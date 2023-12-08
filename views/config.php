<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'include/lib.php' ?>
	<title>Quản Lý Tài Khoản</title>
	<link rel="stylesheet" href="<?php echo urlv ?>css/config.css">
	<script style="text/javascript" src="<?php echo urlv ?>jquery/config.js"></script>
</head>
<body>
	<?php include 'include/header.php' ?>
    <?php include 'include/modal.php' ?>

    <div class="container">
        <h2>Quản Lý Tài Khoản</h2>
        <div class="row">
            <div class="col-12 position-relative">
                <button class="btn-config cf-acc btn-hidden">&#8592; Thiết Lập Tài Khoản</button>
                <button class="btn-config his-mh" style="float: right;">Lịch Sử Mua Hàng &#8594;</button>
            </div>
        </div>
        <hr>
    </div>
    
    <div class="container">
        <div class="cf-slide">
            <div class="cf-trans box-qltk">
                <div class="row">
                    <div class="col-12 text-center">
                        <?php if ($header['nguoidung'][0]['avt'] != "") { ?><img class="user-avt" src="<?php echo $header['nguoidung'][0]['avt'] ?>" alt=""><?php } else { ?>
                        <img class="user-avt" src="<?php echo urlv.'data/avatar.png' ?>" alt=""> <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div hidden class="cf-id"><?php echo $header['nguoidung'][0]['id'] ?></div>
                    <div hidden class="cf-ho"><?php echo $header['nguoidung'][0]['ho'] ?></div>
                    <div hidden class="cf-ten"><?php echo $header['nguoidung'][0]['ten'] ?></div>
                    <div hidden class="cf-sdt"><?php echo $header['nguoidung'][0]['sdt'] ?></div>
                    <div hidden class="cf-mail"><?php echo $header['nguoidung'][0]['email'] ?></div>
                    <div hidden class="cf-dc"><?php echo $header['nguoidung'][0]['diachi'] ?></div>
                    <?php if (isset($_SESSION['update_popup'])) { ?>
                        <h5 class="popup"><?php echo $_SESSION['update_popup'] ?></h5>
                    <?php } unset($_SESSION['update_popup']); ?>
                    <?php if (isset($_SESSION['dmk-popup'])) { ?>
                        <h5 class="errpopup popup"><?php echo $_SESSION['dmk-popup'] ?></h5>
                    <?php } unset($_SESSION['dmk-popup']); ?>
                    <div style="margin: 30px 0 15px;">
                        <div style="display: flex;background: #e0e0e0;padding: 30px 15px;border-radius: 10px;">
                            <div class="col-6">
                                <div class="box-cf">
                                    <label for="config_user">Tên Tài Khoản :</label>
                                    <input type="text" class="config_all config_user" disabled value="<?php echo $header['nguoidung'][0]['user'] ?>">
                                </div>
                                <div class="box-cf">
                                    <label for="config_ho">Họ</label>
                                    <input type="text" class="config_all config_ho" value="<?php echo $header['nguoidung'][0]['ho'] ?>">
                                </div>
                                <div class="box-cf">
                                    <label for="config_ten">Tên </label>
                                    <input type="text" class="config_all config_ten" value="<?php echo $header['nguoidung'][0]['ten'] ?>">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="box-cf">
                                    <label for="config_sdt">Số Điện Thoại :</label>
                                    <input type="number" class="config_all config_sdt" value="<?php echo $header['nguoidung'][0]['sdt'] ?>">
                                </div>
                                <div class="box-cf">
                                    <label for="config_mail">Email :</label>
                                    <input type="text" class="config_all config_mail" value="<?php echo $header['nguoidung'][0]['email'] ?>">
                                </div>
                                <div class="box-cf">
                                    <label for="config_diachi">Địa Chỉ :</label>
                                    <input type="text" class="config_all config_diachi" value="<?php echo $header['nguoidung'][0]['diachi'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin: 0 0 50px;">
                    <div class="offset-4 col-4">
                        <button class="btn btn-primary cf-button cf-dmk">Đổi Mật Khẩu</button>
                    </div>
                    <div class="offset-4 col-4">
                        <button class="btn btn-success cf-button cf-update disabled">Cập Nhật</button>
                    </div>
                </div>
            </div>
            <div class="cf-trans box-lsmh">
                <div class="row">
                    <div class="col-12">    
                            <?php 
                                if (!isset($list_hd[0])) echo "<tr><th colspan=\"5\">Không có hóa đơn mua hàng</th></tr>"; 
                                else {
                                    foreach ($list_hd as $value => $item) { 
                                        $dssp = json_decode($item['dssp'],true);
                                        $tc = number_format($item['thanhtien'],0,'','.');
                                    ?>
                                        <table class="mb-5">
                                            <tr>
                                                <th style="width: 17.5%;">Mã Hóa Đơn</th>
                                                <th style="width: 17.5%;">Ngày Lập Hóa Đơn</th>
                                                <th style="width: 17.5%;">Ngày Xác Nhận</th>
                                                <th style="width: 32.5%;">Tổng Tiền</th>
                                                <th style="width: 15%;">Trạng Thái</th>
                                            </tr>
                                            <tr>
                                                <td class="text-center"><?php echo $item['SHD']; ?></td>
                                                <td class="text-center"><?php echo $item['created']; ?></td>
                                                <td class="text-center"><?php echo $item['submited']; ?></td>
                                                <td class="text-center" style="color: red;"><?php 
                                                    if ($item['thanhtien2'] != 0 ) echo "<span style=\"text-decoration: line-through; margin: 0 15px; color: gray;\">".number_format($item['thanhtien']+20000,0,",",".")."</span>".number_format($item['thanhtien2'],0,",",".");
                                                    else echo number_format($item['thanhtien']+20000,0,",",".");
                                                ?></td>
                                                <td class="text-center"><?php echo $item['trangthai']; ?></td>
                                            </tr>
                                            <tr class="h-list-sp">
                                                <td colspan="5">Danh Sách Sản Phẩm</td>
                                            </tr>
                                            <tr class="h-list-sp">
                                                <td colspan="2">Tên Sản Phẩm</td>
                                                <td>Đơn Giá</td>
                                                <td>Số Lượng</td>
                                                <td>Thành Tiền</td>
                                            </tr>
                                            <?php foreach ($dssp as $value2 => $item2) { ?>
                                                <tr class="list-sp">
                                                    <td colspan="2"><?php echo $item2['name'] ?></td>
                                                    <td>
                                                        <?php 
                                                            if ($item2['price_sale'] != 0) echo number_format($item2['price_sale'],0,'','.');
                                                            else echo number_format($item2['price'],0,'','.')
                                                        ?>
                                                    </td>
                                                    <td><?php echo $item2['soluong'] ?></td>
                                                    <td style="color: red;"><?php echo number_format($item2['thanhtien'],0,'','.') ?></td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                    <?php }
                                }
                            ?>      
                    </div>
                </div>
            </div>
        </div>
    </div>
        

    <?php include 'include/footer.php' ?>
</body>
</html>