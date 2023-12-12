<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'include/lib.php' ?>
	<title><?php echo $chitiet[0]['name'] ?></title>
	<link rel="stylesheet" href="<?php echo urlv ?>css/chitietsanpham.css">
	<script style="text/javascript" src="<?php echo urlv ?>jquery/chitietsanpham.js"></script>
</head>
<body> 
	<?php include 'include/header.php' ?>
    <?php include 'include/modal.php' ?>

    <!-- san pham -->
    <div class="sp-tt" id="sp-tt">
        <div class="container">
            <div class="row phan-tt-tren">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="khunganh-sp">
                        <img src="<?php echo $chitiet[0]['img'] ?>" class="anh-sp" alt="">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="khungtt-sp">
                        <h2 class="ten-sp"><?php echo $chitiet[0]['name'] ?></h2>
                        <ul class="tt-sp">
                            <li>Bảo hành: 36 Tháng</li>
                            <li>Xuất xứ: Chính hãng</li>
                            <li>Thương hiệu: <?php echo $thuonghieu[0]['name'] ?></li>
                        </ul>
                        <span class="mieuta-sp">Đã Bán : <?php echo $chitiet[0]['saled'] ?></span><br>
                        <span class="mieuta-sp"><?php echo $chitiet[0]['detail'] ?></span>
                        <div class="gia-mua-sp">
                            <?php 
                            if ($chitiet[0]['price_sale'] == 0) echo "<h2 class=\"gia-sp\">Giá : ".number_format($chitiet[0]['price'],0,'','.')."</h2>";
                            else echo "<h2 class=\"gia-sp\">Giá : ".number_format($chitiet[0]['price_sale'],0,'','.')."</h2>";
                            ?>
                            <div style="margin: 15px 0;">
                                <label for="">Số Lượng : </label><input type="number" min="1" value="1" class="ctsp-sl">
                            </div>
                            <a href="#" data-idsp="<?php echo $chitiet[0]['id'] ?>" class="nut-muasp buy">Mua Ngay</a>
                            <button class="nut-muasp add addcart" id="uidsp" style="margin: 15px 0 0;" data-idsp="<?php echo $chitiet[0]['id'] ?>">Thêm Giỏ Hàng</button>
                        </div>
                    </div>  
                </div>
            </div>
            <?php if (isset($chitiet[0]['mdetail']) && $chitiet[0]['mdetail'] != '') { ?>
                <div class="row phan-tt-duoi">
                    <div class="col-12 khungttct-sp">
                        <h2>THÔNG TIN CHI TIẾT</h2>
                        <div class="ttct-sp">
                            <?php echo htmlspecialchars_decode($chitiet[0]['mdetail']) ?>
                            <button class="more-less">Xem thêm</button>                         
                        </div>      
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- binh luan -->

    <div class="binhluan">
        <div class="container"><hr>
            <div class="row">
                <div class="col-12">
                    <div class="title-cmt">
                        <h4>ĐÁNH GIÁ SẢN PHẨM</h3>
                    </div>
                </div>
                <?php if (!isset($_SESSION['udone'])) { ?>
                    <div class="col-8 text-center">
                        
                            <button class="ycdn-cmt">Vui lòng đăng nhập để Bình luận & Đánh giá</button>
                        
                    </div>
                <?php } else { ?>
                    <div class="col-8">
                        <form class="send-cmt">
                            <textarea id="noidung-cmt"></textarea>
                            <button type="submit">Gửi</button>
                        </form>
                    </div>
                <?php } ?>
                <div class="col-4">
                    <div class="box-stars">
                        <?php if(isset($button_rt)) echo $button_rt ?>
                        <?php if(isset($sps)) echo $sps ?>
                    </div>
                </div>                    
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="list-cmt">
                        <?php if (isset($dscmt)) { foreach ($dscmt as $value => $item) { ?>
                            <div class="box-cmt">
                                <div class="row" style="margin:0;">
                                    <div class="avatar">
                                        <?php if ($item['avt'] != "") { ?>
                                            <div class="avt-img">
                                                <img src="" alt="">
                                            </div>
                                        <?php } else { ?>
                                            <h5 class="avt-text"><?php echo substr($item['ten'], 0, 1) ?></h5>
                                        <?php } ?>
                                    </div>
                                    <div class="user-cmt">
                                        <p class="uname-cmt"><?php echo $item['ho']." ".$item['ten'] ?></p>
                                        <p class="date-cmt"><?php echo date("d-m-Y", strtotime($item['date'])) ?></p>
                                    </div>
                                </div>
                                <div class="content-cmt">
                                    <p><?php echo $item['noidung'] ?></p>
                                </div>
                            </div><hr>
                        <?php }} ?>
                    </div>
                </div>  
            </div><hr>
        </div>
    </div>

    <!-- san pham lquan -->
    <div class="pad_1">
        <div class="container">
            <h2 class="tieude">SẢN PHẨM LIÊN QUAN</h2>
            <div class="row" id="list-sanpham">
                <?php if (isset($splq)) {
                echo showsp($splq); } ?>
            </div>              
        </div>
    </div>

    <?php include 'include/footer.php' ?>
</body>
</html>