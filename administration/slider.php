<?php
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

$sql = 'SELECT * FROM slider LIMIT ' . $offset . ', ' . $rowsPerPage;
$data = getData($sql);


//Xóa dữ liệu

if (isset($_GET['id'])) {
    echo $_GET['id'];
    // mowr ket noi
    {
        $conn = new mysqli("localhost", "root", "", DATABASE);
        //câu lệnh muốn thực thi
        $sql = 'delete from slider where id_image = "' . $_GET['id'] . '"';
        //thực thi câu lệnh
        mysqli_query($conn, $sql);
        //đóng kết nôi
        mysqli_close($conn);
        header("Location: slider.php");
    }
}


//tim kiếm


// if (isset($_POST['submit_tk'])) {
//     $timkiem = $_POST['timkiem'];
//     $conn = new mysqli("localhost", "root", "", DATABASE);

//     $sql = 'select * from catalog
//         where ( (catalog_name like "%' . $timkiem . '%")  
//         ';


//     mysqli_query($conn, $sql);
//     $data = getData($sql);
//     mysqli_close($conn);
// }

?>
<?php
$conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
if (isset($_POST["submit"])) {
    //lấy thông tin từ các form bằng phương thức POST
    if (isset($_POST['id']))
        $id = trim($_POST["id"]);
    else $id   = "";
 if (isset($_POST['name_image']))
        $name_image = trim($_POST["name_image"]);
    else $name_image   = "";
    
    if (isset($_POST['image']))
        $image = trim($_POST["image"]);
    else $image   = "";

    


    //Kiểm tra điều kiện bắt buộc đối với các field không được bỏ trống
    if (
        $name_image == "" || $image == "" 
    ) {
        echo '<script>';
        echo 'alert("Vui lòng nhập đầy đủ thông tin.")';
        echo '</script>';
    } else {
        // Kiểm tra đã tồn tại chưa
        $sql = "SELECT * from slider where  name_image='$name_image' ";

        $user = mysqli_query($conn, $sql);

        if (mysqli_num_rows($user)  > 0) {
            echo "Thêm slder không thành công.";
        } else {
            //thực hiện việc lưu trữ dữ liệu vào database 
            $sql = "INSERT INTO slider ( id_image, name_image, image ) 
            VALUES ( NULL,'$name_image','$image')";
            // thực thi câu $sql với biến conn 

            mysqli_query($conn, $sql);
            echo '<script language="javascript">';
            echo 'alert("Thêm slider thành công.")';
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
</head>
<style>
#layoutSidenav_nav {
    background-color: #008080;
}


.sb-topnav {
    background-color: #008080;
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

.fa-edit {
    color: orange;
}

.fa-trash-alt {
    color: red;
}
</style>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar">
        <a class="navbar-brand text-white" href="index.html" style="font-weight:500"> QUẢN TRỊ VIÊN</a>
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

        </form>
        <!-- Navbar Search-->


        <!-- Navbar-->
        <ul class="navbar-nav mr-auto mr-md-0">

            <div class="dropdown">
                <a class="text-white"><i class="fas fa-user fa-fw text-white"></i>
                    <?php echo $_SESSION['Fullname'] ?></a>
                <button type="button" class="btn btn-muted dropdown-toggle" data-toggle="dropdown">

                </button>

                <div class="dropdown-menu">

                    <a class="dropdown-item" href="./login_admin.php">Đăng xuất</a>
                </div>
            </div>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#!">Settings</a>
                <a class="dropdown-item" href="#!">Activity Log</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout_admin.php">Logout</a>
            </div>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion" id="sidenavAccordion">
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
                        <a class="nav-link " href="./slider.php" style="color:orange">
                            <div class="sb-nav-link-icon"><i class="text-white fas fa-sliders-h"></i></div>
                            Slider
                        </a>
                        <a class="nav-link text-white" href="./order.php">
                            <div class="sb-nav-link-icon">
                                <i class="text-white far fa-id-badge"></i>
                            </div>
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
                                <div class="modal fade" id="addProduct" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Thêm slider</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="container" action="" method="post">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="" style="font-family:times">Tên
                                                                slider </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">

                                                                <input class="input ml-4" type="text" id="gb"
                                                                    name="name_image">
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="" style="font-family:times">Ảnh
                                                            slider </label></br>
                                                        <input class="input ml-4" type="file" id="gb" name="image">
                                                    </div>









                                                    <button class="add btn btn-success" name="submit"
                                                        type="submit">Thêm</button>

                                            </div>





                                            </form>
                                        </div>

                                    </div>
                                </div>



                                <?php
                                $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
                                if (isset($_GET['submit']) && $_GET["search"] != '') {
                                    $search = $_GET['search'];
                                   

                                    $query = "select * from brand
                                    
                                    WHERE (brand_id like '$search' 
                    
                                    OR brand_name like '%$search%' )  order by brand_id asc";




                                    $sql = mysqli_query($conn, $query);
                                    //echo $sql;
                                    $num = mysqli_num_rows($sql);
                                    if ($num > 0) {
                                        echo '</br>';
                                        echo "&nbsp;&nbsp;&nbsp;&nbsp;" . $num . " kết quả tìm ra với <b>" . " ' " . $search . " ' " . "</b>";
                                        echo '<table class="table-bordered table-light mt-3 ml-1" cellspacing="1" cellpadding="5">';
                                        echo "<thead class='bg-success text-white'>
                                            <tr>
                                              <th scope='col' class='text-center'>Mã loại sản phẩm</th>
                                              <th scope='col' class='text-center'>Tên loại sản phẩm</th>
                                        
                                            </tr>
                                        </thead>";
                                        foreach ($sql as $row) {
                                            echo "<tr class='table table-bordered'>";
                                            echo "<td class='text-center'>MHSP{$row['brand_id']}</td>";
                                            echo "<td class='text-center'>{$row['brand_name']}</td>";
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
                                            <th>Mã slider</th>
                                            <th>Tên slider</th>
                                            <th>Hình ảnh</th>
                                            <th class="text-center">Tùy chọn</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tbody>
                                        <?php




                                        foreach ($data as $value) {
                                            //to mau the dieu kien

                                            //  if($value[5] == '59 cong nghe thong tin 1'){
                                            echo '<tr">
                                <td>' . 'MSLD' . $value[0] . '</td>
                                <td>'  . $value[1] . '</td>
                                 <td><img src="img/' . $value[2] . '" width="100" height="100"></td>
                                


                                <td class="text-center"> 
                                    
                                      <a href="?id=' . $value[0] . '"  onclick="return confirm(\'Bạn có chắc chắn  muốn xóa hãng sản phẩm này  không\')"> <i class="far fa-trash-alt"></i></a> 
                                    
                                </td>
                               
                               
                            </tr>';
                                        }






                                        ?>
                                    </tbody>
                                    </tbody>




                                </table>
                                <?php
                                $conn = new mysqli("localhost", "root", "", DATABASE);
                                $re = mysqli_query($conn, 'select * from slider');
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

</html>