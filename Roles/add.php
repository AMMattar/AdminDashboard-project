<?php 

 
include '../helpers/functions.php';
include '../helpers/loginCheck.php';
include '../helpers/adminCheck.php';
include '../helpers/connectionDB.php';


   if($_SERVER['REQUEST_METHOD'] == "POST"){
       
    // LOGIC ... 

      $role = $_POST['role'];


      $Message = [];
      # Check Validation ... 
      
      if(empty($sector)){
        // code ... 
         $errorMessages['role'] = "Required";
     }  

     if(count($Message) > 0){
       $_SESSION['messages'] = $Message;
             
    }else{

    # DB OPERATION .... 

    $sql = "insert into roles (role) values ('$role')";

    $op  = mysqli_query($con,$sql);

    if($op){

         $Message['Result'] = "Data inserted.";
        $_SESSION['messages'] = $Message;
    }else{
        $Message['Result']  = "Error Try Again.";
     
        $_SESSION['messages'] = $Message;


     }


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

                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
                            enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Role name</label>
                                <input type="text" name="role" class="form-control" id="exampleInputName"
                                    aria-describedby="" placeholder="Enter Role">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>



                </div>
            </main>



            <?php 
    include '../footer.php';
?>