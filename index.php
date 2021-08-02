<?php 

    require 'connectionDB.php'; 


    require 'loginCheck.php';

    //include "userCheck.php";


    $sql = "SELECT courses.id, courses.name, coursestypes.id AS course_id, coursestypes.sector FROM `courses` JOIN coursestypes ON courses.id_sector = coursestypes.id ORDER BY courses.id DESC";

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
                <th>Sector</th>
                <th>Action</th>
            </tr>

            <?php    
               while($data_courses = mysqli_fetch_assoc($op)){
           
           ?>


            <tr>
                <td> <?php echo $data_courses['id'];?></td>
                <td> <?php echo $data_courses['name'];?></td>
                <td> <?php echo $data_courses['sector'];?></td>
                <td> <button><a href="book.php?id=<?php echo $data_courses['id'];?>">Book your Course</a></button></td>
            </tr>


            <?php } ?>
            <!-- end table -->
        </table>
        <a href="http://localhost/Group4/project1/Courses/index.php">Admin Portal</a>
    </div>
    <!-- end .container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- confirm delete record will be here -->

</body>

</html>