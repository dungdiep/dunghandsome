<?php

//Kiểm tra session nếu chưa đăng nhập thì quay vào trang login.php
session_start();
if (!isset($_SESSION['user'])) {
    header("location: login.php");
}
?>

<?php
	$conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
	if (isset($_POST['change'])) 
	{
		 
			$username = $_POST['username'];
           
		

		$oldPassword = md5($_POST['oldPassword']);
		$newPassword = md5($_POST['newPassword']);
		$confirmPassword = md5($_POST['confirmPassword']);
        echo "$username";
         echo "$oldPassword";
          echo "$newPassword";
           echo "$confirmPassword";
		if ($username != '' && $oldPassword != '' && $newPassword != '' && $confirmPassword != '') 
		{
			
		    if ($newPassword == $confirmPassword) 

		    {

                echo "$username";
         echo "$oldPassword";
          echo "$newPassword";
           echo "$confirmPassword";
                
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
</head>
<style>
.form-control {
    width: 50%;
}

.container {
    margin-left: 30%;
    margin-top: 10%;
}
</style>


<body>


    <div class="container">
        <h2>Đổi mật khẩu</h2>
        <form action="" method="post" class="form">
            <div class="form-group">

                <input type="text" class="form-control" id="email" name="username">
            </div>
            <div class="form-group">
                <label for="email">Mật khẩu cũ:</label>
                <input type="password" class="form-control" id="email" name="oldPassword">
            </div>
            <div class="form-group">
                <label for="pwd">Mật khẩu mới:</label>
                <input type="password" class="form-control" id="pwd" name="newPassword">
            </div>
            <div class="form-group">
                <label for="pwd">Nhập lại mật khẩu mới:</label>
                <input type="password" class="form-control" id="pwd" name="confirmPassword">
            </div>


            <button type="submit" name="change" class="btn btn-success">Đổi mật khẩu
            </button>
        </form>
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