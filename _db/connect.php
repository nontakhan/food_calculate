<?php
/**
 * Database Connection - Secure Configuration
 * PHP 8.x Compatible with PDO and MySQLi
 */

// Database Configuration
define('DB_HOST', '192.168.203.6');
define('DB_USER', 'thepha');
define('DB_PASS', '_iL0veU2');
define('DB_NAME', 'food_cal');
define('DB_CHARSET', 'utf8mb4');

// Error reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

// MySQLi Connection (for backward compatibility)
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
    error_log("Database connection failed: " . mysqli_connect_error());
    die("<div class='alert alert-danger text-center'>ขณะนี้ระบบไม่สามารถเชื่อมต่อกับฐานข้อมูลได้</div>");
}

// Set charset
mysqli_set_charset($conn, DB_CHARSET);

// PDO Connection (recommended for prepared statements)
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    error_log("PDO Connection failed: " . $e->getMessage());
    die("<div class='alert alert-danger text-center'>ขณะนี้ระบบไม่สามารถเชื่อมต่อกับฐานข้อมูลได้</div>");
}

/**
 * Security Helper Functions
 */

// Generate CSRF Token
function generateCsrfToken(): string {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Verify CSRF Token
function verifyCsrfToken(?string $token): bool {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($token) || empty($_SESSION['csrf_token'])) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

// Sanitize output for XSS protection
function h(?string $string): string {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

// Secure password hashing
function hashPassword(string $password): string {
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
}

// Verify password
function verifyPassword(string $password, string $hash): bool {
    return password_verify($password, $hash);
}

// Secure redirect
function redirect(string $url): void {
    header("Location: " . $url);
    exit();
}

// Show alert and redirect
function alertRedirect(string $message, string $url): void {
    echo "<script>alert('" . addslashes($message) . "'); window.location.href='" . $url . "';</script>";
    exit();
}
?>
