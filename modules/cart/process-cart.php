<?php
    
    if(isset($_GET['a'])) {
        $action = $_GET['a'];
        switch ($action) {
            case 'add':
                addToCart();
                break;
            case 'update':
                updateCart();
                break;
            case 'delete':
                deleteCart();
                break;
            case 'checkout':
                checkOut();
                break;
        }
    }else{
        header("location:index.php?page=cart");
    }

    //thêm giỏ hảng
    function addToCart() {
        if(isset($_GET['prd_id'])) {
            $prdId = $_GET['prd_id'];
            if(isset($_SESSION['cart'][$prdId])) { 
            //Sản phẩm có id là $prdId đã tồn tại trong giỏ hàng
            //thì ta tăng số lượng của sản phẩm trong giỏ hàng lên 1 đơn vị.
                $_SESSION['cart'][$prdId]['qty']++;
            }else{
            //Sản phẩm có id là $prdId chưa tồn tại trong giỏ hàng
            //thì ta thực hiện thêm thông tin sản phẩm đó vào giỏ hàng
                $conn = initConnection();
                $sqlPrd = "SELECT * FROM products WHERE prd_id = $prdId";
                $queryPrd = mysqli_query($conn, $sqlPrd);
                $product = mysqli_fetch_assoc($queryPrd);

                $_SESSION['cart'][$prdId] = [
                    'price' => $product['prd_price'],
                    'qty'  => 1
                ];
            }
        }
        header("location:index.php?page=cart");
    }
    //Cập nhật giỏ hàng
    function updateCart() {
        foreach ($_POST['quantity'] as $prdId => $qty) {
            $_SESSION['cart'][$prdId]['qty'] = $qty;
        }
        header("location:index.php?page=cart");
    }
    //Xóa sản phẩm trong giỏ hàng
    function deleteCart() {
        if(isset($_GET['prd_id'])) {
            $prdId = $_GET['prd_id'];
            unset($_SESSION['cart'][$prdId]);
            //Trường hợp giỏ hàng rỗng (không có sản phẩm nào) => xóa toàn bộ giỏ hàng.
            if(empty($_SESSION['cart'])) {
                unset($_SESSION['cart']);
            }
            header("location:index.php?page=cart");
        }else{
            header("location:index.php?page=cart");
        }
    }

    function checkOut() {
        $total = 0;
        foreach($_SESSION['cart'] as $prdId => $item) {
            $total += $item['qty'] * $item['price'];
        }
        //Thêm vào orders
        $receiverName = $_POST['name'];
        $receiverPhone = $_POST['phone'];
        $receiverEmail = $_POST['mail'];
        $cust_id = $_SESSION['user_logged']['cust_id'] ;
        // die($cust_id);
        $status = 1;
        // $ok = $_SESSION['user_logged']['cust_id'];
        $sqlOrder = "INSERT INTO orders(receiver_name,receiver_phone, receiver_email, status, total, cust_id ) 
                    VALUES('$receiverName', '$receiverPhone', '$receiverEmail', '$status', '$total', '$cust_id' )";
        $conn = initConnection();
        $queryOrder = mysqli_query($conn, $sqlOrder);
        $lastInsertedId = mysqli_insert_id($conn);
        //Thêm vào Orderdetail: order_id, prd_id, qty, price
        foreach ($_SESSION['cart'] as $prdId => $value) {
            $price = $_SESSION['cart'][$prdId]['price']; //Đơn giá sản phẩm lưu trong giỏ hàng
            $qty  =  $_SESSION['cart'][$prdId]['qty']; //Số lượng của từng sản phẩm trong giỏ hàng
            $sqlDetailOrder = "INSERT INTO order_detail(order_id, prd_id, qty, prd_price) VALUES ($lastInsertedId, $prdId, $qty, $price)";
            mysqli_query($conn, $sqlDetailOrder);
        }
        unset($_SESSION['cart']);// xóa giỏ hàng sau khi mua xong
        header("location:index.php?page=success");
    }
?>