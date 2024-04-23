<?php
if (isset($_GET["limit_home"]) == true)
    $_SESSION['limit_home'] += 4;
else
    $_SESSION['limit_home'] = 8;
// 
$limit_home_ok = $_SESSION['limit_home'];

$sql = "select t.MaSP, t.TenSP, t.IdNSX, t.AnhSP, t.Gia, t.SoLuong, t.MoTa, t.TiLeGiam, t.LuotXem, l.IdNSX, l.TenNSX
    from (nhasanxuat l inner join danhsach t on t.IdNSX=l.IdNSX)
    order by LuotXem DESC Limit 0," . $limit_home_ok;


$danhsach = $connect->query($sql);
//Nếu kết quả kết nối không được thì xuất báo lỗi và thoát
if (!$danhsach) {
    die("Không thể thực hiện câu lệnh SQL: " . $connect->connect_error);
    exit();
}

$sql1 = "select * from (nhasanxuat l inner join danhsach t on t.IdNSX=l.IdNSX)";
$danhsach2 = $connect->query($sql1);
$count_kq = mysqli_num_rows($danhsach2);


// Hiện ảnh tự động
include_once "anh_tudong.php";

?>

<!-- Hiển thị danh sách sản phẩm -->
<div class="container">
    <div class="row">
        <?php
        while ($ds = $danhsach->fetch_array(MYSQLI_ASSOC)) {
            // Tính giá giảm của sản phẩm
            $giagiam = $ds['Gia'] - (($ds['TiLeGiam'] / 100) * $ds['Gia']);
            echo '<div class="col-md-3 mt-2">';
            echo '  <div id="img-products">';
            // Hiển thi hình ảnh
            echo '<a href="index.php?do=kh_sanpham_chitiet&id=' . $ds['MaSP'] . '&IdNSX=' . $ds['IdNSX'] . '"> <img src="' . $ds["AnhSP"] . '"/></a>';
            // Hiển thị tỉ lệ giảm 
            if ($ds['TiLeGiam'] != 0) {
                echo '<h4 class="badge badge-lg bg-danger m-0">-' . $ds['TiLeGiam'] . '%</h4>';
            }
            echo '      <h6>' . $ds["TenSP"] . '</h6>';
            echo '      <div class="price-list">';
            // Nếu giảm thì hiển thị thông tin của 2 giá
            if ($ds['Gia'] == $giagiam) {
                echo '  <span class="price-sale ">' . number_format($giagiam, 0, ',', '.') . ' đ</span>';
            } else {
                echo '  <span class="price-sale ">' . number_format($giagiam, 0, ',', '.') . ' đ</span>';
                echo '  <span class="price">' . number_format($ds['Gia'], 0, ',', '.') . ' đ</span>';
            }
            echo '<div class="d-flex justify-content-end me-3 view"><span> Đã xem ' . $ds['LuotXem'] . '</span></div>';
            echo '      </div>';
            echo '  </div>';
            echo '</div>';
        }
        if ($count_kq > $_SESSION['limit_home']) {
            echo "<div >
                <a class='btn btn-info mt-3 text-white' href='index.php?do=home_trangtin&limit_home=ok' style='width: 120px; float: right;'>XEM THÊM</a>
                </div>";
        }
        ?>
    </div>
</div>