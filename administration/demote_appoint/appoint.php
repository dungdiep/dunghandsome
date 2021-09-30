<?php
$conn = mysqli_connect('localhost', 'root', '', 'onlineshop');

if (isset($_GET['id']))
    $id = trim($_GET['id']);
else $id   = "";

$qry = mysqli_query($conn, "select * from account where id='$id'"); // select query

$row = mysqli_fetch_array($qry); // fetch data

if (isset($_POST['update'])) // when click on Update button
{
    if (isset($_POST['level']))
        $level = $_POST['level'];
    else $level   = "";

    $edit = mysqli_query($conn, "update account set level='$level' where id='$id'");

    if ($edit) {
        mysqli_close($conn); // Close connection
        header("location:../staffmanage.php"); // redirects to all records page
        exit;
    } else {
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
form {
    width: 100%;
    height: 70vh;
    background-color: #00483d;
    border-radius: 10px;
}

img {
    margin: 0 auto;

}

hr {
    display: block;
    height: 1px;
    border: 0;
    border-top: 1px solid #ccc;
    margin: 1em 0;
    padding: 0;
}
</style>

<body>
    <div class="container mt-5" style="border-radius: 10px;">
        <form action="" method="post">


            <div class="row">
                <div class="col-md-4 mt-5">
                    <img src="../img/3043585.png" alt="">
                </div>
                <div class="col-md-4 mt-5">
                    <h1 class="" style="text-align:center;font-family:times; color:orange">THĂNG CHỨC</h1>
                    <hr>
                </div>
                <div class="col-md-4  mt-4">
                    <img src="../img/6385741_preview.png" alt="" style="width:50%; float:right;margin-right:10px">
                </div>
            </div>

            <input type="text" name="level" value="0" style="display: none;">
            <button type="submit" class="mt-5 ml-5" style="border-radius: 5px; text-align: center;" name="update">Đồng
                ý</button>
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