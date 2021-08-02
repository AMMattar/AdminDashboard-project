<?php


          if($_SESSION['data']["role_id"] == 1 ){
            header("Location: index_super_admin.php");
          }elseif($_SESSION['data']["role_id"] == 2 ){
            header("Location: index_admin.php");
          }


?>