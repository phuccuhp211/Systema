<?php 
require_once 'function.php';

class admin_model {
	public function adlogin() { return getdata('SELECT * FROM user WHERE role = 0'); }

    public function fullsp() { return getdata('SELECT * FROM product ORDER BY id DESC'); }

    public function fulldm() { return getdata('SELECT * FROM catalog'); }

    public function pldm() { return getdata('SELECT * FROM phanloai'); }

    public function fullus() { return getdata('SELECT * FROM user'); }

    public function fullth() { return getdata('SELECT * FROM brand'); }

    public function shd() { return getdata("SELECT * FROM hoadon WHERE id > 0 ORDER BY id DESC"); }

    public function mgg() { return getdata("SELECT * FROM voucher ORDER BY id DESC"); }

	public function upsaled($id,$soluong) { iuddata("UPDATE product SET saled = saled + $soluong WHERE id = $id"); }

	public function ajax($id=null, $data=null, $filter=null, $type=null) {
		if ($type == "prod") {
			if (isset($data)) {
				$sql = "UPDATE product SET hidden = '$data' WHERE id = $id";
				iuddata($sql);
			}
			else if (isset($id)) {
				$sql = "SELECT * FROM product WHERE id = $id";
				$ketqua = getdata($sql);
				return $ketqua;
			}
			else if (isset($filter)) {
				if ($filter == 1) $sql = "SELECT * FROM product ORDER BY id DESC";
				else if ($filter == 2) $sql = "SELECT * FROM product ORDER BY saled DESC";
				else if ($filter == 3) $sql = "SELECT * FROM product ORDER BY viewed DESC";
				else if ($filter == 4) $sql = "SELECT * FROM product WHERE price_sale > 0 ORDER BY id DESC";
				else if ($filter == 5) $sql = "SELECT * FROM product WHERE hidden = 1 ORDER BY id DESC";
				$ketqua = getdata($sql);
				return $ketqua;
			}
		}
		else if ($type == "user") {
			if (isset($data)) {
				$sql = "UPDATE user SET ban = $data WHERE id = $id";
				iuddata($sql);
			}
			else if (isset($id)) {
				$sql = "SELECT * FROM user WHERE id = $id";
				$ketqua = getdata($sql);
				return $ketqua;
			}
			else if (isset($filter)) {
				if ($filter == 1) $sql = "SELECT * FROM user ORDER BY id DESC";
				else if ($filter == 2) $sql = "SELECT * FROM user WHERE ban = 2 ORDER BY id DESC";
				else if ($filter == 3) $sql = "SELECT * FROM user WHERE ban = 1 ORDER BY id DESC";
				else if ($filter == 4) $sql = "SELECT * FROM user WHERE role = 1 ORDER BY id DESC";
				else if ($filter == 5) $sql = "SELECT * FROM user WHERE role = 0 ORDER BY id DESC";
				$ketqua = getdata($sql);
				return $ketqua;
			}
		}
		else if ($type == "invo") {
			if (isset($id) && isset($data)) {
				$date = date("Y-m-d",time());
				$sql = "SELECT * FROM hoadon WHERE id = $id";
				$ketqua = getdata($sql);
				if($ketqua[0]['submited'] == "0000-00-00") {
					$sql = "UPDATE hoadon SET trangthai = '$data', submited = '$date' WHERE id = $id";
					iuddata($sql);
				}
				else {
					$sql = "UPDATE hoadon SET trangthai = '$data' WHERE id = $id";
					iuddata($sql);
					if ($data == "Hoàn Thành") { 
						$sql = "UPDATE accessed SET tt = tt + ".$ketqua[0]['thanhtien'];
						iuddata($sql);
					}
				}
			}
			else if (isset($id)) {
				$sql = "SELECT * FROM hoadon WHERE id = $id";
				$ketqua = getdata($sql);
				return $ketqua;
			}
			else if (isset($filter)) {
				if ($filter == 1) $sql = "SELECT * FROM hoadon ORDER BY id DESC";
				else if ($filter == 2) $sql = "SELECT * FROM hoadon WHERE trangthai = 'Chưa Xong' OR trangthai = 'Chờ Xác Nhận' ORDER BY id DESC";
				else if ($filter == 3) $sql = "SELECT * FROM hoadon WHERE trangthai = 'Chuẩn Bị' ORDER BY id DESC";
				else if ($filter == 4) $sql = "SELECT * FROM hoadon WHERE trangthai = 'Đang Giao' ORDER BY id DESC";
				else if ($filter == 5) $sql = "SELECT * FROM hoadon WHERE trangthai = 'Hoàn Thành' ORDER BY id DESC";
				else if ($filter == 6) $sql = "SELECT * FROM hoadon WHERE trangthai = 'Đã Hủy' ORDER BY id DESC";
				$ketqua = getdata($sql);
				return $ketqua;
			}
		}
	}
	/*-----------------------------------------*/
	public function thunhap() { return getdata("SELECT SUM(thanhtien) as dutinh, tb.thunhap FROM hoadon INNER JOIN (SELECT SUM(thanhtien) as thunhap FROM hoadon WHERE trangthai = \"Hoàn Thành\") as tb"); }
	public function donhang() { return getdata("SELECT COUNT(id) as tonghd, tb.hdht FROM hoadon INNER JOIN (SELECT COUNT(id) as hdht FROM hoadon WHERE trangthai = \"Hoàn Thành\")as tb"); }
	public function member() { return getdata("SELECT COUNT(us.user) as ddk, cdk FROM user us, (SELECT COUNT(name) as cdk FROM (SELECT name FROM hoadon WHERE name NOT IN (SELECT user FROM user) GROUP BY name) as tb) as tb WHERE us.role = 1"); }
	public function access() { return getdata("SELECT * FROM accessed"); }
	/*-----------------------------------------*/
	public function tksp() {
		$sql = "
			SELECT dm.name, COUNT(pd.id) as soluong
			FROM catalog dm LEFT JOIN product pd ON dm.id = pd.id_cata
			GROUP BY dm.name";
		$ketqua = getdata($sql);
		return $ketqua;
	}
	public function checksp($name) {
		$sql = "SELECT * FROM product WHERE name = \"$name\"";
		$ketqua = getdata($sql);
		return $ketqua;
	}
	public function addpro($name,$duongdan,$price,$sale,$salef,$salet,$catalog,$brand,$info,$infoct) {
		$sql = "INSERT INTO product VALUES('','$name','$duongdan','$info','$infoct','','$catalog','$brand','$price','$sale','$salef','$salet','','','')";
		iuddata($sql);
	}
	public function fixpro($id,$name,$duongdan,$price,$sale,$salef,$salet,$catalog,$brand,$info,$infoct) {
		$sql = "UPDATE product SET 
			name = '$name', 
			img = '$duongdan', 
			detail = '$info', 
			mdetail = '$infoct', 
			id_cata = '$catalog', 
			id_brand = '$brand', 
			price = '$price', 
			price_sale = '$sale', 
			from_date = '$salef', 
			to_date = '$salet' 
			WHERE id = $id";
		iuddata($sql);
	}
	public function delpro($id) {
		$sql = "DELETE FROM product WHERE id = $id";
		iuddata($sql);
	}
	/*-----------------------------------------*/
	public function checkdm($name) {
		$sql = "SELECT * FROM catalog WHERE name = \"$name\"";
		$ketqua = getdata($sql);
		return $ketqua;
	}
	public function addcat($name, $phanloai, $duongdan = "") {
		$sql = "INSERT INTO catalog VALUES('','$name','$phanloai','$duongdan')";
		iuddata($sql);
	}
	public function fixcat($id,$name, $phanloai, $duongdan) {
		$sql = "UPDATE catalog SET 
			name = '$name',
			loai = '$phanloai', 
			img = '$duongdan'
			WHERE id = $id";
		iuddata($sql);
	}
	public function delcat($id) {
		$sql = "DELETE FROM catalog WHERE id = $id";
		iuddata($sql);
	}
	/*-----------------------------------------*/
	public function checkpl($name) {
		$sql = "SELECT * FROM phanloai WHERE name = \"$name\"";
		$ketqua = getdata($sql);
		return $ketqua;
	}
	public function addpl($name) {
		$sql = "INSERT INTO phanloai VALUES('','$name')";
		iuddata($sql);
	}
	public function fixpl($id,$name) {
		$sql = "UPDATE phanloai SET 
			name = '$name'
			WHERE id = $id";
		iuddata($sql);
	}
	public function delpl($id) {
		$sql = "DELETE FROM phanloai WHERE id = $id";
		iuddata($sql);
	}
	/*-----------------------------------------*/
	public function checkus($name) {
		$sql = "SELECT * FROM user WHERE user = \"$name\"";
		$ketqua = getdata($sql);
		return $ketqua;
	}
	public function addus($name,$pass,$ho,$ten,$phone,$email,$diachi,$role) {
		$sql = "INSERT INTO user VALUES('','$name','$pass','$ho','$ten','$phone','$email','$diachi','$role','','')";
		iuddata($sql);
	}
	public function fixus($id,$name,$pass,$ho,$ten,$phone,$email,$diachi,$role) {
		$sql = "UPDATE user SET 
			user = '$name', 
				pass = '$pass',
			ho = '$ho',
				ten = '$ten',
			sdt = '$phone',
				email = '$email',
			diachi = '$diachi',
				role = '$role'
			WHERE id = $id";
		iuddata($sql);
	}
	public function delus($id) {
		$sql = "DELETE FROM user WHERE id = $id";
		iuddata($sql);
	}
	/*-----------------------------------------*/
	public function checkmgg($name) {
		$sql = "SELECT * FROM voucher WHERE name = '$name'";
		$ketqua = getdata($sql);
		return $ketqua;
	}
	public function addmgg($name,$max,$remaining,$fd,$ft,$percent) {
		$sql = "INSERT INTO voucher VALUES('','$name','$max','$remaining','$fd','$ft','$percent')";
		iuddata($sql);
	}
	public function fixmgg($id,$name,$fd,$td,$percent) {
		$sql = "UPDATE voucher SET 
			name = '$name',
			f_date = '$fd',
			t_date = '$td',
			percent = '$percent'
			WHERE id = $id";
		iuddata($sql);
	}
	public function delmgg($id) {
		$sql = "DELETE FROM voucher WHERE id = $id";
		iuddata($sql);
	}
	/*-----------------------------------------*/
	public function dsbl() {
		$sql = "
		SELECT id, name, SUM(luot) as cmts, COUNT(id_user) as users FROM (
			SELECT id, name, COUNT(id_pd) as luot, id_user
			FROM product pd INNER JOIN comments cmt ON pd.id = cmt.id_pd
			GROUP BY id_pd, id_user) 
		AS TB GROUP BY name";
		$ketqua = getdata($sql);
		return $ketqua;
	}
	public function delbl($id) {
		$sql = "DELETE FROM comments WHERE id_cmt = $id";
		iuddata($sql);
	}
	public function infobl($idsp) {
		$sql = "SELECT * FROM comments WHERE id_pd = $idsp";
		return getdata($sql);
	}
} ?>