<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Member_Controller {
	function index(){
		$this->template->load('home');
	}
}
