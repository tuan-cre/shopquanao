<?php include("../inc/top.php");
 ?>

<h3>Thêm người dùng</h3>
<br>
<form method="post" action="index.php">
    <input type="hidden" name="action" value="them">

    <div class="mb-3 mt-3">
        <label class="form-label">Email</label>
        <input class="form-control" type="email" name="txtemail" placeholder="Email" required>
    </div>

    <div class="mb-3 mt-3">
        <label class="form-label">Mật khẩu</label>
        <input class="form-control" type="password" name="txtmatkhau" placeholder="Mật khẩu" required>
    </div>

    <div class="mb-3 mt-3">
        <label class="form-label">Số điện thoại</label>
        <input class="form-control" type="text" name="txtdienthoai" placeholder="Số điện thoại">
    </div>

    <div class="mb-3 mt-3">
        <label class="form-label">Họ tên</label>
        <input class="form-control" type="text" name="txthoten" placeholder="Họ tên">
    </div>

    <div class="mb-3 mt-3">
        <label class="form-label">Quyền</label>
        <select class="form-select" name="optloaind">
            <option value="1">Quản trị</option>
            <option value="2" selected>Thành viên</option>
            <option value="3">Khách hàng</option>
        </select>
    </div>

    <div class="mb-3 mt-3">
        <input class="btn btn-success" type="submit" value="Lưu">
        <input class="btn btn-warning" type="reset" value="Hủy">
    </div>
</form>

<?php include("../inc/bottom.php"); ?>
