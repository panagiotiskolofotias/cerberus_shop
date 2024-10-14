<?php
  require_once("../ApiClass/AppSession.php");
  require_once("../ApiClass/ConnectionDB.php");

if (isset($_POST['order_id'])) {
    $order_id = intval($_POST['order_id']);
    try{
       ConnectionDB::ExcecuteQuery("UPDATE orders SET order_status = 'Completed' WHERE order_id =". $order_id);
       echo "Order marked as completed.";
    } 
    catch (Exception $ex){
        echo "Error marking order as completed.";
    }
}
?>