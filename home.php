<div class="container">
    <div class="row">
        <!-- Khung sản phẩm -->
        <?php
        $sql = "SELECT * FROM `danhsach` WHERE 1";
        $danhsach = $connect->query($sql);
        ?>
        <?php
        while ($ds = $danhsach->fetch_array(MYSQLI_ASSOC)) {
            // Tính giá giảm của sản phẩm
            $giagiam = $ds['Gia'] - (($ds['TiLeGiam'] / 100) * $ds['Gia']);
            echo '<div class="col-md-3 mt-2">';
            echo '  <div id="img-products">';
            echo '      <img src="' . $ds["AnhSP"] . '"/>';
            echo '      <h6>' . $ds["TenSP"] . '</h6>';
            echo '      <div class="price-list">';
            // Nếu giảm thì hiển thị thông tin của 2 giá
            if ($ds['Gia'] == $giagiam) {
                echo '  <span class="price-sale">' . number_format($giagiam, 0, ',', '.') . ' đ</span>';
            } else {
                echo '  <span class="price-sale">' . number_format($giagiam, 0, ',', '.') . ' đ</span>';
                echo '  <span class="price">' . number_format($ds['Gia'], 0, ',', '.') . ' đ</span>';
            }
            echo '      </div>';

            echo '  </div>';
            echo '</div>';
        }
        ?>

    </div>
</div>