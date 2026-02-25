<?php
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

// Database Configuration
$db_host = isset($_ENV['DB_HOST']) ? $_ENV['DB_HOST'] : 'localhost';
$db_user = isset($_ENV['DB_USER']) ? $_ENV['DB_USER'] : 'root';
$db_pass = isset($_ENV['DB_PASS']) ? $_ENV['DB_PASS'] : '';
$db_name = isset($_ENV['DB_NAME']) ? $_ENV['DB_NAME'] : 'food_cal';
$db_charset = isset($_ENV['DB_CHARSET']) ? $_ENV['DB_CHARSET'] : 'utf8mb4';

// MySQLi Connection
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
    die("Database connection failed");
}
mysqli_set_charset($conn, $db_charset);

// PDO Connection
try {
    $pdo = new PDO(
        "mysql:host=" . $db_host . ";dbname=" . $db_name . ";charset=" . $db_charset,
        $db_user,
        $db_pass,
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        )
    );
} catch (PDOException $e) {
    die("Database connection failed");
}

// Helper Functions (no type declarations for PHP compatibility)
function generateCsrfToken() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = md5(uniqid(mt_rand(), true));
    }
    return $_SESSION['csrf_token'];
}

function h($string) {
    if ($string === null) $string = '';
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function redirect($url) {
    header("Location: " . $url);
    exit();
}

function alertRedirect($message, $url) {
    echo "<script>alert('" . addslashes($message) . "'); window.location.href='" . $url . "';</script>";
    exit();
}

function verifyCsrfToken($token) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($token) || empty($_SESSION['csrf_token'])) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));
}
?>
