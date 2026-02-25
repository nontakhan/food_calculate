<?php
echo "<h1>Simple Test</h1>";
echo "<p>Current URL: " . $_SERVER['REQUEST_URI'] . "</p>";
echo "<p>Script: " . __FILE__ . "</p>";
echo "<p>Working Directory: " . __DIR__ . "</p>";
echo "<p><a href='test_simple'>test_simple (no .php)</a></p>";
echo "<p><a href='test_simple.php'>test_simple.php</a></p>";
echo "<p><a href='login.php'>login.php</a></p>";
echo "<p><a href='login'>login (no .php)</a></p>";
?>
