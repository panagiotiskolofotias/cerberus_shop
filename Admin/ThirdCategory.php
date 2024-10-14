<?php
if (!isset($_SESSION)) { session_start();}
  require_once("../ApiClass/Enumerations.php");
  require_once("../ApiClass/ConnectionDB.php");
   $UserRole = $_SESSION['UserRole'];
   if ($UserRole != UserRole::ADMIN){
         header("Location: ../Index.php");
         exit();
   }
  $Categoryid ="-1";
  $Subcategory1id="-1";
 if(isset($_GET['Categoryid'])){
    $Categoryid = $_GET['Categoryid'];
 }
 if(isset($_GET['Subcategory1id'])){
    $Subcategory1id = $_GET['Subcategory1id'];
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
                <h1> Κατηγορίες 3 </h1>
                <div class="row col-3">     
                    <label for="Category">Choose a Category:</label>
                    <select id="Category" class="form-select form-select-lg mb-3" onChange="window.document.location.href='ThirdCategory.php?Categoryid='+this.options[this.selectedIndex].value;">
                      <option  selected="" value="-1">Ολες</option>
                       <?php 
                            $CategoryResponce = ConnectionDB::SelectQuery("Select category_id ,name from categories" );
                            if ($CategoryResponce->num_rows > 0) {
                                foreach($CategoryResponce as $Catrow):
                                    echo '<option '.$select.' value="'.$Catrow["category_id"].'" >'.$Catrow["name"] .'</option>'; 
                            endforeach; 
                            }
                        ?>
                    </select> 
                </div>
          <div class="row col-3">     
                    <label for="Subcategory1">Choose a Category2:</label>
                    <select id="Subcategory1" class="form-select form-select-lg mb-3" onChange="window.document.location.href='ThirdCategory.php?Categoryid=<?php echo $Categoryid;?>&Subcategory1id='+this.options[this.selectedIndex].value;">
                      <option  selected="" value="-1">Ολες</option>
                       <?php 
                           $subquery ="Select subcategory1_id ,category_id ,name from sub_category1";
                           IF ($Categoryid !=" "  ){
                                $subquery=  $subquery." WHERE category_id = ".$Categoryid ;
                           }
                            $SubCategoryResponce = ConnectionDB::SelectQuery($subquery );
                            if ($SubCategoryResponce->num_rows > 0) {
                                foreach($SubCategoryResponce as $SubCatrow):
                                    echo '<option '.$select.' value="'.$SubCatrow["subcategory1_id"].'" >'.$SubCatrow["name"] .'</option>'; 
                            endforeach; 
                            }
                        ?>
                    </select> 
                </div>      
                
                <table class=\"table table-bordered\">
                    <thead class=\"thead-dark\">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Κατηγορία 2 </th>
                            <th scope="col">Κατηγορία</th>
                            <th scope="col">  <button onclick="location='ThirdCategoryUpd.php?Action=New'"  > new</button> </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                       $query="select cat.category_id, cat1.subcategory1_id,cat2.subcategory2_id,cat2.name as name,cat1.name as cat1_name ,cat.name as cat_name \n";
                       $query=  $query."from categories cat \n";
                       $query=  $query."INNER JOIN sub_category1 cat1 on cat.category_id = cat1.category_id \n";
                       $query=  $query."INNER JOIN sub_category2 cat2 on cat2.subcategory1_id = cat1.subcategory1_id \n";
                       IF ($Categoryid !="-1"  ){
                           $query=  $query."WHERE cat.category_id = ".$Categoryid ;
                       }
                         IF ($Categoryid !="-1" && $Subcategory1id !="-1"){
                             
                            $query=  $query." and cat1.subcategory1_id = ".$Subcategory1id ;
                         }
                        $SqlResponce = ConnectionDB::SelectQuery($query);
                        $result="";
                        if ($SqlResponce->num_rows > 0) {
                           while ($row = mysqli_fetch_array($SqlResponce)) {
                    ?>           
                        <tr> 
                           <th scope="row"><?php echo $row["subcategory1_id"] ?></th>
                           <td><?php echo $row["name"] ?></td>
                           <td><?php echo $row["cat_name"] ?></td>
                           <td>
                               <button  <button onclick="location='ThirdCategoryUpd.php?Action=Edit&Subcategory1id=<?php echo $row["subcategory1_id"];?>+&Subcategory2id=<?php echo $row["subcategory2_id"];?>'"> Edit</button>
                           </td>
                           
                        </tr> 
                    <?php } } ?>          
                    </tbody>
                 </table>
           </div>
        </div>            
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>        
     <script src="../JS/sidebarJS.js"></script>
     <script type="text/javascript">
         $("#Category").val("<?php echo $Categoryid ?>")
         $("#Subcategory1").val("<?php echo $Subcategory1id ?>")
      </script>
     
</body>

</html>