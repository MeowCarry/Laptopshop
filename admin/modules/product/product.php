<?php
// thiết lập kết nối
$conn = initConnection();
$limit = 5; // số bản ghi trên một trang
//Lấy tổng số bản ghi của bảng product
$sqlTotalRecords = "SELECT prd_id FROM products WHERE isDeleted = 0";
$queryTotalRecords = mysqli_query($conn, $sqlTotalRecords);
$totalRecords = mysqli_num_rows($queryTotalRecords); // tổng số bản ghi trong product
//Tổng số trang
$totalPages = ceil($totalRecords / $limit);
//lấy trang hiện tại
/**
 * Nếu như tồn tại tham số current_page trên đường dẫn thì lấy giá trị của nó.
 * Còn nếu như ko tồn tại tham số current_page thì gán mặc định trang đó là trang số 1.
 */
if (isset($_GET['current_page'])) {
  $current_page = $_GET['current_page'];
} else {
  $current_page = 1;
}

// Khi người dùng bấm vào nút trở về trang trc.
if ($current_page < 1) {
  $current_page = 1;
}

// Khi người dùng bấm vào nút sang trang sau.
if ($current_page > $totalPages && $totalPages > 1) {
  $current_page = $totalPages;
}

//Tìm biến $start
$start = ($current_page - 1) * $limit;

// chuẩn bị câu truy vấn lấy tất cả cá thành viên
$sqlAllPro = " SELECT * FROM products INNER JOIN categories ON products.cat_id = categories.cat_id WHERE products.isDeleted = 0 LIMIT $start,$limit";
// thực thi câu truy vấn
$queryAllPro = mysqli_query($conn, $sqlAllPro);
?>

<div id="main" class="row">
  <span><a href=""><i class="fa-solid fa-house fa-lg"></i></a>
    <a>/</a>
    <a class="active"> Danh sách sản phẩm</a></span>
</div>
<div>
  <h1>Danh sách sản phẩm</h1>
</div>
<div id="toolbar" class="btn-group">
  <a href="index.php?page=add_product" class="btn btn-success">
    <i class="glyphicon glyphicon-plus"></i> Thêm sản phẩm
  </a>
</div>
<div id="main" class="row">
  <table class="table" style="width:100%">
    <thread>
      <tr>
        <th>
          <div>ID</div>
        </th>
        <th>
          <div>Tên sản phẩm</div>
        </th>
        <th>
          <div>Giá</div>
        </th>
        <th>
          <div>Ảnh sản phẩm</div>
        </th>
        <th>
          <div>Bảo hành</div>
        </th>
        <th>
          <div>Phụ kiện đi kèm</div>
        </th>
        <th>
          <div>Độ mới</div>
        </th>
        <th>
          <div>Khuyến mãi</div>
        </th>
        <th>
          <div>Loại máy</div>
        </th>
        <th>
          <div>Trạng thái</div>
        </th>
        <th>
          <div>Hành động</div>
        </th>
      </tr>
      <?php
      if (mysqli_num_rows($queryAllPro) > 0) {
        while ($product = mysqli_fetch_assoc($queryAllPro)) {
      ?>
          <tr>
            <td> <?php echo $product['prd_id']; ?></td>
            <td> <?php echo $product['prd_name']; ?></td>
            <td> <?php echo number_format($product['prd_price'], 0, ',', '.'); ?>VND</td>
            <td style="text-align: center" id="product-jpg"><img width="90" height="120" src="../img/product/<?php echo $product['prd_image']; ?> "></td>
            <td> <?php echo $product['prd_warranty']; ?></td>
            <td> <?php echo $product['prd_accessories']; ?></td>
            <td> <?php echo $product['prd_new']; ?></td>
            <td> <?php echo $product['prd_promotion']; ?></td>
            <td> <?php echo $product['cat_name']; ?></td>
            <td>
              <?php
              if ($product['prd_status'] == 1) {
                echo '<span class="label label-success">Còn hàng</span>';
              } else {
                echo '<span class="label label-danger">Hết hàng</span>';
              }
              ?>

            <td class="form-group">
              <a href=" index.php?page=edit_product&id=<?php echo $product['prd_id']; ?>" class="btn btn-primary"><i class="fa-solid fa-pencil fa-lg"></i></a>
              <a href=" index.php?page=delete_prd&id=<?php echo $product['prd_id']; ?>" class="btn btn-danger"><i class="fa-solid fa-trash fa-lg"></i></a>
            </td>
          </tr>
      <?php
        }
      }
      ?>

    </thread>
  </table>
</div>
<div class="panel-footer">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <?php
                                if($current_page > 1){
                                    $prev = $current_page - 1;
                                ?>

                                <li class="page-item">
                                    <a class="page-link" href="index.php?page=product&current_page= <?php echo $prev; ?> ">&laquo;</a>
                                </li>

                                <?php
                                }
                                ?>
                                <!-- In các trang -->
                                <?php for($i = 1; $i <= $totalPages; $i++){
                                ?>
                                <li class="page-item <?php if($i == $current_page) {echo 'active'; } ?>">
                                    <a class="page-link" href="index.php?page=product&current_page=<?php echo $i; ?>">
                                        <?php echo $i; ?>
                                    </a>
                                </li>
                                <?php
                                }
                                ?>

                                <?php
                                if($current_page < $totalPages){
                                    $next = $current_page + 1;
                                ?>
                                <li class="page-item"><a class="page-link" href="index.php?page=product&current_page= <?php echo $next; ?> ">&raquo;</a></li>           

                                <?php
                                }
                                ?>
                            </ul>
                        </nav>
                    </div>