<?php

//Kiểm tra session nếu chưa đăng nhập thì quay vào trang login.php
session_start();
if (!isset($_SESSION['User'])) {
    header("location: login_admin.php");
}
?>

<?php
	$conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
	if (isset($_POST['change'])) 
	{
		if (isset($_POST['username'])) {
			$username = $_POST['username'];
		}
		else{
			$username ="";
		}

		$oldPassword = md5($_POST['oldPassword']);
		$newPassword = md5($_POST['newPassword']);
		$confirmPassword = md5($_POST['confirmPassword']);

		if ($username != '' && $oldPassword != '' && $newPassword != '' && $confirmPassword != '') 
		{
			
		    if ($newPassword == $confirmPassword) 
		    {
		    	$query = mysqli_query($conn, "SELECT username, password FROM account WHERE username='$username' AND password='$oldPassword'");
		    	$num = mysqli_fetch_array($query);
			    if ($num > 0 ) 
			    {
			        $con = mysqli_query($conn, "UPDATE account  SET password = '$newPassword' WHERE username='$username'");

			        echo '<script language="javascript">';
					echo 'alert("Thay đổi mật khẩu thành công.")';
					echo '</script>';
			    }
			}
			else{
					echo '<script language="javascript">';
					echo 'alert("Mật khẩu nhập lại không đúng.")';
					echo '</script>';
			}
		}
		else{
			echo '<script language="javascript">';
			echo 'alert("Yêu cầu điền đầy đủ thông tin.")';
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
</head>
<style>
body {
    background: #00483d;
    background-size: 50% 100vh;
}
</style>

<body>

    <div class="container bootstrap snippets bootdey">
        <div>
            <img src="../administration/img/Admin-icon.png" alt="" width="150" class="ml-5 mt-3">
        </div>
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-2">
                <form action="" method="post">


                    <div class="panel-body">
                        <div class="row">

                            <div style="margin-top:80px;" class="col-xs-12 col-sm-6 col-md-8 login-box">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span>
                                        </div>


                                        <input class="form-control" name="username" type="text"
                                            placeholder="Tên tài khoản" value="<?php echo  $_SESSION['User'] ?>"
                                            style="display:none">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span>
                                        </div>

                                        <input class="form-control" name="oldPassword" type="password"
                                            placeholder="Nhập lại mật khẩu cũ của bạn" minlength="6" maxlength="18">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-log-in"></span>
                                        </div>
                                        <input class="form-control" name="newPassword" type="password"
                                            placeholder="Vui lòng nhập mật khẩu mới" minlength="4" maxlength="18">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-log-in"></span>
                                        </div>
                                        <input class="form-control" name="confirmPassword" type="password"
                                            placeholder="Nhập lại mật khẩu mới" minlength="4" maxlength="18">
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6"></div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <button class="btn icon-btn-save btn-success" type="submit" name="change">
                                    <span class="btn-save-label"><i
                                            class="glyphicon glyphicon-floppy-disk"></i></span>Thay đổi</button>
                            </div>
                            <div><a href="./login_admin.php">Quay về đăng nhập</a></div>
                        </div>
                    </div>
            </div>
            </form>
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