<?php
$conn = initConnection();
    $id = $_GET['cust_id'];
    $sqlUpdateProducts = "UPDATE customers SET isDeleted = 1 WHERE cust_id = $id";
            mysqli_query($conn, $sqlUpdateProducts);
            header("location:index.php?page=customer");
?>