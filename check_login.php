<?php
session_start();
require_once("_db/connect.php");

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit();
}

// Get input
$username = trim(isset($_POST['username1']) ? $_POST['username1'] : '');
$password = isset($_POST['password1']) ? $_POST['password1'] : '';

if (empty($username) || empty($password)) {
    echo "<script>alert('กรุณากรอกชื่อผู้ใช้และรหัสผ่าน'); window.location.href='login.php';</script>";
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username AND status = 'Y' LIMIT 1");
    $stmt->execute(array('username' => $username));
    $user = $stmt->fetch();

    $passwordValid = false;

    if ($user) {
        $storedPassword = $user['password'];
        // Check if password is hashed (bcrypt)
        if (strlen($storedPassword) >= 60 && substr($storedPassword, 0, 4) === '$2y$') {
            $passwordValid = password_verify($password, $storedPassword);
        } else {
            // Plain text password - compare directly
            $passwordValid = ($password === $storedPassword);
        }
    }

    if ($passwordValid) {
        // Set session
        $_SESSION['ses_username'] = $user['username'];
        $_SESSION['ses_userid'] = $user['id'];
        $_SESSION['ses_user_id'] = $user['id'];
        $_SESSION['level'] = isset($user['level']) ? $user['level'] : 'user';
        $_SESSION['last_activity'] = time();

        session_write_close();
        header('Location: calculate.php');
        exit();
    }

    // Login failed
    echo "<script>alert('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง'); window.location.href='login.php';</script>";
    exit();

} catch (Exception $e) {
    echo "<script>alert('เกิดข้อผิดพลาด: " . addslashes($e->getMessage()) . "'); window.location.href='login.php';</script>";
    exit();
}
?>
