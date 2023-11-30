    <?php if (!isset($_SESSION['udone'])) { ?>
        <div class="bg-dndk hide-bg-dndk">
            <div class="dndk">
                <h2 class="text-center">Đăng Nhập</h2>
                <form action="<?php echo urlmd; ?>/login/" method="POST" enctype="multipart/form-data">
                    <div class="field-add">
                        <label>Tài Khoản :</label>
                        <input type="text" name="user">
                    </div>
                    <div class="field-add">
                        <label>Mật Khẩu :</label>
                        <input type="password" name="pass">
                    </div>
                    <div class="field-add"><a href="<?php echo urlmd ?>/quenmk/" class="a-quenmk">Quên mật khẩu ?</a></div>
                    <div class="field-add">
                        <button class="btn btn-success" type="submit">Đăng Nhập</button>
                    </div>
                </form><hr>
                <div class="field-add">
                    <button class="btn btn-info users2">Hoặc Đăng Ký</button>
                </div>
                <div class="field-add" style="margin:0;">
                    <button class="btn btn-danger quaylai-dndk">Quay Lại</button>
                </div>
            </div>
        </div>
        <div class="bg-dndk2 hide-bg-dndk2">
            <div class="dndk2">
                <h2 class="text-center">Đăng Ký</h2>
                <form action="<?php echo urlmd; ?>/regis/" method="POST" enctype="multipart/form-data">
                    <div class="field-add">
                        <label>Tài Khoản :</label>
                        <input type="text" name="user">
                    </div>
                    <div class="db-field-add">
                        <div class="field-add">
                            <label>Họ :</label>
                            <input type="text" name="ho">
                        </div>
                        <div class="field-add">
                            <label>Tên :</label>
                            <input type="text" name="ten">
                        </div>        
                    </div>
                    <div class="db-field-add">
                        <div class="field-add">
                            <label>Email :</label>
                            <input type="text" name="email">
                        </div>
                        <div class="field-add">
                            <label>Số điện thoại :</label>
                            <input type="number" name="sdt">
                        </div>        
                    </div>
                    <div class="field-add">
                        <label>Địa chỉ :</label>
                        <input type="text" name="diachi">
                    </div>
                    <div class="field-add">
                        <label>Mật Khẩu :</label>
                        <input type="password" name="pass1">
                    </div>
                    <div class="field-add">
                        <label>Nhập Lại Mật Khẩu :</label>
                        <input type="password" name="pass2">
                    </div>
                    <div class="field-add">
                        <button class="btn btn-success" type="submit">Đăng Ký</button>
                    </div>
                </form><hr>
                <div class="field-add" style="margin:0;">
                    <button class="btn btn-danger quaylai-dndk2">Quay Lại</button>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if(isset($_SESSION['dndk_err'])) { ?>
        <div class="bg-dndk-err">
            <div class="dndk-err">
                <span><?php echo $_SESSION['dndk_err'] ?></span><hr>
                <button class="btn btn-danger quaylai-dndk">Quay Lại</button>
            </div>
        </div>
    <?php } unset($_SESSION['dndk_err']); ?>
    <?php if(isset($_SESSION['udone2'])) { ?>
        <div class="bg-dndk-err">
            <div class="dndk-err">
                <span><?php echo $_SESSION['udone2'] ?></span><hr>
                <button class="btn btn-danger quaylai-dndk">Quay Lại</button>
            </div>
        </div>
    <?php } unset($_SESSION['udone2']);; ?>

    <?php if (isset($_SESSION['udone'])) { ?>
        <div class="bg-dmk hide-bg-dmk">
            <div class="dmk">
                <h2 class="text-center">Đổi Mật Khẩu</h2>
                <form action="<?php echo urlmd; ?>/doimatkhau/" method="POST" enctype="multipart/form-data">
                    <input type="text" value="<?php echo $header['nguoidung'][0]['id'] ?>" hidden name="id">
                    <div class="field-add">
                        <label>Mật khẩu mới :</label>
                        <input type="password" name="pass1">
                    </div>
                    <div class="field-add">
                        <label>Nhập lại mật khẩu mới :</label>
                        <input type="password" name="pass2">
                    </div>
                    <div class="field-add">
                        <button class="btn btn-success" type="submit">Đổi Mật Khẩu</button>
                    </div>
                </form><hr>
                <div class="field-add" style="margin:0;">
                    <button class="btn btn-danger quaylai-dmk">Quay Lại</button>
                </div>
            </div>
        </div>
    <?php } ?>
    
    <div class="ttgh ttgh-hide">
        <div>
            <i class="fa-solid fa-circle-check"></i>
            <h2>Đã thêm vào giỏ hàng</h2>
        </div>
    </div>