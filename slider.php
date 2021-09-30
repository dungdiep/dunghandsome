<?php
$conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
$result = mysqli_query($conn, "SELECT * FROM slider");
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
    <div class="container">
        <div class="row">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="administration/img/s21.png" alt="Ingredients" width="500"
                            height="400">
                        <div class="carousel-caption d-none d-md-block">
                        </div>
                    </div>
                    <?php
                                $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
                                $results = mysqli_query($conn,"SELECT * FROM slider");
                            ?>
                    <?php
                                // $rowsPerPage=3; //số mẩu tin trên mỗi trang, giả sử là 10
                                // if (!isset($_GET['page']))
                                // { $_GET['page'] = 1;
                                // }
                                // //vị trí của mẩu tin đầu tiên trên mỗi trang
                                // $offset =($_GET['page']-1)*$rowsPerPage;
                                $i=1;
                                while($ngan = mysqli_fetch_array($results)) {
                            ?>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="administration/img/<?php echo $ngan['image']; ?>"
                            alt="Ingredients" width="500" height="400">
                    </div>
                    <?php
                                $i++;
                                // $re = mysqli_query($conn, 'select * from product');
                                // //tổng số mẩu tin cần hiển thị
                                // $numRows = mysqli_num_rows($re);
                            }
                            ?>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
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
</body>

</html>