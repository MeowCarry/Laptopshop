<?php
$conn = initConnection();

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $sqlOldUser = "SELECT * FROM users WHERE user_id = $user_id";
    $queryOldUser = mysqli_query($conn, $sqlOldUser);
    if (mysqli_num_rows($queryOldUser) > 0) {
        $user = mysqli_fetch_assoc($queryOldUser);
        //Sửa thông tin
        if (isset($_POST['sbm'])) {
            $username = $_POST['username'];
            $sqlUpdateUser = "UPDATE Users SET
            username ='$username' WHERE user_id = $user_id";
            mysqli_query($conn, $sqlUpdateUser);
            header("location:index.php?page=edit_user&user_id=$user_id");
        }
    } else {
        header("location:index.php?page=user");
    }
} else {
    header("location:index.php?page=user");
}
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="location:index.php?page=user">Quản lý thành viên</a></li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thành viên: <?php echo $user['username']; ?></h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-8">
                        <div class="alert alert-danger">Email đã tồn tại, Mật khẩu không khớp !</div>
                        <form role="form" method="post">
                            <div class="form-group">
                                <label>Biệt danh</label>
                                <input type="text" name="username" required class="form-control" value="<?php echo $user['username']; ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Họ & Tên (đầy đủ)</label>
                                <input type="text" name="fullname" required class="form-control" value="<?php echo $user['fullname']; ?>" placeholder="Họ & Tên">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" required class="form-control" value="<?php echo $user['email']; ?>" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input type="text" name="password" required class="form-control" value="<?php echo $user['password']; ?>" placeholder="Mật khẩu">
                            </div>
                            <div class="form-group">
                                <label>Nhập lại mật khẩu</label>
                                <input type="text" name="re_password" required value="<?php if (isset($result)) ?>" class="form-control" placeholder="Nhập lại mật khẩu">
                            </div>
                            <button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                    </div>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->

</div> <!--/.main-->