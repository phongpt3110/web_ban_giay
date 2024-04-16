<?php
$sql = "SELECT * FROM `nguoidung` WHERE 1";
$ds = $connect->query($sql);

if (!$ds) {
    die("Không thể thực hiện câu lệnh SQL: " . $connect->connect_error);
    exit();
}
?>


<div class="container mt-3">
    <div class="row">
        <div class="col-12-md">
            <h3 class="header-ds bg_primary text-center text-white mb-0 p-1">DANH SÁCH NGƯỜI DÙNG</h3>
            <div class="table-responsive-lg ">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th class='col-2'>MÃ NGƯỜI DÙNG</th>
                            <th class='col-3'>HỌ VÀ TÊN</th>
                            <th class='col-2'>TÊN ĐĂNG NHẬP</th>
                            <th class='col-2'>QUYỀN</th>
                            <th class='col-2' colspan="3">HÀNH ĐỘNG</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($dong = $ds->fetch_array(MYSQLI_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . $dong['MaNguoiDung'] . "</td>";
                            echo "<td style='text-align: left;'>" . $dong['TenNguoiDung'] . "</td>";
                            echo "<td style='text-align: left;'>" . $dong['TenDangNhap'] . "</td>";

                            // Quyền
                            echo "<td>";
                            if ($dong["QuyenHan"] == 0) {
                                // Hạ quyền
                                echo "Quản trị <a href='index.php?do=nguoidung_kichhoat&id=" . $dong["MaNguoiDung"] . "&quyen=1'>
                                <i class='icon-user fa-solid fa-circle-down fa-lg' style='color: #cc041a;'></i></a>";
                            } else {
                                // Nâng quyền
                                echo "Khách Hàng <a href='index.php?do=nguoidung_kichhoat&id=" . $dong["MaNguoiDung"] . "&quyen=0'>
                                <i class='icon-user fa-solid fa-circle-up fa-lg' style='color: #1c9c46;'></i></a>";
                            }
                            echo "</td>";

                            // Khoá tài khoản
                            echo "<td>";
                            if ($dong["Khoa"] == 0)
                                // Khoá tài khoản 
                                echo "<a href='index.php?do=nguoidung_kichhoat&id=" . $dong["MaNguoiDung"] . "&khoa=1'>
                                <i class='icon-user fa-solid fa-user-check fa-xl' style='color: #1c9c46;'></i></a>";
                            else
                                // Mở tài khoản
                                echo "<a href='index.php?do=nguoidung_kichhoat&id=" . $dong["MaNguoiDung"] . "&khoa=0'>
                                <i class='icon-user fa-solid fa-user-large-slash fa-xl' style='color: #cc041a;' ></i></a>";
                            echo "</td>";

                            //Sửa người dùng
                            echo "<td><a href='index.php?do=hosonguoidung&id=" . $dong["MaNguoiDung"] . "'>
                                <i class='icon-user fa-solid fa-pen-to-square fa-xl' style='color: #cc041a;'></i></a></td>";
                            //Xoá người dùng
                            echo "<td><a href='index.php?do=nguoidung_xoa&id=" . $dong["MaNguoiDung"] . "' 
                                onclick='return confirm(\"Bạn có muốn xóa người dùng " . $dong['TenNguoiDung'] . " không?\")'>
                                <i class='icon-user fa-solid fa-trash fa-xl' style='color: #1c9c46;'></i></a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <a class="btn btn-success">THÊM NGƯỜI DÙNG</a>
        </div>
    </div>
</div>