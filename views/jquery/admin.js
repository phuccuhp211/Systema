$(function() {
	var ccmh = $(window).height();
	var cdmh = $(window).width();
	//var duongdan = window.location.href;
	var duongdan = window.location.origin;
	var url_sub = "/DA1/systema"; 
	//var duongdan_fix = duongdan.replace(/(\/systema\/).*/, "$1"+"ktbh/");

	tinymce.init({
        selector: '#ttct-sp',
        plugins: 'image link',
        toolbar: 'undo redo | bold italic | image link',
        height: '250px',
        image_caption: true
    });

	$(window).resize(function() {
		ccmh = $(window).height();
		cdmh = $(window).width();
	})
	console.log(ccmh , cdmh);

	$('.bg-admin-log').height(ccmh);

/*-------------------- BACK --------------------*/
	$('.them').on('click', function() { $('.bg-add').removeClass('hide-bg-add'); })
	$('.sua').on('click', function() { $('.bg-fix').removeClass('hide-bg-fix'); })
	$('.xoa').on('click', function() { $('.bg-del').removeClass('hide-bg-del'); })
	$('.qlai').on('click', function() { $('.bg-inf').addClass('hide-bg-inf'); })
	$('.quaylai').on('click', function() {
		$('.bg-add').addClass('hide-bg-add');
		$('.bg-fix').addClass('hide-bg-fix');
		$('.bg-del').addClass('hide-bg-del');
		$('.bg-err').addClass('hide-bg-add-err');
	})
	$('.chitiet').on('click', function() {
		var id_sp_cmt = $(this).data('idbl');
		var duongdan = window.location.href;
		var duongdan_fix = duongdan+url_sub+"/inf_cmt/";
		$.ajax({
			type: "POST",
			url: duongdan_fix,
			data: { spcmt: id_sp_cmt },
			success: function(data) {
				show_cmt(data);
				data = "";
			},
			error: function() {
				console.log("Có lỗi xảy ra khi lấy DSBL.");
			}
		})
		console.log(id_sp_cmt);
		$('.bg-inf').removeClass('hide-bg-inf');
	})
/*-------------------- BACK --------------------*/

	var id_sp_fix = 0;
	var id_sp_del = 0;
	var id_dm_fix = 0;
	var id_dm_del = 0;
	var id_pl_fix = 0;
	var id_pl_del = 0;
	var id_us_fix = 0;
	var id_us_del = 0;
	var id_bl_del = 0;

	$('.suasp').on('click', function() {
		id_sp_fix = $(this).data('idsp');
		var duongdan_fix = duongdan+url_sub+"/fixpro/"+id_sp_fix+"/";
		var ae_td = $(this).parent().siblings("td:has(img)");

		var old_name = $(this).parent().siblings("#tensp").text();
		var old_info = $(this).parent().siblings("#in4sp").text();
		var old_price_str = $(this).parent().siblings("#giasp").text();
		var old_sale_str = $(this).parent().siblings("#salesp").text();
		var old_img = ae_td.find("img").attr("src");

		var old_price = parseInt(old_price_str.replace(/\./g, '').replace('.', ''));
		var old_sale = parseInt(old_sale_str.replace(/\./g, '').replace('.', ''));

		$('#fix_img_sp').val(old_img);
		$('#fix_name_sp').val(old_name);
		$('#fix_price_sp').val(old_price);
		$('#fix_sale_sp').val(old_sale);
		$('#fix_info_sp').val(old_info);


		$('#form_fix_pro').attr("action", duongdan_fix);
		console.log(old_price);
	})
	$('.xoasp').on('click', function() {
		id_sp_del = $(this).data('idsp');
		var duongdan_del = duongdan+url_sub+"/delpro/"+id_sp_del+"/";
		$('#acp-del').attr("href", duongdan_del);
		console.log(id_sp_del);
	})
	$('.suadm').on('click', function() {
		id_dm_fix = $(this).data('iddm');
		var duongdan_fix = duongdan+url_sub+"/fixcat/"+id_dm_fix+"/";
		var ae_td = $(this).parent().siblings("td:has(img)");
		var pldm = $(this).parent().siblings("#pldm").text();
		var old_name = $(this).parent().siblings("#tendm").text();
		var old_img = ae_td.find("img").attr("src");

		$('#fix_img_dm').val(old_img);
		$('#fix_name_dm').val(old_name);
		$('#fix_name_pldm').val(pldm);
		$('#fix_name_pl').val("");

		$('#form_fix_cat').attr("action", duongdan_fix);
	})
	$('.xoadm').on('click', function() {
		id_dm_del = $(this).data('iddm');
		var duongdan_del = duongdan+url_sub+"/delcat/"+id_dm_del+"/";
		$('#acp-del').attr("href", duongdan_del);
		console.log(id_sp_del);
	})
	$('.suapl').on('click', function() {
		id_pl_fix = $(this).data('idpl');
		var duongdan_fix = duongdan+url_sub+"/fixpl/"+id_pl_fix+"/";

		var old_name = $(this).parent().siblings("#tenpl").text();

		$('#fix_name_pl').val(old_name);
		$('#fix_name_pldm').val("");
		$('#fix_name_dm').val("");

		$('#form_fix_pl').attr("action", duongdan_fix);
	})
	$('.xoapl').on('click', function() {
		id_pl_del = $(this).data('idpl');
		var duongdan_del = duongdan+url_sub+"/delpl/"+id_pl_del+"/";
		$('#acp-del').attr("href", duongdan_del);
		console.log(id_sp_del);
	})
	$('.suaus').on('click', function() {
		id_us_fix = $(this).data('idus');
		var duongdan_fix = duongdan+url_sub+"/fixus/"+id_us_fix+"/";

		var old_name = $(this).parent().siblings("#tenus").text();
		var old_sdt = $(this).parent().siblings("#sdtus").text();
		var old_email = $(this).parent().siblings("#emailus").text();
		var old_role = $(this).parent().siblings("#roleus").text();

		$('#name_fix_us').val(old_name);
		$('#phone_fix_us').val(old_sdt);
		$('#email_fix_us').val(old_email);

		if(old_role == 0) {
			$("#role_fix_us option[value='0']").prop("selected", true);
		}
		if(old_role == 1) {
			$("#role_fix_us option[value='1']").prop("selected", true);
		}


		$('#form_fix_us').attr("action", duongdan_fix);
	})
	$('.xoaus').on('click', function() {
		id_us_del = $(this).data('idus');
		var duongdan_del = duongdan+url_sub+"/delus/"+id_us_del+"/";
		$('#acp-del').attr("href", duongdan_del);
		console.log(id_sp_del);
	})
	$('.ban').on('click', function() {
		if ($(this).hasClass('banus')) {
			$(this).find("i").removeClass('fa-ban').addClass('fa-check');
			$(this).removeClass('btn-warning banus').addClass('btn-success unbanus');
			$('.popup-small').find("span").text("Đã Khóa Tài Khoản");
			$('.popup-small').find("i").removeClass('fa-check');
			if(!$('.popup-small').find("i").hasClass('fa-ban')) $('.popup-small').find("i").addClass('fa-ban');
		}
		else {
			$(this).find("i").removeClass('fa-check').addClass('fa-ban');
			$(this).removeClass('btn-success unbanus').addClass('btn-warning banus');
			$('.popup-small').find("span").text("Đã Mở Khóa Tài Khoản");
			$('.popup-small').find("i").removeClass('fa-ban');
			if(!$('.popup-small').find("i").hasClass('fa-check')) $('.popup-small').find("i").addClass('fa-check');
		}

		var idtk = $(this).data('idus');
		var duongdan_fix = duongdan+url_sub+"/banus/"+idtk+"/";
		$.ajax({
			type: "POST",
			url: duongdan_fix,
			data: { idtk: idtk },
			success: function(response) {
				console.log('thanh cong');
			},
			error: function() {
				console.log("Có lỗi xảy ra.");
			}
		});

		$('.popup-small').removeClass('hide-popup');
		setTimeout(function() {$('.popup-small').addClass('hide-popup');},1000);
	})

	$(document).on('click', '.hd-update', function() {
		var trangthai = $(this).siblings("select").val();
		var id = $(this).parent().siblings(".id-hd").text();
		var duongdan_fix = duongdan+url_sub+"/hdup/";

		$(this).parent().siblings(".stt-hd").text(trangthai);
		console.log(trangthai+" "+id);
		$.ajax({
			type: "POST",
			url: duongdan_fix,
			data: {id: id, stt: trangthai},
			success: function(response) {

			},
			error: function() {

			}
		});
	})
	$('.boloc').on('click', '.btn-boloc', function() {
		var boloc = $(this).attr("boloc");
		var duongdan_fix = duongdan+url_sub+"/hdup/";
		$.ajax({
			type: "POST",
			url: duongdan_fix,
			data: {boloc: boloc},
			success: function(data) {
				$('.show-data').find('.hoadon').remove();
				$('.show-data').append(data);
			},
			error: function() {
				console.log("Có lỗi xảy ra");
			}
		});
	})
	$(document).on('click', '.xoabl', function() {
		$('.bg-del').removeClass('hide-bg-del');
		id_bl_del = $(this).data('idbl');
		var duongdan_del = duongdan+url_sub+"/delbl/"+id_bl_del+"/";
		$('#acp-del').attr("href", duongdan_del);
		console.log(id_sp_del);
	})

	function show_cmt(data) {
		var dulieu = JSON.parse(data);
		var noidung = "";
		$(".tr-bl").remove();
		for (var i = 0; i < dulieu.length; i++) {
			noidung += `
			<tr class="tr-bl">
				<td>${dulieu[i].noidung}</td>
				<td>${dulieu[i].id_user}</td>
				<td>${dulieu[i].date}</td>
				<td><button class="btn btn-danger suaxoa xoabl" data-idbl="${dulieu[i].id_cmt}"><i class="fa-solid fa-trash"></i></button></td>
			</tr>
			`;
		}
		$('#list-bl-start').append(noidung);
	}

	if($("#bieudo").length > 0) {
	    var qweqwe = document.getElementsByClassName("dsdm-ten");
		var xArray = [];
		var yArray = [];
		for (var i = 0; i < qweqwe.length; i++) {
			xArray[i] = qweqwe[i].innerHTML;
			yArray[i] = $(qweqwe[i]).data('soluong');
		}
		var layout = {title:"Thống kê các loại sản phẩm"};
		var data = [{labels:xArray, values:yArray, type:"pie"}];
		Plotly.newPlot("bieudo", data, layout);
	}	
})