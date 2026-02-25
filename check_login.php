<?php
/**
 * Login Authentication Handler
 */

// Start session FIRST - before any require/output
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_samesite', 'Lax');
    session_start();
}

require_once("_db/connect.php");

// Build base URL for absolute redirects
$protocol = 'http';
$host = $_SERVER['HTTP_HOST'];
$base = $protocol . '://' . $host . '/food_cal/';

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . $base . 'login.php');
    exit();
}

// Verify CSRF token
if (empty($_POST['csrf_token']) || empty($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    $_SESSION['login_error'] = 'เกิดข้อผิดพลาดด้านความปลอดภัย กรุณาลองใหม่';
    header('Location: ' . $base . 'login.php');
    exit();
}

// Sanitize input
$username = trim($_POST['username1'] ?? '');
$password = $_POST['password1'] ?? '';

if (empty($username) || empty($password)) {
    $_SESSION['login_error'] = 'กรุณากรอกชื่อผู้ใช้และรหัสผ่าน';
    header('Location: ' . $base . 'login.php');
    exit();
}

// Rate limiting
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$rateLimitKey = 'login_attempts_' . md5($ip);

if (!isset($_SESSION[$rateLimitKey])) {
    $_SESSION[$rateLimitKey] = ['count' => 0, 'time' => time()];
}
if (time() - $_SESSION[$rateLimitKey]['time'] > 900) {
    $_SESSION[$rateLimitKey] = ['count' => 0, 'time' => time()];
}
if ($_SESSION[$rateLimitKey]['count'] >= 5) {
    $_SESSION['login_error'] = 'คุณพยายามเข้าสู่ระบบมากเกินไป กรุณารอ 15 นาที';
    header('Location: ' . $base . 'login.php');
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username AND status = 'Y' LIMIT 1");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    $passwordValid = false;

    if ($user) {
        $storedPassword = $user['password'];
        $isHashed = (strlen($storedPassword) >= 60 && preg_match('/^\$2[ayb]\$/', $storedPassword));

        if ($isHashed) {
            $passwordValid = password_verify($password, $storedPassword);
        } else {
            $passwordValid = ($password === $storedPassword);
            if ($passwordValid) {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
                $pdo->prepare("UPDATE user SET password = :p WHERE username = :u")
                    ->execute(['p' => $hashedPassword, 'u' => $username]);
            }
        }
    }

    if ($passwordValid) {
        // Reset rate limit
        $_SESSION[$rateLimitKey] = ['count' => 0, 'time' => time()];

        // Clear old session data and set new
        session_unset();

        $_SESSION['ses_username']       = $user['username'];
        $_SESSION['ses_userid']         = $user['id'];
        $_SESSION['ses_user_id']        = $user['id'];
        $_SESSION['level']              = $user['level'] ?? 'user';
        $_SESSION['last_activity']      = time();
        $_SESSION['ip_address']         = $ip;
        $_SESSION['session_regenerated'] = time();
        $_SESSION['csrf_token']         = bin2hex(random_bytes(32));

        // Write session to disk before redirect
        session_write_close();

        header('Location: ' . $base . 'calculate.php');
        exit();
    }

    // Failed
    $_SESSION[$rateLimitKey]['count']++;
    $_SESSION['login_error'] = 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง';
    header('Location: ' . $base . 'login.php');
    exit();

} catch (PDOException $e) {
    error_log("Login error: " . $e->getMessage());
    $_SESSION['login_error'] = 'เกิดข้อผิดพลาดในระบบ กรุณาลองใหม่';
    header('Location: ' . $base . 'login.php');
    exit();
}
?>
