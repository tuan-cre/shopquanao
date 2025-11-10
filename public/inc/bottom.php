            </div>
        </section>
        
        <!-- Top products -->

        <section>            
            <div class="container-fluid">
                <div class="row">                    
                    <div class="col-md-6">
                        <?php include("inc/carousel.php"); ?>    
                    </div>
                    <div class="col-md-6 pt-2">
                    <!-- Nav tabs -->
                      <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" data-bs-toggle="tab" href="#menu1">Nổi bật</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-bs-toggle="tab" href="#menu2">Xem nhiều</a>
                        </li>
                      </ul>

                      <!-- Tab panes -->
                      <div class="tab-content">                        
                        <div id="menu1" class="container tab-pane active"><br>
                          
                          <?php include("inc/topview.php"); ?>
                          
                        </div>
                        <div id="menu2" class="container tab-pane fade"><br>
                          <h3>Sản phẩm xem nhiều</h3>
                          <p>Đang cập nhật...</p>

                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </section> 

        <!-- Footer-->
        <footer class="py-5 bg-dark text-light">
            <div class="text-center mb-4"><a href="#top" class="text-warning"><i class="bi bi-chevron-up" style="font-size: 3rem;"></i></a></div>
            
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <a href="index.php" class="text-decoration-none text-white">
                            <h4>
                                <i class="bi bi-shop"></i>
                                <span class="badge bg-success">A</span><span class="badge bg-danger">B</span><span class="badge bg-warning">C</span> Shop
                            </h4>
                        </a>
                        <p>Cửa hàng văn phòng phẩm uy tín, chất lượng.</p>
                        <p><i class="bi bi-geo-alt-fill"></i> <b>Địa chỉ:</b> 18 Ung Văn Khiêm, P. Đông Xuyên, TP Long Xuyên, An Giang</p>
                        <p><i class="bi bi-telephone-fill"></i> <b>Điện thoại:</b> 076 3841190</p>
                        <p><i class="bi bi-envelope-fill"></i> <b>Email:</b> abc@abc.com</p>
                    </div>
                    <div class="col-md-4">
                        <h5><i class="bi bi-list-ul"></i> DANH MỤC SẢN PHẨM</h5>
                        <div class="list-group list-group-flush">
                            <!-- <?php foreach ($danhmuc as $d): ?>
                                <a class="list-group-item list-group-item-action bg-dark text-light" href="?action=group&id=<?php echo $d["id"]; ?>">
                                    <?php echo $d["tendanhmuc"]; ?>
                                </a>
                            <?php endforeach; ?> -->
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h5><i class="bi bi-headset"></i> DỊCH VỤ KHÁCH HÀNG</h5>
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action bg-dark text-light footer-link">Hướng dẫn mua hàng</a>
                            <a href="#" class="list-group-item list-group-item-action bg-dark text-light footer-link">Câu hỏi thường gặp</a>
                            <a href="#" class="list-group-item list-group-item-action bg-dark text-light footer-link">Liên hệ</a>
							<a href="#" class="list-group-item list-group-item-action bg-dark text-light footer-link">Chính sách bảo hành</a>
                        </div>
                    </div>
                </div>
                <hr class="text-light">
                <p class="m-0 text-center text-white-50">Copyright &copy; ABC Shop 2023</p>
            </div>
        </footer>

    </body>
</html>
