<ol class="breadcrumb">
	<li><?php echo anchor($breadcrumb,'Candidate');?></li>
	<li class="active">Phone Script</li>
</ol>
<div role="tabpanel">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#script" aria-controls="script" role="tab" data-toggle="tab">Phone Script</a></li>
		<li role="presentation"><a href="#product" aria-controls="product" role="tab" data-toggle="tab">Product Knowledge</a></li>
	</ul>
	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="script">
			<div class="row">
				<div class="col-md-9">
					<?php echo form_open($action);?>
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="form-inline">
								<?php echo form_input(array('name'=>'note','value'=>set_value('note',$candidate->note),'class'=>'form-control upper','autocomplete'=>'off','maxlength'=>'50','placeholder'=>'Note...'));?>
								<?php echo form_dropdown('status_phone',status_phone(),set_value('status_phone',$candidate->status_phone),'class="form-control"');?>
								<?php 
									if($this->template->get_level_user_login()==3){
										echo form_dropdown('status_data',array('-Status Data-'=>'','1'=>'ONPROSES','2'=>'VALID'),set_value('status_data',$candidate->status_data),'class="form-control"');
									}else{
										echo form_dropdown('status_data',status_data(),set_value('status_data',$candidate->status_data),'class="form-control"');
									}
								?>
								<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Save</button>
							</div>	
							<hr/>
							<p><?php echo greeting();?>, Nama saya <b><?php echo $this->template->get_fullname_user_login();?></b> dan saya mewakili Singapore Exhibition Services, penyelenggara MTA2017 - acara industri rekayasa presisi di Singapura. Bisa bicara dengan :
								<?php echo anchor('#greeting','<span class="glyphicon glyphicon-retweet"></span>',array('data-toggle'=>'collapse','aria-expanded'=>'false'));?>
							</p>
							<p class="collapse" id="greeting"><i>My name is <b><?php echo $this->template->get_fullname_user_login();?></b> and I am calling on behalf of Singapore Exhibitions Services, organizer of MTA – the precision engineering industry event in Singapore. May I speak with the :</i></p>
							<hr/>
							<div class="row">
								<div class="col-md-6">
									<div class="form-inline">
										<p><span class='contact'>Name</span> : <?php echo $candidate->fullname;?></p>
										<p><span class='contact'>Title</span> : <?php echo $candidate->title;?></p>
										<p><span class='contact'>Departement</span> : <?php echo $candidate->dept;?></p>
										<p><span class='contact'>Company</span> : <?php echo $candidate->co;?></p>
										<p><span class='contact'>Address</span> : <?php echo $candidate->add1;?></p>
										<p><span class='contact'>Mobile</span> : <span id="mobile"><?php echo $candidate->mobile;?></span> <a href="#" id="copy-mobile" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-phone-alt"></span></a></p>
										<p><span class='contact'>Telephone</span> : <span id="tlp"><?php echo $candidate->tlp;?></span> <a href="#" id="copy-tlp" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-phone-alt"></span></a></p>
									</div>
								</div>	
								<div class="col-md-6">
									<div class="form-inline">
										<p><span class='contact'>Name</span> : <?php echo form_input(array('name'=>'new_name','id'=>'new-name','value'=>set_value('new_name',$candidate->new_name),'class'=>'form-control upper','autocomplete'=>'off','maxlength'=>'50','size'=>'30'));?></p>
										<p><span class='contact'>Title</span> : <?php echo form_input(array('name'=>'new_title','value'=>set_value('new_title',$candidate->new_title),'class'=>'form-control upper','autocomplete'=>'off','maxlength'=>'50','size'=>'30'));?></p>
										<p><span class='contact'>Address</span> : <?php echo form_input(array('name'=>'new_add','value'=>set_value('new_add',$candidate->new_add),'class'=>'form-control upper','autocomplete'=>'off','maxlength'=>'100','size'=>'30'));?></p>
										<p><span class='contact'>Mobile</span> : <?php echo form_input(array('name'=>'new_mobile','value'=>set_value('new_mobile',$candidate->new_mobile),'class'=>'form-control','autocomplete'=>'off','maxlength'=>'50'));?></p>
										<p><span class='contact'>Telephone</span> : <?php echo form_input(array('name'=>'new_tlp','value'=>set_value('new_tlp',$candidate->new_tlp),'class'=>'form-control','autocomplete'=>'off','maxlength'=>'50'));?></p>
									</div>	
								</div>	
							</div>	
							<hr/>
							<div class="form-inline">
								<p>Bisa minta waktunya beberapa menit ?
								<?php echo anchor('#greeting2','<span class="glyphicon glyphicon-retweet"></span>',array('data-toggle'=>'collapse','aria-expanded'=>'false'));?>
								<?php echo form_dropdown('respon_1',array(''=>'','1'=>'YA','2'=>'TIDAK','3'=>'SIBUK'),set_value('respon_1',$candidate->respon_1),'id="respon_1" class="form-control"');?>
								</p>
							</div>
							<p class="collapse" id="greeting2"><i>May I have a few minutes of your time ?</i></p>
							<div class='respon_1'></div>
							<div class="respon_2_wrap">
								<div class="form-inline">
									<p>Boleh saya tahu apakah Anda mengetahui event MTA2017 yang akan diselenggarakan pada tanggal 4-7 April di Singapore Expo ?
										<?php echo anchor('#greeting3','<span class="glyphicon glyphicon-retweet"></span>',array('data-toggle'=>'collapse','aria-expanded'=>'false'));?>
										<?php echo form_dropdown('respon_2',array(''=>'','1'=>'TAHU','2'=>'TIDAK TAHU','3'=>'TIDAK TERTARIK'),set_value('respon_2',$candidate->respon_2),'id="respon_2" class="form-control"');?>
									</p>
								</div>
								<p class="collapse" id="greeting3"><i>May I know if you are aware of MTA2017 which is happening from 4-7 April at the Singapore Expo?</i></p>
								<div class='respon_2'></div>
							</div>
							<div class="respon_2_1_wrap">
								<div class="form-inline">
									<p>Sudahkah anda mendaftar di MTA2017 ?
									<?php echo anchor('#greeting4','<span class="glyphicon glyphicon-retweet"></span>',array('data-toggle'=>'collapse','aria-expanded'=>'false'));?>
									<?php echo form_dropdown('respon_2_1',array(''=>'','1'=>'YA','2'=>'TIDAK'),set_value('respon_2_1',$candidate->respon_2_1),'id="respon_2_1" class="form-control"');?>
									</p>
								</div>
								<p class="collapse" id="greeting4"><i>That's great! Have you signed up for MTA2017 ?</i></p>
								<div class='respon_2_1'></div>
							</div>
							<div class="form-inline">
								<p><span class='contact'>Email Sebelum</span> : <?php echo $candidate->email;?></p>									
								<p>
									<span class='contact'>Email</span> : <?php echo form_input(array('id'=>'new-email','name'=>'new_email','value'=>set_value('new_email',$candidate->new_email),'class'=>'form-control upper','autocomplete'=>'off','maxlength'=>'500','placeholder'=>'email','size'=>'60'));?>
									<span class='btn-send-email'><?php echo anchor('candidate/send_email/'.$candidate->id,'<span class="glyphicon glyphicon-send"></span> Send Email',array('id'=>'btn-send-email'));?></span>
								</p>
							</div>
							<div class="send-email-alert"></div>
							<?php echo form_textarea(array('name'=>'remark','value'=>set_value('remark',$candidate->remark),'class'=>'form-control upper','autocomplete'=>'off','rows'=>'2','placeholder'=>'remark...'));?>
						</div>
					</div>
					<?php echo form_close();?>	
				</div>
				<div class="col-md-3">
					<div class="panel panel-default">
						<div class="panel-heading">Call History</div>
						<div class="panel-body">
							<div class="callhis-list">
								<?php echo $this->template->get_callhis($candidate->id);?>
							</div>
						</div>
						<div class="panel-footer">
							<?php echo anchor('callhis/create/'.$candidate->id.'/Noans','Noans',array('class'=>'btn btn-primary btn-xs btn-callhis'));?>
							<?php echo anchor('callhis/create/'.$candidate->id.'/Reject','Reject',array('class'=>'btn btn-primary btn-xs btn-callhis'));?>			
							<?php echo anchor('callhis/create/'.$candidate->id.'/Busy','Busy',array('class'=>'btn btn-primary btn-xs btn-callhis'));?>			
							<?php echo anchor('callhis/create/'.$candidate->id.'/Success','Success',array('class'=>'btn btn-primary btn-xs btn-callhis'));?>			
						</div>
					</div>			
				</div>	
			</div>		
		</div>
		<div role="tabpanel" class="tab-pane" id="product">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-6">
							<h3>Priority</h3>
							<ol>
								<li>Director/Head of Production</li>
								<li>Director/Head of Operations</li>
								<li>Head / Manager in charge of Engineering/Technical</li>
								<li>Head / Manager in charge of Purchasing / Procurement</li>
								
							</ol>
							<p> <b>Website : www.mta-asia.com</p>
							<p> Email : cheryl@sesallworld.com</b></p>
							<h3>Tentang MTA2017</h3>
							<p>MTA2017 adalah acara rekayasa presisi terkemuka internasional untuk produsen seperti perusahaan Anda, untuk mengakses terbaru rekayasa presisi dan alat mesin teknologi dan solusi yang tersedia di pasar global.</p>						
							<p>Beberapa peserta pameran yang terkemuka diantaranya :</p>								
								<ol>
								  <li>Carl Zeiss</li>
								  <li>Faro</li>
								  <li>Hoffman Quality Tools</li>
								  <li>Hwacheon</li>
								  <li>Makino</li>
								  <li>Nikon</li>
								 </ol>
								<h3> Manfaat dan Highlight Event </h3>
							<p> Anda akan dapat melihat teknologi terbaru yang disajikan oleh 280 peserta pameran internasional. Ini termasuk merek metrologi atas berpartisipasi dalam Metrologi Asia 2017 yang merupakan daerah khusus untuk mengukur & aplikasi inspeksi</p>
							<p> Grup paviliun yang mewakili Jerman, Korea, Singapura, Taiwan dan Inggris juga akan menampilkan teknologi mutakhir yang penting untuk memenuhi persyaratan yang semakin menantang di lingkungan manufaktur saat ini. </p>
							<p>Yang terbaru dari MTA adalah area fitur kunci sbb :</p>
							<ol>
							<li>Kemampuan Hub</li>
							<li>Optics & Photonics Inovasi Hub</li>
							<li>Pusat Inovasi Semi Konduktor</li>
							</ol>
							<p> Jika Anda tertarik di bidang manufaktur aditif, Anda juga dapat mendaftar untuk 3D Printing Technology Tour di mana akan ada demonstrasi langsung dari berbagai merek mapan di pasar. </p>
							
							<h3>Tanggal dan Waktu Acara </h3>
							<p> Tanggal: 4 - 7 April 2017, Selasa - Jumat </p>
							<p> Jam Buka: 10:30-18:00 </p>
							<p> Tempat: Singapore Expo, Halls 3 dan 4 </p>
							<h3> Cara Daftar? </h3>
							<p> <b>Pra-Pendaftaran untuk Kunjungi Pameran - Tiket Masuk Gratis</b>,
							kunjungi ke <span style="color: blue">www.mta-asia.com/pre-registration</span> dan kirimkan formulir pendaftaran.
							Surat konfirmasi akan dikirimkan melalui email.
							Bawa email konfirmasi pada hari kunjungan untuk mengumpulkan badge (lencana masuk). </p>
							<p> <b>On-site Pendaftaran untuk Kunjungi Pameran - Tiket Masuk Gratis,</b>
							Lanjutkan ke Pendaftaran Area Visitor untuk mendapatkan tiket masuk.
							Menyelesaikan kuesioner pada tiket masuk dan melanjutkan ke meja pendaftaran. </p>
							<p> <b>Pendaftaran untuk Konferensi - Dikenakan Biaya,</b>
							Kunjungi <span style="color: blue">www.mta-asia.com</span> dan klik pada konferensi masing-masing untuk mengetahui lebih lanjut. </p>
							<p> <b>Register untuk 3D Printing Technology Tour - Gratis,</b>
							Kunjungi <span style="color: blue">www.mta-asia.com</span> dan download formulir pendaftaran. </p>
						</div>
						<div class="col-md-6">
						
							<h3>About MTA2017</h3>
							<p>MTA2017 is the leading industry event for manufacturers such as your company, to access the latest precision engineering and machine tool technologies and solutions available in the global market. Some of the key exhibitors are. </p>						
							  <ol>
							  <li>Carl Zeiss</li>
							  <li>Faro</li>
						  	  <li>Hoffman Quality Tools</li>
							  <li>Hwacheon</li>
							  <li>Makino</li>
							  <li>Nikon</li>
							  </ol>
							<h3>Benefits and Highlights of the Event</h3>
							<p>You’ll be able to see the latest technologies presented by 280 international exhibitors. This includes top metrology brands participating in Metrology Asia2017 which is a dedicated area for measuring & inspection applications.</p>
							<p>Group pavilions representing Germany, Korea, Singapore, Taiwan and United Kingdom will also be showcasing cutting-edge technologies that are essential to meet the increasingly challenging requirements in today’s manufacturing environment.</p>
							<p>New at MTA are the key feature areas.</p>
							<ol>
							<li>Capabilities Hub</li>
							<li>Optics & Photonics Innovation Hub</li>
							<li>Semiconductor Innovation Centre</li>
							</ol>
							<p>If you are interested in additive manufacturing, you can also sign up for the 3D Printing Technology Tour where there will be live demonstrations from the various established brands in the market.</p>
							
							<h3>Date and Time of Event</h3>
							<p>Date: 4 – 7 April 2017, Tuesday - Friday</p>
							<p>Opening Hours: 10:30am-6:00pm</p>
							<p>Venue: Singapore Expo, Halls 3 and 4</p>
							<h3>How to Register?</h3>
							<p>Pre-Registration to Visit the Exhibition – Free Admission
							Go to www.mta-asia.com/pre-registration and submit the form. 
							Confirmation letter will be sent via email. 
							Bring the confirmation email on the day of visit to collect admission badge.</p>
							<p>On-site Registration to Visit the Exhibition – Free Admission
							Proceed to the Visitor Registration Area to obtain an admission ticket.
							Complete the questionnaire on the admission ticket and proceed to the counter for registration.</p>
							<p>Register for the Conferences - Chargeable
							Go to www.mta-asia.com and click on the respective conferences to find out more.</p>
							<p>Register for the 3D Printing Technology Tour - Free
							Go to www.mta-asia.com and download the registration form.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	/* - Deactive text submit on enter - */
	$(document).on('keyup keypress', 'form input[type="text"]', function(e) {
		if(e.which == 13) {
			e.preventDefault();
		}
	});	
</script>