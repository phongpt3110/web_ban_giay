<div class="container">
    <div class="row">
        <!-- Hiển thị menu nhà sản xuất -->
        <div class="col-md-3">
            <?php
            $sql = "select * from `nhasanxuat` WHERE 1";
            $ds = $connect->query($sql);
            //Nếu kết quả kết nối không được thì xuất báo lỗi và thoát
            if (!$ds) {
                die("Không thể thực hiện câu lệnh SQL: " . $connect->connect_error);
            }
            echo '<!-- Hiện thị menu đứng -->
                <ul class="nav flex-column nav-list ">
                    <h4 class="bg_primary text-white p-2 m-0">NHÀ SẢN XUẤT</h4>';
            while ($row = $ds->fetch_array(MYSQLI_ASSOC)) {
                echo '<li class="nav-item">
                    <a class="nav-link" href="index.php?do=kh_sanpham_NSX&IdNSX=' . $row['IdNSX'] . '">
                        <span>
                            <i class="icon-nav fa-solid fa-user-tie"></i>
                            ' . $row['TenNSX'] . '
                        </span>
                    </a>
                </li>';
            }
            echo '</ul> ';
            ?>
        </div>


        <!-- Hiện hình ảnh tự động chuyển -->
        <div class="col-md-9">
            <!-- Cột sản phẩm -->
            <!-- Tạo hiệu ứng chuyển ảnh -->
            <!-- . Hiệu ứng slide 2.Tự động chuyển trang 3. Đặt thời gian 4.Dừng khi hover 5. Chuyển vòng lặp 6. Cho phép nhắn bàn phím -->
            <div id="carouselControls" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000"
                data-bs-pause="hover" data-bs-wrap="true" data-bs-keyboard="true" data-bs-touch="true"
                data-bs-rtl="true">
                <!-- Hiển thị hình ảnh -->
                <div class="carousel-inner">
                    <div class="carousel-item">
                        <img src="./assets/images/conver_white_low.jpg" class="d-block" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="./assets/images/converse_1970s.jpg" class="d-block" alt="...">
                    </div>
                    <div class="carousel-item active">
                        <img src="./assets/images/converse_1970s_white.jpg" class="d-block" alt="...">
                    </div>
                </div>
                <!-- Nút chuyển về trước -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls"
                    data-bs-slide="prev">
                    <i class="fa-solid fa-angles-left fa-2xl" style="color: #0f3057;"></i>
                    <span class="visually-hidden">Previous</span>
                </button>
                <!-- Nút chuyển về sau  -->
                <button class="carousel-control-next" type="button" data-bs-target="#carouselControls"
                    data-bs-slide="next">
                    <i class="fa-solid fa-angles-right fa-2xl" style="color: #0f3057;"></i>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>