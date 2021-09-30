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
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.html"></a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->


        <!-- Navbar-->
        <ul class="navbar-nav mr-auto mr-md-0">

            <div class="dropdown">
                <a class="text-white"><i class="fas fa-user fa-fw text-white"></i> Diệp Túy Dũng</a>
                <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown">

                </button>

                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Thông tin cá nhân</a>
                    <a class="dropdown-item" href="#">Đổi mật khẩu</a>
                    <a class="dropdown-item" href="#">Đăng xuất</a>
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
            <nav class="sb-sidenav accordion bg-success" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <h4 class="text-white">Quản trị viên</h4>



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
                            <div class="sb-nav-link-icon"><i class="fas fa-home text-white"></i></div>
                            Trang chủ quản trị
                        </a>
                        <a class="nav-link text-white" href="./staffmanage.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-users text-white"></i></div>
                            Quản lý nhân viên
                        </a>
                        <a class="nav-link text-white" href="./customermanage.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-users text-white"></i></div>
                            Quản lý khách hàng
                        </a>

                        <a class="nav-link text-white" href="./product.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-sitemap text-white"></i></div>
                            Quản lý sản phẩm
                        </a>
                        <a class="nav-link text-white" href="./category.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user text-white"></i></div>
                            Quản lý danh mục
                        </a>

                        <a class="nav-link text-white" href="./brand.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-code-branch text-white"></i></div>
                            Quản lý hãng sản phẩm
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
                                <a href="./addProduct.php"><i class="fas fa-plus"></i></a>
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
                                    </tbody>




                                </table>
                                <?php
                                $conn = new mysqli("localhost", "root", "", DATABASE);
                                $re = mysqli_query($conn, 'select * from account');
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
                                </d iv>
                            </div>
                        </div>
                    </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2021</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
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