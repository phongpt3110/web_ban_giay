<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Quên mật khẩu</title>
    </head>

    <body>
        <h2>Quên mật khẩu</h2>
        <!-- Form để nhập địa chỉ email để yêu cầu đặt lại mật khẩu -->
        <form action="forgot_password.php" method="post">
            <label for="email">Địa chỉ email:</label><br>
            <input type="email" id="email" name="email" required><br><br>
            <input type="submit" value="Gửi yêu cầu đặt lại mật khẩu">
        </form>
    </body>

    <?php
        // Kiểm tra xem form đã được gửi đi chưa
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lấy địa chỉ email từ form
            $email = $_POST["email"];

            // Xác minh địa chỉ email ở đây
            // Ví dụ: kiểm tra xem địa chỉ email có tồn tại trong cơ sở dữ liệu không

            // Gửi email đặt lại mật khẩu
            $to = $email;
            $subject = "Yêu cầu đặt lại mật khẩu";
            $message = "Nhấp vào liên kết sau để đặt lại mật khẩu của bạn: http://example.com/reset_password.php";
            $headers = "From: webmaster@example.com" . "\r\n" .
                    "Reply-To: webmaster@example.com" . "\r\n" .
                    "X-Mailer: PHP/" . phpversion();

            if (mail($to, $subject, $message, $headers)) {
                echo "Một email đã được gửi đến địa chỉ của bạn để đặt lại mật khẩu.";
            } else {
                echo "Gửi email đặt lại mật khẩu không thành công.";
            }
        }
        ?>


</html>
