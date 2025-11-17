<?php
session_start();
if(!isset($_SESSION["nguoidung"])){
    header("location:../index.php");
    exit();
}
require("../../model/database.php");
require("../../model/danhmuc.php");
require("../../model/mathang.php");

// Xét xem có thao tác nào được chọn
if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action="xem";
}

$dm = new DANHMUC();
$mh = new MATHANG();

switch($action){
    case "xem":
        $mathang = $mh->laymathang();
		include("main.php");
        break;
	case "them":
		$danhmuc = $dm->laydanhmuc();
		include("addform.php");
        break;
	case "xulythem":	
        
		$ten_file_goc = basename($_FILES["filehinhanh"]["name"]);
		$ten_file_sach = preg_replace("/[^a-zA-Z0-9\.\-_]/", "", $ten_file_goc);
		$hinhanh = "images/products/" . $ten_file_sach;
		$duongdan = __DIR__ . "/../../" . $hinhanh;

		$thu_muc_dich = dirname($duongdan);
		if (!is_dir($thu_muc_dich)) {
		    mkdir($thu_muc_dich, 0775, true);
		}

		move_uploaded_file($_FILES["filehinhanh"]["tmp_name"], $duongdan);	
        $mathanghh = new MATHANG();
		$mathanghh->settenmathang($_POST["txttenmathang"]);
		$mathanghh->setgiagoc($_POST["txtgianhap"]);
		$mathanghh->setgiaban($_POST["txtgiaban"]);
		$mathanghh->setdanhmuc_id($_POST["optdanhmuc"]);
        $mathanghh->sethinhanh($hinhanh);
		$mh->themmathang($mathanghh);
		$mathang = $mh->laymathang();
		include("main.php");
        break;
	case "xoa":
		if(isset($_GET["MaSP"])){
            $mathanghh = new MATHANG();        
            $mathanghh->setid($_GET["MaSP"]);
			$mh->xoamathang($mathanghh);
        }
		$mathang = $mh->laymathang();
		include("main.php");
		break;	
    case "chitiet":
        if(isset($_GET["MaSP"])){ 
            $m = $mh->laymathangtheoid($_GET["MaSP"]);            
            include("detail.php");
        }
        else{
            $mathang = $mh->laymathang();        
            include("main.php");            
        }
        break;
    case "sua":
        if(isset($_GET["MaSP"])){ 
            $m = $mh->laymathangtheoid($_GET["MaSP"]);
            $danhmuc = $dm->laydanhmuc(); 
            include("updateform.php");
        }
        else{
            $mathang = $mh->laymathang();        
            include("main.php");            
        }
        break;
    case "xulysua":
        $mathanghh = new MATHANG();
        $mathanghh->setid($_POST["txtid"]);
        $mathanghh->setdanhmuc_id($_POST["optdanhmuc"]);
        $mathanghh->settenmathang($_POST["txttenhang"]);
        $mathanghh->setgiagoc($_POST["txtgiagoc"]);
        $mathanghh->setgiaban($_POST["txtgiaban"]);

        $mathanghh->sethinhanh($_POST["txthinhcu"]);

        if($_FILES["filehinhanh"]["name"]!=""){
            $hinhanh = "images/" . basename($_FILES["filehinhanh"]["name"]);
            $mathanghh->sethinhanh($hinhanh);
            $duongdan = "../../" . $hinhanh;      
            move_uploaded_file($_FILES["filehinhanh"]["tmp_name"], $duongdan);
        }
        
        $mh->suamathang($mathanghh);         
    
        $mathang = $mh->laymathang();    
        include("main.php");
        break;

    default:
        break;
}
?>
