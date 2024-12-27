<?php
$conn = initConnection();
$hi = $_SESSION['user_logged']['cust_id'];
if (isset($_GET['cust_id'])) {
    $cust_id = $_GET['cust_id'];
    $sqlOldCustomer = "SELECT * FROM customers WHERE cust_id = $cust_id";
    $queryOldCustomer = mysqli_query($conn,  $sqlOldCustomer);
    if (mysqli_num_rows($queryOldCustomer) > 0) {
        $customer = mysqli_fetch_assoc($queryOldCustomer);
        /**
         * Sửa thông tin
         */
        if (isset($_POST['sbm'])) {
            $cust_name = $_POST['cust_name'];
            $cust_sex = $_POST['cust_sex'];
            $cust_birth = $_POST['cust_birth'];
            $cust_address = $_POST['cust_address'];
            $sqlUpdateCustomer = "UPDATE customers SET
            cust_name =' $cust_name',
            cust_sex = '$cust_sex',
            cust_birth = '$cust_birth',
            cust_address = '$cust_address'
            WHERE cust_id = $cust_id";
            mysqli_query($conn, $sqlUpdateCustomer);
            header("location:index.php?page=file&cust_id=$hi");
        }
        } else {
        header("location:index.php?page=file&cust_id=$hi");
    }
} else {
    header("location:index.php?page=file&cust_id=$hi");
}

?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-6">
                        <form role="form" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Họ và tên</label>
                                <input type="text" name="cust_name" required class="form-control" value="<?php echo $customer['cust_name']; ?>" placeholder="">
                            </div>

                            <div class="form-group">
                                <label>Giới tính</label>
                                <select name="cust_sex" id="username">
                                    <option value="nam">Nam</option>
                                    <option value="nu">Nữ</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Ngày sinh</label>
                                <input type="text" name="cust_birth" required value="<?php echo $customer['cust_birth']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input type="text" name="cust_address" required value="<?php echo $customer['cust_address']; ?>" class="form-control">
                            </div>
                    </div>
                    <button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
                </div>
                </form>
            </div>
        </div>
    </div><!-- /.col-->
</div><!-- /.row -->

