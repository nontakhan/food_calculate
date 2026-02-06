<?php
/**
 * Login Authentication Handler
 * Secure implementation with prepared statements and password hashing
 */

require_once("_db/connect.php");

// Start session securely
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set security headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('login.php');
}

// Verify CSRF token
if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
    alertRedirect('เกิดข้อผิดพลาดด้านความปลอดภัย กรุณาลองใหม่อีกครั้ง', 'login.php');
}

// Sanitize and validate input
$username = trim($_POST['username1'] ?? '');
$password = $_POST['password1'] ?? '';

// Validate required fields
if (empty($username)) {
    alertRedirect('กรุณากรอกชื่อผู้ใช้', 'login.php');
}

if (empty($password)) {
    alertRedirect('กรุณากรอกรหัสผ่าน', 'login.php');
}

// Rate limiting (simple implementation)
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$rateLimitKey = 'login_attempts_' . md5($ip);

if (!isset($_SESSION[$rateLimitKey])) {
    $_SESSION[$rateLimitKey] = ['count' => 0, 'time' => time()];
}

// Reset count after 15 minutes
if (time() - $_SESSION[$rateLimitKey]['time'] > 900) {
    $_SESSION[$rateLimitKey] = ['count' => 0, 'time' => time()];
}

// Block after 5 failed attempts
if ($_SESSION[$rateLimitKey]['count'] >= 5) {
    alertRedirect('คุณพยายามเข้าสู่ระบบมากเกินไป กรุณารอ 15 นาที', 'login.php');
}

try {
    // Use prepared statement to prevent SQL injection
    $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username AND status = 'Y' LIMIT 1");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();
    
    if ($user) {
        // Check password - support both hashed and plain text (for migration)
        $passwordValid = false;
        $storedPassword = $user['password'];
        
        // Check if password is hashed (bcrypt hashes start with $2y$ and are 60 chars)
        $isHashed = (strlen($storedPassword) >= 60 && preg_match('/^\$2[ayb]\$/', $storedPassword));
        
        if ($isHashed) {
            // Verify hashed password
            $passwordValid = password_verify($password, $storedPassword);
        } else {
            // Plain text comparison (legacy)
            $passwordValid = ($password === $storedPassword);
            
            // Auto-migrate to hashed password on successful login
            if ($passwordValid) {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
                $updateStmt = $pdo->prepare("UPDATE user SET password = :password WHERE username = :username");
                $updateStmt->execute(['password' => $hashedPassword, 'username' => $username]);
            }
        }
        
        if ($passwordValid) {
            // Reset rate limiting on successful login
            $_SESSION[$rateLimitKey] = ['count' => 0, 'time' => time()];
            
            // Regenerate session ID to prevent session fixation
            session_regenerate_id(true);
            
            // Set session variables
            $_SESSION['ses_userid'] = session_id();
            $_SESSION['ses_username'] = $user['username'];
            $_SESSION['ses_user_id'] = $user['id'] ?? null;
            $_SESSION['level'] = $user['level'] ?? 'user';
            $_SESSION['last_activity'] = time();
            $_SESSION['ip_address'] = $ip;
            $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'] ?? '';
            
            // Generate new CSRF token
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            
            // Redirect based on user level
            redirect('menu.php');
        }
    }
    
    // Failed login - increment rate limit
    $_SESSION[$rateLimitKey]['count']++;
    
    alertRedirect('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง', 'login.php');
    
} catch (PDOException $e) {
    error_log("Login error: " . $e->getMessage());
    alertRedirect('เกิดข้อผิดพลาดในระบบ กรุณาลองใหม่อีกครั้ง', 'login.php');
}
?>
