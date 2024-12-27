<?php 
        $conn = initConnection();
        $keyword = "";
        //Lấy keyword trên đường dẫn khi người dùng click chuyển trang
        if(isset($_GET['keyword'])){
            $keyword = $_GET['keyword'];
        }
        //Lấy keyword khi người dùng submit form
        if(isset($_POST['keyword'])){
            $keyword = $_POST['keyword'];
        }
        $arr = explode(' ', $keyword);
        $str = '%'.implode('%',$arr).'%';
        $limit = 3;
        $sqlTotalSearch = "SELECT * FROM products WHERE prd_name  LIKE '$str'";
        $queryTotalSearch = mysqli_query($conn, $sqlTotalSearch);
        $totalRecords = mysqli_num_rows($queryTotalSearch);
        $totalPages = ceil($totalRecords/ $limit);
        //Kiểm tra trên url có số trang không?
        if(isset($_GET['p'])) {
            $p = $_GET['p'];
        }else{
            $p = 1;
        }
        //Nếu người dùng bấm nút trở về trước thì $p = $p - 1, trong trường hợp $p < 1 thì gán $p = 1
        if($p < 1) {
            $p = 1;
        }
        //Nếu người dùng bấm nút trở về sau thì $p = $p + 1, trong trường hợp $p > $totalPages thì gán $p = $totalPages
        if($p > $totalPages && $totalPages > 1) {
            $p = $totalPages;
        }
        $start = ($p - 1) * $limit;
        $sqlSearch = "SELECT * FROM products WHERE prd_name LIKE '$str' LIMIT $start, $limit";
        $querySearch = mysqli_query($conn, $sqlSearch);

    ?>
<!--	List Product	-->
<div class="products">
    <div id="search-result">Kết quả tìm kiếm với sản phẩm <span><?php echo $keyword; ?></span>
    </div>
    <div class="product-list row">
        <?php if(mysqli_num_rows($querySearch) > 0) { 
            while($product = mysqli_fetch_assoc($querySearch)) {
        ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mx-product">
                <div class="product-item card text-center">
                    <a href="index.php?page=product-detail&prd_id=<?php echo $product['prd_id']; ?>"><img src="upload/product/<?php echo $product['prd_image']; ?>"></a>
                    <h4><a href="index.php?page=product-detail&prd_id=<?php echo $product['prd_id']; ?>"><?php echo $product['prd_name']; ?></a></h4>
                    <p>Giá Bán: <span><?php echo number_format($product['prd_price'],0,',','.'); ?>đ</span></p>
                </div>
            </div>
        <?php
            }
        }else{
            echo "Không tìm thấy sản phẩm nào!";
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
                <a class="page-link" href="index.php?page=search-result&p=<?php echo $prev?>&keyword=<?php echo $keyword;?>">Trang trước</a>
            </li>
        <?php
            }
        ?>
        <!-- Các trang giữa -->
        <?php 
            for($i = 1; $i <= $totalPages; $i++) {
        ?>
                <li class="page-item <?php if($i == $p) { echo ' active';} ?>">
                    <a class="page-link" href="index.php?page=search-result&p=<?php echo $i; ?>&keyword=<?php echo $keyword;?>">
                        <?php echo $i; ?>
                    </a>
                </li>
        <?php
            }
        ?>
        <!-- Trang sau -->
        <?php 
            if($p < $totalPages && $totalPages > 1) {
                $next = $p + 1;
        ?>
            <li class="page-item">
                <a class="page-link" href="index.php?page=search-result&p=<?php echo $next?>&keyword=<?php echo $keyword;?>">Trang sau</a>
            </li>
        <?php
            }
        ?>
    </ul>
</div>