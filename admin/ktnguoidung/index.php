<?php
session_start();
require("../../model/database.php");
require("../../model/nguoidung.php");
// Biến $isLogin cho biết người dùng đăng nhập chưa
$isLogin = isset($_SESSION["nguoidung"]);
// Kiểm tra hành động $action: yêu cầu đăng nhập nếu chưa xác thực
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} elseif ($isLogin == FALSE) {
    $action = "dangnhap";
} else {
    $action = "macdinh";
}
$nd = new NGUOIDUNG();
switch ($action) {
    case "macdinh":
        include("main.php");
        break;
    case "dangnhap":
        include("login.php");
        break;
    case "xulydangnhap":
        // xử lý đăng nhập chuyển sang file xử lý riêng
        include("xulydangnhap.php");
        break;
    case "xldangnhap":
        $email = $_POST["txtemail"];
        $matkhau = $_POST["txtmatkhau"];
        if ($nd->kiemtranguoidunghople($email, $matkhau) == TRUE) {
            $_SESSION["nguoidung"] = $nd->laythongtinnguoidung($email);
            include("main.php");
        } else {
            include("login.php");
        }
        break;
    case "hoso":
        include("profile.php");
        break;
    case "xlhoso":
        $mand = $_POST["txtid"];
        $email = $_POST["txtemail"];
        $sodt = $_POST["txtdienthoai"];
        $hoten = $_POST["txthoten"];
        $hinhanh = $_POST["txthinhanh"];
        if ($_FILES["fhinh"]["name"] != null) {
            $hinhanh = basename($_FILES["fhinh"]["name"]);
            $duongdan = "../../images/users/" . $hinhanh;
            move_uploaded_file($_FILES["fhinh"]["tmp_name"], $duongdan);
        }
        $nd->capnhatnguoidung($mand, $email, $sodt, $hoten, $hinhanh);
        $_SESSION["nguoidung"] = $nd->laythongtinnguoidung($email);
        include("main.php");
        break;
    case "matkhau":
        include("changepass.php");
        break;
    case "doimatkhau":
        if (isset($_POST["txtemail"]) && isset($_POST["txtmatkhaumoi"]))
            $nd->doimatkhau($_POST["txtemail"], $_POST["txtmatkhaumoi"]);
        else {
            echo "chưa đổi được mật khẩu";
        }
        include("main.php");
        break;
    case "dangxuat":
        unset($_SESSION["nguoidung"]);
        include("login.php");
        break;
    default:
        break;
}
?>