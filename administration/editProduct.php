<?php
//Kiểm tra session nếu chưa đăng nhập thì quay vào trang login.php
session_start();
if (!isset($_SESSION['User'])) {
    header("location: login_admin.php");
}
?>
<?php
$conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
mysqli_set_charset($conn,'utf8');

require_once 'handing.php';

if (isset($_GET['id']))
    $id = $_GET['id'];
else $id = "";

if (isset($_POST['id']))
    $id = $_POST['id'];

$sql = 'select * from product
            where product_id = "' . $id . '"
    ';
$datanv = getData($sql);
foreach ($datanv as $value) {
    $product_name = $value[1];
    $catalog_id= $value[2];
    $brand_id= $value[3];
    $price = $value[4];
    $quantity = $value[6];
  
     $image_link=$value[10];
}

if (isset($_POST['update'])) {

     
    $anh_sanpham = '';
    if (!empty($_FILES['image_link'])) {
            $file = $_FILES['image_link'];
            $ten_anh = $file['name'];
            $anh_sanpham = $ten_anh;
        }

    if (
        
        !empty($_POST['product_name'])
        && !empty($_POST['catalog_id'])
         &&!empty($_POST['brand_id'])
       
        && !empty($_POST['price'])
        && !empty($_POST['quantity'])
         && !empty($_FILES['image_link'])
         
          
    ) {
        
       
        $product_name = $_POST['product_name'];

        $catalog_id = $_POST['catalog_id'];
        $brand_id = $_POST['brand_id'];
       
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        

        $conn = new mysqli("localhost", "root", "", DATABASE);
        $sqlUpdate = 'update product set product_name = "' . $product_name . '", catalog_id = "' . $catalog_id . '"
        ,brand_id = "' . $brand_id . '", price = "' . $price . '", 
               quantity ="' . $quantity . '",image_link ="' . $anh_sanpham . '"  where  product_id= "' . $id . '" ';
       
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

.heading {
    background-color: #008080;
}

.edit-form {
    border: 0px 5px solid black 0px 5px;

}
}
</style>


<body>
    <div class="heading ">
        <h4 style="font-family:times">Sửa Sản Phẩm</h4>
    </div>


    <form action="" class="mt-5  edit-form" method="post" enctype="multipart/form-data"
        style=" width: 100%; height:700px;margin: 0 auto; border-radius: 10px; ">

        <div class="row">
            <div class="col-md-3">
                <label class="mt-3" for="" style="margin-left: 35px;color: #008080; font-weight: bold;">Tên sản
                    phẩm</label>
            </div>
            <div class="col-md-9">
                <div class="form-group col-md-12">

                    <input type="text" name="product_name" id="" class="form-control mr-5"
                        value="<?php echo $product_name ?>" placeholder="" aria-describedby="helpId "
                        style="width: 60%;  ">

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <label for="" class="mt-3" style="margin-left: 35px;color: #008080; font-weight: bold;">Tên loại sản
                    phẩm</label>
            </div>
            <div class="col-md-9">
                <?php 
        $sql1 = "SELECT * from catalog";
        $catalog = getData($sql1);
        ?>
                <div class="form-group ml-5 mr-5">

                    <select style="width: 60%" class="form-control " style="overflow: auto;" onfocus='this.size=5;'
                        onblur='this.size=1;' onchange='this.size=1; this.blur();' name="catalog_id">
                        <?php foreach($catalog as $value) { ?>
                        <option value="<?php echo $value['catalog_id']?>"><?php echo ''.$value['catalog_name'].'' ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <label for="" class="mt-3" style="margin-left: 35px;color: #008080; font-weight: bold;">Tên hãng sản
                    phẩm</label>
            </div>
            <div class="col-md-9">
                <?php 
        $sql2 = "SELECT * from brand";
        $brand = getData($sql2);
        ?>
                <div class="form-group  ml-5 mr-5">

                    <select style="width: 60%" class="form-control " style="overflow: auto;" onfocus='this.size=5;'
                        onblur='this.size=1;' onchange='this.size=1; this.blur();' name="brand_id">
                        <?php foreach($brand as $value) { ?>
                        <option value="<?php echo $value['brand_id']?>"><?php echo ''.$value['brand_name'].'' ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"><label for="" class="mt-3"
                    style="margin-left: 35px;color: #008080; font-weight: bold;">Giá sản
                    phẩm</label></div>
            <div class="col-md-9">
                <div class="form-group col-md-12">

                    <input type="text" name="price" id="" class="form-control" value="<?php echo $price ?>"
                        placeholder="" aria-describedby="helpId" style="width: 60%;">

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <label for="" class="mt-3" style="margin-left: 35px;color: #008080; font-weight: bold;">Số lượng sản
                    phẩm</label>
            </div>
            <div class="col-md-9">
                <div class="form-group col-md-12">

                    <input type="text" name="quantity" id="" class="form-control" value="<?php echo $quantity ?>"
                        placeholder="" aria-describedby="helpId" style="width: 60%;">

                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-3"> <label for="" class="mt-3"
                    style="margin-left: 35px;color: #008080; font-weight: bold;">Ảnh
                    sản phẩm</label></div>
            <div class="col-md-9">
                <div class="form-group col-md-12">

                    <input type="file" name="image_link" id="" class="form-control" placeholder=""
                        aria-describedby="helpId" style="width: 60%">
                    <img src="<?php echo 'img/'.$image_link.'';?>" width="50px" height="50px" lalt="">

                </div>
            </div>
        </div>


        <button class="btn btn ml-4 text-white" type="submit" name="update">Sửa</button>
        <?php echo '<input type="hidden" name="id" value="' . $id . '"/>'; ?>
        <button class="btn btn" style="margin-left: 20px;"> <a style="color:white; text-decoration: none;"
                href="product.php">Quay về</a></button>

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