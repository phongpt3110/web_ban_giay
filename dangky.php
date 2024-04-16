<!-- from đăng nhập -->
<!DOCTYPE html>
<html lang="en">

<body>
    <!-- Thiết kế from đăng nhập -->
    <div id="fromRegis" class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-4 bg-white shadow box-area">

            <!-- Cột trái from đăng ký  -->
            <div class="col-md-6 left-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2 class="text-center fs-2"
                            style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">ĐĂNG
                            KÝ</h2>
                    </div>
                    <!-- From đăng nhập -->
                    <form action="" method="">
                        <!-- Nhập tên hiển thị -->
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Nhập Email" name="email">
                        </div>
                        <!-- Nhập tên tài khoản -->
                        <div class="input-group mb-3">
                            <input type="text" name="TenDangNhap" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Tên đăng nhập">
                        </div>
                        <!-- Nhập password -->
                        <div class="input-group mb-3">
                            <input type="password" name="MatKhau" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Mật khẩu">
                        </div>
                        <!-- Nhập password -->
                        <div class="input-group mb-3">
                            <input type="password" name="MatKhauXacNhan"
                                class="form-control form-control-lg bg-light fs-6" placeholder="Xác nhận mật khẩu">
                        </div>
                        <!-- Hiển thị mật khẩu -->
                        <div class="input-group mb-3 d-flex justify-content-between">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="formCheck">
                                <label for="formCheck" class="form-check-label text-secondary"><small>Hiển thị mật
                                        khẩu</small></label>
                            </div>
                        </div>
                        <!-- Bấm đăng nhập -->
                        <div class="input-group mb-3">
                            <input type="submit" name="Submit" class="btn btn-lg btn-primary w-100 fs-6"
                                value="ĐĂNG KÝ" />
                        </div>
                    </form>
                </div>
            </div>

            <!-- Cột phải là from đăng nhập -->
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column right-box"
                style="background: #103cbe;">
                <!-- Tiêu đề đăng nhập -->
                <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">
                    XIN CHÀO BẠN!
                </p>
                <small class="text-white text-wrap text-center"
                    style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Bạn đã là thành viên!</small>
                <button type="button" class="btn btn-md btn-outline-light rounded-2 mt-2"><a
                        href="index.php?do=dangnhap"> ĐĂNG NHẬP
                    </a></button>
            </div>
        </div>
    </div>

</body>

<?php
	// Lấy thông tin từ FORM
	$HoVaTen = $_POST['HoVaTen'];
	$TenDangNhap = $_POST['TenDangNhap'];
	$MatKhau = $_POST['MatKhau'];
	$XacNhanMatKhau = $_POST['XacNhanMatKhau'];
	
	// Kiểm tra
	if(trim($HoVaTen) == "")
		ThongBaoLoi("Họ và tên không được bỏ trống!");
	elseif(trim($TenDangNhap) == "")
		ThongBaoLoi("Tên đăng nhập không được bỏ trống!");
	elseif(trim($MatKhau) == "")
		ThongBaoLoi("Mật khẩu không được bỏ trống!");
	elseif($MatKhau != $XacNhanMatKhau)
		ThongBaoLoi("Xác nhận mật khẩu không đúng!");
	else
	{
		// Kiểm tra người dùng đã tồn tại chưa
		$sql_kiemtra = "SELECT * FROM tbl_nguoidung WHERE TenDangNhap = '$TenDangNhap'";
		
		$danhsach = $connect->query($sql_kiemtra);
		
		if($danhsach)
		{
			// Mã hóa mật khẩu
			$MatKhau = md5($MatKhau);
			
			$sql_them = "INSERT INTO `tbl_nguoidung`(`TenNguoiDung`, `TenDangNhap`, `MatKhau`, `QuyenHan`, `Khoa`)
					VALUES ('$HoVaTen', '$TenDangNhap', '$MatKhau', 2, 0)";
			$themnd = $connect->query($sql_them);
			
			if($themnd)
				ThongBao("Đăng ký thành công!");
			else
				ThongBaoLoi(mysql_error());
		}
		else
		{
			ThongBaoLoi("Người dùng với tên đăng nhập đã được sử dụng!");
		}
	}
?>

</html>