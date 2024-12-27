<?php
// thiết lập kết nối
$conn = initConnection();

$limit = 5;
$sqlTotalRecords = "SELECT order_id FROM orders WHERE status != 5 ";
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

$sqlAllCust = " SELECT * FROM customers INNER JOIN orders ON customers.cust_id = orders.cust_id  WHERE customers.isDeleted = 0 AND status != 5 LIMIT $start,$limit";
$queryAllCust = mysqli_query($conn, $sqlAllCust);

$sqlAllCat = " SELECT * FROM orders LIMIT	$start,$limit";
// thực thi câu truy vấn
$queryAllCat = mysqli_query($conn, $sqlAllCat);

?>
<div id="main" class="row">
<div>
    <h1>Lịch sử mua hàng</h1>
</div>
</div>


<div id="main" class="row">
  <table class="table" style="width:100%">
    <thread>
      <tr>
        <th>
          <div>STT</div>
        </th>
        <th>
          <div>Người nhận</div>
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
            <td> <?php echo $cust['cust_id']; ?></td>
            <td> <?php echo $cust['receiver_name']; ?></td></td>
            <td>
              <a href="index.php?page=Trans_his_detail&order_id=<?php echo $cust['order_id']; ?>">Chi tiết</a>
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
          <a class="page-link" href="index.php?page=Trans_his&current_page= <?php echo $prev; ?> ">&laquo;</a>
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
          <a class="page-link" href="index.php?page=Trans_his&current_page=<?php echo $i; ?>">
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
        <li class="page-item"><a class="page-link" href="index.php?page=Trans_his&current_page= <?php echo $next; ?> ">&raquo;</a></li>

      <?php
      }
      ?>
    </ul>
  </nav>
</div>