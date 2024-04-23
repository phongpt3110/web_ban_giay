<?php
$MaSP = $_GET['id'];


$sql = "SELECT * FROM danhsach ds, nhasanxuat nsx
            WHERE ds.IdNSX = nsx.IdNSX AND ds.MaSP = '$MaSP'";

$danhsach = $connect->query($sql);
//Nếu kết quả kết nối không được thì xuất báo lỗi và thoát
if (!$danhsach) {
    die("Không thể thức hiện câu lệnh SQL: " . $connect->error);
}

$dong = $danhsach->fetch_array(MYSQLI_ASSOC);

// Tăng lượt xem 
$sql = "UPDATE `danhsach` SET LuotXem = LuotXem + 1 WHERE MaSP = '$MaSP'";
$luotxem = $connect->query($sql);


//TODO: Hiện hình ảnh chuyển tự động 
include "anh_tudong.php";

?>

<div class="container mt-3" id="detail-products">
    <div class="row">
        <h3 class=" bg_primary text-center text-white mb-2 p-1"><?php echo $dong['TenSP']; ?></h3>
        <div class="col-md-8 ">
            <div>
                <img class="img-view" src="<?php echo $dong['AnhSP'] ?> " alt="Ảnh sản phẩm">
            </div>
        </div>
        <div class="col-md-4 p-0">
            <h5 class="text-center text-danger pt-2"><?php echo $dong['TenNSX']; ?></h5>
            <hr>
            <p>Đơn giá:
                <?php
                echo '  <span class="price">' . number_format($dong['Gia'], 0, ',', '.') . ' đ</span>';
                ?>
            </p>
            <hr>
            <p>Đơn giá giảm:
                <?php
                $giagiam = $dong['Gia'] - (($dong['TiLeGiam'] / 100) * $dong['Gia']);
                echo '  <span class="price-sale ">' . number_format($giagiam, 0, ',', '.') . ' đ</span>';
                ?>
            </p>
            <hr>
            <p>Số lượng: <?php echo '<span> ' . $dong['SoLuong'] . '</span>'; ?></p>
            <hr>
            <p>Tỉ lệ giảm giá: <?php echo '<span class="price-sale ">' . $dong['TiLeGiam'] . "%</span>"; ?></p>
            <hr>
            <p>Mô tả:</p>
            <p class="describe"><?php echo $dong['MoTa']; ?></p>
            <hr>
            <!-- Mua sản phẩm -->
            <form method="post" action="index.php?do=mua_sanpham">
                <div class="mb-3 d-flex  align-items-center">
                    <label for="quantity" class="form-label me-5">Số lượng:</label>
                    <input style="width:50%;" type="number" id="quantity" class="form-control" name="SoLuongMua" min="1"
                        value="1" step="1" max="<?php echo $dong['SoLuong']; ?>" />
                </div>
                <input type="hidden" name="MaSP" value="<?php echo $dong['MaSP']; ?>">
                <input type="hidden" name="TenSP" value="<?php echo $dong['TenSP']; ?>">
                <input type="hidden" name="SoLuong" value="<?php echo $dong['SoLuong']; ?>">
                <input type="hidden" name="Gia" value="<?php echo $dong['Gia']; ?>">
                <input type="hidden" name="TiLeGiam" value="<?php echo $dong['TiLeGiam']; ?>">
                <input type="hidden" name="AnhSP" value="<?php echo $dong['AnhSP']; ?>">
                <button type="submit" class="btn btn-success rounded-0 w-40" name="action" value="mua">
                    MUA NGAY</button>
                <button type="submit" class="btn btn-warning rounded-0 float-end" name="action" value="themgiohang">
                    THÊM VÀO GIỎ HÀNG</button>
            </form>
        </div>
    </div>
</div>
<?php
// echo '<h3>Sản phẩm cùng nhà sản xuất </h3>';
echo '<h4 class="text-center  mt-3 p-1">SẢN PHẨM KHÁC CỦA NHÀ <strong>' . $dong['TenNSX'] . '</strong> </h4>';
include "kh_sanpham_NSX.php";
?>