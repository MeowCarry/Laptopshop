<?php
$conn = initConnection();
if (isset($_GET['cat_id'])) {
    $cat_id = $_GET['cat_id'];
    //Lấy thông tin danh mục
    $sqlCat = "SELECT *  FROM categories WHERE cat_id = $cat_id";
    $queryCat = mysqli_query($conn, $sqlCat);
    $resultCat = mysqli_fetch_assoc($queryCat);
    $cat_name = $resultCat['cat_name'];
    //Lấy sản phẩm có phân trang
    $limit = 5;
    $sqlCatPrdTotal = "SELECT * FROM products WHERE cat_id = $cat_id";
    $queryCatPrdTotal = mysqli_query($conn, $sqlCatPrdTotal);
    $totalRecords = mysqli_num_rows($queryCatPrdTotal); //số bản ghi có cat_id = $cat_id
    $totalPage = ceil($totalRecords / $limit); //Tổng số trang
    if (isset($_GET['p'])) { //p là tham số phân trang trên đường dẫn
        $p = $_GET['p'];
    } else {
        $p = 1;
    }

    if ($p < 1) {
        $p = 1;
    }

    if ($p > $totalPage && $totalPage > 1) {
        $p = $totalPage;
    }
    $start = ($p - 1) * $limit;
    $sqlCatPro = "SELECT * FROM products WHERE cat_id = $cat_id LIMIT $start, $limit";
    $queryCatPro = mysqli_query($conn, $sqlCatPro);
    $numberOfProd = mysqli_num_rows($queryCatPro);
} else {
    header("location:index.php");
}
?>
<!--	List Product	-->
<div class="products">
    <?php
    if ($numberOfProd > 0) {
    ?>
        <h3><?php echo $cat_name; ?> (hiện có <?php echo $numberOfProd; ?> sản phẩm)</h3>
        <div class="product-list row">
            <?php 
                while($prd = mysqli_fetch_assoc($queryCatPro)) {
            ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mx-product">
                    <div class="product-item card text-center">
                        <a href="index.php?page=product-detail&prd_id=<?php echo $prd['prd_id']; ?>">
                            <img src="upload/product/<?php echo $prd['prd_image']; ?>">
                        </a>
                        <h4>
                            <a href="index.php?page=product-detail&prd_id=<?php echo $prd['prd_id']; ?>">
                                <?php echo $prd['prd_name']; ?>
                            </a>
                        </h4>
                        <p>Giá Bán: <span><?php echo number_format($prd['prd_price'],0,',','.'); ?>đ</span></p>
                    </div>
                </div>
            <?php
                }
            ?>
        </div>
</div>
<!--	End List Product	-->

<div id="pagination">
    <ul class="pagination">
        <!-- Trang trước -->
        <?php 
            if($p > 1) {
                $prev = $p - 1;
        ?>
            <li class="page-item">
                <a class="page-link" href="index.php?page=category-product&cat_id=<?php echo $cat_id?>&p=<?php echo $prev?>">Trang trước</a>
            </li>
        <?php
            }
        ?>
        <!-- Các trang giữa -->
        <?php 
            for($i = 1; $i <= $totalPage; $i++) {
        ?>
                <li class="page-item <?php if($i == $p) { echo ' active';} ?>">
                    <a class="page-link" href="index.php?page=category-product&cat_id=<?php echo $cat_id ?>&p=<?php echo $i; ?>">
                        <?php echo $i; ?>
                    </a>
                </li
        <?php
            }
        ?>
        >

        <!-- Trang sau -->
        <?php 
            if($p < $totalPage && $totalPage > 1) {
                $next = $p + 1;
        ?>
            <li class="page-item">
                <a class="page-link" href="index.php?page=category-product&cat_id=<?php echo $cat_id?>&p=<?php echo $next?>">Trang sau</a>
            </li>
        <?php
            }
        ?>
    </ul>
</div>
<?php
    }else{
        echo '<h3>'.$cat_name.'(hiện có 0 sản phẩm)</h3>';
        echo '</div>';
    }
?>