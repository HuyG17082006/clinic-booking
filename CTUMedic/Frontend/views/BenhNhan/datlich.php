<?php
$userID = '001';
$userName = 'Test User';
$userPhone = '0979125356';

$success_msg = "";
$error_msg = "";

// Danh sách chuyên khoa mẫu
$specialties = [
    'Khoa Nội tổng hợp',
    'Khoa Ngoại',
    'Khoa Mắt',
    'Khoa Tai Mũi Họng',
    'Khoa Răng Hàm Mặt',
    'Khoa Da liễu'
];

// Danh sách bác sĩ mẫu
$doctors = [
    ['id' => 'BS01', 'name' => 'BS. Nguyễn Văn A', 'specialty' => 'Khoa Nội tổng hợp'],
    ['id' => 'BS02', 'name' => 'BS. Trần Thị B', 'specialty' => 'Khoa Mắt'],
    ['id' => 'BS03', 'name' => 'BS. Lê Văn C', 'specialty' => 'Khoa Răng Hàm Mặt'],
    ['id' => 'BS04', 'name' => 'BS. Phạm Văn D', 'specialty' => 'Khoa Tai Mũi Họng']
];

// Xử lý gửi Form đăng ký lịch khám
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $specialty = $_POST['specialty'] ?? '';
    $doctor = $_POST['doctor'] ?? '';
    $exam_date = $_POST['exam_date'] ?? '';
    $exam_time = $_POST['exam_time'] ?? '';
    $reason = trim($_POST['reason'] ?? '');

    if (empty($specialty) || empty($exam_date) || empty($exam_time)) {
        $error_msg = "Vui lòng điền đầy đủ các thông tin bắt buộc (*).";
    } else {
        // TODO: Lưu thông tin lịch hẹn vào Database ở đây

        $success_msg = "Đặt lịch khám thành công! Chúng tôi sẽ xác nhận qua số điện thoại " . htmlspecialchars($userPhone) . " sớm nhất.";
    }
}
?>

<div class="container py-4">
    <!-- Nút Quay lại & Tiêu đề -->
    <div class="row justify-content-center mb-4">
        <div class="col-12 col-lg-8">
            <a href="index.php?page=benhnhan" class="text-decoration-none text-secondary small d-inline-flex align-items-center mb-2">
                <i class="bi bi-arrow-left me-1"></i> Quay lại danh sách lịch khám
            </a>
            <h2 class="fw-bold text-primary mb-1">Đặt lịch khám bệnh</h2>
            <p class="text-muted small">Vui lòng chọn thông tin chi tiết bên dưới để hoàn tất đăng ký lịch hẹn.</p>
        </div>
    </div>

    <!-- Khối Form Đặt Lịch -->
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4 p-sm-5">

                    <?php if (!empty($success_msg)): ?>
                        <!-- Thông báo Đặt Lịch Thành Công -->
                        <div class="alert alert-success border-0 rounded-3 text-center p-4 shadow-sm" role="alert">
                            <div class="fs-1 text-success mb-2">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <h4 class="alert-heading fw-bold mb-2">Đặt lịch thành công!</h4>
                            <p class="text-secondary mb-4"><?php echo $success_msg; ?></p>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="index.php?page=benhnhan" class="btn btn-primary rounded-3 px-4 fw-semibold">
                                    Xem danh sách lịch khám
                                </a>
                                <a href="index.php?page=dat-lich" class="btn btn-outline-secondary rounded-3 px-3">
                                    Đặt thêm lịch khác
                                </a>
                            </div>
                        </div>
                    <?php else: ?>

                        <?php if (!empty($error_msg)): ?>
                            <div class="alert alert-danger alert-dismissible fade show rounded-3 small" role="alert">
                                <?php echo $error_msg; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <form action="" method="POST">
                            <!-- Thông tin bệnh nhân (Khóa cố định) -->
                            <div class="bg-light rounded-3 p-3 mb-4">
                                <h6 class="fw-bold text-dark mb-2">Thông tin người khám</h6>
                                <div class="row g-2 text-secondary small">
                                    <div class="col-md-6">
                                        <strong>Họ và tên:</strong> <?php echo htmlspecialchars($userName); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Số điện thoại:</strong> <?php echo htmlspecialchars($userPhone); ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Chọn Chuyên Khoa & Bác Sĩ -->
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select rounded-3" id="specialty" name="specialty" required>
                                            <option value="" selected disabled>-- Chọn chuyên khoa --</option>
                                            <?php foreach ($specialties as $spec): ?>
                                                <option value="<?php echo $spec; ?>"><?php echo $spec; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="specialty">Chuyên khoa <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select rounded-3" id="doctor" name="doctor">
                                            <option value="" selected>-- Chọn bác sĩ (Không bắt buộc) --</option>
                                            <?php foreach ($doctors as $doc): ?>
                                                <option value="<?php echo $doc['name']; ?>">
                                                    <?php echo $doc['name'] . " (" . $doc['specialty'] . ")"; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="doctor">Bác sĩ phụ trách</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Chọn Ngày & Giờ Khám -->
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" 
                                               class="form-control rounded-3" 
                                               id="exam_date" 
                                               name="exam_date" 
                                               min="<?php echo date('Y-m-d'); ?>" 
                                               required>
                                        <label for="exam_date">Ngày khám <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select rounded-3" id="exam_time" name="exam_time" required>
                                            <option value="" selected disabled>-- Chọn ca khám --</option>
                                            <option value="07:30">07:30 - Sáng</option>
                                            <option value="08:30">08:30 - Sáng</option>
                                            <option value="09:30">09:30 - Sáng</option>
                                            <option value="13:30">13:30 - Chiều</option>
                                            <option value="14:30">14:30 - Chiều</option>
                                            <option value="15:30">15:30 - Chiều</option>
                                        </select>
                                        <label for="exam_time">Giờ khám <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>

                            <!-- Lý do khám / Triệu chứng -->
                            <div class="form-floating mb-4">
                                <textarea class="form-control rounded-3" 
                                          id="reason" 
                                          name="reason" 
                                          placeholder="Mô tả triệu chứng hoặc lý do khám..." 
                                          style="height: 110px;"></textarea>
                                <label for="reason">Triệu chứng hoặc Lý do khám</label>
                            </div>

                            <!-- Nút Xác nhận -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg rounded-3 fw-semibold">
                                    Xác nhận đặt lịch
                                </button>
                                <a href="index.php?page=benhnhan" class="btn btn-outline-secondary rounded-3">
                                    Hủy bỏ
                                </a>
                            </div>
                        </form>

                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>