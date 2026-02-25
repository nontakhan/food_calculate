<?php
require_once '_db/connect.php';

echo "<h2>Fix Admin Password</h2>";

// Create correct hash for '123456'
$password = '123456';
$hash = password_hash($password, PASSWORD_BCRYPT);

echo "<p>New hash for '123456': " . $hash . "</p>";

// Update admin password
$stmt = $pdo->prepare("UPDATE user SET password = :password WHERE username = 'admin'");
$result = $stmt->execute(['password' => $hash]);

if ($result) {
    echo "<p>✅ Password updated successfully!</p>";
    
    // Test verification
    $stmt2 = $pdo->prepare("SELECT password FROM user WHERE username = 'admin'");
    $stmt2->execute();
    $user = $stmt2->fetch();
    
    $verify = password_verify($password, $user['password']);
    echo "<p>Verification test: " . ($verify ? '✅ PASS' : '❌ FAIL') . "</p>";
    
    // Test multiple passwords
    $test_passwords = ['123456', 'admin', 'password', 'admin123'];
    echo "<h3>Password Tests:</h3>";
    foreach ($test_passwords as $pwd) {
        $valid = password_verify($pwd, $user['password']);
        echo "<p>'$pwd': " . ($valid ? '✅ VALID' : '❌ INVALID') . "</p>";
    }
    
} else {
    echo "<p>❌ Failed to update password</p>";
}

echo "<hr>";
echo "<p><a href='test_login_manual.php'>Test Manual Login</a></p>";
echo "<p><a href='login.php'>Go to Login Page</a></p>";
?>
