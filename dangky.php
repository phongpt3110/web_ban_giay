<!-- Form đăng ký -->
<form action="dangky.php" method="POST">
    <!-- Các trường nhập dữ liệu của form đăng ký -->
    <!-- Ví dụ: -->
    <div class="mb-3">
        <label for="username" class="form-label">Tên đăng nhập</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Tên đăng nhập">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mật khẩu</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
    </div>
    <button type="submit" class="btn btn-primary">Đăng ký</button>
</form>