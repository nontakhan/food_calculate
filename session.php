<?php
/**
 * Session Security Handler
 * Implements secure session management according to OWASP guidelines
 */

// Configure session security before starting
if (session_status() === PHP_SESSION_NONE) {
    // Session cookie settings
    ini_set('session.cookie_httponly', 1);
    ini_set('session.cookie_secure', 0);
    ini_set('session.cookie_samesite', 'Lax');
    ini_set('session.use_strict_mode', 1);
    ini_set('session.use_only_cookies', 1);
    
    // Session lifetime
    ini_set('session.gc_maxlifetime', 1800); // 30 minutes
    
    session_start();
}

// Set security headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('X-XSS-Protection: 1; mode=block');
header('Referrer-Policy: strict-origin-when-cross-origin');

// Session timeout (30 minutes of inactivity)
$sessionTimeout = 1800;

// Check if session variables exist
$ses_userid = $_SESSION['ses_userid'] ?? null;
$ses_username = $_SESSION['ses_username'] ?? null;

// Validate session
function validateSession(): bool {
    global $sessionTimeout;
    
    // Check if required session variables exist
    if (empty($_SESSION['ses_username'])) {
        return false;
    }
    
    // Check session timeout
    if (isset($_SESSION['last_activity'])) {
        if (time() - $_SESSION['last_activity'] > $sessionTimeout) {
            return false;
        }
    }
    
    // Update last activity time
    $_SESSION['last_activity'] = time();
    
    return true;
}

// Destroy session securely
function destroySession(): void {
    $_SESSION = [];
    
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }
    
    session_destroy();
}

// Check if user is logged in
if (!validateSession()) {
    destroySession();
    
    // Check if this is an AJAX request
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        header('Content-Type: application/json');
        http_response_code(401);
        echo json_encode(['error' => 'Session expired', 'redirect' => 'login.php']);
        exit();
    }
    
    echo "<script>alert('กรุณาเข้าสู่ระบบก่อนใช้งาน'); window.location.href='login.php';</script>";
    exit();
}

// Note: session_regenerate_id removed to prevent session loss after login redirect
?>
