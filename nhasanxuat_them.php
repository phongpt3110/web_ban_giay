<?php
    // Xử lý khi form được gửi đi
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy thông tin từ FORM
        $tenNSX = $_POST['TenNSX'];

        // Kiểm tra tên nhà sản xuất
        if(trim($tenNSX) == "") {
            echo "Tên nhà sản xuất không được bỏ trống!";
        } else {
            // Đưa thông tin nhà sản xuất vào CSDL
            $sql = "INSERT INTO `nhasanxuat` (`TenNSX`) VALUES ('$tenNSX')";
            $result = $connect->query($sql);
            
            if ($result) {
                // Chèn thành công, hiển thị thông báo và chuyển hướng về trang danh sách nhà sản xuất
                echo "Bạn đã thêm thành công nhà sản xuất $tenNSX";
                echo '<script>
                    window.location.href = "index.php?do=nhasanxuat";
                </script>'; 
                exit();
            } else {
                // Nếu có lỗi trong quá trình chèn, hiển thị thông báo lỗi
                echo "Không thể thêm nhà sản xuất mới: " . $connect->error;
            }
        }
    }
?>

<div class="container d-flex justify-content-center align-items-center">
    <div class="row border rounded-5 p-3 bg-white shadow ">
        <div class="col-md-12 ">
            <div class="row align-items-center">
                <div class="header-text">
                    <h2 class="title text-center fs-2">THÊM NHÀ SẢN XUẤT MỚI</h2>
                </div>
                <!-- Form thêm NSX -->
                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <!-- Nhập tên NSX -->
                    <div class="form-floating mb-3 me-2">
                        <input type="text" class="form-control" id="tenNSX" name="TenNSX">
                        <label for="tenNSX">Tên nhà sản xuất</label>
                    </div>
                    <!-- Nút thêm NSX -->
                    <div class="input-group mb-3  justify-content-center">
                        <input type="submit" name="submit" class="btn btn-lg btn-success w-30 fs-6" value="THÊM NHÀ SẢN XUẤT" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
