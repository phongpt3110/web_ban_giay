<?php
// Lấy danh sách đổ vào nhóm 
if (empty($_GET['id'])) {
    $hoten = $_SESSION['HoTen'];
    $sql = "SELECT * FROM `nguoidung` WHERE TenNguoiDung = '$hoten'";
} else {
    $sql = "SELECT * FROM `nguoidung` WHERE MaNguoiDung = " . $_GET['id'];
}
$ds = $connect->query($sql);
//Nếu kết quả kết nối không được thì xuất báo lỗi và thoát
if (!$ds) {
    die("Không thể thực hiện câu lệnh người dùng: " . $connect->connect_error);
}

// Lặp qua các cột
$dong = $ds->fetch_array(MYSQLI_ASSOC);

?>

<!-- Xử lý from  -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy giá trị gán vào biến

    $MaNguoiDung = $_POST['MaNguoiDung'];
    $TenNguoiDung = $_POST['TenNguoiDung'];
    $TenDangNhap = $_POST['TenDangNhap'];
    $DiaChi = $_POST['DiaChi'];
    $Email = $_POST['Email'];


    if (trim($TenNguoiDung) == "")
        BaoLoi("Tên sản phẩm không được để trống!!!");
    elseif (trim($TenDangNhap) == "")
        BaoLoi("Bạn chưa nhập tên đăng nhập!!!");
    elseif (trim($DiaChi) == "")
        BaoLoi("Bạn chưa nhập địa chỉ!!!");
    elseif (trim($Email) == "" || !filter_var($Email, FILTER_VALIDATE_EMAIL))
        BaoLoi("Email không được bỏ trống");
    else {
        // Câu lệnh cập nhật
        $sql = "UPDATE `nguoidung`
                    SET 
                    `TenNguoiDung` = '$TenNguoiDung',
                    `TenDangNhap` = '$TenDangNhap',
                    `DiaChi` = '$DiaChi',
                    `Email` = '$Email'
                    WHERE `MaNguoiDung` = '$MaNguoiDung'";
        echo $sql;

        $ds = $connect->query($sql);
        if (!$ds) {
            die("Không thể thực hiện câu lệnh Update: " . $connect->connect_error);
        } else {
            ThongBao("Bạn đã cập nhật thành công người dùng $TenNguoiDung");

            // Nếu khách hàng thì quay lại trang hồ sơ
            if ($_SESSION['QuyenHan'] == 0) {
                echo '<script>
                        window.location.href = "index.php?do=nguoidung";
                    </script>';
            } else {
                echo '<script>
                        window.location.href = "index.php?do=nguoidung_hoso";
                    </script>';
            }
        }
    }
}
?>


<body>
    <!-- Thiết kế from cập nhật người dùng -->
    <div class="container d-flex justify-content-center align-items-center">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-12 ">
                <div class="row align-items-center">
                    <div class="header-text">
                        <h2 class="title text-center fs-2">CẬP NHẬT NGƯỜI DÙNG</h2>
                    </div>
                    <!-- From cập nhật người dùng -->
                    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"
                        class="was-validated ">
                        <!-- Ẩn mã người dùng -->
                        <input type="hidden" name="MaNguoiDung" value="<?php echo $dong['MaNguoiDung']; ?>" />
                        <!-- Cập nhật tên người dùng -->
                        <div class="form-floating mb-3 ">
                            <input type="text" class="form-control" id="tnd" name="TenNguoiDung"
                                value="<?php echo $dong['TenNguoiDung']; ?>">
                            <label for="tnd">TÊN NGƯỜI DÙNG</label>
                        </div>
                        <!--Cập nhật tên đăng nhập -->
                        <div class="form-floating mb-3 ">
                            <input type="text" class="form-control" id="tdn" name="TenDangNhap" required
                                value="<?php echo $dong['TenDangNhap']; ?>">
                            <label for="tdn">TÊN ĐĂNG NHẬP</label>
                        </div>
                        <!-- Cập nhật mật khẩu -->
                        <div class="form-floating mb-3 ">
                            <input type="password" class="form-control" id="mk" name="MatKhau" disabled
                                value="<?php echo $dong['MatKhau']; ?>">
                            <label for="mk">MẬT KHẨU</label>
                        </div>
                        <!-- Cập nhật địa chỉ -->
                        <div class="form-floating mb-3 ">
                            <input type="text" class="form-control" id="em" name="Email" required
                                value="<?php echo $dong["Email"] ?>">
                            <label for="em">EMAIL</label>
                        </div>
                        <div class="form-floating mb-3 ">
                            <input type="text" class="form-control" id="dc" name="DiaChi" required
                                value="<?php echo $dong["DiaChi"] ?>">
                            <label for="dc">ĐỊA CHỈ</label>
                        </div>
                        <!-- Bấm cập nhật người dùng -->
                        <div class="input-group mb-3 justify-content-center">
                            <input type="submit" name="submit" class="btn btn-lg btn-success w-30 fs-6"
                                value="CẬP NHẬT NGƯỜI DÙNG" />
                        </div>
                    </form>
                </div>
                <?php
                if (empty($_GET['id'])) {
                    echo '
                        <div class="d-flex justify-content-end">
                            <a href=" index.php?do=doimatkhau" class="change_pass w-20 ">
                                ĐỔI MẬT KHẨU</a>
                        </div>
                    ';
                }
                ?>
            </div>
        </div>
</body>