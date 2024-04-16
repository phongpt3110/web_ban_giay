<?php
// Kiểm tra quyền có tồn tại không
if (isset($_GET['quyen'])) {
    $sql = "UPDATE `nguoidung` SET `QuyenHan` = " . $_GET['quyen'] . " WHERE `MaNguoiDung` = " . $_GET['id'];
    $danhsach = $connect->query($sql);
    //Nếu kết quả kết nối không được thì xuất báo lỗi và thoát
    if (!$danhsach) {
        die("Không thể thực hiện câu lệnh SQL: " . $connect->connect_error);
        exit();
    }

    if ($danhsach) {
        // header("Location: index.php?do=nguoidung");
        ThongBao("Bạn đã chỉnh sửa quyền của thành công!!!");
        echo '<script>
            window.location.href = "index.php?do=nguoidung";
        </script>';
    } else
        BaoLoi("Danh sách không có !!!");

    // Kiểm tra khoá có tồn tại không
} elseif (isset($_GET["khoa"])) {

    $sql = "UPDATE `nguoidung` SET `Khoa` = " . $_GET['khoa'] . " WHERE `MaNguoiDung` = " . $_GET['id'];
    $danhsach1 = $connect->query($sql);
    //Nếu kết quả kết nối không được thì xuất báo lỗi và thoát
    if (!$danhsach1) {
        die("Không thể thực hiện câu lệnh SQL: " . $connect->connect_error);
        exit();
    }

    if ($danhsach1) {
        // header("Location: index.php?do=nguoidung");
        ThongBao("Bạn đã thay đổi thực hiện thao tác thành công");
        echo '<script>
                window.location.href = "index.php?do=nguoidung";
            </script>';
    } else
        ThongBaoLoi("Không thể mở danh sách!!");
} else {
    // header("Location: index.php?do=nguoidung");
    echo '<script>
            window.location.href = "index.php?do=nguoidung";
        </script>';
}

?>