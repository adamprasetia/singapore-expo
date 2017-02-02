<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Callhis_model extends CI_Model{
	private $table = 'callhis';
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function get($id){
		$this->db->where('candidate_id',$id);
		$this->db->order_by('created','desc');
		return $this->db->get($this->table);
	}
	function get_last($id){
		$this->db->where('candidate_id',$id);
		$this->db->order_by('created','desc');
		$this->db->limit(1);
		$query = $this->db->get($this->table);
		if($query->num_rows()>0){
			return $query->row()->created;
		}else{
			return '0000-00-00';
		}
	}
	function count_from_candidate_id($id){
		$this->db->where('candidate_id',$id);		
		return $this->db->count_all_results($this->table);
	}			
	function create($data){
		$this->db->insert($this->table,$data);
	}
	function delete($id){
		$this->db->where('id',$id);
		$this->db->delete($this->table);
	}
}