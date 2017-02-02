<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_Controller extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('general_helper');
		$this->load->library('session');
		$this->load->library('template');
		$this->load->library('table');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->model('user_model');
		$this->load->model('candidate_model');
		$this->load->model('callhis_model');
		
		date_default_timezone_set('Asia/Jakarta');			
		
		/* - Check User Login - */
		if($this->session->userdata('user_login')==''){
			redirect('welcome/signin','refresh');
		}

		/* - If Maintenance - */
		//redirect('welcome/maintenance','refresh');
	}
}
