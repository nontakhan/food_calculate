<?php
session_start(); 
$ses_username = ( $_SESSION['ses_username'] ); 
$ses_id = ( $_SESSION['ses_id'] ); 


unset ( $_SESSION['ses_username'] );
unset ( $_SESSION['ses_id'] );
session_destroy();
{
header("Location: login.php");
}
?>