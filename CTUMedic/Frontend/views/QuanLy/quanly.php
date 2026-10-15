<?php
// Thông tin Quản lý
$adminName = 'Admin - Quản lý CTUMedic';

// Dữ liệu mẫu thống kê
$totalPatients = 1240;
$totalDoctors = 18;
$todayAppointments = 32;
$pendingAppointments = 5;

// Dữ liệu mẫu danh sách bác sĩ
$doctorsList = [
    ['id' => 'BS01', 'name' => 'BS. Nguyễn Văn A', 'specialty' => 'Khoa Nội tổng hợp', 'phone' => '0912345678', 'status' => 'Đang làm việc'],
    ['id' => 'BS02', 'name' => 'BS. Trần Thị B', 'specialty' => 'Khoa Mắt', 'phone' => '0987654321', 'status' => 'Đang làm việc'],
    ['id' => 'BS03', 'name' => 'BS. Lê Văn C', 'specialty' => 'Khoa Răng Hàm Mặt', 'phone' => '0903112233', 'status' => 'Tạm nghỉ']
];

// Dữ liệu mẫu lịch khám toàn hệ thống
$allAppointments = [
    [
        'id' => 'LK001',
        'patient' => 'Nguyễn Văn Bệnh',
        'doctor' => 'BS. Nguyễn Văn A',
        'specialty' => 'Khoa Nội tổng hợp',
        'date' => date('Y-m-d'),
        'time' => '08:30',
        'status' => 'Chờ xác nhận'
    ],
    [
        'id' => 'LK002',
        'patient' => 'Trần Thị Mai',
        'doctor' => 'BS. Trần Thị B',
        'specialty' => 'Khoa Mắt',
        'date' => date('Y-m-d'),
        'time' => '09:30',
        'status' => 'Đã xác nhận'
    ]
];
?>

<div class="container py-4">
    <!-- Header Chào mừng -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h2 class="fw-bold text-primary mb-1">Trang Quản Lý Hệ Thống</h2>
            <p class="text-muted small mb-0">Xin chào, <strong><?php echo $adminName; ?></strong> • Tổng quan hoạt động phòng khám CTUMedic</p>
        </div>
        <a href="?page=thembacsi" class="btn btn-primary rounded-3 px-3 py-2 fw-semibold shadow-sm" data-bs-toggle="modal" data-bs-target="#addDoctorModal">
            + Thêm bác sĩ mới
        </a>
    </div>

    <!-- Thẻ Thống Kê Nhanh (Dashboard Metrics) -->
    <div class="row g-3 mb-4">
        <!-- Tổng bệnh nhân -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold">Tổng Bệnh Nhân</span>
                        <h3 class="fw-bold text-dark mt-1 mb-0"><?php echo number_format($totalPatients); ?></h3>
                    </div>
                    <div class="bg-primary-subtle text-primary rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="bi bi-people-fill fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bác sĩ -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold">Đội Ngũ Bác Sĩ</span>
                        <h3 class="fw-bold text-dark mt-1 mb-0"><?php echo $totalDoctors; ?></h3>
                    </div>
                    <div class="bg-success-subtle text-success rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="bi bi-person-badge-fill fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lịch khám hôm nay -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold">Lịch Khám Hôm Nay</span>
                        <h3 class="fw-bold text-dark mt-1 mb-0"><?php echo $todayAppointments; ?></h3>
                    </div>
                    <div class="bg-info-subtle text-info rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="bi bi-calendar-check-fill fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lịch chờ duyệt -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold">Lịch Hẹn Chờ Duyệt</span>
                        <h3 class="fw-bold text-warning mt-1 mb-0"><?php echo $pendingAppointments; ?></h3>
                    </div>
                    <div class="bg-warning-subtle text-warning rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="bi bi-hourglass-split fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bảng Duyệt Lịch Khám Toàn Hệ Thống -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h5 class="fw-bold text-dark m-0">
                <i class="bi bi-calendar-range text-primary me-2"></i>Duyệt Lịch Khám Hệ Thống
            </h5>
            <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill fw-medium">
                Cần xử lý: <?php echo $pendingAppointments; ?>
            </span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light border-bottom">
                        <tr>
                            <th class="ps-4 py-3 text-secondary small text-uppercase fw-bold">Mã LK</th>
                            <th class="py-3 text-secondary small text-uppercase fw-bold">Bệnh nhân</th>
                            <th class="py-3 text-secondary small text-uppercase fw-bold">Bác sĩ / Khoa</th>
                            <th class="py-3 text-secondary small text-uppercase fw-bold">Ngày & Giờ</th>
                            <th class="py-3 text-secondary small text-uppercase fw-bold">Trạng thái</th>
                            <th class="pe-4 py-3 text-end text-secondary small text-uppercase fw-bold">Thao tác duyệt</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allAppointments as $item): ?>
                            <tr>
                                <td class="ps-4 fw-bold text-primary">#<?php echo $item['id']; ?></td>
                                <td class="fw-semibold text-dark"><?php echo htmlspecialchars($item['patient']); ?></td>
                                <td>
                                    <div class="fw-bold text-dark"><?php echo htmlspecialchars($item['doctor']); ?></div>
                                    <div class="text-muted small"><?php echo htmlspecialchars($item['specialty']); ?></div>
                                </td>
                                <td>
                                    <div class="fw-medium"><?php echo date('d/m/Y', strtotime($item['date'])); ?></div>
                                    <div class="text-muted small"><?php echo $item['time']; ?></div>
                                </td>
                                <td>
                                    <?php if ($item['status'] === 'Chờ xác nhận'): ?>
                                        <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill fw-medium">Chờ xác nhận</span>
                                    <?php else: ?>
                                        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-medium">Đã xác nhận</span>
                                    <?php endif; ?>
                                </td>
                                <td class="pe-4 text-end">
                                    <?php if ($item['status'] === 'Chờ xác nhận'): ?>
                                        <button class="btn btn-sm btn-success rounded-2 me-1">Duyệt</button>
                                        <button class="btn btn-sm btn-outline-danger rounded-2 me-1">Hủy</button>
                                    <?php endif; ?>
                                    <button class="btn btn-sm btn-light border rounded-2">Sửa</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bảng Quản Lý Danh Sách Bác Sĩ -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white py-3 border-bottom">
            <h5 class="fw-bold text-dark m-0">
                <i class="bi bi-person-badge text-primary me-2"></i>Danh Sách Bác Sĩ
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light border-bottom">
                        <tr>
                            <th class="ps-4 py-3 text-secondary small text-uppercase fw-bold">Mã BS</th>
                            <th class="py-3 text-secondary small text-uppercase fw-bold">Họ và Tên</th>
                            <th class="py-3 text-secondary small text-uppercase fw-bold">Chuyên Khoa</th>
                            <th class="py-3 text-secondary small text-uppercase fw-bold">Số điện thoại</th>
                            <th class="py-3 text-secondary small text-uppercase fw-bold">Trạng thái</th>
                            <th class="pe-4 py-3 text-end text-secondary small text-uppercase fw-bold">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($doctorsList as $doc): ?>
                            <tr>
                                <td class="ps-4 fw-bold text-secondary"><?php echo $doc['id']; ?></td>
                                <td class="fw-bold text-dark"><?php echo htmlspecialchars($doc['name']); ?></td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary rounded-2 px-2 py-1"><?php echo htmlspecialchars($doc['specialty']); ?></span>
                                </td>
                                <td><?php echo htmlspecialchars($doc['phone']); ?></td>
                                <td>
                                    <?php if ($doc['status'] === 'Đang làm việc'): ?>
                                        <span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill">Đang làm việc</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary-subtle text-secondary px-3 py-1 rounded-pill">Tạm nghỉ</span>
                                    <?php endif; ?>
                                </td>
                                <td class="pe-4 text-end">
                                    <button class="btn btn-sm btn-light border rounded-2 me-1">Sửa</button>
                                    <button class="btn btn-sm btn-outline-danger rounded-2">Xóa</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>