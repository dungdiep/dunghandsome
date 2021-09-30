<?php
    $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');

    if(isset($_GET["change"])) {
        

        if(isset($_GET['cart_id']))  
            $cart_id= $_GET['cart_id']; 
        else $cart_id   = "";

        if(isset($_GET['quantity']))  
            $quantity= $_GET['quantity']; 
        else $quantity   = "1";

        if($cart_id == "" && $quantity =="")
        {
            "Vui lòng nhập giá trị...";
        }
        else
        {
            $sql = " UPDATE cart SET quantity='$quantity', total = price * quantity WHERE cart_id='$cart_id' ";

            if (mysqli_query($conn, $sql)) {
                header("location:cart.php");
            } 
            else 
            {
                echo '<script>';
                echo 'alert("Đã xảy ra lỗi.")';
                echo '</script>' . mysqli_error($conn);
            }
            
        }
        mysqli_close($conn);
    }
?>