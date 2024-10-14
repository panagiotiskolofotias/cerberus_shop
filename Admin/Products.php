<?php
if (!isset($_SESSION)) { session_start();}
  require_once("../ApiClass/Enumerations.php");
  require_once("../ApiClass/ConnectionDB.php");
   $UserRole = $_SESSION['UserRole'];
   if ($UserRole != UserRole::ADMIN){
         header("Location: ../Index.php");
         exit();
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
                 <h1> Products  </h1>
             <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope=\"col\">Name</th>
                        <th scope=\"col\">description</th>  
                        <th scope=\"col\">category</th>  
                        <th scope=\"col\">Subcategory</th>
                        <th scope=\"col\">subcategory2</th>  
                        <th scope=\"col\">price</th> 
                        <th scope="col">  <button onclick="location='ProductUpd.php?Action=New'"  > new</button> </th>
                    </tr>
                </thead>
                <tbody>                
                 
           <?php       
            $sqlqury ="Select pro.product_id,pro.name,pro.description,images,pro.price,cat.name  as category ,CAT1.NAME AS Subcategory,cat2.name as subcategory2, \n";
            $sqlqury =$sqlqury."pro.category_id,pro.subcategory1_id ,pro.subcategory2_id \n";
            $sqlqury =$sqlqury."from products pro \n";
            $sqlqury =$sqlqury."INNER JOIN categories cat on cat.category_id = pro.category_id \n";
            $sqlqury =$sqlqury."LEFT JOIN sub_category1 cat1 on cat1.subcategory1_id= pro.subcategory1_id  \n";
            $sqlqury =$sqlqury."LEFT JOIN sub_category2 cat2 on cat2.subcategory2_id = pro.subcategory2_id  \n";
            $SqlResponce = ConnectionDB::SelectQuery($sqlqury);
              if ($SqlResponce->num_rows > 0) {
                while ($row = mysqli_fetch_array($SqlResponce)) {   
            ?>
  <tr> 
                      <th scope="row"><?php echo $row["product_id"] ?></th>
                      <td><?php echo $row["name"]?></td>
                      <td><?php echo $row["description"]?></td>
                      <td><?php echo $row["category"]?></td>
                      <td><?php echo $row["Subcategory"]?></td>
                      <td><?php echo $row["subcategory2"]?></td>      
                      <td><?php echo $row["price"]?></td>                           
                      <td>
                          <button  <button onclick="location='ProductUpd.php?Action=Edit&Productid=<?php echo $row["product_id"]?>'"  > Edit</button>
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
</body>

</html>