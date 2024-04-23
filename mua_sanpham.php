<!--  Xử lý trường hợp mua -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy giá trị gán vào biến
    $MaNguoiDung = $_SESSION['MaNguoiDung'];
    $MaSanPham = $_POST['MaSP'];
    $TenSanPham = $_POST['TenSP'];
    $Gia = $_POST['Gia'];
    $AnhSP = $_POST['AnhSP'];
    $TiLeGiam = $_POST['TiLeGiam'];
    $SoLuong = $_POST['SoLuong'];
    $SoLuongMua = $_POST['SoLuongMua'];
    $DiaChi = $_SESSION['DiaChi'];

    if (!isset($_SESSION["HoTen"])) {
        // Nếu chưa đăng nhập, chuyển hướng người dùng đến trang đăng nhập
        echo "<script>
                window.location.href='index.php?do=dangnhap';
            </script>";
        exit; // Dừng việc thực hiện các lệnh tiếp theo
    }
    // Kiểm tra giá trị của nút submit
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'mua') {
            // Xử lý mua hàng
            echo '<div class="container mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="header-ds bg_primary text-center text-white mb-0 p-1">SẢN PHẨM</h3>
                        <div class="table-responsive-lg ">
                            <table class="table table-striped ">
                                <thead>
                                    <tr>
                                        <th class="col-1">MÃ SẢN PHẨM</th>
                                        <th class="col-2">TÊN SẢN PHẨM</th>
                                        <th class="col-1">SỐ LƯỢNG</th>
                                        <th class="col-2">ĐƠN GIÁ</th>
                                        <th class="col-2">HÌNH ẢNH</th>
                                        <th class="col-2">TỔNG</th>
                                        <th class="col-2">ĐỊA CHỈ</th>
                                    </tr>
                                </thead>
                                <tbody>';
            echo "<tr style='vertical-align: middle;'>";
            echo "<td>" . $MaSanPham . "</td>";
            echo "<td>" . $TenSanPham . "</td>";
            echo "<td>" . $SoLuongMua . "</td>";
            $giagiam = $Gia - (($TiLeGiam / 100) * $Gia);
            echo "<td>" . $giagiam . "</td>";
            echo "<td ><img src='" . $AnhSP . " ' width='100'></td>";
            $tong = $SoLuongMua * $giagiam;
            echo "<td>" . number_format($tong, 0, '.', '.') . " đ</td>";
            echo "<td>" . $DiaChi . "</td>";
            echo "</tr>";
            echo '</tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                        <form action="index.php?do=capnhat_soluong" method="post">
                            <input type="hidden" name="MaSanPham" value="' . $MaSanPham . '">
                            <input type="hidden" name="SoLuongMua" value="' . $SoLuongMua . '">
                            <button type="submit" class="btn btn-danger rounded-0"> THANH TOÁN</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>';
        } elseif ($_POST['action'] == 'themgiohang') {
            // Thêm sản phẩm
            $sql_check = "SELECT * FROM `giohang` WHERE `MaSP` = '$MaSanPham' AND `MaNguoiDung` = $MaNguoiDung ";

            $danhsach = $connect->query($sql_check);
            if (!$danhsach) {
                die("Không thể thực hiện câu lệnh kiểm tra: " . $connect->connect_error);
            }
            // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
            if ($danhsach && $danhsach->num_rows > 0) {
                // Cập nhật số lượng sp
                $sql_up = "UPDATE `giohang` SET `SoLuong` = $SoLuongMua WHERE `MaSP` = '$MaSanPham'  AND `MaNguoiDung` = $MaNguoiDung ";
                echo $sql_up;
                $ds = $connect->query($sql_up);
                if (!$ds) {
                    die("Không thể thực hiện câu lệnh cập nhật số lượng: " . $connect->connect_error);
                } else {
                    echo "<script>
                        if (!alert('Đã cập nhật số lượng trong giỏ hàng.')) {
                            location.href = 'index.php?do=giohang';
                        }
                    </script>";
                }
            } else {
                $giagiam = $Gia - (($TiLeGiam / 100) * $Gia);
                $sql_up = "INSERT INTO `giohang`( `MaNguoiDung`, `MaSP`, `TenSP`, `SoLuong`, `Gia`, `AnhSP`) VALUES
                        ($MaNguoiDung, $MaSanPham, '$TenSanPham', $SoLuongMua, $giagiam, '$AnhSP')";
                $ds = $connect->query($sql_up);
                if (!$ds) {
                    die("Không thể thực hiện câu lệnh thêm sản phẩm: " . $connect->connect_error);
                } else {
                    //Thông báo cho khác hàng
                    echo "<script>
                            if (!alert('Đã thêm sản phẩm vào giỏ hàng.')) {
                                window.location.href = 'index.php?do=giohang';
                            }
                    </script>";
                }
            }

        }
    }
}

