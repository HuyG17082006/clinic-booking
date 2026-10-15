#id là dữ liệu thuộc uuid và phải có độ dài 36 kí tự

create database datLich;

create table taiKhoan (
    id char(36) primary key,
    username varchar(100) unique not null,
    passwordHash varchar(255) NOT null,
    role enum("user", "doctor", "admin") NOT NULL DEFAULT 'user',
);

create table benhNhan (
    id char(36) primary key,
    taiKhoanId char(36) NOT NULL,
    hoTen varchar(100) NOT NULL,
    sdt varchar(15) NOT NULL,
    ngaySinh DATE NOT NULL,
    foreign key (taiKhoanId) references taiKhoan(id) on delete cascade 
);

create table bacSi (
    id char(36) primary key,
    taiKhoanId char(36) NOT NULL unique,
    hoTen varchar(255) NOT NULL,
    chuyenKhoa varchar(255) NOT NULL,

    foreign key (taiKhoanId) references taiKhoan(id) on delete cascade 
);

create table lichKham (
    id char(36) primary key,
    benhNhanId char(36) NOT NULL,
    bacSiId char(36) NOT NULL,

    thoiGianKham DATETIME NOT NULL,
    trangThai ENUM(
        'cancelled',
        'confirmed',
        'pending',
        'cancel_pending',
        'completed'
    ) NOT NULL DEFAULT 'pending',

    foreign key (benhNhanId) references benhNhan(id),
    foreign key (bacSiId) references bacSi(id) 
);


USE datLich;

-- =========================================
-- 1. BANG TAIKHOAN
-- 8 tai khoan: 4 user, 3 doctor, 1 admin
-- =========================================

INSERT INTO taiKhoan (id, username, passwordHash, role) VALUES
('10000000-0000-4000-8000-000000000001', 'user01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
('10000000-0000-4000-8000-000000000002', 'user02', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
('10000000-0000-4000-8000-000000000003', 'user03', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
('10000000-0000-4000-8000-000000000004', 'user04', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),

('20000000-0000-4000-8000-000000000001', 'doctor01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'doctor'),
('20000000-0000-4000-8000-000000000002', 'doctor02', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'doctor'),
('20000000-0000-4000-8000-000000000003', 'doctor03', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'doctor'),

('30000000-0000-4000-8000-000000000001', 'admin01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');


-- =========================================
-- 2. BANG BENHNHAN
-- 6 ho so benh nhan
-- Tai khoan user01 va user04 quan ly nhieu ho so
-- =========================================

INSERT INTO benhNhan (id, taiKhoanId, hoTen, sdt, ngaySinh) VALUES
('40000000-0000-4000-8000-000000000001',
 '10000000-0000-4000-8000-000000000001',
 'Nguyen Van An', '0901234567', '1995-05-12'),

('40000000-0000-4000-8000-000000000002',
 '10000000-0000-4000-8000-000000000001',
 'Nguyen Thi Hoa', '0901234567', '1998-09-20'),

('40000000-0000-4000-8000-000000000003',
 '10000000-0000-4000-8000-000000000002',
 'Tran Van Binh', '0912345678', '1988-03-15'),

('40000000-0000-4000-8000-000000000004',
 '10000000-0000-4000-8000-000000000003',
 'Le Thi Mai', '0923456789', '2000-11-08'),

('40000000-0000-4000-8000-000000000005',
 '10000000-0000-4000-8000-000000000004',
 'Pham Minh Duc', '0934567890', '1979-07-22'),

('40000000-0000-4000-8000-000000000006',
 '10000000-0000-4000-8000-000000000004',
 'Pham Thu Trang', '0934567890', '2003-01-17');


-- =========================================
-- 3. BANG BACSI
-- 3 bac si, moi bac si lien ket 1 tai khoan
-- =========================================

INSERT INTO bacSi (id, taiKhoanId, hoTen, chuyenKhoa) VALUES
('50000000-0000-4000-8000-000000000001',
 '20000000-0000-4000-8000-000000000001',
 'Tran Van Minh', 'Tim mach'),

('50000000-0000-4000-8000-000000000002',
 '20000000-0000-4000-8000-000000000002',
 'Le Thi Mai', 'Da lieu'),

('50000000-0000-4000-8000-000000000003',
 '20000000-0000-4000-8000-000000000003',
 'Pham Van Hung', 'Nhi khoa');


-- =========================================
-- 4. BANG LICHKHAM
-- 10 lich kham, bao gom ca 5 trang thai
-- completed: lich trong qua khu
-- cac lich con lai: lich mau trong tuong lai
-- =========================================

INSERT INTO lichKham
    (id, benhNhanId, bacSiId, thoiGianKham, trangThai)
VALUES

-- Dang cho xac nhan
('60000000-0000-4000-8000-000000000001',
 '40000000-0000-4000-8000-000000000001',
 '50000000-0000-4000-8000-000000000001',
 '2026-10-20 08:00:00', 'pending'),

('60000000-0000-4000-8000-000000000002',
 '40000000-0000-4000-8000-000000000003',
 '50000000-0000-4000-8000-000000000002',
 '2026-10-20 09:00:00', 'pending'),

-- Da xac nhan
('60000000-0000-4000-8000-000000000003',
 '40000000-0000-4000-8000-000000000002',
 '50000000-0000-4000-8000-000000000001',
 '2026-10-21 08:00:00', 'confirmed'),

('60000000-0000-4000-8000-000000000004',
 '40000000-0000-4000-8000-000000000004',
 '50000000-0000-4000-8000-000000000003',
 '2026-10-21 09:00:00', 'confirmed'),

-- Dang cho xac nhan huy
('60000000-0000-4000-8000-000000000005',
 '40000000-0000-4000-8000-000000000005',
 '50000000-0000-4000-8000-000000000002',
 '2026-10-22 10:00:00', 'cancel_pending'),

('60000000-0000-4000-8000-000000000006',
 '40000000-0000-4000-8000-000000000006',
 '50000000-0000-4000-8000-000000000003',
 '2026-10-23 14:00:00', 'cancel_pending'),

-- Da huy
('60000000-0000-4000-8000-000000000007',
 '40000000-0000-4000-8000-000000000001',
 '50000000-0000-4000-8000-000000000002',
 '2026-10-24 08:00:00', 'cancelled'),

-- Da hoan thanh
('60000000-0000-4000-8000-000000000008',
 '40000000-0000-4000-8000-000000000003',
 '50000000-0000-4000-8000-000000000001',
 '2026-09-20 08:00:00', 'completed'),

('60000000-0000-4000-8000-000000000009',
 '40000000-0000-4000-8000-000000000004',
 '50000000-0000-4000-8000-000000000003',
 '2026-09-22 09:00:00', 'completed'),

('60000000-0000-4000-8000-000000000010',
 '40000000-0000-4000-8000-000000000005',
 '50000000-0000-4000-8000-000000000002',
 '2026-09-25 10:00:00', 'completed');
