<?php
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="administration/css/header.css">
    <link rel="stylesheet" href="administration/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <style>
    body {

        background-color: white;
        color: black;
        font-size: 25px;
    }

    .dark-mode {
        background-color: #A8A5A5;
        transition: .5s;

    }

    .phone {
        list-style: none;
    }

    .row {
        display: -ms-flexbox;
        /* IE10 */
        display: flex;
        -ms-flex-wrap: wrap;
        /* IE10 */
        flex-wrap: wrap;
        margin: 0 -16px;
    }

    .col-25 {
        -ms-flex: 25%;
        /* IE10 */
        flex: 25%;
    }

    .col-50 {
        -ms-flex: 50%;
        /* IE10 */
        flex: 50%;
    }

    .col-75 {
        -ms-flex: 75%;
        /* IE10 */
        flex: 75%;
    }

    .col-25,
    .col-50,
    .col-75 {
        padding: 0 16px;
    }


    input[type=text] {
        width: 100%;
        margin-bottom: 20px;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    label {
        margin-bottom: 10px;
        display: block;
    }

    .icon-container {
        margin-bottom: 20px;
        padding: 7px 0;
        font-size: 24px;
    }

    .btn {
        background-color: #04AA6D;
        color: white;
        padding: 12px;
        margin: 10px 0;
        border: none;
        width: 100%;
        border-radius: 3px;
        cursor: pointer;
        font-size: 17px;
    }

    .btn:hover {
        background-color: #45a049;
    }

    span.price {
        float: right;
        color: grey;
    }

    /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (and change the direction - make the "cart" column go on top) */
    @media (max-width: 800px) {
        .row {
            flex-direction: column-reverse;
        }

        .col-25 {
            margin-bottom: 20px;
        }
    }

    .tooltip {
        position: relative;
        display: inline-block;
        border-bottom: 1px dotted black;
    }

    .tooltip .tooltiptext {
        visibility: hidden;
        width: 120px;
        background-color: #555;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px 0;
        position: absolute;
        z-index: 1;
        bottom: 125%;
        left: 50%;
        margin-left: -60px;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .tooltip .tooltiptext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #555 transparent transparent transparent;
    }

    .tooltip:hover .tooltiptext {
        visibility: visible;
        opacity: 1;
    }

    .menuIcon :hover {
        color: grey;
    }

    li:hover {
        color: grey;
    }
    </style>

</head>

<body>

    <div class="top-navigaton">

        <ul class="navigation">


            <li class="menuitem"><a class="linkitem introduce" style="text-decoration: none;" href="introduce.php">Giới
                    thiệu</a></li>

            <?php
                $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
                $countOrder  = mysqli_query($conn, " SELECT count(1) as SUM FROM order_item ");
            ?>
            <?php
                $i = 0;
                while ($rows = mysqli_fetch_array($countOrder)) {
            ?>

            <?php 
                if ($rows[0] == 0) {
                    echo '<li class="menuitem">
                                <a class="linkitem search" style="text-decoration: none;" onclick="notice()">Tra cứu đơn
                                    hàng</a>
                            </li>';
                }
                else{
                    echo '<li class="menuitem">
                                <a class="linkitem search" style="text-decoration: none;" href="order.php">Tra cứu đơn
                                    hàng</a>
                            </li>';
                }
            ?>

            <?php
                $i++;
            }
            ?>

            <li class="menuitem"><a class="linkitem login" style="text-decoration: none;" href="infor.php"><i
                        class="far fa-user"></i>
                    <?php echo $_SESSION['fullname'] ?></a>
            </li>


            <li class="menuitem"><a class="linkitem login" style="text-decoration: none;" href="logout.php"><i
                        class="fas fa-sign-out-alt"></i></i>
                    Đăng xuất</a>
            </li>
            <li class="menuitem"><a onclick="myFunction()"><i class="far fa-lightbulb"></i></a></li>
        </ul>
    </div>
    <div class="container">
        <form action="" method="get">
            <div class="searchandcartbar container">

                <a href="index.php"> <img class="logo" src="administration/img/logotuydung.png" alt=""></a>
                <input style="border-radius: 15px; border: 0px;" class="searchbar" name="search" type="text"
                    placeholder="Hôm nay bạn cần tìm gì? ">
                <div class="gg">

                    <button type="submit" name="submit" class=" btn-search"><i class="fas fa-search"></i></button>
                    <?php
                $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
                $count = mysqli_query($conn,"SELECT count(1) FROM cart");
                $sum = mysqli_query($conn,"SELECT sum(total) FROM cart");
            ?>
                    <?php
                $i=0;
                while($row = mysqli_fetch_array($sum)) {
                ?>

                    <a href="cart.php" class="btn-transport pt-3" style="text-decoration: none; color: white;"
                        data-toggle="tooltip"
                        title="Giỏ hàng của bạn có giá trị <?php echo adddotstring($row[0]); ?> đồng"><i
                            class="fas fa-shopping-cart" style="color: white; font-size: 20px;"></i>
                        <?php
                $i++;
                }
                ?>
                        <?php
                        $countcart  = mysqli_query($conn, " SELECT count(1) as SUM FROM cart ");
                        ?>

                        <?php
                        $i = 0;
                        while ($rows = mysqli_fetch_array($countcart)) {
                        ?>
                        <span style="font-weight: bold; font-size: 13px;"><?php echo $rows[0]; ?></span>
                        <?php
                            $i++;
                        }
                        ?>
                    </a>

                </div>
            </div>

        </form>




    </div>



    <div class="container sticky-top">
        <div class="taskbar">
            <div class="active separate">
                <div class=" menuIcon "><a href="phone_loged.php" style="text-decoration: none;" class="text-white"><i
                            class="  fas fa-mobile-alt  "></i></a>
                </div>
                <a href="phone_loged.php" class="phone" style="text-decoration: none;">
                    <li>ĐIỆN THOẠI</li>
                </a>

            </div>



            <div class="active separate">
                <div class="menuIcon"><a href="smartwatch_loged.php" style="text-decoration: none;"
                        class="text-white"><i class="far fa-clock"></i></a>
                </div>
                <a href="smartwatch_loged.php" style="text-decoration: none;">
                    <li>ĐỒNG HỒ</li>
                </a>
            </div>

            <div class="active separate">
                <div class="menuIcon"> <a href="laptop_loged.php" style="text-decoration: none;" class="text-white"><i
                            class="fas fa-laptop-code"></a></i>
                </div>
                <a href="laptop_loged.php" style="text-decoration: none;">
                    <li>LAPTOP</li>
                </a>
            </div>
            <div class="active separate">
                <div class="menuIcon"> <a href="macbook_loged.php" style="text-decoration: none;" class="text-white"><i
                            class=" fas fa-laptop"></a></i>
                </div>
                <a href="macbook_loged.php" style="text-decoration: none;">
                    <li>MACBOOK</li>
                </a>
            </div>

            <div class="active separate">
                <div class="menuIcon"> <a href="tablet_loged.php" style="text-decoration: none;" class="text-white"><i
                            class=" fas fa-tablet-alt"></i></a>
                </div>
                <a href="tablet_loged.php" style="text-decoration: none;">
                    <li>TABLET</li>
                </a>
            </div>
            <div class="active separate">
                <div class="menuIcon"> <a href="speaker_loged.php" style="text-decoration: none;" class="text-white"><i
                            class="fas fa-volume-down"></i></a>
                </div>
                <a href="speaker_loged.php" style="text-decoration: none;">
                    <li>LOA</li>
                </a>
            </div>
            <div class="active separate">
                <div class="menuIcon"> <a href="headphone_loged.php" style="text-decoration: none;"
                        class="text-white"><i class="fas fa-headphones-alt"></i></a>
                </div>
                <a href="headphone_loged.php" style="text-decoration: none;">
                    <li>TAI NGHE</li>
                </a>
            </div>

            <div class="active separate">
                <div class="menuIcon"><a href="new_loged.php" style="text-decoration: none;" class="text-white"><i
                            class=" far fa-newspaper"></i></a>
                </div>
                <a href="new_loged.php" style="text-decoration: none;">
                    <li>TIN TỨC</li>
                </a>
            </div>



        </div>
    </div>


    <script>
    function myFunction() {
        var element = document.body;
        element.classList.toggle("dark-mode");
    }
    </script>
</body>

</html>


</script>

<script type="text/javascript">
function notice() {
    alert("Đơn hàng trống!");
}
</script>