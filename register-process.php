<?php
    Session_start();

    include_once "config/db.php";

    if(isset($_POST['sbm'])){
        $cust_name = $_POST['cust_name'];
        $cust_mail = $_POST['cust_mail'];
        $cust_pass = $_POST['cust_pass'];
        $cust_numberphone = $_POST['cust_numberphone'];
        $cust_sex = $_POST['cust_sex'];
        $cust_birth = $_POST['cust_birth'];
        $cust_address = $_POST['cust_address'];
        $fullname = $_POST['fullname'];
        include_once "config/db.php";
        //1. kiểm tra danh mục đã tồn tại trong cadl hay chưa?
        //1.1 chuẩn bị kết lối tới CSDL
        $conn = initConnection();
        //1.2 chuẩn bị câu truy vấn 
        $sqlCheckExists = " SELECT * FROM customers WHERE cust_name = '$cust_name'";
        //1.3 thực thi truy vấn
        $sqlCheckExists = mysqli_query($conn, $sqlCheckExists);
        //1.4 kiểm tra danh mục đã tồn tại hay chưa?
        if(mysqli_num_rows($sqlCheckExists) > 0) {
            //1.4.1 Nếu trong CSDL đã có bản ghi cùng tên với tên mới thì thông báo lỗi
            $error = '<div class="alert alert-danger">Danh mục đã tồn tại !</div>';
        }else{
        //2 thêm danh mục vào CSDL
        //2.1 chuẩn bị câu truy vấn
        $sqlInsertCategory = " INSERT INTO customers(cust_name ,cust_numberphone ,cust_sex ,cust_birth ,cust_address ,cust_mail ,cust_pass ,fullname,isDeleted)
                                VALUES ('$cust_name','$cust_numberphone','$cust_sex ','$cust_birth','$cust_address','$cust_mail','$cust_pass','$fullname',0)"; 
        //2.2 Thực thi câu truy vấn
        $sqlInsertCategory = mysqli_query($conn, $sqlInsertCategory);
           
        }
    }

    if(empty($_POST['cust_mail'])){
        $_SESSION['error']['cust_mail'] = '<div class= "error-text text-danger "> Email không được để trống! </div>';
            header("location: register.php");
    }else{
        $cust_mail = $_POST['cust_mail'];
        $_SESSION['old_email'] = $cust_mail;
    }
    
    if(empty($_POST['cust_pass'])){
        $_SESSION['error']['cust_pass'] = '<div class= "error-text text-danger "> password không được để trống! </div>';
        header("location: register.php");
    }else{
        $cust_pass = $_POST['cust_pass'];
        $_SESSION['old_pass'] = $cust_pass;
    }
    // thực hiện đăng nhập
    if(isset($cust_mail)) { 
        // thiết lập kết lối tới CSDL
        // chuẩn bị câu truy vấn kiểm tra tài khoản
        $sqlLogin = "SELECT * FROM customers WHERE cust_mail = '$cust_mail'";
        // thực hiện truy vấn đến CSDL
        $queryLogin = mysqli_query($conn, $sqlLogin);
        //kiểm tra dữ liệu
        if(mysqli_num_rows($queryLogin) > 0){
            $result = mysqli_fetch_assoc($queryLogin);
            // lưu trữ thông tin vào session
            $_SESSION['user_logged']['cust_id'] = $result['cust_id'];
            $_SESSION['user_logged']['cust_name'] = $result['cust_name'];
            $_SESSION['user_logged']['cust_mail'] = $result['cust_mail'];
            $_SESSION['user_logged']['cust_numberphone'] = $result['cust_numberphone'];
            $_SESSION['user_logged']['cust_address'] = $result['cust_address'];
            header("location:home.php");


        }else{
            $_SESSION['error']['invalid_account'] = '<div class="alert alert-danger">Tài khoản không hợp lệ !</div>';
            header("location:register.php");
        }
        closeConnection();
    }
?>