<?php 
	function getdata($sql) {
		global $ketnoi;
		$data_args = array_slice(func_get_args(), 1);
		$data = $ketnoi->prepare($sql);
		$data->execute($data_args);
		$row = $data->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}

	function iuddata($sql) {
		global $ketnoi;
		$data_args = array_slice(func_get_args(), 1);
		$data = $ketnoi->prepare($sql);
		$data->execute($data_args);
	}

	function showsp($mangsp) {
		$chuoisp = "";
	    foreach ($mangsp as $value => $item) {
	    	if ($item['price_sale'] != 0) { 
	    		$sale ="
	    			<span>"
	    				.number_format($item['price'],0,",",".")."
	    			</span>"
	    			.number_format($item['price_sale'],0,",",".");
	    	}
	    	else { $sale = number_format($item['price']);}
	    	$chuoisp.= "
	    	<div class=\"col-xs-6 col-sm-6 col-md-6 col-lg-3 col-12 text-center\">
                <div class=\"khungsp\">
                    <div class=\"khungxam nav-item\">
                        <a href=\"".urlmd."/sanpham/chitiet=".$item['id']."/\" class=\"nav-link\">
                        	<img src=\"".$item['img']."\" class=\"anhsp nav-link\" alt=\"\">
                        </a>                               
                    </div>                                
                    <p class=\"tt tensp\">".$item['name']."</p>
                    <p class=\"tt giasp\">".$sale."</p>
                    <div class=\"nut_sp\">
                        <a href=\"".urlmd."/muangay/".$item['id']."/\" class=\"btn nutsp\">Mua Ngay</a>
                        <button class=\"btn nutsp addcart\" data-idsp=\"".$item['id']."\"><i class=\"fa-solid fa-cart-plus\"></i></button>
                    </div>
                </div>                    
            </div>";
	    }
	    return $chuoisp;
	}

	function showsp2($mangsp) {
		$chuoisp = "";
	    foreach ($mangsp as $value => $item) {
	    	if ($item['price_sale'] != 0) { 
	    		$sale ="
	    			<span>"
	    				.number_format($item['price'],0,",",".")."
	    			</span>"
	    			.number_format($item['price_sale'],0,",",".");
	    	}
	    	else { $sale = number_format($item['price']);}
	    	$chuoisp.= "
	    	<div class=\"col-xs-6 col-sm-6 col-md-6 col-lg-4 col-12 text-center\">
                <div class=\"khungsp\">
                    <div class=\"khungxam nav-item\">
                        <a href=\"".urlmd."/sanpham/chitiet=".$item['id']."/\" class=\"nav-link\">
                        	<img src=\"".$item['img']."\" class=\"anhsp nav-link\" alt=\"\">
                        </a>                               
                    </div>                                
                    <p class=\"tt tensp\">".$item['name']."</p>
                    <p class=\"tt giasp\">".$sale."</p>
                    <div class=\"nut_sp\">
                        <a href=\"".urlmd."/muangay/".$item['id']."/\" class=\"btn nutsp\">Mua Ngay</a>
                        <button class=\"btn nutsp addcart\" data-idsp=\"".$item['id']."\"><i class=\"fa-solid fa-cart-plus\"></i></button>
                    </div>
                </div>                    
            </div>";
	    }
	    return $chuoisp;
	}
?>