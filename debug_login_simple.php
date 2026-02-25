<?php
// Enable all errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Debug Login Process</h2>";

// Test 1: Check if form is submitting to check_login.php
echo "<h3>1. Form Submission Test</h3>";
echo "<p>Method: " . $_SERVER['REQUEST_METHOD'] . "</p>";
echo "<p>POST data: <pre>" . print_r($_POST, true) . "</pre></p>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<p style='color:green'>✅ Form is submitting via POST</p>";
    
    // Test 2: Check CSRF token
    echo "<h3>2. CSRF Token Check</h3>";
    $csrf_post = $_POST['csrf_token'] ?? 'MISSING';
    $csrf_session = $_SESSION['csrf_token'] ?? 'MISSING';
    
    echo "<p>POST CSRF: " . ($csrf_post === 'MISSING' ? '<strong style="color:red">MISSING</strong>' : substr($csrf_post, 0, 20) . '...') . "</p>";
    echo "<p>Session CSRF: " . ($csrf_session === 'MISSING' ? '<strong style="color:red">MISSING</strong>' : substr($csrf_session, 0, 20) . '...') . "</p>";
    
    if ($csrf_post !== 'MISSING' && $csrf_session !== 'MISSING') {
        $csrf_match = hash_equals($csrf_session, $csrf_post);
        echo "<p>CSRF Match: " . ($csrf_match ? '<strong style="color:green">✅ YES</strong>' : '<strong style="color:red">❌ NO</strong>') . "</p>";
    } else {
        echo "<p style='color:red'>❌ CSRF token missing</p>";
    }
    
    // Test 3: Check if check_login.php is being called
    echo "<h3>3. Check Login Processing</h3>";
    
    // Simulate check_login.php logic
    $username = trim($_POST['username1'] ?? '');
    $password = $_POST['password1'] ?? '';
    
    echo "<p>Username: '$username'</p>";
    echo "<p>Password: '" . (empty($password) ? 'EMPTY' : 'FILLED') . "'</p>";
    
    if (!empty($username) && !empty($password)) {
        echo "<p style='color:green'>✅ Input validation passed</p>";
        
        // Test database connection
        try {
            require_once("_db/connect.php");
            echo "<p style='color:green'>✅ Database connected</p>";
            
            // Test user query
            $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username AND status = 'Y' LIMIT 1");
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch();
            
            if ($user) {
                echo "<p style='color:green'>✅ User found: " . htmlspecialchars($user['username']) . " (id=" . $user['id'] . ")</p>";
                
                // Test password
                $valid = password_verify($password, $user['password']);
                echo "<p>Password verify: " . ($valid ? '<strong style="color:green">✅ VALID</strong>' : '<strong style="color:red">❌ INVALID</strong>') . "</p>";
                
                if ($valid) {
                    echo "<h3>4. Session Setup Test</h3>";
                    
                    // Clear and set session
                    session_unset();
                    $_SESSION['ses_username'] = $user['username'];
                    $_SESSION['ses_userid'] = $user['id'];
                    $_SESSION['level'] = $user['level'];
                    $_SESSION['last_activity'] = time();
                    
                    echo "<p style='color:green'>✅ Session variables set</p>";
                    echo "<p>Session ID: " . session_id() . "</p>";
                    echo "<p>Session data: <pre>" . print_r($_SESSION, true) . "</pre></p>";
                    
                    // Test redirect
                    echo "<h3>5. Redirect Test</h3>";
                    $base = 'http://' . $_SERVER['HTTP_HOST'] . '/food_cal/';
                    $redirect_url = $base . 'calculate.php';
                    echo "<p>Redirect URL: <a href='$redirect_url' target='_blank'>$redirect_url</a></p>";
                    echo "<p><button onclick='window.location.href=\"$redirect_url\"'>Test Redirect</button></p>";
                    
                } else {
                    echo "<p style='color:red'>❌ Password incorrect</p>";
                }
            } else {
                echo "<p style='color:red'>❌ User not found or status not Y</p>";
            }
        } catch (Exception $e) {
            echo "<p style='color:red'>❌ Database error: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p style='color:red'>❌ Input validation failed</p>";
    }
} else {
    echo "<p style='color:orange'>Waiting for POST submission...</p>";
    echo "<p><a href='login.php'>Go to Login Page</a></p>";
}

echo "<hr>";
echo "<p><small>Current URL: " . $_SERVER['REQUEST_URI'] . "</small></p>";
echo "<p><small>HTTP Host: " . $_SERVER['HTTP_HOST'] . "</small></p>";
echo "<p><small>HTTPS: " . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'YES' : 'NO') . "</small></p>";
?>
