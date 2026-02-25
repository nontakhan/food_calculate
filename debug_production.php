<?php
echo "<h1>Server Test</h1>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>Server: " . $_SERVER['HTTP_HOST'] . "</p>";
echo "<p>HTTPS: " . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'YES' : 'NO') . "</p>";

// Test session
session_start();
echo "<p>Session: OK</p>";

// Test database
try {
    include '_db/connect.php';
    echo "<p>Database: Connected</p>";
    $stmt = $pdo->query("SELECT COUNT(*) as cnt FROM user");
    $row = $stmt->fetch();
    echo "<p>Users: " . $row['cnt'] . "</p>";
} catch (Exception $e) {
    echo "<p style='color:red'>DB Error: " . $e->getMessage() . "</p>";
}

echo "<p><a href='login.php'>Go to Login</a></p>";
?>
