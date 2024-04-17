<!-- Xử lý from  -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy giá trị gán vào biến
    $TenSanPham = $_POST['TenSanPham'];
    $Gia = $_POST['Gia'];
    $NhaSanXuat = $_POST['NhaSanXuat'];
    $SoLuong = $_POST['SoLuong'];
    $TiLeGiam = $_POST['TiLeGiam'];
    $MoTa = $_POST['MoTa'];


    if (trim($TenSanPham) == "") {
        BaoLoi("Tên sản phẩm không được để trống");
    } elseif (trim($NhaSanXuat) == "") {
        BaoLoi("Bạn chưa chọn nhà sản xuất");
    } elseif (trim($Gia) == "" || !is_numeric($Gia)) {
        BaoLoi("Giá sản phẩm phải là số");
    } elseif (trim($SoLuong) == "" || !is_numeric($SoLuong)) {
        BaoLoi("Số lượng sản phẩm phải là số");
    } elseif (trim($TiLeGiam) != "" && !is_numeric($TiLeGiam)) {
        BaoLoi("Tỉ lệ giảm của sản phẩm phải là số");
    } else {
        // Lưu tập tin vào thu mục
        $target_path = "./assets/images/";
        $target_path = $target_path . basename($_FILES['HinhAnh']['name']);
        if (move_uploaded_file($_FILES['HinhAnh']['tmp_name'], $target_path)) {
            // echo "Tập tin " .basename($_FILES["HinhAnh"]["name"]) . " đã được upload!";
            echo '';
        } else {
            echo 'Tập tin bạn đã load thành công';
        }
        // Up dữ liệu lên database
        $sql = "INSERT INTO `danhsach` (`TenSP`, `IdNSX`, `Gia`,  `TiLeGiam`, `SoLuong`, `MoTa`, `AnhSP`, `LuotXem`)
                    VALUES ('$TenSanPham','$NhaSanXuat','$Gia','$TiLeGiam','$SoLuong','$MoTa','$target_path', 0)";
        $ds = $connect->query($sql);
        if (!$ds) {
            die("Không thể thực hiện câu lệnh SQL: " . mysqli_connect_error());
        } else {
            ThongBao("Bạn đã thêm thành công sản phẩm $TenSanPham");
            echo '<script>
                    window.location.href = "index.php?do=sanpham";
                </script>';
        }
    }
}
?>
<!-- from đăng sản phẩm -->

<body>
    <!-- Thiết kế from đăng sản phẩm -->
    <div id="fromProduct" class="container d-flex justify-content-center align-items-center">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-12 ">
                <div class="row align-items-center">
                    <div class="header-text">
                        <h2 class="title text-center fs-2">THÔNG TIN SẢN PHẨM
                        </h2>
                    </div>
                    <!-- From đăng đăng sản phẩm -->
                    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"
                        enctype="multipart/form-data" class="was-validated">
                        <div class="d-flex">
                            <!-- Nhập tên sản phảm -->
                            <div class="form-floating mb-3 me-2 w-50">
                                <input type="text" class="form-control" id="tsp" name="TenSanPham" required>
                                <label for="tsp">TÊN SẢN PHẨM</label>
                            </div>
                            <!-- Nhập giá sản phảm -->
                            <div class="form-floating mb-3 w-50">
                                <input type="text" class="form-control" id="gsp" name="Gia" required>
                                <label for="gsp">GIÁ SẢN PHẨM</label>
                            </div>
                        </div>
                        <div class="d-flex">
                            <!-- Nhập nhà sản xuất -->
                            <div class="form-floating mb-3 me-2 w-50">
                                <select class="form-select" id="sel" name="NhaSanXuat" required>
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
                                        echo "<option value = '" . $item["IdNSX"] . "'>" . $item['TenNSX'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <label for="sel1" class="form-label">NHÀ SẢN XUẤT</label>
                            </div>
                            <!-- Nhập số lượng -->
                            <div class="form-floating mb-3 w-50">
                                <input type="text" class="form-control" id="sl" name="SoLuong" required>
                                <label for="sl">SỐ LƯỢNG</label>
                            </div>
                        </div>
                        <div class="d-flex">
                            <!-- Nhập tỉ lệ giảm giá -->
                            <div class="form-floating mb-3 me-2 w-50">
                                <input type="text" class="form-control" id="tlgg" name="TiLeGiam">
                                <label for="tlgg">TỈ LỆ GIẢM GIÁ</label>
                            </div>
                            <!-- Nhập hình ảnh -->
                            <div class="form-floating mb-3 w-50">
                                <input type="file" class="form-control" id="ha" name="HinhAnh">
                                <label for="ha">HÌNH ẢNH</label>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <!-- Nhập mô tả -->
                            <textarea class="form-control" id="cm" name="MoTa"></textarea>
                            <label for="cm">MÔ TẢ</label>
                        </div>

                        <!-- Bấm đăng sản phẩm -->
                        <div class="input-group mb-3  justify-content-center">
                            <input type="submit" name="submit" class="btn btn-lg btn-success w-30 fs-6"
                                value="ĐĂNG SẢN PHẨM" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>