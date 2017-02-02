<div class="containers">
	<div class="panel panel-default panel-landing">
		<div class="panel-body">
			<p>Sign in here...</p>
			<?php echo form_open('welcome/signin',array('id'=>'form-sign-in'));?>
				<div class="form-group">
					<?php echo form_input(array('class'=>'form-control','placeholder'=>'Username','name'=>'username','maxlength'=>'100','autofocus'=>'autofocus','autocomplete'=>'off'));?>
				</div>		
				<div class="form-group">
					<?php echo form_password(array('class'=>'form-control','placeholder'=>'Password','name'=>'password','maxlength'=>'50','autocomplete'=>'off'));?>	
				</div>		
				<button type="submit" id="btn-login" class="btn btn-primary">
					<span class="glyphicon glyphicon-log-in"></span> Sign In
				</button>
			<?php echo form_close();?>					
		</div>
		<div class="panel-footer">
			<p>Or new member ? sign up now</p>
			<?php echo form_open('welcome/signup');?>
				<div class="form-group">
					<?php echo form_input(array('class'=>'form-control','placeholder'=>'Fullname','name'=>'fullname','maxlength'=>'50','autocomplete'=>'off'));?>	
				</div>		
				<div class="form-group">
					<?php echo form_input(array('class'=>'form-control','placeholder'=>'Username','name'=>'username','maxlength'=>'50','autocomplete'=>'off'));?>
				</div>		
				<div class="form-group">
					<?php echo form_password(array('class'=>'form-control','placeholder'=>'Password','name'=>'password','maxlength'=>'50'));?>	
				</div>		
				<button type="submit" class="btn btn-primaryz">
					<span class="glyphicon glyphicon-pencil"></span> Sign Up
				</button>
			<?php echo form_close();?>
		</div>
	</div>			
</div>			
