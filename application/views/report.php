<div class="panel panel-default">
	<div class="panel-heading">Report</div>
	<div class="panel-body">
		<?php echo form_open('candidate/report',array('class'=>'form-inline','method'=>'get'));?>
			<div class="form-group">
				<?php echo form_input(array('name'=>'date_from','class'=>'form-control tanggal','value'=>$this->input->get('date_from'),'placeholder'=>'From','autocomplete'=>'off'));?> ke
				<?php echo form_input(array('name'=>'date_to','class'=>'form-control tanggal','value'=>$this->input->get('date_to'),'placeholder'=>'To','autocomplete'=>'off'));?>
			</div>										
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-filter"></span> Filter</button>
		<?php echo form_close();?>	
		<hr/>
		<h4>Report 1</h4>
		<?php echo (isset($table)?$table:"");?>
		<h4>Report 2</h4>
		<?php echo (isset($table_2)?$table_2:"");?>
	</div>
</div>