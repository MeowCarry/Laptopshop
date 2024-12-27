<?php
$conn = initConnection();
// lấy dữ liệu 
if (isset($_GET['cust_id'])) {
    $cust_id = $_GET['cust_id'];
    $sqlOldCust = "SELECT * FROM customers WHERE cust_id = '$cust_id'";
    $queryOldCust = mysqli_query($conn, $sqlOldCust);
    if (mysqli_num_rows($queryOldCust) > 0) {
        $custegory = mysqli_fetch_assoc($queryOldCust);
        // sửa custegory
        if (isset($_POST['sbm'])) {
            $cust_name = $_POST['cust_name'];
            $sqlUpdateCust = " UPDATE customers SET cust_name = '$cust_name' WHERE cust_id = $cust_id";
            mysqli_query($conn, $sqlUpdateCust);
            header("locustion:index.php?page=edit_customer&cust_id=$cust_id");
        }
    } else {
        header("locusted:index.php?page=customer");
    }
} else {
    header("locusted:index.php?page=customer");
}


?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="index.php?page=admin"><i class="fa-solid fa-house fa-lg"></i></a></li>
            <li><a>/</a></li>
            <li><a href="index.php?page=customer">Quản lý danh mục</a></li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
        <div class="form-group">
                                <label>Khách hàng</label>
                                <input type="text" name="cust_name" required class="form-control" class="<?php echo $product['cust_name']; ?>" placeholder="">
                            </div>
                            
                        
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-8">
                        <form role="form" method="post">
                            <div class="form-group">
                                <label>Tên danh mục:</label>
                                <input type="text" name="cust_name" required value="<?php echo $custegory['cust_name']; ?>" class="form-control" placeholder="Tên danh mục...">
                            </div>
                            
                            <button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                    </div>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div> <!--/.main-->