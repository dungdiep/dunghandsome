<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../administration/css/home.css">


</head>
<style>
body {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 20px;
}

#myBtn {
    display: none;
    position: fixed;
    bottom: 20px;
    right: 30px;
    z-index: 99;
    font-size: 18px;
    border: none;
    outline: none;
    background-color: #37A191;
    color: white;
    cursor: pointer;
    padding: 15px;
    border-radius: 4px;
    width: 50px;
    height: 50px;
}

#myBtn:hover {
    background-color: #555;
}
</style>


<body>

    <footer class="container footer text-center text-lg-start ">
        <!-- Section: Social media -->

        <!-- Section: Social media -->

        <!-- Section: Links  -->

        <div class="container text-center text-md-start " style="background-color: #00483d; border-radius:5px ">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-6 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4 text-white mt-4" style="text-align:justify">
                        Liên hệ
                    </h6>
                    <p class="text-white" style="text-align:left "><i class="fas fa-home me-3 text-white"></i>
                        Số nhà 03, đường Bà Huyện Thanh Quan, phường Ba Ngòi,thành phố Cam Ranh, tỉnh Khánh Hòa</p>
                    <p class="text-white" style="text-align:left ">
                        <i class="fas fa-envelope me-3"></i>
                        dungdt1511@gmail.com
                    </p>
                    <p class="text-white" style="text-align:left "><i class="fas fa-phone me-3"></i> (84) 378 186
                        047</p>

                </div>

                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4 text-white  mt-4" style="text-align:left">
                        Thanh toán
                    </h6>
                    <div class="row">
                        <div class="col-sm-6 ">
                            <img src="./administration/img/logo-visa.png" alt="">
                        </div>
                        <div class="col-sm-6">
                            <img src="./administration/img/logo-vnpay.png" alt="">
                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-6">
                            <img src="./administration/img/logo-samsungpay.png" alt="">
                        </div>
                        <div class="col-sm-6">
                            <img src="./administration/img/logo-atm.png" alt="">
                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-6">
                            <img src="./administration/img/logo-master.png" alt="">
                        </div>
                        <div class="col-sm-6">
                            <img src="./administration/img/logo-jcb.png" alt="">
                        </div>

                    </div>


                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-4 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4 text-white  mt-4">
                        Vận chuyển
                    </h6>
                    <div class="col-md-12">
                        <img src="./administration/img/vnpost.jpg" alt="">

                    </div>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->

                <!-- Grid column -->
            </div>


            <!-- Grid row -->
        </div>


        <!-- Section: Links  -->

        <!-- Copyright -->


        <!-- Copyright -->
    </footer>
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-angle-up"></i></button>


    <script>
    //Get the button
    var mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
    </script>




</body>

</html>