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

$row = mysqli_fetch_array($qry); // fetch data

if ($row) {
    mysqli_close($conn); // Close connection
} else {
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
<style>

</style>

<body>
    <?php
    include("include/header.php");
    ?>
    <div class="modal fade mt-5" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <img class="rounded" style="cursor: zoom-in;" src="administration/img/<?php echo $row['image_link']; ?>"
                width="400" height="400">
        </div>
    </div>


    <form class="container mt-3" action="" method="post">
        <h4><?php echo $row['product_name']; ?></h4>
        <div class="row">
            <div class="col-sm-3 image"> <a href="#" data-toggle="modal" data-target="#exampleModal"><img
                        style="cursor: zoom-in;" src="administration/img/<?php echo $row['image_link']; ?>" width="250"
                        height="290"></a>
            </div>
            <div class="col-sm-5">
                <h4 style="font-weight: 500; color: red;"> <?php echo adddotstring($row['price']); ?> VND <s
                        style="color: grey;">
                    </s></h4>
                <button disabled class="btn btn-success" style="padding: 5px 100px 5px 100px;"><i
                        class="fa fa-truck"></i>
                    Miễn phí vận chuyển toàn
                    quốc</button>

                <button class="btn text-white p-2 pl-3 pr-3 mt-3 " onclick="notice()"
                    style="width:30%; height:15%;  background-image: linear-gradient(#00483d, #008080); box-shadow: 5px 5px lightgrey;">Mua
                    ngay</button>

            </div>
            <div class="col-sm-4">
                <h4 style="text-align: center;"><i class="fas fa-cog mr-2"></i>Cấu hình máy</h4>
                <div style="border: 1px solid green; border-radius: 10px;" class="p-2">
                    <p><?php echo $row['content'] ?></p>
                </div>

            </div>
        </div>

    </form>


    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <p style="font-family:times; font-weight:bold;font-size:20px" data-aos="flip-left">Sản phẩm liên quan
                </p>

                <div class="row">
                    <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
                    $qrx = mysqli_query(
                        $conn,
                        "SELECT 
                        p.product_id,p.catalog_id,p.brand_id, p.product_name, p.price, p.unit, p.Quantity, 
                        p.content, p.discount, p.image_link, c.catalog_name, b.brand_name 
                        FROM product as p 
                        INNER JOIN catalog as c ON p.catalog_id = c.catalog_id 
                        INNER JOIN brand as b ON p.brand_id = b.brand_id 
                        where p.product_id !='$product_id'HAVING p.catalog_id = '$catalog_id' and p.brand_id = '$brand_id' limit 0,4 "
                    ); // select query

                    ?>
                    <?php
                    $i = 0;
                    while ($row = mysqli_fetch_array($qrx)) {
                    ?>



                    <div class="col-sm-3 " data-aos="flip-left">
                        <a
                            href="product_detail_unloged.php?product_id=<?php echo $row['product_id']; ?>&catalog_id=<?php echo $row['catalog_id']; ?>&brand_id=<?php echo $row['brand_id']; ?>">
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


    <?php
    include('include/footer.php')

    ?>


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
    <script>
    AOS.init();
    </script>
</body>

</html>
<script type="text/javascript">
function notice() {
    alert("Vui lòng đăng nhập để tiến hành mua hàng!");
}
</script>