<?php
$MaSP = $_GET['id'];
$MaNguoiDung = $_GET['MaND'];

// Xóa thông tin trong giỏ hàng
$sql_delete = "DELETE FROM giohang WHERE MaSP = '$MaSP' AND MaNguoiDung =  '$MaNguoiDung'";
$kiemtra_delete = $connect->query($sql_delete);
echo '<script>
    window.location.href="index.php?do=giohang";
    </script>';
?>