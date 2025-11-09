<?php
class NGUOIDUNG
{
    private $id, $email, $hoten, $matkhau, $sodienthoai, $loai, $trangthai, $hinhanh;
    // Các phương thức getter và setter
    public function getId()
    {
        return $this->id;
    }
    public function setId($value)
    {
        $this->id = $value;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($value)
    {
        $this->email = $value;
    }
    public function getHoten()
    {
        return $this->hoten;
    }
    public function setHoten($value)
    {
        $this->hoten = $value;
    }
    public function getMatkhau()
    {
        return $this->matkhau;
    }
    public function setMatkhau($value)
    {
        $this->matkhau = $value;
    }
    public function getSodienthoai()
    {
        return $this->sodienthoai;
    }
    public function setSodienthoai($value)
    {
        $this->sodienthoai = $value;
    }
    public function getLoai()
    {
        return $this->loai;
    }
    public function setLoai($value)
    {
        $this->loai = $value;
    }
    public function getTrangthai()
    {
        return $this->trangthai;
    }
    public function setTrangthai($value)
    {
        $this->trangthai = $value;
    }
    public function getHinhanh()
    {
        return $this->hinhanh;
    }
    public function setHinhanh($value)
    {
        $this->hinhanh = $value;
    }

    // Contructor
    public function __construct()
    {
        $this->id = 0;
        $this->email = "";
        $this->hoten = "";
        $this->matkhau = "";
        $this->sodienthoai = "";
        $this->loai = 3; // Mặc định là khách hàng
        $this->trangthai = 1; // Mặc định là kích hoạt
        $this->hinhanh = ""; // Hình mặc định
    }

    public function kiemtranguoidunghople($username, $matkhau)
    {
        $db = DATABASE::connect();
        try {
            // Sử dụng bảng TaiKhoan để xác thực
            $sql = "SELECT * FROM TaiKhoan WHERE Username=:username AND Password=:matkhau AND TinhTrang='Hoạt động'";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":username", $username);
            $cmd->bindValue(":matkhau", md5($matkhau));
            $cmd->execute();
            $valid = ($cmd->rowCount() == 1);
            $cmd->closeCursor();
            return $valid;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // lấy thông tin người dùng có $id
    public function laythongtinnguoidung($username)
    {
        $db = DATABASE::connect();
        try {
            // Giả định username là email và lấy thông tin từ bảng NhanVien
            $sql = "SELECT nv.MaNV as id, nv.HoTen as hoten, nv.Email as email, nv.SoDT as sodienthoai, nv.DiaChi as diachi, tk.Quyen as loai, tk.TinhTrang as trangthai, '' as hinhanh 
                    FROM NhanVien nv 
                    JOIN TaiKhoan tk ON nv.Email = tk.Username 
                    WHERE nv.Email=:username";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":username", $username);
            $cmd->execute();
            $ketqua = $cmd->fetch();
            $cmd->closeCursor();
            return $ketqua;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // lấy tất cả người dùng
    public function laydanhsachnguoidung()
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM nguoidung ORDER BY loai ASC, hoten ASC";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $ketqua = $cmd->fetchAll();
            foreach ($ketqua as $nd) {
                $nguoidung = new NGUOIDUNG();
                $nguoidung->setId($nd["id"]);
                $nguoidung->setEmail($nd["email"]);
                $nguoidung->setHoten($nd["hoten"]);
                $nguoidung->setMatkhau($nd["matkhau"]);
                $nguoidung->setSodienthoai($nd["sodienthoai"]);
                $nguoidung->setLoai($nd["loai"]);
                $nguoidung->setTrangthai($nd["trangthai"]);
                $nguoidung->setHinhanh($nd["hinhanh"]);
                $dsnguoidung[] = $nguoidung;
            }
            return $dsnguoidung;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }


    public function themNguoidung($nguoidung)
    {
        $db = DATABASE::connect();
        try {
            $sql = "INSERT INTO nguoidung (email, hoten, matkhau, sodienthoai, loai, trangthai, hinhanh)
                    VALUES (:email, :hoten, :matkhau, :sodienthoai, :loai, :trangthai, :hinhanh)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":email", $nguoidung->getEmail());
            $cmd->bindValue(":hoten", $nguoidung->getHoten());
            $cmd->bindValue(":matkhau", md5($nguoidung->getMatkhau()));
            $cmd->bindValue(":sodienthoai", $nguoidung->getSodienthoai());
            $cmd->bindValue(":loai", $nguoidung->getLoai());
            $cmd->bindValue(":trangthai", $nguoidung->getTrangthai());
            $cmd->bindValue(":hinhanh", $nguoidung->getHinhanh());
            $cmd->execute();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Sửa thông tin người dùng
    public function suaNguoiDung($nguoidung) {
        $db = DATABASE::connect();
        try {
            // Cập nhật bảng NhanVien
            $sql = "UPDATE NhanVien SET HoTen=:hoten, SoDT=:sodienthoai, Email=:email
                    WHERE MaNV=:id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":id", $nguoidung->getId());
            $cmd->bindValue(":email", $nguoidung->getEmail());
            $cmd->bindValue(":hoten", $nguoidung->getHoten());
            $cmd->bindValue(":sodienthoai", $nguoidung->getSodienthoai());
            $cmd->execute();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Đổi mật khẩu người dùng
    public function doiMatKhau($username, $matkhauMoi) {
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE TaiKhoan SET Password=:matkhau WHERE Username=:username";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":username", $username);
            $cmd->bindValue(":matkhau", md5($matkhauMoi));
            $cmd->execute();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Đổi quyền người dùng
    public function doiQuyen($id, $loaiMoi) {
        $db = DATABASE::connect();
        try {
            // Cần có username để cập nhật bảng TaiKhoan
            $sql = "UPDATE TaiKhoan SET Quyen=:loai WHERE Username=(SELECT Email FROM NhanVien WHERE MaNV=:id)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":id", $id);
            $cmd->bindValue(":loai", $loaiMoi);
            $cmd->execute();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Khóa / Mở khóa người dùng
    public function thayDoiTrangThai($id, $trangthaiMoi) {
        $db = DATABASE::connect();
        try {
            // Cần có username để cập nhật bảng TaiKhoan
            $sql = "UPDATE TaiKhoan SET TinhTrang=:trangthai WHERE Username=(SELECT Email FROM NhanVien WHERE MaNV=:id)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":id", $id);
            $cmd->bindValue(":trangthai", $trangthaiMoi);
            $cmd->execute();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
}
