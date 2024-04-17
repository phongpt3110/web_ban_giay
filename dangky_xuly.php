<?php
    //Kết nối đến cơ sở dữ liệu (cần thay đổi thông tin kết nối cho phù hợp)
    $servername = "localhost";
    $username = "root";
    $password = "vertrigo";
    $dbname = "db_shop";

    // Tạo kết nối
    $connect = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($connect->connect_error) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . $connect->connect_error);
    }

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
			
			$sql_them = "INSERT INTO `tbl_nguoidung`(`TenNguoiDung`, `TenDangNhap`, `MatKhau`, `QuyenHan`, `Khoa`, 'Email')
					VALUES ('$HoVaTen', '$TenDangNhap', '$MatKhau', 2, 0, '$Email')";
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