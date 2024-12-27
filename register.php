<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>register</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/register.css">

</head>

<body>
    <div class="container">
        <form id="form" action="register-process.php" role="form" method="post">
            <h1>Registration</h1>
            <?php
            // lỗi anh mục đã tồn tại
            if (isset($error)) {
                echo $error;
            }

            //lôic thêm bản ghi ko thành công
            if (isset($insertFailed)) {
                echo $insertFailed;
            }
            ?>


            <div class="input-control">
                <label for="username">Username</label>
                <input id="username" name="cust_name" type="text" required>
            </div>
            <div class="input-control">
                <label for="email">Email</label>
                <input id="email" required type="text" name="cust_mail" class="form-control" placeholder="Tên danh mục...">
                <div class="error"></div>
            </div>
            <div class="input-control">
                <label for="password">Password</label>
                <input id="password" name="cust_pass" type="password">
                <div class="error"></div>
            </div>
            <div class="input-control">
                <label for="password">Password again</label>
                <input id="re_password" name="re_password" type="password">
                <div class="error"></div>
            </div>
            <div class="input-control">
                <label for="username">Họ & tên</label>
                <input id="username" name="fullname" type="text" required>
            </div>
            <div class="input-control">
                <label for="username">Số điện thoại</label>
                <input id="username" name="cust_numberphone" type="text" required>
            </div>
            <div class="input-control">
                <label for="username">Giới tính</label>
                <select name="cust_sex" id="username">
                    <option value="nam">Nam</option>
                    <option value="nu">Nữ</option>
                </select>
            </div>
            <div class="input-control">
                <label for="username">Ngày sinh(năm-tháng-ngày)</label>
                <input id="username" name="cust_birth" type="date" required>
            </div>
            <div class="input-control">
                <label for="username">Địa chỉ</label>
                <input id="username" name="cust_address" type="text" required>
            </div>

            <button type="submit" name="sbm" class="btn btn-primary">Đăng kí</button>

        </form>
    </div>
</body>

</html>