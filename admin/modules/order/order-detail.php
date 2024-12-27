<?php
// thiết lập kết nối
$conn = initConnection();
$order_id = $_GET['order_id'];
$sqlAllCust = " SELECT * FROM customers INNER JOIN orders ON customers.id = orders.cust_id  WHERE orders.order_id = $order_id ";
$queryAllCust = mysqli_query($conn, $sqlAllCust);
if (mysqli_num_rows($queryAllCust) > 0) {
    $OrderDetail = mysqli_fetch_assoc($queryAllCust);
} else {
    header("location:index.php");
}



    $sqlProDetail = " SELECT * FROM products  ";
    $queryProDetail = mysqli_query($conn, $sqlProDetail);
    
?>

<div id="main" class="row">
    <span><a href="index.php?page=admin"><i class="fa-solid fa-house fa-lg"></i></a>
        <a>/</a>
        <a class="active" href="index.php?page=order">Quản lý đơn hàng</a>
        <a>/</a>
        <a class="active" href="#">Chi tiết</a></span>
</div>
<div>
    <h1>Chi tiết đơn hàng</h1>
</div>
<div id="product-head" class="row">
    <div id="product-details" class="col-lg-6 col-md-6 col-sm-12">
        <ul>
            <li><span>Mã đơn hàng :</span><?php echo $OrderDetail['order_id']; ?></li>
            <li><span>Họ và tên :</span><?php echo $OrderDetail['fullname']; ?></li>
            <li><span>Số điện thoại :</span><?php echo $OrderDetail['receiver_phone']; ?></li>
            <li><span>Email :</span><?php echo $OrderDetail['email']; ?> </li>
            <li><label>Trạng thái</label>
                <select name="status" id="status">
                    <option <?php if ($OrderDetail['status'] == 1) {
                                echo 'selected';
                            } ?> value=1>Chờ xác nhận</option>
                    <option <?php if ($OrderDetail['status'] == 2) {
                                echo 'selected';
                            } ?> value=2>Đã xác nhận</option>
                    <option <?php if ($OrderDetail['status'] == 3) {
                                echo 'selected';
                            } ?> value=3>Đang giao hàng</option>
                    <option <?php if ($OrderDetail['status'] == 4) {
                                echo 'selected';
                            } ?> value=4>Đã thanh toán</option>
                    <option <?php if ($OrderDetail['status'] == 5) {
                                echo 'selected';
                            } ?> value=5>Hủy</option>
                </select>

            </li>
        </ul>
    </div>
</div>

<div id="main" class="row">
    <table class="table" style="width:100%">
        <thread>

            <tr>
                <th>
                    <div>STT</div>
                </th>
                <th>
                    <div>Tên sản phẩm</div>
                </th>
                <th>
                    <div>Hình ảnh</div>
                </th>
                <th>
                    <div>Đơn giá</div>
                </th>
                <th>
                    <div>số lượng</div>
                </th>
                <th>
                    <div>thành tiền</div>
                </th>
            </tr>
            <?php
            $total = 0;
            if (mysqli_num_rows($queryProDetail) > 0) {
                while ($ProDetail = mysqli_fetch_assoc($queryProDetail)) {
                    $prdId = $ProDetail['prd_id'];
                    $price = $_SESSION['cart'][$prdId]['price'];
                    $qty = $_SESSION['cart'][$prdId]['qty'];
                    $subTotal = $price * $qty;
                    $total += $subTotal;
            ?>
                    <tr>
                        <td> <?php echo $ProDetail['prd_id']; ?></td>
                        <td> <?php echo $ProDetail['prd_name']; ?></td>
                        <td style="text-align: center" id="product-jpg"><img width="90" height="120" src="../img/product/<?php echo $ProDetail['prd_image']; ?> "></td>
                        <td> <?php echo number_format($ProDetail['prd_price'], 0, ',', '.'); ?>VND</td>
                        <td> <?php echo $qty; ?></td>
                        <td> <?php echo number_format($total, 0, ',', '.'); ?>đ</td>
                    </tr>
            <?php
                }
            }
            ?>
        </thread>
    </table>
</div>