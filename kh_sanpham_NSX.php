<?php
// Lây mã nhà sản xuất
if (isset($_GET["limit"])) {
    $_SESSION['limit'] += 4;
} else {
    // khởi tạo limit hiển thị 8 sản phẩm
    $_SESSION['limit'] = 8;
}

$limit_ok = $_SESSION['limit'];

// Lấy id nhà sản xuất
$IdNSX = $_GET["IdNSX"];

// Lấy dữ liệu SQL nhà sản xuất
$sql = "select * from `nhasanxuat` where IdNSX ='" . $IdNSX . "'";
$danhsach = $connect->query($sql);
$row = $danhsach->fetch_array(MYSQLI_ASSOC);

// Lấy danh sách 
$sql1 = "select * from `danhsach` where IdNSX ='" . $IdNSX . "' ORDER by `MaSP` DESC LIMIT 0, " . $limit_ok;
$danhsach1 = $connect->query($sql1);
//Nếu kết quả kết nối không được thì xuất báo lỗi và thoát
if (!$danhsach1) {
    die("Không thể thực hiện câu lệnh DANH SÁCH: " . $connect->connect_error);
    exit();
}

// Danh sách số lượng sản phẩm
$sql2 = "select * from danhsach where IdNSX='" . $IdNSX . "'";
$danhsach2 = $connect->query($sql2);
$count_sp_nsx = mysqli_num_rows($danhsach2);

//TODO: Nếu id tồn tại không (ở giữa) hiện trên SẢN PHẨM CHI TIẾT
if (!isset($_GET['id'])) {
    // Hiển thị hình ảnh tự động
    include_once "anh_tudong.php";
}


echo '<div class="container">';
echo '<div class="row">';
while ($ds = $danhsach1->fetch_array(MYSQLI_ASSOC)) {
    // Tính giá giảm của sản phẩm
    $giagiam = $ds['Gia'] - (($ds['TiLeGiam'] / 100) * $ds['Gia']);
    echo '<div class="col-md-3 mt-2">';
    echo '  <div id="img-products">';
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
echo '</div>';
echo '</div>';

if ($count_sp_nsx > $_SESSION['limit']) {
    echo "<div >
        <a class='btn btn-info mt-3 text-white' href='index.php?do=kh_sanpham_NSX&IdNSX=' " . $row['IdNSX'] . " style='width: 120px; float: right;'>XEM THÊM " . $row['TenNSX'] . " </a>
        </div>";
}
?>