<?php
    include("inc/top.php");
?>

<style>
    .card {
        border-radius: 0.75rem !important; 
        border: 1px solid #9ebdddff !important; 
        background-color: #d2e4f5ff; 
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out, background-color 0.2s ease-in-out; 
    }

    .card:hover {
        transform: scale(1.02); 
        background-color: #ffffffff; 
    }

    .card .card-title, .card .card-text {
        color: #212529 !important; 
    }


    h3 a {
        color: #1a253c !important; 
        transition: text-shadow 0.2s ease-in-out; 
    }


    h3 a:hover {
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); 
    }

 
    .btn-outline-dark-custom {
        color: #212529; /* Chữ màu đen */
        background-color: #f8f9fa; /* Nền trắng */
        border-color: #212529; /* Viền đen */
    }

    .btn-outline-dark-custom:hover {
        color: #f8f9fa; /* Chữ trắng khi hover */
        background-color: #212529; /* Nền đen khi hover */
    }

    .card-img-top {
        border-top-left-radius: 0.75rem; 
        border-top-right-radius: 0.75rem; 
    }

</style>

<?php foreach($danhmuc as $dm): ?>
    <?php
    // Lọc các sản phẩm thuộc danh mục hiện tại
    $products_in_category = array_filter($mathang, function($mh_item) use ($dm) {
        return $mh_item['MaDM'] == $dm['MaDM'];
    });
    $total_products = count($products_in_category);
    $products_slice = array_slice($products_in_category, 0, 4);
    $more_products_slice = array_slice($products_in_category, 4);
    ?>

    <h3>
        <a class="text-decoration-none" href="?action=group&id=<?= $dm['MaDM']; ?>"><?= $dm['TenDanhMuc']; ?></a>
    </h3>

    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        <?php foreach($products_slice as $mh_item): ?>
            <div class="col mb-5">
                    <div class="card h-100 shadow-sm">
                        <?php 
                            if($mh_item['GiaBan'] != $mh_item['GiaGoc']) {?> 
                            <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Giảm giá</div>
                        <?php } ?>
                            <a href="?action=detail&id=<?php echo $mh_item['MaSP'] ?>">
                            <img class="card-img-top" src="../<?php echo $mh_item['HinhAnh'];?>" alt="<?php echo $mh_item['TenSP'];?>" />
                        </a>
                        <div class="card-body p-4">
                            <div class="text-center">
                                <a class="text-decoration-none" href="?action=detail&id=<?= $mh_item['MaSP']; ?>">
                                    <h5 class="fw-bolder card-title"><?= $mh_item['TenSP']; ?></h5>
                                </a> 
                                <div class="d-flex justify-content-center small text-warning mb-2">
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                </div>
                                <?php 
                                    if($mh_item['GiaBan'] != $mh_item['GiaGoc']) {?>
                                        <span class="text-muted text-decoration-line-through"><?= number_format($mh_item['GiaGoc']) ; ?> đ</span>
                                <?php } ?>
                                    <span class="text-danger fw-bolder card-text"><?= number_format($mh_item['GiaBan'])?> đ</span> 
                            </div>
                        </div>
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent text-center">
                            <a class="btn btn-outline-dark-custom mt-auto" href="#">Chọn mua</a>
                        </div>
                    </div>
            </div>
        <?php endforeach; ?>

        <?php if ($total_products > 4): ?>
            <?php foreach($more_products_slice as $mh_item): ?>
                <div class="col mb-5 more-products-item-<?= $dm['MaDM']; ?>" style="display: none;">
                    <div class="card h-100 shadow-sm">
                        <?php if($mh_item['GiaBan'] != $mh_item['GiaGoc']) {?>
                            <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Giảm giá</div>
                        <?php } ?>
                        <a href="?action=detail&id=<?php echo $mh_item['MaSP'] ?>">
                            <img class="card-img-top" src="../<?php echo $mh_item['HinhAnh'];?>" alt="<?php echo $mh_item['TenSP'];?>" />
                        </a>
                        <div class="card-body p-4">
                            <div class="text-center">
                                <a class="text-decoration-none" href="?action=detail&id=<?= $mh_item['MaSP']; ?>">
                                    <h5 class="fw-bolder card-title"><?= $mh_item['TenSP']; ?></h5>
                                </a>
                                <div class="d-flex justify-content-center small text-warning mb-2">
                                    <div class="bi-star-fill"></div><div class="bi-star-fill"></div><div class="bi-star-fill"></div><div class="bi-star-fill"></div><div class="bi-star-fill"></div>
                                </div>
                                <?php if($mh_item['GiaBan'] != $mh_item['GiaGoc']) {?>
                                    <span class="text-muted text-decoration-line-through"><?= number_format($mh_item['GiaGoc']) ; ?> đ</span>
                                <?php } ?>
                                <span class="text-danger fw-bolder card-text"><?= number_format($mh_item['GiaBan'])?> đ</span>
                            </div>
                        </div>
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent text-center">
                            <a class="btn btn-outline-dark-custom mt-auto" href="#">Chọn mua</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php if ($total_products > 4): ?>
        <div class="text-center mb-5">
            <button class="btn btn-outline-primary btn-xem-them" data-target-class="more-products-item-<?= $dm['MaDM']; ?>">
                Xem thêm <i class="bi bi-chevron-down"></i>
            </button>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

<ul class="pagination justify-content-center" style="margin:20px 0">
    <li class="page-item"><a class="page-link" href="#"><i class="bi bi-caret-left-fill"></i></a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#"><i class="bi bi-caret-right-fill"></i></a></li>
</ul>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const seeMoreButtons = document.querySelectorAll('.btn-xem-them');
    seeMoreButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetClass = this.getAttribute('data-target-class'); 
            const moreProducts = document.querySelectorAll(`.${targetClass}`); 
            
            if (moreProducts.length > 0) {
                moreProducts.forEach(product => {
                    product.style.display = 'block'; 
                });
                this.style.display = 'none';
            }
        });
    });
});
</script>

<?php
    include("inc/bottom.php");
?>
