<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/main.css">
    <link rel="icon" href="worldwide.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Shop Thời Trang</title>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet " />
</head>

<body id="top">
    <header>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark shadow">
            <div class="container">
                <a class="navbar-brand fw-bold" href="index.php"><i class="bi bi-shop-window"></i> Shop Thời Trang</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item fw-bold"><a class="nav-link active" aria-current="page" href="index.php">Trang chính</a></li>
                        <li class="nav-item fw-bold"><a class="nav-link" href="#!">Giới thiệu</a></li>
                        <li class="nav-item fw-bold"><a class="nav-link" href="#!">Sản phẩm</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-bold" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Danh mục sản phẩm</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <!-- <?php foreach ($danhmuc as $d): ?>
                                    <li><a class="dropdown-item" href="?action=group&id=<?php echo $d["id"]; ?>">
                                        <?php echo $d["tendanhmuc"]; ?></a></li>
                                <?php endforeach; ?> -->
                            </ul>
                        </li>
                        <li class="nav-item fw-bold"><a class="nav-link" href="#!">Liên hệ</a></li>
                    </ul>

                    <!-- Info -->
                    <div class="dropdown align-items-center">
                        <a class="dropdown-toggle me-3 text-decoration-none" href="#"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> Khách hàng
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item " href="#">Thông tin</a></li>
                            <li><a class="dropdown-item " href="#">Giỏ hàng</a></li>
                            <li><a class="dropdown-item " href="#!">Đổi mật khẩu</a></li>
                            <li><a class="dropdown-item " href="#!">Đăng xuất</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Search -->
        <div class="search-bar px-5 py-2 d-flex justify-content-end">
            <form class="d-flex" role="search" style="width: 470px;">
                <input class="form-control form-control-lg me-2" type="search" placeholder="Search for books" aria-label="Search">
                <button class="btn btn-outline-light btn-lg" type="submit"><i class="bi bi-search"></i></button>
            </form>
        </div>

        <!-- Content -->
        <div class="content d-flex flex-column justify-content-center align-items-start px-5 mb-4 h-100">
            <h3 class="fw-bold text-white">Chào mừng đến với Shop Thời Trang</h3>
            <p class="fw-bold text-white fs-2">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Suscipit labore d.</p>
            <div class="row">
                <div class="col-auto me-2">
                    <button class="btn btn-info"> Đăng nhập</button>
                </div>
                <div class="col-auto me-2">
                    <button class="btn btn-info"> Đăng ký</button>
                </div>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-1">