<?php
    
    // Xử lý khi có tham số 'ok' được gửi đến server
    if(isset($_REQUEST['ok']))
    {
        if (isset($_GET["limit_home"]) == true)
            $_SESSION['limit_home'] += 4;
        else
            $_SESSION['limit_home'] = 8;
        
        $limit_home_ok = $_SESSION['limit_home'];
         
        $search = addslashes($_POST['search']);
        $sql = "SELECT * FROM danhsach WHERE TenSP LIKE '%$search%' OR MoTa LIKE '%$search%'";

        // thực thi câu truy vấn 
        $danhsach = $connect-> query($sql);
        // Nếu kết quả kết nối không được thì xuất báo lỗi và thoát
        if(!$danhsach)
        {
            die("Không thể thực hiện câu lệnh SQL: " . $connect->connect_error);
            exit();
        }
         //Đếm số dòng trả về trong sql
        $num = mysqli_num_rows($danhsach);
        $sql1 = "select * from (nhasanxuat l inner join danhsach t on t.IdNSX=l.IdNSX)";
        $danhsach2 = $connect->query($sql1);
        $count_kq = mysqli_num_rows($danhsach2);

         // Nếu $search rỗng thì báo lỗi, empty  kiểm tra có rỗng ko
        if(empty($search))
        {
            echo "Hãy nhập dữ liệu vào ô tìm kiếm";
        }
        else
        {
           // Ngược lại nếu nhập vào thì tiến hành xử lí
           //Giá trị num > 0 hoặc $search phải khác rỗng, tìm kiếm thì sẽ show ra màn hình hoặc thông báo lỗi 
           if($num > 0 && $search !="")
           {
                // Dùng $num để đếm số dòng trả về.
                echo "<h3>$num kết quả trả về với từ khóa <b>$search</b> <br /></h3>";

                // Hiện ảnh tự động
                include_once "anh_tudong.php";

                echo '<div class="container">
                    <div class="row">';
        
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

            echo' </div>
                </div>';
            }
            else {
                echo "Không tìm thấy kết quả!";
           }

        }
            
    }
          	
?>