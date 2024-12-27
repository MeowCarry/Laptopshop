<?php 
    //kết nối csdl
    $conn = initConnection();
    /**
     * LẤY DỮ LIỆU CŨ
     */

    if(isset($_GET['id'])) {
        $prd_id = $_GET['id'];
        $sqlOldProduct = "SELECT * FROM products WHERE prd_id = $prd_id";
        $queryOldProduct = mysqli_query($conn, $sqlOldProduct);
        if(mysqli_num_rows($queryOldProduct) > 0) {
            $product = mysqli_fetch_assoc($queryOldProduct);
            /**
             * SỬA THÔNG TIN
             */
            if(isset($_POST['sbm'])) {
                $prd_name = $_POST['prd_name'];
                $prd_price = $_POST['prd_price'];
                $prd_warranty = $_POST['prd_warranty'];
                $prd_accessories = $_POST['prd_accessories'];
                $prd_promotion = $_POST['prd_promotion'];
                $prd_new = $_POST['prd_new'];
                $cat_id = $_POST['cat_id'];
                $prd_status = $_POST['prd_status'];
                $prd_details = $_POST['prd_details'];
                if(isset($_POST['prd_featured'])) {
                        $prd_featured = 1;
                }else{
                        $prd_featured = 0;
                }

                if(isset($_FILES['prd_image']['name'])) {
                    $file_name = $_FILES['prd_image']['name'];
                    $file_tmp_name = $_FILES['prd_image']['tmp_name'];
                    move_uploaded_file($file_tmp_name, '../../../upload/product/'.$file_name);
                }else{
                    $file_name = $product['prd_image'];
                }
                $sqlUpdateProduct = "UPDATE product SET 
                                    prd_name = '$prd_name',
                                    prd_price = '$prd_price',
                                    prd_warranty = '$prd_warranty',
                                    prd_accessories = '$prd_accessories',
                                    prd_promotion = '$prd_promotion',
                                    prd_new = '$prd_new',
                                    cat_id = '$cat_id',
                                    prd_status = '$prd_status',
                                    prd_desc = '$prd_details',
                                    prd_featured = '$prd_featured',
                                    prd_image = '$file_name' WHERE prd_id = $prd_id";
                mysqli_query($conn, $sqlUpdateProduct);
                header("location:index.php?page=edit_product&id=$prd_id");
            }
            
        }else{
            header("location:index.php?page=product");
        }
    }else{
        header("location:index.php?page=product");
    }
    


?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="">Quản lý sản phẩm</a></li>
            <li class="active"><?php echo $product['prd_name']; ?></li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Sản phẩm: <?php echo $product['prd_name']; ?></h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-6">
                        <form role="form" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text" name="prd_name" required class="form-control" value="<?php echo $product['prd_name']; ?>" placeholder="">
                            </div>

                            <div class="form-group">
                                <label>Giá sản phẩm</label>
                                <input type="number" name="prd_price" required value="<?php echo $product['prd_price']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Bảo hành</label>
                                <input type="text" name="prd_warranty" required value="<?php echo $product['prd_warranty']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Phụ kiện</label>
                                <input type="text" name="prd_accessories" required value="<?php echo $product['prd_accessories']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Khuyến mãi</label>
                                <input type="text" name="prd_promotion" required value="<?php echo $product['prd_promotion']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Tình trạng</label>
                                <input type="text" name="prd_new" required value="<?php echo $product['prd_new']; ?>" type="text" class="form-control">
                            </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ảnh sản phẩm</label>
                            <input type="file" name="prd_image" onchange="preview();">
                            <br>
                            <div>
                                <img src="../upload/product/<?php echo $product['prd_image']; ?>" id="prd_image" width="150" height="200">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Danh mục</label>
                            <?php 
                                $sqlCategories = "SELECT * FROM categories ORDER BY cat_id";
                                $queryCategories = mysqli_query($conn, $sqlCategories);
                            ?>
                            <select name="cat_id" class="form-control">
                                <?php 
                                    while($row = mysqli_fetch_assoc($queryCategories)) {
                                ?>
                                    <option  <?php 
                                            if($row['cat_id'] == $product['cat_id']) {
                                                echo "selected";
                                            }
                                        ?>  value="<?php echo $row['cat_id']; ?>"> <?php echo $row['cat_name']; ?></option>
                                <?php      
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select name="prd_status" class="form-control">
                                <option <?php if($product['prd_status'] == 1) {echo 'selected'; } ?>  value=1>Còn hàng</option>
                                <option <?php if($product['prd_status'] == 0) {echo 'selected'; } ?> value=0>Hết hàng</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Sản phẩm nổi bật</label>
                            <div class="checkbox">
                                <label>
                                    <input name="prd_featured" <?php if($product['prd_featured'] == 1) {echo 'checked'; } ?> type="checkbox" value=1>Nổi bật
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mô tả sản phẩm</label>
                            <textarea name="prd_details" required class="form-control" rows="3"><?php echo $product['prd_desc']; ?></textarea>
                        </div>
                        <button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>
                    </div>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->
</div> <!--/.main-->

<script>
    function preview() {
        prd_image.src=URL.createObjectURL(event.target.files[0]);
    }
</script>