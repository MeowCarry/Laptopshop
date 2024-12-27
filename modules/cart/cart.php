<?php 
$conn = initConnection();
$listId = "";
if(isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $prdId => $value) {
        $listId .="$prdId,"; //1,2,3,
    }
    $listId = rtrim($listId,","); //1,2,3
    $listId = "(".$listId.")"; // (1,2,3)
    //SELECT * FROM product WHERE prd_id IN (1,2,3)
    $sqlCartPrd = "SELECT * FROM products WHERE prd_id IN $listId";
    $queryCartPrd = mysqli_query($conn, $sqlCartPrd);
?>


<!--	Cart	-->
<div id="my-cart">
    <div class="row">
        <div class="cart-nav-item col-lg-7 col-md-7 col-sm-12">Thông tin sản phẩm</div>
        <div class="cart-nav-item col-lg-2 col-md-2 col-sm-12">Tùy chọn</div>
        <div class="cart-nav-item col-lg-3 col-md-3 col-sm-12">Giá</div>
    </div>
    <form method="post" action="index.php?page=process-cart&a=update">
        <?php 
        $total = 0;
        if(mysqli_num_rows($queryCartPrd) > 0) {
            while($cart = mysqli_fetch_assoc($queryCartPrd)) {
                $prdId = $cart['prd_id'];
                /*
                    $_SESSION['cart'] = [
                        1 => [
                                'price' => 1000,
                                'qty' => 1
                             ],
                        2 => [
                                'price' => 2000,
                                'qty' => 3
                             ]
                    ]
                */
                $price = $_SESSION['cart'][$prdId]['price']; //Đơn giá sản phẩm lưu trong giỏ hàng
                $qty  =  $_SESSION['cart'][$prdId]['qty']; //Số lượng của từng sản phẩm trong giỏ hàng
                $subTotal = $price * $qty; //giá của từng sản phẩm theo số lượng mua
                $total += $subTotal; //tổng giá trị đơn hàng

        ?>
            <div class="cart-item row">
                <div class="cart-thumb col-lg-7 col-md-7 col-sm-12">
                    <img src="upload/product/<?php echo $cart['prd_image']; ?>">
                    <h4><?php echo $cart['prd_name']; ?></h4>
                </div>

                <div class="cart-quantity col-lg-2 col-md-2 col-sm-12">
                    <input type="number" id="quantity" name="quantity[<?php echo $prdId; ?>]" class="form-control form-blue quantity" 
                        value="<?php echo $qty; ?>" min="1">
                </div>
                <div class="cart-price col-lg-3 col-md-3 col-sm-12"><b>
                    <?php echo number_format($subTotal,0,',','.'); ?>đ</b>
                    <a href="index.php?page=process-cart&a=delete&prd_id=<?php echo $prdId; ?>"><i class="fa-solid fa-circle-xmark"></i></a></div>
            </div>
        <?php
            }
        }else{
            echo "Không có sản phẩm nào trong giỏ hàng!";
        }
        ?>
        

        <div class="row">
            <div class="cart-thumb col-lg-7 col-md-7 col-sm-12">
                <button id="update-cart" class="btn btn-success" type="submit" name="sbm">Cập nhật
                    giỏ hàng</button>
            </div>
            <div class="cart-total col-lg-2 col-md-2 col-sm-12"><b>Tổng cộng:</b></div>
            <div class="cart-price col-lg-3 col-md-3 col-sm-12"><b><?php echo number_format($total,0,',','.'); ?>đ</b></div>
        </div>
    </form>

</div>
<!--	End Cart	-->

<!--	Customer Info	-->
<div id="customer">
    <form method="post" action="index.php?page=process-cart&a=checkout">
        <div class="row">
            <div id="customer-name" class="col-lg-4 col-md-4 col-sm-12">
                <input placeholder="Họ và tên (bắt buộc)" type="text" name="name" class="form-control" required>
            </div>
            <div id="customer-phone" class="col-lg-4 col-md-4 col-sm-12">
                <input placeholder="Số điện thoại (bắt buộc)" type="text" name="phone" class="form-control" required>
            </div>
            <div id="customer-mail" class="col-lg-4 col-md-4 col-sm-12">
                <input placeholder="Email (bắt buộc)" type="text" name="mail" class="form-control" required>
            </div>
            <div id="customer-add" class="col-lg-12 col-md-12 col-sm-12">
                <input placeholder="Địa chỉ nhà riêng hoặc cơ quan (bắt buộc)" type="text" name="add" class="form-control" required>
            </div>
        </div>
    
        <div class="row">
            <div class="by-now col-lg-6 col-md-6 col-sm-12">
                <button class="btn btn-danger" type="submit">
                    <b>Mua ngay</b>
                    <span>Giao hàng tận nơi siêu tốc</span>
                </button>
            </div>
            <div class="by-now col-lg-6 col-md-6 col-sm-12">
                <button class="btn btn-primary btn-sm">
                    <b>Trả góp Online</b>
                    <span>Vui lòng call (+84) 0968600145</span>
                </button>
            </div>
        </div>
    </form>
</div>
<!--	End Customer Info	-->

<?php
    }else{
        echo "<h1>Không có sản phẩm nào trong giỏ hàng!</h1>";
    }
?>