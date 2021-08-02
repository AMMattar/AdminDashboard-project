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
    


    $sql = "SELECT courses.id, courses.name, coursestypes.id AS course_id, coursestypes.sector FROM `courses` JOIN coursestypes ON courses.id_sector = coursestypes.id ORDER BY courses.id DESC";

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
                                            <th>Name</th>
                                            <th>Sector</th>
                                            <th>Add Course</th>
                                            <th>ِAdmin Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php    
               while($data_courses = mysqli_fetch_assoc($op)){
           
           ?>


                                        <tr>
                                            <td> <?php echo $data_courses['id'];?></td>
                                            <td> <?php echo $data_courses['name'];?></td>
                                            <td> <?php echo $data_courses['sector'];?></td>
                                            <td> <button><a href="add.php">Add Course</a></button></td>
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