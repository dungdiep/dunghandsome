<?php

//Kiểm tra session nếu chưa đăng nhập thì quay vào trang login.php
session_start();
if (!isset($_SESSION['User'])) {
    header("location: login_admin.php");
}
?>
<?php
require_once './administration/handing.php';

 
$sql = ' SELECT c.cart_id, c.product_id, c.price, c.total, c.quantity, p.unit, p.image_link, p.product_name,
                                        p.price FROM cart as c INNER JOIN product as p ON c.product_id = p.product_id order by c.cart_id asc ';
$data = getData($sql);


//Xóa dữ liệu

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

    #layoutSidenav_nav {
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

    .sb-topnav {
        background-color: #008080;
    }
    </style>
</head>

<body class="sb-nav-fixed">
    <main>
        <div class="container-fluid">
            <table class="table table-bordered" width="100%" cellspacing="0" style="border: 2px solid black">
                <thead>
                    <tr>
                        <th>Mã giỏ hàng</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá tiền</th>
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

                                 <td>' . 'MGH' . $value['cart_id'] . '</td>
                                 
                                <td>' . $value['product_name'] . '</td>
                                <td>' . $value['quantity'] . '</td>
                                <td>' . $value['price'] . '</td>
                             
                                <td>
                                
                                     <a href="?id=' . $value[0] . '"  onclick="return confirm(\'Bạn có chắc chắn  muốn xóa khách hàng này  không\')"> <i class="far fa-trash-alt"></i></a> 
                                </td>
                            
                               
                            </tr>';
                                        }






                                        ?>
                </tbody>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous">
    </script>
    <script src="./startbootstrap-sb-admin-gh-pages/assets/demo/chart-area-demo.js"></script>
    <script src="./startbootstrap-sb-admin-gh-pages/assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous">
    </script>
    <script src="./startbootstrap-sb-admin-gh-pages/assets/demo/datatables-demo.js"></script>
</body>

</html>