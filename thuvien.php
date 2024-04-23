<?php
function BaoLoi($thongbao = "")
{
    echo "<script>alert('$thongbao');</script>";
    echo "

    ";
}

function ThongBao($thongbao = "")
{
    echo "<script>alert('$thongbao');</script>";

}

function AlertMess($message = "", $location = "index.php")
{
    echo "<script>alert('$message');</script>";
    echo '
        <script> window.location.href="' . $location . '"</script>;
        ';

}
?>