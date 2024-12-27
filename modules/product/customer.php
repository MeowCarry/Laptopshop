<?php
if (isset($_GET['id'])) {
    $conn = initConnection();
    $cust_id = $_GET['id'];
    $sqlCust = "SELECT * FROM customers WHERE id = $cust_id";
    $queryCust = mysqli_query($conn, $sqlCust);
    if (mysqli_num_rows($queryCust) > 0) {
        $customer = mysqli_fetch_assoc($queryCust);
    } else {
        header("location:index.php");
    }
} else {
    header("location:index.php");
}
?>

<ul>
                <li><span>Họ tên</span><?php echo $customer['username']; ?></li>
                <li><span>Đi kèm:</span><?php echo $customer['email']; ?></li>
                <li><span>Tình trạng:</span><?php echo $customer['password']; ?></li>
                <li><span>Khuyến Mại:</span><?php echo $customer['fullname']; ?> </li>
            </ul>