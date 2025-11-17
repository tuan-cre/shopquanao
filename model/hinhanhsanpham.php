<?php
class HINHANHSANPHAM
{
    private $id;
    private $masp;
    private $duongdan;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getMaSP()
    {
        return $this->masp;
    }

    public function setMaSP($masp)
    {
        $this->masp = $masp;
    }

    public function getDuongdan()
    {
        return $this->duongdan;
    }

    public function setDuongdan($duongdan)
    {
        $this->duongdan = $duongdan;
    }

    // Thêm hình ảnh sản phẩm
    public function themHinhAnh()
    {
        try {
            $sql = "INSERT INTO hinhanhsanpham (MaSP, DuongDan) VALUES (:masp, :duongdan)";
            $conn = DATABASE::connect();
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':masp', $this->masp);
            $stmt->bindParam(':duongdan', $this->duongdan);
            $result = $stmt->execute();
            return $result;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    public function layHinhAnhTheoMaSP($masp)
    {
        try {
            $sql = "SELECT Duongdan FROM hinhanhsanpham WHERE MaSP = :masp ORDER BY idHinhAnh DESC LIMIT 1";
            $conn = DATABASE::connect();
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':masp', $masp);
            $stmt->execute();
            $hinhAnh= $stmt->fetchColumn();
            return $hinhAnh;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }

    public function layTatCaHinhAnhTheoMaSP($masp)
    {
        try {
            $sql = "SELECT * FROM hinhanhsanpham WHERE MaSP = :masp";
            $conn = DATABASE::connect();
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':masp', $masp);
            $stmt->execute();
            $hinhAnhs= $stmt->fetchAll();
            return $hinhAnhs;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }

    public function xoaHinhAnhTheoMaSP($masp)
    {
        try {
            $sql = "DELETE FROM hinhanhsanpham WHERE MaSP = :masp";
            $conn = DATABASE::connect();
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':masp', $masp);
            $result = $stmt->execute();
            return $result;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

};
