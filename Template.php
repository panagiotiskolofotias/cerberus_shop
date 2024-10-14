<?php
  require_once("ApiClass/AppSession.php");
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
           </div>
        </div>            
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>        
     <script src="JS/sidebarJS.js"></script>
</body>

</html>