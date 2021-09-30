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
        background-color: #676464;
        transition: .9s;
    }

    .phone {
        list-style: none;
    }

    .menuIcon :hover {
        color: grey;
    }

    li:hover {
        color: grey;
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
    </style>

</head>

<body>

    <div class="top-navigaton">
        <ul class="navigation">

            <li class="menuitem"><a class="linkitem introduce" href="introduce.php">Giới
                    thiệu</a></li>



            <li class="menuitem"><a class="linkitem login" href="./Login.php">Đăng nhập</a></li>
            <li class="menuitem"><a onclick="myFunction()"><i class="far fa-lightbulb"></i></a></li>


        </ul>
    </div>

    <div class="container">
        <form action="" method="get">
            <div class="searchandcartbar container">

                <a href="index.php"> <img class="logo" src="administration/img/logotuydung.png" alt=""></a>
                <input class="searchbar " name="search" type="text" placeholder="Hôm nay bạn cần tìm gì? ">
                <div class="gg">
                    <button type="submit" name="submit" class=" btn-search"><i class="fas fa-search"></i></button>

                    <button class="btn-transport " data-toggle="tooltip"
                        title="Chưa đăng nhập không thể vào xem giỏ hàng"><i class="fas fa-shopping-cart"
                            style="color: white; font-size: 20px; float:left" onclick="notice()"></i>
                        <span style="font-weight: bold; font-size: 10px;" class="mt-5">Giỏ hàng</span></button>

                </div>
            </div>

        </form>



    </div>



    <div class="container sticky-top">
        <div class="taskbar">
            <div class="active separate">
                <div class=" menuIcon "><a href="phone.php" class="text-white"><i class="  fas fa-mobile-alt  "></i></a>
                </div>
                <a href="phone.php" style="text-decoration: none;" class="phone">
                    <li>ĐIỆN THOẠI</li>
                </a>

            </div>



            <div class="active separate">
                <div class="menuIcon"><a href="smartwatch.php" class="text-white"><i class="far fa-clock"></i></a>
                </div>
                <a href="smartwatch.php" style="text-decoration: none;">
                    <li>ĐỒNG HỒ</li>
                </a>
            </div>

            <div class="active separate">
                <div class="menuIcon"> <a href="laptop.php" class="text-white"><i class=" fas fa-laptop-code"></a></i>
                </div>
                <a href="laptop.php" style="text-decoration: none;">
                    <li>LAPTOP</li>
                </a>
            </div>
            <div class="active separate">
                <div class="menuIcon"> <a href="macbook.php" class="text-white"><i class=" fas fa-laptop"></a></i>
                </div>
                <a href="macbook.php" style="text-decoration: none;">
                    <li>MACBOOK</li>
                </a>
            </div>

            <div class="active separate">
                <div class="menuIcon"> <a href="tablet.php" class="text-white"><i class=" fas fa-tablet-alt"></i></a>
                </div>
                <a href="tablet.php" style="text-decoration: none;">
                    <li>TABLET</li>
                </a>
            </div>
            <div class="active separate">
                <div class="menuIcon"> <a href="speaker.php" class="text-white"><i class="fas fa-volume-down"></i></a>
                </div>
                <a href="speaker.php" style="text-decoration: none;">
                    <li>LOA</li>
                </a>
            </div>
            <div class="active separate">
                <div class="menuIcon"> <a href="headphone.php" class="text-white"><i
                            class="fas fa-headphones-alt"></i></a>
                </div>
                <a href="headphone.php" style="text-decoration: none;">
                    <li>TAI NGHE</li>
                </a>
            </div>


            <div class="active separate">
                <div class="menuIcon"><a href="new.php" class="text-white"><i class=" far fa-newspaper"></i></a>
                </div>
                <a href="new.php" style="text-decoration: none;">
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

<script type="text/javascript">
function notice() {
    alert("Vui lòng đăng nhập để tiến hành mua hàng!");
}
</script>