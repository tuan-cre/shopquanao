<?php
session_start();
if (!isset($_SESSION["nguoidung"])) {
    header("location:../index.php");
    exit();
}
require("../../model/database.php");
require("../../model/danhmuc.php");
require("../../model/mathang.php");
require("../../model/hinhanhsanpham.php");

// Xét xem có thao tác nào được chọn
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} else {
    $action = "xem";
}

$dm = new DANHMUC();
$mh = new MATHANG();
$ha = new HINHANHSANPHAM();

switch ($action) {
    case "xem":
        $mathang = $mh->laymathang();
        include("main.php");
        break;
    case "them":
        $danhmuc = $dm->laydanhmuc();
        include("addform.php");
        break;
    case "xulythem":
        if (!isset($_POST["txttenmathang"]) || !isset($_FILES["filehinhanh"])) {
            throw new Exception("Thiếu dữ liệu bắt buộc.");
        }

        $mathanghh = new MATHANG();
        $mathanghh->settenmathang($_POST["txttenmathang"]);
        $mathanghh->setgiagoc($_POST["txtgianhap"]);
        $mathanghh->setgiaban($_POST["txtgiaban"]);
        $mathanghh->setdanhmuc_id($_POST["optdanhmuc"]);
        $mathanghh->setMoTa($_POST['txtmota']);

        // Thêm mặt hàng vào CSDL
        $mh->themmathang($mathanghh);

        $maSP = $mh->laymathangvuathem();

        // Thư mục lưu ảnh
        $uploadFolder = __DIR__ . "/../../images/products/";
        if (!is_dir($uploadFolder)) {
            mkdir($uploadFolder, 0775, true);
        }

        // Duyệt file upload (dự kiến input name="filehinhanh[]" multiple)
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $order = 1;
        foreach ($_FILES["filehinhanh"]["tmp_name"] as $key => $tmp_name) {
            if (!is_uploaded_file($tmp_name)) continue;

            $originalName = basename($_FILES["filehinhanh"]["name"][$key]);
            $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
            if (!in_array($ext, $allowedExt)) continue; // hoặc báo lỗi

            // tạo tên file duy nhất tránh trùng
            $safeBase = preg_replace("/[^a-zA-Z0-9\.\-_]/", "", pathinfo($originalName, PATHINFO_FILENAME));
            $uniqueName = $safeBase . '_' . time() . '_' . $key . '.' . $ext;
            $relativePath = "images/products/" . $uniqueName;
            $dest = $uploadFolder . $uniqueName;

            if (!move_uploaded_file($tmp_name, $dest)) {
                continue;
            }

            $hinhAnhSP = new HINHANHSANPHAM();
            $hinhAnhSP->setMaSP($maSP);
            $hinhAnhSP->setDuongdan($relativePath);
            $hinhAnhSP->themHinhAnh();
        }

        $duongdanAnh = $ha->layHinhAnhTheoMaSP($maSP);
        $mh->capNhatHinhAnh($maSP, $duongdanAnh);

        $mathang = $mh->laymathang();
        include("main.php");
        break;
    case "xoa":
        if (isset($_GET["MaSP"])) {
            $mathanghh = new MATHANG();
            $mathanghh->setid($_GET["MaSP"]);
            $mh->xoamathang($mathanghh);
        }
        $mathang = $mh->laymathang();
        include("main.php");
        break;
    case "chitiet":
        if (isset($_GET["MaSP"])) {
            $m = $mh->laymathangtheoid($_GET["MaSP"]);
            include("detail.php");
        } else {
            $mathang = $mh->laymathang();
            include("main.php");
        }
        break;
    case "sua":
        if (isset($_GET["MaSP"])) {
            $m = $mh->laymathangtheoid($_GET["MaSP"]);
            $danhmuc = $dm->laydanhmuc();
            include("updateform.php");
        } else {
            $mathang = $mh->laymathang();
            include("main.php");
        }
        break;
    case "xulysua":
        $idSP = isset($_POST["txtid"]) ? (int)$_POST["txtid"] : 0;
        if ($idSP <= 0) {
            throw new Exception("ID sản phẩm không hợp lệ.");
        }

        // Cập nhật thông tin cơ bản của sản phẩm
        $mathanghh = new MATHANG();
        $mathanghh->setid($idSP);
        $mathanghh->setdanhmuc_id($_POST["optdanhmuc"]);
        $mathanghh->settenmathang($_POST["txttenhang"]);
        $mathanghh->setgiagoc($_POST["txtgiagoc"]);
        $mathanghh->setgiaban($_POST["txtgiaban"]);
        $mathanghh->setMoTa($_POST['txtmota']);

        // Nếu có upload ảnh chính mới (input name="hinhanh")
        if (isset($_FILES["hinhanh"]) && !empty($_FILES["hinhanh"]["name"])) {
            // tạo tên an toàn và move file
            $orig = basename($_FILES["hinhanh"]["name"]);
            $ext = strtolower(pathinfo($orig, PATHINFO_EXTENSION));
            $safeBase = preg_replace("/[^a-zA-Z0-9\.\-_]/", "", pathinfo($orig, PATHINFO_FILENAME));
            $uniqueMain = $safeBase . '_' . time() . '.' . $ext;
            $uploadFolder = __DIR__ . "/../../images/products/";
            if (!is_dir($uploadFolder)) mkdir($uploadFolder, 0775, true);
            $destMain = $uploadFolder . $uniqueMain;

            if (is_uploaded_file($_FILES["hinhanh"]["tmp_name"]) && move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $destMain)) {
                // Chỉ lưu tên file vào bảng SanPham (không có path)
                $mathanghh->sethinhanh($uniqueMain);
            }
        } else {
            // giữ ảnh cũ: server gửi txthinhcu trong form
            $mathanghh->sethinhanh($_POST["txthinhcu"] ?? null);
        }

        // Thực hiện update thông tin sản phẩm
        $mh->suamathang($mathanghh);

        // 2) Xử lý ảnh gallery (filehinhanh[]). Chiến lược an toàn:
        // - Nếu không có file mới => giữ nguyên gallery (không xóa)
        // - Nếu có file mới => di chuyển tất cả file mới sang thư mục, nếu tất cả ok -> xóa file cũ trong FS và DB -> chèn bản ghi mới

        $hasNewGallery = false;
        if (isset($_FILES["filehinhanh"]) && isset($_FILES["filehinhanh"]["name"]) && is_array($_FILES["filehinhanh"]["name"])) {
            // kiểm xem có ít nhất 1 file được chọn (tên khác rỗng)
            foreach ($_FILES["filehinhanh"]["name"] as $nm) {
                if (!empty($nm)) {
                    $hasNewGallery = true;
                    break;
                }
            }
        }

        $uploadFolder = __DIR__ . "/../../images/products/";
        if (!is_dir($uploadFolder)) mkdir($uploadFolder, 0775, true);

        $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if ($hasNewGallery) {
            // 2.1 Di chuyển tất cả file mới vào temp list
            $movedFiles = []; // chứa relative paths đã move thành công
            foreach ($_FILES["filehinhanh"]["tmp_name"] as $key => $tmp_name) {
                if (!is_uploaded_file($tmp_name)) continue;
                $originalName = basename($_FILES["filehinhanh"]["name"][$key]);
                if (empty($originalName)) continue;
                $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
                if (!in_array($ext, $allowedExt)) continue;

                $safeBase = preg_replace("/[^a-zA-Z0-9\.\-_]/", "", pathinfo($originalName, PATHINFO_FILENAME));
                $uniqueName = $safeBase . '_' . time() . '_' . $key . '.' . $ext;
                $relativePath = "images/products/" . $uniqueName;
                $dest = $uploadFolder . $uniqueName;

                if (move_uploaded_file($tmp_name, $dest)) {
                    $movedFiles[] = $relativePath;
                }
            }

            // Nếu có file đã move thành công -> xóa ảnh cũ và insert mới
            if (!empty($movedFiles)) {
                // lay all anh cu
                $existingImages = $ha->layTatCaHinhAnhTheoMaSP($idSP);

                // xac dinh anh chinh
                $finalMainImage = $mathanghh->getHinhAnh();
                // tao duong dan
                $finalMainImageBasename = $finalMainImage ? basename($finalMainImage) : null;

                // xoa anh cu
                $keptOldImage = null; 
                foreach ($existingImages as $image) {
                    $filePath = __DIR__ . "/../../" . $image['DuongDan'];
                    $basename = basename($image['DuongDan']);
                    if ($finalMainImageBasename && $basename === $finalMainImageBasename) {
                        // giu anh main
                        $keptOldImage = $image['DuongDan'];
                        continue;
                    }
                    if (file_exists($filePath)) {
                        @unlink($filePath);
                    }
                }

                //xoa anh cu
                $ha->xoaHinhAnhTheoMaSP($idSP);

                $finalGallery = $movedFiles;
                if ($keptOldImage) {
                    if (!in_array($keptOldImage, $finalGallery)) {
                        array_unshift($finalGallery, $keptOldImage);
                    }
                }

                // 2.5 Chen cac anh moi vao DB
                $order = 1;
                foreach ($finalGallery as $rel) {
                    $hinhAnhSP = new HINHANHSANPHAM();
                    $hinhAnhSP->setMaSP($idSP);
                    $hinhAnhSP->setDuongdan($rel);
                    $hinhAnhSP->themHinhAnh();
                }
            } else {
                // Không file nào move thành công -> không thay đổi gì cho gallery
            }
        }

        // 3) Sau khi xong, load lại danh sách sản phẩm
        $mathang = $mh->laymathang();
        include("main.php");
        break;

    default:
        break;
}
