<?php
  require_once("../ApiClass/AppSession.php");
  require_once("../ApiClass/ConnectionDB.php"); 

if (isset($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']);
    $SqlResponce = ConnectionDB::SelectQuery("SELECT * FROM order_items WHERE order_id =".$order_id);
    if ($SqlResponce->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>Product ID</th><th>Product Name</th><th>Quantity</th><th>Price</th><th>Total</th></tr>';
        while ($item  = mysqli_fetch_array($SqlResponce)) {
            echo '<tr>';
            echo '<td>' . $item['product_id'] . '</td>';
            echo '<td>' . $item['product_name'] . '</td>';
            echo '<td>' . $item['quantity'] . '</td>';
            echo '<td>$' . number_format($item['price'], 2) . '</td>';
            echo '<td>$' . number_format($item['total'], 2) . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'No order details found.';
    }
}
?>