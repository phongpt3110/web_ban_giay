<?php
$sql = "DELETE FROM `danhsach` WHERE MaSP = " . $_GET['id'];
$ds = $connect->query($sql);
if (!$ds) {
    die('Không thể thực hiện câu lệnh SQL: ' . $connect->connect_error);
} else {
    header('Location: index.php?do=sanpham');
}

?>