<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template{
	protected $ci;
	function __construct(){
		$this->ci = &get_instance();
	}
	function load($view=null,$data=null){
		$data['content'] = $this->ci->load->view($view,$data,true);
		$this->ci->load->view('template', $data);
	}
	function get_fullname_user_login(){
		$fullname = $this->ci->user_model->get_fullname_from_id($this->ci->session->userdata('user_login'));
		if($fullname<>''){
			return $fullname;
		}else{
			return '';
		}
	}
	function get_level_user_login(){
		$level = $this->ci->user_model->get_level_from_id($this->ci->session->userdata('user_login'));
		if($level<>''){
			return $level;
		}else{
			return '';
		}
	}
	function get_callhis($id){
		$query = $this->ci->callhis_model->get($id);
		$data = '';
		if($query->num_rows()>0){
			$result = $query->result();
			foreach($result as $r){
				$data .= '<p>'.$r->remark.' <small>'.$r->created.'</small> '.anchor('callhis/delete/'.$r->id.'/'.$r->candidate_id,'<span aria-hidden="true">&times;</span>',array('class'=>'close btn-callhis')).'</p>';
			}		
		}else{
			$data = 'Tidak ada history';	
		}
		return $data;
	}
}