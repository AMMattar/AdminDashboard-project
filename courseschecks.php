<?php 

    require 'connectionDB.php'; 

    include './helpers/functions.php';
    require 'loginCheck.php';

    //include "userCheck.php";


    $id = '';
   if($_SERVER['REQUEST_METHOD'] == "GET"){

    // LOGIC .... 
      $Message = [];
      $id  = Sanitize($_GET['id'],1);
     
       if(!Validator($id,3)){
 
        $Message['id'] = "Invalid ID";
        
        $_SESSION['messages'] = $Message;
       header("Location: index.php");
       }

    }
    
    $sql = "SELECT appointment.id, appointment.phoneNumber,appointment.states_co, course_status.states, users.name as user_name,users.id, courses.name AS course_name FROM `appointment` JOIN users ON appointment.user_id = users.id JOIN courses ON appointment.course_id = courses.id join course_status on appointment.states_co = course_status.id where users.id = '$id'";

    $op  = mysqli_query($con,$sql);


?>


<!DOCTYPE html>
<html>

<head>
    <title>Courses</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!-- custom css -->
    <style>
    .m-r-1em {
        margin-right: 1em;
    }

    .m-b-1em {
        margin-bottom: 1em;
    }

    .m-l-1em {
        margin-left: 1em;
    }

    .mt0 {
        margin-top: 0;
    }
    </style>

</head>

<body>

    <!-- container -->
    <div class="container">


        <div class="page-header">
            <h1>Courses </h1> <br>

            <?php 
            
           echo 'WELCOME '.  $_SESSION['data']['name'];
            
            ?>
            <a href="logout.php">Logout</a>






            <?php 
      
        if(isset($_SESSION['message'])){
            echo '* '.$_SESSION['message'];
        }
         unset($_SESSION['message']);
      ?>

        </div>

        <!-- PHP code to read records will be here -->



        <table class='table table-hover table-responsive table-bordered'>
            <!-- creating our table heading -->
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Course</th>
                <th>Status</th>
            </tr>

            <?php    
               while($data_courses = mysqli_fetch_assoc($op)){
           
           ?>


            <tr>
                <td> <?php echo $data_courses['id'];?></td>
                <td> <?php echo $data_courses['user_name'];?></td>
                <td> <?php echo $data_courses['course_name'];?></td>
                <td> <?php echo $data_courses['states'];?></td>
            </tr>


            <?php } ?>
            <!-- end table -->
        </table>
        <a href="http://localhost/Group4/project1/index.php">Brows More Courses</a>
    </div>
    <!-- end .container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- confirm delete record will be here -->

</body>

</html>