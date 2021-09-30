<?php

//Kiểm tra session nếu chưa đăng nhập thì quay vào trang login.php
session_start();
if (!isset($_SESSION['User'])) {
    header("location: login_admin.php");
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
        $result = substr($result, 1, $len + 2);
    }
    return $result;
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

$sql = 'SELECT * FROM account where level=0 LIMIT ' . $offset . ', ' . $rowsPerPage;
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
        header("Location: staffmanage.php");
    }
}


//tim kiếm


// if (isset($_POST['submit_tk'])) {
//     $timkiem = $_POST['timkiem'];
//     $conn = new mysqli("localhost", "root", "", DATABASE);

//     $sql =
//         'select * from product
//          where ( (catalog_id like "%' . $timkiem . '%") OR (product_name like  "%' . $timkiem . '%" ) 
//         OR (price like  "%' . $timkiem . '%" )
//         OR(content  like  "%' . $timkiem . '%" )
//         OR(discount like  "%' . $timkiem . '%   " )
//         OR(image_link like  "%' . $timkiem . '%" )
//         OR(guarantee like  "%' . $timkiem . '%" )
//         OR(accessories like  "%' . $timkiem . '%" )
//         OR(status like  "%' . $timkiem . '%" )
//         OR(special like  "%' . $timkiem . '%" ) )
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
    <title>Dashboard - SB Admin</title>
    <link href="./startbootstrap-sb-admin-gh-pages/css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous">
    </script>
</head>
<style>
.sb-sidenav {
    background-color: #008080;
}

.sb-topnav {
    background-color: #008080;
}
</style>

<body class="sb-nav-fixed">
    <nav class="sb-topnav  navbar navbar-expand  ">
        <a class="navbar-brand text-white" href="admin.php" style="font-weight: 500;">QUẢN TRỊ VIÊN</a>

        <!-- Navbar Search-->

        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-md-0">

            <div class="dropdown">
                <a class="text-white"><i class="fas fa-user fa-fw text-white"></i>
                    <?php echo $_SESSION['Fullname'] ?></a>
                <button type="button" class="btn btn-muted dropdown-toggle" data-toggle="dropdown">

                </button>

                <div class="dropdown-menu">
                    <a class="dropdown-item" href="./infor.php">Thông tin cá nhân</a>
                    <a class="dropdown-item" href="changepassword.php">Đổi mật khẩu</a>
                    <a class="dropdown-item" href="./logout_admin.php">Đăng xuất</a>
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

                        <a class="nav-link " href="./admin.php" style="color:orange">
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
                        <a class="nav-link text-white" href="./product.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-sitemap text-white"></i></div>
                            Sản phẩm
                        </a>
                        <a class="nav-link text-white" href="./color.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-palette text-white"></i></div>
                            Màu sắc
                        </a>
                        <a class="nav-link text-white" href="./slider.php">
                            <div class="sb-nav-link-icon"><i class="text-white fas fa-sliders-h"></i></i></div>
                            Slider
                        </a>

                        <a class="nav-link text-white" href="./order.php">
                            <div class="sb-nav-link-icon"><i class="far fa-id-badge"></i></div>
                            Đơn hàng
                        </a>
                        <a class="nav-link text-white" href="./new.php">
                            <div class="sb-nav-link-icon"><i class="far fa-newspaper  text-white"></i></i></div>
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


                    <div class="row mt-3">
                        <div class="col-md-6">

                            <div class="card   text-black mb-4"
                                style="background-color: lightgray; border-left: 5px solid orange">
                                <div class="row">
                                    <div class="col-md-2">

                                    </div>

                                    <div class="col-md-8">
                                        <div class="card-body" style="text-align: center;">Tổng số sản phẩm</div>

                                        <?php
                                $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');

                                $countProduct = mysqli_query($conn, " SELECT count(1) as SUM FROM product ");
                                ?>

                                        <?php
                                $i = 0;
                                while ($row = mysqli_fetch_array($countProduct)) {
                                ?><h3 style="text-align: center; font-family:times"><?php echo $row[0]; ?></h3>
                                        <?php
                                    $i++;
                                }
                                ?>

                                    </div>
                                    <div class="col-md-2 mt-4">
                                        <img src="./img/product-135-781070.png" alt="" width="50" height="50">
                                    </div>


                                </div>



                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card text-black mb-4"
                                style="background-color: lightgray;border-left:5px solid green">
                                <div class="row">
                                    <div class="col-md-2">

                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body" style="text-align: center;">Tổng số hãng sản phẩm
                                        </div>
                                        <?php
                                $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');

                                $countorder  = mysqli_query($conn, " SELECT count(1) as SUM FROM brand  ");


                                ?>

                                        <?php
                                $i = 0;
                                while ($row = mysqli_fetch_array($countorder)) {
                                ?><h3 style="text-align: center; font-family:times"><?php echo $row[0]; ?></h3>
                                        <?php
                                    $i++;
                                }
                                ?>
                                    </div>
                                    <div class="col-md-2 mt-4">
                                        <img src="./img/product-135-781070.png" alt="" width="50" height="50">

                                    </div>

                                </div>



                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card text-black mb-4"
                                style="background-color: lightgray;border-left:5px solid purple">
                                <div class="row">
                                    <div class="col-md-2">

                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body" style="text-align: center;">Tổng số loại sản phẩm</div>
                                        <?php
                                $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');

                                $countorder  = mysqli_query($conn, " SELECT count(1) as SUM FROM catalog  ");


                                ?>

                                        <?php
                                $i = 0;
                                while ($row = mysqli_fetch_array($countorder)) {
                                ?><h3 style="text-align: center; font-family:times"><?php echo $row[0]; ?></h3>
                                        <?php
                                    $i++;
                                }
                                ?>
                                    </div>
                                    <div class="col-md-2 mt-4">
                                        <img src="./img/product-135-781070.png" alt="" width="50" height="50">

                                    </div>

                                </div>



                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card text-black mb-4"
                                style="background-color: lightgray;border-left:5px solid brown">
                                <div class="row">
                                    <div class="col-md-2">

                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body" style="text-align: center;">Tổng số sản phẩm đã bán</div>
                                        <?php
                                $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');

                                $countorder  = mysqli_query($conn, " SELECT sum(quantity) from transaction   ");


                                ?>

                                        <?php
                                $i = 0;
                                while ($row = mysqli_fetch_array($countorder)) {
                                ?><h3 style="text-align: center; font-family:times"><?php echo $row[0]; ?></h3>
                                        <?php
                                    $i++;
                                }
                                ?>
                                    </div>
                                    <div class="col-md-2 mt-4">
                                        <img src="./img/product-135-781070.png" alt="" width="50" height="50">

                                    </div>

                                </div>



                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-8">
                            <div class="card text-black mb-4"
                                style="background-color: lightgray; border-left:5px solid red">
                                <div class="row">
                                    <div class="col-md-3">

                                    </div>
                                    <div class="col-md-6">
                                        <div class="card-body" style="text-align: center; ">Thống kê doanh thu</div>
                                        <?php
                                $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');

                                $sumProduct  = mysqli_query($conn, " SELECT sum(earn) as SUM FROM transaction");


                                ?>

                                        <?php
                                $i = 0;
                                while ($row = mysqli_fetch_array($sumProduct)) {
                                ?><h3 style="text-align: center; font-family:times;">
                                            <?php echo adddotstring ($row[0]); ?><span> VND</span>
                                        </h3>
                                        <?php
                                    $i++;
                                }
                                ?>
                                    </div>
                                    <div class="col-md-2 mt-4">
                                        <img src="./img/thongke.png" alt="" width="50" height="50">
                                    </div>

                                </div>


                            </div>
                        </div>
                        <div class="col-md-3">

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <h4>Nhập tháng muốn xem doanh thu</h4>



                            <form action="" method="get">
                                <nav class="navbar navbar-expand-sm bg-light navbar-dark">
                                    <form class="form-inline" action="" method="get">
                                        <input name="income" class="form-control mr-sm-2" type="number" placeholder=""
                                            min="1" step="1" max="12">
                                        <button type="submit" name="statistical" class="btn btn-success"><i
                                                class="fas fa-search"></i></button>
                                    </form>

                                </nav>
                            </form>


                        </div>
                        <?php
                            $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
                            if (isset( $_GET['statistical']) && $_GET["income"] != '') 
                            {
                                $earn = $_GET['income'];
                                $query = "SELECT sum(earn) FROM transaction WHERE month(date) = '$earn'";

                                $sql = mysqli_query($conn, $query);
                                //echo $sql;
                                $num = mysqli_num_rows($sql);
                                if ($num > 0) {
                                    echo "<div class='col-xl-3 col-md-6 mb-4'>
                                                    <div class='card border-left-muted shadow h-100 py-2'>
                                                        <div class='card-body'>
                                                            <div class='row no-gutters align-items-center'>
                                                                <div class='col mr-2'>";
                        
                                    foreach( $sql as $row ) {
                                        echo "<div class='text-xs font-weight-bold text-primary text-uppercase mb-1'>
                                                DOANH THU THÁNG $earn/2021</div>
                                                <div class='h5 mb-0 text-success font-weight-bold'>".adddotstring($row['sum(earn)'])."<span style='color:red'> VND</span>";
                                    }
                                } 
                                else {
                                    echo "<div class='text-xs font-weight-bold text-success text-uppercase mb-1'>
                                                DOANH THU THEO THÁNG
                                                </div>
                                                <div class='h5 mb-0 font-weight-bold text-gray-800'>Không có dữ liệu</div>";
                                }
                                    echo "</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>";
                            }
                        ?>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>






                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tên tài khoản</th>
                                    <th>Họ và tên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Giáng chức</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php




                                        foreach ($data as $value) {
                                            //to mau the dieu kien

                                            //  if($value[5] == '59 cong nghe thong tin 1'){
                                            echo '<tr">
                                  <td>' . $value['username'] . '</td>
                                <td>' . $value['fullname'] . '</td>
                                <td>' . $value['email'] . '</td>
                                <td>' . $value['phone'] . '</td>    
                                <td>' . $value['address'] . '</td> 
                   <td><a href="demote_appoint/demote.php?id=' . $value['id'] . ' ">  <img src="./img/demote.png"
                                            width="50" height="50"></a></td>

                                        </tr>';
                                        }






                                        ?>

                            </tbody>
                        </table>
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

</html>