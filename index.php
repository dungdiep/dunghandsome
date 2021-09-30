<?php
//Kiểm tra session nếu chưa đăng nhập thì quay vào trang login.php
session_start();
if (isset($_SESSION['user'])) {
    header("location: success.php");
}
?>


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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Home.css">
    <link rel="" type="" href="./administration/css/header.css">

    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"
        integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="./administration//css/home.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<style>
.btn {
    background-color: #00483d
}

.btn:hover {
    background-color: #07190B;
}

.container {
    border: 0px;
}

.icon {
    background-color: lightgrey;

    border-radius: 10px;
    height: 150px;


}

.icon:hover {
    border: 2px solid #00483d;
    cursor: pointer;
}
</style>


<body>
    <?php include("./include/header.php"); ?>
    <!-- Thanh navbar -->

    <?php include("./slider.php"); ?>
    <!-- show slide -->

    <div class="linkicon">
        <a href="https://www.messenger.com/t/100049833153057"><i class="fab fa-facebook"
                style="font-size: 45px;"></i></a></br>



    </div>







    <?php
        $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
        if (isset($_GET['submit']) && $_GET["search"] != '') {
            $search = $_GET['search'];

            $query = "select  p.product_id, p.product_name, p.price, p.unit,  p.discount, p.image_link,p.guarantee,
c.catalog_id, c.catalog_name, b.brand_id, b.brand_name
 from product as p inner join catalog as c on p.catalog_id = c.catalog_id 
 inner join brand as b on p.brand_id = b.brand_id 
  inner join color as co on co.color_id = p.color_id 
                                    
                                    WHERE (p.product_id like '$search' 
                    OR p.product_name like '%$search%'
                    OR p.price like '%$search%'
                    OR p.unit like '%$search%'
                    OR p.discount like '%$search%'
                   
                    OR co.color_name like '%$search%'
                    OR p.guarantee like '%$search%')  order by p.product_id asc";



            $sql = mysqli_query($conn, $query);
            //echo $sql;
            $num = mysqli_num_rows($sql);
            if ($num > 0) {
                echo "<div class='container product-show mt-5'>
                                <div class='row'>
                                    <div class='col-sm-12 main-product'>
                                        <div class='row'>

                                            <div class='col-sm-12 pb-3'>
                                            <h4 class='ml-2' style='font-size:18px;margin-left:12px; color:#00483d'>Sản phẩm bạn cần tìm là:</h4>
                                               
                                            </div>";

                foreach ($sql as $row) {
                    echo "<div class='col-12 col-lg-3 mt-2 col-6' class='aos-item' data-aos='zoom-in'>
                                        <div class='card'>
                                            <div class='card-body  rounded'style=' height:26rem' >
                                                <img class='card-img-bottom product-image' src='administration/img/$row[image_link]' alt='Card image' style='width:100%' height='150'>
                                                <hr>
                                                 <h4 class='card-title' style='font-size: 18px; text-align:center; font-weight: bold;'>$row[product_name]</h4>
                                                <h4 class='card-title' style='font-size: 18px; text-align:center; color: #000; font-weight: 400;'>" . adddotstring($row['price']) . " <span style='color:red'>VND</span></h4>
                                                
                                                 <a class='product-details pl-4 text-primary' style='text-decoration: none; cursor: bointer;' href='product_detail_unloged.php?product_id=$row[product_id]&catalog_id=$row[catalog_id]'> 
                                                <i class='fas fa-info-circle ' style='color:orange'></i> Chi tiết</a>
                                                <button class=btn text-success border-success' style='background-color:#00483d; color: white; float:right' onclick = 'notice()'>Cho vào giỏ</button>
                                               
                                            </div>
                                        </div>
                                    </div>";
                }
            } else {
                echo "<div class='container-fluid product-show mt-5'>
                                <div class='row'>
                                    <div class='col-sm-12 main-product'>
                                        <div class='row'>
                                        <div class='col-sm-4 pb-3 d-flex justify-content-center' >
                                                
                                            </div>

                                            <div class='col-sm-4 pb-3 d-flex justify-content-center' style='background-color:#00483d; border-radius:5px'>
                                                <p class='mt-4 text-white' style='font-weight:bold;; font-family:times; align-items:center; font-size:18px'>Xin lỗi sản phẩm bạn cần tìm không có</p>
                                            </div>
                                            <div class='col-sm-4 pb-3 d-flex justify-content-center' >
                                               
                                            </div>
                                         </div>
                                    </div>";
            }
        }
        ?>


    <div class="container mt-3 ">
        <div class=" row">

            <div class="col-sm-4">
                <h3 style="color:#00483d">TẤT CẢ SẢN PHẨM
                </h3>
            </div>

        </div>
    </div>
    <div class="container">
        <div class=" my-5">
            <div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner ">
                    <div class="carousel-item active text-center">
                        <div class="row">
                            <?php
                            $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');

                            $countProduct = mysqli_query($conn, " SELECT * FROM product where brand_id = '8' LIMIT 4");
                            ?>
                            <?php
                            $i = 0;
                            while ($row = mysqli_fetch_array($countProduct)) {
                            ?>
                            <div class="col-12 col-md-3">
                                <div class="card" style="border-radius: 10px;">
                                    <div class="card-body">
                                        <img class="img-fluid"
                                            src="./administration/img/<?php echo $row['image_link']; ?>" alt="">
                                        <p class="mt-3"><?php echo $row['product_name']; ?></p>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <?php
                                $i++;
                            }
                            ?>
                        </div>
                    </div>

                    <div class="carousel-item text-center">
                        <div class="row">
                            <?php
                            $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');

                            $countProduct = mysqli_query($conn, " SELECT * FROM product where brand_id = '1' LIMIT 4");
                            ?>
                            <?php
                            $i = 0;
                            while ($row = mysqli_fetch_array($countProduct)) {
                            ?>
                            <div class="col-12 col-md-3">
                                <div class="card" style="border-radius: 10px;">
                                    <div class="card-body">
                                        <img class="img-fluid"
                                            src="./administration/img/<?php echo $row['image_link']; ?>" alt="">
                                        <p class="mt-3"><?php echo $row['product_name']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php
                                $i++;
                            }
                            ?>
                        </div>
                    </div>

                    <div class="carousel-item text-center">
                        <div class="row">
                            <?php
                            $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');

                            $countProduct = mysqli_query($conn, " SELECT * FROM product where brand_id = '16' LIMIT 4");
                            ?>
                            <?php
                            $i = 0;
                            while ($row = mysqli_fetch_array($countProduct)) {
                            ?>
                            <div class="col-12 col-md-3">
                                <div class="card" style="border-radius: 10px;">
                                    <div class="card-body">
                                        <img class="img-fluid"
                                            src="./administration/img/<?php echo $row['image_link']; ?>" alt="">
                                        <p class="mt-3"><?php echo $row['product_name']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php
                                $i++;
                            }
                            ?>
                        </div>
                    </div>
                    <div class="carousel-item text-center">
                        <div class="row">
                            <?php
                            $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');

                            $countProduct = mysqli_query($conn, " SELECT * FROM product where brand_id = '30' LIMIT 4");
                            ?>
                            <?php
                            $i = 0;
                            while ($row = mysqli_fetch_array($countProduct)) {
                            ?>
                            <div class="col-12 col-md-3">
                                <div class="card" style="border-radius: 10px;">
                                    <div class="card-body">
                                        <img class="img-fluid"
                                            src="./administration/img/<?php echo $row['image_link']; ?>" alt="">
                                        <p class="mt-3"><?php echo $row['product_name']; ?></p>
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
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>



    <!-- Show Product for User -->
    <div class="container product-show mt-5">
        <div class="row">
            <div class="  col-sm-12 main-product">
                <div class="row">

                    <div class="col-sm-12 pb-3">

                    </div>
                    <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
                    $result = mysqli_query($conn, "SELECT * FROM product");
                    ?>


                    <?php
                    $i = 0;
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <div class="col-12 col-sm-3 mt-3" data-aos="fade-up">
                        <div class="card" style="border-radius: 12px;  height:26rem">
                            <div class="card-body ">
                                <img class="card-img-bottom"
                                    src='./administration/img/<?php echo $row["image_link"]; ?>' alt="Card
                                    image" style="width:100%" height="200">
                                <hr>
                                <h4 class="card-title product-name" style="font-size: 12px;">
                                    <?php echo $row["product_name"]; ?></h4>
                                <h4 class="card-title product-price text-center" style="font-size: 12px;">
                                    <?php echo adddotstring($row["price"]); ?> <span style="color: red;">VND</span>
                                </h4>


                                <a href="product_detail_unloged.php?product_id=<?php echo $row['product_id']; ?>&catalog_id=<?php echo $row['catalog_id']; ?>&brand_id=<?php echo $row['brand_id']; ?>"
                                    class="product-details" style="text-decoration: none;"><i class="fas fa-info-circle"
                                        style="color: orange;"></i>
                                    <a href="">


                                        <button class="btn text-white " style="float: right; background-color:#00483d"
                                            onclick="notice()">Thêm
                                            vào giỏ</button>
                                    </a>
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
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-2">
                <div class="icon" style="display: flex; 
                align-items: center;">
                    <i class="fas fa-shopping-cart " style="color:#00483d;font-size:70px; "></i>

                </div>
                <p style="text-align:center; font-weight: bold; font-family:times; font-size:15px; color:#00483d">Giỏ
                    hàng</p>
            </div>
            <div class="col-md-2 ">

                <div class="icon" style="display: flex;
                justify-content: center; align-items: center;">
                    <i class="fas fa-list-alt " style="color:#00483d;font-size:70px;"></i>
                </div>
                <p style="text-align:center;font-weight: bold; font-family:times; font-size:15px; color:#00483d">Đơn
                    hàng</p>
            </div>

            <div class="col-md-2 ">
                <div class="icon" style="display: flex;
                justify-content: center; align-items: center;"><i class="far fa-credit-card "
                        style="color:#00483d;font-size:70px;"></i></div>
                <p style="text-align:center;font-weight: bold; font-family:times; font-size:15px; color:#00483d">Thanh
                    toán</p>
            </div>

            <div class="col-md-2 ">
                <div class="icon"
                    style="display: flex;
                justify-content: center; align-items: center;font-weight: bold; font-family:times; font-size:15px; color:#00483d">
                    <i class="fas fa-check-double" style="color:#00483d;font-size:70px;"></i>

                </div>
                <p style="text-align:center;font-weight: bold; font-family:times; font-size:15px; color:#00483d">Xác
                    nhận</p>
            </div>
            <div class="col-md-2 ">
                <div class="icon" style="display: flex;
                justify-content: center; align-items: center;">
                    <i class="fas fa-truck " style="color:#00483d;font-size:70px;"></i>
                </div>
                <p style="text-align:center;font-weight: bold; font-family:times; font-size:15px; color:#00483d">Giao
                    hàng</p>
            </div>
            <div class="col-md-2 ">
                <div class="icon" style="display: flex;
                justify-content: center; align-items: center;">
                    <i class="fas fa-handshake " style="color:#00483d;font-size:70px;"></i>
                </div>
                <p style="text-align:center;font-weight: bold; font-family:times; font-size:15px; color:#00483d">Kết
                    thúc</p>

            </div>

        </div>

    </div>















    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>
    <script>
    AOS.init();
    </script>
    <?php include("./include/footer.php"); ?>
</body>

</html>

<script type="text/javascript">
function notice() {
    alert("Vui lòng đăng nhập để tiến hành mua hàng!");
}
</script>