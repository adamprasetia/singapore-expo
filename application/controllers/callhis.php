<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Callhis extends Member_Controller {
	function create($candidate_id,$remark){
		$data = array(
			'candidate_id'=>$candidate_id
			,'remark'=>$remark
			,'created'=>date('Y-m-d H:i:s')
		);
		$this->callhis_model->create($data);
		$datas = array('date_phone'=>$this->callhis_model->get_last($candidate_id));
		$this->candidate_model->update($candidate_id,$datas);
		echo $this->template->get_callhis($candidate_id);
	}	
	function delete($id,$candidate_id){
		$this->callhis_model->delete($id);	
		$data = array('date_phone'=>$this->callhis_model->get_last($candidate_id));
		$this->candidate_model->update($candidate_id,$data);
		echo $this->template->get_callhis($candidate_id);
	}
}
