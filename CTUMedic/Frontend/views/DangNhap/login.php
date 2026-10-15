<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4 p-sm-5">

                    <!-- Tiêu đề -->
                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-primary">Đăng nhập</h3>
                        <p class="text-muted small">Nhập số điện thoại và mật khẩu để tiếp tục</p>
                    </div>

                    <!-- Form Đăng Nhập -->
                    <form action="" method="POST">
                        <!-- Nhập Số điện thoại -->
                        <div class="form-floating mb-3">
                            <input type="tel" 
                                   class="form-control rounded-3" 
                                   id="phone" 
                                   name="phone" 
                                   placeholder="0912345678" 
                                   pattern="[0-9]{10}" 
                                   required>
                            <label for="phone">Số điện thoại</label>
                        </div>

                        <!-- Nhập Mật khẩu -->
                        <div class="form-floating mb-3">
                            <input type="password" 
                                   class="form-control rounded-3" 
                                   id="password" 
                                   name="password" 
                                   placeholder="Mật khẩu" 
                                   required>
                            <label for="password">Mật khẩu</label>
                        </div>

                        <!-- Nhóm Nút bấm -->
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg rounded-3 fw-semibold">
                                Đăng nhập
                            </button>
                            <button type="reset" class="btn btn-outline-secondary rounded-3">
                                Xóa nhập lại
                            </button>
                        </div>
                    </form>

                    <!-- Chuyển sang Đăng ký -->
                    <div class="text-center mt-4 pt-2 border-top">
                        <span class="text-muted small">Chưa có tài khoản? </span>
                        <a href="index.php?page=register" class="text-primary text-decoration-none fw-semibold small">
                            Đăng ký ngay
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>