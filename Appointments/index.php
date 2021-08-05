<?php 
include '../helpers/functions.php';
include '../helpers/loginCheck.php';
include '../helpers/adminCheck.php';
include '../helpers/connectionDB.php';

    include '../header.php';
?>

<body class="sb-nav-fixed">


    <?php 
    include '../nav.php'; 
?>


    <div id="layoutSidenav">


        <?php 
    include '../sidNav.php';
    


    $sql = "SELECT appointment.id, appointment.phoneNumber,appointment.states_co, course_status.states, users.name as user_name, courses.name AS course_name FROM `appointment` JOIN users ON appointment.user_id = users.id JOIN courses ON appointment.course_id = courses.id join course_status on appointment.states_co = course_status.id";
    $op  = mysqli_query($con,$sql);

?>





        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>



                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            DataTable of courses
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Phone Number</th>
                                            <th>User Name</th>
                                            <th>Course Name</th>
                                            <th>Course Stats</th>
                                            <th>ِAdmin Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php    
               while($data_courses = mysqli_fetch_assoc($op)){
           
           ?>


                                        <tr>
                                            <td> <?php echo $data_courses['id'];?></td>
                                            <td> <?php echo $data_courses['phoneNumber'];?></td>
                                            <td> <?php echo $data_courses['user_name'];?></td>
                                            <td> <?php echo $data_courses['course_name'];?></td>
                                            <td> <?php echo $data_courses['states'];?></td>
                                            <td>
                                                <a href='delete.php?id=<?php echo $data_courses['id'];?>'
                                                    class='btn btn-danger m-r-1em'>Delete</a>
                                                <a href='edit.php?id=<?php echo $data_courses['id'];?>'
                                                    class='btn btn-primary m-r-1em'>Edit</a>
                                            </td>
                                        </tr>


                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>



            <?php 
    include '../footer.php';
?>