<?php
/**
 * Database Connection - Secure Configuration
 * PHP 8.x Compatible with PDO and MySQLi
 */

// Load environment variables from .env file
$envFile = dirname(__DIR__) . '/.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        if (strpos($line, '=') === false) continue;
        list($key, $value) = explode('=', $line, 2);
        $_ENV[trim($key)] = trim($value);
    }
}

// Database Configuration (loaded from .env)
define('DB_HOST', $_ENV['DB_HOST'] ?? 'localhost');
define('DB_USER', $_ENV['DB_USER'] ?? 'root');
define('DB_PASS', $_ENV['DB_PASS'] ?? '');
define('DB_NAME', $_ENV['DB_NAME'] ?? 'food_cal');
define('DB_CHARSET', $_ENV['DB_CHARSET'] ?? 'utf8mb4');

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
