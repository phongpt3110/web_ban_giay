<?php
// Hủy SESSION
unset($_SESSION['MaND']);
unset($_SESSION['HoTen']);
unset($_SESSION['QuyenHan']);

// Chuyển hướng về trang index.php
echo '
    <script>
    window.location.href = "index.php";
    </script>
    ';

?>