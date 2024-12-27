<?php
$conn = initConnection();

$order_id = (int) $_GET['order_id'];

$limit = 5; //Số bản ghi trên 1 trang
//lấy tổng số bản ghi của orders

$sqlFirstPart = "SELECT * FROM order_detail INNER JOIN orders ON order_detail.order_id = orders.order_id WHERE order_detail.order_id = $order_id ";
$queryFirstPart = mysqli_query($conn, $sqlFirstPart);
$ripntear = mysqli_fetch_assoc($queryFirstPart);

$totalRecord = mysqli_num_rows($queryFirstPart); //Tổng số bản ghi trong total orders   
$totalPage = ceil($totalRecord / $limit); // Tổng số trang
//Lấy trang hiện tại
if (isset($_GET['current_page'])) {
    $current_page = $_GET['current_page'];
} else {
    $current_page = 1;
}
//Đặt limit cho chuyển trang:
if ($current_page < 1) {
    $current_page = 1;
}
if ($current_page > $totalPage && $totalPage > 1) {
    $current_page = $totalPage;
}
//Tìm biến $start
$start = ($current_page - 1) * $limit;

$sqlALLorders = "SELECT * FROM order_detail INNER JOIN products ON order_detail.prd_id = products.prd_id WHERE order_id = $order_id LIMIT $start,$limit";
$queryALLorders = mysqli_query($conn, $sqlALLorders);

if (isset($_POST['sbm'])) {
    $lary = $_POST['status'];
    $sqlFixyPixy = "UPDATE orders SET status = '$lary' WHERE order_id = $order_id";
    $queryFixyPixy = mysqli_query($conn, $sqlFixyPixy);
    header("location:index.php?page=order");
}

?>


<div class="col-10" id="col2" style="overflow-x: hidden;">
    <div>
        <ul class="breadcrumb">
            <li><a class="fa-solid fa-house fa-sm house" name="home" style="color: #2868d7;" href="#"></a></li>
            <li><a class="crumbs" href="index.php?page=product">Orders</a></li>
        </ul>
        <div class="container fadeload">
            <h1 style="text-align: center;">ORDERS</h1>
            <div id="adder">
                <h3 style="color: white;">Order details</h3>
            </div>
            <div id="addercontent">
                <div class="row">
                    <div>
                        <div class="levitate">Order ID:&nbsp; <?php echo $ripntear['order_id'] ?></div>
                        <div class="levitate">Receiver name:&nbsp; <?php echo $ripntear['receiver_name'] ?></div>
                        <div class="levitate">Phone address:&nbsp; <?php echo $ripntear['receiver_address'] ?> </div>
                        <div class="levitate">Phone number:&nbsp; <?php echo $ripntear['receiver_phone'] ?> </div>
                        <div class="levitate">Email:&nbsp; <?php echo $ripntear['receiver_email'] ?> </div>
                        <form role="form" method="post" style="margin-top: 10px;">
                            <div class="row">
                                <div class="col-1">
                                    <div class="levitate">Status:</div>
                                </div>
                                <div class="col-8">
                                    <div class="form-group">
                                        <select name="status" class="form-select" aria-label="Default select example" style="width: 300px;">
                                            <?php
                                            $extra = $ripntear['status'];
                                            ?>
                                          
                                            <option value="1" <?php if($extra == 1) {echo "selected";} ?>>Pending</option>
                                            <option value="2" <?php if($extra == 2) {echo "selected";} ?>>Accepted</option>
                                            <option value="3" <?php if($extra == 3) {echo "selected";} ?>>Delivering</option>
                                            <option value="4" <?php if($extra == 4) {echo "selected";} ?>>Paid</option>
                                            <option value="0" <?php if($extra == 0) {echo "selected";} ?>>Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <button type="submit" class="btn btn-primary button-61" name="sbm">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

                <table class="table" style="color: black;">
                    <thead>
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Product name</th>
                            <th scope="col">Picture</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $moni = 0;
                        if (mysqli_num_rows($queryALLorders) > 0) {
                            while ($row = mysqli_fetch_assoc($queryALLorders)) {
                                $temp = (int) $row['order_id'];
                                $ting = (int) $row['prd_id'];
                        ?>
                                <tr>
                                    <th scope="row" style="color: rgb(26, 192, 247);"><?php echo $row['order_id'] ?></th>
                                    <td style="color: rgb(26, 192, 247);"><?php echo $row['prd_name'] ?></td>
                                

                                    <td><img style="height:200px;" src="../images/prd_img/<?php echo $row['prd_image'] ?>"></td>


                                    <td style="color: rgb(26, 192, 247);"><?php echo $row['prd_price'] ?>$</td>
                                    <td style="color: rgb(26, 192, 247);"><?php echo $row['prd_qty'] ?></td>
                                    <?php
                                    $money = $row['prd_price'] * $row['prd_qty'];
                                    $moni += $money;
                                    ?>
                                    <td style="color: rgb(26, 192, 247);"><?php echo $money ?>$</td>

                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <table class="table table-dark daTable shadow" style="color: white;">
                    <tbody>
                        <tr>
                            <td style="font-size: 20px;">Total:</td>
                            <td style="font-size: 20px;"><?php echo $moni ?>$</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center pagination-lg" style="text-align: center;">
                        <?php
                        if ($current_page > 1) {
                        ?>
                            <li class="page-item"><a class="page-link" href="index.php?page=order_detail&current_page=<?php echo $current_page - 1 ?>">&laquo;</a></li>
                        <?php
                        }
                        ?>
                        <!-- In số trang -->
                        <?php
                        for ($i = 1; $i <= $totalPage; $i++) {
                        ?>
                            <li class="page-item <?php if ($i == $current_page) {
                                                        echo 'active';
                                                    } ?>"><a class="page-link" href="index.php?page=order_detail&current_page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php
                        }
                        ?>
                        <?php
                        if ($current_page < $totalPage) {
                        ?>
                            <li class="page-item"><a class="page-link" href="index.php?page=order_detail&current_page=<?php echo $current_page + 1 ?>">&raquo;</a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </nav>
            </div>


        </div>

    </div>
</div>