<?php 
    session_start();
    ob_start();
    include_once "config/db.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Home</title>
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/home.css">
<link rel="stylesheet" href="css/category.css">
<link rel="stylesheet" href="css/product.css">
<link rel="stylesheet" href="css/search.css">
<link rel="stylesheet" href="css/success.css">
<link rel="stylesheet" href="css/cart.css">
<script src="js/jquery-3.3.1.js"></script>
<script src="js/bootstrap.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
<style>
        .dropbtn {
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropbtn:hover,
        .dropbtn:focus {
            background-color: #2980B9;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            overflow: auto;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown a:hover {
            background-color: #ddd;
        }

        .show {
            display: block;
        }

        body {
            background-image: url("paper.gif");
            background-color: #cccccc;
        }
    </style>
</head>
<body>

<!--	Header	-->
<div id="header">
	<div class="container">
    	<div class="row">
        	<div id="logo" class="col-lg-3 col-md-3 col-sm-12">
            	<h1><a href="index.php"><img class="img-fluid" src="upload/logo-ko1.png"></a></h1>
            </div>
            <div id="search" class="col-lg-6 col-md-6 col-sm-12">
                <form action="index.php?page=search-result" method="post" class="form-inline">
                    <input class="form-control mt-3" name='keyword' type="search" placeholder="Tìm kiếm" aria-label="Search">
                    <button class="btn btn-danger mt-3" type="submit">Tìm kiếm</button>
                </form>
            </div>
            <div id="cart" class="col-lg-3 col-md-3 col-sm-12">
            	<a class="mt-4 mr-2" href="index.php?page=cart">giỏ hàng
                    <i class="fa-solid fa-cart-shopping cart-icon">
                    <span class="mt-3">0</span></i>
                </a>
            </div>
            <div class="dropdown">
                        <button onclick="myFunction()" class="dropbtn"><i class="fa-regular fa-circle-user fa-lg"></i></i></button>
                        <div id="myDropdown" class="dropdown-content">
                        <?php if (isset($_SESSION['user_logged'])){?>
                            <?php
                            $bitch = $_SESSION['user_logged']['cust_id']
                            ?>
                            <a href="index.php?page=file&cust_id=<?php echo $bitch ?>"><i class="fa-solid fa-user fa-lg"></i> Hồ sơ</a>
                            <a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket fa-lg"></i> Đăng xuất</a>
                        <?php  } else {
                            ?>
                           <a href="login.php"><i class="fa-solid fa-arrow-right-from-bracket fa-lg"></i> Đăng nhập</a>
                           <?php
                         }
                        ?>

                        </div>
                    </div>
        </div>
    </div>
    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#menu">
    	<span class="navbar-toggler-icon"></span>
    </button>
</div>
<!--	End Header	-->

<!--	Body	-->
<div id="body">
	<div class="container">
    	<div class="row">
        	<div class="col-lg-12 col-md-12 col-sm-12">
            	<nav>
                    <?php
                        $conn = initConnection();
                        $sqlCategories = "SELECT * FROM categories ORDER BY cat_id";
                        $queryCategories = mysqli_query($conn, $sqlCategories);
                    ?>
                	<div id="menu" class="collapse navbar-collapse">
                        <ul>
                            <?php 
                                while($cate = mysqli_fetch_assoc($queryCategories)) {
                            ?>
                                <li class="menu-item">
                                    <a href="index.php?page=category-product&cat_id=<?php echo $cate['cat_id']; ?>">
                                        <?php echo $cate['cat_name']; ?>
                                    </a>
                                </li>
                            <?php
                                }
                                closeConnection();
                            ?>
                        </ul>
                    </div>
                </nav>
                <!-- <form class="form-inline">
                    <input class="form-control mt-3" type="search" placeholder="Tìm kiếm" aria-label="Search">
                    <button class="btn btn-danger mt-3" type="submit">Tìm kiếm</button>
                </form> -->
            </div>
        </div>
        <div class="row">
             <?php 
            //   var_dump($_SESSION);
            //   die;
             
             ?>
        	<div id="main" class="col-lg-8 col-md-12 col-sm-12">
            	<!--	Slider	-->
                <div id="slide" class="carousel slide" data-ride="carousel">

                  <!-- Indicators -->
                  <ul class="carousel-indicators">
                    <li data-target="#slide" data-slide-to="0" class="active"></li>
                    <li data-target="#slide" data-slide-to="1"></li>
                    <li data-target="#slide" data-slide-to="2"></li>
                    <li data-target="#slide" data-slide-to="3"></li>
                    <li data-target="#slide" data-slide-to="4"></li>
                    <li data-target="#slide" data-slide-to="5"></li>
                  </ul>
                
                  <!-- The slideshow -->
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img src="upload/slide/images.jpg" alt="Webleaners Training">
                    </div>
                    <div class="carousel-item">
                      <img src="upload/slide/images (9).jpg" alt="Webleaners Training">
                    </div>
                     <div class="carousel-item">
                      <img src="upload/slide/images (8).jpg" alt="Webleaners Training">
                    </div>
                     <div class="carousel-item">
                      <img src="upload/slide/images (7).jpg" alt="Webleaners Training">
                    </div>
                     <div class="carousel-item">
                      <img src="upload/slide/images (4).jpg" alt="Webleaners Training">
                    </div>
					<div class="carousel-item">
                      <img src="upload/slide/download (1).jpg" alt="Webleaners Training">
                    </div>
                  </div>
                
                  <!-- Left and right controls -->
                  <a class="carousel-control-prev" href="#slide" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                  </a>
                  <a class="carousel-control-next" href="#slide" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                  </a>
                
                </div>
                <!--	End Slider	-->
                <!-- Content -->
                <?php 
                    if(isset($_GET['page'])) {
                        $page = $_GET['page'];
                        switch ($page) {
                            case 'category-product':
                                include_once "modules/product/category-product.php";
                                break;
                            case 'search-result':
                                include_once "modules/product/search-result.php";
                                break;
                            case 'product-detail':
                                include_once "modules/product/product-detail.php";
                                break;
                            case 'cart':
                                include_once "modules/cart/cart.php";
                                break;
                            case 'process-cart':
                                include_once "modules/cart/process-cart.php";
                                break;
                            case 'success':
                                include_once "modules/cart/success.php";
                                break;
                            case 'file':
                                include_once "modules/file/file.php";
                                break;
                           
                        }
                    }else{
                        include_once "modules/product/featured-product.php";
                        include_once "modules/product/lastest-product.php"; 
                    }
                
                ?>
                <!--	End Content	-->
                
            </div>
            
            <div id="sidebar" class="col-lg-4 col-md-12 col-sm-12">
            	<div id="banner">
                	<div class="banner-item">
                    	<a href="#"><img class="img-fluid" src="upload/banner/123.jpg"></a>
                    </div>
                    <div class="banner-item">
                    	<a href="#"><img class="img-fluid" src="upload/banner/asd.jpg"></a>
                    </div>
                    <div class="banner-item">
                    	<a href="#"><img class="img-fluid" src="upload/banner/download.jpg"></a>
                    </div>
                    <div class="banner-item">
                    	<a href="#"><img class="img-fluid" src="upload/banner/images (1).jpg"></a>
                    </div>
                    <div class="banner-item">
                    	<a href="#"><img class="img-fluid" src="upload/banner/images (3).jpg"></a>
                    </div>
                    <div class="banner-item">
                    	<a href="#"><img class="img-fluid" src="upload/banner/images (6).jpg"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--	End Body	-->

<div id="footer-top">
	<div class="container">
    	<div class="row">
        	<div id="logo-2" class="col-lg-3 col-md-6 col-sm-12">
            	<h2><a href="#"><img src="upload/Screenshot 2023-08-17 004058.png"></a></h2>
                <p>
                	<strong>LaptopShop</strong> Chúng tôi đào tạo chuyên sâu trong 2 lĩnh vực là Lập trình Website & Mobile nhằm cung cấp cho thị trường CNTT Việt Nam những lập trình viên thực sự chất lượng, có khả năng làm việc độc lập, cũng như Team Work ở mọi môi trường đòi hỏi sự chuyên nghiệp cao. 
                </p>
            </div>
            <div id="address" class="col-lg-3 col-md-6 col-sm-12">
            	<h3>Địa chỉ</h3>
                <p>Hai Bà Trưng - Hà Nội</p>
                <p>Hà Nội</p>
            </div>
            <div id="service" class="col-lg-3 col-md-6 col-sm-12">
            	<h3>Dịch vụ</h3>
            	<p>Bảo hành rơi vỡ, ngấm nước Care Diamond</p>
            	<p>Bảo hành Care X60 rơi vỡ ngấm nước vẫn Đổi mới</p>
            </div>
            <div id="hotline" class="col-lg-3 col-md-6 col-sm-12">
            	<h3>Hotline</h3>
            	<p>Phone Sale: (+84) 0968600145</p>
                <p>Email: manhduong@gmail.com</p>
            </div>
        </div>
    </div>
</div>

<!--	Footer	-->
<div id="footer-bottom">
	<div class="container">
    	<div class="row">
        	<div class="col-lg-12 col-md-12 col-sm-12">
            	<p>
                    2023 © LaptopShop. All rights reserved. Developed by Manh.
                </p>
            </div>
        </div>
    </div>
</div>
<!--	End Footer	-->
<?php  ob_end_flush(); ?>
</body>
</html>
<script>
    /* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    // function corny() {
    //     if (!event.target.matches('.dropbtn')) {
    //         var dropdowns = document.getElementsByClassName("dropdown-content");
    //         var i;
    //         for (i = 0; i < dropdowns.length; i++) {
    //             var openDropdown = dropdowns[i];
    //             if (openDropdown.classList.contains('show')) {
    //                 openDropdown.classList.remove('show');
    //             }
    //         }
    //     }
    // }
</script>