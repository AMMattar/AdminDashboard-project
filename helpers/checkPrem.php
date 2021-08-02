<?php 


    if($_SESSION['User']['role_id'] == 8){

        header("Location: ".url('index.php'));
    }


?>