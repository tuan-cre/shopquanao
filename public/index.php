<?php
session_start();

// Khởi tạo giỏ hàng nếu chưa có
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

require("../model/database.php");
require("../model/danhmuc.php");
require("../model/mathang.php");
require("../model/taikhoan.php");
require("../model/khachhang.php");
require("../model/hinhanhsanpham.php");

require("../model/sukien.php"); // Thêm model sự kiện

$dm = new DANHMUC();
$danhmuc = $dm->laydanhmuc();
$mh = new MATHANG();
$taikhoan = new TAIKHOAN();
$ha = new HINHANHSANPHAM();
$kh = new KHACHHANG();
$sk = new SUKIEN(); // Tạo đối tượng sự kiện

// Hàm đếm hàng trong giỏ
function demhangtronggio()
{
    return count($_SESSION['cart']);
}

// Hàm tính tiền giỏ hàng
function tinhtiengiohang()
{
    global $mh;
    $total = 0;
    foreach ($_SESSION['cart'] as $masp => $soluong) {
        $sp = $mh->laymathangtheoid($masp);
        if ($sp) {
            $total += $sp['GiaBan'] * $soluong;
        }
    }
    return $total;
}

// Xử lý action
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} else {
    $action = "trangchu";
}

switch ($action) {
    case "dangnhap":
        include("login.php");
        break;
    case "dangky":
        include("register.php");
        break;
    case "dangxuat":
        // Đăng xuất
        session_unset();
        session_destroy();
        echo '<script>alert("Đăng xuất thành công!"); window.location="index.php";</script>';
        break;
    case "dangky_process":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (
                !isset($_POST['username'], $_POST['password'], $_POST['hoten'], $_POST['email']) ||
                empty(trim($_POST['username'])) || empty(trim($_POST['password'])) || empty(trim($_POST['hoten'])) || empty(trim($_POST['email']))
            ) {
                echo '<script>alert("Vui lòng điền đầy đủ thông tin đăng ký."); window.location="index.php?action=dangky";</script>';
                exit();
            } else if ($_POST['password'] !== $_POST['confirmPassword']) {
                echo '<script>alert("Mật khẩu xác nhận không khớp."); window.location="index.php?action=dangky";</script>';
                exit();
            } else {
                $username = trim($_POST['username']);
                $password = trim($_POST['password']);
                $hoten = trim($_POST['hoten']);
                $email = trim($_POST['email']);

                // Kiểm tra xem tài khoản đã tồn tại chưa
                $existingUser = $taikhoan->kiemtrataikhoandatontai($username);
                if ($existingUser) {
                    echo '<script>alert("Tài khoản đã tồn tại! Vui lòng chọn tên khác."); window.location="index.php?action=dangky";</script>';
                    exit();
                }

                // Thêm tài khoản mới
                $resultTK = $taikhoan->dangkytaikhoanKH($username, md5($password));
                
                if ($resultTK) {
                    // Thêm khách hàng vào cơ sở dữ liệu
                    $khachhangmoi = new KHACHHANG();
                    $khachhangmoi->setUsername($username);
                    $khachhangmoi->setHoTen($hoten);
                    $khachhangmoi->setEmail($email);
                    $khachhangmoi->setDiaChi('');
                    $khachhangmoi->setSoDienThoai('');
                    $khachhangmoi->setGioiTinh('Nam');
                    $khachhangmoi->setNamSinh(null);
                    $khachhangmoi->setDiemThuong(0);
                    
                    $resultKH = KHACHHANG::themKhachHang($khachhangmoi);
                    
                    if ($resultKH) {
                        echo '<script>alert("Đăng ký thành công! Vui lòng đăng nhập."); window.location="index.php?action=dangnhap";</script>';
                    } else {
                        echo '<script>alert("Có lỗi khi tạo thông tin khách hàng!"); window.location="index.php?action=dangky";</script>';
                    }
                } else {
                    echo '<script>alert("Có lỗi khi tạo tài khoản!"); window.location="index.php?action=dangky";</script>';
                }
            }
        }
        break;
    case "dangnhap_process":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (
                !isset($_POST['username'], $_POST['password']) ||
                empty(trim($_POST['username'])) || empty(trim($_POST['password']))
            ) {
                echo '<script>alert("Vui lòng điền đầy đủ thông tin đăng nhập."); window.location="index.php?action=dangnhap";</script>';
                exit();
            } else {
                $username = trim($_POST['username']);
                $password = trim($_POST['password']);

                $islogin = $taikhoan->kiemtrataikhoanhople($username, md5($password));
                if ($islogin) {
                    // Lấy thông tin tài khoản
                    $userInfo = $taikhoan->laythongtin($username);
                    
                    // Lấy thông tin khách hàng (nếu có)
                    $khachHang = KHACHHANG::layKhachHangTheoUsername($username);
                    
                    // Lưu thông tin người dùng vào session
                    $_SESSION['user'] = [
                        'Username' => $username,
                        'HoTen' => $khachHang ? $khachHang['HoTen'] : $username,
                        'Email' => $khachHang ? $khachHang['Email'] : '',
                        'MaKhachHang' => $khachHang ? $khachHang['MaKhachHang'] : null,
                        'Quyen' => $userInfo['Quyen'],
                        'TinhTrang' => $userInfo['TinhTrang']
                    ];
                    
                    echo '<script>alert("Đăng nhập thành công!"); window.location="index.php";</script>';
                } else {
                    echo '<script>alert("Tên đăng nhập hoặc mật khẩu không đúng."); window.location="index.php?action=dangnhap";</script>';
                    exit();
                }
            }
        }
        break;
    case "trangchu":
    case "null":
        // Trang chủ - hiển thị sản phẩm
        $mathang = $mh->laymathang();
        $sukien_hientai = $sk->laysukiendangdienra();

        if ($sukien_hientai) {
            $giamgia = $sukien_hientai['GiamGia'];
            foreach ($mathang as &$sp) {
                $sp['GiaGoc'] = $sp['GiaBan'];
                $sp['GiaBan'] = $sp['GiaGoc'] * (1 - $giamgia / 100);
            }
            unset($sp);
        }
        include("main.php");
        break;

    case "group":
        // Xem sản phẩm theo danh mục
        if (isset($_REQUEST["id"])) {
            $id = $_REQUEST["id"];
            $danhmuctheoID = $dm->laydanhmuctheoid($id);
            $tendanhmuc = $danhmuctheoID['TenDanhMuc'];
            $mathang = $mh->laymathangtheodanhmuc($id);
            include("group.php");
        } else {
            include("main.php");
        }
        break;

    case "detail":
    case "chitiet":
        // Chi tiết sản phẩm
        if (isset($_GET["id"])) {
            $mahang = $_GET["id"];
            // $mh->tangluotxem($mahang); // Bỏ comment nếu có method này trong model
            $mhct = $mh->laymathangtheoid($mahang);
            if ($mhct && isset($mhct["MaDM"])) {
                $madm = $mhct["MaDM"];
                $mathang = $mh->laymathangtheodanhmuc($madm);
            }
            $dsHinhAnh = $ha->layTatCaHinhAnhTheoMaSP($mahang);
            $dsSPLienQuan = $mh->laymathangtheodanhmuc($mhct['MaDM']);
            $tenDM = $dm->laytendanhmuctheoMaSP($mhct['MaDM']);
            include("detail.php");
        }
        break;

    case "giohang":
        // Kiểm tra đăng nhập trước khi xem giỏ hàng
        if (!isset($_SESSION['user'])) {
            echo '<script>alert("Vui lòng đăng nhập để xem giỏ hàng!"); window.location="index.php?action=dangnhap";</script>';
            exit();
        }
        
        // Hiển thị giỏ hàng
        $giohang = [];
        foreach ($_SESSION['cart'] as $masp => $soluong) {
            $sp = $mh->laymathangtheoid($masp);
            if ($sp) {
                $giohang[$masp] = [
                    'id' => $sp['MaSP'],
                    'tenmathang' => $sp['TenSP'],
                    'hinhanh' => $sp['HinhAnh'],
                    'giaban' => $sp['GiaBan'],
                    'soluong' => $soluong,
                    'thanhtien' => $sp['GiaBan'] * $soluong
                ];
            }
        }
        include("cart.php");
        break;

    case "themvaogio":
    case "chovaogio":
        // Kiểm tra đăng nhập trước khi thêm vào giỏ
        if (!isset($_SESSION['user'])) {
            echo '<script>alert("Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng!"); window.location="index.php?action=dangnhap";</script>';
            exit();
        }
        
        // Thêm sản phẩm vào giỏ
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
        }
        if (isset($_REQUEST['soluong'])) {
            $soluong = (int)$_REQUEST['soluong'];
        } else {
            $soluong = 1;
        }

        if (isset($_SESSION['cart'][$id])) {
            // Nếu đã có trong giỏ thì cộng thêm số lượng
            $soluong += $_SESSION['cart'][$id];
            $_SESSION['cart'][$id] = $soluong;
        } else {
            // Nếu chưa có thì thêm mới
            $_SESSION['cart'][$id] = $soluong;
        }

        // Hiển thị giỏ hàng ngay (không redirect)
        $giohang = [];
        foreach ($_SESSION['cart'] as $masp => $sl) {
            $sp = $mh->laymathangtheoid($masp);
            if ($sp) {
                $giohang[$masp] = [
                    'id' => $sp['MaSP'],
                    'tenmathang' => $sp['TenSP'],
                    'hinhanh' => $sp['HinhAnh'],
                    'giaban' => $sp['GiaBan'],
                    'soluong' => $sl,
                    'thanhtien' => $sp['GiaBan'] * $sl
                ];
            }
        }
        include("cart.php");
        break;

    case "capnhatgio":
        // Kiểm tra đăng nhập trước khi cập nhật giỏ hàng
        if (!isset($_SESSION['user'])) {
            echo '<script>alert("Vui lòng đăng nhập để cập nhật giỏ hàng!"); window.location="index.php?action=dangnhap";</script>';
            exit();
        }
        
        // Cập nhật số lượng từ form
        if (isset($_REQUEST['mh']) && is_array($_REQUEST['mh'])) {
            foreach ($_REQUEST['mh'] as $masp => $soluong) {
                $soluong = (int)$soluong;
                if ($soluong > 0) {
                    $_SESSION['cart'][$masp] = $soluong;
                } else {
                    // Số lượng = 0 thì xóa khỏi giỏ
                    unset($_SESSION['cart'][$masp]);
                }
            }
        }
        // Hiển thị giỏ hàng sau khi cập nhật (không redirect)
        $giohang = [];
        foreach ($_SESSION['cart'] as $masp => $sl) {
            $sp = $mh->laymathangtheoid($masp);
            if ($sp) {
                $giohang[$masp] = [
                    'id' => $sp['MaSP'],
                    'tenmathang' => $sp['TenSP'],
                    'hinhanh' => $sp['HinhAnh'],
                    'giaban' => $sp['GiaBan'],
                    'soluong' => $sl,
                    'thanhtien' => $sp['GiaBan'] * $sl
                ];
            }
        }
        include("cart.php");
        break;

    case "xoagiohang":
        // Kiểm tra đăng nhập trước khi xóa giỏ hàng
        if (!isset($_SESSION['user'])) {
            echo '<script>alert("Vui lòng đăng nhập!"); window.location="index.php?action=dangnhap";</script>';
            exit();
        }
        
        // Xóa toàn bộ giỏ hàng
        $_SESSION['cart'] = [];
        // Hiển thị giỏ hàng rỗng (không redirect)
        $giohang = [];
        include("cart.php");
        break;

    case "thanhtoan":
        // Kiểm tra đăng nhập trước khi thanh toán
        if (!isset($_SESSION['user'])) {
            echo '<script>alert("Vui lòng đăng nhập để thanh toán!"); window.location="index.php?action=dangnhap";</script>';
            exit();
        }
        
        // Trang thanh toán
        include("checkout.php");
        break;

    default:
        $mathang = $mh->laymathang();
        include("main.php");
        break;
}
