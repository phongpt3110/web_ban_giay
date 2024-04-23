<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaNguoiDung = $_POST['MaNguoiDung'];
    $SanPhamXoa = $_POST['SanPhamXoa'];

    // Chia nhỏ các sản phẩm cần xóa thành mảng
    $arraySanPhamXoa = explode(",", $SanPhamXoa);

    // Xóa các sản phẩm đã chọn khỏi giỏ hàng và cập nhật số lượng tồn
    foreach ($arraySanPhamXoa as $masp) {
        // Lấy số lượng sản phẩm từ giỏ hàng
        $sql_sl = "SELECT SoLuong FROM giohang WHERE MaNguoiDung = '$MaNguoiDung' AND MaSP = '$masp'";
        $result_sl = $connect->query($sql_sl);

        if ($result_sl) {
            $dong_sl = $result_sl->fetch_array(MYSQLI_ASSOC);
            $soluong = $dong_sl['SoLuong'];
        } else {
            echo "Error: " . $sql_sl . "<br>" . $connect->error;
        }

        // Lấy số lượng tồn kho của sản phẩm từ danh sách
        $sql_sltk = "SELECT SoLuong FROM danhsach WHERE MaSP = '$masp'";
        $result_sltk = $connect->query($sql_sltk);

        if ($result_sltk) {
            $dong_sltk = $result_sltk->fetch_array(MYSQLI_ASSOC);
            $soluongtonkho = $dong_sltk['SoLuong'];
        } else {
            echo "Error: " . $sql_sltk . "<br>" . $connect->error;
        }

        // Cập nhật số lượng tồn kho
        $soluongtonkho -= $soluong;
        $sql_update_sltk = "UPDATE danhsach SET SoLuong = '$soluongtonkho' WHERE MaSP = '$masp'";
        if (!$connect->query($sql_update_sltk)) {
            echo "Error: " . $sql_update_sltk . "<br>" . $connect->error;
        }

        // Xóa sản phẩm khỏi giỏ hàng
        $sql_delete_gh = "DELETE FROM giohang WHERE MaNguoiDung = '$MaNguoiDung' AND MaSP = '$masp'";
        if (!$connect->query($sql_delete_gh)) {
            echo "Error: " . $sql_delete_gh . "<br>" . $connect->error;
        }
    }
}



?>