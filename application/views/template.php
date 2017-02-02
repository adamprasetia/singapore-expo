<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Singapore Expo</title>
	<!-- CSS -->
	<link href="<?php echo base_url();?>assets/jquery-ui-1.11.2.custom/jquery-ui.min.css" rel="stylesheet">		
	<link href="<?php echo base_url();?>assets/bootstrap-3.3.2-dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
</head>
<body>
	<!-- NAVBAR -->
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">
					<?php echo anchor('home','Singapore Expo',array('class'=>'navbar-brand'));?>
				</a>
			</div>
			<div class="<?php echo ($this->session->userdata('user_login')<>''?'':'hide');?>">
			<ul class="nav navbar-nav">
				<?php 
					$level = $this->template->get_level_user_login();
					if($level==1){
						echo '<li>'.anchor('candidate/import','<span class="glyphicon glyphicon-import"></span> Import').'</li>';
						echo '<li>'.anchor('candidate/dist','<span class="glyphicon glyphicon-list"></span> Distribution').'</li>';
						echo '<li>'.anchor('candidate/report','<span class="glyphicon glyphicon-stats"></span> Report').'</li>';
					}
					echo '<li>'.anchor('candidate/show','<span class="glyphicon glyphicon-user"></span> Candidate').'</li>';
				?>
				
			</ul>			
			<p class="navbar-text">
				<?php echo 'Hi, '.$this->template->get_fullname_user_login().' | '.anchor('welcome/signout','Sign out');?>
			</p>
			</div>
		</div>
	</nav>
	
	<!-- CONTENT -->
	<div class="container-fluid">
		<?php echo $this->session->flashdata('alert');?>
		<?php echo (isset($content)?$content:"");?>
	</div>
	
	<!-- JS -->
	<script src="<?php echo base_url();?>assets/js/jquery-1.10.2.js"></script>
	<script src="<?php echo base_url();?>assets/jquery-ui-1.11.2.custom/jquery-ui.min.js"></script>	
	<script src="<?php echo base_url();?>assets/bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/zclip/jquery.zclip.js"></script>
	<script>var base_url = "<?php echo base_url();?>"</script>
	<script src="<?php echo base_url();?>assets/js/main.js"></script>
</body>
</html>