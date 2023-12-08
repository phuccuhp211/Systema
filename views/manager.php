<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'include/lib.php' ?>
	<link rel="stylesheet" href="<?php echo urlv ?>css/admin.css">
	<script style="text/javascript" src="<?php echo urlv ?>jquery/admin.js"></script>
	<script style="text/javascript" src="<?php echo urlv ?>lib/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
	<script style="text/javascript" src="<?php echo urlv ?>lib/js/plotly.min.js" referrerpolicy="origin"></script>
	<title>Trang Quản Trị</title>
</head>
<body style="padding: 0 !important;">
	<div class="container menu">
		<div class="row">
			<div class="col-4"><a class="btn w-100 btn-info" href="<?php echo urlmd ?>/manager/">Trang Quản Trị</a></div>
			<div class="col-4"><a class="btn w-100 btn-warning" href="<?php echo urlmd ?>/">Quay Về Website</a></div>
			<div class="col-4"><a class="btn w-100 btn-danger text-white" href="<?php echo urlmd ?>/dangxuat/">Đăng Xuất</a></div>
		</div>
		<div class="row" style="margin: 15px 0;">
			<div class="col-4"><a class="btn w-100 btn-primary text-white" href="<?php echo urlmd ?>/manager/qlsp/">Quản Lý Sản Phẩm</a></div>
			<div class="col-4"><a class="btn w-100 btn-success text-white" href="<?php echo urlmd ?>/manager/qldm/">Quản Lý Danh Mục</a></div>
			<div class="col-4"><a class="btn w-100 btn-secondary text-white" href="<?php echo urlmd ?>/manager/qlus/">Quản Lý User</a></div>
		</div>
		<div class="row">
			<div class="col-4"><a class="btn w-100 btn-secondary text-white" href="<?php echo urlmd ?>/manager/qlbl/">Quản Lý Bình Luận</a></div>
			<div class="col-4"><a class="btn w-100 btn-dark text-white" href="<?php echo urlmd ?>/manager/hddh/">Hóa Đơn Đặt Hàng</a></div>
			<div class="col-4"><a class="btn w-100 btn-dark text-white" href="<?php echo urlmd ?>/manager/magg/">Mã Giảm Giá</a></div>
		</div>
	</div>

	<div class="container" style="margin: 30px auto;">
		<div class="row" style="padding: 30px 15px 0; background: #2c3e50; border-radius: 15px;">
			<?php if (isset($_SESSION['quanly'])) { ?>
				<div class="col-6">
					<div class="ql-box">
						<h3 class="text-center">Tổng thu nhập</h3>
						<div class="box-icon">
							<i class="fa-solid fa-cash-register" style="background: #9933CC;"></i>
						</div>
						<div class="ql-mess">
							<h3 style="color: red; text-align: center;"><?php echo number_format($thunhap[0]['thunhap'],0,",",".") ?> VNĐ</h3>
							<h5 style="color: gray; text-align: center;">Từ các hóa đơn đã được thanh toán</h5><hr>
							<p>Thu nhập dự tính nếu hoàn tất mọi HD : <span style="color:red;"><?php echo number_format($thunhap[0]['dutinh'],0,",",".")?> VNĐ</span></p>
							<p>Giá trị của các hóa đơn chưa thanh toán : <span style="color:red;"><?php echo number_format($thunhap[0]['dutinh']-$thunhap[0]['thunhap'],0,",",".")?> VNĐ</span></p>
						</div>
					</div>
				</div>
				<div class="col-6">
					<div class="ql-box">
						<h3 class="text-center">Lượng đơn hàng</h3>
						<div class="box-icon">
							<i class="fa-solid fa-file-invoice" style="background: #0d47a1;"></i>
						</div>
						<div class="ql-mess">
							<h3 style="color: red; text-align: center;"><?php echo $donhang[0]['tonghd'] ?></h3>
							<h5 style="color: gray; text-align: center;">Là tổng số các hóa đơn hiện có</h5><hr>
							<p>Đã hoàn thành : <?php echo $donhang[0]['hdht'] ?></p>
							<p>Chưa hoàn thành : <?php echo $donhang[0]['tonghd']-$donhang[0]['hdht'] ?></p>
						</div>
					</div>
				</div>
				<div class="col-6">
					<div class="ql-box">
						<h3 class="text-center">Tổng số khách hàng</h3>
						<div class="box-icon">
							<i class="fa-regular fa-user" style="background: #00695c;"></i>
						</div>
						<div class="ql-mess">
							<h3 style="color: red; text-align: center;"><?php echo $member[0]['ddk'] + $member[0]['cdk'] ?></h3>
							<h5 style="color: gray; text-align: center;">Là tổng số khách hàng đã truy cập và mua tại Web.</h5><hr>
							<p>Đã đăng ký : <?php echo $member[0]['ddk'] ?></p>
							<p>Chưa đăng ký : <?php echo $member[0]['cdk'] ?></p>
						</div>
					</div>
				</div>
				<div class="col-6">
					<div class="ql-box">
						<h3 class="text-center">Lưu lượng truy cập</h3>
						<div class="box-icon">
							<i class="fa-solid fa-globe" style="background: #0099cc;"></i>
						</div>
						<div class="ql-mess">
							<h3 style="color: red; text-align: center;"><?php echo number_format($access[0]['trangchu']+$access[0]['trangcon'],0,",",".") ?></h3>
							<h5 style="color: gray; text-align: center;">Lượt truy cập Web</h5><hr>
							<p>Trang chủ : <?php echo $access[0]['trangchu'] ?></p>
							<p>Trang con : <?php echo $access[0]['trangcon'] ?></p>
						</div>
					</div>
				</div>
			<?php } else { ?>
				<div class="box-table">
					<div class="boloc">
						<?php if (isset($_SESSION['qlsp'])) { ?>
							<button class="btn-boloc" data="sanpham" boloc="1">Tất Cả</button>
							<button class="btn-boloc" data="sanpham" boloc="2">Sản Phẩm Bán Chạy</button>
							<button class="btn-boloc" data="sanpham" boloc="3">Nhiều Lượt Xem</button>
							<button class="btn-boloc" data="sanpham" boloc="4">Đang Sale</button>
							<button class="btn-boloc" data="sanpham" boloc="5">Đã Ẩn</button>
						<?php } ?>
						<?php if (isset($_SESSION['qlus'])) { ?>
							<button class="btn-boloc" data="taikhoan" boloc="1">Tất Cả</button>
							<button class="btn-boloc" data="taikhoan" boloc="2">TK Bị khóa</button>
							<button class="btn-boloc" data="taikhoan" boloc="3">TK Không khóa</button>
							<button class="btn-boloc" data="taikhoan" boloc="4">TK User</button>
							<button class="btn-boloc" data="taikhoan" boloc="5">TK Admin</button>
						<?php } ?>
						<?php if (isset($_SESSION['hddh'])) { ?>
							<button class="btn-boloc" data="hoadon" boloc="1">Tất Cả</button>
							<button class="btn-boloc" data="hoadon" boloc="2">Hóa đơn mới</button>
							<button class="btn-boloc" data="hoadon" boloc="3">Đang Chuẩn Bị</button>
							<button class="btn-boloc" data="hoadon" boloc="4">Đang Giao</button>
							<button class="btn-boloc" data="hoadon" boloc="5">Hoàn Thành</button>
							<button class="btn-boloc" data="hoadon" boloc="6">Đã Hủy</button>
						<?php } ?>
					</div>
					<table class="show-data">
						<?php if (isset($_SESSION['qlsp'])) { ?>
							<tr>
								<th style="width: 50px;">ID</th>
								<th style="width: 150px; padding: 0;">IMG</th>
								<th style="width: 200px;">Tên</th>
								<th style="width: auto;">Thông Tin</th>
								<th style="width: 100px;">Giá</th>
								<th style="width: 100px;">Sale</th>
								<th style="width: 120px;">Thao Tác</th>
							</tr>
							<tr>
								<td colspan="7" class="td-addsp"><button class="btn btn-primary btn-add them">Thêm sản phẩm +</button></td>
							</tr>
							<?php foreach ($sanpham as $value => $item) { ?>
								<tr class="sanpham">
									<td rowspan="2" class="text-center"><?php echo $item['id'] ?></td>
									<td rowspan="2" class="text-center"><img src="<?php echo $item['img'] ?>" alt=""></td>
									<td rowspan="2" id="tensp"><?php echo $item['name'] ?></td>
									<td rowspan="2" id="in4sp" style="overflow-hidden"><?php echo $item['detail'] ?></td>
									<td id="min4sp" hidden><?php echo $item['mdetail'] ?></td>
									<td id="giasp" class="text-center"><?php echo number_format($item['price'],0,'','.') ?></td>
									<td id="salesp" class="text-center"><?php echo number_format($item['price_sale'],0,'','.') ?></td>
									<td rowspan="2" class="text-center">
										<button class="btn btn-primary suaxoa sua suasp" data-idsp="<?php echo $item['id'] ?>"><i class="fa-solid fa-gear"></i></button>
										<button class="btn btn-danger suaxoa xoa xoasp" data-idsp="<?php echo $item['id'] ?>"><i class="fa-solid fa-trash"></i></button>
										<?php 
											if($item['hidden'] == 0) echo"<button class=\"btn btn-warning suaxoa hidden hidsp\" data-idsp=\"".$item['id']."\"><i class=\"fa-solid fa-eye-slash\"></i></button>"; 
											else echo"<button class=\"btn btn-success suaxoa hidden unhidsp\" data-idsp=\"".$item['id']."\"><i class=\"fa-solid fa-eye\"></i></button>"
										?>
									</td>
								</tr>
								<tr class="sanpham">
									<td colspan="2">Đã bán : <?php echo $item['saled'] ?></td>
								</tr>
							<?php } ?>
						<?php } ?>
						<?php if (isset($_SESSION['qldm'])) { ?>
							<tr>
								<th style="width: 50px;">ID</th>
								<th style="width: 200px;">Tên</th>
								<th style="width: 200px;">Mã Phân Loại</th>
								<th style="width: auto;">IMG</th>
								<th style="width: 120px;">Thao Tác</th>
							</tr>
							<tr>
								<td colspan="7" class="td-adddm"><button class="btn btn-primary btn-add them">Thêm danh mục +</button></td>
							</tr>
							<?php foreach ($danhmuc as $value => $item) { ?>
								<tr>
									<td style="text-align: center;"><?php echo $item['id'] ?></td>
									<td style="text-align: center;" id="tendm"><?php echo $item['name'] ?></td>
									<td style="text-align: center;" id="pldm"><?php echo $item['loai'] ?></td>
									<td style="text-align: center;" id="imgdm"><?php echo $item['img'] ?></td>
									<td style="text-align: center;">
										<button class="btn btn-primary suaxoa sua suadm" data-iddm="<?php echo $item['id'] ?>"><i class="fa-solid fa-gear"></i></button>
										<button class="btn btn-danger suaxoa xoa xoadm" data-iddm="<?php echo $item['id'] ?>"><i class="fa-solid fa-trash"></i></button>
									</td>
								</tr>
							<?php } ?>
						<?php } ?>
						<?php if (isset($_SESSION['qlus'])) { ?>
							<tr>
								<th style="width: 40px;">ID</th>
								<th style="width: 200px; padding: 0;">Tài Khoản</th>
								<th style="width: 250px;">Họ Tên</th>
								<th style="width: 125px;">SĐT</th>
								<th style="width: auto;">Email</th>
								<th style="width: 70px;">Role</th>
								<th style="width: 120px;">Thao Tác</th>
							</tr>
							<tr>
								<td colspan="7" class="td-adddm"><button class="btn btn-primary btn-add them">Thêm User +</button></td>
							</tr>
							<?php foreach ($user as $value => $item) { ?>
								<tr class="taikhoan">
									<td class="text-center"><?php echo $item['id'] ?></td>
									<td id="tenus"><?php echo $item['user'] ?></td>
									<td><?php echo $item['ho']." ".$item['ten'] ?></td>
									<td id="sdtus"><?php echo $item['sdt'] ?></td>
									<td id="emailus" class="text-center"><?php echo $item['email'] ?></td>
									<td id="roleus" class="text-center"><?php echo $item['role'] ?></td>
									<td class="text-center">
										<button class="btn btn-primary suaxoa sua suaus" data-idus="<?php echo $item['id'] ?>"><i class="fa-solid fa-gear"></i></button>
										<button class="btn btn-danger suaxoa xoa xoaus" data-idus="<?php echo $item['id'] ?>"><i class="fa-solid fa-trash"></i></button>
										<?php 
											if($item['ban'] == 1) echo"<button class=\"btn btn-warning suaxoa ban banus\" data-idus=\"".$item['id']."\"><i class=\"fa-solid fa-ban\"></i></button>"; 
											else echo"<button class=\"btn btn-success suaxoa ban unbanus\" data-idus=\"".$item['id']."\"><i class=\"fa-solid fa-check\"></i></button>"
										?>
									</td>
								</tr>
							<?php } ?>
						<?php } ?>
						<?php if (isset($_SESSION['hddh'])) { ?>
							<tr>
								<th style="width: 30px;">ID</th>
								<th style="width: 120px;">Tên</th>
								<th style="width: 20%;">Liên Hệ</th>
								<th style="width: auto;">Danh Sách Sản Phẩm</th>
								<th style="width: 100px;">Thành tiền</th>
								<th style="width: 100px;">Tình Trạng</th>
								<th style="width: 100px;">Thao tác</th>
							</tr>
							<?php foreach ($hoadon as $value => $item) { 
								$dssp = json_decode($item['dssp'],true);
								if ($item['thanhtien2'] != 0) $tc = number_format($item['thanhtien2'],0,'','.')."<br><span style=\"font-size: 10px; color: red;\">".$item['mgg']."</span>";
								else $tc = number_format($item['thanhtien'],0,'','.');
								if (is_array($dssp)) $rp = count($dssp);
								else $rp = 0;
							?>
								<tr class="hoadon">
									<td rowspan="<?php echo $rp ?>" class="text-center p-0 id-hd"><?php echo $item['id'] ?></td>
									<td rowspan="<?php echo $rp ?>" class="text-start"><?php echo $item['name'] ?></td>
									<td rowspan="<?php echo $rp ?>" class="text-start">
										Email: <?php echo $item['email'] ?><br>
										SĐT: <?php echo $item['sdt'] ?><br>
										Đ/C: <?php echo $item['dc'] ?>
									</td>
									<td class="text-start"><?php echo "SL: ".$dssp[0]['soluong']." | ".$dssp[0]['name'] ?></td>
									<td rowspan="<?php echo $rp ?>" class="text-center p-0"><?php echo $tc ?></td>
									<td rowspan="<?php echo $rp ?>" class="text-center stt-hd"><?php echo $item['trangthai'] ?></td>
									<td rowspan="<?php echo $rp ?>" class="text-center">
										<select name="trangthai" class="hd-stt" id="hd-stt">
											<option value="Chuẩn Bị">Chuẩn Bị</option>
											<option value="Đang Giao">Đang Giao</option>
											<option value="Hoàn Thành">Hoàn Thành</option>
											<option value="Hủy">Hủy</option>
										</select>
										<button class="btn btn-success d-block mt-1 mx-auto hd-update" id="hd-update">Cập Nhật</button>
									</td>
								</tr>
								<?php for ($i = 1; $i < $rp ; ++$i) { ?>
									<tr class="hoadon">
										<td style="text-align: left;"><?php echo "SL: ".$dssp[$i]['soluong']." | ".$dssp[$i]['name'] ?></td>
									</tr>
								<?php } ?>
							<?php } ?>
						<?php } ?>
						<?php if (isset($_SESSION['qlbl'])) { ?>
							<tr>
								<th style="width: 70px;">ID SP</th>
								<th style="width: auto;">Tên SP</th>
								<th style="width: 125px;">Lượt CMT</th>
								<th style="width: 125px;">Lượng User</th>
								<th style="width: 125px;">Thao Tác</th>
							</tr>
							<?php foreach ($binhluan as $value => $item) { ?>
								<tr>
									<td><?php echo $item['id'] ?></td>
									<td style="text-align: left;"><?php echo $item['name'] ?></td>
									<td><?php echo $item['cmts'] ?></td>
									<td><?php echo $item['users'] ?></td>
									<td><button class="btn btn-success chitiet chitietbl" data-idbl="<?php echo $item['id'] ?>">Chi tiết</button></td>
								</tr>
							<?php } ?>
						<?php } ?>
						<?php if (isset($_SESSION['magg'])) { ?>
							<tr>
								<th style="width: 40px;">ID</th>
								<th style="width: auto;">Tên Mã</th>
								<th style="width: 100px;">S.Lượng</th>
								<th style="width: 100px;">Còn Lại</th>
								<th style="width: 125px;">Từ Ngày</th>
								<th style="width: 125px;">Đến Ngày</th>
								<th style="width: 100px;">% Giảm</th>
								<th style="width: 120px;">Thao Tác</th>
							</tr>
							<tr>
								<td colspan="8" class="td-adddm"><button class="btn btn-primary btn-add them">Thêm MGG +</button></td>
							</tr>
							<?php foreach ($mgg as $value => $item) { ?>
								<tr class="voucher">
									<td><?php echo $item['id'] ?></td>
									<td id="tengg"><?php echo $item['name'] ?></td>
									<td id="maxgg"><?php echo $item['max'] ?></td>
									<td id="remgg"><?php echo $item['remaining'] ?></td>
									<td hidden id="fdgg"><?php echo $item['f_date'] ?></td>
									<td hidden id="tdgg"><?php echo $item['t_date'] ?></td>
									<td><?php echo date("d-m-Y",strtotime($item['f_date'])) ?></td>
									<td><?php echo date("d-m-Y",strtotime($item['t_date'])) ?></td>
									<td id="ptgg"><?php echo $item['percent'] ?></td>
									<td>
										<button class="btn btn-primary suaxoa sua suagg" data-idgg="<?php echo $item['id'] ?>"><i class="fa-solid fa-gear"></i></button>
										<button class="btn btn-danger suaxoa xoa xoagg" data-idgg="<?php echo $item['id'] ?>"><i class="fa-solid fa-trash"></i></button>
									</td>
								</tr>
							<?php } ?>
						<?php } ?>
					</table>
					<table>
						<?php if (isset($_SESSION['qldm'])) { ?>
							<tr>
								<th style="width: 50px;">ID</th>
								<th style="width: auto;">Tên</th>
								<th style="width: 120px;">Thao Tác</th>
							</tr>
							<tr>
								<td colspan="7" class="td-adddm"><button class="btn btn-primary btn-add them">Thêm phân loại +</button></td>
							</tr>
							<?php foreach ($phanloai as $value => $item) { ?>
								<tr>
									<td style="text-align: center;"><?php echo $item['id'] ?></td>
									<td style="text-align: center;" id="tenpl"><?php echo $item['name'] ?></td>
									<td style="text-align: center;">
										<button class="btn btn-primary suaxoa sua suapl" data-idpl="<?php echo $item['id'] ?>"><i class="fa-solid fa-gear"></i></button>
										<button class="btn btn-danger suaxoa xoa xoapl" data-idpl="<?php echo $item['id'] ?>"><i class="fa-solid fa-trash"></i></button>
									</td>
								</tr>
							<?php } ?>
						<?php } ?>
					</table>
				</div>
				<?php if (isset($_SESSION['qlsp'])) { ?>
					<div class="thongke">
						<?php foreach ($tksp as $value => $item) { ?>
							<div hidden class="dsdm-ten" data-soluong="<?php echo $item['soluong'] ?>" ><?php echo $item['name'] ?></div>
						<?php } ?>
						<div id="bieudo"></div>
					</div>
				<?php } ?>	
			<?php } ?>
		</div>
	</div>

	<?php include 'apopup.php' ?>
</body>
</html>