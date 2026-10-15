<?php
$success_msg = "";
$error_msg = "";

// Danh sách chuyên khoa mẫu của CTUMedic
$specialties = [
    'Khoa Nội tổng hợp',
    'Khoa Ngoại',
    'Khoa Mắt',
    'Khoa Tai Mũi Họng',
    'Khoa Răng Hàm Mặt',
    'Khoa Da liễu',
    'Khoa Nhi'
];

// Danh sách học vị / chức danh
$degrees = [
    'Bác sĩ Chuyên khoa I (BS.CKI)',
    'Bác sĩ Chuyên khoa II (BS.CKII)',
    'Thạc sĩ Bác sĩ (ThS.BS)',
    'Tiến sĩ Bác sĩ (TS.BS)',
    'Bác sĩ Đa khoa (BS)'
];

// Xử lý khi Submit Form
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = trim($_POST['fullname'] ?? '');
    $degree = $_POST['degree'] ?? '';
    $specialty = $_POST['specialty'] ?? '';
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Kiểm tra dữ liệu bắt buộc
    if (empty($fullname) || empty($specialty) || empty($phone) || empty($password)) {
        $error_msg = "Vui lòng điền đầy đủ các thông tin bắt buộc (*).";
    } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
        $error_msg = "Số điện thoại không hợp lệ (phải đủ 10 chữ số).";
    } else {
        // TODO: Thực hiện lưu thông tin bác sĩ vào Database ở đây

        $success_msg = "Thêm bác sĩ thành công! Tài khoản bác sĩ đã sẵn sàng hoạt động.";
    }
}
?>

<div class="container py-4">
    <!-- Nút Quay lại & Tiêu đề -->
    <div class="row justify-content-center mb-4">
        <div class="col-12 col-lg-9">
            <a href="index.php?page=quanly"
                class="text-decoration-none text-secondary small d-inline-flex align-items-center mb-2">
                <i class="bi bi-arrow-left me-1"></i> Quay lại Trang Quản Lý
            </a>
            <h2 class="fw-bold text-primary mb-1">Thêm Bác Sĩ Mới</h2>
            <p class="text-muted small">Tạo hồ sơ và cấp tài khoản làm việc cho bác sĩ trong hệ thống CTUMedic.</p>
        </div>
    </div>

    <!-- Form Thêm Bác Sĩ -->
    <div class="row justify-content-center">
        <div class="col-12 col-lg-9">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4 p-sm-5">

                    <?php if (!empty($success_msg)): ?>
                        <!-- Thông báo thành công -->
                        <div class="alert alert-success border-0 rounded-3 text-center p-4 shadow-sm" role="alert">
                            <div class="fs-1 text-success mb-2">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <h4 class="alert-heading fw-bold mb-2">Thêm Bác Sĩ Thành Công!</h4>
                            <p class="text-secondary mb-4"><?php echo $success_msg; ?></p>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="index.php?page=quanly" class="btn btn-primary rounded-3 px-4 fw-semibold">
                                    Về Trang Quản Lý
                                </a>
                                <a href="index.php?page=them-bacsi" class="btn btn-outline-secondary rounded-3 px-3">
                                    + Thêm Bác Sĩ Khác
                                </a>
                            </div>
                        </div>
                    <?php else: ?>

                        <?php if (!empty($error_msg)): ?>
                            <div class="alert alert-danger alert-dismissible fade show rounded-3 small mb-4" role="alert">
                                <?php echo $error_msg; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <form action="" method="POST">
                            <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">1. Thông tin cá nhân & Chuyên môn</h6>

                            <div class="row g-3 mb-3">
                                <!-- Họ và tên -->
                                <div class="col-md-7">
                                    <div class="form-floating">
                                        <input type="text" class="form-control rounded-3" id="fullname" name="fullname"
                                            placeholder="Nguyễn Văn A"
                                            value="<?php echo htmlspecialchars($_POST['fullname'] ?? ''); ?>" required>
                                        <label for="fullname">Họ và tên bác sĩ <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <!-- Học vị / Chức danh -->
                                <div class="col-md-5">
                                    <div class="form-floating">
                                        <select class="form-select rounded-3" id="degree" name="degree">
                                            <option value="" selected>-- Chọn học vị --</option>
                                            <?php foreach ($degrees as $deg): ?>
                                                <option value="<?php echo $deg; ?>"><?php echo $deg; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="degree">Học vị / Chức danh</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <!-- Chuyên khoa -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select rounded-3" id="specialty" name="specialty" required>
                                            <option value="" selected disabled>-- Chọn chuyên khoa --</option>
                                            <?php foreach ($specialties as $spec): ?>
                                                <option value="<?php echo $spec; ?>"><?php echo $spec; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="specialty">Chuyên khoa phụ trách <span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <!-- Số điện thoại -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="tel" class="form-control rounded-3" id="phone" name="phone"
                                            placeholder="0912345678" pattern="[0-9]{10}"
                                            value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>" required>
                                        <label for="phone">Số điện thoại liên hệ <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>

                            <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">2. Tài khoản đăng nhập hệ thống</h6>

                            <div class="row g-3 mb-4">
                                <!-- Email -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control rounded-3" id="email" name="email"
                                            placeholder="bacsi@ctumedic.edu.vn"
                                            value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                                        <label for="email">Địa chỉ Email</label>
                                    </div>
                                </div>

                                <!-- Mật khẩu ban đầu -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control rounded-3" id="password" name="password"
                                            placeholder="Mật khẩu" required>
                                        <label for="password">Mật khẩu khởi tạo <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>

                            <!-- Nhóm Nút bấm -->
                            <div class="d-flex justify-content-end gap-2 pt-2">
                                <a href="index.php?page=quanly" class="btn btn-outline-secondary rounded-3 px-4">
                                    Hủy bỏ
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg rounded-3 fw-semibold px-4">
                                    Lưu thông tin bác sĩ
                                </button>
                            </div>
                        </form>

                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>