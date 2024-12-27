<?php
$conn = initConnection();
    $id = $_GET['id'];
    $sqlUpdateProducts = "UPDATE products SET isDeleted = 1 WHERE prd_id = $id";
            mysqli_query($conn, $sqlUpdateProducts);
            header("location:index.php");
?>