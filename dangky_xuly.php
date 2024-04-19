<?php
// Lấy thông tin từ FORM
$QuyenHan = 1;
$Email = $_POST['email'];
$HoVaTen = $_POST['HoVaTen'];
$TenDangNhap = $_POST['TenDangNhap'];
$MatKhau = $_POST['MatKhau'];
$XacNhanMatKhau = $_POST['XacNhanMatKhau'];
$DiaChi = $_POST['DiaChi'];

// Kiểm tra
if (trim($HoVaTen) == "")
	ThongBao("Họ và tên không được bỏ trống!");
elseif (trim($TenDangNhap) == "")
	ThongBao("Tên đăng nhập không được bỏ trống!");
elseif (trim($MatKhau) == "")
	ThongBao("Mật khẩu không được bỏ trống!");
elseif ($MatKhau != $XacNhanMatKhau)
	ThongBao("Xác nhận mật khẩu không đúng!");
else {
	// Kiểm tra người dùng đã tồn tại chưa
	$MatKhau = md5($MatKhau);
	$sql_kiemtra = "SELECT * FROM `nguoidung` WHERE `TenDangNhap` = '$TenDangNhap'";

	$danhsach = $connect->query($sql_kiemtra);

	if ($danhsach) {
		if ($danhsach->num_rows > 0) {
			ThongBao("Người dùng với tên đăng nhập đã được sử dụng!");
		} else {
			// Thêm người dùng
			$sql_them_nd = "INSERT INTO `nguoidung`(`QuyenHan`,`TenNguoiDung`, `TenDangNhap`, `MatKhau`,`DiaChi`, `Khoa`, `Email`)
						VALUES ('$QuyenHan', '$HoVaTen', '$TenDangNhap', '$MatKhau','$DiaChi', 0, '$Email')";
			$themnd = $connect->query($sql_them_nd);

			if ($themnd) {
				ThongBao("Đăng ký thành công!");
				echo '
						<script>
						window.location.href = "index.php";
						</script>
						';
			} else {
				ThongBao('Đã xảy ra lỗi khi thêm dữ liệu vào CSDL!');
			}
		}
	} else {
		ThongBao("Đã xảy ra lỗi khi kiểm tra người dùng!");
	}
}
?>