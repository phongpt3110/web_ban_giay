<script>
    function showPass() {
        var matKhau = document.getElementsByName('MatKhau')[0];

        if (matKhau.type === 'password') {
            matKhau.type = 'text';
        } else {
            matKhau.type = 'password';
        }
    }
</script>

<!-- from đăng nhập -->

<body>
    <!-- Thiết kế from đăng nhập -->
    <div id="fromRegis" class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <!-- Cột trái nền xanh  -->
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
                style="background: #103cbe;">
                <!-- Tiêu đề đăng nhập -->
                <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">
                    XIN CHÀO BẠN!
                </p>
                <small class="text-white text-wrap text-center"
                    style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Bạn có thể tham gia với chúng
                    tôi</small>
                <button type="button" class="btn btn-md btn-outline-light rounded-2 mt-2"><a
                        href="index.php?do=dangky">ĐĂNG KÝ</a></button>
            </div>
            <!-- Cột phải là from đăng nhập -->
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2 class="text-center fs-2"
                            style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">ĐĂNG
                            NHẬP</h2>
                    </div>

                    <!-- From đăng nhập -->
                    <form action="index.php?do=dangnhap_xuly" method="post">
                        <!-- Nhập tên tài khoản -->
                        <div class="input-group mb-3">
                            <input type="text" name="TenDangNhap" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Name">
                        </div>
                        <!-- Nhập password -->
                        <div class="input-group mb-1">
                            <input type="password" name="MatKhau" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Password">
                        </div>
                        <!-- Hiển thị mật khẩu -->
                        <div class="input-group mb-5 d-flex justify-content-between">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="formCheck" onclick="showPass()">
                                <label for="formCheck" class="form-check-label text-secondary"><small>Hiển thị mật
                                        khẩu</small></label>
                            </div>
                            <!-- Quên mật khẩu -->
                            <div class="forgot">
                                <small><a href="#">Quên mật khẩu?</a></small>
                            </div>
                        </div>
                        <!-- Bấm đăng nhập -->
                        <div class="input-group mb-3">
                            <input type="submit" name="Submit" class="btn btn-lg btn-primary w-100 fs-6"
                                value="ĐĂNG NHẬP" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>