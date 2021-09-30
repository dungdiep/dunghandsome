<?php
//Kiểm tra session nếu chưa đăng nhập thì quay vào trang login.php
session_start();
if (!isset($_SESSION['User'])) {
    header("location: login_admin.php");
}
?>
<?php
$conn = mysqli_connect('localhost', 'root', '', 'onlineshop');

if (isset($_GET['id']))
    $id = trim($_GET['id']);
else $id   = "";

$qry = mysqli_query($conn, "select * from product 



where product_id='$id'"); // select query

$row = mysqli_fetch_array($qry); // fetch data

if (isset($_POST['update'])) // when click on Update button
{
    if (isset($_POST['tsp']))
        $product_name = $_POST['tsp'];
    else $product_name   = "";

    if (isset($_POST['quantity']))
        $quantity = $_POST['quantity'];
    else $quantity   = "";

    if (isset($_POST['dv']))
        $unit = $_POST['dv'];
    else $unit   = "";




    $edit = mysqli_query($conn, "update product set quantity='$quantity'+quantity where product_id='$id'");

    if ($edit) {
        mysqli_close($conn); // Close connection
        header("location:./product.php"); // redirects to all records page
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
input {
    width: 60%;
    border-radius: 4px;
}

.container {
    width: 40%;
    margin-top: 20px;
    border-radius: 10px;
}

body {

    background-color: #008080;

    background-size: 100% 100vh;



}

.btn {
    background-color: #008080;
}


form {

    background-color: #20B2AA;
    background-size: 100% 100vh;



}
</style>

<body>

    <form class="container mt-5" action="" method="post">

        <div>
            <h4 style="color:  #008080;text-align: center;">Nhập hàng</h4>
        </div>
        <div class="form-group ml-4">

            <label for="" class="" style="color:  #008080;">Tên sản phẩm: </label></br>
            <input type="text" id="sp" class="sp" name="tsp" value="<?php echo $row['product_name'] ?>">
        </div>



        <div class="form-group ml-4">
            <label for="" style="color:  #008080;">Số lượng </label></br>
            <input type="number" id="mncc" name="quantity" value="<?php echo $row['quantity'] ?>">
        </div>


        <div class="form-group ml-4">
            <label for="" style="color:  #008080;">Đơn vị: </label></br>
            <input type="text" name="dv" id="anh" value="<?php echo $row['unit'] ?>">
        </div>




        </div>






        <button class="btn btn mb-2 text-white" type="submit" name="update">Nhập hàng</button>
        <?php echo '<input type="hidden" name="id" value="' . $id . '"/>'; ?>
        <button class="btn btn mb-2" style="margin-left: 20px;"> <a style="color:white; text-decoration: none;"
                href="orderannounce.php">Quay về</a></button>
        </div>

    </form>

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