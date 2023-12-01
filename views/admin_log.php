<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'include/lib.php' ?>
	<title>ĐĂNG NHẬP QUẢN TRỊ</title>
	<link rel="stylesheet" href="<?php echo urlv ?>css/admin.css">
	<script style="text/javascript" src="<?php echo urlv ?>jquery/admin.js"></script>
	<script style="text/javascript" src="<?php echo urlv ?>lib/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body style="padding: 0 !important;">
	<div class="bg-admin-log">
		<?php if (isset($_SESSION['errlog'])) { ?>
			<div class="errlog"><h2><?php echo $_SESSION['errlog']; unset($_SESSION['errlog']);?></h2></div>
		<?php } ?>
		<form action="<?php echo urlmd ?>/adlogin/" method="POST" enctype="multipart/form-data" class="log-f">
			<h2 class="text-center">Đăng Nhập</h2>
			<div style="margin: 15px 0;">
				<label>Tài khoản :</label>
				<input type="text" name="u_admin" class="input-f">
			</div>
			<div style="margin: 15px 0;">
				<label>Mật Khẩu :</label>
				<input type="password" name="p_admin" class="input-f">
			</div>
			<input type="checkbox" name="save-up"><label>Lưu tài khoản & mật khẩu</label>
			<button type="submit">Đăng Nhập</button>
		</form>
	</div>
</body>
</html>