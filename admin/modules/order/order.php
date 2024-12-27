<?php
// thiết lập kết nối
$conn = initConnection();

$limit = 5;
$sqlTotalRecords = "SELECT order_id FROM orders ";
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

$sqlAllCust = " SELECT * FROM orders LIMIT $start,$limit";
$queryAllCust = mysqli_query($conn, $sqlAllCust);

$sqlAllCat = " SELECT * FROM orders LIMIT	$start,$limit";
// thực thi câu truy vấn
$queryAllCat = mysqli_query($conn, $sqlAllCat);

?>
<div id="main" class="row">
  <span><a href="index.php?page=admin"><i class="fa-solid fa-house fa-lg"></i></a>
    <a>/</a>
    <a class="active" href="index.php?page=order">Quản lý đơn hàng</a></span>
</div>
<div>
  <h1>Danh sách đơn hàng</h1>
</div>

<div id="main" class="row">
  <table class="table" style="width:100%">
    <thread>
      <tr>
        <th>
          <div>STT</div>
        </th>
        <th>
          <div>Tên khách hàng</div>
        </th>
        <th>
          <div>Số điện thoại</div>
        </th>
        <th>
          <div>Email</div>
        </th>
        <th>
          <div>Địa chỉ</div>
        </th>
        <th>
          <div>Trạng thái</div>
        </th>
        <th>
          <div>Ngày đặt</div>
        </th>
        <th>
          <div>Hành động</div>
        </th>
      </tr>
      <?php
      if (mysqli_num_rows($queryAllCust) > 0) {
        while ($cust = mysqli_fetch_assoc($queryAllCust)) {
      ?>
          <tr>
            <td> <?php echo $cust['order_id']; ?></td>
            <td> <?php echo $cust['receiver_name']; ?></td>
            <td> <?php echo $cust['receiver_phone']; ?></td>
            <td> <?php echo $cust['receiver_email']; ?></td>
            <td> <?php echo $cust['receiver_address']; ?></td>
            <td>
              <?php
              if ($cust['status'] == 1) {
                echo 'Chờ xác nhận';
              } else if ($cust['status'] == 2) {
                echo 'Đã xác nhận';
              } else if ($cust['status'] == 3) {
                echo 'Đang giao hàng';
              } else if ($cust['status'] == 4) {
                echo 'Đã thanh toán';
              } else {
                echo 'Hủy';
              }
              ?>
            </td>
            <td> <?php echo $cust['created_at']; ?></td>
            <td>
              <a href="index.php?page=order-detail&order_id=<?php echo $cust['order_id']; ?>">Chi tiết</a>
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
      if ($current_page > 1) {
        $prev = $current_page - 1;
      ?>

        <li class="page-item">
          <a class="page-link" href="index.php?page=order&current_page= <?php echo $prev; ?> ">&laquo;</a>
        </li>

      <?php
      }
      ?>
      <!-- In các trang -->
      <?php for ($i = 1; $i <= $totalPages; $i++) {
      ?>
        <li class="page-item <?php if ($i == $current_page) {
                                echo 'active';
                              } ?>">
          <a class="page-link" href="index.php?page=order&current_page=<?php echo $i; ?>">
            <?php echo $i; ?>
          </a>
        </li>
      <?php
      }
      ?>

      <?php
      if ($current_page < $totalPages) {
        $next = $current_page + 1;
      ?>
        <li class="page-item"><a class="page-link" href="index.php?page=order&current_page= <?php echo $next; ?> ">&raquo;</a></li>

      <?php
      }
      ?>
    </ul>
  </nav>
</div>