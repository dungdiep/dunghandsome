<?php

//Kiểm tra session nếu chưa đăng nhập thì quay vào trang login.php
session_start();
if (!isset($_SESSION['User'])) {
    header("location: login_admin.php");
}
?>
<?php
require_once 'handing.php';
//lần đầu tiên là lấy dữ liệu để show
$rowsPerPage = 5; //số mẩu tin trên mỗi trang, giả sử là 10
if (!isset($_GET['page'])) {
    $_GET['page'] = 1;
}

//vị trí của mẩu tin đầu tiên trên mỗi trang
$offset = ($_GET['page'] - 1) * $rowsPerPage;
//lấy $rowsPerPage mẩu tin, bắt đầu từ vị trí $offset

$sql = 'SELECT p.product_id, p.product_name, p.price, p.unit, p.quantity, p.color_id, p.discount, p.image_link,p.guarantee,
c.catalog_id, c.catalog_name, b.brand_id, b.brand_name,co.color_id,co.color_name
from product as p inner join catalog as c on p.catalog_id = c.catalog_id 
inner join brand as b on p.brand_id = b.brand_id inner join color as co on co.color_id = p.color_id order by p.product_id asc

 LIMIT ' . $offset . ', ' . $rowsPerPage;
$data = getData($sql);


//Xóa dữ liệu

if (isset($_GET['id'])) {
    echo $_GET['id'];
    // mowr ket noi
    {
        $conn = new mysqli("localhost", "root", "", DATABASE);
        //câu lệnh muốn thực thi
        $sql = 'delete from product where product_id = "' . $_GET['id'] . '"';
        //thực thi câu lệnh
        mysqli_query($conn, $sql);
        //đóng kết nôi
        mysqli_close($conn);
        header("Location: product.php");
    }
}


// //tim kiếm


// if (isset($_POST['submit_tk'])) {
//     $timkiem = $_POST['timkiem'];
//     $conn = new mysqli("localhost", "root", "", DATABASE);

//     $sql =
//         'select  p.product_id, p.product_name, p.price, p.unit,  p.discount, p.image_link,p.guarantee,
// c.catalog_id, c.catalog_name, b.brand_id, b.brand_name
// from product as p inner join catalog as c on p.catalog_id = c.catalog_id 
// inner join brand as b on p.brand_id = b.brand_id 

//          where ( (product_name like "%' . $timkiem . '%") OR (catalog_name like  "%' . $timkiem . '%" ) 
//         OR (brand_name  "%' . $timkiem . '%" )
//         OR(price  like  "%' . $timkiem . '%" )
//         OR(unit like  "%' . $timkiem . '%   " )
//         OR(content like  "%' . $timkiem . '%" )
//         OR(discount like  "%' . $timkiem . '%" )
//         OR(image_link like  "%' . $timkiem . '%" )
//         OR( like guarantee  "%' . $timkiem . '%" ) ) order by p.product_id desc 
//         ';

//     mysqli_query($conn, $sql);
//     $data = getData($sql);
//     mysqli_close($conn);
// }

?>
<!-- PHP thêm sản phẩm -->
<?php
$conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
if (isset($_POST["submit"])) {
    //lấy thông tin từ các form bằng phương thức POST
    if (isset($_POST['id']))
        $id = trim($_POST["id"]);
    else $id   = "";

    if (isset($_POST['tsp']))
        $product_name = trim($_POST["tsp"]);
    else $product_name   = "";

    if (isset($_POST['lsp']))
        $catalog_id = trim($_POST["lsp"]);
    else $catalog_id   = "";

    if (isset($_POST['hsp']))
        $brand_id = trim($_POST["hsp"]);
    else $brand_id  = "";

    if (!empty($_POST['gsp'])) {
        $price = $_POST['gsp'];
    } else {
        echo 'Please select the value.';
    }

    if (!empty($_POST['dv'])) {
        $unit = $_POST['dv'];
    } else {
        echo 'Please select the value.';
    }
    if (!empty($_POST['mau'])) {
        $color_id = $_POST['mau'];
    } else {
        echo 'Please select the value.';
    }


    if (isset($_POST['nd']))
        $content = trim($_POST["nd"]);
    else $content  = "";

    if (isset($_POST['sl']))
        $quantity = trim($_POST["sl"]);
    else $quantity   = "";

    if (isset($_POST['asp']))
        $image_link = trim($_POST["asp"]);
    else $image_link   = "";

    if (isset($_POST['bh']))
        $guarantee = trim($_POST["bh"]);
    else $guarantee  = "";



    //Kiểm tra điều kiện bắt buộc đối với các field không được bỏ trống
    if (
        $product_name == "" || $catalog_id == "" || $brand_id == ""   || $price == ""
        || $unit == ""|| $quantity == ""|| $color_id == "" || $content == "" || $image_link == "" || $guarantee == ""
    ) {
        echo '<script>';
        echo 'alert("Vui lòng nhập đầy đủ thông tin.")';
        echo '</script>';
    } else {
        // Kiểm tra đã tồn tại chưa
        $sql = "SELECT * from product where product_name='$product_name' ";

        $user = mysqli_query($conn, $sql);

        if (mysqli_num_rows($user)  > 0) {
            echo "Thêm sản phẩm không thành công.";
        } else {
            //thực hiện việc lưu trữ dữ liệu vào database 
            $sql = "INSERT INTO product ( product_id, product_name, catalog_id, brand_id, price, unit, quantity, color_id ,content,  image_link, guarantee ) 
            VALUES ( NULL,'$product_name','$catalog_id','$brand_id', '$price', '$unit','$quantity ','$color_id' , '$content',  '$image_link', '$guarantee')";
            // thực thi câu $sql với biến conn 

            mysqli_query($conn, $sql);
            echo '<script language="javascript">';
            echo 'alert("Thêm sản phẩm thành công.")';
            echo '</script>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Category</title>
    <link href="./startbootstrap-sb-admin-gh-pages/css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous">
    </script>
    <style>
    .fa-edit {
        color: orange;
    }

    .fa-trash-alt {
        color: red;
    }

    input {
        border: 2px solid lightblue;
        border-radius: 6px;
        outline: none;

    }



    .modal-header {
        background-color: #008080;
    }

    .add {
        background-color: #008080;
    }

    #layoutSidenav_nav {
        background-color: #008080;
    }


    .sb-topnav {
        background-color: #008080;
    }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand ">
        <a class="navbar-brand text-white" href="admin.php" style="font-weight: 500;">QUẢN TRỊ VIÊN</a>

        <!-- Navbar Search-->

        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-md-0">

            <div class="dropdown">
                <a class="text-white"><i class="fas fa-user fa-fw text-white" style="font-weight: 500;"></i>
                    <?php echo $_SESSION['Fullname'] ?></a>
                <button type="button" class="btn btn-muted dropdown-toggle" data-toggle="dropdown">

                </button>

                <div class="dropdown-menu">

                    <a class="dropdown-item" href="logout_admin.php">Đăng xuất</a>
                </div>
            </div>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#!">Settings</a>
                <a class="dropdown-item" href="#!">Activity Log</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="login.html">Logout</a>
            </div>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion   " id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">



                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                            aria-expanded="false" aria-controls="collapsePages">

                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                            data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-toggle="collapse"
                                    data-target="#pagesCollapseAuth" aria-expanded="false"
                                    aria-controls="pagesCollapseAuth">
                                    Authentication
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                                    data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="login.html">Login</a>
                                        <a class="nav-link" href="register.html">Register</a>
                                        <a class="nav-link" href="password.html">Forgot Password</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse"
                                    data-target="#pagesCollapseError" aria-expanded="false"
                                    aria-controls="pagesCollapseError">
                                    Error
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                                    data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="401.html">401 Page</a>
                                        <a class="nav-link" href="404.html">404 Page</a>
                                        <a class="nav-link" href="500.html">500 Page</a>
                                    </nav>
                                </div>
                            </nav>
                        </div>
                        <a class="nav-link text-white" href="./admin.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-home "></i>
                            </div>
                            Trang chủ quản trị
                        </a>
                        <a class="nav-link text-white" href="./staffmanage.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-users text-white"></i></div>
                            Nhân viên
                        </a>
                        <a class="nav-link text-white" href="./customermanage.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-users text-white"></i></div>
                            Khách hàng
                        </a>

                        <a class="nav-link text-white" href="./category.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-sitemap text-white"></i></div>
                            Danh mục sản phẩm
                        </a>
                        <a class="nav-link text-white" href="./brand.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-sitemap text-white"></i></div>
                            Hãng sản phẩm
                        </a>
                        <a class="nav-link " href="./product.php" style="color:orange">
                            <div class="sb-nav-link-icon"><i class="fas fa-sitemap text-white"></i></div>
                            Sản phẩm
                        </a>
                        <a class="nav-link text-white" href="./color.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-palette text-white"></i></div>
                            Màu sắc
                        </a>
                        <a class="nav-link text-white" href="./slider.php">
                            <div class="sb-nav-link-icon"><i class="text-white fas fa-sliders-h"></i></div>
                            Slider
                        </a>
                        <a class="nav-link text-white" href="./order.php">
                            <div class="sb-nav-link-icon"><i class="text-white far fa-id-badge"></i></div>
                            Đơn hàng
                        </a>
                        <a class="nav-link text-white" href="./new.php">
                            <div class="sb-nav-link-icon"><i class="text-white far fa-newspaper"></i></div>
                            Tin tức
                        </a>
                        <a class="nav-link text-white" href="./orderannounce.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-bullhorn"></i></div>
                            Thông báo
                        </a>
                        <a class="nav-link text-white" href="./historytransaction.php">
                            <div class="sb-nav-link-icon"><i class="far fa-id-card"></i></div>
                            Lịch sử giao dịch
                        </a>








                    </div>
                </div>

            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">





                    <div class="card mb-4">
                        <div class="card-header">


                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <nav class="navbar navbar-expand-sm bg-light navbar-dark">
                                    <form class="form-inline" action="" method="get">
                                        <input name="search" class="form-control mr-sm-2" type="text"
                                            placeholder="Search">
                                        <button name="submit" class="btn btn-success" type="submit"><i
                                                class="fas fa-search"></i></button>
                                    </form>
                                    <a href="" data-toggle="modal" data-target="#addProduct"
                                        class="btn btn-warning ml-5 text-white">Thêm <i
                                            class="fas fa-plus-circle"></i></a>

                                </nav>

                                <div class="modal fade " id="addProduct" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content ">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"
                                                    style=" font-weight:bold; font-family:times">Thêm sản phẩm</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="container" action="" method="post">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="" style=" font-family:times">Tên sản
                                                                phẩm: </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group" style="margin: 0 auto;">
                                                                <input class="input ml-4" type="text" id="sp" class="sp"
                                                                    name="tsp" style="width: 80%">
                                                            </div>
                                                        </div>

                                                    </div>


                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <label for="" class="mt-2" style=" font-family:times">Tên
                                                                loại sản phẩm</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <?php 
                                            $sql1 = "SELECT * from catalog";
                                            $catalog = getData($sql1);
                                            ?>
                                                            <div class="form-group   mr-5">

                                                                <select style="width: 110%" class="form-control mt-2 "
                                                                    style="overflow: auto;" onfocus='this.size=5;'
                                                                    onblur='this.size=1;'
                                                                    onchange='this.size=1; this.blur();' name="lsp">
                                                                    <?php foreach($catalog as $value) { ?>
                                                                    <option value="<?php echo $value['catalog_id']?>">
                                                                        <?php echo ''.$value['catalog_name'].'' ?>
                                                                    </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <label for="" class="mt-2" style=" font-family:times">Tên
                                                                hãng sản phẩm</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <?php 
                                            $sql2 = "SELECT * from brand";
                                            $brand = getData($sql2);
                                            ?>
                                                            <div class="form-group  mr-5">

                                                                <select style="width: 110%" class="form-control mt-2"
                                                                    style="overflow: auto;" onfocus='this.size=5;'
                                                                    onblur='this.size=1;'
                                                                    onchange='this.size=1; this.blur();' name="hsp">
                                                                    <?php foreach($brand as $value) { ?>
                                                                    <option value="<?php echo $value['brand_id']?>">
                                                                        <?php echo ''.$value['brand_name'].'' ?>
                                                                    </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>




                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="" style=" font-family:times">Giá
                                                                sản phẩm: </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">

                                                                <input class="input ml-4" type="text" id="mncc"
                                                                    name="gsp" style="width: 80%">
                                                            </div>
                                                        </div>

                                                    </div>


                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="" style=" font-family:times">Đơn
                                                                vị: </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">

                                                                <input class="input ml-4" type="text" name="dv" id="anh"
                                                                    style="width: 80%">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="" style=" font-family:times">Mô
                                                                tả:
                                                            </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class=" form-group">

                                                                <textarea type="text" name="nd" id=""
                                                                    class="form-control" placeholder=""
                                                                    aria-describedby="helpId"
                                                                    style="width: 80%"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4"> <label for=""
                                                                style=" font-family:times">Số
                                                                lượng: </label></div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">

                                                                <input class="input ml-4" type="text" id="sl" name="sl"
                                                                    style="width: 80%">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <label for="" class="mt-2" style=" font-family:times">Màu
                                                                sắc sản phẩm
                                                                hãng sản phẩm</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <?php 
                                                         $sql3 = "SELECT * from color";
                                                         $color = getData($sql3);
                                                            ?>
                                                            <div class="form-group  mr-5">

                                                                <select style="width: 110%" class="form-control mt-2"
                                                                    style="overflow: auto;" onfocus='this.size=5;'
                                                                    onblur='this.size=1;'
                                                                    onchange='this.size=1; this.blur();' name="mau">
                                                                    <?php foreach($color as $value) { ?>
                                                                    <option value="<?php echo $value['color_id']?>">
                                                                        <?php echo ''.$value['color_name'].'' ?>
                                                                    </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="" style="font-family:times">Ảnh
                                                            sản phẩm: </label></br>
                                                        <input class="input ml-4" type="file" id="gb" name="asp">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="" style="font-family:times">Bảo
                                                                hành: </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">

                                                                <input class="input ml-4" type="text" id="gb" name="bh"
                                                                    style="width: 80%">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button class="add btn btn-success" name="submit"
                                                        type="submit">Thêm</button>

                                            </div>





                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <?php
                            $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
                            if (isset($_GET['submit']) && $_GET["search"] != '') {
                                $search = $_GET['search'];
                                $query = "select  p.product_id, p.product_name, p.price, p.unit,  p.discount, p.image_link,p.guarantee,
                                c.catalog_id, c.catalog_name, b.brand_id, b.brand_name
                                from product as p inner join catalog as c on p.catalog_id = c.catalog_id 
                                inner join brand as b on p.brand_id = b.brand_id 
                                    
                                    WHERE (p.product_id like '$search' 
                    OR p.product_name like '%$search%'
                    OR p.price like '%$search%'
                    OR p.unit like '%$search%'
                    OR p.discount like '%$search%'
                    OR p.image_link like '%$search%'
                    OR p.guarantee like '%$search%')  order by p.product_id asc";



                                $sql = mysqli_query($conn, $query);
                                //echo $sql;
                                $num = mysqli_num_rows($sql);
                                if ($num > 0) {
                                    echo '</br>';
                                    echo "&nbsp;&nbsp;&nbsp;&nbsp;" . $num . " kết quả tìm ra với <b>" . " ' " . $search . " ' " . "</b>";
                                    echo '<table class="table-bordered table-light mt-3 ml-1" cellspacing="1" cellpadding="5">';
                                    echo "<thead class='bg-success text-white'>
                                            <tr>
                                              <th scope='col' class='text-center'>Mã sản phẩm</th>
                                              <th scope='col' class='text-center'>Tên sản phẩm</th>
                                                 <th scope='col' class='text-center'>Loại sản phẩm</th>
                                              <th scope='col' class='text-center'>Hãng</th>
                                              <th scope='col' class='text-center'>Giá</th>
                                           
                                              <th scope='col' class='text-center'>Đơn vị</th>
                                              <th scope='col' class='text-center'>Khuyến mãi</th>
                                               <th scope='col' class='text-center'>Hình ảnh</th>
                                              <th scope='col' class='text-center'>Bảo hành</th>
                                              
                                              
                                             
                                             
                                            </tr>
                                        </thead>";
                                    foreach ($sql as $row) {
                                        echo "<tr class='table table-bordered'>";
                                        echo "<td class='text-center'>SP{$row['product_id']}</td>";
                                        echo "<td class='text-center'>{$row['product_name']}</td>";
                                        echo "<td class='text-center'>{$row['catalog_name']}</td>";
                                        echo "<td class='text-center'>{$row['brand_name']}</td>";
                                        echo "<td class='text-center'>{$row['price']}</td>";
                                        echo "<td class='text-center'>{$row['unit']}</td>";

                                        echo "<td class='text-center'>{$row['discount']}</td>";


                                        echo "<td><img src='../administration/img/$row[image_link]' width='60px;' height='60px;'
                                                            style='margin: 10px auto; border-radius: 10px;'></td>";
                                        echo "<td class='text-center'>{$row['guarantee']}</td>";


                                        echo "</tr>";
                                    }
                                    echo '</table>';
                                    echo "<hr class='type_5 ml-3'>";
                                } else {
                                    echo "&nbsp;&nbsp;&nbsp;&nbsp;" . "----" . " Không tìm thấy kết quả nào " . "-----";
                                }
                            }
                            ?>
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Mã sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Loại sản phẩm</th>
                                        <th>Hãng sản phẩm</th>
                                        <th>Giá thành</th>
                                        <th>Số lượng</th>
                                        <th>Màu sắc</th>
                                        <th>Đơn vị</th>


                                        <th>Hình ảnh</th>
                                        <th>Bảo hành</th>
                                        <th>Tùy chọn</th>


                                    </tr>
                                </thead>
                                <tbody>
                                <tbody>
                                    <?php




                                    foreach ($data as $value) {
                                        //to mau the dieu kien

                                        //  if($value[5] == '59 cong nghe thong tin 1'){
                                        echo '<tr">
                                  <td>' . 'SP' . $value['product_id'] . '</td>
                                <td>' . $value['product_name'] . '</td>
                                <td>' . $value['catalog_name'] . '</td>
                                <td>' . $value['brand_name'] . '</td>    
                                <td>' . $value['price'] . '</td>    
                                <td>' . $value['quantity'] . '</td>   
                                 <td>' . $value['color_name'] . '</td>   
                                <td>' . $value['unit'] . '</td>
                                
                              
                                <td><img src="img/' . $value[7] . '" width="100" height="100"></td>
                              <td>' . $value['guarantee'] . '</td>
                              
                                



                                <td class="text-center"> 
                                  
                                     <a href="editProduct.php?id=' . $value[0] . '" onclick="return confirm(\'Bạn có chắc chắn  muốn sửa sản phẩm này  không\')"> <i class="far fa-edit"></i></a> 
                                     <a href="?id=' . $value[0] . '"  onclick="return confirm(\'Bạn có chắc chắn  muốn xóa sản phẩm này  không\')"> <i class="far fa-trash-alt"></i></a> 
                                    
                                </td>
                               
                               
                            </tr>';
                                    }






                                    ?>
                                </tbody>
                                </tbody>




                            </table>
                            <?php
                            $conn = new mysqli("localhost", "root", "", DATABASE);
                            $re = mysqli_query($conn, 'select * from product');
                            //tổng số mẩu tin cần hiển thị
                            $numRows = mysqli_num_rows($re);
                            //tổng số trang
                            $maxPage = floor($numRows / $rowsPerPage) + 1;

                            echo "<div style='text-align: center'>";

                            if ($_GET['page'] > 1) {
                                echo "<a style='text-decoration: none;color: blue;' href=" . $_SERVER['PHP_SELF'] . "?page=" . (1) . "> Trang đầu </a>";
                                echo "<a style='text-decoration: none;color: blue;' href=" . $_SERVER['PHP_SELF'] . "?page=" . ($_GET['page'] - 1) . "> < </a> ";
                            }
                            for ($i = 1; $i <= $maxPage; $i++) {
                                if ($i == $_GET['page']) {
                                    echo '<b>' . $i . '</b> '; //trang hiện tại sẽ được bôi đậm
                                } else
                                    echo "<a style='text-decoration: none;color: blue;' href=" . $_SERVER['PHP_SELF'] . "?page=" . $i . ">" . $i . "</a> ";
                            }
                            if ($_GET['page'] < $maxPage) {
                                echo "<a style='text-decoration: none;color: blue;' href=" . $_SERVER['PHP_SELF'] . "?page=" . ($_GET['page'] + 1) . "> > </a>";
                                echo "<a style='text-decoration: none;color: blue;' href=" . $_SERVER['PHP_SELF'] . "?page=" . ($maxPage) . "> Trang cuối </a>";
                            }
                            echo "</div>";

                            echo '<div style="text-align: center">Tổng số trang: ' . $maxPage . '</div>';
                            ?>
                        </div>
                    </div>
                </div>
        </div>
        </main>

    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="./startbootstrap-sb-admin-gh-pages/assets/demo/chart-area-demo.js"></script>
    <script src="./startbootstrap-sb-admin-gh-pages/assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="./startbootstrap-sb-admin-gh-pages/assets/demo/datatables-demo.js"></script>
</body>


<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="./startbootstrap-sb-admin-gh-pages/assets/demo/chart-area-demo.js"></script>
<script src="./startbootstrap-sb-admin-gh-pages/assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="./startbootstrap-sb-admin-gh-pages/assets/demo/datatables-demo.js"></script>
</body>

</html>