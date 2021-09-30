<?php
    $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
    if (isset($_POST["submit"])) {

        if(isset($_POST['product_id']))  
            $product_id = $_POST['product_id'];
        else $product_id   ="";

        if(isset($_POST['id']))  
            $account_id = $_POST['id'];
        else $account_id   ="";

        if(isset($_POST['address']))  
            $address = $_POST['address'];
        else $address   ="";

        if(isset($_POST['quantity']))  
            $quantity = $_POST['quantity'];
        else $quantity   ="";

        if(isset($_POST['price']))  
            $price = $_POST['price'];
        else $price   ="";

        //Kiểm tra điều kiện bắt buộc đối với các field không được bỏ trống
        if ($product_id == "" || $quantity == "" || $address == "" || $account_id == "" || $price == "")  
        {
        }
        else
        {
            //thực hiện việc lưu trữ dữ liệu vào database
            $sql = "INSERT INTO `transaction`(`transaction_id`, `id`,  `product_id`, `address`, `quantity`, `earn`, `date`) 
            VALUES (NULL, '$account_id', '$product_id', '$address', '$quantity',  '$price', NULL)";

            $sql2 = "DELETE FROM order_item";

            $sql3 = "UPDATE product set quantity= quantity - '$quantity' where product_id='$product_id'";
            // thực thi câu $sql với biến conn 
            mysqli_query($conn,$sql);
            mysqli_query($conn,$sql2);
            mysqli_query($conn,$sql3);
            header("location:order.php");
            mysqli_close($conn);
            
        }
    }
?>