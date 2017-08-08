<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit extends CI_Controller {
	public function __construct(){
		 parent::__construct();
		 $this->load->helper('url');
	}
	
	public function index(){
		if (!$this->ion_auth->logged_in()) { redirect('auth/login', 'refresh'); }
		
		echo "Hi";
	}
} 
