<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct(){
		 parent::__construct();
		 $this->load->helper('url');
	}
	
	public function index(){
		if (!$this->ion_auth->logged_in()) { redirect('auth/login', 'refresh'); }
		
		$q = $this->db->query("SELECT * FROM bots");
		$total_bots = $q->num_rows();
		
		$q = $this->db->query("SELECT * FROM bots WHERE bot_lastseen >= date_sub(NOW(), interval 10 minute);");
		$bots_online = $q->num_rows();
		
		$q = $this->db->query("SELECT * FROM bots WHERE bot_lastseen <= date_sub(NOW(), interval 10 minute);");
		$bots_offline = $q->num_rows();

		$q = $this->db->query("SELECT * FROM bots WHERE bot_added >= date_sub(NOW(), interval 24 hour);");
		$bots_new = $q->num_rows();
			
			
		$this->template->set('title', 'iceDragon - Dashboard');
		@$this->template->load('main', 'home', array(
			'total_bots' => $total_bots,
			'bots_online' => $bots_online,
			'bots_offline' => $bots_offline,
			'bot_new' => $bots_new
		));
	}
} 
