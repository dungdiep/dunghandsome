<?php
//Kiểm tra session nếu chưa đăng nhập thì quay vào trang login.php
session_start();
if (!isset($_SESSION['user'])) {
    header("location:login.php");
}
?>

<?php
include('./include/header_loged.php')

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
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>

<style>

</style>


<body>
    <div class="container">
        <h4 style="text-align: center;">Giới thiệu TuyDungStore</h4>
        <div class="row">
            <div class="col-sm-5" data-aos="fade-right">
                <img src="./administration/img/b1938164af13de8b8c3a64ee3fcedd57.png" style="border-radius: 20px;" alt=""
                    width="70" height="70">
            </div>
            <div class="col-sm-2 " data-aos="fade-down">
                <img src="./administration/img/5cb4df79b88f7cc1e0c22b3dcff64955.png" style="border-radius: 20px;" alt=""
                    width="70" height="70">

            </div>
            <div class="col-sm-5" data-aos="fade-left">
                <img src="./administration/img/a8283e242caec48f69e306f9f0ec6a87.png" alt="" width="70" height="70"
                    style="border-radius: 20px; float:right" class="img" data-aos="flip-down">

            </div>
        </div>


    </div>
    <div class="container mt-2 p-5" style="font-family: Calibri">
        <p style="font-size: 18px; text-align: justify; color: #00483d ;">Cửa hàng <b>TuyDungStore</b> luôn mang đến
            những sản phẩm công
            nghệ
            chất lượng đến với tay
            của
            người tiêu dùng như: điện thoại,
            laptop, ipad, macbook. Nhân viên của cửa hàng sẽ tư vấn nhiệt tình và sẵn sàng giải đáp thắc mắc
            của
            khách hàng về sản phẩm trong thời gian làm việc của cửa hàng </p>
        <h4 style="color: #00483d;">Tiêu chí hoạt động của cửa hàng</h4>
        <p style="font-size: 18px; text-align: justify; color: #00483d;"><b>TuyDungStore</b> luôn luôn đặt sự tôn trọng
            khách hàng lên hàng
            đầu, nỗ lực hết mình để đạt được mục tiêu cao nhất là làm hài lòng người dùng thông qua các sản phẩm được
            cung cấp và dịch vụ khách hàng
        </p>
        <p style="font-size: 18px; text-align: justify; color: #00483d;">Đối với quý khách hàng, chúng tôi luôn đặt cái
            tâm làm gốc, làm
            việc với tinh thần nghiêm túc, trung thực và
            có trách nhiệm, để mang tới trải nghiệm dịch vụ tốt nhất. </p>


    </div>

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
    <script>
    AOS.init();
    </script>
</body>
<?php
include('./include/footer.php')

?>

</html>