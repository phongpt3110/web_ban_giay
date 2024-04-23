<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin sản phẩm và số lượng từ yêu cầu POST
    $MaSanPham = $_POST['MaSanPham'];
    $SoLuongMua = $_POST['SoLuongMua'];
    $sql = "SELECT * FROM `danhsach` WHERE `MaSP` = $MaSanPham";
    $danhsach = $connect->query($sql);

    if (!$danhsach) {
        die("Không thể thực hiện câu lệnh SQL: " . $connect->connect_error);
    }

    $dong = $danhsach->fetch_array(MYSQLI_ASSOC);

    $sql_update = "UPDATE `danhsach` SET `SoLuong` = `SoLuong` - $SoLuongMua WHERE `MaSP` = '$MaSanPham'";
    $danhsach_update = $connect->query($sql_update);

    if (!$danhsach_update) {
        die("Không thể thực hiện câu lệnh SQL: " . $connect->connect_error);
    } else {
        echo "<script>
                if (!alert('Đơn hàng của bạn sẽ đến trong vài ngày tới.')) {
                    window.location.href = 'index.php';
                }
            </script>";
    }

}
?>