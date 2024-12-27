<?php
    session_start();
    include_once "config/db.php";

// validdate email
    if(empty($_POST['cust_mail'])){
        $_SESSION['error']['cust_mail'] = '<div class= "error-text text-danger "> Email không được để trống! </div>';
            header("Location: login.php");// nếu email chưa đc nhập thì di chuyển về trang login.php
    }else{
        $mail = $_POST['cust_mail'];
        $_SESSION['old_email'] = $cust_mail;
    }
    
    if(empty($_POST['cust_pass'])){
        $_SESSION['error']['cust_pass'] = '<div class= "error-text text-danger "> password không được để trống! </div>';
        header("Location: login.php");// nếu mật khẩu chưa đc nhập thì di chuyển về trang login.php
    }else{
        $pass = $_POST['cust_pass'];
        $_SESSION['old_pass'] = $pass;
    }
    // thực hiện đăng nhập
    if(isset($mail) && isset($pass)) { 
        // thiết lập kết lối tới CSDL
        $conn = initConnection();
        // chuẩn bị câu truy vấn kiểm tra tài khoản
        $sqlLogin = "SELECT * FROM customers WHERE email = '$mail' AND password = '$pass'";
        // thực hiện truy vấn đến CSDL
        $queryLogin = mysqli_query($conn, $sqlLogin);
        //kiểm tra dữ liệu
        if(mysqli_num_rows($queryLogin) > 0){
            $result = mysqli_fetch_assoc($queryLogin);
            // lưu trữ thông tin vào session
            $_SESSION['user_logged']['cust_id'] = $result['cust_id'];
            $_SESSION['user_logged']['cust_name'] = $result['cust_name'];
            $_SESSION['user_logged']['cust_mail'] = $result['email'];

            header("Location:index.php");
        }else{
            $_SESSION['error']['invalid_account'] = '<div class="alert alert-danger">Tài khoản không hợp lệ !</div>';
            header("Location:login.php");
        }
        closeConnection();
    }
?>