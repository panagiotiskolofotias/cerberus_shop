<?php
  require_once("ApiClass/AppSession.php");
  require_once("ApiClass/ConnectionDB.php");
  
  $Categoryid ="";
  $SubCcategory1id="";
  if(isset($_GET['Categoryid'])){
    $Categoryid = $_GET['Categoryid'];
  }  
  if(isset($_GET['SubCcategory1id'])){
    $SubCcategory1id = $_GET['SubCcategory1id'];
  }  

  $total_items_in_cart = 0;
  
  if (isset($_SESSION['cart'])) {
      foreach ($_SESSION['cart'] as $item) {
          $total_items_in_cart += $item['quantity'];
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
    <style>
                
                .cart-button {
                    background-color: #ddbf3b;
                    color: white;
                    border: none;
                    padding: 10px 20px;
                    border-radius: 5px;
                    text-decoration: none;
                    font-size: 16px;
                    position: relative;
                }

                
                .cart-count {
                    background-color: red;
                    color: white;
                    border-radius: 50%;
                    padding: 5px 10px;
                    position: absolute;
                    top: -10px;
                    right: -10px;
                    font-size: 12px;
                }
        </style>
</head>

<body>
    <div class="wrapper"> 
        <?php include "SideBar.php"; ?>
        <div class="main p-3">
           <div class="text-center">
               <h1> CERBERUS SHOP </h1>
               <div style="text-align: right; margin: 20px;">
                  <a href="cart.php" class="cart-button">
                    <i class="lni lni-cart-full"></i> Cart
                        <?php if ($total_items_in_cart > 0) { ?>
                        <span class="cart-count"><?php echo $total_items_in_cart; ?></span>
                    <?php } ?>
                  </a>
                </div>
           </div>
           <div id="contexshow" class="container row"> 
               
              <?php   
                $sqlqury ="Select pro.product_id,pro.name,pro.description,images,pro.price,cat.name as category ,CAT1.NAME AS Subcategory,cat2.name as subcategory2 \n";
                $sqlqury = $sqlqury ."from products pro \n";
                $sqlqury = $sqlqury ."INNER JOIN categories cat on cat.category_id = pro.category_id \n";
                $sqlqury = $sqlqury ."LEFT JOIN sub_category1 cat1 on cat1.subcategory1_id= pro.subcategory1_id  \n";
                $sqlqury = $sqlqury ."LEFT JOIN sub_category2 cat2 on cat2.subcategory2_id = pro.subcategory2_id  \n";
                $sqlqury = $sqlqury ."where pro.category_id =".$Categoryid;
                if ($SubCcategory1id !=""){
                     $sqlqury = $sqlqury ." and  pro.subcategory1_id =".$SubCcategory1id;
                }
                 $SqlResponce = ConnectionDB::SelectQuery($sqlqury);
                  if ($SqlResponce->num_rows > 0) {
                    while ($row = mysqli_fetch_array($SqlResponce)) {
                    ?>
                    <div class="card" style="width: 18rem;">
                      <img src="<?php echo $row["images"]?>" class="card-img-top">
                          <div class="card-body">
                          <h5 class="card-title"><?php echo $row["name"]?></h5>
                          <h6 class="card-title"><?php echo $row["price"]?>€</h6>
                          <p class="card-text"><?php echo $row["description"]?></p>
                          <form method="post" action="cart.php?action=add&product_id=<?php echo $row['product_id']; ?>" >
                            <input type="number" name="quantity" value="1" min="1">
                            <input type="submit" value="Add to Cart">
                          </form>
                       </div>
                     </div>
                  <?php } }?>       
           </div>
        </div>            
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>        
     <script src="JS/sidebarJS.js"></script>
</body>

</html>