<?php 
require_once 'function.php';

class user_model {
	public function upview_index() {
		$sql = "UPDATE accessed SET trangchu = trangchu + 1";
		iuddata($sql);
	}
	public function upview_nonin() {
		$sql = "UPDATE accessed SET trangcon = trangcon + 1";
		iuddata($sql);
	}
	public function fullsp1() {
		$sql = "SELECT * FROM product WHERE hidden = 0 LIMIT 8";
		$ketqua = getdata($sql);
		return $ketqua;
	}
	public function spnew() {
		$sql = "SELECT * FROM product WHERE hidden = 0 ORDER BY id DESC LIMIT 4";
		$ketqua = getdata($sql);
		return $ketqua;
	}
	public function sphot() {
		$sql = "SELECT * FROM product WHERE hidden = 0 ORDER BY viewed DESC LIMIT 4";
		$ketqua = getdata($sql);
		return $ketqua;
	}
	public function fullsp($page) {
		$vitri = ($page*9)-9;
		$sql = "SELECT * FROM product WHERE hidden = 0 LIMIT $vitri,9 ";
		$ketqua = getdata($sql);
		return $ketqua;
	}
	public function fullpl($id=null) {
		if (isset($id)) $sql = "SELECT * FROM phanloai WHERE id = $id";
		if (!isset($id)) $sql = "SELECT * FROM phanloai";
		$ketqua = getdata($sql);
		return $ketqua;
	}
	public function fulldm($id=null) {
		if (isset($id)) $sql = "SELECT * FROM catalog WHERE id = $id";
		if (!isset($id)) $sql = "SELECT * FROM catalog";
		$ketqua = getdata($sql);
		return $ketqua;
	}
	public function gethd($name) {
		$sql = "SELECT * FROM hoadon WHERE name = '$name' ORDER BY id DESC";
		$ketqua = getdata($sql);
		return $ketqua;
	}
	public function kthd($mahd) {
		$sql = "SELECT * FROM hoadon WHERE SHD = $mahd";
		$ketqua = getdata($sql);
		return $ketqua;
	}
	public function rating($idus=null, $idsp=null, $exist=null, $rate=null, $old_rt=null) {
		if (!isset($exist)) {
			$sql = "SELECT * FROM turnrt WHERE idus = $idus AND idsp = $idsp";
			$ketqua = getdata($sql);
			return $ketqua;
		}
		else if ($exist == "plus") {
			$sql = "INSERT INTO turnrt VALUES('','$idus','$idsp','$rate')";
			iuddata($sql);

			$sql = "SELECT * FROM rating WHERE idsp = $idsp";
			$ketqua = getdata($sql);

			if (!isset($ketqua[0])) {
				$sql = "INSERT INTO rating VALUES('','$idsp','$rate',1)";
				iuddata($sql);
			}
			else {
				$sql = "UPDATE rating SET stars = stars + $rate, turn = turn + 1 WHERE idsp = $idsp";
				iuddata($sql);
			}
		}
		else if ($exist == "rert") {
			$sql = "UPDATE turnrt SET stars = $rate";
			iuddata($sql);
			$sql = "UPDATE rating SET stars = stars - $old_rt + $rate WHERE idsp = $idsp";
			iuddata($sql);
		}
	}
	public function getrate($idus=null, $idsp=null) {
		if (isset($idus)) {
			$sql = "SELECT * FROM turnrt WHERE idus = $idus AND idsp = $idsp";
			return getdata($sql);
		}
		else {
			$sql = "SELECT * FROM rating WHERE idsp = $idsp";
			return getdata($sql);
		}
	}
	public function getsp($type=null,$data=null,$page,$sapxep) {
		$vitri = ($page*9)-9;
		$order= "";

		if(isset($sapxep)) {
			if ($sapxep == 1) $order = "ORDER BY id ASC";
			else if ($sapxep == 2) $order = "ORDER BY id DESC";
			else if ($sapxep == 3) $order = "ORDER BY price ASC";
			else if ($sapxep == 4) $order = "ORDER BY price DESC";
		}
		else $order = "";
			

		if ($type == "sanpham/tatca") $sql = "SELECT * FROM product WHERE hidden = 0 $order LIMIT $vitri,9";
		else if ($type == "sanpham/danhmuc") $sql = "SELECT * FROM product WHERE hidden = 0 AND  id_cata = $data $order LIMIT $vitri,9";
		else if ($type == "sanpham/timkiem") $sql = "SELECT * FROM product WHERE hidden = 0 AND  name like \"%$data%\" $order LIMIT $vitri,9";
		else if ($type == "sanpham/phanloai")$sql = "SELECT * FROM product WHERE hidden = 0 AND id IN (
														SELECT sp.id FROM phanloai pl INNER JOIN catalog cat INNER JOIN product sp
														ON pl.id = cat.loai AND sp.id_cata = cat.id
														WHERE pl.id = $data
													) $order LIMIT $vitri,9";

		$ketqua = getdata($sql);
		return $ketqua;
	}
	public function phantrang($iddm=null,$chuoitk=null,$idpl=null) {
		if (isset($iddm)) $sql = "SELECT CEILING(COUNT(*)/9) as pt FROM product WHERE id_cata = $iddm";
		else if (isset($chuoitk)) $sql = "SELECT CEILING(COUNT(*)/9) as pt FROM product WHERE name like  '%$chuoitk%'";
		else if (isset($idpl)) $sql = "SELECT CEILING(COUNT(*)/9) as pt
								FROM phanloai pl INNER JOIN catalog cat INNER JOIN product sp
								ON pl.id = cat.loai AND sp.id_cata = cat.id
								WHERE pl.id = $idpl";
		else {$sql = "SELECT CEILING(COUNT(*)/9) as pt FROM product";}

		$ketqua = getdata($sql);
		return $ketqua;
	}
	public function chitietsp($id) {
		$sql = "SELECT * FROM product WHERE id = $id AND hidden = 0";
		$ketqua = getdata($sql);
		$sql = "UPDATE product SET viewed = viewed + 1 WHERE id = $id";
		iuddata($sql);
		return $ketqua;
	}
	public function splq($idcata) {
		$sql = "SELECT * FROM product WHERE id_cata = $idcata AND hidden = 0 LIMIT 4";
		$ketqua = getdata($sql);
		return $ketqua;
	}
	public function thuonghieu($brand) {
		$sql = "SELECT name FROM brand WHERE id_brand = $brand";
		$ketqua = getdata($sql);
		return $ketqua;
	}
	public function dscmt($id) {
		$sql = "SELECT * FROM comments INNER JOIN user WHERE comments.id_user = user.id AND id_pd = $id ORDER BY date DESC";
		$ketqua = getdata($sql);
		return $ketqua;
	}
	public function addcmt($noidung, $spid, $uid, $ngay) {
		$sql = "INSERT INTO comments VALUES ('','$noidung','$spid','$uid','$ngay')";
		iuddata($sql);
	}
	public function checkuser() {
		$sql = 'SELECT * FROM user WHERE role = 1';
		$ketqua = getdata($sql);
		return $ketqua;
	}
	public function checkmgg($mgg) {
		$sql = "SELECT * FROM voucher WHERE name = '$mgg'";
		return getdata($sql);
	}
	public function divineMGG($name) {
		$sql = "UPDATE voucher SET remaining = remaining - 1 WHERE name = '$name'";
		iuddata($sql);
	}
	public function getuser($name) {
		$sql = "SELECT * FROM user where user = '$name'";
		$ketqua = getdata($sql);
		return $ketqua;
	}
	public function spcart($id) {
		$sql = "SELECT * FROM product WHERE id = $id AND hidden = 0";
		$ketqua = getdata($sql);
		return $ketqua;
	}
	public function regis($name,$pass,$ho,$ten,$sdt,$email,$diachi) {
		$sql = "INSERT INTO user VALUES ('','$name','$pass','$ho','$ten','$sdt','$email','$diachi','1','','1')";
		iuddata($sql);
	}
	public function updatetk($id,$ho,$ten,$sdt,$email,$diachi){
		$sql="UPDATE user SET 
			ho = '$ho', 
			ten = '$ten', 
			sdt = '$sdt', 
			email = '$email', 
			diachi = '$diachi'
			WHERE id = $id
		";
		iuddata($sql);
	}
	public function doimatkhau($id,$pass){
		$sql="UPDATE user SET pass = '$pass'WHERE id = $id";
		iuddata($sql);
	}
	public function hoadon($ten,$email,$sdt,$dc,$dssp,$thanhtien,$date,$mxn,$mgg,$thanhtien2) {
		$sql = "INSERT INTO hoadon VALUES('','$ten','$sdt','$email','$dc','$dssp','$thanhtien','Chờ Xác Nhận','$date','','$mxn','$mgg','$thanhtien2')";
		iuddata($sql);
	}
} ?>