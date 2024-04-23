<script>
    // Lắng nghe sự kiện khi người dùng chọn hoặc bỏ chọn sản phẩm
    function updateBuyButton() {
        // Lấy tất cả các phần tử checkbox trong bảng
        var checkboxes = document.querySelectorAll('.product:checked');
        var buyButton = document.getElementById('buy-button');
        var check_box = false;
        var tong = 0;
        var sanpham_xoa = [];

        // Kiểm tra xem có ít nhất một sản phẩm được chọn hay không
        checkboxes.forEach(function (checkbox) {
            if (checkbox.checked) {
                check_box = true;

                // Lấy giá tiền
                var row = checkbox.parentNode.parentNode;
                var gia = parseFloat(row.cells[4].innerText.replace(' đ', ''));
                // Lấy số lượng sản phẩm
                var soluong = parseFloat(row.cells[3].innerText);
                var masp = checkbox.value;

                // Thêm sản phẩm vào danh sách cần xóa
                sanpham_xoa.push(masp);

                // Tính tổng giá tiền sản phẩm
                tong += gia * soluong;
            }
        });

        if (check_box) {
            buyButton.removeAttribute('disabled');
        } else {
            buyButton.setAttribute('disabled', 'disabled');
        }
        // Hiển thị tổng tiền
        document.getElementById('total-amout').innerText = 'TỔNG THANH TOÁN:  ' + tong.toLocaleString() + ' đ';

        // Cập nhật danh sách sản phẩm cần xóa
        document.getElementById('sanpham_xoa').value = sanpham_xoa.join(',');
    }
</script>

<?php
$MaNguoiDung = $_SESSION['MaNguoiDung'];
$DiaChi = $_SESSION['DiaChi'];
// Xử lý thêm vào giỏ hàng
$sql = "SELECT gh.*, ds.TiLeGiam as TiLeGiam FROM giohang gh, danhsach ds WHERE gh.MaNguoiDung = '$MaNguoiDung' and ds.MaSP=gh.MaSP";
$danhsach = $connect->query($sql);
$num = mysqli_num_rows($danhsach);


// Nếu có ít nhất một mục trong giỏ hàng
if ($num > 0) {
    echo '<div class="container mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="header-ds bg_primary text-center text-white mb-0 p-1">SẢN PHẨM</h3>
                        <div class="table-responsive-lg ">
                            <table class="table table-striped text-center">
                                <thead>
                                    <tr>
                                        <th class="col-1">MUA</th>
                                        <th class="col-1">MÃ SẢN PHẨM</th>
                                        <th class="col-2">TÊN SẢN PHẨM</th>
                                        <th class="col-1">SỐ LƯỢNG</th>
                                        <th class="col-1">ĐƠN GIÁ</th>
                                        <th class="col-1">HÌNH ẢNH</th>
                                        <th class="col-2">TỔNG</th>
                                        <th class="col-1">XOÁ</th>
                                    </tr>
                                </thead>
                                <tbody>';
    while ($dong = $danhsach->fetch_array(MYSQLI_ASSOC)) {
        echo "<tr style='vertical-align: middle;'>";
        echo "<td> <input type='checkbox' name='check' class='product' value='" . $dong['MaSP'] . "' onchange='updateBuyButton()'/> </td>";
        echo "<td>" . $dong['MaSP'] . "</td>";
        echo "<td>" . $dong['TenSP'] . "</td>";
        echo "<td>" . $dong['SoLuong'] . "</td>";
        $giagiam = $dong['Gia'] - (($dong['TiLeGiam'] / 100) * $dong['Gia']);
        echo "<td>" . $giagiam . " đ</td>";
        echo "<td ><img src='" . $dong['AnhSP'] . " ' width='100'></td>";
        $tong = $dong['SoLuong'] * $giagiam;
        echo "<td>" . $tong . " đ</td>";
        echo "<td> <a href='index.php?do=giohang_xoa&id=" . $dong['MaSP'] . "&MaND=" . $MaNguoiDung .
            "'onclick='return confirm(\"Bạn có muốn xóa bài viết " . $dong['TenSP'] .
            " không?\")'>
                <i class='fa-solid fa-trash fa-xl' style='color: #cc041a;'></i></a>
            </td>";
        echo "</tr>";
    }
    echo '</tbody>
                </table>
                </div>
                <div class="d-flex justify-content-end align-items-center" >
                <p class="m-0 p-2 bg_primary text-white">
                    <span id="total-amout">TỔNG THANH TOÁN </span>
                </p>
                <form action="index.php?do=giohang_mua" method="post">
                    <input type="hidden" name="MaNguoiDung" value="' . $MaNguoiDung . '">
                    <input type="hidden" name="SanPhamXoa" id="sanpham_xoa" value="">
                    <button type="submit" class="btn btn-danger rounded-0 px-5 mx-5" id="buy-button" disabled > MUA HÀNG</button>
                </form>
                </div>
            </div>
        </div>
    </div>';
} else {
    echo "<h2>Bạn chưa thêm gì vào giỏ hàng</h2>";
}

?>