<?php
  require_once("ApiClass/AppSession.php");
  require_once("ApiClass/Users.php");
 
  if(isset($_POST['submit'])){
       $name = $_POST['name'];
       $pass = md5($_POST['password']);
       try{
       Users::Login($name,$pass);
        header('location:Index.php');
       }
       catch (Exception $ex){
       $message[] =  $ex->getMessage();
       }
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
            <div class="form-container">
              <form action="" method="post" enctype="multipart/form-data">
                 <h3>login now</h3>
                 <?php 
                 if(isset($message)){
                    foreach($message as $message){
                       echo '<div class="message">'.$message.'</div>';
                    }
                 }
                 ?>
                 <input type="name" name="name" placeholder="enter name" class="box" required>
                 <input type="password" name="password" placeholder="enter password" class="box" required>
                 <input type="submit" name="submit" value="login now" class="btn">
                 <p>don't have an account? <a href="register.php">regiser now</a></p>
              </form>

           </div>
       </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>        
     <script src="JS/sidebarJS.js"></script>
</body>

</html>