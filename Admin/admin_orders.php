<?php
if (!isset($_SESSION)) { session_start();}
  require_once("../ApiClass/Enumerations.php");
  require_once("../ApiClass/ConnectionDB.php");  
   $UserRole = $_SESSION['UserRole'];
   if ($UserRole != UserRole::ADMIN){
         header("Location: ../Index.php");
         exit();
   }
  
   //$query = "SELECT * FROM orders ORDER BY order_date DESC";
   //$result = $conn->query($query);
   //$query = "SELECT * FROM orders ORDER BY order_date DESC";
   //$result = $conn->query($query);
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
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }

        
        .completed {
            background-color: #6aa84f;
        }

        
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover, .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
 </head>

<body>
    <div class="wrapper"> 
        <?php include "AdminSideBar.php"; ?>
        <div class="main p-3">
           <div class="text-center">
               <h1> CERBERUS SHOP Admin  </h1>
           </div>
           <div id="contexshow" class="container row"> 
           <h1>Customer Orders</h1>

<table>
    <tr>
        <th>Order ID</th>
        <th>Customer Name</th>
        <th>Email</th>
        <th>Total Amount</th>
        <th>Order Date</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    <?php
        $SqlResponce = ConnectionDB::SelectQuery("SELECT * FROM orders ORDER BY order_date DESC");
        $result="";
        if ($SqlResponce->num_rows > 0) {
            while ($row = mysqli_fetch_array($SqlResponce)) {?>

        <tr id="order-<?php echo $row['order_id']; ?>" class="<?php echo ($row['order_status'] == 'Completed') ? 'completed' : ''; ?>">
            <td><?php echo $row['order_id']; ?></td>
            <td><?php echo $row['customer_name']; ?></td>
            <td><?php echo $row['customer_email']; ?></td>
            <td>$<?php echo number_format($row['total_amount'], 2); ?></td>
            <td><?php echo $row['order_date']; ?></td>
            <td id="status-<?php echo $row['order_id']; ?>"><?php echo $row['order_status']; ?></td>
            <td>
                <button class="view-details" data-order-id="<?php echo $row['order_id']; ?>">View Details</button>
                <?php if ($row['order_status'] == 'Pending') { ?>
                    <button class="complete-order" data-order-id="<?php echo $row['order_id']; ?>">Mark as Completed</button>
                <?php } else { ?>
                    <span>Completed</span>
                <?php } ?>
            </td>
        </tr>
        <?php } } ?>          
</table>


<div id="orderModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Order Details</h2>
        <div id="orderDetailsContent">
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.complete-order').forEach(button => {
        button.onclick = function() {
            var orderId = this.getAttribute('data-order-id');

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'complete_order.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status === 200) {
                    document.getElementById('status-' + orderId).innerText = 'Completed';
                    document.getElementById('order-' + orderId).classList.add('completed');
                }
            };
            xhr.send('order_id=' + orderId);
        };
    });

    document.querySelectorAll('.view-details').forEach(button => {
        button.onclick = function() {
            var orderId = this.getAttribute('data-order-id');

            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_order_details.php?order_id=' + orderId, true);
            xhr.onload = function() {
                if (this.status === 200) {
                    document.getElementById('orderDetailsContent').innerHTML = this.responseText;
                    document.getElementById('orderModal').style.display = "block";
                }
            };
            xhr.send();
        };
    });

    var modal = document.getElementById("orderModal");
    var span = document.getElementsByClassName("close")[0];

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
           </div>
        </div>            
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>        
     <script src="../JS/sidebarJS.js"></script>
</body>

</html>