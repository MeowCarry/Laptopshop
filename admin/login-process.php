<?php
    Session_start();
// sử lý đăng nhập
    include_once "../config/db.php";

// validdate email
    if(empty($_POST['mail'])){
        $_SESSION['error']['mail'] = '<div class= "error-text text-danger "> Email không được để trống! </div>';
            header("Location: login.php");// nếu email chưa đc nhập thì di chuyển về trang login.php
    }else{
        $mail = $_POST['mail'];
        $_SESSION['old_email'] = $mail;
    }
    
    if(empty($_POST['pass'])){
        $_SESSION['error']['pass'] = '<div class= "error-text text-danger "> password không được để trống! </div>';
        header("Location: login.php");// nếu mật khẩu chưa đc nhập thì di chuyển về trang login.php
    }else{
        $pass = $_POST['pass'];
        $_SESSION['old_pass'] = $pass;
    }
    // thực hiện đăng nhập
    if(isset($mail) && isset($pass)) { 
        // thiết lập kết lối tới CSDL
        $conn = initConnection();
        // chuẩn bị câu truy vấn kiểm tra tài khoản
        $sqlLogin = "SELECT * FROM users WHERE email = '$mail' AND password = '$pass'";
        // thực hiện truy vấn đến CSDL
        $queryLogin = mysqli_query($conn, $sqlLogin);
        //kiểm tra dữ liệu
        if(mysqli_num_rows($queryLogin) > 0){
            $result = mysqli_fetch_assoc($queryLogin);
            // lưu trữ thông tin vào session
            $_SESSION['user_logged']['id'] = $result['id'];
            $_SESSION['user_logged']['username'] = $result['username'];
            $_SESSION['user_logged']['email'] = $result['mail'];
            $_SESSION['user_logged']['level'] = $result['level'];
            header("Location:index.php");
        }else{
            $_SESSION['error']['invalid_account'] = '<div class="alert alert-danger">Tài khoản không hợp lệ !</div>';
            header("Location:login.php");
        }
        closeConnection();
    }
?>