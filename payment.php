<?php
$conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
if (isset($_POST["order"])) {

    if (isset($_POST['account_id']))
        $account_id = trim($_POST["account_id"]);
    else $account_id   = "";

    if (isset($_POST['product_id']))
        $product_id = trim($_POST["product_id"]);
    else $product_id   = "";

    if (isset($_POST['quantity']))
        $quantity = trim($_POST["quantity"]);
    else $quantity  = "";
    
    if (isset($_POST['price']))
        $price = trim($_POST["price"]);
    else $price  = "";

    //Kiểm tra điều kiện bắt buộc đối với các field không được bỏ trống
    if (
        $account_id == "" || $product_id == "" || $quantity ==
        "" || $price == "") {
        echo '<script>';
        echo 'alert("Có vấn đề xảy ra")';
        echo '</script>';
    } else {
        // Kiểm tra đã tồn tại chưa
        $sql = "SELECT * from order_item where product_id='$product_id' ";

        $user = mysqli_query($conn, $sql);

        if (mysqli_num_rows($user)  > 0) {
            echo '<script language="javascript">';
            echo 'alert("Đặt hàng không thành công")';
            echo '</script>';
        } else {
            //thực hiện việc lưu trữ dữ liệu vào database 
            $sql = "INSERT INTO order_item (order_id, account_id, product_id, quantity, price, status, deleteorder, date) 
            VALUES (NULL, '$account_id','$product_id','$quantity', '$price' * '$quantity', '0', '0',Null)";

            $sql1 = "DELETE from cart ";
            // thực thi câu $sql với biến conn 

            mysqli_query($conn, $sql);
            mysqli_query($conn, $sql1);
            echo '<script language="javascript">';
            echo 'alert("Đặt hàng thành công")';
            echo '</script>';
        }
    }
}
?>

<?php
//Kiểm tra session nếu chưa đăng nhập thì quay vào trang login.php
session_start();
if (!isset($_SESSION['user'])) {
    header("location:login.php");
}


function adddotstring($strNum)
{
    $len = strlen($strNum);
    $counter = 3;
    $result = "";
    while ($len - $counter >= 0) {
        $con = substr($strNum, $len - $counter, 3);
        $result = '.' . $con . $result;
        $counter += 3;
    }
    $con = substr($strNum, 0, 3 - ($counter - $len));
    $result = $con . $result;
    if (substr($result, 0, 1) == '.') {
        $result = substr($result, 1, $len + 1);
    }
    return $result;
}
?>
<?php

?>

<!--PHP Xử lý việc xóa -->
<?php
$conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
if (isset($_GET['cart_id']))
    $cart_id = trim($_GET['cart_id']);
else $cart_id   = "";

$sql = "DELETE FROM cart WHERE cart_id='" . $cart_id . "'";

if (mysqli_query($conn, $sql)) {
} else {
    echo '<script>';
    echo 'alert("Đã xảy ra lỗi.")';
    echo '</script>' . mysqli_error($conn);
}
mysqli_close($conn);
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
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="administration/css/order.css">
    <link rel="stylesheet" href="./administration/input_number.css">


</head>

<style>

</style>

<body>


    <div class="card" class="preloading">
        <form method="post" action="add_order.php">

            <div class="row">
                <div class="col-md-12 cart">
                    <div class="title">
                        <div class="row">
                            <div class="col text-muted">
                                <h4><b style="color: green;"> <i class="far fa-address-card"></i> THANH TOÁN ĐƠN
                                        HÀNG</b>
                                </h4>
                            </div>

                            <div class="col-2">
                                <div class="row text-muted"></div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
                    $result = mysqli_query($conn, "SELECT c.cart_id, c.product_id, c.price, c.quantity, c.total, p.unit, p.image_link, p.product_name, p.price 
                FROM cart as c INNER JOIN product as p ON c.product_id = p.product_id order by c.cart_id asc");

                    ?>

                    <!--  -->
                    <div class="row border-top border-bottom p-2">


                        <?php
                        $i = 0;
                        while ($row = mysqli_fetch_array($result)) {
                        ?>

                        <div class="row main align-items-center">
                            <input type="text" name="account_id" value="<?php echo $_SESSION['id'] ?> "
                                style="display:none;">
                            <input type="text" name="product_id" id="" value="<?php echo $row['product_id'] ?>"
                                style="display:none;">
                            <input type="text" name="quantity" value="<?php echo $row['quantity'] ?> "
                                style="display:none;">
                            <input type="text" name="price" value="<?php echo $row['total'] ?> " style="display:none;">

                            <div class="col-2"><img class="img-fluid"
                                    src="./administration/img/<?php echo $row['image_link']; ?>" alt=""></div>

                            <div class="col">
                                <div class="row text-muted" style="font-size: 15px;"><?php echo $row['product_name']; ?>
                                </div>
                            </div>

                            <div class="col">

                                <form action="updateQuantity.php" method="GET">
                                    <input name="cartID" type="text" value="<?php echo $row['cart_id']; ?>"
                                        style="display: none;">
                                    <?php echo $row['quantity']; ?>

                            </div>
                            <div class="col" style="font-weight: 500;"><?php echo $row['unit']; ?></div>

                            <div class="col" style="color: red;">
                                <?php echo adddotstring($row['total']); ?> VND
                            </div>



                        </div>



                        <?php
                            $i++;
                        }
                        ?>
                    </div>
                    <br>
                    <div class="col-2">
                        <div class="row text-muted"><button class="btn bg-warning"
                                style=" border-radius: 10px; border: 0px;" type="submit" name="order"
                                onclick="return confirm('Bạn có chắc chắn muốn đặt hàng?')">
                                Đặt hàng</button></div>
                    </div>
                    <div style="float: right; padding: 5px;">
                        <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
                        $total = mysqli_query($conn, "SELECT SUM(total) FROM cart");
                        $sumProduct = mysqli_query($conn, "SELECT count(1) as summary FROM cart");
                        ?>
                        <p> Tổng tiền:
                            <?php
                            $i = 0;
                            while ($row = mysqli_fetch_array($total)) {
                            ?>
                            <n class="text-danger"><?php echo adddotstring($row[0]); ?> VND</n>
                        </p>

                        <p> Phí vận chuyển: <n class="text-danger">20.000 VND</n>
                        </p>
                        <p>Tổng thanh toán: <n class="text-danger"><?php echo adddotstring($row[0] + 20000); ?> VND</n>
                        </p>
                        <?php
                                $i++;
                            }
                    ?>
                    </div>
                    <div class="back-to-shop"><a href="success.php"><i class="fas fa-long-arrow-alt-left"> <span
                                    class="text" style="color:#00483d">Quay về
                                    và tiếp tục mua sắm</span></i> </a></div>
                </div>

            </div>
    </div>
    </form>




</body>

</html>



</body>

</html>