<?php
Session_start();
include_once "../config/db.php";
if (!isset($_SESSION['user_logged'])) {
  header("Location:login.php");
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>laptop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet" href="public/css/styles.css">
  <link rel="stylesheet" href="public/css/index.css">
</head>

<body>
  <div id="header">#
    <div class="dropdown">
      <button onclick="myFunction()" class="dropbtn"><i class="fa-solid fa-circle-user fa-lg"></i>Admin</button>
      <div id="myDropdown" class="dropdown-content">
        <a href="#"><i class="fa-solid fa-user fa-lg"></i> Hồ sơ</a>
        <a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket fa-lg"></i> Đăng xuất</a>
      </div>
    </div>
  </div>
  <div class="row" style="height: 550px;">
    <div class="col-sm-3 col-lg-2 g-0">
      <div id="sidebar">
        <form role="search">
          <div class="form-group">
            <!-- <i class="fa-solid fa-magnifying-glass"></i> -->
            <input type="text" class="form-control" placeholder="Search">
          </div>
        </form>

        <div id="navbar">
          <ul class="navi">
            <li class="<?php if (isset($_GET['page'])) echo 'active'; ?> "><a href="index.php?page=admin"><i class="fa-solid fa-house fa-lg"></i>Dashboard</a></li>
            <li class="<?php if (isset($_GET['page']) && $_GET['page'] == 'users') echo 'active'; ?> "><a href="index.php?page=user"><i class="fa-solid fa-users fa-lg"></i>Quản lý thành viên</a></li>
            <li class="<?php if (isset($_GET['page']) && $_GET['page'] == 'categories') echo 'active'; ?>"><a href="index.php?page=category"><i class="fa-solid fa-folder fa-lg"></i>Quản lý danh mục</a></li>
            <li class="<?php if (isset($_GET['page']) && $_GET['page'] == 'products') echo 'active'; ?>"><a href="index.php?page=product"><i class="fa-solid fa-mobile fa-lg"></i>Quản lý sản phẩm</a></li>
            <li class="<?php if (isset($_GET['page']) && $_GET['page'] == 'customers') echo 'active'; ?>"><a href="index.php?page=customer"><i class="fa-solid fa-cart-shopping fa-lg"></i>Quản lý Khách hàng</a></li>
            <li class="<?php if (isset($_GET['page']) && $_GET['page'] == 'orders') echo 'active'; ?>"><a href="index.php?page=order"><i class="fa-solid fa-cart-shopping fa-lg"></i>Quản lý đơn hàng</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
      <?php
      if (isset($_GET['page'])) {
        $page = strtolower($_GET['page']); // chuyển sang chữ thường
        switch ($page) {
          case 'admin':
            include_once "../admin/modules/admin.php";
            break;
          case 'user':
            include_once "modules/user/user.php";
            break;
          case 'add_user':
            include_once "modules/user/add_user.php";
            break;
          case 'edit_user':
            include_once "modules/user/edit_user.php";
            break;
          case 'delete_user':
            include_once "modules/user/delete_user.php";
            break;
          case 'product':
            include_once "modules/product/product.php";
            break;
          case 'add_product':
            include_once "modules/product/add_product.php";
            break;
          case 'edit_product':
            include_once "modules/product/edit_product.php";
            break;
          case 'delete_prd':
            include_once "modules/product/delete_prd.php";
            break;
          case 'category':
            include_once "modules/category/category.php";
            break;
          case 'add_category':
            include_once "modules/category/add_category.php";
            break;
          case 'edit_category':
            include_once "modules/category/edit_category.php";
            break;
          case 'delete_category':
            include_once "modules/category/delete_category.php";
            break;
          case 'order':
            include_once "modules/order/order.php";
            break;
          case 'order-detail':
            include_once "modules/order/order_detail.php";
            break;
          case 'customer':
            include_once "modules/customer/customer.php";
            break;
          case 'add_customer':
            include_once "modules/customer/add_customer.php";
            break;
          case 'edit_customer':
            include_once "modules/customer/edit_customer.php";
            break;
          case 'delete_customer':
            include_once "modules/customer/delete_customer.php";
            break;
        }
      } else {
        include_once "modules/admin.php";
      }

      ?>
    </div>
  </div>

</html>  <script>
    /* When the user clicks on the button, 
    toggle between hiding and showing the dropdown content */
    function myFunction() {
      document.getElementById("myDropdown").classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
  </script>
</body>
<script src="../admin/public/js/jquery-3.3.1.js"></script>
<script src="../admin/public/js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
