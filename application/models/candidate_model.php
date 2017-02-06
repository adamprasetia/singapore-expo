<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Candidate_model extends CI_Model{
	private $table = 'candidate';
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function filter(){
		$user_login = $this->session->userdata('user_login');
		if($this->user_model->get_level_from_id($user_login)==3){
			$this->db->where('a.telemarketer',$user_login);
			$this->db->where('a.status_data <>','3');
		}
		
		$search = $this->input->get('search');
		if($search<>''){
			$this->db->where('(a.serial like "%'.$search.'%" or a.fullname like "%'.$search.'%" or a.tlp like "%'.$search.'%")');
		}
		$status_phone = $this->input->get('status_phone');
		if($status_phone<>''){
			$this->db->where('a.status_phone',$status_phone);
		}
		$status_data = $this->input->get('status_data');
		if($status_data<>''){
			$this->db->where('a.status_data',$status_data);
		}
		if($this->input->get('date_from')<>'' && $this->input->get('date_to')<>''){
			$this->db->where('date_format(a.date_dist,\'%Y-%m-%d\') >=',format_tanggal_barat($this->input->get('date_from')));
			$this->db->where('date_format(a.date_dist,\'%Y-%m-%d\') <=',format_tanggal_barat($this->input->get('date_to')));
		}				
		$telemarketer = $this->input->get('telemarketer');
		if($telemarketer<>''){
			$this->db->where('a.telemarketer',$telemarketer);
		}
	}
	function import($data){
		$this->db->insert_batch($this->table,$data);
	}	
	function get($order_column='a.id',$order_type='asc',$limit=10,$offset=0){
		$this->filter();
		$this->db->select(array('a.*','b.fullname as telemarketer_name'));
		$this->db->order_by($order_column,$order_type);
		$this->db->join('user b','a.telemarketer=b.id','left');
		return $this->db->get($this->table.' a',$limit,$offset);
	}
	function export($order_column='a.id',$order_type='asc'){
		$this->filter();
		$this->db->order_by($order_column,$order_type);
		return $this->db->get($this->table.' a');
	}
	function get_from_id($id){
		$this->db->where('id',$id);
		return $this->db->get($this->table);	
	}
	function get_fullname_from_id($id){
		$this->db->where('id',$id);
		$this->db->limit(1);
		$query = $this->db->get($this->table);
		if($query->num_rows()>0){
			return $query->row()->fullname;
		}
		return false;
	}
	function get_callagain(){
		$sql = 'select * from candidate where status_phone in(1,2,3,5) and status_data <> 1';
		return $this->db->query($sql);
	}	
	function count_all(){
		$this->filter();
		$this->db->join('user b','a.telemarketer=b.id','left');
		return $this->db->count_all_results($this->table.' a');
	}		
	function phone($id){
		$data = array(
			'new_name'=>strtoupper($this->input->post('new_name'))
			,'new_title'=>strtoupper($this->input->post('new_title'))
			,'new_add'=>$this->input->post('new_add')
			,'new_mobile'=>$this->input->post('new_mobile')
			,'new_tlp'=>$this->input->post('new_tlp')
			,'new_email'=>strtoupper($this->input->post('new_email'))
			,'remark'=>strtoupper($this->input->post('remark'))
			,'note'=>strtoupper($this->input->post('note'))
			,'respon_1'=>strtoupper($this->input->post('respon_1'))
			,'respon_2'=>strtoupper($this->input->post('respon_2'))
			,'respon_2_1'=>strtoupper($this->input->post('respon_2_1'))
			,'status_phone'=>$this->input->post('status_phone')
			,'status_data'=>$this->input->post('status_data')
			,'updated'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id',$id);
		$this->db->update($this->table,$data);
	}
	function update($id,$data){
		$this->db->where('id',$id);
		$this->db->update($this->table,$data);
	}
	function count_onproses($id){
		$this->db->where('telemarketer',$id);
		$this->db->where('status_data','1');
		return $this->db->count_all_results($this->table);
	}
	function count_valid($id){
		$this->db->where('telemarketer',$id);
		$this->db->where('status_data','2');
		return $this->db->count_all_results($this->table);
	}
	function count_audit($id){
		$this->db->where('telemarketer',$id);
		$this->db->where('status_data','3');
		return $this->db->count_all_results($this->table);
	}
	function filter_dist(){
		if($this->input->get('dist_type')==1){
			$this->db->where('date_dist <>','0000-00-00');
			$this->db->where('telemarketer','0');
		}elseif($this->input->get('dist_type')==2){
			$this->db->where('date_dist','0000-00-00');
			$this->db->where('telemarketer','0');
		}else{
			$this->db->where('telemarketer','0');
		}		
	}
	function dist($telemarketer,$limit=0){
		$this->filter_dist();
		$data = array(
			'telemarketer'=>$telemarketer
			,'date_dist'=>date('Y-m-d')
		);
		$this->db->where('telemarketer','0');
		$this->db->limit($limit);
		$this->db->update($this->table,$data);		
	}
	function count_dist(){
		$this->filter_dist();
		$this->db->where('telemarketer','0');
		return $this->db->count_all_results($this->table);
	}	
	function clear($telemarketer){
		$data = array(
			'telemarketer'=>'0'
		);
		$this->db->where('telemarketer',$telemarketer);
		$this->db->where('status_data',1);
		$this->db->update($this->table,$data);		
	}
	function send_email($id,$email){
		$data = array(
			'send_email'=>'1'
			,'send_email_address'=>$email
		);
		$this->db->where('id',$id);
		$this->db->update($this->table,$data);				
	}
	function report(){
		if($this->input->get('date_from')<>'' && $this->input->get('date_to')<>''){
			$this->db->where('date_format(date_dist,\'%Y-%m-%d\') >=',format_tanggal_barat($this->input->get('date_from')));
			$this->db->where('date_format(date_dist,\'%Y-%m-%d\') <=',format_tanggal_barat($this->input->get('date_to')));
		}		
		$this->db->select('status_phone,count(status_phone) as total');
		$this->db->group_by('status_phone');
		return $this->db->get($this->table);
	}
	function report_2(){
		$query = 'select ';
		$query .= ' sum(if(status_phone IN(1,2,3,4,41),1,0)) as unsuccess ';
		$query .= ' ,sum(if(status_phone IN(5,6,7,8),1,0)) as success ';
		$query .= ' ,sum(if(status_phone <> 0,1,0)) as total ';
		$query .= ' from candidate';	
		$query .= ' where 1 ';	
		if($this->input->get('date_from')<>'' && $this->input->get('date_to')<>''){
			$query .= ' AND date_format(date_dist,\'%Y-%m-%d\') >=\''.format_tanggal_barat($this->input->get('date_from')).'\' ';
			$query .= ' AND date_format(date_dist,\'%Y-%m-%d\') <=\''.format_tanggal_barat($this->input->get('date_to')).'\' ';
		}	
		return $this->db->query($query);
	}
	function get_date_phone(){
		$this->db->group_by('date_phone');
		$this->db->order_by('date_phone','asc');
		return $this->db->get($this->table);
	}
}