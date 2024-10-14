<?php
if (!isset($_SESSION)) { session_start();}
  require_once("../ApiClass/Enumerations.php");
  require_once("../ApiClass/ConnectionDB.php"); 
   $UserRole = $_SESSION['UserRole'];
   if ($UserRole != UserRole::ADMIN){
         header("Location: ../Index.php");
         exit();
   }
     
   $conn= ConnectionDB::MyConn();
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }
   
   if(isset($_POST['submit'])){
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $image = $_FILES['photo']['name'];
        $image_tmp = $_FILES['photo']['tmp_name'];
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $image_extension = pathinfo($image, PATHINFO_EXTENSION);
        $target_dir = "../images/";
        if (in_array(strtolower($image_extension), $allowed_extensions)) {
            $upload_path = $target_dir. basename($image);
            if (move_uploaded_file($image_tmp, $upload_path)) {
                $fullimage = "images/".basename($image);
                $sql = "INSERT INTO advertisements (photo_name, photo_path) VALUES ('$image', '$fullimage')";
                if ($conn->query($sql) === TRUE) {
                    echo "The file " . htmlspecialchars($image) . " has been uploaded.";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                $message = "Αποτυχία μεταφόρτωσης αρχείου.";
            }
        } else {
            $message = "Μη έγκυρη μορφή αρχείου.";
        }
     }
    }
   $conn->close();
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
           <h2>Upload Photo in slider</h2>
           <form action="" method="post" enctype="multipart/form-data">
                Select image to upload:
                <input type="file" name="photo" id="photo">
                <input type="submit" value="Upload Image" name="submit">
            </form>
           </div>
        </div>            
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>        
     <script src="../JS/sidebarJS.js"></script>
</body>

</html>