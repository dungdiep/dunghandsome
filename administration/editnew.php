<?php
//Kiểm tra session nếu chưa đăng nhập thì quay vào trang login.php
session_start();
if (!isset($_SESSION['User'])) {
    header("location: login_admin.php");
}
?>
<?php

require_once 'handing.php';

if (isset($_GET['id']))
    $id = $_GET['id'];
else $id = "";

if (isset($_POST['id']))
    $id = $_POST['id'];

$sql = 'select * from new 
            where new_id = "' . $id . '"
    ';
$datanv = getData($sql);
foreach ($datanv as $value) {
    $new_img = $value[1];
    $new_title = $value[2];
    $new_content = $value[3];
    $content_full = $value[4];
   
}


if (isset($_POST['update'])) {
      $anh_tintuc = '';
    if (!empty($_FILES['new_img'])) {
            $file = $_FILES['new_img'];
            $ten_anh = $file['name'];
            $anh_tintuc = $ten_anh;
        }

    if (
        !empty($_FILES['new_img'])

        && !empty($_POST['new_title'])
        && !empty($_POST['new_content'])
        && !empty($_POST['content_full'])
        
    ) {
        echo 'abc';
        
        

        $new_title = $_POST['new_title'];
        $new_content = $_POST['new_content'];
        $content_full = $_POST['content_full'];
       

        $conn = new mysqli("localhost", "root", "", DATABASE);
        $sqlUpdate = 'update new set new_img ="' . $anh_tintuc . '", 
               new_title = "' . $new_title . '", new_content = "' . $new_content . '", content_full ="' . $content_full . '" where new_id= "' . $id . '" ';

        
        mysqli_query($conn, $sqlUpdate);
        mysqli_close($conn);
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
<style>
}

.btn {
    background-color: #008080;
}

.heading {
    background-color: #008080;
}



}
</style>

<body>


    <div class="heading ">
        <h4 style="font-family:times">Sửa Tin Tức</h4>
    </div>


    <form action="" class="mt-5 " class="edit-staff" method="post"
        style=" height:500px;margin: 0 auto; border-radius: 10px; ">

        <div class="row">
            <div class="col-md-3">
                <label for="" style="margin-left: 35px;color: #008080; font-weight: bold;">Hình ảnh</label>
            </div>
            <div class="col-md-9">
                <div class="form-group col-md-12">

                    <input type="file" name="new_img" id="" class="form-control" placeholder=""
                        aria-describedby="helpId" style="width: 60%">
                    <img src="<?php echo 'img/'.$new_img.'';?>" width="50px" height="50px" lalt="">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <label for="" style="margin-left: 35px;color: #008080; font-weight: bold;">Tiêu đề</label>
            </div>
            <div class="col-md-9">
                <div class="form-group col-md-12">

                    <input type="text" name="new_title" id="" class="form-control" value="<?php echo $new_title ?>"
                        placeholder="" aria-describedby="helpId" style="width: 60%;">


                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <label for="" style="margin-left: 35px;color: #008080; font-weight: bold;">Thông tin tóm tắt</label>
            </div>
            <div class="col-md-9">
                <div class="form-group col-md-12">

                    <input type="text" name="new_content" id="" class="form-control" value="<?php echo $new_content ?>"
                        placeholder="" aria-describedby="helpId" style="width: 60%">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="" style="margin-left: 35px;color: #008080; font-weight: bold;">Thông tin đầy đủ</label>
            </div>
            <div class="col-md-9">
                <div class="form-group col-md-12">

                    <textarea type="text" name="content_full" id="" class="form-control" placeholder=""
                        aria-describedby="helpId" style="width: 60%"><?php echo $content_full ?></textarea>
                </div>
            </div>
        </div>

        <button class=" btn btn-success ml-4 text-white" type="submit" name="update">Sửa</button>
        <?php echo '<input type="hidden" name="id" value="' . $id . '"/>'; ?>
        <button class="btn  btn-primary" style="margin-left: 20px;"> <a style="color:white; text-decoration: none;"
                href="new.php">Quay về</a></button>


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

</html>