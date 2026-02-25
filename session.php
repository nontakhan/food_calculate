<?php
// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Session timeout (30 minutes)
$sessionTimeout = 1800;

// Get session variables
$ses_userid = isset($_SESSION['ses_userid']) ? $_SESSION['ses_userid'] : null;
$ses_username = isset($_SESSION['ses_username']) ? $_SESSION['ses_username'] : null;

// Check if user is logged in
if (empty($_SESSION['ses_username'])) {
    session_destroy();
    echo "<script>alert('กรุณาเข้าสู่ระบบก่อนใช้งาน'); window.location.href='login.php';</script>";
    exit();
}

// Check session timeout
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $sessionTimeout)) {
    session_destroy();
    echo "<script>alert('หมดเวลาการใช้งาน กรุณาเข้าสู่ระบบใหม่'); window.location.href='login.php';</script>";
    exit();
}

// Update last activity
$_SESSION['last_activity'] = time();
?>
