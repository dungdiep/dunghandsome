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
<?php
$conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
if (isset($_GET['shipted']))
    $shipted = trim($_GET['shipted']);
else $shipted   = "";

$sql = "UPDATE order_item set status= '2', deleteorder= '2' WHERE order_id='" . $shipted . "' ";

if (mysqli_query($conn, $sql)) {
} else {
    echo "Đã xảy ra lỗi: " . mysqli_error($conn);
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
        <form method="post">

            <div class="row">
                <div class="col-md-12 cart">
                    <div class="title">
                        <div class="row">
                            <div class="col text-muted">
                                <h4><b style="color: green;"> <i class="far fa-address-card"></i> ĐƠN HÀNG CỦA BẠN</b>
                                </h4>
                            </div>
                            <?php
                            $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
                            if (isset($_GET['shipted'])) {
                                $shipted = $_GET['shipted'];
                            } else {
                                $shipted = "";
                            }
                            $result = mysqli_query($conn, "SELECT o.order_id, o.product_id, o.quantity, o.price , o.status, o.deleteorder,
                                    p.product_name,p.image_link, p.unit 
                                    FROM order_item  as o INNER JOIN product as p ON o.product_id = p.product_id 
                                ");
                            ?>
                            <?php
                            $i = 0;
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                            <div class="col-2">
                                <?php
                                    if ($row['status'] == 0 && $row["deleteorder"] == 0) {
                                        echo '<div class="row text-muted"><button disabled="disabled" class="btn btn-primary bg-primary" style="cursor:no-drop; border-radius: 10px;"> Đang chờ duyệt ....</button></div>';
                                    } elseif ($row['status'] == 1 && $row["deleteorder"] == 0) {
                                        echo '<div class="row text-muted"><button disabled="disabled" class="btn btn-warning" style="cursor:no-drop; border-radius: 10px;"> Đang giao ....</button></div>';
                                    } else {
                                        echo "<div class='row text-muted'>
                                            <button disabled='disabled' class='btn bg-danger' style='border-radius: 10px; border: 0px;'> Đã nhận hàng</button>
                                            </div>";
                                    }
                                    ?>
                            </div>

                            <div class="col-2">
                                <?php
                                    $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');

                                    if (isset($_GET['delete']))
                                        $delete = $_GET['delete'];
                                    else $delete   = "";

                                    $edit = mysqli_query($conn, "delete from order_item where order_id ='$delete' ");

                                    if ($edit) {
                                            mysqli_close($conn);
                                        } else {
                                    }

                                ?>
                                <?php
                                    if ($row['status'] == 0 && $row["deleteorder"] == 0) {
                                        echo "<div class='row text-light'><a onclick='return confirm('Bạn có chắc chắn muốn hủy đơn hàng?')' href='order.php?delete=$row[order_id]' class='btn btn-primary' style='border-radius: 10px;'> Hủy đơn hàng</a></div>";
                                    } elseif ($row['status'] == 1 && $row["deleteorder"] == 0) {
                                        echo "<div class='row text-muted'><a onclick='return confirm_success()' href='order.php?shipted=$row[order_id]' class='btn btn-danger' style='border-radius: 10px; border: 1px solid red; background-color: red;'> Đã nhận ....</a></div>";
                                    } else {
                                    }

                                    ?>
                                <!-- 
                        <div class="row text-muted"><button disabled="disabled" class="btn btn-danger bg-danger" onclick="return confirm('Bạn đã chắc chắn nhận được hàng?')" style="cursor:no-drop; border-radius: 10px;"> Đã nhận <i class="fas fa-check"></i></button></div> -->
                            </div>
                            <?php
                                $i++;
                            }
                            ?>


                            <div class="col-2">
                                <div class="row text-muted"></div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');


                    ?>

                    <!--  -->
                    <div class="row border-top border-bottom p-2">

                        <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');

                        $result = mysqli_query($conn, "SELECT o.order_id, o.product_id, o.quantity, o.price ,
                         p.product_name,p.image_link, p.unit 
                        FROM order_item  as o INNER JOIN product as p ON o.product_id = p.product_id 
               ");

                        ?>
                        <?php
                        $i = 0;
                        while ($row = mysqli_fetch_array($result)) {
                        ?>


                        <div class="row main align-items-center">
                            <div class="col-2"><img class="img-fluid"
                                    src="./administration/img/<?php echo $row['image_link']; ?>" alt=""></div>
                            <div class="col">
                                <div class="row text-muted" style="font-size: 15px;"><?php echo $row['product_name']; ?>
                                </div>
                            </div>
                            <div class="col">
                                <div class=""><input type="number" value="<?php echo $row['quantity'] ?>" class="mt-3">
                                </div>
                            </div>
                            <div class="col" style="font-weight: 500;"><?php echo $row['unit']; ?></div>
                            <div class="col" style="color: red;">
                                <?php echo adddotstring(0 + $row['price']); ?> VND
                            </div>





                        </div>



        </form>
        <?php
                            $i++;
                        }
    ?>
    </div>
    <br>


    <div style="float: right ; padding: 5px;">
        <?php
        $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
        $price = mysqli_query($conn, "SELECT SUM(price) FROM order_item");
        $sumProduct = mysqli_query($conn, "SELECT count(1) as summary FROM order_item");
        ?>
        <p> Tổng tiền:
            <?php
            $i = 0;
            while ($row = mysqli_fetch_array($price)) {
            ?>
            <n class="text-danger"><?php echo adddotstring(0 + $row[0]); ?> VND</n>
        </p>

        <p> Phí vận chuyển: <n class="text-danger">20.000 VND</n>
        </p>
        <p>Tổng thanh toán: <n class="text-danger">
                <?php echo adddotstring($row[0] + 20000); ?> VND</n>
        </p>
        <?php
                $i++;
            }
    ?>
    </div>
    <div class="back-to-shop"><a href="success.php"><i class="fas fa-long-arrow-alt-left">
                <span class="text-muted">Quay
                    lại mua sắm</span></i> </a></div>
    </div>

    </div>
    </div>




</body>

</html>



</body>

</html>