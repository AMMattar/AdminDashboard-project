<?php 

   include './helpers/connectionDB.php';
include './helpers/functions.php';
   # Clean input ...
  //  function CleanInputs($input){

  //   $input = trim($input);
  //   $input = stripcslashes($input);
  //   $input = htmlspecialchars($input);

  //   return $input;
  // }

    $errorMessages = array();
    if($_SERVER['REQUEST_METHOD'] == "POST" ){

       $email = CleanInputs($_POST['email']);
       $password = CleanInputs($_POST['password']); 

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

        // Code ... 
       
        //$password = sha1($password);
        $sql = "select * from users where email = '$email' and password = '$password'";
        
        $op  = mysqli_query($con,$sql);
        
        
          if(mysqli_num_rows($op) == 1){

            // code... 

          $data = mysqli_fetch_assoc($op);

          $_SESSION['data'] = $data;
          header("Location: index.php");
            
         //header("Location: index.php");
          }else{

            echo 'Error in Login try again ';
          }





     }else{

     // print error messages 
     foreach($errorMessages as $key => $value){

        echo '* '.$key.' : '.$value.'<br>';
        }
      } 
    }





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Login</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data">



            <div class="form-group">
                <label for="exampleInputEmail1">Email </label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Enter email">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1"> Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                    placeholder="Password">
            </div>


            <button type="submit" class="btn btn-primary">Login</button>
            <h3>Register if you don't have an account</h3>
            <button><a href="register.php">Register</a></button>
        </form>
    </div>

</body>

</html>