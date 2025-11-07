<?php
class MATHANG
{
    private $id, $tenMatHang, $moTa, $giaGoc, $giaBan, $soLuongTon, $hinhAnh, $danhMuc_id, $luotXem, $luotMua;
    // getter and setter
    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getTenMatHang()
    {
        return $this->tenMatHang;
    }

    public function setTenMatHang($value)
    {
        $this->tenMatHang = $value;
    }

    public function getMoTa()
    {
        return $this->moTa;
    }

    public function setMoTa($value)
    {
        $this->moTa = $value;
    }

    public function getGiaGoc()
    {
        return $this->giaGoc;
    }

    public function setGiaGoc($value)
    {
        $this->giaGoc = $value;
    }

    public function getGiaBan()
    {
        return $this->giaBan;
    }

    public function setGiaBan($value)
    {
        $this->giaBan = $value;
    }

    public function getSoLuongTon()
    {
        return $this->soLuongTon;
    }

    public function setSoLuongTon($value)
    {
        $this->soLuongTon = $value;
    }

    public function getHinhAnh()
    {
        return $this->hinhAnh;
    }

    public function setHinhAnh($value)
    {
        $this->hinhAnh = $value;
    }

    public function getDanhMuc_id()
    {
        return $this->danhMuc_id;
    }

    public function setDanhMuc_id($value)
    {
        $this->danhMuc_id = $value;
    }

    public function getLuotXem()
    {
        return $this->luotXem;
    }

    public function setLuotXem($value)
    {
        $this->luotXem = $value;
    }

    public function getLuotMua()
    {
        return $this->luotMua;
    }

    public function setLuotMua($value)
    {
        $this->luotMua = $value;
    }

    public function laymathang()
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM mathang";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $mathang = $cmd->fetchAll();
            $cmd->closeCursor();
            return $mathang;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    public function laymathangtheoid($id)
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM mathang WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', $id);
            $cmd->execute();
            $mathang = $cmd->fetch();
            $cmd->closeCursor();
            return $mathang;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    public function laymathangtheodanhmuc($danhMuc_id)
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM mathang WHERE danhMuc_id = :danhMuc_id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':danhMuc_id', $danhMuc_id);
            $cmd->execute();
            $mathang = $cmd->fetchAll();
            $cmd->closeCursor();
            return $mathang;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    public function tangLuotXem($id)
    {
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE mathang SET luotXem = luotXem + 1 WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', $id);
            $cmd->execute();
            $cmd->closeCursor();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    public function laymathangxemnhieu()
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM mathang ORDER BY luotxem DESC LIMIT 5";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $mathang = $cmd->fetchAll();
            $cmd->closeCursor();
            return $mathang;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Thêm mới
    public function themmathang($mathang)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "INSERT INTO
mathang(tenmathang,mota,giagoc,giaban,soluongton,danhmuc_id,hinhanh,luotxem,luotmua)
VALUES(:tenmathang,:mota,:giagoc,:giaban,:soluongton,:danhmuc_id,:hinhanh,0,0)";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tenmathang", $mathang->getTenMatHang());
            $cmd->bindValue(":mota", $mathang->getMoTa());
            $cmd->bindValue(":giagoc", $mathang->getGiaGoc());
            $cmd->bindValue(":giaban", $mathang->getGiaBan());
            $cmd->bindValue(":soluongton", $mathang->getSoLuongTon());
            $cmd->bindValue(":danhmuc_id", $mathang->getDanhMuc_Id());
            $cmd->bindValue(":hinhanh", $mathang->getHinhAnh());
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Xóa
    public function xoamathang($mathang)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "DELETE FROM mathang WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $mathang->getId());
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Cập nhật
    public function suamathang($mathang)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "UPDATE mathang SET  tenmathang=:tenmathang,
                                        mota=:mota,
                                        giagoc=:giagoc,
                                        giaban=:giaban,
                                        soluongton=:soluongton,
                                        danhmuc_id=:danhmuc_id,
                                        hinhanh=:hinhanh,
                                        luotxem=:luotxem,
                                        luotmua=:luotmua
                                        WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tenmathang", $mathang->getTenMatHang());
            $cmd->bindValue(":mota", $mathang->getMoTa());
            $cmd->bindValue(":giagoc", $mathang->getGiaGoc());
            $cmd->bindValue(":giaban", $mathang->getGiaBan());
            $cmd->bindValue(":soluongton", $mathang->getSoLuongTon());
            $cmd->bindValue(":danhmuc_id", $mathang->getDanhMuc_Id());
            $cmd->bindValue(":hinhanh", $mathang->getHinhAnh());
            $cmd->bindValue(":luotxem", $mathang->getLuotXem());
            $cmd->bindValue(":luotmua", $mathang->getLuotMua());
            $cmd->bindValue(":id", $mathang->getId());
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
}
