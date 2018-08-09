<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controller extends CI_Controller {
	
	public function redirector($path,$flashmsg,$flashmsgtype) {
		if($flashmsgtype == "error") {
			$toast = "$.toast({
				heading: 'An error occurred!',
				text: '$flashmsg',
				position: 'top-center',
				loaderBg:'#ff6849',
				icon: 'error',
				hideAfter: 3500
			});";
			$this->session->set_flashdata('global_message', $toast);
		} 
		elseif($flashmsgtype == "success") {
			$toast = "$.toast({
				heading: 'Congratulations!',
				text: '$flashmsg',
				position: 'top-center',
				loaderBg:'#ff6849',
				icon: 'success',
				hideAfter: 3500
			});";
			$this->session->set_flashdata('global_message', $toast);
		} 
		elseif($flashmsgtype == "warning") {
			$toast = "$.toast({
				heading: 'Warning!',
				text: '$flashmsg',
				position: 'top-center',
				loaderBg:'#ff6849',
				icon: 'warning',
				hideAfter: 3500
			});";
			$this->session->set_flashdata('global_message', $toast);
		}
		redirect(base_url($path));
	}
	
	public function loginpage() {
		if($this->session->userdata('userid') == "") { 
			$this->load->view('login');
		} else {
			$this->redirector("employees/dashboard","Welcome back ".$this->session->userdata('fullname')."!","success");
		}
	}
	
	public function submitLogin() {
		$useremail = $this->input->post('useremail');
		$userpass = $this->input->post('userpass');
		if($useremail != "" && $userpass != "") {
			$this->load->model("Users","user");
			$result = $this->user->search_Users(array("username" => $useremail, "password" => md5($userpass)));
			if($result !== false) {
				foreach($result as $row) {
					$xuserid 		= $row->id;
					$xusername 		= $row->username;
					$xuserfullname	= $row->fullname;
					$xuserlevel		= $row->level;
				}
				
				$newdata = array(
					'adminid'	=> $xuserid,
					'username'	=> $xusername,
					'fullname'	=> $xuserfullname,
					'userlevel'	=> $xuserlevel
				);

				$this->session->set_userdata($newdata);
				$this->redirector("employees/dashboard","Welcome back ".$this->session->userdata('fullname')."!","success");
			} else {
				$this->session->set_flashdata('global_message', "<span style='color:red'>Invalid Account!</span>");
				redirect(base_url("user/login"));
			}
		} else {
			$this->session->set_flashdata('global_message', "<span style='color:red'>Incomplete required parameter!</span>");
			redirect(base_url("user/login"));
		}
	}
	
	public function submitLogout() {
		$sess = array('userid', 'username','fullname','userlevel');
		$this->session->unset_userdata($sess);
		$this->session->set_flashdata('global_message', "<span style='color:green'>Successfully logged out!</span>");
		redirect(base_url("user/login"));
	}
	
	public function crud($action = '',$module = '',$search = '') {
		if($action != "") {
			if($action == "create" && $this->session->userdata('adminid') <> "") {
				if($module == "list") {
					if($this->session->userdata('userlevel') == "VIEWER") {
						$this->redirector("user/list","Unable to proceed insufficient account level!","error");
						exit;
					}
					if($this->session->userdata('adminid') <> "" && $this->input->post('username') <> "" && $this->input->post('password') <> "" && $this->input->post('fullname') <> "" && $this->input->post('level') <> "") {
						$data = array(
							"username" 	=> $this->input->post('username'),
							"password"	=> md5($this->input->post('password')),
							"fullname"	=> $this->input->post('fullname'),
							"level" 	=> $this->input->post('level')
						);
						$result = $this->Create_AdminList($data);
						if($result == false) {
							$this->redirector("user/list","An error occurred when creating record!","error");
						} else {
							$this->redirector("user/list","Successfully admin account!","success");
						}
					}  
					else {
						$this->redirector("user/list","Invalid User ID!","error");
					}
				}
				else {
					show_404();
				}
			} 
			elseif($action == "retrieve" && $this->session->userdata('adminid') <> "") {
				if($module == "list") {
					echo $this->List_AdminData();
				}
				else {
					show_404();
				}
			}
			elseif($action == "update" && $this->session->userdata('adminid') <> "") {
				if($module == "list") {
					if($this->session->userdata('userlevel') == "VIEWER") {
						$this->redirector("user/list","Unable to proceed insufficient account level!","error");
						exit;
					}
					if($this->session->userdata('adminid') <> "" && $this->input->post("row_id") <> "" && $this->input->post("username") <> "" && $this->input->post('fullname') <> "" && $this->input->post('level') <> "") {
						if($this->input->post('password') <> "") {
							$data = array(
								"username" 	=> $this->input->post('username'),
								"fullname" 	=> $this->input->post('fullname'),
								"level" 	=> $this->input->post('level'),
								"password" 	=> md5($this->input->post('password'))
							);
						} else {
							$data = array(
								"username" 	=> $this->input->post('username'),
								"fullname" 	=> $this->input->post('fullname'),
								"level" 	=> $this->input->post('level')
							);

						}
						$result = $this->Update_AdminData($data,$this->input->post('row_id'));
						if($result == false) {
							$this->redirector("user/list","An error occurred when updating record!","error");
						} else {
							$this->redirector("user/list","Successfully update admin data!","success");
						}
					} 
					else {
						$this->redirector("user/list","Invalid parameters passed!","error");
					}
				}
				elseif($module == "account") {
					if($this->session->userdata('adminid') <> "") {
						if($this->input->post('password') <> "") {
							$data = array(
								"fullname" 	=> $this->input->post('fullname'),
								"password" 	=> md5($this->input->post('password'))
							);
						} else {
							$data = array(
								"fullname" 	=> $this->input->post('fullname')
							);

						}
						$result = $this->Update_AdminData($data,$this->session->userdata('adminid'));
						if($result == false) {
							$this->redirector("user/manage","An error occurred when updating record!","error");
						} else {
							$this->redirector("user/logout","Successfully update account data!","success");
						}
					}
				}
				else {
					show_404();
				}
			}
			elseif($action == "delete" && $this->session->userdata('adminid') <> "") {
				if($module == "list") {
					if($this->session->userdata('userlevel') == "VIEWER") {
						$this->redirector("user/list","Unable to proceed insufficient account level!","error");
						exit;
					}
					if($this->session->userdata('adminid') <> "" && $this->input->post('id') <> "") {
						$result = $this->Delete_AdminData($this->session->userdata('adminid'),$this->input->post('id'));
						if($result == false) {
							$this->redirector("user/list","An error occurred when deleting record!","error");
						} else {
							echo true;
						}
					}
					else {
						$this->redirector("user/list","Invalid parameters passed!","error");
					}
				}
				else {
					show_404();
				}
			}
		}
		else {
			show_404();
		}
	}
	
	public function prep_update($type) {
		if($this->input->post('id') <> "" && $this->session->userdata('adminid') <> "") {
			$this->load->model('Users','user');
			if($this->session->userdata('userlevel') == "VIEWER") {
				$data = "Unable to proceed insufficient account level!";
			} else {
				if($type == "list") {
					$data = $this->user->search_Users(array("id"=>$this->input->post('id')));
				}
				else {
					echo $type;
				}
			}
			echo json_encode($data);
		}
		else {
			show_404();
		}
	}
	
	public function Create_AdminList($param) {
		if(count($param) > 0) {
			$this->load->model('Users','user');
			return $this->user->insert_Users($param);
		} else {
			return false;
		}		
	}
	
	public function List_AdminData() {
		$this->load->model('Users','user');
		$data = $this->user->get_Users();
		if($data !== false) {
			$html = "";
			foreach($data as $row) {
				$html .= "<tr>";
				$html .= "<td>".$row->fullname."</td>";
				$html .= "<td>".$row->username."</td>";
				$html .= "<td>".$row->level."</td>";
				$html .= "<td>".$row->date_created."</td>";
				$html .= "<td>
							<button data-toggle='tooltip' title='View Record'  type='button' onclick=\"fneditAdminList('".$row->id."');\" class='btn btn-info'><i class='fa fa-desktop'></i></button>
							<button data-toggle='tooltip' title='Delete Record' type='button' onclick=\"fndeleteAdminList('".$row->id."');\" class='btn btn-warning'><i class='fa fa-eraser'></i></button>
						  </td>";
			}
			return $html;
		}
	}
	
	public function Update_AdminData($param = array(),$id) {
		if(count($param) > 0) {
			$this->load->model('Users','user');
			return $this->user->update_Users($param,$id);
		} else {
			return false;
		}		
	}
	
	public function Delete_AdminData($adminid,$id) {
		if($adminid <> "" && $id <> "") {
			$this->load->model('Users','user');
			$rr = $this->user->delete_Users($adminid,$id);
			return $rr;
		} else {
			return false;
		}
	}
}