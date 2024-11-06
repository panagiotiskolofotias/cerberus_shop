<?php
require_once("ApiClass/AppSession.php");
require_once("ApiClass/ConnectionDB.php");


if (isset($_GET['action']) && $_GET['action'] == "add") {
    $id = $_GET['product_id']; 
    $quantity = $_POST['quantity'];
    $SqlResponce = ConnectionDB::SelectQuery("select  * from products WHERE product_id =".$id);
    if ($SqlResponce->num_rows > 0) {
        while ($row = mysqli_fetch_array($SqlResponce)) {
            $cartItem = array(
                'id' => $row['product_id'],
                'name' => $row['name'],
                'price' => $row['price'],
                'quantity' => $quantity
            );
        }
    }
   
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];

        
        $itemExists = false;
        foreach ($cart as &$item) {
            if ($item['id'] == $id) {
                $item['quantity'] += $quantity;
                $itemExists = true;
                break;
            }
        }

        if (!$itemExists) {
            array_push($cart, $cartItem);
        }

        $_SESSION['cart'] = $cart;
    } else {
        $_SESSION['cart'] = array($cartItem);
    }

    header('Location: cart.php');
    exit;
}


if (isset($_GET['action']) && $_GET['action'] == "remove") {
    $id = $_GET['id'];

    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $id) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }

    $_SESSION['cart'] = array_values($_SESSION['cart']);
    header('Location: cart.php');
    exit;
}


if (isset($_GET['action']) && $_GET['action'] == "clear") {
    unset($_SESSION['cart']);
    header('Location: cart.php');
    exit;
}

if (isset($_GET['action']) && $_GET['action'] == 'increase') {
    $id = $_GET['id'];

    
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $id) {
            $item['quantity'] += 1; 
            break;
        }
    }
    header('Location: cart.php');
    exit;
}


if (isset($_GET['action']) && $_GET['action'] == 'decrease') {
    $id = $_GET['id'];

    
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $id && $item['quantity'] > 1) {
            $item['quantity'] -= 1; 
            break;
        }
    }
    header('Location: cart.php');
    exit;
}


if (isset($_GET['action']) && $_GET['action'] == 'remove') {
    $id = $_GET['id'];

    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $id) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }

    $_SESSION['cart'] = array_values($_SESSION['cart']);
    header('Location: cart.php');
    exit;
}

if (isset($_GET['action']) && $_GET['action'] == 'clear') {
    unset($_SESSION['cart']);
    header('Location: cart.php');
    exit;
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
           <div id="" class=""> 
    <h1>Shopping Cart</h1>
    

    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { ?>
        <table border="1">
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            <?php 
            $total = 0;
            foreach ($_SESSION['cart'] as $item) {
                $itemTotal = $item['price'] * $item['quantity'];
                $total += $itemTotal;
            ?>
            <tr>
                <td><?php echo $item['name']; ?></td>
                <td>
                    <a href="cart.php?action=decrease&id=<?php echo $item['id']; ?>">-</a>
                    <?php echo $item['quantity']; ?>
                    <a href="cart.php?action=increase&id=<?php echo $item['id']; ?>">+</a>
                </td>
                <td><?php echo $item['price']; ?></td>
                <td><?php echo number_format($itemTotal, 2); ?></td>
                <td>
                    <a href="cart.php?action=remove&id=<?php echo $item['id']; ?>">Remove</a>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="3">Total</td>
                <td><?php echo number_format($total, 2); ?></td>
                <td><a href="cart.php?action=clear">Clear Cart</a></td>
            </tr>
        </table>

        <h2>Enter your details to complete the purchase:</h2>
        <form method="post" action="checkout.php">
            <label for="name">Name:</label>
            <input type="text" name="name" required>
            <br><br>
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <br><br>
            <input type="submit" value="Proceed to Checkout">
        </form>

    <?php } else { ?>
        <p>Your cart is empty!</p>
    <?php } ?>
    </div>
        </div>            
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>        
     <script src="JS/sidebarJS.js"></script>
</body>
</html>
