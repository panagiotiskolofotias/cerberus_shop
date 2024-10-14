<?php
require_once("ApiClass/AppSession.php");
require_once("ApiClass/ConnectionDB.php");

if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {

   
    $customer_name = $_POST['name'];
    $customer_email = $_POST['email'];

    
    $total_amount = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total_amount += $item['price'] * $item['quantity'];
    }

    $conn= ConnectionDB::MyConn();
    $stmt = $conn->prepare("INSERT INTO orders (customer_name, customer_email, total_amount) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $customer_name, $customer_email, $total_amount);
    $stmt->execute();
    $order_id = $stmt->insert_id; 
    $stmt->close();

    
    foreach ($_SESSION['cart'] as $item) {
        $conn= ConnectionDB::MyConn();
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, quantity, price, total) VALUES (?, ?, ?, ?, ?, ?)");
        $item_total = $item['price'] * $item['quantity'];
        $stmt->bind_param("iisidd", $order_id, $item['id'], $item['name'], $item['quantity'], $item['price'], $item_total);
        $stmt->execute();
        $stmt->close();
    }

    
    unset($_SESSION['cart']);

    echo "<h1>Thank you for your purchase!</h1>";
    echo "<p>Your order has been successfully placed.</p>";
    echo "<a href='index.php'>Go back to the store</a>";

} else {
    echo "<p>Your cart is empty.</p>";
}
?>