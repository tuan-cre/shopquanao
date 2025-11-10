<?php include("inc/top.php"); ?>
    
  <div class="row">
    <div class="col-sm-9">  
      <h3 class="text-info">
        <?= $mhct['tenmathang'] ?>
      </h3>
      <div>
        <img src="../<?= $mhct['hinhanh'] ?>" alt="<?= $mhct['tenmathang'] ?>" />
      </div>
      <div>
        <h4 class="text-primary">Giá bán: 
          <span class="text-danger"><?= $mhct['giaban'] ?> đ</span>
        </h4>
        <form method="post" class="form-inline">
          <input type="hidden" name="action" value="chovaogio">
          <input type="hidden" name="id" value="<?= $mhct['id'] ?>">
          <div class="row">
            <div class="col">
              <input type="number" class="form-control" name="soluong" value="1">
            </div>
            <div class="col">
              <input type="submit" class="btn btn-primary" value="Chọn mua">
            </div>
          </div>		
        </form>  	  
  	  </div>

      <div>
        <h4 class="text-primary">Mô tả sản phẩm: </h4>
        <p><?= $mhct['mota'] ?></p>
      </div>

      <br>
    </div>

    <div class="col-sm-3"> 
      <h3 class="text-warning">Cùng danh mục:</h3>
      <div style="height: 300px">
        <marquee direction="up" onmouseover="stop()" onmouseout="start()">
        <?php
            foreach($mathang as $mh): 
                if($mh['id'] != $mhct['id']): ?>
                    <div>
                        <div class="col mb-5">
                            <div class="card h-100 shadow">
                                <!-- Sale badge-->
                                <?php if($mh['giaban'] != $mh['giagoc']) {?>            
                                    <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Giảm giá</div>
                                <?php } ?>
                                <!-- Product image-->
                                <a href="?action=detail&id=<?= $mh['id'] ?>">
                                    <img class="card-img-top" src="../<?= $mh['hinhanh'] ?>" alt="<?= $mh['tenmathang'] ?>" />
                                </a>
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <a class="text-decoration-none" href="?action=detail&id=<?=$mh['id']; ?>"><h5 class="fw-bolder text-info"><?php echo $mh['tenmathang'] ?></h5></a>
                                        <!-- Product reviews-->
                                        <div class="d-flex justify-content-center small text-warning mb-2">
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                        </div>
                                        <!-- Product price-->
                                        <?php if($mh['giaban'] != $mh['giagoc']) {?>
                                            <span class="text-muted text-decoration-line-through"><?php echo $mh['giagoc'] ?>đ</span>
                                        <?php } ?>
                                        <span class="text-danger fw-bolder"><?php echo $mh['giaban'] ?>đ</span>
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-info mt-auto" href="#">Chọn mua</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>            
        </marquee>
      </div>
    </div>    
  </div>
  


<?php include("inc/bottom.php"); ?>