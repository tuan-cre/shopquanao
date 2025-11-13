<?php include("inc/top.php"); ?>
<div class="detail-product px-lg-5">
    <div class="d-flex flex-md-row flex-column mb-5">
        <div class="product-image me-4">
            <img id="main-img" src="../images/products/dieu_tra_chi_tiet.jpg" alt="Áo nỉ màu xám" />
            <div class="img-more d-flex justify-content-between mt-3">
                <img class="img-item" src="../images/products/helmet.jpg" alt="Áo nỉ màu xám" />
                <img class="img-item" src="../images/products/dieu_tra_chi_tiet.jpg" alt="Áo sơ mi trắng" />
                <img class="img-item" src="../images/products/helmet2.jpg" alt="Quần jean xanh" />
                <img class="img-item" src="../images/products/dieu_tra_chi_tiet.jpg" alt="Váy hoa nhí" />
            </div>
        </div>
        <div class="product-description">
            <div class="detail">
                <h4>Tên thể loại</h4>
                <h2 class="fw-bold">Tên sản phẩm </h2>
                <h3>Giá bán: 100000VND</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Pariatur aliquam consequuntur facere praesentium dolore eligendi ipsum quasi.
                    Possimus ipsum mollitia perspiciatis maiores ad accusantium aperiam incidunt impedit
                    minima? Molestiae, amet?
                </p>
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
            <span> Thể loại: <a href="" class="text-decoration-none">Quần áo</a></span><br />
        </div>
    </div>
    <div class="product-detail-tab mt-5">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#menu1">Mô tả sản phẩm</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#menu2">Thông số</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#menu3">Đánh giá</a>
            </li>
        </ul>
        <div class="tab-content p-3 border border-top-0">
            <div id="menu1" class="container tab-pane active"><br>
                <h4>Mô tả sản phẩm</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Pariatur aliquam consequuntur facere praesentium dolore eligendi ipsum quasi.
                    Possimus ipsum mollitia perspiciatis maiores ad accusantium aperiam incidunt impedit
                    minima? Molestiae, amet?
                </p>
            </div>
            <div id="menu2" class="container tab-pane "><br>
                <h4>Thông số kỹ thuật</h4>
                <ul class="list-unstyled">
                    <li>Chất liệu: Cotton</li>
                    <li>Màu sắc: Xám</li>
                    <li>Kích cỡ: S, M, L, XL</li>
                </ul>
            </div>
            <div id="menu3" class="container tab-pane "><br>
                <h4>Đánh giá</h4>
                <p>Chưa có đánh giá nào</p>
            </div>
        </div>
    </div>
    <div class="related-products mt-5">
        <h3 class="mb-4">Sản phẩm liên quan</h3>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <div class="col">
                <div class="card h-100">
                    <img src="../images/products/ao_so_mi_trang.jpg" class="card-img-top" alt="Áo sơ mi trắng">
                    <div class="card-body">
                        <h5 class="card-title">Áo sơ mi trắng</h5>
                        <p class="card-text text-danger fw-bold">150000 VND</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="../images/products/an_may.jpg" class="card-img-top" alt="Áo sơ mi trắng">
                    <div class="card-body">
                        <h5 class="card-title">Áo sơ mi trắng</h5>
                        <p class="card-text text-danger fw-bold">150000 VND</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="../images/products/an_may.jpg" class="card-img-top" alt="Áo sơ mi trắng">
                    <div class="card-body">
                        <h5 class="card-title">Áo sơ mi trắng</h5>
                        <p class="card-text text-danger fw-bold">150000 VND</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="#" class="card-img-top" alt="Áo sơ mi trắng">
                    <div class="card-body">
                        <h5 class="card-title">Áo sơ mi trắng</h5>
                        <p class="card-text text-danger fw-bold">150000 VND</p>
                    </div>
                </div>
            </div>
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