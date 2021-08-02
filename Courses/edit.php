<?php 
include '../helpers/functions.php';
include '../helpers/loginCheck.php';
include '../helpers/adminCheck.php';
include '../helpers/connectionDB.php';


$sql2 = 'select * from coursestypes';
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
      $sector = CleanInputs($_POST['sector']);
      $name = CleanInputs($_POST['name']);
      $id         = Sanitize($_POST['id'],1);


      $Message = [];
      # Check Validation ... 
      if(!Validator($name,1)){
      
        $Message['name'] = "Name Field Required";

      }
  
      
      $length = 3;

      if(!Validator($name,2,$length)){
      
        $Message['name'] = "name length must be > ".$length;

      }

     if(count($Message) > 0){
       $_SESSION['messages'] = $Message;
             
    }else{

    # DB OPERATION .... 

    $sql = "update courses set name='$name', id_sector='$sector' where id = '$id'";

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

    $sql = "SELECT courses.id, courses.name, courses.id_sector, coursestypes.id AS course_id, coursestypes.sector FROM `courses` JOIN coursestypes ON courses.id_sector = coursestypes.id where courses.id = $id";
    $op = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($op);
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
                        <form method="post" action="edit.php?id=<?php echo $data['id'];?>"
                            enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" name="name" value="<?php echo $data['name'];?>" class="form-control"
                                    id="exampleInputName" aria-describedby="" placeholder="Enter Name">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">Sector</label>
                                <select name="sector" class="form-control">
                                    <?php
            while($sector_data = mysqli_fetch_assoc($op2)){
        ?>
                                    <option value="<?php echo $sector_data['id'];?>"
                                        <?php if($sector_data['id'] == $data['course_id'] ){ echo 'selected';}?>>
                                        <?php echo $sector_data['sector'];?></option>
                                    <?php } ?>
                                </select>
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