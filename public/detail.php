<?php include("inc/top.php"); ?>
<div class="detail-product px-lg-5">
    <div class="d-flex flex-md-row flex-column mb-5">
        <div class="product-image me-4">
            <img id="main-img" src="../images/products/<?= $mhct['HinhAnh']  ?>" alt="Áo nỉ màu xám" />
            <div class="img-more d-flex justify-content-evenly mt-3">
                <?php foreach ($dsHinhAnh as $ha): ?>
                    <img class="img-item" src="../<?= $ha['DuongDan'] ?>" alt="<?= $mhct['TenSP'] ?>" />
                <?php endforeach; ?>
            </div>
        </div>
        <div class="product-description">
            <div class="detail">
                <h4>Danh mục: <?= $tenDM['TenDanhMuc'] ?></h4>
                <h2 class="fw-bold"> <?= $mhct['TenSP'] ?></h2>
                <h3>Giá gốc: <?= $mhct['GiaGoc'] ?>VNĐ</h3>
                <h3>Giá bán: <?= $mhct['GiaBan'] ?>VNĐ</h3>
            </div>
            <div class="action row">
                <hr>
                <form method="get" action="index.php">
                    <input type="hidden" name="action" value="chovaogio">
                    <input type="hidden" name="id" value="<?php echo $mhct['MaSP']; ?>">
                    <div class="size-selector">
                        <input type="radio" id="size-s" name="size" value="S">
                        <label for="size-s">S</label>

                        <input type="radio" id="size-m" name="size" value="M">
                        <label for="size-m">M</label>

                        <input type="radio" id="size-l" name="size" value="L">
                        <label for="size-l">L</label>

                        <input type="radio" id="size-xl" name="size" value="XL">
                        <label for="size-xl">XL</label>
                    </div>

                    <div class="d-flex align-items-center mt-3">
                        <input type="number" name="soluong" min="1" value="1" class="form-control w-25 me-3" />
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="bi bi-cart-plus"></i> Thêm vào giỏ hàng
                        </button>
                    </div>
                </form>
                <hr class="mt-4">
            </div>
            <span> Thể loại: <a href="" class="text-decoration-none"> <?= $tenDM['TenDanhMuc'] ?> </a></span><br />
        </div>
    </div>
    <div class="product-detail-tab mt-5">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#menu1">Mô tả sản phẩm</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#menu2">Đánh giá</a>
            </li>
        </ul>
        <div class="tab-content p-3 border border-top-0">
            <div id="menu1" class="container tab-pane active"><br>
                <h4>Mô tả sản phẩm</h4>
                <p> <?= $mhct['MoTa'] ?>
                </p>
            </div>
            <div id="menu2" class="container tab-pane "><br>
                <h4>Đánh giá</h4>
                <p>Chưa có đánh giá nào</p>
            </div>
        </div>
    </div>
    <div class="related-products py-3">
        <h3 class="mb-4">Sản phẩm liên quan</h3>
        <div class="d-flex justify-content-around">
            <?php foreach ($dsSPLienQuan as $splq): ?>
                <a class="text-decoration-none px-1 w-25 d-inline-block" href="index.php?action=detail&id=<?= $splq['MaSP'] ?>">
                    <div class="products h-100">
                        <div class="card h-100">
                            <img src="../images/products/<?= $splq['HinhAnh'] ?>" class="card-img-top h-75" alt="<?= $splq["TenSP"] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $splq['TenSP'] ?></h5>
                                <p class="card-text text-danger fw-bold"><?= $splq['GiaBan'] ?>VNĐ</p>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const mainImg = document.getElementById("main-img");
            const thumbnails = document.querySelectorAll(".img-item");

            thumbnails.forEach(img => {
                img.addEventListener("click", function() {
                    mainImg.style.opacity = 0;
                    setTimeout(() => {
                        mainImg.src = this.src;
                        mainImg.style.opacity = 1;
                    }, 200);

                    thumbnails.forEach(i => i.classList.remove("active"));
                    this.classList.add("active");
                });
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const productSection = document.querySelector(".detail-product");
            if (productSection) {
                productSection.scrollIntoView({
                    behavior: "smooth"
                });
            }
        });
    </script>

    <?php include("inc/bottom.php"); ?>