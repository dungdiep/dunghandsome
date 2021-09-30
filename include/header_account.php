  <div class="top-navigaton">
      <ul class="navigation">

          <li class="menuitem"><a class="linkitem introduce" href="introduce.php" style="text-decoration: none;">Giới
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

          <li class="menuitem"><a class="linkitem login" href="success.php" style="text-decoration: none;">
                  <i class="far fa-user"></i>
                  Trang chủ</a></li>

          <li class="menuitem"><a class="linkitem login" href="logout.php" style="text-decoration: none;"><i
                      class="far fa-user"></i>
                  Đăng xuất</a></li>
      </ul>
  </div>

  <script type="text/javascript">
function notice() {
    alert("Đơn hàng trống!");
}
  </script>