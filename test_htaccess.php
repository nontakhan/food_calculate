<?php
echo "<h2>.htaccess Test</h2>";
echo "<p>Current URL: " . $_SERVER['REQUEST_URI'] . "</p>";
echo "<p>Script name: " . $_SERVER['SCRIPT_NAME'] . "</p>";
echo "<p>PHP_SELF: " . $_SERVER['PHP_SELF'] . "</p>";
echo "<p>HTTP_HOST: " . $_SERVER['HTTP_HOST'] . "</p>";
echo "<p>HTTPS: " . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'YES' : 'NO') . "</p>";

// Test if .htaccess is being read
if (function_exists('apache_get_modules')) {
    $modules = apache_get_modules();
    echo "<p>Rewrite module loaded: " . (in_array('mod_rewrite', $modules) ? 'YES' : 'NO') . "</p>";
}

// Check if URL rewriting is happening
$has_php = strpos($_SERVER['REQUEST_URI'], '.php') !== false;
echo "<p>URL contains .php: " . ($has_php ? 'YES' : 'NO') . "</p>";

// Test direct file access
$file_path = __FILE__;
echo "<p>File path: $file_path</p>";
echo "<p>File exists: " . (file_exists($file_path) ? 'YES' : 'NO') . "</p>";

// Test rewrite rules
echo "<h3>Test Links:</h3>";
echo "<p><a href='test_htaccess'>test_htaccess (no .php)</a></p>";
echo "<p><a href='test_htaccess.php'>test_htaccess.php (with .php)</a></p>";
echo "<p><a href='debug_form_submit'>debug_form_submit (no .php)</a></p>";
echo "<p><a href='debug_form_submit.php'>debug_form_submit.php (with .php)</a></p>";
?>
