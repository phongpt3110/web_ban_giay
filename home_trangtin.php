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
            <div class="col-md-3">
                <h1>NHÀ SẢN XUẤT</h1>
            </div>

            <div class="col-md-9">

                <!-- . Hiệu ứng slide 2.Tự động chuyển trang 3. Đặt thời gian 4.Dừng khi hover 5. Chuyển vòng lặp 6. Cho phép nhắn bàn phím -->
                <div id="carouselControls" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000"
                    data-bs-pause="hover" data-bs-wrap="true" data-bs-keyboard="true" data-bs-touch="true">
                    <!-- Hiển thị hình ảnh -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="./assets/images/conver_white_low.jpg" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="./assets/images/converse_1970s.jpg" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="./assets/images/converse_1970s_white.jpg" alt="...">
                        </div>
                    </div>
                    <!-- Nút chuyển về trước -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <!-- Nút chuyển về sau  -->
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselControls"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>



            </div>
            <!-- Khung sản phẩm -->
            <?php
            $sql = "SELECT * FROM `danhsach` WHERE 1";
            $danhsach = $connect->query($sql);
            ?>
            <?php
            while ($ds = $danhsach->fetch_array(MYSQLI_ASSOC)) {
                // Tính giá giảm của sản phẩm
                $giagiam = $ds['Gia'] - (($ds['TiLeGiam'] / 100) * $ds['Gia']);
                echo '<div class="col-md-3 mt-2">';
                echo '  <div id="img-products">';
                echo '      <img src="' . $ds["AnhSP"] . '"/>';
                echo '      <h6>' . $ds["TenSP"] . '</h6>';
                echo '      <div class="price-list">';
                // Nếu giảm thì hiển thị thông tin của 2 giá
                if ($ds['Gia'] == $giagiam) {
                    echo '  <span class="price-sale ">' . number_format($giagiam, 0, ',', '.') . ' đ</span>';
                } else {
                    echo '  <span class="price-sale ">' . number_format($giagiam, 0, ',', '.') . ' đ</span>';
                    echo '  <span class="price">' . number_format($ds['Gia'], 0, ',', '.') . ' đ</span>';
                }
                echo '      </div>';
                echo '      <div class="d-flex justify-content-around pb-3">';
                echo "          <a title='mua hàng' class='btn btn-outline-success btn-sm me-2'
                                href='index.php?do=dangnhap'
                                onclick='return confirm(\"Vui lòng đăng nhập để mua sản phẩm " . $ds["TenSP"] . " này\")'>Buy</a>";
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