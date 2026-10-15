<?php
// Thông tin Bác sĩ đang đăng nhập (Sau này lấy từ Session/Database)
$doctorID = 'BS01';
$doctorName = 'BS. Nguyễn Văn A';
$specialty = 'Khoa Nội tổng hợp';

// Dữ liệu mẫu danh sách bệnh nhân đăng ký khám với bác sĩ này
$appointments = [
    [
        'id' => 'LK001',
        'patient_name' => 'Nguyễn Văn Bệnh',
        'phone' => '0987654321',
        'gender' => 'Nam',
        'age' => 22,
        'date' => date('Y-m-d'), // Hôm nay
        'time' => '08:30',
        'reason' => 'Sốt cao, đau đầu kéo dài 2 ngày',
        'status' => 'Đã xác nhận' // Các trạng thái: Chờ xác nhận, Đã xác nhận, Hoàn thành, Đã hủy
    ],
    [
        'id' => 'LK002',
        'patient_name' => 'Trần Thị Mai',
        'phone' => '0912345678',
        'gender' => 'Nữ',
        'age' => 19,
        'date' => date('Y-m-d'), // Hôm nay
        'time' => '09:30',
        'reason' => 'Đau dạ dày sau khi ăn',
        'status' => 'Chờ xác nhận'
    ],
    [
        'id' => 'LK003',
        'patient_name' => 'Lê Hoàng Nam',
        'phone' => '0903112233',
        'gender' => 'Nam',
        'age' => 21,
        'date' => date('Y-m-d', strtotime('-1 day')), // Hôm qua
        'time' => '14:00',
        'reason' => 'Khám sức khỏe định kỳ',
        'status' => 'Hoàn thành'
    ]
];
?>

<div class="container py-4">
    <!-- Tiêu đề & Thông tin Bác sĩ -->
    <div class="row align-items-center mb-4">
        <div class="col-md-8">
            <h2 class="fw-bold text-primary mb-1">
                Lịch khám bệnh - <?php echo htmlspecialchars($doctorName); ?>
            </h2>
            <p class="text-muted mb-0">
                Chuyên khoa: <span class="badge bg-primary-subtle text-primary fw-semibold"><?php echo htmlspecialchars($specialty); ?></span>
            </p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <span class="bg-light border px-3 py-2 rounded-3 text-dark fw-semibold small d-inline-flex align-items-center">
                <i class="bi bi-calendar3 me-2 text-primary"></i> Hôm nay: <?php echo date('d/m/Y'); ?>
            </span>
        </div>
    </div>

    <!-- Thanh Lọc / Tìm kiếm -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-3">
            <form action="" method="GET" class="row g-2 align-items-center">
                <input type="hidden" name="page" value="bacsi">
                
                <div class="col-12 col-sm-4 col-md-3">
                    <label class="form-label small text-muted mb-1">Lọc theo ngày</label>
                    <input type="date" name="filter_date" class="form-control form-control-sm rounded-3" value="<?php echo date('Y-m-d'); ?>">
                </div>

                <div class="col-12 col-sm-4 col-md-3">
                    <label class="form-label small text-muted mb-1">Trạng thái</label>
                    <select name="filter_status" class="form-select form-select-sm rounded-3">
                        <option value="">-- Tất cả trạng thái --</option>
                        <option value="Chờ xác nhận">Chờ xác nhận</option>
                        <option value="Đã xác nhận">Đã xác nhận</option>
                        <option value="Hoàn thành">Hoàn thành</option>
                        <option value="Đã hủy">Đã hủy</option>
                    </select>
                </div>

                <div class="col-12 col-sm-4 col-md-2 mt-auto">
                    <button type="submit" class="btn btn-sm btn-primary rounded-3 w-100 fw-semibold">
                        Lọc danh sách
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bảng Danh Sách Bệnh Nhân -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white py-3 border-bottom">
            <h5 class="fw-bold text-dark m-0">
                <i class="bi bi-person-lines-fill text-primary me-2"></i>Danh sách bệnh nhân đặt lịch
            </h5>
        </div>
        <div class="card-body p-0">
            <?php if (empty($appointments)): ?>
                <div class="text-center py-5">
                    <p class="text-muted m-0">Chưa có lịch khám nào cho ngày được chọn.</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light border-bottom">
                            <tr>
                                <th class="ps-4 py-3 text-secondary small text-uppercase fw-bold">Giờ khám</th>
                                <th class="py-3 text-secondary small text-uppercase fw-bold">Bệnh nhân</th>
                                <th class="py-3 text-secondary small text-uppercase fw-bold">Số điện thoại</th>
                                <th class="py-3 text-secondary small text-uppercase fw-bold">Triệu chứng / Lý do</th>
                                <th class="py-3 text-secondary small text-uppercase fw-bold">Trạng thái</th>
                                <th class="pe-4 py-3 text-end text-secondary small text-uppercase fw-bold">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($appointments as $item): ?>
                                <tr>
                                    <!-- Giờ khám -->
                                    <td class="ps-4">
                                        <span class="fw-bold text-primary fs-6"><?php echo $item['time']; ?></span>
                                        <div class="text-muted small"><?php echo date('d/m/Y', strtotime($item['date'])); ?></div>
                                    </td>

                                    <!-- Thông tin Bệnh nhân -->
                                    <td>
                                        <div class="fw-bold text-dark"><?php echo htmlspecialchars($item['patient_name']); ?></div>
                                        <div class="text-muted small">
                                            <?php echo $item['gender']; ?> • <?php echo $item['age']; ?> tuổi
                                        </div>
                                    </td>

                                    <!-- Số điện thoại -->
                                    <td class="fw-medium text-dark">
                                        <?php echo htmlspecialchars($item['phone']); ?>
                                    </td>

                                    <!-- Lý do khám -->
                                    <td class="text-secondary small" style="max-width: 250px;">
                                        <?php echo htmlspecialchars($item['reason']); ?>
                                    </td>

                                    <!-- Trạng thái -->
                                    <td>
                                        <?php if ($item['status'] === 'Đã xác nhận'): ?>
                                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-medium">
                                                Đã xác nhận
                                            </span>
                                        <?php elseif ($item['status'] === 'Chờ xác nhận'): ?>
                                            <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill fw-medium">
                                                Chờ duyệt
                                            </span>
                                        <?php elseif ($item['status'] === 'Hoàn thành'): ?>
                                            <span class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill fw-medium">
                                                Đã khám
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill fw-medium">
                                                Đã hủy
                                            </span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- Các nút thao tác -->
                                    <td class="pe-4 text-end">
                                        <?php if ($item['status'] === 'Chờ xác nhận'): ?>
                                            <button class="btn btn-sm btn-success rounded-2 me-1">
                                                Xác nhận
                                            </button>
                                        <?php endif; ?>

                                        <?php if ($item['status'] === 'Đã xác nhận'): ?>
                                            <button class="btn btn-sm btn-primary rounded-2 me-1">
                                                Hoàn thành
                                            </button>
                                        <?php endif; ?>

                                        <button class="btn btn-sm btn-light border rounded-2" title="Xem chi tiết">
                                            Chi tiết
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>