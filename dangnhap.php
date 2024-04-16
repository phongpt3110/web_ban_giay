<?php
if ( $_SERVER ["REQUEST_METHOD" ] == "POST" )  {
	// Lấy thông tin từ FORM
	$TenDangNhap = $_POST['TenDangNhap'];
	$MatKhau = $_POST['MatKhau'];
	
	// Kiểm tra
	if(trim($TenDangNhap) == "")
		BaoLoi("Tên đăng nhập không được bỏ trống!");
	elseif(trim($MatKhau) == "")
		BaoLoi("Mật khẩu không được bỏ trống!");
	else
	{
		// Mã hóa mật khẩu
		$MatKhau = md5($MatKhau);
		
		// Kiểm tra người dùng có tồn tại không
		$sql_kiemtra = "SELECT * from nguoidung WHERE TenDangNhap = '$TenDangNhap' AND MatKhau = '$MatKhau'";	
		
		
		$danhsach = $connect->query($sql_kiemtra);
		
		//Nếu kết quả kết nối không được thì xuất báo lỗi và thoát
		if (!$danhsach) {
			die("Không thể thực hiện câu lệnh SQL: " . $connect->connect_error);
			exit();
		}
		
		$dong = $danhsach->fetch_array(MYSQLI_ASSOC);
		if($dong)
		{
			if($dong['Khoa'] == 0)
			{
				// Đăng ký SESSION
				$_SESSION['MaNguoiDung'] = $dong['MaNguoiDung'];
				$_SESSION['HoTen'] = $dong['TenNguoiDung'];
				$_SESSION['QuyenHan'] = $dong['QuyenHan'];
				
                BaoLoi("Đã đăng nhập thành công!");
				// Chuyển hướng về trang index.php
				echo '
                    <script>
                    window.location.href = "index.php";
                    </script>
                    ';
			}
			else
			{
				BaoLoi("Người dùng đã bị khóa tài khoản!");
			}	
		}
		else
		{
			BaoLoi("Tên đăng nhập hoặc mật khẩu không chính xác!");
		}
	}
}
	
?>


<!-- from đăng nhập -->

<body>
    <!-- Thiết kế from đăng nhập -->
    <div id="fromRegis" class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <!-- Cột trái nền xanh  -->
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
                style="background: #103cbe;">
                <!-- Tiêu đề đăng nhập -->
                <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">
                    XIN CHÀO BẠN!
                </p>
                <small class="text-white text-wrap text-center"
                    style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Bạn có thể tham gia với chúng
                    tôi</small>
                <button type="button" class="btn btn-md btn-outline-light rounded-2 mt-2"><a
                        href="index.php?do=dangky">ĐĂNG
                        KÝ</a></button>
            </div>
            <!-- Cột phải là from đăng nhập -->
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2 class="text-center fs-2"
                            style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">ĐĂNG
                            NHẬP</h2>
                    </div>

                    <!-- From đăng nhập -->
                    <form action="<?php echo htmlspecialchars( $_SERVER [ "PHP_SELF" ]); ?>" method="post">
                        <!-- Nhập tên tài khoản -->
                        <div class="input-group mb-3">
                            <input type="text" name="TenDangNhap" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Name">
                        </div>
                        <!-- Nhập password -->
                        <div class="input-group mb-1">
                            <input type="password" name="MatKhau" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Password">
                        </div>
                        <!-- Hiển thị mật khẩu -->
                        <div class="input-group mb-5 d-flex justify-content-between">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="formCheck">
                                <label for="formCheck" class="form-check-label text-secondary"><small>Hiển thị mật
                                        khẩu</small></label>
                            </div>
                            <!-- Quên mật khẩu -->
                            <div class="forgot">
                                <small><a href="#">Quên mật khẩu?</a></small>
                            </div>
                        </div>
                        <!-- Bấm đăng nhập -->
                        <div class="input-group mb-3">
                            <input type="submit" name="Submit" class="btn btn-lg btn-primary w-100 fs-6"
                                value="ĐĂNG NHẬP" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>