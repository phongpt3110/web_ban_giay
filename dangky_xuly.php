<?php
	// Lấy thông tin từ FORM
	$Email = $_POST['Email'];
	$TenDangNhap = $_POST['TenDangNhap'];
	$MatKhau = $_POST['MatKhau'];
	$XacNhanMatKhau = $_POST['XacNhanMatKhau'];
	
	// Kiểm tra
	if(trim($Email) == "")
		BaoLoi("Email không được bỏ trống!");
	elseif(trim($TenDangNhap) == "")
		BaoLoi("Tên đăng nhập không được bỏ trống!");
	elseif(trim($MatKhau) == "")
		BaoLoi("Mật khẩu không được bỏ trống!");
	elseif($MatKhau != $XacNhanMatKhau)
		BaoLoi("Xác nhận mật khẩu không đúng!");
	else
	{
		// Kiểm tra người dùng đã tồn tại chưa
		$sql_kiemtra = "SELECT * FROM tbl_nguoidung WHERE TenDangNhap = '$TenDangNhap'";
		
		$danhsach = $connect->query($sql_kiemtra);
		
		if($danhsach)
		{
			// Mã hóa mật khẩu
			$MatKhau = md5($MatKhau);
			
			$sql_them = "INSERT INTO `tbl_nguoidung`(`Email`, `TenDangNhap`, `MatKhau`, `QuyenHan`, `Khoa`)
					VALUES ('$Email', '$TenDangNhap', '$MatKhau', 2, 0)";
			$themnd = $connect->query($sql_them);
			
			if($themnd)
				BaoLoi("Đăng ký thành công!");
			else
				BaoLoi(mysql_error());
		}
		else
		{
			BaoLoi("Người dùng với tên đăng nhập đã được sử dụng!");
		}
	}
?>