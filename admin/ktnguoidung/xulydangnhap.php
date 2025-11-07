<?php
// Xử lý đăng nhập (xulydangnhap.php)
// file này được include từ index.php với session đã được start
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../model/database.php';
require_once __DIR__ . '/../../model/nguoidung.php';

// Lấy dữ liệu từ form
$email = isset($_POST['txtemail']) ? trim($_POST['txtemail']) : '';
$matkhau = isset($_POST['txtmatkhau']) ? $_POST['txtmatkhau'] : '';

$nd = new NGUOIDUNG();

// Kiểm tra các trường bắt buộc
if (empty($email) || empty($matkhau)) {
    // Chuyển về trang đăng nhập với thông báo lỗi
    header('Location: index.php?action=dangnhap&error=missing');
    exit();
}

try {
    if ($nd->kiemtranguoidunghople($email, $matkhau) === TRUE) {
        // Lưu thông tin người dùng vào session
        $_SESSION['nguoidung'] = $nd->laythongtinnguoidung($email);
        // Chuyển tới trang chính quản trị
        header('Location: index.php?action=macdinh');
        exit();
    } else {
        // Đăng nhập thất bại
        header('Location: index.php?action=dangnhap&error=invalid');
        exit();
    }
} catch (Exception $e) {
    // Trong môi trường dev có thể log lỗi hoặc hiển thị
    error_log('Login error: ' . $e->getMessage());
    header('Location: index.php?action=dangnhap&error=server');
    exit();
}
