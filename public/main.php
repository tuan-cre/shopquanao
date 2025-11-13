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

<?php foreach($danhmuc as $dm): 
    $i = 0;  ?>

    <h3>
        <a class="text-decoration-none" href="?action=group&id=<?= $dm['MaDM']; ?>"><?= $dm['TenDanhMuc']; ?></a>
    </h3>

    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        <?php foreach($mathang as $mh_item): 
            if($i < 4 && $mh_item['MaDM'] == $dm['MaDM']) {
                $i++;  ?>    
                <div class="col mb-5">
                    <div class="card h-100 shadow-sm">
                        <!-- Sale badge-->
                        <?php 
                            if($mh_item['GiaBan'] != $mh_item['GiaGoc']) {?>                
                            <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Giảm giá</div>
                        <?php } ?>
                            <!-- Product image-->
                        <a href="?action=detail&id=<?php echo $mh_item['MaSP'] ?>">
                            <img class="card-img-top" src="../<?php echo $mh_item['HinhAnh'];?>" alt="<?php echo $mh_item['TenSP'];?>" />
                        </a>
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <a class="text-decoration-none" href="?action=detail&id=<?= $mh_item['MaSP']; ?>">
                                    <h5 class="fw-bolder card-title"><?= $mh_item['TenSP']; ?></h5>
                                </a>                    
                                <!-- Product reviews-->
                                <div class="d-flex justify-content-center small text-warning mb-2">
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                </div>
                                <!-- Product price-->
                                <?php 
                                    if($mh_item['GiaBan'] != $mh_item['GiaGoc']) {?>
                                        <span class="text-muted text-decoration-line-through"><?= number_format($mh_item['GiaGoc']) ; ?> đ</span>
                                    <?php } ?>
                                    <span class="text-danger fw-bolder card-text"><?= number_format($mh_item['GiaBan'])?> đ</span>                                 
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent text-center">
                            <a class="btn btn-outline-dark-custom mt-auto" href="#">Chọn mua</a>
                        </div>
                    </div>
                </div>        
            <?php } ?>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>

<ul class="pagination justify-content-center" style="margin:20px 0">
    <li class="page-item"><a class="page-link" href="#"><i class="bi bi-caret-left-fill"></i></a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#"><i class="bi bi-caret-right-fill"></i></a></li>
</ul>

<?php
    include("inc/bottom.php");
?>
