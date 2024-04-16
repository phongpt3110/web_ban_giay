<?php
// Lấy danh sách đổ vào nhóm 
$sql = "SELECT * FROM `danhsach` WHERE MaSP = " . $_GET['id'];
$ds = $connect->query($sql);
//Nếu kết quả kết nối không được thì xuất báo lỗi và thoát
if (!$ds) {
    die("Không thể thực hiện câu lệnh SQL: " . $connect->connect_error);
}
// Lặp qua các cột
$dong = $ds->fetch_array(MYSQLI_ASSOC);
?>

<!-- Xử lý from  -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy giá trị gán vào biến
    $MaSanPham = $_POST['MaSanPham'];
    $TenSanPham = $_POST['TenSanPham'];
    $Gia = $_POST['Gia'];
    $NhaSanXuat = $_POST['NhaSanXuat'];
    $SoLuong = $_POST['SoLuong'];
    $TiLeGiam = $_POST['TiLeGiam'];
    $MoTa = $_POST['MoTa'];


    if (trim($TenSanPham) == "")
        BaoLoi("Tên sản phẩm không được để trống");
    elseif (trim($NhaSanXuat) == "")
        BaoLoi("Bạn chưa chọn nhà sản xuất");
    elseif (trim($Gia) == "" || !is_numeric($Gia))
        BaoLoi("Giá sản phẩm phải là số");
    elseif (trim($SoLuong) == "" || !is_numeric($SoLuong))
        BaoLoi("Số lượng sản phẩm phải là số");
    elseif (!is_numeric($TiLeGiam))
        BaoLoi("Tỉ lệ giảm của sản phẩm phải là số");
    else {
        // Lấy hình ảnh hiện tại
        $target_path = $dong['AnhSP'];

        // Xử lý tải lên hình ảnh mới và cập nhật URL
        if (!empty($_FILES['HinhAnh']["name"])) {
            //Lưu tập tin upload vào thư mục hinhanh
            $target_path = "./assets/images/";
            $target_path = $target_path . basename($_FILES['HinhAnh']['name']);
            // di chuyển hình ảnh vào thư mục
            move_uploaded_file($_FILES['HinhAnh']['tmp_name'], $target_path);
        }
        // Câu lệnh cập nhật
        $sql = "UPDATE `danhsach`
                    SET 
                    `TenSP` = '$TenSanPham',
                    `IdNSX` = '$NhaSanXuat',
                    `Gia` = '$Gia',
                    `MoTa` = '$MoTa',
                    `SoLuong` = '$SoLuong',
                    `TiLeGiam` = '$TiLeGiam',
                    `AnhSP` = '$target_path'
                    WHERE `MaSP` = '$MaSanPham'";

        $ds = $connect->query($sql);
        if (!$ds) {
            die("Không thể thực hiện câu lệnh SQL: " . mysqli_connect_error());
        } else {
            ThongBao("Bạn đã cập nhật thành công sản phẩm $TenSanPham");
            echo '<script>
                    window.location.href = "index.php?do=sanpham";
                </script>';
        }
    }
}
?>


<body>
    <!-- Thiết kế from cập nhật sản phẩm -->
    <div id="fromProduct" class="container d-flex justify-content-center align-items-center">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-12 ">
                <div class="row align-items-center">
                    <div class="header-text">
                        <h2 class="title text-center fs-2">CẬP NHẬT SẢN PHẨM
                        </h2>
                    </div>
                    <!-- From cập nhật sản phẩm -->
                    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"
                        enctype="multipart/form-data">
                        <!-- Ẩn mã sản phẩm -->
                        <input type="hidden" name="MaSanPham" value="<?php echo $dong['MaSP']; ?>" />

                        <div class="d-flex">
                            <!-- Cập nhật tên sản phảm -->
                            <div class="form-floating mb-3 me-2 w-50">
                                <input type="text" class="form-control" id="tsp" name="TenSanPham"
                                    value="<?php echo $dong['TenSP']; ?>">
                                <label for="tsp">TÊN SẢN PHẨM</label>
                            </div>
                            <!--Cập nhật giá sản phảm -->
                            <div class="form-floating mb-3 w-50">
                                <input type="text" class="form-control" id="gsp" name="Gia"
                                    value="<?php echo $dong['Gia']; ?>">
                                <label for="gsp">GIÁ SẢN PHẨM</label>
                            </div>
                        </div>
                        <div class="d-flex">
                            <!--Cập nhật nhà sản xuất -->
                            <div class="form-floating mb-3 me-2 w-50">
                                <select class="form-select" id="sel" name="NhaSanXuat">
                                    <option value="">--Chọn--</option>
                                    <?php
                                    $sql = "SELECT * FROM `nhasanxuat` WHERE 1 ORDER BY `TenNSX` ";
                                    // Nếu không kết nối thì báo lỗi
                                    $ds = $connect->query($sql);
                                    if (!$ds) {
                                        die("Không thể thực hiện câu lệnh SQL: " . $connect->connect_errno);
                                    }
                                    // Lấy danh sách 
                                    while ($item = $ds->fetch_array(MYSQLI_ASSOC)) {
                                        if ($dong["IdNSX"] == $item["IdNSX"]) {
                                            echo "<option value = '" . $item["IdNSX"] . "' selected = 'selected'>" . $item['TenNSX'] . "</option>";
                                        } else {
                                            echo "<option value='" . $item['IdNSX'] . "'>" . $item['TenNSX'] . "</option>";

                                        }
                                    }
                                    ?>
                                </select>
                                <label for="sel1" class="form-label">NHÀ SẢN XUẤT</label>
                            </div>
                            <!-- Cập nhật số lượng -->
                            <div class="form-floating mb-3 w-50">
                                <input type="text" class="form-control" id="sl" name="SoLuong"
                                    value="<?php echo $dong['SoLuong']; ?>">
                                <label for="sl">SỐ LƯỢNG</label>
                            </div>
                        </div>
                        <div class="d-flex">
                            <!-- Cập nhật tỉ lệ giảm giá -->
                            <div class="form-floating mb-3 me-2 w-50">
                                <input type="text" class="form-control" id="tlgg" name="TiLeGiam"
                                    value="<?php echo $dong['TiLeGiam']; ?>">
                                <label for="tlgg">TỈ LỆ GIẢM GIÁ</label>
                            </div>
                            <!-- Cập nhật hình ảnh -->
                            <div class="form-floating mb-3 w-50">
                                <input type="file" class="form-control" id="ha" name="HinhAnh" accept="image/*">
                                <label for="ha">HÌNH ẢNH</label>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <!-- Cập nhật mô tả -->
                            <textarea class="form-control" id="cm" name="MoTa"><?php echo $dong['MoTa']; ?></textarea>
                            <label for="cm">MÔ TẢ</label>
                        </div>

                        <!-- Bấm đăng sản phẩm -->
                        <div class="input-group mb-3  justify-content-center">
                            <input type="submit" name="submit" class="btn btn-lg btn-success w-30 fs-6"
                                value="CẬP NHẬT SẢN PHẨM" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>