<?php
session_start();
if(!isset($_SESSION["nguoidung"])){
    header("location:../index.php");
    exit();
}
require("../../model/database.php");
require("../../model/nguoidung.php");
// Xét xem có thao tác nào được chọn
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} else { // mặc định là xem danh sách
    $action = "xem";
}

$nd = new NGUOIDUNG();
$idsua = 0;
switch ($action) {
    case "xem":
        $nguoidung = $nd->laydanhsachnguoidung();
        include("main.php");
        break;
    case "sua": // hiển thị form
        $idsua = $_GET["id"];
        $nguoidung = $nd->laythongtinnguoidung($idsua);
        include("main.php");
        break;
    case "capnhat": // lưu dữ liệu sửa mới vào db
// gán dữ liệu từ form
        $ndmoi = new NGUOIDUNG();
        $ndmoi->setid($_POST["id"]);
        $ndmoi->setemail($_POST["email"]);
        $ndmoi->setmatkhau($_POST["matkhau"]);
        $ndmoi->setsodt($_POST["sodt"]);
        $ndmoi->sethoten($_POST["hoten"]);
        $ndmoi->setloai($_POST["loai"]);
        // sửa
        $nd->suanguoidung($ndmoi);
        // load danh sách
        $nguoidung = $nd->laydanhsachnguoidung();
        include("main.php");
        break;
    case "them":
        // Thêm người dùng -- map fields from addform.php and validate
        $email = isset($_POST['txtemail']) ? trim($_POST['txtemail']) : '';
        $matkhau = isset($_POST['txtmatkhau']) ? $_POST['txtmatkhau'] : '';
        $sodt = isset($_POST['txtdienthoai']) ? trim($_POST['txtdienthoai']) : '';
        $hoten = isset($_POST['txthoten']) ? trim($_POST['txthoten']) : '';
        $loai = isset($_POST['optloaind']) ? intval($_POST['optloaind']) : 2;

        // Validate required fields
        if ($email === '' || $matkhau === '') {
            $tb = 'Email và mật khẩu là bắt buộc.';
            // show the add form with error
            include("addform.php");
            break;
        }

        try {
            $nd->themnguoidung($email, $matkhau, $sodt, $hoten, $loai);
            $tb = 'Thêm người dùng thành công.';
        } catch (Exception $e) {
            // giữ thông báo lỗi để hiển thị
            $tb = 'Lỗi thêm người dùng: ' . $e->getMessage();
        }

        // load danh sách
        $nguoidung = $nd->laydanhsachnguoidung();
        include("main.php");
        break;
    case "xoa":
        // lấy dòng muốn xóa
        $dmxoa = new DANHMUC();
        $dmxoa->setid($_GET["id"]);
        // xóa
        $dm->xoadanhmuc($dmxoa);
        // load danh sách
        $danhmuc = $dm->laydanhmuc();
        include("main.php");
        break;
    default:
        break;
}
?>