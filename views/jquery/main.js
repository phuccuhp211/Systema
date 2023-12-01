$(function() {
	var chieucao=0;
	var chieucao_cu = 0;
	//var duongdan = window.location.href;
	var duongdan = window.location.origin;
	var url_sub = "/DA1/systema";
	//var duongdan_fix = duongdan.replace(/(\/systema\/).*/, "$1"+"ktbh/");

	$(document).ready(function () {
	  $('#carousel-id').carousel();
	});

	function reset_cc() {
		$(".tensp").each(function() {
			chieucao = $(this).height();
			if (chieucao > chieucao_cu) {
			  chieucao_cu = chieucao;
			}
		});
		$(".tensp").height(chieucao_cu);
	}

	reset_cc();

	var cc_gia_sp = $('.giasp').height();
	$('.giasp').find("span").css({"line-height":cc_gia_sp+"px"});

	$(".tensp").height(chieucao_cu);
	console.log(chieucao_cu);

	$('.users').on('click', function() {$('.bg-dndk').removeClass('hide-bg-dndk');})
	$('.cf-dmk').on('click', function() {$('.bg-dmk').removeClass('hide-bg-dmk');})
	$('.ycdn-cmt').on('click', function() {$('.bg-dndk').removeClass('hide-bg-dndk');})
	$('.quaylai-dndk').on('click', function() {$('.bg-dndk').addClass('hide-bg-dndk');})
	$('.quaylai-dndk').on('click', function() {$('.bg-dndk-err').addClass('hide-bg-dndk-err');})
	$('.quaylai-dmk').on('click', function() {$('.bg-dmk').addClass('hide-bg-dmk');})
	$('.users2').on('click', function() {$('.bg-dndk2').removeClass('hide-bg-dndk2');})
	$('.quaylai-dndk2').on('click', function() {$('.bg-dndk2').addClass('hide-bg-dndk2');})

	$('.send-cmt').on('submit', function(event) {
		event.preventDefault();
		var ho = document.getElementById("uho").innerHTML;
		var ten = document.getElementById("uten").innerHTML;
		var idu = document.getElementById("uid").innerHTML;
		var idsp = $('#uidsp').data('idsp');
		var nd = $('#noidung-cmt').val();

		var d = new Date();
		var time = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();

		console.log(time);

		var duongdan_fix = duongdan+url_sub+"/comments/";

		$.ajax({
			type: "POST",
			url: duongdan_fix,
			data: {
				noidung: nd,
				idpd: idsp,
				idu: idu,
				date: time
			},
			success: function(response) {
				console.log('thanh cong');
			},
			error: function() {
				console.log("Có lỗi xảy ra khi comments.");
			}
		})

		binhluan = `
		<div class="box-cmt">
            <div class="row" style="margin:0;">
                <div class="avatar">
                    <h5 class="avt-text">${ten.charAt(0)}</h5>
                </div>
                <div class="user-cmt">
                    <p class="uname-cmt">${ho} ${ten}</p>
                    <p class="date-cmt">${d.getDate() + "-" + (d.getMonth()+1) + "-" + d.getFullYear()}</p>
                </div>
            </div>
            <div class="content-cmt">
                <p>${nd}</p>
            </div>
        </div><hr>
		`;

		$('.list-cmt').prepend(binhluan);
	})


	/* Chịu trách nhiệm về giỏ hàng*/
	$('#list-sanpham').on('click', '.addcart', function() {
		ttgh();
		var idsp = $(this).data('idsp');
		console.log(idsp);
		var duongdan_fix = duongdan+url_sub+"/addcart/";
		$.ajax({
			type: "POST",
			url: duongdan_fix,
			data: { idsp: idsp },
			success: function(response) {
				console.log('thanh cong');
			},
			error: function() {
				console.log("Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng.");
			}
		});
	})
	$('#sp-tt').on('click', '.addcart', function() {
		ttgh();
		var idsp = $(this).data('idsp');
		var sl = $('.ctsp-sl').val();
		console.log(idsp);
		var duongdan_fix = duongdan+url_sub+"/addcart/";
		$.ajax({
			type: "POST",
			url: duongdan_fix,
			data: { idsp: idsp, slsp: sl },
			success: function(response) {
				console.log('thanh cong');
			},
			error: function() {
				console.log("Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng.");
			}
		});
	})
	slsp = document.getElementsByName('slsp');
	full_sldssp = document.getElementsByName('sanpham');
	$(window).on('load' ,function() {
		slsp = document.getElementsByName('slsp');
		full_sldssp = document.getElementsByName('sanpham');
		var duongdan_fix = duongdan+url_sub+"/updatecart/";
		for (var j=0; j<slsp.length; j++) {
			var quantity = parseInt($(slsp)[j].value);
			var price = parseInt($(slsp[j]).parent().siblings("#giasp").text().replace(/\./g, ''));
			var total = quantity * price;
			$(slsp[j]).parent().siblings("#thanhtien").text(total.toLocaleString('vi-VN'));
			totalp = updateTT();
			$.ajax({
				type: "POST",
				url: duongdan_fix,
				data: { totalp: totalp },
				success: function(response) {
					console.log("thanh cong");
				},
				error: function() {
					console.log("Có lỗi xảy ra.");
				}
			});
		}
	})
	for (var j=0; j<slsp.length; j++) {
		slsp[j].addEventListener('change', function() {
			var duongdan_fix = duongdan+url_sub+"/updatecart/";
			quantity = parseInt(this.value);
			keysp = parseInt($(this).parent().siblings("#keysp").text());
			price = parseInt($(this).parent().siblings("#giasp").text().replace(/\./g, ''));
			total = quantity * price;
			$(this).parent().siblings("#thanhtien").text(total.toLocaleString('vi-VN'));
			totalp = updateTT();

			$.ajax({
				type: "POST",
				url: duongdan_fix,
				data: { quantity: quantity, keysp: keysp, total: total, totalp: totalp },
				success: function(response) {
					console.log("thanh cong");
				},
				error: function() {
					console.log("Có lỗi xảy ra.");
				}
			});
		});
	}
	function updateCart() {
		var totalp = updateTT();
		var duongdan_fix = duongdan+url_sub+"/updatecart/";
		$.ajax({
			type: "POST",
			url: duongdan_fix,
			data: { totalp: totalp },
			success: function(response) {
				console.log("thanh cong");
			},
			error: function() {
				console.log("Có lỗi xảy ra.");
			}
		});
	}
	function updateTT() {
		var totalPrice = 0;
    	for (var l=0; l<full_sldssp.length; l++) {
	        var itemPrice = parseInt($(full_sldssp[l]).find('#thanhtien').text().replace(/\./g, ''));
	        totalPrice += itemPrice;
    	}
    	$('#ttfn').text(totalPrice.toLocaleString('vi-VN'));
    	return totalPrice;
	}
	function ttgh() {
		$('.ttgh').removeClass('ttgh-hide');
		setTimeout(function() {
	    	$('.ttgh').addClass('ttgh-hide');
	  	}, 1000);
	}
	var xoasp = document.getElementsByName('xoasp');
  	for (var k=0; k<xoasp.length; k++) {
	    xoasp[k].addEventListener('click', function() {
	    	var duongdan_fix = duongdan+url_sub+"/delcart/";
	    	$(this).closest('tr').remove();
	    	var delspcart = $(this).data('idsp');
	    	updateTT();
	    	$.ajax({
				type: "POST",
				url: duongdan_fix,
				data: { delspcart: delspcart },
				success: function(response) {
					updateCart();
				},
				error: function() {
					console.log("Có lỗi xảy ra.");
				}
			});
	    });
	}
	$('.delallcart').on('click', function() {
		$(this).parent().parent().siblings("div:has(table)").find('td').remove();
		var emtycart = `<tr id="emptycart"><th colspan="7">Bạn không có sản phẩm nào trong giỏ hàng</th></tr>`;
		if(!$('#listcart').find('#emtycart')) {
			$('#listcart').append(emtycart);	
		}

		var duongdan_fix = duongdan+url_sub+"/delallcart/";

		$.ajax({
			type: "POST",
			url: duongdan_fix,
			success: function(response) {
				console.log('thanh cong');
			},
			error: function() {
				console.log("Có lỗi xảy ra.");
			}
		});
		console.log('asdsd');
	})
	/* --------------------------- */



	/* Chịu trách nhiệm chuyển trang*/
	$('.boloc-act').on('click', function() {
		var randomParam = Math.random().toString(36).substring(7);
		var data_type = $(this).attr("data-type");
		var dulieu = $(this).attr("data");
		var phanloai = $(this).attr("data-phanloai");

		var duongdan_fix = duongdan+url_sub+`/${data_type}${dulieu ? `=${dulieu}` : ''}/`;
		var data_trave = {
			xacthuc2: randomParam,
	        type: data_type,
	        loai: phanloai
		}

		if (dulieu) data_trave.data = dulieu;

		console.log(data_type+" "+(dulieu ? dulieu : "dl_null")+" "+phanloai);

		$.ajax({
	        type: "POST",
	        url: duongdan_fix,
	        dataType: 'json',
	        data: data_trave,
	        success: function(data) {
	            $('#list-sanpham').html(data.sanpham);
	            $('#list-pt').html(data.phantrang);
	            console.log(data);
	            reset_cc();
	        },
	        error: function() {
	            console.log("Có lỗi xảy ra.");
	        }
	    });
	})
	$('#list-pt').on('click', '.a-pt', function() {
		var randomParam = Math.random().toString(36).substring(7);
		var data_type = $(this).attr('data-type');
		var data = $(this).attr('data');
		var page = $(this).attr('page');
		var phanloai = $(this).attr('type');

		var duongdan_fix = duongdanduongdan+url_sub+`/${data_type}${data ? `=${data}` : ''}/page=${page}/`;

		var requestData = { type: data_type };
		
	    if (data) requestData.data = data;

	    if (phanloai) {
	    	requestData.loai = phanloai;
	    	requestData.xacthuc2 = randomParam;
	    }
	    else {
	    	requestData.loai = phanloai;
	    	requestData.xacthuc1 = randomParam;
	    }

	    console.log(data_type+" "+(data ? data : "data_null")+" "+page+" "+(phanloai ? phanloai : "loai_null"));

		$.ajax({
	        type: "POST",
	        url: duongdan_fix,
	        dataType: phanloai ? 'json' : null,
	        data: requestData,
	        success: function(data) {
	            $('#list-sanpham').html(phanloai ? data.sanpham : data);
	            reset_cc();
	        },
	        error: function() {
	            console.log("Có lỗi xảy ra.");
	        }
	    });
	})
	/* ---------------------------- */



	/* Chịu trách nhiệm xử lý menu & list DM*/
	var h_mnc2 = $('.menu-cap2').height();
	$('.menu-cap3').css({"min-height":h_mnc2});
	var w_mnc2 = $('.menu-cap2').width();
	$('.menu-cap3').css({"min-width":w_mnc2});

	$("#show-dmsp").on('mouseover', function() {
		$(this).css({"background":"#392b5c","padding":"18px 25px","margin":"0"});
		$('.menu-cap2').addClass('show-mnmn');
	})
	$("#show-dmsp").on('mouseout', function() {
		$(this).css({"background":"#6246A8","padding":"8px 15px","margin":"10px"});
		$('.menu-cap2').removeClass('show-mnmn');
	})
	$(".menu-cap2").on('mouseover', function() {
		$('.menu-cap2').addClass('show-mnmn');
		$('#show-dmsp').css({"background":"#392b5c","color":"white","padding":"18px 25px","margin":"0"});
	})
	$(".menu-cap2").on('mouseout', function() {
		$('.menu-cap2').removeClass('show-mnmn');
		$('#show-dmsp').css({"background":"#6246A8","color":"white","padding":"8px 15px","margin":"10px"});
	})
	$(".menu-cap3").on('mouseover', function() {
		$(this).siblings("li").find('a').addClass('a-mnmn-hv');
		$('.menu-cap2').addClass('show-mnmn');
		$('#show-dmsp').css({"background":"#392b5c","color":"white","padding":"18px 25px","margin":"0"});
	})
	$(".menu-cap3").on('mouseout', function() {
		$(this).siblings("li").find('a').removeClass('a-mnmn-hv');
		$('.menu-cap2').removeClass('show-mnmn');
		$('#show-dmsp').css({"background":"#6246A8","color":"white","padding":"8px 15px","margin":"10px"});
	})
	$(".li-mnmn").on('mouseover', function() {
		$(this).find("a").addClass('a-mnmn-hv');
	})
	$(".li-mnmn").on('mouseout', function() {
		$(this).find("a").removeClass('a-mnmn-hv');
	})
	$(".show-list-btn").on('click', function() {
	    var listCap2 = $(this).siblings(".list-cap2");
	    if (listCap2.is(":visible")) {
	        listCap2.slideUp(400,'linear');
	        $(this).text("+");
	    } else {
	        listCap2.slideDown(400,'linear');
	        $(this).text("-");
	    }
	});
	/* -------------------------- */



	/* Chịu trách nhiệm Config */
	if ($('.box-qltk').length > 0) {
		var id = $('.cf-id').text();
		var old_ho = $('.cf-ho').text();
		var old_ten = $('.cf-ten').text();
		var old_sdt = $('.cf-sdt').text();
		var old_email = $('.cf-mail').text();
		var old_dc = $('.cf-dc').text();
		var check_on = 0;

		var ho_new=""; var ten_new=""; var sdt_new=""; var email_new=""; var dc_new="";

		$('.config_all').on('keyup', function() {
		    ho_new = $('.config_ho').val();
		    ten_new = $('.config_ten').val();
		    sdt_new = $('.config_sdt').val();
		    email_new = $('.config_mail').val();
		    dc_new = $('.config_diachi').val();
		    checkChanges();
		})

		function checkChanges() {
		    if (ho_new == old_ho && ten_new == old_ten && sdt_new == old_sdt && email_new == old_email && dc_new == old_dc) $('.cf-update').addClass('disabled');
		    else $('.cf-update').removeClass('disabled');
		}

		var duongdan_fix1 = duongdan+url_sub+"/updatetk/";
		var duongdan_fix2 = duongdan+url_sub+"/config/";

		$('.cf-update').on('click',function() {

			$.ajax({
				type: "POST",
				url: duongdan_fix1+id+"/",
				data: {
					ho: ho_new,
					ten: ten_new,
					sdt: sdt_new,
					email: email_new,
					diachi: dc_new
				},
				success: function(response) {
					console.log('thanh cong');
					window.location.href = duongdan_fix2;
				},
				error: function() {
					console.log("Có lỗi xảy ra khi update.");
				}
			})
		})
	}

	var cd_slide = $('.cf-slide').width();
	$('.box-qltk').width(cd_slide);
	$('.box-lsmh').width(cd_slide);

	var cr_slide = $('.box-qltk').height();
	$('.cf-slide').css({"height":cr_slide});

	$('.his-mh').on('click', function() {
		$(this).addClass('btn-hidden');
		$('.box-qltk').addClass('cf-left');
		$('.cf-acc').removeClass('btn-hidden');

		var cr_slide2 = $('.box-lsmh').height();
		$('.cf-slide').css({"height":"auto"});
	})
	$('.cf-acc').on('click', function() {
		$(this).addClass('btn-hidden');
		$('.box-qltk').removeClass('cf-left');
		$('.his-mh').removeClass('btn-hidden');

		var cr_slide2 = $('.box-qltk').height();
		$('.cf-slide').css({"height":cr_slide2});
	})
	/* -------------------------- */



	var stt_ml = 0;
	var cc_tt = 0;
	
	if ($('.ttct-sp').height() > 499 ) {
		cc_tt = $('.ttct-sp').height();
		$('.ttct-sp').height(500);
	}

	$('.more-less').on('click', function() {
		if (stt_ml == 0 ) {
			$('.ttct-sp').height(cc_tt);
			stt_ml = 1;
			$('.more-less').text('Thu gọn');
		}
		else if (stt_ml == 1 ) {
			$('.ttct-sp').height(500);
			$('html, body').animate({scrollTop: $('.phan-tt-duoi').offset().top},500);
			stt_ml = 0;
			$('.more-less').text('Xem thêm');
		}
	})

	$('.thanhtoansp').on('click', function() {
		if ($('#tenkh').val() == "" ||
			$('#emailkh').val() == "" ||
			$('#sdtkh').val() == "" ||
			$('#dckh').val() == "") {
			alert("vui lòng điển đầy đủ thông tin khách hàng!");
		}
		else if ($('#sdtkh').val().length != 10) {
			alert("Số điện thoại không hợp lệ");
		}
		else if ($('#tenkh').val() != "" && $('#emailkh').val() != "" && $('#sdtkh').val() != "" && $('#dckh').val() != "" && $('#sdtkh').val().length == 10) {
			var tenkh = $('#tenkh').val();
			var emailkh = $('#emailkh').val();
			var sdtkh = $('#sdtkh').val();
			var dckh = $('#dckh').val();
			var randomParam = Math.random().toString(36).substring(7);

			var duongdan_fix1 = duongdan+url_sub+"/sendmail/";
			var duongdan_fix2 = duongdan+url_sub+"/hoadon/";
			var duongdan_fix3 = duongdan+url_sub+"/hoantat/";

			var d = new Date();
			var gio1 = String((d.getHours()));
			var phut1 = String((d.getMinutes()));
			var giay1 = String((d.getSeconds()));

			if (gio1.length == 1) var gio2 = "0"+gio1;
			else gio2 = gio1;
			if (phut1.length == 1) var phut2 = "0"+phut1;
			else phut2 = phut1;
			if (giay1.length == 1) var giay2 = "0"+giay1;
			else giay2 = giay1;

			var mxn = String((sdtkh.substring(4, 10)))+gio2+phut2+giay2;
			var time = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();

			$.ajax({
				type: "POST",
				method: "POST",
				url: duongdan_fix1,
				data: { tenkh: tenkh, emailkh: emailkh, sdtkh: sdtkh, dckh: dckh, mxn: mxn, date:time, randomParam: randomParam },
				success: function(response) {
					$.ajax({
						type: "POST",
						method: "POST",
						url: duongdan_fix2,
						data: { tenkh: tenkh, emailkh: emailkh, sdtkh: sdtkh, dckh: dckh, mxn: mxn, date:time, randomParam: randomParam },
						success: function(response) {
							window.location.href = duongdan_fix3;
						},
						error: function() {
							console.log("Có lỗi xảy ra.");
						}
					});
				},
				error: function() {
					console.log("Có lỗi xảy ra.");
				}
			});
		}
	})

	$('#reset-session').on('click', function() {
		var duongdan_fix = duongdan+url_sub+"/reset/";
		var duongdan_fix2 = duongdan+url_sub+"/";

		$.ajax({
			type: "POST",
			url: duongdan_fix,
			success: function(response) {
				window.location.href = duongdan_fix2;
			},
			error: function() {
				console.log("Có lỗi xảy ra.");
			}
		});
	})

	$('.popup').on('click', function() {
		$('.popup').slideUp(1000);
	})

	$('.check-bh').on('click', function() {
		var mahd = $(this).siblings('#mahd').val();
		var error ="";
		if (mahd === "" || mahd.length < 12) {
			error = `<h3 class="popup popup-do" id="log-bh">Mã hóa đơn không hợp lệ</h3>`;
			if ($('.popup-do').length == 0) $('.baohanh').prepend(error);
			else {
				document.getElementById("log-bh").remove();
				$('.baohanh').prepend(error);
			}
		}
		else {
			var duongdan_fix = duongdan+url_sub+"/ktbh/";
			$.ajax({
		        type: "POST",
		        url: duongdan_fix,
		        //dataType: 'json',
		        data: {mahd: mahd},
		        success: function(data) {
		        	if (data === "false") {
		        		error = `<h3 class="popup popup-do" id="log-bh">Mã hóa đơn không tồn tại</h3>`;
						if ($('.popup-do').length == 0) $('.baohanh').prepend(error);
						else {
							document.getElementById("log-bh").remove();
							$('.baohanh').prepend(error);
						}
		        	}
		        	else $('#baohanh').html(data);
		        },
		        error: function() {
		            console.log("Có lỗi xảy ra.");
		        }
		    });
		}
	})
})