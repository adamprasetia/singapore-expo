<div class="panel panel-default">
	<div class="panel-body">
		<div class="pull-right"><?php echo (isset($pagination)?$pagination:"");?></div>
		<?php echo form_open('candidate/filter',array('class'=>'form-inline'));?>
			<div class="form-group">
				<?php echo form_label('Limit','limit');?>
				<?php echo form_dropdown('limit',array('10'=>'10','50'=>'50','100'=>'100'),$this->input->get('limit'),'class="form-control"');?>
			</div>
			<div class="form-group">
				<?php echo form_input(array('name'=>'search','class'=>'form-control','value'=>$this->input->get('search'),'maxlength'=>'50','placeholder'=>'Search...','autocomplete'=>'off'));?>
			</div>										
			<div class="form-group">
				<?php echo form_input(array('name'=>'date_from','class'=>'form-control tanggal','value'=>$this->input->get('date_from'),'placeholder'=>'From','autocomplete'=>'off','size'=>'10'));?> ke
				<?php echo form_input(array('name'=>'date_to','class'=>'form-control tanggal','value'=>$this->input->get('date_to'),'placeholder'=>'To','autocomplete'=>'off','size'=>'10'));?>
			</div>										
			<div class="form-group">
				<?php echo form_dropdown('status_phone',status_phone(),$this->input->get('status_phone'),'class="form-control"');?>
			</div>										
			<div class="form-group">
				<?php echo form_dropdown('status_data',status_data(),$this->input->get('status_data'),'class="form-control"');?>
			</div>										
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-filter"></span> Filter</button>
		<?php echo form_close();?>	
		<hr/>
		<?php echo (isset($table)?$table:"");?>
		<?php echo (isset($total)?$total:"");?>
		<div class="pull-right">
			<?php 
				$search = $this->input->get('search');
				$date_from = $this->input->get('date_from');
				$date_to = $this->input->get('date_to');
				$status_phone = $this->input->get('status_phone');
				$status_data = $this->input->get('status_data');
				$filter = "?search=$search&date_from=$date_from&date_to=$date_to&status_phone=$status_phone&status_data=$status_data";
			
				echo anchor('candidate/export'.$filter,'<span class="glyphicon glyphicon-export"></span> Export',array('class'=>'btn btn-primary'));
			?>
		</div>
	</div>
</div>