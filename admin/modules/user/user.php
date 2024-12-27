<?php
// thiết lập kết nối
$conn = initConnection();
$limit = 5;
$sqlTotalRecords = "SELECT user_id FROM users";
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
$sqlAllUser = " SELECT * FROM users WHERE isDeleted = 0 LIMIT	$start,$limit";
// thực thi câu truy vấn
$queryAllUser = mysqli_query($conn, $sqlAllUser);
?>

<div id="main" class="row">
  <span><a href=""><i class="fa-solid fa-house fa-lg"></i></a>
    <a>/</a>
    <a class="active"> Danh sách thành viên</a></span>
</div>
<div>
  <h1>Danh sách thành viên</h1>
</div>
<div id="main" class="row">
  <div class = "col-9"> 
  <table class="table" style="width:100%">
    <thread>
      <tr>
        <th>
          <div>ID</div>
        </th>
        <th>
          <div>Họ và tên</div>
        </th>
        <th>
          <div>Gmail</div>
        </th>
        <th>
          <div>Quyền</div>
        </th>
        <th>
          <div>Hành động</div>
        </th>
      </tr>
      <?php
      if (mysqli_num_rows($queryAllUser) > 0) {
        while ($row = mysqli_fetch_assoc($queryAllUser)) {
      ?>
          <tr>
            <td> <?php echo $row['user_id']; ?></td>
            <td> <?php echo $row['username']; ?></td>
            <td> <?php echo $row['email']; ?></td>
            <td>
              <?php if ($row['level'] == 1) {
                echo '<span class = "label label-danger"> Admin </span> ';
              } else {
                echo '<span class = "label label-primary"> Member </span> ';
              }
              ?>
            </td>

            <td class="form-group">
              <a href="index.php?page=edit_user&user_id=<?php echo $row['user_id']; ?>" class="btn btn-primary"><i class="fa-solid fa-pencil fa-lg"></i></a>
              <a href="index.php?page=delete_user&user_id=<?php echo $row['user_id']; ?>" class="btn btn-danger"><i class="fa-solid fa-trash fa-lg"></i></a>
            </td>
          </tr>

      <?php
        }
      }
      //lấy dữ liệu ra
      ?>
    </thread>
  </table></div>
</div>
</div>