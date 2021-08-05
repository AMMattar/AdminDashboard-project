<?php 
include '../helpers/functions.php';
include '../helpers/loginCheck.php';
include '../helpers/adminCheck.php';
include '../helpers/connectionDB.php';


$sql2 = 'select * from course_status';
$op2 = mysqli_query($con,$sql2);

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







   if($_SERVER['REQUEST_METHOD'] == "POST"){
       
    // LOGIC ... 
      $states = CleanInputs($_POST['states']);
      $id         = Sanitize($_POST['id'],1);


      $Message = [];
      # Check Validation ... 
      if(!Validator($states,1)){
      
        $Message['states'] = "states Field Required";

      }

     if(count($Message) > 0){
       $_SESSION['messages'] = $Message;
             
    }else{

    # DB OPERATION .... 

    $sql = "update appointment set states_co='$states' where id = '$id'";

    $op  = mysqli_query($con,$sql);

    if($op){

         $Message['Result'] = "Data updated.";
       
    }else{
         $Message['Result']  = "Error Try Again.";
     
     }
        $_SESSION['messages'] = $Message;
       
        header('Location: index.php');

     }

   }



    include '../header.php';
?>

<body class="sb-nav-fixed">


    <?php 
    include '../nav.php';
?>


    <div id="layoutSidenav">


        <?php 
    include '../sidNav.php';

    $sql = "SELECT appointment.id as app_id, appointment.states_co, users.name as us_name, users.id as id_user from users JOIN appointment ON appointment.user_id = users.id join course_status on appointment.states_co = course_status.id where appointment.id=$id";

    $op  = mysqli_query($con,$sql);
    $app_data = mysqli_fetch_assoc($op);
?>





        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">

                        <?php 
                        
    

                            if(isset($_SESSION['messages'])){

                               foreach($_SESSION['messages'] as $key =>  $data){

                                echo '* '.$key.' : '.$data.'<br>';
                               }

                             unset($_SESSION['messages']);
                             }else{
                        ?>

                        <li class="breadcrumb-item active">Add Role</li>
                        <?php } ?>



                    </ol>



                    <div class="container">
                        <h2>Edit Data</h2>
                        <form method="post" action="edit.php?id=<?php echo $app_data['app_id'];?>"
                            enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" name="name" value="<?php echo $app_data['us_name'];?>"
                                    class="form-control" id="exampleInputName" aria-describedby=""
                                    placeholder="Enter Name">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">States</label>
                                <select name="states" class="form-control">
                                    <?php
            while($role_data = mysqli_fetch_assoc($op2)){
        ?>
                                    <option value="<?php echo $role_data['id'];?>"
                                        <?php if($role_data['id'] == $app_data['states_co'] ){ echo 'selected';}?>>
                                        <?php echo $role_data['states'];?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $app_data['app_id'];?>">

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>



                </div>
            </main>



            <?php 
    include '../footer.php';
?>