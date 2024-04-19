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



</html>
