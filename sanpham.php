<?php
$sql = "SELECT * FROM danhsach ds, nhasanxuat nsx
            WHERE ds.IdNSX = nsx.IdNSX ORDER BY `MaSP` DESC";
$ds = $connect->query($sql);

if (!$ds) {
    die("Không thể thực hiện câu lệnh SQL: " . $connect->connect_error);
    exit();
}
?>


<div class="container mt-3" id="products">
    <div class="row">
        <div class="col-12-md">
            <div class="header-text d-flex justify-content-center align-items-center mb-2">
                <h3 class="header-ds flex-grow-1 text-center">DANH SÁCH SẢN PHẨM</h3>
                <a href="index.php?do=sanpham_them" class="btn btn-warning">THÊM SẢN PHẨM</a>
            </div>
            <div class="table-responsive-lg ">
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th class='col-1'>MÃ SẢN PHẨM</th>
                            <th class='col-3'>TÊN SẢN PHẨM</th>
                            <th class='col-1'>NHÀ SẢN XUẤT</th>
                            <th class='col-1'>SỐ LƯỢNG</th>
                            <th class='col-2'>ĐƠN GIÁ</th>
                            <th class='col-2'>HÌNH ẢNH</th>
                            <th class='col-1' colspan="2">HÀNH ĐỘNG</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($dong = $ds->fetch_array(MYSQLI_ASSOC)) {
                            // Giá giảm theo tỉ lệ
                            $giagiam = $dong['Gia'] - (($dong['TiLeGiam'] / 100) * $dong['Gia']);
                            echo "<tr>";
                            echo "<td>" . $dong['MaSP'] . "</td>";
                            echo "<td><a class='text-info' href='index.php?do=sanpham_chitiet&id=" . $dong["MaSP"] . "'>" . $dong['TenSP'] . "</a></td>";
                            echo "<td>" . $dong['TenNSX'] . "</td>";
                            echo "<td>" . $dong["SoLuong"] . "</td>";
                            // Hiện sản phẩm giảm giá
                            if ($dong['Gia'] == $giagiam) {
                                echo "<td>" . number_format($giagiam, 0, ',', '.') . "đ</td>";
                            } else {
                                echo "<td>" . number_format($giagiam, 0, '.', '.') . "đ <i class='icon-discount fa-solid fa-caret-down' style='color: #c92626;'></i></td>";
                            }
                            echo "<td><img src='" . $dong['AnhSP'] . "' width='100'/></td>";
                            echo "<td>
                                        <a href='index.php?do=sanpham_sua&id=" . $dong['MaSP'] . "'>
                                        <i class='icon-up fa-solid fa-pen-to-square fa-xl'>
                                        </i></a>
                                    </td>";
                            echo "<td>
                                        <a href='index.php?do=sanpham_xoa&id=" . $dong['MaSP'] .
                                "'onclick='return confirm(\"Bạn có muốn xóa bài viết " . $dong['TenSP'] .
                                " không?\")'>
                                        <i class='icon-del fa-solid fa-trash fa-xl'></i></a>
                                    </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>