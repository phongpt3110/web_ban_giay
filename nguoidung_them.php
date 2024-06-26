<!-- Thiết kế from đăng nhập -->
<div id="fromRegis" class="container d-flex justify-content-center align-items-center">
    <div class="row border rounded-5 p-4 bg-white shadow box-area">

        <div class="col-md-12">
            <div class="row align-items-center">
                <div class="header-text mb-2">
                    <h2 class="text-center fs-2"
                        style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">ĐĂNG
                        KÝ</h2>
                </div>
                <!-- From ĐĂNG KÝ-->
                <form action="index.php?do=dangky_xuly" method="post">
                    <!-- Nhập tên hiển thị -->
                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label"></label>
                        <input type="email" class="form-control" id="email" placeholder="Nhập Email" name="email">
                    </div>
                    <!-- Nhập tên tài khoản -->
                    <div class="input-group mb-3">
                        <input type="text" name="HoVaTen" class="form-control form-control-lg bg-light fs-6"
                            placeholder="Tên người dùng">
                    </div>
                    <!-- Nhập tên tài khoản -->
                    <div class="input-group mb-3">
                        <input type="text" name="TenDangNhap" class="form-control form-control-lg bg-light fs-6"
                            placeholder="Tên đăng nhập">
                    </div>
                    <!-- Nhập password -->
                    <div class="input-group mb-3">
                        <input type="password" name="MatKhau" class="form-control form-control-lg bg-light fs-6"
                            placeholder="Mật khẩu">
                    </div>
                    <!-- Nhập password -->
                    <div class="input-group mb-3">
                        <input type="password" name="XacNhanMatKhau" class="form-control form-control-lg bg-light fs-6"
                            placeholder="Xác nhận mật khẩu">
                    </div>
                    <!-- Địa chỉ -->
                    <div class=" input-group mb-3">
                        <input type="text" name="DiaChi" class="form-control form-control-lg bg-light fs-6"
                            placeholder="Địa chỉ">
                    </div>
                    <!-- Bấm đăng nhập -->
                    <div class="input-group mb-3">
                        <input type="submit" name="Submit" class="btn btn-lg btn-primary w-100 fs-6" value="ĐĂNG KÝ" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>