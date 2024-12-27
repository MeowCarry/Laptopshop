<?php
        if (isset($_GET['cust_id'])) {
            $conn = initConnection();
            $cust_id = $_GET['cust_id'];
            $sqlCustDetail = "SELECT * FROM customers WHERE cust_id = $cust_id";
            $queryCustDetail = mysqli_query($conn, $sqlCustDetail);
            if (mysqli_num_rows($queryCustDetail) > 0) {
                $customer = mysqli_fetch_assoc($queryCustDetail);
            } else {
                header("location:index.php");
            }
        } else {
            header("location:index.php");
        }

        ?>
    <div id="product-head" class="row">
        <div id="product-details" class="col-lg-6 col-md-6 col-sm-12">
            <h1>Tài khoản người dùng</h1>
            <ul>
                <li><span>Tên :</span><?php echo $customer['cust_name']; ?></li>
                <li><span>Tên đầy đủ :</span><?php echo $customer['fullname']; ?></li>
                <li><span>Email :</span><?php echo $customer['email']; ?></li>
            </ul>
        </div>
    </div>