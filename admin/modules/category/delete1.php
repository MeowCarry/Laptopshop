<?php
$conn = initConnection();
    $id = $_GET['id'];
    $sqlUpdateProducts = "UPDATE categories SET isDeleted = 1 WHERE cat_id = $id";
            mysqli_query($conn, $sqlUpdateProducts);
            header("location:index.php");
?>