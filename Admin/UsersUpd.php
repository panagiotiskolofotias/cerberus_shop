<?php
  require_once("../ApiClass/AppSession.php");
  require_once("../ApiClass/ConnectionDB.php"); 
  if(isset($_GET['Userid'])){
    $Userid = $_GET['Userid'];
  }
   
 if(isset($_POST['submit'])){
   $name = $_POST['name'];
   $user_type =$_POST['UserRole'];
   try{
      $qury ="update users set name = '".$name."',user_type = '".$user_type."' where id = ".$Userid;
      $SqlResponce = ConnectionDB::ExcecuteQuery($qury);
      header('location:Users.php');
   }  catch (Exception $ex){
       $message = $ex->getMessage();
   }
   header('location:Users.php');
} 
$OldName ="";
$user_type =""; 
if(!isset($_POST['submit'])){
    $SqlResponce = ConnectionDB::SelectQuery("Select * from users where id = ".$Userid );
    if ($SqlResponce->num_rows > 0) {
        $fetch = mysqli_fetch_assoc($SqlResponce);
        $OldName = $fetch['name'];
        $user_type =$fetch['user_type'];
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
    <link rel="stylesheet" href="../css/style.css"> 
 </head>

<body>
    <div class="wrapper"> 
        <?php include "AdminSideBar.php"; ?>
        <div class="main p-3">
           <div class="text-center">
               <h1> CERBERUS SHOP Admin  </h1>
           </div>
           <div id="contexshow" class="container row"> 
               <h1> users </h1>
               <div>
      <?php if(isset($message)){ echo '<div class="message">'.$message.'</div>';}?>                   
                  <form action="" method="post" enctype="multipart/form-data">
                    <input type="text" name="name" placeholder="Name" value="<?php echo $OldName; ?>" class="box" >
                     <select id="UserRole" name="UserRole"  class="form-select form-select-lg mb-3" >
                        <option  selected="" value="Admin">Admin</option>
                        <option  selected="" value="User">User</option>
                        <option  selected="" value="Anonymous">Anonymous</option>                        
                     </select>
                    <input type="submit" name="submit" value="Save" class="btn">                      
                   </form>
               </div>
           </div>
        </div>            
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>        
     <script src="../JS/sidebarJS.js"></script>
     <script type="text/javascript">
         $("#UserRole").val("<?php echo $user_type ?>")
      </script>     
</body>

</html>