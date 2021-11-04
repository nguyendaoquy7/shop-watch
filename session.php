<?php 
error_reporting(E_ALL & ~E_NOTICE);
    include 'config.php' ;
    
    session_start();
    
    $user_id = $_SESSION['login_user'];

?>