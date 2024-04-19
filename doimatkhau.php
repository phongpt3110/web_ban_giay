<!DOCTYPE html>
<html lang="en">

    <body>
        <h2>Đổi mật khẩu</h2>
        <form action="change_password.php" method="post">
            <label for="old_password">Mật khẩu cũ:</label><br>
            <input type="password" id="old_password" name="old_password"><br><br>

            <label for="new_password">Mật khẩu mới:</label><br>
            <input type="password" id="new_password" name="new_password"><br><br>

            <label for="confirm_password">Xác nhận mật khẩu mới:</label><br>
            <input type="password" id="confirm_password" name="confirm_password"><br><br>

            <input type="submit" value="Đổi mật khẩu">
        </form>
    </body>

    <?php
        // Kiểm tra xem dữ liệu được gửi từ form chưa
        if ($_SERVER["change_password.php"] == "post") {
            // Lấy dữ liệu từ form
            $old_password = $_POST["old_password"];
            $new_password = $_POST["new_password"];
            $confirm_password = $_POST["confirm_password"];

            // Kiểm tra xem mật khẩu mới và xác nhận mật khẩu mới có khớp nhau không
            if ($new_password != $confirm_password) {
                echo "Mật khẩu mới và xác nhận mật khẩu mới không khớp nhau.";
            } else {
                // Kiểm tra xem mật khẩu cũ có đúng không (trong trường hợp này, chúng ta giả định mật khẩu cũ đã được lưu trữ trong cơ sở dữ liệu)
                $stored_old_password = "hashed_password"; // Thay bằng mật khẩu cũ đã được mã hóa

                if ($old_password != $stored_old_password) {
                    echo "Mật khẩu cũ không đúng.";
                } else {
                    // Mật khẩu cũ đúng, thực hiện đổi mật khẩu (trong trường hợp này, chúng ta giả định cập nhật mật khẩu mới vào cơ sở dữ liệu)
                    $stored_new_password = password_hash($new_password, PASSWORD_DEFAULT); // Mã hóa mật khẩu mới

                    // Cập nhật mật khẩu mới vào cơ sở dữ liệu
                    // Ví dụ:
                    // $sql = "UPDATE users SET password='$stored_new_password' WHERE user_id=1";
                    // Thực thi truy vấn SQL...
                    
                    echo "Đổi mật khẩu thành công.";
                }
            }
        }
    ?>

</html>
