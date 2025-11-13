<?php
    include("inc/top.php");
?>
<a class="btn btn-info" href="detail.php">Xem chi tiết</a>

<?php foreach($danhmuc as $dm): 
    $i = 0;  ?>

    <h3>
        <a class="text-decoration-none text-info" href="?action=group&id=<?= $dm['MaDM']; ?>"><?= $dm['TenDM']; ?></a>
    </h3>

    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        <?php foreach($mathang as $m): 
            if($i < 4 && $m['MaDM'] == $dm['MaDM']) {
                $i++;  ?>    
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Sale badge-->
                        <?php 
                            if($m['GiaBan'] != $m['GiaGoc']) {?>                
                            <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Giảm giá</div>
                        <?php } ?>
                            <!-- Product image-->
                        <a href="?action=detail&id=<?php echo $m['MaSP'] ?>">
                            <img class="card-img-top" src="../<?php echo $m['HinhAnh'];?>" alt="<?php echo $m['TenSP'];?>" />
                        </a>
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <a class="text-decoration-none" href="?action=detail&id=<?= $m['MaSP'];?>">
                                    <h5 class="fw-bolder text-info"><?= $m['TenSP']; ?></h5>
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
                                    if($m['GiaBan'] != $m['GiaGoc']) {?>
                                        <span class="text-muted text-decoration-line-through"><?= number_format($m['GiaGoc']); ?> đ</span>
                                    <?php } ?>
                                    <span class="text-danger fw-bolder"><?= number_format($m['GiaBan']); ?> đ</span>                                 
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-info mt-auto" href="index.php?action=chovaogio&id=<?php echo $m['MaSP']; ?>">Chọn mua</a></div>
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
