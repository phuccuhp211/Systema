<?php 
require_once 'models/admin_model.php';

class admin_controller {
	public function index() {
		if (isset($_SESSION['adone'])) {
		    header('location: '.urlmd.'/manager/'); 
		    exit();
		}
		else {
		    require_once './views/admin_log.php';
		}
	}
	public function adlogin() {
		$amodel = new admin_model();
		$userpass = $amodel->adlogin();
		$aname = $_POST['u_admin'];
		$apass = $_POST['p_admin'];
		if ($aname == "") $_SESSION['errlog'] = "Vui lòng nhập tên tài khoản";
		if ($apass == "") $_SESSION['errlog'] = "Vui lòng nhập mật khẩu";
		foreach ($userpass as $value => $item) {
			if ($aname != $item['user']) {
				$_SESSION['errlog'] = "Tài khoản không tồn tại";
			}
			if ($aname == $item['user']) {
				unset($_SESSION['errlog']);
				if (md5($apass) != $item['pass']) {
					$_SESSION['errlog'] = "Sai mật khẩu";
					break;
				}
				if (md5($apass) == $item['pass']) {
					unset($_SESSION['errlog']);
					$_SESSION['adone'] = "SUCESS";
					break;
				}
			}
		}
		if (isset($_SESSION['adone'])) {
		    header('location: '.urlmd.'/manager/'); 
		    exit();
		}
		else {
		    header('location: '.urlmd.'/admin/'); 
		    exit();
		}
	}
	public function manager($request = "") {
		$amodel = new admin_model();
		if (!isset($_SESSION['adone'])) {
			unset($_SESSION['errlog']);
	        header('Location: ' .urlmd. '/admin/');
	        exit();
    	}
    	else {
    		unset($_SESSION['errlog']);
	    	if ($request != "") {
	    		unset($_SESSION['quanly']);
	    		if ($request == "qldm") {
	    			$danhmuc = $amodel->fulldm();
	    			$phanloai = $amodel->pldm();
	    			$_SESSION['qldm'] = true;
	    			unset($_SESSION['qlus'], $_SESSION['qlsp'], $_SESSION['hddh'], $_SESSION['qlbl']);
	    			require_once './views/manager.php';
	    		}
	    		if ($request == "qlus") {
	    			$user = $amodel->fullus();
	    			$_SESSION['qlus'] = true;
	    			unset($_SESSION['qldm'], $_SESSION['qlsp'], $_SESSION['hddh'], $_SESSION['qlbl']);
	    			require_once './views/manager.php';
	    		}
	    		if ($request == "qlsp") {
	    			$sanpham = $amodel->fullsp();
	    			$danhmuc = $amodel->fulldm();
	    			$tksp = $amodel->tksp();
	    			$brand = $amodel->fullth();
					$_SESSION['qlsp'] = true;
					unset($_SESSION['qldm'], $_SESSION['qlus'], $_SESSION['hddh'], $_SESSION['qlbl']);
		    		require_once './views/manager.php';
	    		}
	    		if ($request == "hddh") {
	    			$hoadon = $amodel->shd();
					$_SESSION['hddh'] = true;
					unset($_SESSION['qldm'], $_SESSION['qlus'], $_SESSION['qlsp'], $_SESSION['qlbl']);
		    		require_once './views/manager.php';
	    		}
	    		if ($request == "qlbl") {
	    			$binhluan = $amodel->dsbl();
	    			$_SESSION['qlbl'] = true;
	    			unset($_SESSION['qldm'], $_SESSION['qlus'], $_SESSION['qlsp'], $_SESSION['hddh']);
	    			require_once './views/manager.php';
	    		}
	    	}
	    	else {
	    		$thunhap = $amodel->thunhap();
	    		$donhang = $amodel->donhang();
	    		$member = $amodel->member();
	    		$access = $amodel->access();
				$_SESSION['quanly'] = true;
				unset($_SESSION['qldm'], $_SESSION['qlus'], $_SESSION['hddh'], $_SESSION['qlbl'], $_SESSION['qlsp']);
	    		require_once './views/manager.php';
	    	}
    	}
	}
	public function hdup() {
		$amodel = new admin_model();
		if (isset($_POST['id'])) {
			$amodel->hdup($_POST['id'],$_POST['stt'],null);
		}
		else if (isset($_POST['boloc'])) {
			$hoadon = $amodel->hdup(null,null,$_POST['boloc']);

			$show_hd = "";

			foreach ($hoadon as $value => $item) {
				$dssp = json_decode($item['dssp'],true);
				$tc = number_format($item['thanhtien'],0,'','.');
				if (is_array($dssp)) $rp = count($dssp);
				else $rp = 0;
				$show_hd .= "
					<tr class=\"hoadon\">
						<td rowspan=\"$rp\" class=\"text-center p-0 id-hd\">".$item['id']."</td>
						<td rowspan=\"$rp\" class=\"text-start\">".$item['name']."</td>
						<td rowspan=\"$rp\" class=\"text-start\">
							Email: ".$item['email']."<br>
							SĐT: ".$item['sdt']."<br>
							Đ/C: ".$item['dc']."
						</td>
						<td class=\"text-start\">SL: ".$dssp[0]['soluong']." | ".$dssp[0]['name']."</td>
						<td rowspan=\"$rp\" class=\"text-center p-0\">$tc</td>
						<td rowspan=\"$rp\" class=\"text-center stt-hd\">".$item['trangthai']."</td>
						<td rowspan=\"$rp\" class=\"text-center\">
							<select name=\"trangthai\" class=\"hd-stt\" id=\"hd-stt\">
								<option value=\"Chuẩn Bị\">Chuẩn Bị</option>
								<option value=\"Đang Giao\">Đang Giao</option>
								<option value=\"Hoàn Thành\">Hoàn Thành</option>
								<option value=\"Hủy\">Hủy</option>
							</select>
							<button class=\"btn btn-success d-block mt-1 mx-auto hd-update\" id=\"hd-update\">Cập Nhật</button>
						</td>
					</tr>
				";
				for ($i = 1; $i < $rp ; ++$i) {
					$show_hd .="
						<tr class=\"hoadon\">
							<td style=\"text-align: left;\">SL: ".$dssp[$i]['soluong']." | ".$dssp[$i]['name']."</td>
						</tr>
					";
				}
			}

			echo $show_hd;
		}
		else {
			header('Location: ' .urlmd. '/manager/hddh/');
		    exit();
		}
	}
	/*-----------------------------------------*/
	public function addpro() {
		if(isset($_SESSION['error_log'])) unset($_SESSION['error_log']);
		$amodel = new admin_model();
		$name = $_POST['name'];
		$price = $_POST['price'];
		$sale = $_POST['sale'];
		$salef = $_POST['salef'];
		$salet = $_POST['salet'];
		$catalog = $_POST['catalog'];
		$brand = $_POST['brand'];
		$info = $_POST['info'];
		$infoct = $_POST['detail'];
		$checksp = $amodel->checksp($name);

		if ($name == "") $_SESSION['error_log'] .= "Không để trống tên sản phẩm !<br>";
		if (isset($checksp[0])) $_SESSION['error_log'] .= "sản phẩm đã tồn tại !<br>";
		if ($price == "") $_SESSION['error_log'] .= "Không để trống giá sản phẩm !<br>";
		if ($catalog == "" || $brand == "") $_SESSION['error_log'] .= "Không để trống danh mục hoặc hãng sản phẩm !<br>";
		if ($info == "") $_SESSION['error_log'] .= "Không để trống mô tả sản phẩm !<br>";

		$duongdan = urlmd . "/views/data/" . basename($_FILES["img"]["name"]);
		$duongdan_2nd = "./views/data/" . basename($_FILES["img"]["name"]);
		$dinhdang = strtolower(pathinfo($duongdan,PATHINFO_EXTENSION));

		if (file_exists($duongdan)) $_SESSION['error_log'] .= "File đã tồn tại<br>";
		if ($_FILES["img"]["size"] > 4096000) $_SESSION['error_log'] .= "Chỉ chấp nhận file dưới 4mb<br>";

		if($dinhdang != "jpg" && $dinhdang != "png" && $dinhdang != "jpeg"
		&& $dinhdang != "gif" && $dinhdang != "pdf" && $dinhdang != "webp") {
			$_SESSION['error_log'] .= "Chỉ chấp nhận file jpg, png, jpeg, gif, pdf<br>";
		}

		if (!isset($_SESSION['error_log'])) {
			move_uploaded_file($_FILES["img"]["tmp_name"], $duongdan_2nd);
			$amodel->addpro($name,$duongdan,$price,$sale,$salef,$salet,$catalog,$brand,$info,$infoct);
		}
		header('Location: ' .urlmd. '/manager/');
	    exit();
	}
	public function fixpro($id) {
		if(isset($_SESSION['error_log'])) unset($_SESSION['error_log']);
		$amodel = new admin_model();
		$name = $_POST['name'];
		$price = $_POST['price'];
		$sale = $_POST['sale'];
		$salef = $_POST['salef'];
		$salet = $_POST['salet'];
		$catalog = $_POST['catalog'];
		$brand = $_POST['brand'];
		$info = $_POST['info'];
		$infoct = $_POST['detail'];

		if ($name == "") $_SESSION['error_log'] .= "Không để trống tên sản phẩm !<br>";
		if ($price == "") $_SESSION['error_log'] .= "Không để trống giá sản phẩm !<br>";
		if ($catalog == "" || $brand == "") $_SESSION['error_log'] .= "Không để trống danh mục hoặc hãng sản phẩm !<br>";
		if ($info == "") $_SESSION['error_log'] .= "Không để trống mô tả sản phẩm !<br>";

		if (isset($_FILES['img']) && $_FILES['img']['name'] != '') {
			$duongdan = urlmd . "/views/data/" . basename($_FILES["img"]["name"]);
			$duongdan_2nd = "./views/data/" . basename($_FILES["img"]["name"]);
			$dinhdang = strtolower(pathinfo($duongdan,PATHINFO_EXTENSION));

			if (file_exists($duongdan)) $_SESSION['error_log'] .= "File đã tồn tại<br>";
			if ($_FILES["img"]["size"] > 4096000) $_SESSION['error_log'] .= "Chỉ chấp nhận file dưới 4mb<br>";

			if($dinhdang != "jpg" && $dinhdang != "png" && $dinhdang != "jpeg"
			&& $dinhdang != "gif" && $dinhdang != "pdf" && $dinhdang != "webp") {
				$_SESSION['error_log'] .= "Chỉ chấp nhận file jpg, png, jpeg, gif, pdf<br>";
			}

			if (!isset($_SESSION['error_log'])) {
				move_uploaded_file($_FILES["img"]["tmp_name"], $duongdan_2nd);
				$amodel->fixpro($id,$name,$duongdan,$price,$sale,$salef,$salet,$catalog,$brand,$info,$infoct);
			}
			header('Location: ' .urlmd. '/manager/qlsp/');
		    exit();
		}
		else {
			$img_cu = $_POST['old_img'];
			if (!isset($_SESSION['error_log'])) {
				$amodel->fixpro($id,$name,$img_cu,$price,$sale,$salef,$salet,$catalog,$brand,$info,$infoct);
			}
			header('Location: ' .urlmd. '/manager/qlsp/');
		    exit();
		}
	}
	public function delpro($id) {
		$amodel = new admin_model();
		$amodel->delpro($id);
		header('Location: ' .urlmd. '/manager/');
	    exit();
	}
	/*-----------------------------------------*/
	public function addcat() {
		if(isset($_SESSION['error_log'])) unset($_SESSION['error_log']);
		$amodel = new admin_model();
		$name = $_POST['name'];
		$phanloai = $_POST['phanloai'];
		$checkdm = $amodel->checkdm($name);

		if ($name == "") $_SESSION['error_log'] .= "Không để trống tên danh mục<br>";
		if (isset($checkdm[0])) $_SESSION['error_log'] .= "Danh mục đã tồn tại<br>";

		if (isset($_FILES["product_image"]) && $_FILES["product_image"]["error"] === UPLOAD_ERR_OK) {
			$duongdan = urlmd . "/views/data/" . basename($_FILES["img"]["name"]);
			$duongdan_2nd = "./views/data/" . basename($_FILES["img"]["name"]);
			$dinhdang = strtolower(pathinfo($duongdan,PATHINFO_EXTENSION));

			if (file_exists($duongdan)) $_SESSION['error_log'] .= "File đã tồn tại<br>";
			if ($_FILES["img"]["size"] > 4096000) $_SESSION['error_log'] .= "Chỉ chấp nhận file dưới 4mb<br>";

			if($dinhdang != "jpg" && $dinhdang != "png" && $dinhdang != "jpeg"
			&& $dinhdang != "gif" && $dinhdang != "pdf" && $dinhdang != "webp") {
				$_SESSION['error_log'] .= "Chỉ chấp nhận file jpg, png, jpeg, gif, pdf<br>";
			}

			if (!isset($_SESSION['error_log'])) {
				move_uploaded_file($_FILES["img"]["tmp_name"], $duongdan_2nd);
				$amodel->addcat($name,$phanloai,$duongdan);
			}
		}
		if (!isset($_SESSION['error_log'])) $amodel->addcat($name,$phanloai);
			
		header('Location: ' .urlmd. '/manager/qldm/');
	    exit();
	}
	public function fixcat($id) {
		if(isset($_SESSION['error_log'])) unset($_SESSION['error_log']);
		$amodel = new admin_model();
		$name = $_POST['name'];
		$phanloai = $_POST['phanloai'];
		$img = $_POST['img'];

		if ($name == "") $_SESSION['error_log'] .= "Không để trống tên danh mục<br>";
		if (isset($_FILES['img']) && $_FILES['img']['name'] != '') {
			$duongdan = urlmd . "/views/data/" . basename($_FILES["img"]["name"]);
			$duongdan_2nd = "./views/data/" . basename($_FILES["img"]["name"]);
			$dinhdang = strtolower(pathinfo($duongdan,PATHINFO_EXTENSION));

			if (file_exists($duongdan)) $_SESSION['error_log'] .= "File đã tồn tại<br>";
			if ($_FILES["img"]["size"] > 4096000) $_SESSION['error_log'] .= "Chỉ chấp nhận file dưới 4mb<br>";

			if($dinhdang != "jpg" && $dinhdang != "png" && $dinhdang != "jpeg"
			&& $dinhdang != "gif" && $dinhdang != "pdf" && $dinhdang != "webp") {
				$_SESSION['error_log'] .= "Chỉ chấp nhận file jpg, png, jpeg, gif, pdf<br>";
			}

			if (!isset($_SESSION['error_log'])) {
				move_uploaded_file($_FILES["img"]["tmp_name"], $duongdan_2nd);
				$amodel->fixcat($id,$name,$phanloai,$duongdan);
			}
			header('Location: ' .urlmd. '/manager/qldm/');
		    exit();
		}
		else {
			$img_cu = $_POST['old_img'];
			if (!isset($_SESSION['error_log'])) {
				move_uploaded_file($_FILES["img"]["tmp_name"], $duongdan_2nd);
				$amodel->fixcat($id,$name,$phanloai,$img_cu);
			}
			header('Location: ' .urlmd. '/manager/qldm/');
		    exit();
		}
	}
	public function delcat($id) {
		$amodel = new admin_model();
		$amodel->delcat($id);
		header('Location: ' .urlmd. '/manager/qldm/');
	    exit();
	}
	/*-----------------------------------------*/
	public function addpl() {
		if(isset($_SESSION['error_log'])) unset($_SESSION['error_log']);
		$amodel = new admin_model();
		$name = $_POST['name'];
		$checkpl = $amodel->checkpl($name);

		if ($name == "") $_SESSION['error_log'] .= "Không để trống tên phân loại<br>";
		if (isset($checkpl[0])) $_SESSION['error_log'] .= "\"Phân loại\" này đã tồn tại<br>";

		if (!isset($_SESSION['error_log'])) $amodel->addpl($name);
			
		header('Location: ' .urlmd. '/manager/qldm/');
	    exit();
	}
	public function fixpl($id) {
		if(isset($_SESSION['error_log'])) unset($_SESSION['error_log']);
		$amodel = new admin_model();
		$name = $_POST['name'];
		$checkpl = $amodel->checkpl($name);

		if ($name == "") $_SESSION['error_log'] .= "Không để trống tên phân loại<br>";
		if (isset($checkpl[0])) $_SESSION['error_log'] .= "\"Phân loại\" này đã tồn tại<br>";

		if (!isset($_SESSION['error_log'])) $amodel->fixpl($id,$name);
			
		header('Location: ' .urlmd. '/manager/qldm/');
	    exit();
	}
	public function delpl($id) {
		$amodel = new admin_model();
		$amodel->delpl($id);
		header('Location: ' .urlmd. '/manager/qldm/');
	    exit();
	}
	/*-----------------------------------------*/
	public function addus() {
		if(isset($_SESSION['error_log'])) unset($_SESSION['error_log']);
		$amodel = new admin_model();

		$name = $_POST['name'];
		$ho = $_POST['ho'];
		$ten = $_POST['ten'];
		$pass = $_POST['pass'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$diachi = $_POST['diachi'];
		$role = $_POST['role'];
		$checkus = $amodel->checkus($name);

		if ($ho==""||$ten==""||$email==""||$phone==""||$diachi=="") $_SESSION['error_log'] = "Vui lòng điền đầy đủ thông tin";
		else if ($name == "") $_SESSION['error_log'] .= "Không để trống tên người dùng<br>";
		else if ($pass == "") $_SESSION['error_log'] .= "Vui lòng nhập khẩu<br>";
		else if (isset($checkus[0])) $_SESSION['error_log'] .= "Người dùng đã tồn tại<br>";

		if (!isset($_SESSION['error_log'])) $amodel->addus($name,md5($pass),$ho,$ten,$phone,$email,$diachi,$role);
		header('Location: ' .urlmd. '/manager/qlus/');
	    exit();
	}
	public function fixus($id) {
		if(isset($_SESSION['error_log'])) unset($_SESSION['error_log']);
		$amodel = new admin_model();

		$name = $_POST['name'];
		$ho = $_POST['ho'];
		$ten = $_POST['ten'];
		$pass = $_POST['pass'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$diachi = $_POST['diachi'];
		$role = $_POST['role'];
		$checkus = $amodel->checkus($name);

		if ($ho==""||$ten==""||$email==""||$phone==""||$diachi=="") $_SESSION['dndk_err'] = "Vui lòng điền đầy đủ thông tin";
		else if ($name == "") $_SESSION['error_log'] .= "Không để trống tên người dùng<br>";
		else if ($pass == "") $_SESSION['error_log'] .= "Vui lòng nhập khẩu<br>";
		else if (isset($checkus[0])) $_SESSION['error_log'] .= "Người dùng đã tồn tại<br>";

		if (!isset($_SESSION['error_log'])) $amodel->fixus($id,$name,md5($pass),$ho,$ten,$phone,$email,$diachi,$role);
		header('Location: ' .urlmd. '/manager/qlus/');
	    exit();
	}
	public function delus($id) {
		$amodel = new admin_model();
		$amodel->delus($id);
		header('Location: ' .urlmd. '/manager/qlus/');
	    exit();
	}
	public function banus() {
		$amodel = new admin_model();
		$idtk = $_POST['idtk'];
		$user = $amodel->banus($idtk);
		if ($user[0]['ban'] == 1) $amodel->banus($idtk,2);
		if ($user[0]['ban'] == 2) $amodel->banus($idtk,1);
	}
	/*-----------------------------------------*/
	public function delbl($id) {
		$amodel = new admin_model();
		$amodel->delbl($id);
		header('Location: ' .urlmd. '/manager/qlbl/');
	    exit();
	}
	public function info_cmt() {
		$amodel = new admin_model();
		$data = $amodel->infobl($_POST['spcmt']);
		echo json_encode($data);
	}
	/*-----------------------------------------*/
	public function dangxuat() {
	    unset($_SESSION['adone']);
	    unset($_SESSION['errlog']);
	    header('Location: ' .urlmd. '/admin/');
	    exit();
	}
} ?>