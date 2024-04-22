<?php
$sql = "SELECT * FROM `nhasanxuat` WHERE 1";
$ds = $connect->query($sql);

if (!$ds) {
    die("Không thể thực hiện câu lệnh SQL: " . $connect->connect_error);
    exit();
}
?>

<link rel="stylesheet" href="./assets/css/style.css" />

<div class="container mt-3" id="products">
    <div class="row">
        <div class="col-12-md">
            <h3 class="header-ds bg_primary text-center text-white mb-1 p-1">DANH SÁCH NHÀ SẢN XUẤT</h3>
            <div class="table-responsive-lg ">
                <table class="table  table-hover">
                    <thead>
                        <tr>
                            <th class='col-1'>MÃ NHÀ SẢN XUẤT</th>
                            <th class='col-3'>TÊN NHÀ SẢN XUẤT</th>
                            <th class='col-1' colspan="2">HÀNH ĐỘNG</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($dong = $ds->fetch_array(MYSQLI_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . $dong["IdNSX"] . "</td>";
                            echo "<td>" . $dong["TenNSX"] . "</td>";                            
                            //Sửa nhà sản xuất
                            echo "<td><a href='index.php?do=nhasanxuat_sua&id=" . $dong["IdNSX"] . "'>
                                <i class='icon-user fa-solid fa-pen-to-square fa-xl' style='color: #cc041a;'></i></a></td>";
                            //Xoá nhà sản xuất
                            echo "<td><a href='index.php?do=nhasanxuat_xoa&id=" . $dong["IdNSX"] . "' 
                                onclick='return confirm(\"Bạn có muốn xóa người dùng " . $dong['TenNSX'] . " không?\")'>
                                <i class='icon-user fa-solid fa-trash fa-xl' style='color: #1c9c46;'></i></a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <a href="index.php?do=nhasanxuat_them" class="btn btn-success">THÊM NHÀ SẢN XUẤT</a>
        </div>
    </div>
</div>