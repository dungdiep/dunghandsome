<?php
session_start();
?>
<?php
require_once 'handing.php';
//lần đầu tiên là lấy dữ liệu để show


$sql = 'SELECT * FROM product ';
$data = getData($sql);


//Xóa dữ liệu

if (isset($_GET['id'])) {
    echo $_GET['id'];
    // mowr ket noi
    {
        $conn = new mysqli("localhost", "root", "", DATABASE);
        //câu lệnh muốn thực thi
        $sql = 'delete from brand where brand_id = "' . $_GET['id'] . '"';
        //thực thi câu lệnh
        mysqli_query($conn, $sql);
        //đóng kết nôi
        mysqli_close($conn);
        header("Location: orderannounce.php");
    }
}


// //tim kiếm


// if (isset($_POST['submit_tk'])) {
//     $timkiem = $_POST['timkiem'];
//     $conn = new mysqli("localhost", "root", "", DATABASE);

//     $sql = 'select * from catalog
//         where ( (brand_name like "%' . $timkiem . '%")  
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
</head>
<style>
#layoutSidenav_nav {
    background-color: #008080;
}


.sb-topnav {
    background-color: #008080;
}
</style>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar ">
        <a class="navbar-brand text-white" style="font-weight:500" href="admin.php">QUẢN TRỊ VIÊN</a>

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
            <nav class="sb-sidenav " id="sidenavAccordion">
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
                        <a class="nav-link text-white" href="./product.php">
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
                        <a class="nav-link " href="./orderannounce.php" style="color:orange">
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





                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tên sản phẩm</th>
                                            <th>Hình ảnh</th>
                                            <th>Cảnh báo</th>
                                            <th>Nhập hàng</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tbody>
                                        <?php




                                        foreach ($data as $value) {
                                            //to mau the dieu kien

                                            if ($value[6] < 10) {
                                                echo '<tr">
                                <td>'  . $value[1] . '</td>
                              <td><img src="img/' . $value[10] . '" width="100" height="100"></td>
                              <td><p style="color:red">Sắp hết hàng rồi, yêu cầu nhập hàng</p></td>
                             

                                <td class="text-center"> 
                                  
                                     <a href="addProduct.php?id=' . $value[0] . '"><i class="fas fa-plus-square"></i></a> 
                                
                                    
                                </td>


                                
                               
                               
                            </tr>';
                                            } else {
                                            }
                                        }






                                        ?>
                                    </tbody>
                                    </tbody>




                                </table>

                            </div>
                        </div>
                        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
                            crossorigin="anonymous">
                        </script>
                        <script src="js/scripts.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
                            crossorigin="anonymous"></script>
                        <script src="./startbootstrap-sb-admin-gh-pages/assets/demo/chart-area-demo.js"></script>
                        <script src="./startbootstrap-sb-admin-gh-pages/assets/demo/chart-bar-demo.js"></script>
                        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"
                            crossorigin="anonymous"></script>
                        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"
                            crossorigin="anonymous"></script>
                        <script src="./startbootstrap-sb-admin-gh-pages/assets/demo/datatables-demo.js"></script>
</body>

</html>