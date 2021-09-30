<?php
$conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
if (isset($_POST["submit"])) {
    //lấy thông tin từ các form bằng phương thức POST
    $username = trim($_POST["username"]);

    $password = trim(md5($_POST["password"]));

    $fullname = trim($_POST["fullname"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $address = trim($_POST["address"]);

    //Kiểm tra điều kiện bắt buộc đối với các field không được bỏ trống
    if ($username == "" || $password == "" || $fullname == "" || $email == "" || $phone == "" || $address == "") {
    } else {

        // Kiểm tra tài khoản đã tồn tại chưa
        $sql = "SELECT * from account where username='$username'";
        $user = mysqli_query($conn, $sql);

        if (mysqli_num_rows($user) > 0) {
            echo "Tài khoản đã tồn tại";
        } else {
            //thực hiện việc lưu trữ dữ liệu vào db
            $sql = "INSERT INTO account(
			username,
			password,
			fullname,
			email,
			phone,
			address,
            level
			
			) 
			VALUES (
			'$username',
			'$password',
			'$fullname',
			'$email',
			'$phone',
			'$address',
            '2'
		)";
            // thực thi câu $sql với biến conn 
            mysqli_query($conn, $sql);
            echo '<script>';
            echo 'alert("Đăng kí thành công.")';
            echo '</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="./registerFrom/fonts/material-icon/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="./registerFrom/css/style.css">
</head>

<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form method="POST" id="signup-form" class="signup-form" action="">
                        <h2 class="form-title">Đăng ký</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="username" id="name"
                                placeholder="Your Account Name" />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="name"
                                placeholder="Password" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="fullname" id="name" placeholder="Your name" />
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Your Email" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="phone" id="password"
                                placeholder="Phone number" />
                            <span toggle="#password"></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="address" id="password"
                                placeholder="Your Address" />
                            <span toggle="#password"></span>
                        </div>


                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />

                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Sign up" />
                        </div>
                    </form>
                    <p class="loginhere">
                        Đã có tài khoản<a href="./login.php" class="loginhere-link">Đăng nhập tại đây</a>
                    </p>

                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="./registerForm/vendor/jquery/jquery.min.js"></script>
    <script src="./registerForm/js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>