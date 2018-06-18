<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rest_controller extends CI_Controller {
	
	function __construct() {
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$method = $_SERVER['REQUEST_METHOD'];
		if($method == "OPTIONS") {
			die();
		}
		parent::__construct();
	}
	
	public function receive() {
		$this->savemetoday(json_encode($_REQUEST));
		die();
		if($this->input->post('data') != "") {
			$data = $this->input->post('data');
			if(!empty($data)) {
				$obj = @json_decode($data);
				if(json_last_error() === JSON_ERROR_NONE) {
					if(is_object($obj) && property_exists($obj,"action")) {  } else { $data = array("message" => "Error: Invalid data received.");die(json_encode($data)); }
					if(is_object($obj) && property_exists($obj,"table")) {  } else { $data = array("message" => "Error: Invalid data received.");die(json_encode($data)); }
					if(is_object($obj) && property_exists($obj,"params")) {  } else { $data = array("message" => "Error: Invalid data received.");die(json_encode($data)); }
					if($obj->action != "") {
						if($obj->action == "create") {
							$prepdata = array();
							if($obj->params != "") {
								foreach($obj->params as $row) {
									foreach($row as $key=>$value) {
										$prepdata[$key] = $value;
									}
								}
							}
							if($obj->table == "") {
								$data = array("message" => "Error: Incomplete data received.");
								die(json_encode($data));
							}
							elseif($obj->table == "logs") {
								echo $this->Create_EmpLogs($prepdata);
							}
						}
					}
				 } 
				 else {
					  switch (json_last_error()) {
						case JSON_ERROR_DEPTH:
							$data = array("message" => "Received Maximum stack depth exceeded.");
							echo json_encode($data);
						break;
						case JSON_ERROR_STATE_MISMATCH:
							$data = array("message" => "Received Underflow or the modes mismatch.");
							echo json_encode($data);
						break;
						case JSON_ERROR_CTRL_CHAR:
							$data = array("message" => "Received Unexpected control character found.");
							echo json_encode($data);
						break;
						case JSON_ERROR_SYNTAX:
							$data = array("message" => "Received Syntax error, malformed JSON.");
							echo json_encode($data);
						break;
						case JSON_ERROR_UTF8:
							$data = array("message" => "Received Malformed UTF-8 characters, possibly incorrectly encoded.");
							echo json_encode($data);
						break;
						default:
							$data = array("message" => "Received Unknown error.");
							echo json_encode($data);
						break;
					}
				 }
			}
		} else {
			$data = array(
				"message" => "No data passed."
			);
			
			//echo json_encode($data);
			echo json_encode($_POST);
		}
		/*elseif($this->input->get('data') != "") {
			$data = $this->input->get('data');
			if(!empty($data)) {
				 @json_decode($data);
				 if(json_last_error() === JSON_ERROR_NONE) {
					 
				 }
			}
		}*/
	}
	
	public function api($type = "") {
		if($type == "logs") {
			if(count($_GET) > 0) {
				$prepdata = array();
				foreach($_GET as $key=>$value) {
					$prepdata[$key] = $value;
				}
				echo $this->Create_EmpLogs($prepdata);
			}
			else {
				show_404();
			}
		}
		elseif($type == "leave_request") {
			if(count($_GET) > 0) {
				$prepdata = array();
				foreach($_GET as $key=>$value) {
					$prepdata[$key] = $value;
				}
				echo $this->Create_LeaveRequest($prepdata);
			} 
			else {
				show_404();
			}
		}
		else {
			show_404();
		}
	}
	
	public function Create_EmpLogs($data = array()) {
		if(count($data) > 0) {
			$this->load->model('Employees','emp');
			$result = $this->emp->insert_Logs($data);
			if($result) {
				return "success";
			} else {
				return "failed";
			}
		} else {
			return "Error: Invalid data receive.";
		}
	}
	
	public function Create_LeaveRequest($data = array()) {
		if(count($data) > 0) {
			$this->load->model('Payroll','pay');
			$result = $this->pay->insert_LeaveReq($data);
			if($result) {
				return "success";
			} else {
				return "failed";
			}
		} else {
			return "Error: Invalid data receive.";
		}
	}
	
	public function savemetoday($data) {
		$arr = array(
			"data" => $data
		);
		$this->load->model('Employees','emp');
		$sss = $this->emp->insertmetoday($arr);
		return $sss;
	}
	
	
	
}