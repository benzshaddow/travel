<?php
    session_start();
    if(!isset($_SESSION['TOKEN']) || (trim($_SESSION['TOKEN']) == '')) {
    	header("location: index.php");
    	exit();
    }
    if(!isset($_SESSION['MEMBER_ID']) || (trim($_SESSION['MEMBER_ID']) == '')) {
    }
?>
