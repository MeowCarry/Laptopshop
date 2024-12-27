<?php 
    $conn = initConnection();
    $sqlFeaturedPrd = "SELECT * FROM products WHERE prd_featured=1 ORDER BY prd_id DESC LIMIT 6";
    $queryFeaturedPrd = mysqli_query($conn, $sqlFeaturedPrd);
?>

<div class="products">
    <h3>Sản phẩm nổi bật</h3>
    <div class="product-list row">
        <?php 
            while($row = mysqli_fetch_assoc($queryFeaturedPrd)) {
        ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mx-product">
                <div class="product-item card text-center">
                    <a href="index.php?page=product-detail&prd_id=<?php echo $row['prd_id']; ?>">
                        <img src="upload/product/<?php echo $row['prd_image']; ?>">
                    </a>
                    <h4>
                        <a href="index.php?page=product-detail&prd_id=<?php echo $row['prd_id']; ?>">
                            <?php echo $row['prd_name']; ?>
                        </a>
                    </h4>
                    <p>Giá Bán: <span> <?php echo number_format($row['prd_price'], 0, ',', '.'); ?>đ</span></p>
                </div>
            </div>
        <?php
            }
        ?>
    </div>
</div>