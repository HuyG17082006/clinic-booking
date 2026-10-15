<?php
$userID = '001';
$userName = 'Test User';
$userPhone = '0979125356';

// Dữ liệu mẫu danh sách lịch khám (Sau này bạn sẽ truy vấn dữ liệu từ Database)
$appointments = [
    [
        'id' => 'LK001',
        'doctor' => 'BS. Nguyễn Văn A',
        'specialty' => 'Khoa Nội tổng hợp',
        'date' => '2026-10-20',
        'time' => '08:30',
        'status' => 'Đã xác nhận', // Trạng thái: Chờ xác nhận, Đã xác nhận, Hoàn thành, Đã hủy
        'note' => 'Khám sức khỏe định kỳ'
    ],
    [
        'id' => 'LK002',
        'doctor' => 'BS. Trần Thị B',
        'specialty' => 'Khoa Mắt',
        'date' => '2026-10-25',
        'time' => '14:00',
        'status' => 'Chờ xác nhận',
        'note' => 'Đau mắt đỏ'
    ],
    [
        'id' => 'LK003',
        'doctor' => 'BS. Lê Văn C',
        'specialty' => 'Khoa Răng Hàm Mặt',
        'date' => '2026-09-15',
        'time' => '09:00',
        'status' => 'Hoàn thành',
        'note' => 'Tấy vôi răng'
    ]
];
?>

<div class="container py-4">
    <!-- Tiêu đề chính -->
    <div class="row justify-content-center text-center mb-4">
        <div class="col-lg-8 col-12">
            <h2 class="fw-bold text-primary mb-2">
                Chào <?php echo htmlspecialchars($userName); ?>,
            </h2>
            <p class="lead text-muted">
                Hôm nay của bạn thế nào? Dưới đây là danh sách lịch khám bệnh của bạn tại CTUMedic.
            </p>
        </div>
    </div>

    <!-- Thanh công cụ & Nút Đặt lịch khám mới -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h4 class="fw-bold text-dark m-0">
            <i class="bi bi-calendar-event text-primary me-2"></i>Lịch khám của tôi
        </h4>
        <a href="?page=datlich" class="btn btn-primary rounded-3 px-3 py-2 fw-semibold shadow-sm">
            + Đặt lịch khám mới
        </a>
    </div>

    <!-- Danh sách Bảng Lịch khám -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
        <div class="card-body p-0">
            <?php if (empty($appointments)): ?>
                <!-- Trường hợp chưa có lịch khám -->
                <div class="text-center py-5">
                    <p class="text-muted mb-3">Bạn chưa có lịch hẹn khám nào.</p>
                    <a href="?page=datlich" class="btn btn-outline-primary rounded-3">Đặt lịch ngay</a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light border-bottom">
                            <tr>
                                <th class="ps-4 py-3 text-secondary small text-uppercase fw-bold">Mã LK</th>
                                <th class="py-3 text-secondary small text-uppercase fw-bold">Bác sĩ / Chuyên khoa</th>
                                <th class="py-3 text-secondary small text-uppercase fw-bold">Ngày & Giờ</th>
                                <th class="py-3 text-secondary small text-uppercase fw-bold">Ghi chú</th>
                                <th class="py-3 text-secondary small text-uppercase fw-bold">Trạng thái</th>
                                <th class="pe-4 py-3 text-end text-secondary small text-uppercase fw-bold">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($appointments as $item): ?>
                                <tr>
                                    <!-- Mã lịch khám -->
                                    <td class="ps-4 fw-bold text-primary">
                                        #<?php echo $item['id']; ?>
                                    </td>

                                    <!-- Bác sĩ & Chuyên khoa -->
                                    <td>
                                        <div class="fw-bold text-dark"><?php echo $item['doctor']; ?></div>
                                        <div class="text-muted small"><?php echo $item['specialty']; ?></div>
                                    </td>

                                    <!-- Ngày & Giờ khám -->
                                    <td>
                                        <div class="fw-semibold text-dark">
                                            <?php echo date('d/m/Y', strtotime($item['date'])); ?>
                                        </div>
                                        <div class="text-muted small">
                                            <?php echo $item['time']; ?>
                                        </div>
                                    </td>

                                    <!-- Ghi chú -->
                                    <td class="text-secondary small">
                                        <?php echo htmlspecialchars($item['note']); ?>
                                    </td>

                                    <!-- Badge Trạng thái -->
                                    <td>
                                        <?php if ($item['status'] === 'Đã xác nhận'): ?>
                                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-medium">
                                                Đã xác nhận
                                            </span>
                                        <?php elseif ($item['status'] === 'Chờ xác nhận'): ?>
                                            <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill fw-medium">
                                                Chờ xác nhận
                                            </span>
                                        <?php elseif ($item['status'] === 'Hoàn thành'): ?>
                                            <span class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill fw-medium">
                                                Hoàn thành
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill fw-medium">
                                                Đã hủy
                                            </span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- Nút Thao tác -->
                                    <td class="pe-4 text-end">
                                        <?php if ($item['status'] === 'Chờ xác nhận' || $item['status'] === 'Đã xác nhận'): ?>
                                            <button class="btn btn-sm btn-outline-danger rounded-2 me-1" onclick="return confirm('Bạn có chắc muốn hủy lịch này?')">
                                                Hủy
                                            </button>
                                        <?php endif; ?>
                                        <button class="btn btn-sm btn-light border rounded-2">
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