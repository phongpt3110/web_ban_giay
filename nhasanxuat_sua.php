<?php
	if(isset($_GET['id'])) {
        // Lấy id từ tham số GET
        $id = $_GET['id'];

        // Lấy thông tin nhà sản xuất từ CSDL
        $sql = "SELECT * FROM `nhasanxuat` WHERE `IdNSX` = $id";
        $result = $connect->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $tenNSX = $row['TenNSX'];
        } else {
            // Nếu không tìm thấy bản ghi với id tương ứng, hiển thị thông báo lỗi
            BaoLoi("Không tìm thấy nhà sản xuất với ID này.");
        }

        // Xử lý khi form được gửi đi
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lấy thông tin từ FORM
            $tenNSX = $_POST['TenNSX'];

            // Kiểm tra tên nhà sản xuất không được rỗng
            if(trim($tenNSX) == "") {
                echo "Tên nhà sản xuất không được bỏ trống!";
            } else {
                // Cập nhật thông tin nhà sản xuất vào CSDL
                $sql = "UPDATE `nhasanxuat` SET `TenNSX` = '$tenNSX' WHERE `IdNSX` = $id";
                $result = $connect->query($sql);
                
                if ($result) {
                    // Nếu cập nhật thành công, hiển thị thông báo và chuyển hướng về trang danh sách nhà sản xuất
                    echo "Bạn đã cập nhật thành công nhà sản xuất $tenNSX";
                    echo '<script>window.location.href = "index.php?do=nhasanxuat";</script>'; 
                    exit();
                } else {
                    // Nếu có lỗi trong quá trình cập nhật, hiển thị thông báo
                    echo "Không thể cập nhật thông tin nhà sản xuất: " . $connect->error;
                }
            }
        }
    } else {
        // Nếu id không được cung cấp, hiển thị thông báo lỗi
        BaoLoi("ID không được cung cấp.");
    }
	
?>

<div class="container d-flex justify-content-center align-items-center">
        <div class="row border rounded-5 p-3 bg-white shadow ">
            <div class="col-md-12 ">
                <div class="row align-items-center">
                    <div class="header-text">
                        <h2 class="title text-center fs-2">CẬP NHẬT NHÀ SẢN XUẤT
                        </h2>
                    </div>
                    <!-- From cập nhật hãng sản xuất -->
                    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <!-- Ẩn mã hãng sản xuất -->
                        <input type="hidden" name="IdNSX" />
						<!-- Cập nhật tên hãng sản xuất -->
						<div class="form-floating mb-3 me-2 ">
							<input type="text" class="form-control" id="tsp" name="TenNSX">
							<label for="tsp">TÊN SẢN PHẨM</label>
						</div>
                        <!-- Bấm cập nhật hãng sản xuất -->
                        <div class="input-group mb-3  justify-content-center">
                            <input type="submit" name="submit" class="btn btn-lg btn-success w-30 fs-6"
                                value="CẬP NHẬT SẢN PHẨM" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>