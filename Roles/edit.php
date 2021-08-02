<?php 
include '../helpers/functions.php';
include '../helpers/loginCheck.php';
include '../helpers/adminCheck.php';
include '../helpers/connectionDB.php';


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
      $role = CleanInputs($_POST['role']);
      $id         = Sanitize($_POST['id'],1);


      $Message = [];
      # Check Validation ... 
      if(!Validator($role,1)){
      
        $Message['name'] = "Name Field Required";

      }
  
      
     if(count($Message) > 0){
       $_SESSION['messages'] = $Message;
             
    }else{

    # DB OPERATION .... 

    $sql = "update roles set role='$role' where id = '$id'";

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

    $sql2 = "select * from roles where id='$id'";
    $op2 = mysqli_query($con,$sql2);
    $data = mysqli_fetch_assoc($op2);
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

                        <li class="breadcrumb-item active">Edit Role</li>
                        <?php } ?>



                    </ol>



                    <div class="container">
                        <h2>Edit Data</h2>
                        <form method="post" action="edit.php?id=<?php echo $data['id'];?>"
                            enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Role</label>
                                <input type="text" name="role" value="<?php echo $data['role'];?>" class="form-control"
                                    id="exampleInputName" aria-describedby="" placeholder="Enter Name">
                            </div>

                            <input type="hidden" name="id" value="<?php echo $data['id'];?>">

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>



                </div>
            </main>



            <?php 
    include '../footer.php';
?>