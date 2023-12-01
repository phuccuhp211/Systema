    <div class="full-menu">
        <nav class="navbar navbar-expand-md menu-chinh">
            <div class="container" style="display: unset;">
                <div class="row">
                    <div class="col-3">
                        <a href="<?php echo urlmd ?>/" class="navbar-brand menu-logo-chinh"><img src="<?php echo urlv ?>/data/LOGO2.png" alt=""></a>
                        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#menu-top">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <div class="col-6">
                        <form action="<?php echo urlmd; ?>/sanpham/timkiem/" method="POST" enctype="multipart/form-data" class="form-inline menu-khungtk">
                            <input class="form-control" name="tksp" type="text" placeholder="Tìm Kiếm...">
                            <button type="submit" class="btn btn-success menu-nuttk"><i class="fa fa-search"></i></button>
                        </form> 
                    </div>
                    <div class="col-3">
                        <ul class="navbar-nav menu-ghdndk">
                            <li class="nav-item">
                                <a href="<?php echo urlmd; ?>/giohang/" class="nav-link menu-chinh-li giohang">
                                    <i class="fa fa-shopping-cart"></i> Giỏ Hàng
                                </a>
                            </li>
                            <?php if (!isset($_SESSION['udone'])) { ?>
                                <li class="nav-item">
                                    <button class="nav-link menu-chinh-li users">
                                        <i class="fas fa-user icon_setting"></i> Đăng Nhập
                                    </button>
                                </li>
                            <?php } ?>                
                        </ul>
                    </div>
                </div>
            </div>
            <?php if (isset($_SESSION['udone'])) { ?>
                <span class="span-popup">Xin chào <strong>
                    <?php echo $header['nguoidung'][0]['ho']." ".$header['nguoidung'][0]['ten'] ?></strong>,
                    <a href="<?php echo urlmd; ?>/config/" class="fa-solid fa-gear"></a> | 
                    <a href="<?php echo urlmd; ?>/logout/" class="fa-solid fa-right-from-bracket"></a>
                </span>
                <span hidden id="uho"><?php echo $header['nguoidung'][0]['ho'] ?></span>
                <span hidden id="uten"><?php echo $header['nguoidung'][0]['ten'] ?></span>
                <span hidden id="uid"><?php echo $header['nguoidung'][0]['id'] ?></span>
            <?php } ?>    
        </nav>
        <div class="menu-thucap">
            <nav class="navbar second-menu">
                <div class="container" style="display: unset;">
                    <div class="row">
                        <div class="col-12">
                            <div class="menu-chinh-li" id="show-dmsp">Danh Mục Sản Phẩm <i class="fa-solid fa-bars" style="font-size: 22px;"></i></div>
                            <a class="menu-chinh-li" href="<?php echo urlmd.'/baohanh/'?>">Bảo Hành</a>
                            <a class="menu-chinh-li" href="<?php echo urlmd.'/vanchuyen/'?>">Vận Chuyển</a>
                            <a class="menu-chinh-li" href="<?php echo urlmd.'/lienhe/'?>">Liên Hệ</a>
                            <a class="menu-chinh-li" href="<?php echo urlmd.'/hotro/'?>">Hỗ Trợ</a>
                            <a class="menu-chinh-li" href="<?php echo urlmd.'/ktbh/'?>">Tra Cứu Hóa Đơn</a>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="container">
                <div class="row" style="position: relative;">
                    <div class="col-12">
                        <div class="menu-cap2">
                            <li class="li-mnmn"><a href="<?php echo urlmd ?>/sanpham/tatca/" class="a-mnc2">Tất cả sản phẩm</a></li>
                            <?php foreach ($header['phanloai'] as $value => $item) { ?>
                                <div class="thirt-menu">
                                    <li class="li-mnmn"><hr>
                                        <a href="<?php echo urlmd.'/sanpham/phanloai='.$item['id'].'/' ?>" class="a-mnc2">
                                            <?php echo ucwords($item['name']) ?> 
                                        </a>
                                    </li>
                                    <?php foreach ($header['danhmuc'] as $value2 => $item2) { ?>
                                        <?php if ($item['id'] == $item2['loai']) {?>
                                            <div class="menu-cap3">
                                                <?php foreach ($header['danhmuc'] as $value3 => $item3) {
                                                    if ($item['id'] == $item3['loai']) { ?>
                                                        <li class="li-mnmn">
                                                            <a href="<?php echo urlmd.'/sanpham/danhmuc='.$item3['id'].'/' ?>" class="a-mnc3">
                                                                <?php echo strtoupper($item3['name']); ?>
                                                            </a><hr>
                                                        </li>
                                                    <?php }
                                                } ?> 
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>