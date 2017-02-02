<div class="panel panel-default">
	<div class="panel-heading">
		<?php echo form_open('candidate/dist',array('class'=>'form-inline','method'=>'get'));?>
		<div class="form-inline">
			Distribution 
			<?php echo form_dropdown('dist_type',array(''=>'','1'=>'OLD','2'=>'NEW'),$this->input->get('dist_type'),'class="form-control"');?>
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-filter"></span> Filter</button>
			<?php echo (isset($total)?$total:"");?>
			<?php echo anchor('candidate/callagain','Get Callback',array('onclick'=>"return confirm('Are you sure')",'class'=>'btn btn-danger'));?>
		</div>										
		<?php echo form_close();?>	
	</div>
	<?php echo form_open('candidate/dist_?dist_type='.$this->input->get('dist_type'),array('class'=>'form-inline'));?>
	<div class="panel-body">
		<?php echo (isset($table)?$table:"");?>
	</div>
	<div class="panel-footer">
		<button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure')"><span class="glyphicon glyphicon-list"></span> Distribution</button>
	</div>
	<?php echo form_close();?>	
</div>
