<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'onlineshop');

if (isset($_POST['submit']) && $_POST['username'] != '' && $_POST['password'] != '') {

    $username = trim($_POST['username']);
    $password = trim(md5($_POST['password']));
    $sql = "SELECT * FROM account WHERE username = '$username' AND password = '$password'";
    $users = mysqli_query($conn, $sql);
    if (mysqli_num_rows($users) > 0) {


        $account = mysqli_fetch_array($users);
        $_SESSION['Fullname'] = $account["fullname"];
        $_SESSION['Email'] = $account["email"];
        $_SESSION['Phone'] = $account["phone"];
        $_SESSION['Address'] = $account["address"]; 
        $_SESSION['Type'] = $account["level"];
        $_SESSION['User'] = $account["username"];
        switch ($_SESSION['Type']) {
            case 0:
                header('Location: admin.php');
                break;

            case 1:
                header('Location: ../staff/customer.php');
                break;

            case 2:
                echo '<script>';
                echo 'alert("Vui lòng đăng nhập bằng tài khoản quản trị viên hoặc nhân viên.")';
                echo '</script>';
                break;
        }
    } else {
 echo '<script>';
                echo 'alert("Vui lòng đăng nhập bằng tài khoản quản trị viên hoặc nhân viên.")';
                echo '</script>';
               
        // echo "Bạn đã nhập sai tên tài khoản hoặc mật khẩu";
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!-- Include the above in your HEAD tag -->
    <link rel="stylesheet" href="./css/admin_login.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <div class="main">


        <div class="container">

            <div class="middle">
                <div id="login">

                    <form action="" method="post">

                        <fieldset class="clearfix">

                            <p><span class="fa fa-user"></span><input type="text" Placeholder="Username" name="username"
                                    required></p>
                            <!-- JS because of IE support; better: placeholder="Username" -->
                            <p><span class="fa fa-lock"></span><input type="password" Placeholder="Password"
                                    name="password" required>
                            </p> <!-- JS because of IE support; better: placeholder="Password" -->

                            <div>

                                <span style="width:50%; text-align:right;  display: inline-block;"><input type="submit"
                                        name="submit" value="Đăng nhập"></span>
                                <a href="./register_admin.php"><i class="fas fa-registered "
                                        style="font-size:15px"></i><span class="text-white ml-2"
                                        style="font-size:13px">Đăng ký tại đây</span></a>
                            </div>

                        </fieldset>
                        <div class="clearfix"></div>
                    </form>

                    <div class="clearfix"></div>

                </div> <!-- end login -->
                <div class="logo"> &nbsp;<i class="fas fa-user-lock"></i>

                    <div class="clearfix"></div>
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