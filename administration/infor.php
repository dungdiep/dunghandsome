<?php
session_start();
if (!isset($_SESSION['User'])) {
    header("location: login_admin.php");
}
?>

<?php
    $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
    if (isset($_POST['update'])) 
    {
        if ($_POST['fullname'] != '' && $_POST['email'] != '' && $_POST['phone'] != '' && $_POST['address'] != '') 
        {
        $username = $_SESSION['User'];
        $fullname= $_POST['fullname'];
        $email = $_POST['email'];
        $phone =$_POST['phone'];
        $address = $_POST['address'];
        $query = mysqli_query($conn, "SELECT * FROM account WHERE username='$username'");
        $num = mysqli_fetch_array($query);
        if ($num > 0 ) 
        {
            $con = mysqli_query($conn, "UPDATE account SET fullname='$fullname', email='$email', phone='$phone', address='$address' WHERE username='$username'");

            echo '<script language="javascript">';
            echo 'alert("Thay đổi thông tin thành công.")';
            echo '</script>';
        }
        }
        else{
        echo '<p>'.'Bạn chưa nhập đủ thông tin'.'</p>';
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
    <link rel="stylesheet" href="../administration/css/infor.css">
    <link rel="stylesheet" href="../administration/css/header.css">

</head>
<style>
body {
    background-color: #008080;
    background-size: 100% 100vh;
}

>
</style>

<body>


    <div class="page-contentpage-container " id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center mt-4">
                <div class="col-xl-6 col-md-12">
                    <div class="card user-card-full" style="width: 140%;">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-4 user-profile">
                                <div class="card-block text-center text-white">
                                    <div class="m-b-25"> <img src="./img/admin (1).png" class="img-radius"
                                            alt="User-Profile-Image"> </div>

                                    <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="card-block">
                                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">THÔNG TIN CÁ NHÂN</h6>
                                    <div class="row">

                                    </div>

                                    <div class="row">

                                        <div class="col-sm-12">
                                            <p class="m-b-10 f-w-600">Họ và tên</p>
                                            <h6 class="text-muted f-w-400" style="font-family:times">
                                                <?php echo  $_SESSION["Fullname"]; ?></h6>
                                        </div>
                                        <div class="col-sm-12">
                                            <p class="m-b-10 f-w-600">Email</p>
                                            <h6 class="text-muted f-w-400" style="font-family:times">
                                                <?php echo  $_SESSION["Email"]; ?></h6>
                                        </div>
                                        <div class="col-sm-12">
                                            <p class="m-b-10 f-w-600">Số điện thoại</p>
                                            <h6 class="text-muted f-w-400" style="font-family:times">
                                                <?php echo  $_SESSION["Phone"]; ?></h6>
                                        </div>
                                        <div class="col-sm-12">
                                            <p class="m-b-10 f-w-600">Địa chỉ</p>
                                            <h6 class="text-muted f-w-400" style="font-family:times">
                                                <?php echo  $_SESSION["Address"]; ?></h6>
                                        </div>


                                        <div class="col-sm-12 mt-3 ml-5">
                                            <div class="container">

                                                <!-- Button to Open the Modal -->
                                                <button type="button" type="submit" name="" class="btn btn-success"
                                                    data-toggle="modal" data-target="#myModal">
                                                    Sửa thông tin
                                                </button>
                                                <a href="admin.php"><button type="button" type="submit" name=""
                                                        class="btn btn-success " data-toggle="modal"
                                                        data-target="#myModal">
                                                        Quay về
                                                    </button></a>

                                                <!-- The Modal -->
                                                <div class="modal" id="myModal">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">

                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body">

                                                                <form action="" method="post">

                                                                    <div class="form-group">
                                                                        <label for="">Họ và tên</label>
                                                                        <input type="text" id="" class="form-control"
                                                                            placeholder="" aria-describedby="helpId"
                                                                            name="fullname"
                                                                            value="<?php echo  $_SESSION["Fullname"]; ?>">

                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Email</label>
                                                                        <input type="text" name="email" id=""
                                                                            class="form-control" placeholder=""
                                                                            aria-describedby="helpId" name="email"
                                                                            value="<?php echo  $_SESSION["Email"]; ?>">

                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Số điện thoại</label>
                                                                        <input type="text" name="phone" id=""
                                                                            class="form-control" placeholder=""
                                                                            aria-describedby="helpId"
                                                                            value="<?php echo  $_SESSION["Phone"]; ?>">

                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Địa chỉ</label>
                                                                        <input type="text" name="address" id=""
                                                                            class="form-control" placeholder=""
                                                                            aria-describedby="helpId"
                                                                            value="<?php echo  $_SESSION["Address"]; ?>">

                                                                    </div>
                                                                    <div>
                                                                        <button class="btn btn-success ml-4 text-white"
                                                                            type="submit" name="update">Sửa</button>
                                                                    </div>



                                                                </form>

                                                            </div>

                                                            <!-- Modal footer -->


                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <ul class="social-link list-unstyled m-t-40 m-b-10">
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title=""
                                                data-original-title="facebook" data-abc="true"><i
                                                    class="mdi mdi-facebook feather icon-facebook facebook"
                                                    aria-hidden="true"></i></a></li>
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title=""
                                                data-original-title="twitter" data-abc="true"><i
                                                    class="mdi mdi-twitter feather icon-twitter twitter"
                                                    aria-hidden="true"></i></a></li>
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title=""
                                                data-original-title="instagram" data-abc="true"><i
                                                    class="mdi mdi-instagram feather icon-instagram instagram"
                                                    aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
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