<?php
require_once("ApiClass/AppSession.php");
require_once("ApiClass/Users.php");

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $email =$_POST['email'];
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;
   try{
      if($pass != $cpass){ throw new Exception('confirm password not matched!');}
      if($image_size > 2000000){ throw new Exception('image size is too large!');} 
      Users::Register_user($name, $pass, $email, $image );
      move_uploaded_file($image_tmp_name, $image_folder);
   }  catch (Exception $ex){
      $message[] =  $ex->getMessage();
   }
   header('location:login.php');
}
?>  
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CERBERUS SHOP</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
   
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>   
    <link rel="stylesheet" href="css/style.css"> 
</head>

<body>
    <div class="wrapper"> 
        <?php include "SideBar.php"; ?>
        <div class="main p-3">
           <div class="text-center">
               <h1> CERBERUS SHOP </h1>
           </div>
           <div id="contexshow" class="container row"> 

                <form action="" method="post" enctype="multipart/form-data">
                   <h3>register now</h3>
                   <?php
                   if(isset($message)){
                      foreach($message as $message){
                         echo '<div class="message">'.$message.'</div>';
                      }
                   }
                   ?>
                   <input type="text" name="name" placeholder="enter username" class="box" required>
                   <input type="email" name="email" placeholder="enter email" class="box" required>
                   <input type="password" name="password" placeholder="enter password" class="box" required>
                   <input type="password" name="cpassword" placeholder="confirm password" class="box" required>
                   <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
                   <input type="submit" name="submit" value="register now" class="btn">
                   <p>already have an account? <a href="login.php">login now</a></p>
                </form>                       

           </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>        
     <script src="JS/sidebarJS.js"></script>
</body>

</html>