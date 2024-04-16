<?php
session_start();

include_once "cauhinh.php";
include_once "thuvien.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>SNEAKERS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Nhúng bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Nhúng font-icon -->
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.3.0-web/css/all.min.css">
    <link rel="stylesheet" href="./assets/fonts/themify-icons/themify-icons.css">

    <!-- Nhúng css -->
    <link rel="stylesheet" href="./assets/css/style.css" />

</head>

<body>
    <div></div>
    <!-- Đầu trang -->
    <header class="container-fluid p-3 bg_primary text-white text-center">
        <div class="container d-md-flex justify-content-md-between align-content-center align-items-md-center">
            <!-- Logo -->
            <div id="logo" class="me-2 mt-2">
                <a href="index.php"><img class="rounded" src="./assets/images/logo.jpg" class="img-fluid"
                        style="width: 100px; height: 100px;" /></a>
            </div>
            <!-- Tạo khung search -->
            <div id="search" class="input-group input-group-md me-2 mt-2">
                <input type="text" class="form-control" placeholder="Search">
                <button class="btn btn-success" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
            <!-- Tài khoản -->
            <div id="account" class="d-md-flex me-2 mt-2 align-items-center">
                <i class="icon fa-solid fa-user-gear fa-2xl me-2"></i>
                <!-- Đăng nhập, đăng ký, đăng xuất -->
                <div class="dropdown">
                    <button type="button" class="border-0 bg_primary text-white dropdown-toggle"
                        data-bs-toggle="dropdown">
                        <?php
                        // Đặt mặt định là "Tài khoản"
                        $taikhoan = "Tài khoản";
                        if (isset($_SESSION["QuyenHan"]) && $_SESSION["HoTen"]) {
                            // Nếu admin or khách hàng hiện tên
                            if ($_SESSION['QuyenHan'] == 0) {
                                echo $_SESSION['HoTen'];
                            } elseif ($_SESSION['QuyenHan'] == 1)
                                echo $_SESSION['HoTen'];
                            else {
                                echo $taikhoan;
                            }
                        }
                        
                        ?>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="accountDropdownMenu">
                        <!-- Phương thức đăng nhập, đăng ký, đăng xuất -->
                        <?php
                        // Hiển thị from đăng nhập 
                        echo '<li><a class="dropdown-item" href="index.php?do=dangky">
                                    <i class="fa-solid fa-user-pen" style="color: #0f3057;"></i>
                                    Đăng ký</a>
                            </li>';
                        // Hiển thị from đăng ký
                        echo '<li><a class="dropdown-item" href="index.php?do=dangnhap">
                                    <i class="fa-solid fa-user-check" style="color: #0f3057;"></i>
                                    Đăng nhập</a></li>';
                        // Đăng xuất thông tin
                        echo '<li><a class="dropdown-item" href="index.php?do=dangxuat">
                                    <i class="fa-solid fa-user-xmark" style="color: #0f3057;"></i>
                                    Đăng xuất</a></li>';
                        ?>

                    </ul>
                </div>


            </div>
            <!-- Giỏ hàng -->
            <div id="cart" class="me-2 mt-2">
                <a href="#">
                    <i class="icon fa-solid fa-cart-flatbed fa-2xl"></i>
                </a>
            </div>
        </div>
    </header>

    <!-- Phần giữa trang -->
    <div class="container mt-5">
        <div class="row">
            <!-- Cột trái -->
            <div class="col-md-3">
                <h1> Nav bên trái </h1>
            </div>

            <!-- Cột phải -->
            <div class="col-md-9">
                <?php
                // Kiểm tra nếu trang là trang đăng nhập
                $do = isset($_GET['do']) ? $_GET['do'] : 'home';
                if ($do === 'dangnhap.php')
                    include 'dangnhap.php';
                else
                    include $do . ".php";
                ?>
            </div>
        </div>
    </div>

    <!-- Phần chân trang -->
    <footer class="container-fluid rounded mt-5 p-5 bg_primary text-white text-justify">
        <div class="container">
            <div class="row ">
                <div class="col-md-5 mt-2">
                    <h3>GIÀY CHÍNH HÃNG</h3>
                    <div class="d-md-flex ">
                        <div class="mx-2 p-0">
                            <a href="#"><img class="rounded" src="./assets/images/logo.jpg" class="img-fluid"
                                    style="width: 150px; height: 150px;" /></a>
                        </div>
                        <div>
                            <p>Shop được định hướng trở thành hệ thống thương mại điện tử bán giày chính hãng hàng
                                đầu
                                Việt
                                Nam.</p>
                            <span>
                                Showroom: Long Xuyên, An Giang
                                <br>
                                Hotline: 0357546199
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ms-2 mt-2">
                    <h3>VỀ CHÚNG TÔI</h3>
                    <ul class="p-0 ">
                        <a href="#">
                            <li>Giới thiệu</li>
                        </a>
                        <a href="#">
                            <li>Điều khoản sử dụng</li>
                        </a>
                        <a href="#">
                            <li>Chính sách đổi trả</li>
                        </a>
                        <a href="#">
                            <li>Chính sách bảo mật</li>
                        </a>
                    </ul>
                </div>
                <div class="col-md-3  mt-2">
                    <h3>LIÊN HỆ</h3>
                    <ul class="p-0">
                        <a href="#">
                            <li>
                                <i class="fa-brands fa-facebook-f fa-lg"></i>
                                Facebook
                            </li>
                        </a>
                        <a href="#">
                            <li>
                                <i class="fa-brands fa-instagram fa-lg"></i>
                                Instagram
                            </li>
                        </a>
                        <a href="#">
                            <li>
                                <i class="fa-brands fa-linkedin-in fa-lg"></i>
                                Like in
                            </li>
                        </a>
                        <a href="#">
                            <li>
                                <i class="fa-brands fa-stripe-s fa-lg"></i>
                                Shoppe
                            </li>
                        </a>
                        <a href="#">
                            <li>
                                <i class="fa-brands fa-tiktok fa-lg"></i>
                                Tiktok
                            </li>
                        </a>
                    </ul>
                </div>
            </div>
            <hr>
            <div>
                Copyright © 2016 -
                <?php echo $current_year = date("Y"); ?> SNEAKERS.vn. All rights reserved.
            </div>
        </div>
    </footer>
    </div>
</body>

</html>