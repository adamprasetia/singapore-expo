<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model{
	private $table = 'user';
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function signin(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$this->db->where('username',$username);
		$this->db->where('password',md5($password));
		$query = $this->db->get($this->table);
		if($query->num_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	function signup(){
		$fullname = $this->input->post('fullname');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$data = array(
			'fullname'=>$fullname
			,'username'=>$username
			,'password'=>md5($password)
			,'level'=>3
		);
		$this->db->insert($this->table,$data);
	}
	function get_id_from_username($username){
		$this->db->where('username',$username);
		$this->db->limit(1);
		$query = $this->db->get($this->table);
		if($query->num_rows()>0){
			return $query->row()->id;
		}
		return false;
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
	function get_level_from_id($id){
		$this->db->where('id',$id);
		$this->db->limit(1);
		$query = $this->db->get($this->table);
		if($query->num_rows()>0){
			return $query->row()->level;
		}
		return false;
	}
	function get_telemarketer(){
		$this->db->where('level',3);
		return $this->db->get($this->table);
	}
}