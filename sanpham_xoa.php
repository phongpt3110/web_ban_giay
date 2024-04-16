<?php


// Tiếp tục với mã PHP còn lại ở đây
$sql = "DELETE FROM `danhsach` WHERE MaSP = " . $_GET['id'];
$ds = $connect->query($sql);
if (!$ds) {
    die('Không thể thực hiện câu lệnh SQL: ' . $connect->connect_error);
    exit();
} else {
    ThongBao("Bạn đã xoá thành công sản phẩm!!");
    echo '<script>
            window.location.href = "index.php?do=sanpham";
        </script>';
}

?>