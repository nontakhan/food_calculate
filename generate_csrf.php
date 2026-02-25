<?php
session_start();
echo json_encode(['token' => bin2hex(random_bytes(32))]);
?>
