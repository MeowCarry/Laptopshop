<?php
$conn = initConnection();
    $id = $_GET['user_id'];
    $sqlUpdateProducts = "UPDATE users SET isDeleted = 1 WHERE user_id = $id";
            mysqli_query($conn, $sqlUpdateProducts);
            header("location:index.php");
?>