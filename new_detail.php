<?php
$conn = mysqli_connect('localhost', 'root', '', 'onlineshop');

if (isset($_GET['new_id']))
    $new_id = trim($_GET['new_id']);
else $new_id   = "";

$qry = mysqli_query($conn, "SELECT * from new where new_id ='$new_id' "); // select query

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
</head>
<style>

</style>

<body>
    <div class="container">

        <div class="col-md-5 mt-2">
            <a href="index.php" style="text-decoration: none; color: #00483d; font-weight: 500;"><i
                    class="fas fa-home mr-1" style="color: #00483d;"></i>Trang chủ </a>

        </div>

    </div>
    <form action="" method="post">
        <div class="container mt-3 mb-3">
            <div class="row">
                <div class="col-md-4">
                    <img class="img-fluid rounded" src="administration/img/<?php echo $row['new_img']; ?>" alt=""
                        width="350" height="350" style="box-shadow: 2px 2px 20px #00483d;">
                </div>

                <div class="col-md-8 container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="text-uppercase text-center" style="font-size: 15px; color: black;">
                                <?php echo $row["new_title"]; ?></p>
                        </div>

                        <div class="col-lg-12">
                            <p style="font-size: 15px; color: black; text-align:justify;">
                                <?php echo $row["content_full"]; ?></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>





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
<?php
include('./include/footer.php')

?>

</html>