
<?php
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        //Lấy dữ liệu
        $maNguoiDung = $_POST['MaNguoiDung'];
        $oldMatKhau = $_POST['MatKhauCu'];
        $newMatKhau = $_POST['MatKhauMoi'];
        $XacNhanMatKhau = $_POST['XacNhanMatKhau'];
        
        // Lấy dữ liệu mật khẩu cũ để so sánh
        $sql = "SELECT `MatKhau` FROM  `nguoidung` WHERE MaNguoiDung = '$maNguoiDung'";
        $ds = $connect->query($sql);
        if (!$ds) {
            BaoLoi("Không thể thực hiện câu lệnh SQL: " . $connect->connect_error);
            exit();
        }

        $dong = $ds->fetch_array(MYSQLI_ASSOC);
        if(md5($oldMatKhau) != $dong['MatKhau']) 
            BaoLoi("Nhập mật khẩu của bạn không đúng!");
        elseif ($newMatKhau != $XacNhanMatKhau)
            BaoLoi("Xác nhận mật khẩu không đúng!");
         else {
            //Cập nhật dữ liệu
            //Mã hóa MD5
            $newMatKhau = md5($newMatKhau);
            $updateSql = "UPDATE `nguoidung` SET MatKhau ='$newMatKhau' WHERE MaNguoiDung = '$maNguoiDung' ";
    
            if ($connect->query($updateSql) === TRUE){
                ThongBao("Cập nhật mật khẩu thành công.");
            } else{
                BaoLoi('Lỗi khi cập nhật mật khẩu: '. $connect->error );
            }

        }

    }   

?>
    <!-- Chức năng hiện mật khẩu -->
    <script>
        function togglePassword() {
            const MatKhau = document.getElementById('password');
            const MatKhauMoi = document.getElementById('passwordNew');
            const XacNhanMatKhau = document.getElementById('passwordValid');
            const icon = document.querySelector('.password-toggle');

            if (XacNhanMatKhau.type === "password") {
                MatKhau.type = "text";
                MatKhauMoi.type = "text";
                XacNhanMatKhau.type = "text";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                MatKhau.type = "password";
                MatKhauMoi.type = "password";
                XacNhanMatKhau.type = "password";
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
                    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <!-- Ẩn mã người dùng -->
                        <input type="hidden" name="MaNguoiDung" value="<?php echo $_SESSION['MaNguoiDung']; ?>" />
                        <!-- Cập nhật tên người dùng -->
                        <div class="form-floating mb-3 ">
                            <input type="password" class="form-control" id="password" name="MatKhauCu" required>
                            <label for="password">MẬT KHẨU</label>
                        </div>
                        <!--Cập nhật tên đăng nhập -->
                        <div class="form-floating mb-3 ">
                            <input type="password" class="form-control" id="passwordNew" name="MatKhauMoi" required>
                            <label for="passwordNew">MẬT KHẨU MỚI</label>
                        </div>
                        <!-- Cập nhật tỉ lệ giảm giá -->
                        <div class="form-floating mb-3 ">
                            <input type="password" id="passwordValid" class="form-control" name="XacNhanMatKhau">
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
