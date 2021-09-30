<?php
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
} ?>
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
    <link rel="stylesheet" href="css/cart.css" />
</head>

<body>

    <body>
        <main class="page">
            <section class="shopping-cart dark mt-5">
                <div class="container">
                    <div class="block-heading">
                    </div>

                    <div class="content">
                        <div class="row">
                            <div class="col-md-12 col-lg-8">
                                <h3 class="mt-3 ml-3"
                                    style="font-weight:bold; color:#00483d;text-shadow: 3px 3px 3px lightgrey"><i
                                        class="fas fa-shopping-cart"></i> GIỎ HÀNG
                                </h3>
                                <div class="items">
                                    <div class="product">
                                        <?php 
                                        $conn = new mysqli("localhost", "root", "", "onlineshop");
                                        //câu lệnh muốn thực thi
                                        if (isset($_GET['delete'])){
                                            $delete = $_GET['delete'];
                                        }
                                        else{
                                            echo $delete = "";
                                        }
                                        
                                        $sql = "DELETE from cart where cart_id = '$delete' ";
                                        //thực thi câu lệnh
                                        mysqli_query($conn, $sql);
                                        //đóng kết nôi
                                        mysqli_close($conn);
                                    ?>
                                        <?php
                                        $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
                                        $result = mysqli_query($conn, "SELECT c.cart_id, c.product_id, c.price, c.total, c.quantity, p.unit, p.image_link, p.product_name,
                                        p.price FROM cart as c INNER JOIN product as p ON c.product_id = p.product_id order by c.cart_id asc");
                                        ?>

                                        <div class="row pl-5">
                                            <?php
                                            $i = 0;
                                            while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <div class="row">
                                                <div class="col-md-2">

                                                    <img class="card-img-bottom"
                                                        src='administration/img/<?php echo $row["image_link"]; ?>' alt="Card
                                            image" width="20" height="100">
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="info">
                                                        <form action="update_quantity.php" method="get">
                                                            <input type="number" name="cart_id"
                                                                value="<?php echo $row['cart_id']?>"
                                                                style="display:none">
                                                            <div class="row">
                                                                <div class="col-md-3 product-name">

                                                                    <span style="color: #00483d">
                                                                        <?php echo $row['product_name'] ?></span>

                                                                </div>
                                                                <div class="col-md-2 quantity">

                                                                    <input id="quantity" type="number"
                                                                        value="<?php echo $row['quantity']  ?>"
                                                                        class="form-control quantity-input"
                                                                        name="quantity">
                                                                </div>
                                                                <div class="col-md-1 quantity">

                                                                    <p><?php echo $row['unit'] ?></p>
                                                                </div>

                                                                <div class="col-md-2 ">
                                                                    <p style="color: red; font-size: 18px;">
                                                                        <?php echo adddotstring($row['total']) ?> VND
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <button class="btn text-white" type="submit"
                                                                        name="change"
                                                                        style="background-color:#00483d"><i
                                                                            class="fas fa-sync-alt"></i></button>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <a href="cart.php?delete=<?php echo $row['cart_id']; ?>"
                                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')"><i
                                                                            class="fa fa-minus-circle"
                                                                            style="text-decoration: none; color: grey;"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                            <?php
                                                $i++;
                                            }
                                            ?>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class=" col-md-12 col-lg-4">
                                <div class="summary" style="border-radius:10px">
                                    <h3></h3>
                                    <div class="summary-item"><span class="text"></span><span class="price">
                                            <?php

                                            $total = mysqli_query($conn, "SELECT SUM(total) FROM cart");
                                            $sumProduct = mysqli_query($conn, "SELECT count(1) as summary FROM cart");
                                            ?>

                                            <p> <i class="fas fa-dollar-sign"></i> Tổng tiền:
                                                <?php
                                                $i = 0;
                                                while ($row = mysqli_fetch_array($total)) {
                                                ?>
                                                <n class="text-danger">
                                                    <?php echo adddotstring(0 + $row[0]); ?>
                                                    VND</n>
                                            </p>


                                            <p> <i class="far fa-credit-card"></i> Tổng thanh toán: <n
                                                    class="text-danger">
                                                    <?php echo adddotstring(0 + $row[0]); ?>
                                                    VND</n>
                                            </p>
                                            <?php
                                                $i++;
                                                }
                                                ?>


                                        </span>
                                    </div>
                                    <?php
                                                $i = 0;
                                                while ($row = mysqli_fetch_array($sumProduct)) {
                                                ?>
                                    <?php 
                                                    if ($row[0] != 0) {
                                                        echo '<a href="payment.php" style="text-decoration: none;" class="text-white"><button type="button"  style="background-color:#00483d;color:white"
                                                                class="btn  btn-lg btn-block">Thanh
                                                                toán</button></a>';
                                                    }
                                                    else{
                                                        echo '<a href="#" onclick="notice()" style="text-decoration: none;" class="text-white"><button type="button" style="background-color:#00483d;color:white"
                                                                class="btn  btn-lg btn-block ">Thanh
                                                                toán</button></a>';
                                                    }
                                                ?>


                                    <?php
                                                $i++;
                                                }
                                                ?>
                                    <a class="mt-2" href="./success.php"
                                        style="text-decoration:none; font-size:12px; color:#00483d ">
                                        <i class="fas fa-long-arrow-alt-left "></i> Tiếp tục mua sắm</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>


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
        <script type="text/javascript">
        function notice() {
            alert("Chưa có sản phẩm nào trong giỏ hàng!");
        }

        function confirm() {
            return confirm("Bạn có muốn xóa sản phẩm này!");
        }
        </script>
    </body>

</html>