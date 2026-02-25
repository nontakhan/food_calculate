<?php
session_start();
require_once '_db/connect.php';

echo "<h1>Test Functions</h1>";

// Test CSRF token generation
$token = generateCsrfToken();
echo "<p>CSRF Token: " . $token . "</p>";

// Test CSRF verification
$verify = verifyCsrfToken($token);
echo "<p>CSRF Verify: " . ($verify ? 'PASS' : 'FAIL') . "</p>";

// Test password hashing
$hash = hashPassword('123456');
echo "<p>Password Hash: " . substr($hash, 0, 20) . "...</p>";

echo "<p><a href='login.php'>Go to Login</a></p>";
?>
