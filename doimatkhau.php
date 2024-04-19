<!DOCTYPE html>
<html lang="en">


    <?php
        // Kiểm tra xem dữ liệu được gửi từ form chưa
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lấy dữ liệu từ form
            $old_password = $_POST["old_password"];
            $new_password = $_POST["new_password"];
            $confirm_password = $_POST["confirm_password"];

            // Kiểm tra xác nhận mật khẩu mới
            if ($new_password != $confirm_password) {
                echo "Mật khẩu mới và xác nhận mật khẩu mới không khớp nhau.";
            } else {
                // Kiểm tra xác nhận mật khẩu cũ
                $username = "client"; // Thay bằng tên đăng nhập của người dùng
                $sql = "SELECT MatKhau FROM nguoidung WHERE TenDangNhap = :username";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['username' => $username]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$row) {
                    echo "Người dùng không tồn tại.";
                } else {
                    // So sánh mật khẩu cũ
                    $stored_password = $row['MatKhau'];
                    if (!password_verify($old_password, $stored_password)) {
                        echo "Mật khẩu cũ không đúng.";
                    } else {
                        // Mật khẩu cũ đúng, thực hiện đổi mật khẩu
                        $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

                        // Cập nhật mật khẩu mới vào cơ sở dữ liệu
                        $sql = "UPDATE nguoidung SET MatKhau = :new_password WHERE TenDangNhap = :username";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(['new_password' => $hashed_new_password, 'username' => $username]);

                        echo "Đổi mật khẩu thành công.";
                    }
                }
            }
        }

        // Đóng kết nối
        $pdo = null;

    ?>
    <!-- Chức năng hiện mật khẩu -->
<script>
    function togglePassword() {
        const MatKhau = document.getElementById('password');
        const MatKhauMoi = document.getElementById('passwordNew');
        const MatKhauXacNhan = document.getElementById('passwordValid');
        const icon = document.querySelector('.password-toggle');

        if (MatKhauXacNhan.type === "password") {
            MatKhau.type = "text";
            MatKhauMoi.type = "text";
            MatKhauXacNhan.type = "text";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            MatKhau.type = "password";
            MatKhauMoi.type = "password";
            MatKhauXacNhan.type = "password";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    }
</script>

<!-- Thiết kế from đổi mật khẩu -->
<div class="container d-flex justify-content-center align-items-center">
    <div class="row border rounded-5 p-3 bg-white shadow box-area">
        <div class="col-md-12 ">
            <div class="row align-items-center">
                <div class="header-text">
                    <h2 class="title text-center fs-2">ĐỔI MẬT KHẨU</h2>
                </div>
                <!-- From đổi mật khẩu -->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <!-- Ẩn mã người dùng -->
                    <input type="hidden" name="MaNguoiDung" value="<?php echo $_SESSION['MaNguoiDung']; ?>" />
                    <!-- Cập nhật tên người dùng -->
                    <div class="form-floating mb-3 ">
                        <input type="password" class="form-control" id="password" name="old_password" required>
                        <label for="password">MẬT KHẨU</label>
                    </div>
                    <!--Cập nhật tên đăng nhập -->
                    <div class="form-floating mb-3 ">
                        <input type="password" class="form-control" id="passwordNew" name="new_password" required>
                        <label for="passwordNew">MẬT KHẨU MỚI</label>
                    </div>
                    <!-- Cập nhật tỉ lệ giảm giá -->
                    <div class="form-floating mb-3 ">
                        <input type="password" id="passwordValid" class="form-control" name="confirm_password">
                        <i class="password-toggle fas fa-eye-slash" onclick="togglePassword()"></i>
                        <label for="passwordValid">XÁC NHẬN MẬT KHẨU</label>
                    </div>
                    <!-- Bấm đổi mật khẩu -->
                    <div class="input-group mb-3 justify-content-center">
                        <input type="submit" name="submit" class="btn btn-lg btn-success w-30 fs-6"
                            value="ĐỔI MẬT KHẨU" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



</html>
