	<?php if (isset($_SESSION['qlsp'])) { ?>
		<div class="bg-add hide-bg-add">
			<div class="addsp">
				<form action="<?php echo urlmd ?>/addpro/" method="POST" enctype="multipart/form-data">
					<div class="field-add">
						<label>Tên Sản Phẩm :</label>
						<input type="text" name="name">
					</div>
					<div class="db-field-add">
						<div class="field-add">
							<label>Giá Sản Phẩm :</label>
							<input type="number" name="price">
						</div>
						<div class="field-add">
							<label>Giá Sale (nếu có) :</label>
							<input type="number" name="sale">
						</div>
					</div>
					<div class="db-field-add">
						<div class="field-add">
							<label>Sale từ ngày (nếu có) :</label>
							<input type="date" name="salef">
						</div>
						<div class="field-add">
							<label>Sale đến ngày (nếu có) :</label>
							<input type="date" name="salet">
						</div>
					</div>
					<div class="db-field-add">
						<div class="field-add">
							<label>Danh Mục :</label>
							<select name="catalog" id="">
								<option value=""></option>
								<?php foreach ($danhmuc as $value => $item) { ?>
									<option value="<?php echo $item['id'] ?>"><?php echo $item['name'] ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="field-add">
							<label>Thương Hiệu :</label>
							<select name="brand" id="">
								<option value=""></option>
								<?php foreach ($brand as $value => $item) { ?>
									<option value="<?php echo $item['id_brand'] ?>"><?php echo $item['name'] ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="field-add">
						<label>Mô tả :</label>
						<input type="text" name="info">
					</div>
					<div class="field-add">
						<label>Thông tin chi tiết :</label>
						<textarea name="detail" id="ttct-sp"></textarea>
					</div>
					<div class="field-add">
						<label style="width:auto; margin: 0 30px 0 0;">Hình ảnh :</label>
						<input type="file" name="img">
					</div>
					<div class="field-add">
						<button class="btn btn-success" type="submit">Thêm Sản Phẩm</button>
					</div>
				</form>
				<div class="field-add" style="margin:0;">
					<button class="btn btn-danger quaylai">Quay Lại</button>
				</div>
			</div>
		</div>
		<div class="bg-fix hide-bg-fix">
			<div class="addsp">
				<form action="" method="POST" enctype="multipart/form-data" id="form_fix_pro">
					<div class="field-add">
						<label>Tên Sản Phẩm :</label>
						<input type="text" name="name" id="fix_name_sp">
					</div>
					<div class="db-field-add">
						<div class="field-add">
							<label>Giá Sản Phẩm :</label>
							<input type="number" name="price" id="fix_price_sp">
						</div>
						<div class="field-add">
							<label>Giá Sale (nếu có) :</label>
							<input type="number" name="sale" id="fix_sale_sp">
						</div>
					</div>
					<div class="db-field-add">
						<div class="field-add">
							<label>Sale từ ngày (nếu có) :</label>
							<input type="date" name="salef" id="fix_salef_sp">
						</div>
						<div class="field-add">
							<label>Sale đến ngày (nếu có) :</label>
							<input type="date" name="salet" id="fix_salet_sp">
						</div>
					</div>
					<div class="db-field-add">
						<div class="field-add">
							<label>Danh Mục :</label>
							<select name="catalog" id="">
								<option value="" id="fix_catalog_sp"></option>
								<?php foreach ($danhmuc as $value => $item) { ?>
									<option value="<?php echo $item['id'] ?>"><?php echo $item['name'] ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="field-add">
							<label>Thương Hiệu :</label>
							<select name="brand" id="">
								<option value="" id="fix_brand_sp"></option>
								<?php foreach ($brand as $value => $item) { ?>
									<option value="<?php echo $item['id_brand'] ?>"><?php echo $item['name'] ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="field-add">
						<label>Mô tả :</label>
						<input type="text" id="fix_info_sp" name="info">
					</div>
					<div class="field-add">
						<label>Thông tin chi tiết :</label>
						<textarea name="detail" id="ttct-sp"></textarea>
					</div>
					<div class="field-add">
						<label style="width:auto; margin: 0 30px 0 0;">Hình ảnh ( không chọn nếu sử dụng ảnh cũ ) :</label>
						<input type="file" name="img">
						<input type="text" name="old_img" id="fix_img_sp" hidden>
					</div>
					<div class="field-add">
						<button class="btn btn-success" type="submit">Cập Nhật Sản Phẩm</button>
					</div>
				</form>
				<div class="field-add" style="margin:0;">
					<button class="btn btn-danger quaylai">Quay Lại</button>
				</div>
			</div>
		</div>
		<div class="bg-del hide-bg-del">
			<div class="addsp">
				<div class="field-add">
					<h4 class="text-center">Bạn có chắc muốn xóa sản phẩm ?</h4 class="text-center">
				</div>
				<div class="field-add">
					<a href="" class="btn btn-success" id="acp-del" type="submit">Xóa</a>
				</div>
				<button class="btn btn-danger quaylai" type="submit">Quay Lại</button>
			</div>
		</div>
		<div class="popup-small hide-popup">
			<i class="fa-solid fa-eye-slash"></i>
			<span>Đã Ẩn Sản Phẩm</span>
		</div>
	<?php } ?>
	<?php if (isset($_SESSION['qldm'])) { ?>
		<div class="bg-add hide-bg-add">
			<div class="addsp">
				<form action="<?php echo urlmd ?>/addcat/" method="POST" enctype="multipart/form-data">
					<h3 class="text-center">Thêm Danh Mục</h3>
					<div class="field-add">
						<label>Tên Danh Mục :</label>
						<input type="text" name="name">
					</div>
					<select name="phanloai" id="pl" style="margin: 0 0 15px;">
						<?php foreach ($phanloai as $value => $item) { ?>
							<option value="<?php echo $item['id'] ?>">Mã : <?php echo $item['id'] ?> | <?php echo $item['name'] ?></option>
						<?php } ?>
					</select>
					<div class="field-add">
						<label style="width:auto; margin: 0 30px 0 0;">Hình ảnh (nếu có) :</label>
						<input type="file" name="img">
					</div>
					<div class="field-add">
						<button class="btn btn-success" type="submit">Thêm Danh Mục</button>
					</div>
				</form><hr>
				<form action="<?php echo urlmd ?>/addpl/" method="POST" enctype="multipart/form-data">
					<h3 class="text-center">Thêm Phân Loại</h3>
					<div class="field-add">
						<label>Tên Phân Loại :</label>
						<input type="text" name="name">
					</div>
					<div class="field-add">
						<button class="btn btn-success" type="submit">Thêm Phân Loại</button>
					</div>
				</form>
				<div class="field-add" style="margin:0;">
					<button class="btn btn-danger quaylai">Quay Lại</button>
				</div>
			</div>
		</div>
		<div class="bg-fix hide-bg-fix">
			<div class="addsp">
				<form action="" method="POST" enctype="multipart/form-data" id="form_fix_cat">
					<h3 class="text-center">Cập Nhật Danh Mục</h3>
					<div class="field-add">
						<label>Tên Danh Mục :</label>
						<input type="text" name="name" id="fix_name_dm">
					</div>
					<select name="phanloai" id="fix_name_pldm" style="margin: 0 0 15px;">
						<?php foreach ($phanloai as $value => $item) { ?>
							<option value="<?php echo $item['id'] ?>">Mã : <?php echo $item['id'] ?> | <?php echo $item['name'] ?></option>
						<?php } ?>
					</select>
					<div class="field-add">
						<label style="width:auto; margin: 0 30px 0 0;">Hình ảnh (nếu có) :</label>
						<input type="file" name="img" id="fix_img_dm">
						<input type="text" name="old_img" id="fix_img_dm" hidden>
					</div>
					<div class="field-add">
						<button class="btn btn-success" type="submit">Cập Nhật Danh Mục</button>
					</div>
				</form><hr>
				<form action="" method="POST" enctype="multipart/form-data" id="form_fix_pl">
					<h3 class="text-center">Cập Nhật Phân Loại</h3>
					<div class="field-add">
						<label>Tên Phân Loại :</label>
						<input type="text" name="name" id="fix_name_pl">
					</div>
					<div class="field-add">
						<button class="btn btn-success" type="submit">Cập Nhật Phân Loại</button>
					</div>
				</form>
				<div class="field-add" style="margin:0;">
					<button class="btn btn-danger quaylai">Quay Lại</button>
				</div>
			</div>
		</div>
		<div class="bg-del hide-bg-del">
			<div class="addsp">
				<div class="field-add">
					<h4 class="text-center">Bạn có chắc muốn xóa danh mục ?</h4 class="text-center">
				</div>
				<div class="field-add">
					<a href="" class="btn btn-success" id="acp-del" type="submit">Xóa</a>
				</div>
				<button class="btn btn-danger quaylai" type="submit">Quay Lại</button>
			</div>
		</div>
	<?php } ?>
	<?php if (isset($_SESSION['qlus'])) { ?>
		<div class="bg-add hide-bg-add">
			<div class="addsp">
				<form action="<?php echo urlmd ?>/addus/" method="POST" enctype="multipart/form-data">
					<div class="field-add">
						<label>Tên Tài Khoản :</label>
						<input type="text" name="name">
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
                            <input type="number" name="phone">
                        </div>        
                    </div>
                    <div class="field-add">
                        <label>Địa chỉ :</label>
                        <input type="text" name="diachi">
                    </div>
					<div class="field-add">
						<label style="width:auto; margin: 0 30px 0 0;">Mật Khẩu :</label>
						<input type="password" name="pass">
					</div>
					<div class="field-add">
						<label style="width:auto; margin: 0 30px 0 0;">Role :</label>
						<select name="role" id="">
							<option value="0">0</option>
							<option value="1">1</option>
						</select>
					</div>
					<div class="field-add">
						<button class="btn btn-success" type="submit">Thêm Người Dùng</button>
					</div>
				</form>
				<div class="field-add" style="margin:0;">
					<button class="btn btn-danger quaylai">Quay Lại</button>
				</div>
			</div>
		</div>
		<div class="bg-fix hide-bg-fix">
			<div class="addsp">
				<form action="" method="POST" enctype="multipart/form-data" id="form_fix_us">
					<div class="field-add">
						<label>Tên Tài Khoản :</label>
						<input type="text" name="name" id="name_fix_us">
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
                            <input type="text" name="email" id="email_fix_us">
                        </div>
                        <div class="field-add">
                            <label>Số điện thoại :</label>
                            <input type="number" name="phone" id="phone_fix_us">
                        </div>        
                    </div>
                    <div class="field-add">
                        <label>Địa chỉ :</label>
                        <input type="text" name="diachi">
                    </div>
					<div class="field-add">
						<label style="width:auto; margin: 0 30px 0 0;">Mật Khẩu :</label>
						<input type="password" name="pass">
					</div>
					<div class="field-add">
						<label style="width:auto; margin: 0 30px 0 0;">Role :</label>
						<select name="role" id="role_fix_us">
							<option value="0">0</option>
							<option value="1">1</option>
						</select>
					</div>
					<div class="field-add">
						<button class="btn btn-success" type="submit">Cập Nhật</button>
					</div>
				</form>
				<div class="field-add" style="margin:0;">
					<button class="btn btn-danger quaylai">Quay Lại</button>
				</div>
			</div>
		</div>
		<div class="bg-del hide-bg-del">
			<div class="addsp">
				<div class="field-add">
					<h4 class="text-center">Bạn có chắc muốn xóa người dùng ?</h4 class="text-center">
				</div>
				<div class="field-add">
					<a href="" class="btn btn-success" id="acp-del" type="submit">Xóa</a>
				</div>
				<button class="btn btn-danger quaylai" type="submit">Quay Lại</button>
			</div>
		</div>
		<div class="popup-small hide-popup">
			<i class="fa-solid fa-ban"></i>
			<span>Đã Khóa Tài Khoản</span>
		</div>
	<?php } ?>
	<?php if (isset($_SESSION['magg'])) { ?>
		<div class="bg-add hide-bg-add">
			<div class="addsp">
				<form action="<?php echo urlmd ?>/addgg/" method="POST" enctype="multipart/form-data">
					<div class="field-add">
						<label>Nhập tên mã :</label>
						<input type="text" name="name">
					</div>
					<div class="field-add">
						<label>Nhập số lượng :</label>
						<input type="number" name="soluong">
					</div>
					<div class="db-field-add">
                        <div class="field-add">
                            <label>Từ ngày :</label>
                            <input type="date" name="fd">
                        </div>
                        <div class="field-add">
                            <label>Đến ngày :</label>
                            <input type="date" name="td">
                        </div>        
                    </div>
                    <div class="field-add">
						<label>Phần trăm giảm (%) :</label>
						<input type="number" name="discount">
					</div>
					<div class="field-add">
						<button class="btn btn-success" type="submit">Thêm MGG</button>
					</div>
				</form>
				<div class="field-add" style="margin:0;">
					<button class="btn btn-danger quaylai">Quay Lại</button>
				</div>
			</div>
		</div>
		<div class="bg-fix hide-bg-fix">
			<div class="addsp">
				<form action="" method="POST" enctype="multipart/form-data" id="form_fix_gg">
					<div class="field-add">
						<label>Nhập tên mã :</label>
						<input type="text" name="name" id="fix_name_gg">
					</div>
					<div class="field-add">
						<label>Nhập số lượng :</label>
						<input type="text" name="soluong" id="soluong" disabled>
					</div>
					<div class="db-field-add">
                        <div class="field-add">
                            <label>Từ ngày :</label>
                            <input type="date" name="fd" id="fix_fd_gg">
                        </div>
                        <div class="field-add">
                            <label>Đến ngày :</label>
                            <input type="date" name="td" id="fix_td_gg">
                        </div>        
                    </div>
                    <div class="field-add">
						<label>Phần trăm giảm (%) :</label>
						<input type="text" name="discount" id="fix_pt_gg">
					</div>
					<div class="field-add">
						<button class="btn btn-success" type="submit">Sửa MGG</button>
					</div>
				</form>
				<div class="field-add" style="margin:0;">
					<button class="btn btn-danger quaylai">Quay Lại</button>
				</div>
			</div>
		</div>
		<div class="bg-del hide-bg-del">
			<div class="addsp">
				<div class="field-add">
					<h4 class="text-center">Bạn có chắc muốn xóa mã này ?</h4 class="text-center">
				</div>
				<div class="field-add">
					<a href="" class="btn btn-success" id="acp-del" type="submit">Xóa</a>
				</div>
				<button class="btn btn-danger quaylai" type="submit">Quay Lại</button>
			</div>
		</div>
	<?php } ?>
	<?php if (isset($_SESSION['qlbl'])) { ?>
		<div class="bg-del hide-bg-del">
			<div class="addsp">
				<div class="field-add">
					<h4 class="text-center">Bạn có chắc muốn xóa bình luận này ?</h4 class="text-center">
				</div>
				<div class="field-add">
					<a href="" class="btn btn-success" id="acp-del" type="submit">Xóa</a>
				</div>
				<button class="btn btn-danger quaylai" type="submit">Quay Lại</button>
			</div>
		</div>
		<div class="bg-inf hide-bg-inf">
			<div class="dsbl">
				<table style="width: 100%; margin: 15px 0 30px;" id="list-bl-start">
					<tr>
						<th style="width: auto;">Nội dung</th>
						<th style="width: 70px;">ID User</th>
						<th style="width: 120px;">Ngày</th>
						<th style="width: 70px;">Xóa</th>
					</tr>
				</table>
				<button class="btn btn-danger qlai" type="submit">Quay Lại</button>
			</div>
		</div>
	<?php } ?>

	<?php if(isset($_SESSION['error_log'])) { ?>
		<div class="bg-err">
			<div class="error">
				<span><?php echo $_SESSION['error_log'] ?></span><hr>
				<button class="btn btn-danger quaylai">Quay Lại</button>
			</div>
		</div>
	<?php } unset($_SESSION['error_log']); ?>