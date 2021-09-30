<?php
//Kiểm tra session nếu chưa đăng nhập thì quay vào trang login.php
session_start();
if (!isset($_SESSION['user'])) {
    header("location:login.php");
}
?>
<?php
include('./include/header_loged.php')
?>
<?php
$conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
$result = mysqli_query($conn, "select * from product  
where catalog_id='14'");
?>

<?php
$conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
if (isset($_POST["buy"])) {
    //lấy thông tin từ các form bằng phương thức POST
    if (isset($_POST['product_id']))
        $product_id = $_POST['product_id'];
    else $product_id   = "";

    if (isset($_POST['number']))
        $number = $_POST['number'];
    else $number   = "";

    if (isset($_POST['price']))
        $price = $_POST['price'];
    else $price   = "";


    //Kiểm tra điều kiện bắt buộc đối với các field không được bỏ trống
    if ($product_id == "" || $number == "" || $price == "") {
    } else {
        // Kiểm tra tài khoản đã tồn tại chưa
        $sql = "SELECT * from cart where product_id='$product_id'";
        $user = mysqli_query($conn, $sql);

        if (mysqli_num_rows($user)  > 0) {
            echo '<script language="javascript">';
            echo 'alert("Mua hàng không thành công.")';
            echo '</script>';
        } else {
            //thực hiện việc lưu trữ dữ liệu vào database
            $sql = "INSERT INTO cart (cart_id, product_id, price, quantity, total) 
                                                VALUES (NULL, '$product_id', '$price', '$number', price * quantity)";
            // thực thi câu $sql với biến conn 
            mysqli_query($conn, $sql);
            echo '<script language="javascript">';
            echo 'alert("Mua hàng thành công.")';
            echo '</script>';
            mysqli_close($conn);
        }
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
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>

<body>

    <div class="container">
        <div class="col-md-5 mt-2">
            <a href="success.php" style="text-decoration: none; color: #00483d; font-weight: 500;"><i
                    class="fas fa-home mr-1" style="color: #00483d;"></i>Trang chủ </a>
            <a href="speaker_loged.php" style="text-decoration: none; color: #00483d; font-weight: 500;"><i
                    class="fas fa-chevron-right mr-1 ml-1"></i>Loa</a>
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
                                               
                                            </div>";

                foreach ($sql as $row) {
                    echo "<div class='col-12 col-lg-3 mt-2 col-6' class='aos-item' data-aos='zoom-in'>
                                        <div class='card'>
                                            <div class='card-body  rounded'  style='height: 26rem'>
                                                <img class='card-img-bottom product-image' src='administration/img/$row[image_link]' alt='Card image' style='width:100%' height='150'>
                                                <hr>
                                                 <h4 class='card-title' style='font-size: 18px; text-align:center; font-weight: bold;'>$row[product_name]</h4>
                                                <h4 class='card-title' style='font-size: 18px; text-align:center; color: #000; font-weight: 400;'>" . adddotstring($row['price']) . " <span style='color:red'>VND</span></h4>
                                                
                                                 <a class='product-details pl-4 text-primary ' style='text-decoration: none; cursor: bointer; float:left' href='product_detail_unloged.php?product_id=$row[product_id]&catalog_id=$row[catalog_id]'> 
                                                <i class='fas fa-info-circle ' style='color:orange; ' ></i> </a>
                                                <button class=btn text-success border-success' style='background-color:#00483d; color: white; float:right' onclick = 'notice()'>Mua hàng</button>
                                               
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


        <!-- Show Product for User -->
        <div class="container-fluid product-show mt-5">
            <div class="row">
                <div class="col-sm-12 main-product">
                    <div class="row">



                        <?php
                        $i = 0;
                        while ($row = mysqli_fetch_array($result)) {
                        ?>

                        <div class="col-12 col-sm-3 mt-2 " data-aos="flip-up">
                            <div class="card" style="border-radius: 8px;">
                                <div class="card-body ">
                                    <form action="" method="post">
                                        <input type="text" name="product_id"
                                            value="<?php echo ($row['product_id']); ?> " style="display:none;">
                                        <input type="text" name="price" value="<?php echo $row["price"]; ?>"
                                            style="display:none;">
                                        <input type="text" name="number" value="1" style="display:none;">
                                        <img class="card-img-bottom"
                                            src='./administration/img/<?php echo $row["image_link"]; ?>' alt="Card
                                    image" style="width:100%" height="200">
                                        <hr>
                                        <h4 class="card-title product-name" style="font-size: 12px;">
                                            <?php echo $row["product_name"]; ?></h4>
                                        <h4 class="card-title product-price text-center" style="font-size: 12px;">
                                            <?php echo adddotstring($row["price"]); ?> <span
                                                style="color: red;">VND</span>
                                        </h4>


                                        <a href="product_detail.php?product_id=<?php echo $row['product_id']; ?>&catalog_id=<?php echo $row['catalog_id']; ?>&brand_id=<?php echo $row['brand_id']; ?>"
                                            class="product-details" style="text-decoration: none;"><i
                                                class="fas fa-info-circle" style="color: chocolate;"></i> </a>
                                        <a href="">


                                            <button class="btn text-white" type="submit" name="buy"
                                                style="float: right;  background-color:#00483d ">Mua
                                                hàng</button>
                                        </a>
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


            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
                crossorigin="anonymous">
            </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
                integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
                crossorigin="anonymous">
            </script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
                integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
                crossorigin="anonymous">
            </script>
            </script>
            <script>
            AOS.init();
            </script>


</body>


</html>
<script type="text/javascript">

</script>
<?php
include('./include/footer.php')
?>