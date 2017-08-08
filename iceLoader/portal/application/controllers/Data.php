<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data extends CI_Controller {
	public function __construct(){
		 parent::__construct();
		 $this->load->helper('url');
	}
	
	public function bots(){
		$q = $this->db->query("SELECT * FROM bots");
		$result = $q->result();
		
		$bots = array();
		$names = '{"BD": "Bangladesh", "BE": "Belgium", "BF": "Burkina Faso", "BG": "Bulgaria", "BA": "Bosnia and Herzegovina", "BB": "Barbados", "WF": "Wallis and Futuna", "BL": "Saint Barthelemy", "BM": "Bermuda", "BN": "Brunei", "BO": "Bolivia", "BH": "Bahrain", "BI": "Burundi", "BJ": "Benin", "BT": "Bhutan", "JM": "Jamaica", "BV": "Bouvet Island", "BW": "Botswana", "WS": "Samoa", "BQ": "Bonaire, Saint Eustatius and Saba ", "BR": "Brazil", "BS": "Bahamas", "JE": "Jersey", "BY": "Belarus", "BZ": "Belize", "RU": "Russia", "RW": "Rwanda", "RS": "Serbia", "TL": "East Timor", "RE": "Reunion", "TM": "Turkmenistan", "TJ": "Tajikistan", "RO": "Romania", "TK": "Tokelau", "GW": "Guinea-Bissau", "GU": "Guam", "GT": "Guatemala", "GS": "South Georgia and the South Sandwich Islands", "GR": "Greece", "GQ": "Equatorial Guinea", "GP": "Guadeloupe", "JP": "Japan", "GY": "Guyana", "GG": "Guernsey", "GF": "French Guiana", "GE": "Georgia", "GD": "Grenada", "GB": "United Kingdom", "GA": "Gabon", "SV": "El Salvador", "GN": "Guinea", "GM": "Gambia", "GL": "Greenland", "GI": "Gibraltar", "GH": "Ghana", "OM": "Oman", "TN": "Tunisia", "JO": "Jordan", "HR": "Croatia", "HT": "Haiti", "HU": "Hungary", "HK": "Hong Kong", "HN": "Honduras", "HM": "Heard Island and McDonald Islands", "VE": "Venezuela", "PR": "Puerto Rico", "PS": "Palestinian Territory", "PW": "Palau", "PT": "Portugal", "SJ": "Svalbard and Jan Mayen", "PY": "Paraguay", "IQ": "Iraq", "PA": "Panama", "PF": "French Polynesia", "PG": "Papua New Guinea", "PE": "Peru", "PK": "Pakistan", "PH": "Philippines", "PN": "Pitcairn", "PL": "Poland", "PM": "Saint Pierre and Miquelon", "ZM": "Zambia", "EH": "Western Sahara", "EE": "Estonia", "EG": "Egypt", "ZA": "South Africa", "EC": "Ecuador", "IT": "Italy", "VN": "Vietnam", "SB": "Solomon Islands", "ET": "Ethiopia", "SO": "Somalia", "ZW": "Zimbabwe", "SA": "Saudi Arabia", "ES": "Spain", "ER": "Eritrea", "ME": "Montenegro", "MD": "Moldova", "MG": "Madagascar", "MF": "Saint Martin", "MA": "Morocco", "MC": "Monaco", "UZ": "Uzbekistan", "MM": "Myanmar", "ML": "Mali", "MO": "Macao", "MN": "Mongolia", "MH": "Marshall Islands", "MK": "Macedonia", "MU": "Mauritius", "MT": "Malta", "MW": "Malawi", "MV": "Maldives", "MQ": "Martinique", "MP": "Northern Mariana Islands", "MS": "Montserrat", "MR": "Mauritania", "IM": "Isle of Man", "UG": "Uganda", "TZ": "Tanzania", "MY": "Malaysia", "MX": "Mexico", "IL": "Israel", "FR": "France", "IO": "British Indian Ocean Territory", "SH": "Saint Helena", "FI": "Finland", "FJ": "Fiji", "FK": "Falkland Islands", "FM": "Micronesia", "FO": "Faroe Islands", "NI": "Nicaragua", "NL": "Netherlands", "NO": "Norway", "NA": "Namibia", "VU": "Vanuatu", "NC": "New Caledonia", "NE": "Niger", "NF": "Norfolk Island", "NG": "Nigeria", "NZ": "New Zealand", "NP": "Nepal", "NR": "Nauru", "NU": "Niue", "CK": "Cook Islands", "XK": "Kosovo", "CI": "Ivory Coast", "CH": "Switzerland", "CO": "Colombia", "CN": "China", "CM": "Cameroon", "CL": "Chile", "CC": "Cocos Islands", "CA": "Canada", "CG": "Republic of the Congo", "CF": "Central African Republic", "CD": "Democratic Republic of the Congo", "CZ": "Czech Republic", "CY": "Cyprus", "CX": "Christmas Island", "CR": "Costa Rica", "CW": "Curacao", "CV": "Cape Verde", "CU": "Cuba", "SZ": "Swaziland", "SY": "Syria", "SX": "Sint Maarten", "KG": "Kyrgyzstan", "KE": "Kenya", "SS": "South Sudan", "SR": "Suriname", "KI": "Kiribati", "KH": "Cambodia", "KN": "Saint Kitts and Nevis", "KM": "Comoros", "ST": "Sao Tome and Principe", "SK": "Slovakia", "KR": "South Korea", "SI": "Slovenia", "KP": "North Korea", "KW": "Kuwait", "SN": "Senegal", "SM": "San Marino", "SL": "Sierra Leone", "SC": "Seychelles", "KZ": "Kazakhstan", "KY": "Cayman Islands", "SG": "Singapore", "SE": "Sweden", "SD": "Sudan", "DO": "Dominican Republic", "DM": "Dominica", "DJ": "Djibouti", "DK": "Denmark", "VG": "British Virgin Islands", "DE": "Germany", "YE": "Yemen", "DZ": "Algeria", "US": "United States", "UY": "Uruguay", "YT": "Mayotte", "UM": "United States Minor Outlying Islands", "LB": "Lebanon", "LC": "Saint Lucia", "LA": "Laos", "TV": "Tuvalu", "TW": "Taiwan", "TT": "Trinidad and Tobago", "TR": "Turkey", "LK": "Sri Lanka", "LI": "Liechtenstein", "LV": "Latvia", "TO": "Tonga", "LT": "Lithuania", "LU": "Luxembourg", "LR": "Liberia", "LS": "Lesotho", "TH": "Thailand", "TF": "French Southern Territories", "TG": "Togo", "TD": "Chad", "TC": "Turks and Caicos Islands", "LY": "Libya", "VA": "Vatican", "VC": "Saint Vincent and the Grenadines", "AE": "United Arab Emirates", "AD": "Andorra", "AG": "Antigua and Barbuda", "AF": "Afghanistan", "AI": "Anguilla", "VI": "U.S. Virgin Islands", "IS": "Iceland", "IR": "Iran", "AM": "Armenia", "AL": "Albania", "AO": "Angola", "AQ": "Antarctica", "AS": "American Samoa", "AR": "Argentina", "AU": "Australia", "AT": "Austria", "AW": "Aruba", "IN": "India", "AX": "Aland Islands", "AZ": "Azerbaijan", "IE": "Ireland", "ID": "Indonesia", "UA": "Ukraine", "QA": "Qatar", "MZ": "Mozambique"}';
		$names = json_decode($names, true);
		
		$bot_array = array();
		
		$osList = array(
			'10.0' => 'Windows 10',
			'6.3' => 'Windows 8.1',
			'6.2' => 'Windows 8',
			'6.1' => 'Windows 7',
			'6.0' => 'Windows Vista',
			'5.2' => 'Windows Server 2003',
			'5.1' => 'Windows XP',
			'5.0' => 'Windows 2000'
		);
		
		
		foreach($result as $key => $value){
			$bot_location_name = preg_replace('/\s+/', '', $value->bot_location);
			

			$last_seen = $value->bot_lastseen;
			$date = date_create($last_seen);
			$date->format("U");
			$diff = $this->datediff('s', $date->getTimestamp(), time(), true);
	
			if($diff > 600){
				$status = '<font color="red"><b>Offline</b></font>'; 
			}else{
				$status = '<font color="green"><b>Online</b></font>'; 
			}
			$bot_array[] = array(
				'id' => $value->id,
				'machine_id' => $value->bot_uuid,
				'ipv4' => $value->bot_ipv4,
				'location' => '<img src="assets/images/flags/'. strtolower($value->bot_location).'.png"> ' . $names[$bot_location_name],
				'os' => @$osList[$value->bot_os],
				'version' => $value->bot_version,
				'status' => $status,
				'isAdmin' => $value->bot_admin,
				'last_seen' => $value->bot_lastseen
			);
			
		}
		
		die(json_encode($bot_array));
	}
	
	
	public function task(){
		$q = $this->db->query("SELECT * FROM tasks");
		$result = $q->result();
		$tasks = array();
		
		foreach($result as $key => $value){
			if($value->status == '0'){
				$status = 'Pending';
			}elseif($value->status == '1'){
				$status = 'Completed';
			}elseif($value->status == '2'){
				$status = 'Supspended';
			}else{
				$status = 'Unknown';
			}
		
		
			$tasks[] = array(
				'task_id' => $value->id,
				'task_command' => $value->cmd,
				'task_executed' => $value->executed,
				'task_failed' => $value->failed,
				'task_total'=> $value->maxbots,
				'task_added' => $value->time_added,
				'task_status' => $value->status,
				'task_actions' => $this->createActionMenu($value->id, $value->status)
			);
		}
		die(json_encode($tasks));
	}
	
	public function countries(){
		$q = $this->db->query("SELECT * FROM bots");
		$bnum = $q->num_rows();
		
		$q = $this->db->query("SELECT DISTINCT bot_location FROM bots");
		$result = $q->result();
		$names = '{"BD": "Bangladesh", "BE": "Belgium", "BF": "Burkina Faso", "BG": "Bulgaria", "BA": "Bosnia and Herzegovina", "BB": "Barbados", "WF": "Wallis and Futuna", "BL": "Saint Barthelemy", "BM": "Bermuda", "BN": "Brunei", "BO": "Bolivia", "BH": "Bahrain", "BI": "Burundi", "BJ": "Benin", "BT": "Bhutan", "JM": "Jamaica", "BV": "Bouvet Island", "BW": "Botswana", "WS": "Samoa", "BQ": "Bonaire, Saint Eustatius and Saba ", "BR": "Brazil", "BS": "Bahamas", "JE": "Jersey", "BY": "Belarus", "BZ": "Belize", "RU": "Russia", "RW": "Rwanda", "RS": "Serbia", "TL": "East Timor", "RE": "Reunion", "TM": "Turkmenistan", "TJ": "Tajikistan", "RO": "Romania", "TK": "Tokelau", "GW": "Guinea-Bissau", "GU": "Guam", "GT": "Guatemala", "GS": "South Georgia and the South Sandwich Islands", "GR": "Greece", "GQ": "Equatorial Guinea", "GP": "Guadeloupe", "JP": "Japan", "GY": "Guyana", "GG": "Guernsey", "GF": "French Guiana", "GE": "Georgia", "GD": "Grenada", "GB": "United Kingdom", "GA": "Gabon", "SV": "El Salvador", "GN": "Guinea", "GM": "Gambia", "GL": "Greenland", "GI": "Gibraltar", "GH": "Ghana", "OM": "Oman", "TN": "Tunisia", "JO": "Jordan", "HR": "Croatia", "HT": "Haiti", "HU": "Hungary", "HK": "Hong Kong", "HN": "Honduras", "HM": "Heard Island and McDonald Islands", "VE": "Venezuela", "PR": "Puerto Rico", "PS": "Palestinian Territory", "PW": "Palau", "PT": "Portugal", "SJ": "Svalbard and Jan Mayen", "PY": "Paraguay", "IQ": "Iraq", "PA": "Panama", "PF": "French Polynesia", "PG": "Papua New Guinea", "PE": "Peru", "PK": "Pakistan", "PH": "Philippines", "PN": "Pitcairn", "PL": "Poland", "PM": "Saint Pierre and Miquelon", "ZM": "Zambia", "EH": "Western Sahara", "EE": "Estonia", "EG": "Egypt", "ZA": "South Africa", "EC": "Ecuador", "IT": "Italy", "VN": "Vietnam", "SB": "Solomon Islands", "ET": "Ethiopia", "SO": "Somalia", "ZW": "Zimbabwe", "SA": "Saudi Arabia", "ES": "Spain", "ER": "Eritrea", "ME": "Montenegro", "MD": "Moldova", "MG": "Madagascar", "MF": "Saint Martin", "MA": "Morocco", "MC": "Monaco", "UZ": "Uzbekistan", "MM": "Myanmar", "ML": "Mali", "MO": "Macao", "MN": "Mongolia", "MH": "Marshall Islands", "MK": "Macedonia", "MU": "Mauritius", "MT": "Malta", "MW": "Malawi", "MV": "Maldives", "MQ": "Martinique", "MP": "Northern Mariana Islands", "MS": "Montserrat", "MR": "Mauritania", "IM": "Isle of Man", "UG": "Uganda", "TZ": "Tanzania", "MY": "Malaysia", "MX": "Mexico", "IL": "Israel", "FR": "France", "IO": "British Indian Ocean Territory", "SH": "Saint Helena", "FI": "Finland", "FJ": "Fiji", "FK": "Falkland Islands", "FM": "Micronesia", "FO": "Faroe Islands", "NI": "Nicaragua", "NL": "Netherlands", "NO": "Norway", "NA": "Namibia", "VU": "Vanuatu", "NC": "New Caledonia", "NE": "Niger", "NF": "Norfolk Island", "NG": "Nigeria", "NZ": "New Zealand", "NP": "Nepal", "NR": "Nauru", "NU": "Niue", "CK": "Cook Islands", "XK": "Kosovo", "CI": "Ivory Coast", "CH": "Switzerland", "CO": "Colombia", "CN": "China", "CM": "Cameroon", "CL": "Chile", "CC": "Cocos Islands", "CA": "Canada", "CG": "Republic of the Congo", "CF": "Central African Republic", "CD": "Democratic Republic of the Congo", "CZ": "Czech Republic", "CY": "Cyprus", "CX": "Christmas Island", "CR": "Costa Rica", "CW": "Curacao", "CV": "Cape Verde", "CU": "Cuba", "SZ": "Swaziland", "SY": "Syria", "SX": "Sint Maarten", "KG": "Kyrgyzstan", "KE": "Kenya", "SS": "South Sudan", "SR": "Suriname", "KI": "Kiribati", "KH": "Cambodia", "KN": "Saint Kitts and Nevis", "KM": "Comoros", "ST": "Sao Tome and Principe", "SK": "Slovakia", "KR": "South Korea", "SI": "Slovenia", "KP": "North Korea", "KW": "Kuwait", "SN": "Senegal", "SM": "San Marino", "SL": "Sierra Leone", "SC": "Seychelles", "KZ": "Kazakhstan", "KY": "Cayman Islands", "SG": "Singapore", "SE": "Sweden", "SD": "Sudan", "DO": "Dominican Republic", "DM": "Dominica", "DJ": "Djibouti", "DK": "Denmark", "VG": "British Virgin Islands", "DE": "Germany", "YE": "Yemen", "DZ": "Algeria", "US": "United States", "UY": "Uruguay", "YT": "Mayotte", "UM": "United States Minor Outlying Islands", "LB": "Lebanon", "LC": "Saint Lucia", "LA": "Laos", "TV": "Tuvalu", "TW": "Taiwan", "TT": "Trinidad and Tobago", "TR": "Turkey", "LK": "Sri Lanka", "LI": "Liechtenstein", "LV": "Latvia", "TO": "Tonga", "LT": "Lithuania", "LU": "Luxembourg", "LR": "Liberia", "LS": "Lesotho", "TH": "Thailand", "TF": "French Southern Territories", "TG": "Togo", "TD": "Chad", "TC": "Turks and Caicos Islands", "LY": "Libya", "VA": "Vatican", "VC": "Saint Vincent and the Grenadines", "AE": "United Arab Emirates", "AD": "Andorra", "AG": "Antigua and Barbuda", "AF": "Afghanistan", "AI": "Anguilla", "VI": "U.S. Virgin Islands", "IS": "Iceland", "IR": "Iran", "AM": "Armenia", "AL": "Albania", "AO": "Angola", "AQ": "Antarctica", "AS": "American Samoa", "AR": "Argentina", "AU": "Australia", "AT": "Austria", "AW": "Aruba", "IN": "India", "AX": "Aland Islands", "AZ": "Azerbaijan", "IE": "Ireland", "ID": "Indonesia", "UA": "Ukraine", "QA": "Qatar", "MZ": "Mozambique"}';
		$names = json_decode($names, true);
		
		$country_list = array();
		$country_result = array();
			foreach($result as $key => $value){
				$country_list[] = $value->bot_location;
			}
		
			foreach($country_list as $key => $value){
				$query = $this->db->query("SELECT * FROM bots WHERE bot_location='$value'");
				$num = $query->num_rows();
				
				$bot_location_name = preg_replace('/\s+/', '', $value);
				$country_result[] = array(
					'country_code' => preg_replace('/\s+/', '', $value),
					'country_name' => '<img src="assets/images/flags/'. strtolower($value).'.png"> ' . $names[$bot_location_name],
					'num' => $num,
					'per' => round(($num / $bnum) * 100) . '% (' .$num . '/' . $bnum .')'
				);
				
			}
			die( json_encode($country_result) );
	}
	
	public function cpu(){
		$q = $this->db->query("SELECT * FROM bots");
		$bnum = $q->num_rows();
		
		
		$q = $this->db->query("SELECT DISTINCT bot_proc FROM bots");
		$result = $q->result();
		
		$cpu_list = array();
		$country_result = array();
			foreach($result as $key => $value){
				$cpu_list[] = $value->bot_proc;
			}

			foreach($cpu_list as $key => $value){
				$query = $this->db->query("SELECT * FROM bots WHERE bot_proc='$value'");
				$num = $query->num_rows();
				
				$bot_location_name = preg_replace('/\s+/', '', $value);
				$country_result[] = array(
					'cpu' => $value,
					'num' => $num,
					'per' => round(($num / $bnum) * 100) . '% (' .$num . '/' . $bnum .')'
				);
				
			}
			die( json_encode($country_result) );
	}

	
	
	
	public function update(){
		
		$q = $this->db->query("SELECT * FROM bots");
		$total_bots = $q->num_rows();
		
		$q = $this->db->query("SELECT * FROM bots WHERE bot_lastseen >= date_sub(NOW(), interval 10 minute);");
		$bots_online = $q->num_rows();
		
		$q = $this->db->query("SELECT * FROM bots WHERE bot_lastseen <= date_sub(NOW(), interval 10 minute);");
		$bots_offline = $q->num_rows();

		$q = $this->db->query("SELECT * FROM bots WHERE bot_added >= date_sub(NOW(), interval 24 hour);");
		$bots_new = $q->num_rows();
		
		
		$array = array(
			'online' => $bots_online,
			'online_pre' => round(($bots_online / $total_bots) * 100),
			'total' => $total_bots,
			'offline' => $bots_offline,
			'offline_pre' => round(($bots_offline / $total_bots) * 100),
			'new' => $bots_new,
			'new_pre' => round(($bots_new / $total_bots) * 100),
		);
		die( json_encode($array) );
	}

	public function gpu(){
		$q = $this->db->query("SELECT * FROM bots");
		$bnum = $q->num_rows();
		
		$q = $this->db->query("SELECT DISTINCT bot_gpu FROM bots");
		$result = $q->result();
		
		$cpu_list = array();
		$country_result = array();
			foreach($result as $key => $value){
				$cpu_list[] = $value->bot_gpu;
			}

			foreach($cpu_list as $key => $value){
				$query = $this->db->query("SELECT * FROM bots WHERE bot_gpu='$value'");
				$num = $query->num_rows();
				
				$bot_location_name = preg_replace('/\s+/', '', $value);
				$country_result[] = array(
					'gpu' => $value,
					'num' => $num,
					'per' => round(($num / $bnum) * 100) . '% (' .$num . '/' . $bnum .')'
				);
				
			}
			die( json_encode($country_result) );
	}
	

	public function ram(){
		$q = $this->db->query("SELECT * FROM bots");
		$bnum = $q->num_rows();
		
		$q = $this->db->query("SELECT DISTINCT bot_ram FROM bots");
		$result = $q->result();
		
		$cpu_list = array();
		$country_result = array();
			foreach($result as $key => $value){
				$cpu_list[] = $value->bot_ram;
			}

			foreach($cpu_list as $key => $value){
				$query = $this->db->query("SELECT * FROM bots WHERE bot_ram='$value'");
				$num = $query->num_rows();
				
				$bot_location_name = preg_replace('/\s+/', '', $value);
				$country_result[] = array(
					'ram' => $value,
					'num' => $num,
					'per' => round(($num / $bnum) * 100) . '% (' .$num . '/' . $bnum .')'
				);
				
			}
			die( json_encode($country_result) );
	}
	
	
	public function storage(){
		$q = $this->db->query("SELECT * FROM bots");
		$bnum = $q->num_rows();
		
		$q = $this->db->query("SELECT DISTINCT bot_space FROM bots");
		$result = $q->result();
		
		$cpu_list = array();
		$country_result = array();
			foreach($result as $key => $value){
				$cpu_list[] = $value->bot_space;
			}

			foreach($cpu_list as $key => $value){
				$query = $this->db->query("SELECT * FROM bots WHERE bot_space='$value'");
				$num = $query->num_rows();
				
				$bot_location_name = preg_replace('/\s+/', '', $value);
				$country_result[] = array(
					'storage' => $value,
					'num' => $num,
					'per' => round(($num / $bnum) * 100) . '% (' .$num . '/' . $bnum .')'
				);
				
			}
			die( json_encode($country_result) );
	}
	
	
	public function os(){
		$q = $this->db->query("SELECT * FROM bots");
		$bnum = $q->num_rows();
		
		$q = $this->db->query("SELECT DISTINCT bot_os FROM bots");
		$result = $q->result();
		
		$osList = array(
			'10.0' => 'Windows 10',
			'6.3' => 'Windows 8.1',
			'6.2' => 'Windows 8',
			'6.1' => 'Windows 7',
			'6.0' => 'Windows Vista',
			'5.2' => 'Windows Server 2003',
			'5.1' => 'Windows XP',
			'5.0' => 'Windows 2000'
		);
		
		$cpu_list = array();
		$country_result = array();
			foreach($result as $key => $value){
				$cpu_list[] = $value->bot_os;
			}

			foreach($cpu_list as $key => $value){
				$query = $this->db->query("SELECT * FROM bots WHERE bot_os='$value'");
				$num = $query->num_rows();
				
				$bot_location_name = preg_replace('/\s+/', '', $value);
				$country_result[] = array(
					'os' => @$osList[$value],
					'num' => $num,
					'per' => round(($num / $bnum) * 100) . '% (' .$num . '/' . $bnum .')'
				);
				
			}
			die( json_encode($country_result) );
	}
	
	function datediff($interval, $datefrom, $dateto, $using_timestamps = false)
	{
		/*
		$interval can be:
		yyyy - Number of full years
		q - Number of full quarters
		m - Number of full months
		y - Difference between day numbers
		(eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33".
					 The datediff is "-32".)
		d - Number of full days
		w - Number of full weekdays
		ww - Number of full weeks
		h - Number of full hours
		n - Number of full minutes
		s - Number of full seconds (default)
		*/

		if (!$using_timestamps) {
			$datefrom = strtotime($datefrom, 0);
			$dateto = strtotime($dateto, 0);
		}
		$difference = $dateto - $datefrom; // Difference in seconds

		switch($interval) {
			case 'yyyy': // Number of full years
			$years_difference = floor($difference / 31536000);
			if (mktime(date("H", $datefrom),
								  date("i", $datefrom),
								  date("s", $datefrom),
								  date("n", $datefrom),
								  date("j", $datefrom),
								  date("Y", $datefrom)+$years_difference) > $dateto) {

			$years_difference--;
			}
			if (mktime(date("H", $dateto),
								  date("i", $dateto),
								  date("s", $dateto),
								  date("n", $dateto),
								  date("j", $dateto),
								  date("Y", $dateto)-($years_difference+1)) > $datefrom) {

			$years_difference++;
			}
			$datediff = $years_difference;
			break;

			case "q": // Number of full quarters
			$quarters_difference = floor($difference / 8035200);
			while (mktime(date("H", $datefrom),
									   date("i", $datefrom),
									   date("s", $datefrom),
									   date("n", $datefrom)+($quarters_difference*3),
									   date("j", $dateto),
									   date("Y", $datefrom)) < $dateto) {

			$months_difference++;
			}
			$quarters_difference--;
			$datediff = $quarters_difference;
			break;

			case "m": // Number of full months
			$months_difference = floor($difference / 2678400);
			while (mktime(date("H", $datefrom),
									   date("i", $datefrom),
									   date("s", $datefrom),
									   date("n", $datefrom)+($months_difference),
									   date("j", $dateto), date("Y", $datefrom)))
							{ // Sunday
			$days_remainder--;
			}
			if ($odd_days > 6) { // Saturday
			$days_remainder--;
			}
			$datediff = ($weeks_difference * 5) + $days_remainder;
			break;

			case "ww": // Number of full weeks
			$datediff = floor($difference / 604800);
			break;

			case "h": // Number of full hours
			$datediff = floor($difference / 3600);
			break;

			case "n": // Number of full minutes
			$datediff = floor($difference / 60);
			break;

			default: // Number of full seconds (default)
			$datediff = $difference;
			break;
		}

		return $datediff;
	}
	
	
	public function edit(){
		
		echo "d";
	}
	
	function createActionMenu($id, $status){
		if($status == '2'){
			$button = '<a href="task?id='.$id.'&a=reactivate">Reactivate</a>';
		}else{
			$button = '<a href="task?id='.$id.'&a=supspend">Suspend</a>';
		}
		$atts = array(
				'width'       => 800,
				'height'      => 600,
				'scrollbars'  => 'yes',
				'status'      => 'yes',
				'resizable'   => 'yes',
				'screenx'     => 0,
				'screeny'     => 0,
				'window_name' => '_blank'
		);

		return '
			<div class="btn-group">
				<button type="button" class="btn btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions <span class="caret"></span></button>
				<ul class="dropdown-menu dropdown-menu-right">
					<!-- <li>' . anchor_popup('edit/?id=' . $id, 'Edit', $atts) . '</li> -->
					<li>'.$button.'</li>
					<li><a href="task?id='.$id.'&a=remove">Remove</a></li>
				</ul>
			</div>
		';
	}
} 
