<?php 

 
include '../helpers/functions.php';
include '../helpers/loginCheck.php';
include '../helpers/adminCheck.php';
include '../helpers/connectionDB.php';

# Clean input ...
// function CleanInputs($input){

//     $input = trim($input);
//     $input = stripcslashes($input);
//     $input = htmlspecialchars($input);

//     return $input;
//   }

    $errorMessages = array();
    if($_SERVER['REQUEST_METHOD'] == "POST" ){

       $name  = CleanInputs($_POST['name']);
       $email = CleanInputs($_POST['email']);
       $password = CleanInputs($_POST['password']); 

        // Name Validation ...
        if(!empty($name)){
          // code ... 
           if(strlen($name) < 3){
              $errorMessages['name'] = "Name Length must be > 2 "; 
             }
        }else{
          $errorMessages['name'] = "Required";
        }

        // Email Validation ... 
        if(!empty($email)){
           // code ... 
           if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $errorMessages['email'] = "Invalid Email";
           }

        }else{
            $errorMessages['email'] = "Required";
        }

        // Password Validation ... 
        if(!empty($password)){
           // code ...   
            if(strlen($password) < 6){

               $errorMessages['Password'] = "Password Length must be > 5 "; 
            }

        }else{

          $errorMessages['Password'] = "Required";

        }

     if(count($errorMessages) == 0){

          $sql = "insert into users (name,email,password,role_id) values ('$name','$email','$password','3')";

          $op =  mysqli_query($con,$sql);

          //mysqli_error($con);

       if($op){
           header("location: index.php");
       }else{
         echo 'Error Try Again';
       }



     }else{

     // print error messages 
     foreach($errorMessages as $key => $value){

        echo '* '.$key.' : '.$value.'<br>';
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

                        <li class="breadcrumb-item active">Add Course</li>
                        <?php } ?>



                    </ol>



                    <div class="container">

                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
                            enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" name="name" class="form-control" id="exampleInputName"
                                    aria-describedby="" placeholder="Enter name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" name="email" class="form-control" id="exampleInputName"
                                    aria-describedby="" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="text" name="password" class="form-control" id="exampleInputName"
                                    aria-describedby="" placeholder="Enter password">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>



                </div>
            </main>



            <?php 
    include '../footer.php';
?>