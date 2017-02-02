$(document).ready(function(){	
	/* - Deactive text submit on enter - */
	$(document).on('keyup keypress', 'form input[type="text"]', function(e) {
		if(e.which == 13) {
			e.preventDefault();
		}
	});	
	
	/* Copy to Clipboard */	
	var kode = $('span#mobile').text().substr(0, 2);
	if(kode=='62'){
		mobile = '0'.concat($('span#mobile').text().slice(2)); 
	}else{
		mobile = $('span#mobile').text();
	}
	$('a#copy-mobile').zclip({
		path:base_url+'/assets/zclip/ZeroClipboard.swf',
		copy:mobile
	});	
	var kode = $('span#tlp').text().substr(0, 2);
	if(kode=='62'){
		tlp = '0'.concat($('span#tlp').text().slice(2)); 
	}else{
		tlp = $('span#tlp').text();
	}
	$('a#copy-tlp').zclip({
		path:base_url+'/assets/zclip/ZeroClipboard.swf',
		copy:tlp
	});	
	
	//Tanggal
	$( ".tanggal" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'dd/mm/yy'
	});
	
	/* - Button Callhis - */
	$('body').on('click','.btn-callhis',function(event){
		$.ajax({
			url:$(this).attr('href')
			,type:'post'
			,success:function(str){
				$('.callhis-list').html(str);
			}
		});	
		event.preventDefault();	
	});
	
	/* - Send Email - */
	$('body').on('click','#btn-send-email',function(event){
		if(confirm('Are you sure')){
			$.ajax({
				url:$(this).attr('href')
				,data:{email:$('#new-email').val(),'fullname':$('#new-name').val()}
				,type:'post'
				,beforeSend: function () {
					$('.send-email-alert').html('<p>Please wait...</p>');
				}
				,success:function(str){
					$('.send-email-alert').html(str);
				}
			});	
		}
		event.preventDefault();	
	});
	
	/* Phone Interview */
	respon_1();
	$('#respon_1').change(function(){
		respon_1();
	});	
	function respon_1() {
		if($('#respon_1').val()==''){
			$('.respon_1').html('');
			$('.respon_2_wrap').hide();
		}else if($('#respon_1').val()==1){
			$('.respon_1').html(
				'<div class="alert alert-success"><p>Terima kasih bapak/ibu. (lanjutkan ke bagian selanjutnya)</p>'
				+'<p><i>Thank you Sir/Mdm. (proceed to probing question)</i></p></div>'
			);
			$('.respon_2_wrap').show();
		}else if($('#respon_1').val()==2){
			$('.respon_1').html(
				'<div class="alert alert-warning"><p>Ini tidak akan terlalu lama. Kami hanya ingin mengetahui apakah Anda telah terdaftar untuk acara mendatang kami pada bulan April. (jika prospek memberikan indikasi untuk melanjutkan dengan panggilan, pergi ke menyelidiki pertanyaan. Jika prospek menolak, membangun callback).</p>'
				+'<p><i>It will not take up too much of your time. We just want to find out if you have registered for our upcoming event in April. (if prospect gives indication to proceed with the call, go to probing question. If prospect refuses, establish a callback)</i></p></div>'
			);
			$('.respon_2_wrap').show();
		}else if($('#respon_1').val()==3){
			$('.respon_1').html(
				'<div class="alert alert-warning"><p>Mohon maaf mengganggu waktunya. Kapan waktu yang tepat untuk dapat kami hubungi kembali ?</p>'
				+'<p><i>I apologise for taking up your time. What is the best time to call you ?</i></p></div>'
			);
			$('.respon_2_wrap').hide();
		}
	}
	respon_2();
	$('#respon_2').change(function() {
		respon_2();
	});	
	function respon_2(){
		if($('#respon_2').val()==''){
			$('.respon_2').html('');
			$('.respon_2_1_wrap').hide();
		}else if($('#respon_2').val()==1){
			$('.respon_2').html(
				'<div class="alert alert-success"><p>Lanjutkan ke bagian selanjutnya</p>'
			);
			$('.respon_2_1_wrap').show();
		}else if($('#respon_2').val()==2){
			$('.respon_2').html(
				'<div class="alert alert-warning"><p>Dapatkah saya mengirimkan email undangan kehadiran MTA2015 bersama dengan informasi acara dan link untuk pra-pendaftaran secara online ? (Dapatkan alamat email) Silakan cek email anda dan saya akan mengirimkan segera. Terima kasih dan sampai jumpa. (End call) (Kirim Email).</p>'
				+'<p><i>(Give info about MTA) Can I email to you the invitation to attend MTA2015 along with the event information and a link to pre-register online? (Get email address) Please keep a look out for the email that I will be sending to you shortly. Thank you again and we look forward to see you. (End call) (Send Email)</i></p></div>'
			);
			$('.respon_2_1_wrap').hide();
		}else if($('#respon_2').val()==3){
			$('.respon_2').html(
				'<div class="alert alert-warning"><p>Tidak apa-apa. Terima kasih untuk waktunya sampai jumpa.</p>'
				+'<p><i>It’s alright. Thank you for your time & have a nice day.</i></p></div>'
			);
			$('.respon_2_1_wrap').hide();
		}
	}
	respon_2_1();
	$('#respon_2_1').change(function() {
		respon_2_1();
	});	
	function respon_2_1(){
		if($('#respon_2_1').val()==''){
			$('.respon_2_1').html('');
		}else if($('#respon_2_1').val()==1){
			$('.respon_2_1').html(
				'<div class="alert alert-success"><p>Terima kasih atas partisipasi dan waktunya. Sampai jumpa di acara tersebut! (Selesai)</p>'
				+'<p>Thank you for your support & time. See you at the event! (Completed)</p></div>'
			);
		}else if($('#respon_2_1').val()==2){
			$('.respon_2_1').html(
				'<div class="alert alert-warning"><p>Dapatkah saya mengirimkan email undangan kehadiran MTA2015 bersama dengan informasi acara dan link untuk pra-pendaftaran secara online ? (Dapatkan alamat email) Silakan cek email anda dan saya akan mengirimkan segera. Terima kasih dan sampai jumpa. (End call) (Kirim Email)</p>'
				+'<p><i>Can I email to you the invitation to attend MTA2015 along with the event information and a link to pre-register online? (Get email address) Please keep a look out for the email that I will be sending to you shortly. Thank you again and we look forward to see you. (End call) (Send Email) </i></p></div>'
			);
		}
	}
});