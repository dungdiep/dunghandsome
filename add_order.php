<?php
$conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
if (isset($_POST["order"])) {

    if (isset($_POST['account_id']))
        $account_id = trim($_POST["account_id"]);
    else $account_id   = "";

    if (isset($_POST['product_id']))
        $product_id = trim($_POST["product_id"]);
    else $product_id   = "";

    if (isset($_POST['quantity']))
        $quantity = trim($_POST["quantity"]);
    else $quantity  = "";
    if (isset($_POST['price']))
        $price = trim($_POST["price"]);
    else $price  = "";

    //Kiểm tra điều kiện bắt buộc đối với các field không được bỏ trống
    if (
        $account_id == "" || $product_id == "" || $quantity ==
        "" || $price == ""
    ) {
        echo '<script>';
        echo 'alert("Vui lòng nhập đầy đủ thông tin.")';
        echo '</script>';
    } else {
        // Kiểm tra đã tồn tại chưa
        $sql = "SELECT * from order_item where product_id='$product_id' ";

        $user = mysqli_query($conn, $sql);

        if (mysqli_num_rows($user)  > 0) {
            echo "Thêm không thành công.";
        } else {
            //thực hiện việc lưu trữ dữ liệu vào database 
            $sql = "INSERT INTO order_item (order_id, account_id, product_id, quantity, price, status, deleteorder, date) 
            VALUES (NULL, '$account_id','$product_id','$quantity', '$price', '0', '0',Null)";

            $sql1 = "DELETE from cart ";
            // thực thi câu $sql với biến conn 

            mysqli_query($conn, $sql);
            mysqli_query($conn, $sql1);
            header('location: order.php');
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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>




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