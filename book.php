<?php
include './helpers/connectionDB.php';
include './helpers/functions.php';
include 'loginCheck.php';

echo "thanks for booking we will contact you soon, please leave your number";


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

$sql3 = "SELECT * from courses where id = '$id'";
$op3  = mysqli_query($con,$sql3);
$courses_data = mysqli_fetch_assoc($op3);

if($_SERVER['REQUEST_METHOD'] == "POST"){
       
    // LOGIC ... 
      $phone = CleanInputs($_POST['phone']);
      $id         = Sanitize($_POST['id'],1);


      $Message = [];
      # Check Validation ... 
      
      if(!Validator($phone,1)){
      
        $Message['phone'] = "Phone Field Required";

      }
      

     if(count($Message) > 0){
       $_SESSION['messages'] = $Message;
             
    }else{

    // echo $id;
     $course = $_GET['id'];
        //exit();
    # DB OPERATION .... 

    $sql = "INSERT INTO appointment (phoneNumber,states_co,user_id,course_id) VALUES ('$phone','1','$id','$course')";

    $op  = mysqli_query($con,$sql);

    if($op){

         $Message['Result'] = "Data Inserted.";
       
    }else{
         $Message['Result']  = "Error Try Again.";
         //echo mysqli_error($sql);
        echo 'error';
     }
        $_SESSION['messages'] = $Message;
       
        header('Location: index.php');

     }

   }


// $sql = "SELECT courses.id, courses.name, courses.id_sector, coursestypes.id AS course_id, coursestypes.sector FROM `courses` JOIN coursestypes ON courses.id_sector = coursestypes.id where courses.id = $id";
// $op = mysqli_query($con, $sql);
// $data = mysqli_fetch_assoc($op);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Booking</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>


<body>
    <div class="container">
        <h2>Booking</h2>
        <form method="post" action="book.php?id=<?php echo $courses_data['id'];?>" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputEmail1">Phone Number</label>
                <input type="text" name="phone" class="form-control" id="exampleInputName" aria-describedby=""
                    placeholder="Enter Phone Number">
            </div>

            <input type="hidden" name="id" value="<?php echo $_SESSION['data']['id'];?>">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <button><a href="index.php"> See more Courses </a></button>
    </div>

</body>

</html>