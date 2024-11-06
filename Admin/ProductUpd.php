<?php
  require_once("../ApiClass/AppSession.php");
  require_once("../ApiClass/ConnectionDB.php"); 
  $action ="";
  $Categoryid="";
  $Subcategory1id="";
  $Subcategory2id="";
  $product_id="";
   
  if(isset($_GET['Action'])){ $action = $_GET['Action']; }
  if(isset($_GET['Productid'])){ $product_id = $_GET['Productid'];}  
  if(isset($_GET['$Categoryid'])){ $Categoryid = $_GET['$Categoryid'];}    
  if(isset($_GET['Subcategory1id'])){$Subcategory1id = $_GET['Subcategory1id'];} 
  if(isset($_GET['Subcategory2id'])){$Subcategory2id = $_GET['Subcategory2id'];} 
   
if(isset($_POST['submit'])){
   $name = $_POST['name'];
   $description = $_POST['description'];
   $price = $_POST['price'];
   $Categoryid=$_POST['Category'];
   $Subcategory1id =$_POST['Subcategory1'];
   $Subcategory2id=$_POST['Subcategory2'];
   
if (isset($_FILES['images']) && $_FILES['images']['error'] == 0) {
    $image = $_FILES['images']['name'];
    $image_tmp = $_FILES['images']['tmp_name'];
   
    
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $image_extension = pathinfo($image, PATHINFO_EXTENSION);
    
    if (in_array(strtolower($image_extension), $allowed_extensions)) {
        $target_dir = "../images/";
        $upload_path = $target_dir. basename($image);
        if (move_uploaded_file($image_tmp, $upload_path)) {
            $images = "images/".basename($image);
        } else {
            $message = "Αποτυχία μεταφόρτωσης αρχείου.";
        }
    } else {
        $message = "Μη έγκυρη μορφή αρχείου.";
    }
}
   try{
      if ($action == "New"){ 
          $qury ="Insert into products(name,description,price,category_id,subcategory1_id,subcategory2_id,images) \n";
          $qury = $qury. "values('".$name."','".$description."','".$price."','".$Categoryid."','".$Subcategory1id."',";
          if ($Subcategory2id ==''){
              $qury = $qury ."null";
          }
          else{
             $qury = $qury . $Subcategory2id;
          }
          $qury = $qury . ",'".$images."')";
      }
      if ($action == "Edit"){ 
          $qury ="update products set name = '".$name."',description = '".$description."',price = '".$price;
          $qury = $qury."',category_id = '".$Categoryid."',subcategory1_id = '".$Subcategory1id."' ,subcategory2_id = '".$Subcategory2id;
          $qury = $qury."', images = '".$images ."'  where product_id = ".$product_id;
      }      
      $SqlResponce = ConnectionDB::ExcecuteQuery($qury);
      header('location:Products.php');
   }  catch (Exception $ex){
       $message = $ex->getMessage();
   }
} 

   $Oldname = "";
   $Olddescription = "";
   $Oldprice ="";
   $OldCategoryid="";
   $OldSubcategory1id ="";
   $OldSubcategory2id="";
   $Oldimages = "";

if ($action == "Edit"){
    $ProductQuery = "select product_id,name,description,price,category_id,subcategory1_id,subcategory2_id,images \n";
    $ProductQuery =$ProductQuery. "from products  \n";
    $ProductQuery =$ProductQuery. " WHERE product_id = ".$product_id;
    
    $SqlResponce = ConnectionDB::SelectQuery($ProductQuery);
    if ($SqlResponce->num_rows > 0) {
        $fetch = mysqli_fetch_assoc($SqlResponce);
        $Oldname = $fetch['name'];
        $Olddescription  =$fetch['description'];
        $Oldprice =$fetch['price'];
        $OldCategoryid=$fetch['category_id'];
        $OldSubcategory1id =$fetch['subcategory1_id'];
        $OldSubcategory2id=$fetch['subcategory2_id'];
        $Oldimages =$fetch['images'];    
    }
    else{
        echo "no rows select";
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
    <script type="text/javascript" src="../JS/GetDropListData.js"></script>   
 </head>

<body>
    <div class="wrapper"> 
        <?php include "AdminSideBar.php"; ?>
        <div class="main p-3">
           <div class="text-center">
               <h1> CERBERUS SHOP Admin  </h1>
           </div>
           <div id="contexshow" class="container row"> 
               <h1> Product <?php echo $action?> </h1>
               <?php if(isset($message)){ echo '<div class="message">'.$message.'</div>';}?>      
               <div>
                  <form action="" method="post" enctype="multipart/form-data">
                    <div>
                        <select id="Category" name="Category" class="form-select form-select-lg mb-3"
                                onclick=" ClearDropDown('Subcategory1');ClearDropDown('Subcategory2'); GetDropListData('GetSubCategory1','Subcategory1','Category');" 
                                onchange="ClearDropDown('Subcategory1');ClearDropDown('Subcategory2'); GetDropListData('GetSubCategory1','Subcategory1','Category');">
                           <option  selected="" value="-1">Ολες</option>
                        </select>
                     </div>                      
                    <div>
                         <select id="Subcategory1" name="Subcategory1" class="form-select form-select-lg mb-3"
                                 onclick="ClearDropDown('Subcategory2'); GetDropListData('GetSubCategory2','Subcategory2','Subcategory1');" 
                                 onchange="ClearDropDown('Subcategory2'); GetDropListData('GetSubCategory2','Subcategory2','Subcategory1');">                             
                          <option  selected="" value="">Ολες</option>
                        </select>
                    </div>   
                    <div>
                         <select id="Subcategory2" name="Subcategory2" class="form-select form-select-lg mb-3">
                          <option  selected="" value="">Ολες</option>
                        </select>
                    </div>                       
                    <input type="text" name="name" placeholder="name" value="<?php echo $Oldname; ?>" class="box" >
                    <input type="text" name="description" placeholder="description" value="<?php echo $Olddescription; ?>" class="box" >
                    <input type="text" name="price" placeholder="price" value="<?php echo $Oldprice; ?>" class="box" >
                    <h2>Upload an Image</h2>
                    <input type="file" name="images" id="file" />
                    <span id="uploaded_image"></span>
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
        ClearDropDown('Category');
        ClearDropDown('Subcategory1');
        ClearDropDown('Subcategory2');  
        LoadDropDound('GetCategory','Category','<?php echo $OldCategoryid ?>') 
        $("#Category").val("<?php echo $OldCategoryid ?>")
        LoadDropDound('GetSubCategory1','Subcategory1','<?php echo $OldSubcategory1id ?>');        
        $("#Subcategory1").val("<?php echo $OldSubcategory1id ?>")
        LoadDropDound('GetSubCategory2','Subcategory2','<?php echo $OldSubcategory2id ?>');    
         $("#GetSubCategory2").val("<?php echo $OldSubcategory2id ?>")
      </script>
</body>

</html>