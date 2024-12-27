<?php
// thiết lập kết nối
$conn = initConnection();
$limit = 5;
$sqlTotalRecords = "SELECT cat_id FROM categories";
$queryTotalRecords = mysqli_query($conn, $sqlTotalRecords);
$totalRecords = mysqli_num_rows($queryTotalRecords);
$totalPages = ceil($totalRecords / $limit);
if (isset($_GET['current_page'])) {
  $current_page = $_GET['current_page'];
} else {
  $current_page = 1;
}

if ($current_page < 1) {
  $current_page = 1;
}

if ($current_page > $totalPages && $totalPages > 1) {
  $current_page = $totalPages;
}

$start = ($current_page - 1) * $limit;

// chuẩn bị câu truy vấn lấy tất cả cá thành viên
$sqlAllCat = " SELECT * FROM categories WHERE isDeleted = 0 LIMIT	$start,$limit";
// thực thi câu truy vấn
$queryAllCat = mysqli_query($conn, $sqlAllCat);
?>

  <div id="main" class="row">
    <span><a href=""><i class="fa-solid fa-house fa-lg"></i></a>
      <a>/</a>
      <a class="active"> Danh mục</a></span>
  </div>
  <div>
    <h1>Danh sách danh mục</h1>
  </div>
  <div id="main" class="row">
    <table class="table" style="width:100%">
      <thread>
        <tr>
          <th>
            <div>ID</div>
          </th>
          <th>
            <div>Tên hạng mục</div>
          </th>
          <th>
            <div>Hành động</div>
          </th>
        </tr>
        <?php
        if (mysqli_num_rows($queryAllCat) > 0) {
          while ($row = mysqli_fetch_assoc($queryAllCat)) {
        ?>
            <tr>
              <td> <?php echo $row['cat_id']; ?></td>
              <td> <?php echo $row['cat_name']; ?></td>

              <td class="form-group">
                <a href="index.php?page=edit_category&id=<?php echo $row['cat_id']; ?>" class="btn btn-primary"><i class="fa-solid fa-pencil fa-lg"></i></a>
                <a href="index.php?page=delete_category&id=<?php echo $row['cat_id']; ?>" class="btn btn-danger"><i class="fa-solid fa-trash fa-lg"></i></a>
              </td>
            </tr>
        <?php
          }
        }
        ?>
      </thread>
    </table>
  </div>