<?php
$conn = mysqli_connect('localhost', 'root', '', 'onlineshop');

if (isset($_GET['new_id']))
    $new_id = trim($_GET['new_id']);
else $new_id   = "";

$qry = mysqli_query($conn, "SELECT * from new where new_id = '$new_id'  "); // select query

$row = mysqli_fetch_array($qry); // fetch data

if ($row) {
    mysqli_close($conn); // Close connection
} else {
}
?>
<?php
include('./include/header.php')

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>
<style>

</style>

<body>


    <!-- Show Product for User -->
    <div class="container product-show mt-5">
        <div class="col-md-5 mt-2">
            <a href="index.php" style="text-decoration: none; color: #00483d; font-weight: 500;"><i
                    class="fas fa-home mr-1" style="color: #00483d;"></i>Trang chủ </a>
            <a href="new.php" style="text-decoration: none; color: #00483d; font-weight: 500;"><i
                    class="fas fa-chevron-right mr-1 ml-1"></i>Tin tức</a>
        </div>
        <div class="row">
            <div class="col-sm-12 main-product">
                <div class="row">

                    <div class="col-sm-12 pb-3">

                    </div>
                    <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
                    $result = mysqli_query($conn, "SELECT * FROM new  ");
                    ?>

                    <?php
                    $i = 0;
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <div class="col-12 col-3 col-sm-4 mt-2 " data-aos="fade-up">
                        <div class="card" style="border-radius: 8px;">
                            <div class="card-body ">
                                <img class="img-fluid rounded" src="administration/img/<?php echo $row['new_img']; ?>"
                                    alt="">
                                <hr>
                                <p></p><?php echo $row["new_title"]; ?></p>
                                <p></p><?php echo $row["new_content"]; ?></p>



                                <a href="new_detail.php?new_id=<?php echo $row['new_id']; ?>" class="new"
                                    style="text-decoration: none;">Xem
                                    thêm</a>

                            </div>
                        </div>
                    </div>
                    <?php
                        $i++;
                    }
                    ?>

                </div>
            </div>
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