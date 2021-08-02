<?php
session_start();

if(!isset($_SESSION['data'])){
    header("location: ".url("login.php"));
}


?>