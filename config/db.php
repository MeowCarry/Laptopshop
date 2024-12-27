<?php
    define('DB_HOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'laptopshop1');

    $conn = null;
    /**
     * function: initConnection()
     * desc: Khởi tạo kết nối đến CSDL
     * @param: 
     * result: $conn
     */
    function initConnection() {
        global $conn;
        $conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if(!$conn) {
            die("Connection failed" + mysqli_connect_error());
        }else{
            mysqli_set_charset($conn, 'UTF8'); //hiển thị tiếng việt
            // echo "Kết nối thành công!";
        }
        return $conn;
    }

    /**
     * function: closeConnection()
     * desc: Đóng kết nối tới CSDL sau khi sử dụng xong
     * @param:
     * result: $conn = null
     */

    function closeConnection() {
        global $conn;
        if($conn) { //Nếu như kết nối đang được thiết lập
            mysqli_close($conn); //thì thực hiện đóng kết nối.
        }
    }
?>