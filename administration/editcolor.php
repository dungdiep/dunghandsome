<?php
//Kiểm tra session nếu chưa đăng nhập thì quay vào trang login.php
session_start();
if (!isset($_SESSION['User'])) {
    header("location: login_admin.php");
}
?>
<?php

require_once 'handing.php';

if (isset($_GET['id']))
    $id = $_GET['id'];
else $id = "";

if (isset($_POST['id']))
    $id = $_POST['id'];

$sql = 'select * from color 
            where color_id = "' . $id . '"
    ';
$datanv = getData($sql);
foreach ($datanv as $value) {
 
    $color_name = $value[1];
   
}

if (isset($_POST['update'])) {

    if (
        
        !empty($_POST['color_name'])

        
    ) {
        $color_name = $_POST['color_name'];

        $conn = new mysqli("localhost", "root", "", DATABASE);
        $sqlUpdate = 'update color set color_name = "' . $color_name . '"
               where color_id= "' . $id . '" ';


        mysqli_query($conn, $sqlUpdate);
        mysqli_close($conn);
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
.btn {
    background-color: #008080;
}
</style>

<body>
    <div class="heading ">
        <h4 style="font-family:times">Sửa màu sản phẩm</h4>
    </div>


    <form action="" class="mt-5 " method="post" style=" height:500px;margin: 0 auto; border-radius: 10px; ">

        <div class="row">
            <div class="col-md-3">
                <label for="" class="mt-3" style="margin-left: 35px;color: #008080; font-weight: bold;">Tên
                    màu</label>
            </div>
            <div class="col-md-9">
                <div class="form-group col-md-12">

                    <input type="text" name="color_name" id="" class="form-control " value="<?php echo $color_name ?>"
                        placeholder="" aria-describedby="helpId " style="width: 60%">

                </div>
            </div>
        </div>





        <button class="btn btn ml-4 text-white" type="submit" name="update">Sửa</button>
        <?php echo '<input type="hidden" name="id" value="' . $id . '"/>'; ?>
        <button class="btn btn" style="margin-left: 20px;"> <a style="color:white; text-decoration: none;"
                href="color.php">Quay về</a></button>

    </form>

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