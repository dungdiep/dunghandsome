<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'onlineshop');

if (isset($_POST['dangnhap']) && $_POST['username'] != '' && $_POST['password'] != '') {

    $username = trim($_POST['username']);
    $password = trim(md5($_POST['password']));
    $sql = "SELECT * FROM account WHERE username = '$username' AND password = '$password'";
    $users = mysqli_query($conn, $sql);
    if (mysqli_num_rows($users) > 0) {


        $account = mysqli_fetch_array($users);
        $_SESSION['fullname'] = $account["fullname"];
        $_SESSION['email'] = $account["email"];
        $_SESSION['phone'] = $account["phone"];
        $_SESSION['address'] = $account["address"];
        $_SESSION['type'] = $account["level"];
        $_SESSION['user'] = $account["username"];
        $_SESSION['id'] = $account["id"];

        switch ($_SESSION['type']) {
            case 0:
                echo '<script>';
                echo 'alert("Vui lòng đăng nhập bằng tài khoản khách hàng.")';
                echo '</script>';
                break;
            case 1:
                echo '<script>';
                echo 'alert("Vui lòng đăng nhập bằng tài khoản khách hàng.")';
                echo '</script>';
                break;

            case 2:
                header("location:./success.php");
                break;
        }
    } else {

        echo '<script>';

        echo 'alert("Vui bạn nhập sai tài khoản hoặc mật khẩu")';
        echo '</script>';
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="administration/css/login.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body style="margin: 0;
  padding: 0;
  background-color: #00483d;
  height: 100vh;">

    <div id="login">
        <h3 class="text-center text-white pt-5"></h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Đăng nhập</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Tên tài khoản:</label><br>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Mật khẩu:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <br>
                                <input type="submit" name="dangnhap" class="btn btn-info btn-md" value="Đăng nhập">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="./register.php" style="text-decoration: none;" class="text-info">Đăng ký tại
                                    đây</a>
                                <br>
                                <a href="index.php" style="text-decoration: none;" class="text-right">Quay về trang
                                    chủ</a>
                            </div>



                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>