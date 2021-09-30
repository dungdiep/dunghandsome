<?php
//Kiểm tra session nếu chưa đăng nhập thì quay vào trang login.php
session_start();
if (!isset($_SESSION['user'])) {
    header("location: login.php");
}
?>

<?php
$conn = mysqli_connect('localhost', 'root', '', 'onlineshop');

if (isset($_GET['product_id']))
    $product_id = trim($_GET['product_id']);
else $product_id   = "";

if (isset($_GET['catalog_id']))
    $catalog_id = trim($_GET['catalog_id']);
else $catalog_id   = "";

if (isset($_GET['brand_id']))
    $brand_id = trim($_GET['brand_id']);
else $brand_id   = "";

if (isset($_POST['product_name']))
    $product_name = $_POST['product_name'];
else $product_name   = "";

if (isset($_POST['price']))
    $price = $_POST['price'];
else $price   = "";

if (isset($_POST['unit']))
    $unit = $_POST['unit'];
else $unit   = "";

if (isset($_POST['Quantity']))
    $Quantity = $_POST['Quantity'];
else $Quantity   = "";
if (isset($_POST['content']))
    $content = $_POST['content'];
else $content   = "";

if (isset($_POST['discount']))
    $discount = $_POST['discount'];
else $discount   = "";

if (isset($_POST['image_link']))
    $image_link = $_POST['image_link'];
else $image_link   = "";

$qry = mysqli_query($conn, "SELECT 
p.product_id, p.product_name, p.price, p.unit, p.Quantity, 
p.content, p.discount, p.image_link, c.catalog_name, b.brand_name 
FROM product as p 
INNER JOIN catalog as c ON p.catalog_id = c.catalog_id 
INNER JOIN brand as b ON p.brand_id = b.brand_id 
where p.product_id ='$product_id' "); // select query

$rowss = mysqli_fetch_array($qry); // fetch data

if ($rowss) {
    mysqli_close($conn); // Close connection
} else {
}

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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>


<body>
    <?php
    include("include/header_loged.php");
    ?>

    <div class="modal fade mt-5" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <img class="rounded" style="cursor: zoom-in;" src="administration/img/<?php echo $rowss['image_link']; ?>"
                width="400" height="400">
        </div>
    </div>

    <form class="container mt-3" action="" method="post">
        <input type="text" name="product_id" value="<?php echo ($rowss['product_id']); ?> " style="display:none;">
        <input type="text" name="price" value="<?php echo $rowss["price"]; ?>" style="display:none;">
        <input type="text" name="number" value="1" style="display:none;">
        <h3 style="color:#000"><?php echo $rowss['product_name']; ?></h3>
        <div class="row">
            <div class="col-sm-3 image"> <a href="#" data-toggle="modal" data-target="#exampleModal"><img
                        style="cursor: zoom-in;" src="administration/img/<?php echo $rowss['image_link']; ?>"
                        width="250" height="290"></a>
            </div>
            <div class="col-sm-5">
                <h4 style="font-weight: 500; color: red;" class="mt-4"> <?php echo adddotstring($rowss['price']); ?> VND
                    <s style="color: grey;">
                    </s>
                </h4>
                <button disabled class="btn btn-success" style="padding: 5px 100px 5px 100px;"><i
                        class="fa fa-truck"></i>
                    Miễn phí vận chuyển toàn
                    quốc</button>

                <button class="btn bg-danger p-2 pl-3 pr-3" type="submit" name="buy"
                    style="width:30%; height:15%;  background-image: linear-gradient(#00483d, #008080);  box-shadow: 5px 5px lightgrey;">Mua
                    ngay</button>

            </div>
            <div class="col-sm-4">

                <h4 style="text-align: center;"> <i class="fas fa-cog"></i> Cấu hình máy</h4>
                <div style="border: 1px solid green; border-radius: 10px;" class="p-2">
                    <p style="font-size:16px"><?php echo $rowss['content'] ?></p>
                </div>

            </div>
        </div>

    </form>
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-5">
                <p style="font-family:times; font-weight:bold;font-size:20px" data-aos="flip-left">Sản phẩm liên quan
                </p>
                <div class=" row">
                    <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
                    $qrx = mysqli_query(
                        $conn,
                        "SELECT 
                        p.product_id,p.catalog_id, p.brand_id, p.product_name, p.price, p.unit, p.Quantity, 
                        p.content, p.discount, p.image_link, c.catalog_name, b.brand_name 
                        FROM product as p 
                        INNER JOIN catalog as c ON p.catalog_id = c.catalog_id 
                        INNER JOIN brand as b ON p.brand_id = b.brand_id 
                        where p.product_id !='$product_id'HAVING p.catalog_id = '$catalog_id' and p.brand_id = '$brand_id'  limit 0,4 "
                    ); // select query

                    ?>
                    <?php
                    $i = 0;
                    while ($row = mysqli_fetch_array($qrx)) {
                    ?>



                    <div class="col-sm-3" data-aos="flip-left">
                        <a
                            href="product_detail.php?product_id=<?php echo $row['product_id']; ?>&catalog_id=<?php echo $row['catalog_id']; ?>&brand_id=<?php echo $row['brand_id']; ?>">
                            <img src="administration/img/<?php echo $row['image_link']; ?>" width="100px" height="100px"
                                style="border-radius: 20px;"></a>
                        <p class="text-center text-muted"><?php echo $row['product_name']; ?></p>

                    </div>
                    <?php
                        $i++;
                    }
                    ?>
                </div>
            </div>


        </div>
    </div>

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
    <script>
    AOS.init();
    </script>
    <?php
    include("include/footer.php");
    ?>
</body>

</html>