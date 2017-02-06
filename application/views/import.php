<?php echo form_open_multipart('candidate/import_');?>
	<div class="panel panel-default">
		<div class="panel-heading">Import</div>
		<div class="panel-body">
			<div class="form-group">
				<?php echo form_upload(array('id'=>'userfile','name'=>'userfile'));?>
			</div>				
		</div>
		<div class="panel-footer">
			<button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure')"><span class="glyphicon glyphicon-import"></span> Import</button>		
			<a href="<?php echo base_url() ?>uploads/import.xls">Download Template</a>
		</div>
	</div>				
<?php echo form_close();?>				
