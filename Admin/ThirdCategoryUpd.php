<?php
  require_once("../ApiClass/AppSession.php");
  require_once("../ApiClass/ConnectionDB.php"); 
  $action ="";
  $Subcategory1id="";
  $Subcategory2id="";
  if(isset($_GET['Action'])){
     $action = $_GET['Action'];
  }
   if(isset($_GET['Subcategory1id'])){
    $Subcategory1id = $_GET['Subcategory1id'];
  } 
  if(isset($_GET['Subcategory2id'])){
    $Subcategory2id = $_GET['Subcategory2id'];
  } 
   
if(isset($_POST['submit'])){
   $name = $_POST['name'];
   $Subcategory1id =$_POST['Subcategory1'];
   try{
      if ($action == "New"){ 
          $qury ="Insert into sub_category2(name ,subcategory1_id) values('".$name."','".$Subcategory1id."')";
      }
      if ($action == "Edit"){ 
          $qury ="update sub_category2 set name = '".$name."',subcategory1_id = '".$Subcategory1id."' where subcategory2_id = ".$Subcategory2id;
      }      
      $SqlResponce = ConnectionDB::ExcecuteQuery($qury);
      header('location:ThirdCategory.php');
   }  catch (Exception $ex){
       $message = $ex->getMessage();
   }
   header('location:ThirdCategory.php');
} 
$OldName ="";
$OldSubcategory1id="";
if ($action == "Edit"){

    $SqlResponce = ConnectionDB::SelectQuery("SELECT subcategory1_id ,name FROM sub_category2 WHERE subcategory2_id = ".$Subcategory2id );
    if ($SqlResponce->num_rows > 0) {
        $fetch = mysqli_fetch_assoc($SqlResponce);
        $OldName = $fetch['name'];
        $OldSubcategory1id  =$fetch['subcategory1_id'];
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
               <h1> catategory 2 <?php echo $action?> </h1>
               <div>
      <?php if(isset($message)){ echo '<div class="message">'.$message.'</div>';}?>                   
                  <form action="" method="post" enctype="multipart/form-data">
                    <input type="text" name="name" placeholder="Κατηγορία" value="<?php echo $OldName; ?>" class="box" >
                    <div class="row col-3">     
                        <select id="Subcategory1" name="Subcategory1" class="form-select form-select-lg mb-3">
                        <?php 
                             $Subcategory1Responce = ConnectionDB::SelectQuery("Select subcategory1_id ,category_id ,name from sub_category1" );
                             if ($Subcategory1Responce->num_rows > 0) {
                                 foreach($Subcategory1Responce as $Subcatrow):
                                     echo '<option '.$select.' value="'.$Subcatrow["subcategory1_id"].'" >'.$Subcatrow["name"] .'</option>'; 
                             endforeach; 
                             }
                         ?>
                     </select> 
                    </div>                    
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
         $("#Subcategory1").val("<?php echo $OldSubcategory1id ?>")
      </script>
          
</body>

</html>