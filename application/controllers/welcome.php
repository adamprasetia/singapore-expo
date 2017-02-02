<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('template');
		$this->load->model('user_model');
	}
	function index(){
		if($this->session->userdata('user_login')<>''){
			$this->template->load('home');
		}else{
			$this->template->load('landing');
		}
	}
	function signin(){
		$this->form_validation->set_rules('username','','required|trim');
		$this->form_validation->set_rules('password','','required|trim');
		if($this->form_validation->run()===false){
			$this->template->load('landing');
		}else{
			if($this->user_model->signin()){
				$id = $this->user_model->get_id_from_username($this->input->post('username'));
				$this->session->set_userdata('user_login',$id);				
				redirect('home');
			}else{
				$this->template->load('landing');
			}
		}
	}
	function signup(){
		$this->form_validation->set_rules('fullname','Fullname','required|trim');
		$this->form_validation->set_rules('username','Username','required|trim|is_unique[user.username]');
		$this->form_validation->set_rules('password','Password','required|trim');
		if($this->form_validation->run()===false){
			$this->template->load('landing');
		}else{
			$this->user_model->signup();
			$this->template->load('signup_success');
		}		
	}
	function signout(){
		$this->session->unset_userdata('user_login');
		redirect('welcome');
	}
}
