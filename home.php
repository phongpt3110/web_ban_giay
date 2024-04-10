<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SNEAKERS</title>
    <link rel="stylesheet" href="./assets/css/style.css" />
</head>

<body>
    <div class="container">
        <div class="row">
            <!-- Khung sản phẩm -->
            <?php
            $sql = "SELECT * FROM `danhsach` WHERE 1";
            $danhsach = $connect->query($sql);
            ?>
            <?php
            $count = 0;
            while ($ds = $danhsach->fetch_array(MYSQLI_ASSOC)) {
                echo '<div class="col-md-3" id="img-products">';
                echo '  <div id="img-products">';
                echo '      <img src="' . $ds["AnhSP"] . '"/>';
                echo '      <h6>' . $ds["TenSP"] . '</h6>';
                echo '      <div class="price">' . $ds["Gia"] . '</div>';
                echo '      <div class="d-flex justify-content-around py-2">';
                echo '          <a class="btn btn-outline-success btn-sm me-2" 
                                href="index.php?do=dangnhap" 
                                onclick="return confirm(\"Vui lòng đăng nhập để mua sản phẩm ' . $ds["TenSP"] . ' này\")">Buy</a>';
                echo '          <a class="btn btn-outline-warning btn-sm">Add cart</a>';
                echo '      </div>';
                echo '  </div>';
                echo '</div>';
            }
            ?>

        </div>
    </div>
</body>

</html>