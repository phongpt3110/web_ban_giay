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
            <div id="search" class="input-group input-group-m mt-2">
                <input type="text" class="form-control" placeholder="Search">
                <button class="btn btn-success" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
            <!-- Tài khoản -->
            <div id="account" class="d-md-flex me-2 mt-2 align-items-center">
                <i class="icon-header fa-solid fa-user-gear me-2"></i>
                <!-- Đăng nhập, đăng ký, đăng xuất -->
                <div class="dropdown">
                    <button type="button" class="border-0 bg_primary text-white dropdown-toggle p-0"
                        data-bs-toggle="dropdown">
                        <?php
                        // Đặt mặt định là "Tài khoản"
                        $taikhoan = "Tài khoản";
                        if (isset($_SESSION["QuyenHan"]) && $_SESSION["HoTen"]) {
                            // Nếu admin or khách hàng hiện tên
                            if ($_SESSION['QuyenHan'] == 0 || $_SESSION['QuyenHan'] == 1) {
                                echo $_SESSION['HoTen'];
                            } else {
                                echo $taikhoan;
                            }
                        } else {
                            echo $taikhoan;
                        }

                        ?>
                    </button>
                    <!-- Phương thức đăng nhập, đăng ký, đăng xuất -->
                    <ul class="dropdown-menu" aria-labelledby="accountDropdownMenu">
                        <?php
                        if (isset($_SESSION['QuyenHan'])) {
                            // Đăng xuất thông tin
                            echo '<li><a class="dropdown-item" href="index.php?do=dangxuat">
                            <i class="fa-solid fa-user-xmark" style="color: #0f3057;"></i>
                            Đăng xuất</a></li>';
                        } else {
                            // Hiển thị from đăng nhập
                            echo '<li><a class="dropdown-item" href="index.php?do=dangnhap">
                                        <i class="fa-solid fa-user-check" style="color: #0f3057;"></i>
                                        Đăng nhập</a></li>';
                            // Hiển thị from đăng ký
                            echo '<li><a class="dropdown-item" href="index.php?do=dangky">
                                        <i class="fa-solid fa-user-pen" style="color: #0f3057;"></i>
                                        Đăng ký</a>
                                </li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <!-- Giỏ hàng -->
            <div id="cart" class="me-2 mt-2">
                <!-- Tạo ra menu bên phải của giỏ hàng -->
                <a href="#" data-bs-toggle="offcanvas" data-bs-target="#demo">
                    <i class="icon-header fa-solid fa-cart-flatbed"></i>
                    <span class="badge">0</span>
                </a>
                <!-- Hiển thị menu giở hàng -->
                <div class="offcanvas offcanvas-end offcanvas-lg bg-white" id="demo">
                    <div class="offcanvas-header">
                        <h1 class="offcanvas-title">GIỎ HÀNG</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                    </div>
                    <div class="offcanvas-body">
                        <p>Some text lorem ipsum.</p>
                        <p>Some text lorem ipsum.</p>
                        <p>Some text lorem ipsum.</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Phần giữa trang -->
    <div class="container mt-5">
        <div class="row">
            <?php
            // Nếu chưa đăng nhập or tài khoản khách hàng
            if (!isset($_SESSION['QuyenHan']) || $_SESSION['QuyenHan'] == 1) {
                // Kiểm tra nếu trang chưa đăng nhập
                echo '<div class="col-md-12">';
                $do = isset($_GET["do"]) ? $_GET["do"] : "home_trangtin";
                if ($do === "dangnhap.php")
                    include "dangnhap.php";
                else
                    include $do . ".php";
                echo '</div> ';
            } else {
                // Nếu quyền hạn admin
                if ($_SESSION['QuyenHan'] == 0) {
                    // ------------------ Trang đã đăng nhập ---------------------------------
                    // Hiển thị cột trái
                    echo '<div class="col-md-3">';
                    echo '<nav class="d-block">
                                <div class="mt-3 col-md-12 ">
                                    <ul class="nav flex-column nav-list ">
                                        <h4 class="bg_primary text-white p-2 m-0">QUẢN LÝ</h4>';
                    echo '<li class="nav-item">
                            <a class="nav-link" href="index.php?do=sanpham_them">
                                <span>
                                <i class="icon-nav fa-solid fa-plus"></i>
                                THÊM SẢN PHẨM
                                </span>
                            </a>
                        </li>';
                    echo '<li class="nav-item">
                                <a class="nav-link" href="index.php?do=sanpham">
                                    <span>
                                        <i class="icon-nav fa-solid fa-eye"></i>
                                        SẢN PHẨM
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?do=nhasanxuat">
                                    <span>
                                        <i class="icon-nav fa-solid fa-city"></i>
                                        NHÀ SẢN XUẤT
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?do=nguoidung">
                                    <span>
                                        <i class="icon-nav fa-solid fa-user"></i>
                                        NGƯỜI DÙNG
                                    </span>
                                </a>
                            </li>';
                }
                echo '</ul>';
                echo '</div>';
                // // Menu khách hàng
                // if ($_SESSION['QuyenHan'] == 1) {
                //     echo '<li class="nav-item">
                //                 <a class="nav-link" href="index.php?do=dssanpham_khachhang&id=' . $_SESSION['MaNguoiDung'] . '">
                //                     <span>
                //                         <i class="icon-nav fa-solid fa-eye"></i>
                //                         SẢN PHẨM
                //                     </span>
                //                 </a>
                //             </li>
                //             <li class="nav-item">
                //                 <a class="nav-link" href="index.php?do=giohang_xem&id=' . $_SESSION['MaNguoiDung'] . '">
                //                     <span>
                //                         <i class="icon-nav fa-solid fa-cart-shopping"></i>
                //                         GIỎ HÀNG
                //                     </span>
                //                 </a>
                //             </li>';
                // }
            
                //Hiện menu cá nhân
                // if (isset($_SESSION['HoTen'])) { Điều chỉnh lại khác hàng
                if ($_SESSION['QuyenHan'] == 0) {
                    echo '  <div class=" mt-3 col-md-12 ">
                            <ul class="nav flex-column  nav-list">
                                <h4 class=" bg_primary text-white p-2 m-0">CÁ NHÂN</h4>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?do=nguoidung_hoso">
                                        <span>
                                            <i class="icon-nav fa-solid fa-address-card"></i>
                                            HỒ SƠ
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?do=doimatkhau">
                                        <span>
                                            <i class="icon-nav fa-solid fa-pen"></i>
                                            THAY ĐỔI MẬT KHẨU
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>';
                }
                echo '</nav>';
                echo '</div>';
                // Hiển thị cột phải
                echo '<div class="col-md-9">';
                $do = isset($_GET["do"]) ? $_GET["do"] : "home";
                if ($do === "dangnhap.php")
                    include "dangnhap.php";
                else
                    include $do . ".php";
                echo '</div>';
            }
            ?>
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