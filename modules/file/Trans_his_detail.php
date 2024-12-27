<?php
$conn = initConnection();

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $sqlAllCust = " SELECT * FROM customers INNER JOIN orders ON customers.cust_id = orders.cust_id  WHERE orders.order_id = $order_id ";
    $queryAllCust = mysqli_query($conn, $sqlAllCust);

    if (mysqli_num_rows($queryAllCust) > 0) {
        $OrderDetail = mysqli_fetch_assoc($queryAllCust);
        $order_id = $OrderDetail['order_id'];
    } else {
        header("location:index.php");
    }
}


if (isset($_POST['sbm'])) {
    $sqlProDetail = "UPDATE orders SET status = '5' WHERE order_id = '$order_id'";
    $queryProDetail = mysqli_query($conn, $sqlProDetail);
}

$sqlProDetail = "SELECT * FROM order_detail INNER JOIN products ON order_detail.prd_id = products.prd_id WHERE order_id = $order_id";
$queryProDetail = mysqli_query($conn, $sqlProDetail);
?>

<div>
    <h1>Chi tiết</h1>
</div>
<div id="product-head" class="row">
    <ul>
        <li><span><strong>Mã đơn hàng :</strong></span><?php echo $OrderDetail['order_id']; ?></li>
    </ul>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <ul>
            <li><span><strong>Người mua :</strong></span><?php echo $OrderDetail['fullname']; ?></li>
            <li><span><strong>Số điện thoại :</strong></span><?php echo $OrderDetail['cust_numberphone']; ?></li>
            <li><span><strong>Email :</strong></span><?php echo $OrderDetail['cust_mail']; ?> </li>
            <li><span><strong>Địa chỉ :</strong></span><?php echo $OrderDetail['cust_address']; ?> </li>
        </ul>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <ul>
            <li><span><strong>Người nhận :</strong></span><?php echo $OrderDetail['receiver_name']; ?></li>
            <li><span><strong>Số điện thoại :</strong></span><?php echo $OrderDetail['receiver_phone']; ?></li>
            <li><span><strong>Email :</strong></span><?php echo $OrderDetail['receiver_email']; ?> </li>
            <li><span><strong>Địa chỉ :</strong></span><?php echo $OrderDetail['receiver_address']; ?> </li>

        </ul>
    </div>
    <ul>
        <li><label><strong>Trạng thái</strong></label>
            <?php
            $change = $OrderDetail['status'];
            if ($change == 1) {
                echo '<span class="label label-success">Chờ xác nhận</span>';
            } else if ($change == 2) {
                echo '<span class="label label-danger">Đã xác nhận</span>';
            } else if ($change == 3) {
                echo '<span class="label label-danger">Đang giao hàng</span>';
            } else if ($change == 4) {
                echo '<span class="label label-danger">Đã thanh toán</span>';
            } else {
                echo '<span class="label label-danger">Hủy</span>';
            }
            ?>
        </li>
    </ul>
</div>
<div id="main" class="row">
    <table class="table" style="width:100%">
        <thead>

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
                    $price = $ProDetail['prd_price'];
                    $qty = $ProDetail['qty'];
                    $subTotal = $price * $qty;
                    $total += $subTotal;
            ?>
                    <tr>
                        <td> <?php echo $ProDetail['prd_id']; ?></td>
                        <td> <?php echo $ProDetail['prd_name']; ?></td>
                        <td style="text-align: center" id="product-jpg"><img width="90" height="120" src="img/product/<?php echo $ProDetail['prd_image']; ?> "></td>
                        <td> <?php echo number_format($ProDetail['prd_price'], 0, ',', '.'); ?>VND</td>
                        <td> <?php echo $ProDetail['qty']; ?></td>
                        <td> <?php echo number_format($total, 0, ',', '.'); ?>đ</td>
                    </tr>
            <?php
                }
            }
            ?>
        </thead>
    </table>
</div>

<?php
if ($change == 1) {
?>
    <form role="form" method="post">
        <div>
            <button type="submit" name="sbm" class="btn btn-primary">Hủy đơn hàng</button>

        </div>
    </form>
<?php
}
?>