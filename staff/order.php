<?php

session_start();
if (!isset($_SESSION['User'])) {
    header("location: ../administration/login_admin.php");
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
require_once '../administration/handing.php';
//lần đầu tiên là lấy dữ liệu để show
$rowsPerPage = 5; //số mẩu tin trên mỗi trang, giả sử là 10
if (!isset($_GET['page'])) {
    $_GET['page'] = 1;
}

//vị trí của mẩu tin đầu tiên trên mỗi trang

//lấy $rowsPerPage mẩu tin, bắt đầu từ vị trí $offset

$sql = 'SELECT o.order_id, o.product_id, o.quantity, o.price , o.status,
                            p.product_name,p.image_link, p.unit 
                            FROM order_item  as o INNER JOIN product as p ON o.product_id = p.product_id ';

$data = getData($sql);


//Xóa dữ liệu

if (isset($_GET['id'])) {
    echo $_GET['id'];
    // mowr ket noi
    {
        $conn = new mysqli("localhost", "root", "", DATABASE);
        //câu lệnh muốn thực thi
        $sql = 'delete from order_item where order_id = "' . $_GET['id'] . '"';
        //thực thi câu lệnh
        mysqli_query($conn, $sql);
        //đóng kết nôi
        mysqli_close($conn);
        header("Location: order_item.php");
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

    .input {
        width: 80%;
        border-radius: 4px;
        outline: blue;


    }

    #layoutSidenav_nav {
        background-color: #008080;
    }


    .sb-topnav {
        background-color: #008080;
    }

    label {
        color: green;
        font-weight: 500;
    }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar ">
        <a class="navbar-brand text-white" href="admin.php" style="font-weight:500">NHÂN VIÊN</a>

        <!-- Navbar Search-->

        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-md-0">

            <div class="dropdown">
                <a class="text-white"><i class="fas fa-user fa-fw text-white"></i>
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
            <nav class="sb-sidenav accordion " id="sidenavAccordion">
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

                        <a class="nav-link text-white" href="./customer.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-users text-white"></i></div>
                            Khách hàng
                        </a>

                        <a class="nav-link text-white" href="./product.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-sitemap text-white"></i></div>
                            Sản phẩm
                        </a>
                        <a class="nav-link text-white" href="./category.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-sitemap text-white"></i></div>
                            Danh mục sản phẩm
                        </a>
                        <a class="nav-link text-white" href="./brand.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-sitemap text-white"></i></div>
                            Hãng sản phẩm
                        </a>
                        <a class="nav-link text-white" href="./slider.php">
                            <div class="sb-nav-link-icon"><i class="text-white fas fa-sliders-h"></i></div>
                            Slider
                        </a>

                        <a class="nav-link " href="./order.php" style="color:orange">
                            <div class="sb-nav-link-icon"><i class="far fa-id-badge"></i></div>
                            Đơn hàng
                        </a>
                        <a class="nav-link text-white" href="./new.php">
                            <div class="sb-nav-link-icon"><i class="text-white far fa-newspaper"></i></div>
                            Tin tức
                        </a>









                    </div>,
                </div>

            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <div class="card mb-4">
                        <?php
                            $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');

                            if (isset($_GET['shipping']))
                                $shipping = $_GET['shipping'];
                            else $shipping   = "";

                            $edit = mysqli_query($conn, "update order_item set status ='1' where order_id='$shipping'");

                            if ($edit) {
                                    mysqli_close($conn);
                                } else {
                            }

                        ?>

                        <?php
                            $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
                            $result = mysqli_query($conn, "SELECT o.order_id, o.product_id,o.account_id, o.quantity, o.price , o.status, o.deleteorder,
                            p.product_name,p.image_link, p.unit , a.id, a.fullname, a.address
                            FROM order_item  as o INNER JOIN product as p ON o.product_id = p.product_id INNER JOIN account as a ON o.account_id= a.id
                            ");
                        ?>

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4 pl-4 pr-4">

                        </div>

                        <table class="table table-bordered mt-4">
                            <tr>
                                <td class="font-weight-bold text-center">Mã đơn hàng</td>
                                <td class="font-weight-bold text-center">Tên sản phẩm</td>
                                <td class="font-weight-bold text-center">Tên khách hàng</td>
                                <td class="font-weight-bold text-center">Đơn giá</td>
                                <td class="font-weight-bold text-center">Số lượng</td>
                                <td class="font-weight-bold text-center">Đơn vị</td>
                                <td class="font-weight-bold text-center">Hình ảnh</td>
                                <td class="font-weight-bold text-center">Duyệt đơn</td>
                                <td class="font-weight-bold text-center">Hành động</td>


                            </tr>

                            <?php
                            $i = 0;
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                            <tr class="<?php if (isset($classname)) echo $classname; ?>">
                                <form action="order_hangding.php" method="POST">
                                    <input type="text" name="id" value="<?php echo $row["account_id"]; ?>"
                                        style="display:none;">
                                    <input type="text" name="product_id" value="<?php echo $row["product_id"]; ?>"
                                        style="display:none;">
                                    <input type="text" name="address" value="<?php echo $row["address"]; ?>"
                                        style="display:none;">
                                    <input type="text" name="quantity" value="<?php echo $row["quantity"]; ?>"
                                        style="display:none;">
                                    <input type="text" name="price" value="<?php echo $row["price"]; ?>"
                                        style="display:none;">

                                    <td class="text-center"><?php echo "DH" . $row["order_id"]; ?></td>
                                    <td class="text-center"><?php echo $row["product_name"]; ?></td>
                                    <td class="text-center"><?php echo $row["fullname"]; ?></td>
                                    <td class="text-center"><?php echo adddotstring($row["price"]) ?></td>
                                    <td class="text-center"><?php echo $row["quantity"]; ?></td>
                                    <td class="text-center"><?php echo $row["unit"]; ?></td>
                                    <td class="text-center"><img class="img-fluid"
                                            src="img/<?php echo $row['image_link']; ?>" alt="" width="60" height="60">
                                    </td>
                                    <td class="text-center">
                                        <?php
                                            if ($row["status"] == 0 && $row["deleteorder"] == 0) {
                                                echo "<a onclick='return confirm_delete()' class='btn btn-danger' href='order.php?shipping=$row[order_id]' >Duyệt đơn</a>";
                                            } elseif ($row["status"] == 1 && $row["deleteorder"] == 0) {
                                                echo "<button disabled='disabled' class='btn btn-warning'>Đang giao</button>";
                                            } else {
                                                echo "<button disabled='disabled' class='btn btn-success'>Đã giao</button>";
                                            }
                                            ?>
                                    <td class="text-center">
                                        <?php
                                            if ($row["deleteorder"] == 0 && $row["status"] == 0) {
                                            } elseif ($row["deleteorder"] == 0 && $row["status"] == 1) {
                                            } else {
                                                echo "<button type='submit' name='submit' class='btn btn-warning' >Lưu đơn hàng</button>";
                                            }
                                            ?>




                            </tr>
                            <?php
                                $i++;
                            }
                            ?>
                            </form>



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