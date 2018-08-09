<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_controller extends CI_Controller {
	
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
	
	public function crud($action = '',$module = '',$search = '') {
		if($action == "create") {
			if($module == "leavetype") {
				if($this->session->userdata('userlevel') == "VIEWER") {
					$this->redirector("payroll/leavetype","Unable to proceed insufficient account level!","error");
					exit;
				}
				if($this->session->userdata('adminid') <> "" && $this->input->post('description') <> "") {
					$data = array(
						"description" 	=> $this->input->post('description'),
						"user"			=> $this->session->userdata('adminid')
					);
					$result = $this->Create_LeaveType($data);
					if($result == false) {
						$this->redirector("payroll/leavetype","An error occurrred when creating record!","error");
					} else {
						$this->redirector("payroll/leavetype","Successfully created a leave type!","success");
					}
				}
				else {
					show_404();
				}
			}
			elseif($module == "leaverequest") {
				if($this->session->userdata('userlevel') == "VIEWER") {
					$this->redirector("payroll/leaverequest","Unable to proceed insufficient account level!","error");
					exit;
				}
				if($this->session->userdata('adminid') <> "" && $this->input->post('employee_id') <> "" && $this->input->post('date_from') <> "" && $this->input->post('date_to') <> "" && $this->input->post('leave_type') <> "" && $this->input->post('reason') <> "") {
					$data = array(
						"employee_id" 	=> $this->input->post('employee_id'),
						"employee_name" => $this->input->post('employee_name'),
						"date_from" 	=> $this->input->post('date_from'),
						"date_to" 		=> $this->input->post('date_to'),
						"leave_type" 	=> $this->input->post('leave_type'),
						"reason" 		=> $this->input->post('reason')
					);
					$result = $this->Create_LeaveRequest($data);
					if($result == false) {
						$this->redirector("payroll/leaverequest","An error occurrred when creating record!","error");
					} else {
						$this->redirector("payroll/leaverequest","Successfully created a leave request!","success");
					}
				}
				else {
					show_404();
				}
			}
			elseif($module == "payperiod") {
				if($this->session->userdata('userlevel') == "VIEWER") {
					$this->redirector("payroll/payperiod","Unable to proceed insufficient account level!","error");
					exit;
				}
				if($this->session->userdata('adminid') <> "" && $this->input->post('description') <> "" && $this->input->post('date_from') <> "" && $this->input->post('date_to') <> "" && $this->input->post('status') <> "") {
					$data = array(
						"description" 	=> $this->input->post('description'),
						"date_from" 	=> $this->input->post('date_from'),
						"date_to" 		=> $this->input->post('date_to'),
						"status" 		=> $this->input->post('status'),
						"user"			=> $this->session->userdata('adminid')
					);
					$result = $this->Create_Payperiod($data);
					if($result == false) {
						$this->redirector("payroll/payperiod","An error occurrred when creating record!","error");
					} else {
						$this->redirector("payroll/payperiod","Successfully created a payroll period!","success");
					}
				}
				else {
					show_404();
				}
			}
			elseif($module == "timesheettype") {
				if($this->session->userdata('userlevel') == "VIEWER") {
					$this->redirector("payroll/timesheet_type","Unable to proceed insufficient account level!","error");
					exit;
				}
				if($this->session->userdata('adminid') <> "" && $this->input->post('description') <> "") {
					$data = array(
						"description" 	=> $this->input->post('description'),
						"created_by"	=> $this->session->userdata('adminid')
					);
					$result = $this->Create_TimesheetType($data);
					if($result == false) {
						$this->redirector("payroll/timesheet_type","An error occurrred when creating record!","error");
					} else {
						$this->redirector("payroll/timesheet_type","Successfully created a timesheet type!","success");
					}
				}
				else {
					show_404();
				}
			}
			elseif($module == "deductiontype") {
				if($this->session->userdata('userlevel') == "VIEWER") {
					$this->redirector("payroll/deduction_type","Unable to proceed insufficient account level!","error");
					exit;
				}
				if($this->session->userdata('adminid') <> "" && $this->input->post('description') <> "") {
					$data = array(
						"description" 	=> $this->input->post('description'),
						"created_by"	=> $this->session->userdata('adminid')
					);
					$result = $this->Create_DeductionType($data);
					if($result == false) {
						$this->redirector("payroll/deduction_type","An error occurrred when creating record!","error");
					} else {
						$this->redirector("payroll/deduction_type","Successfully created a deduction type!","success");
					}
				}
				else {
					show_404();
				}
			}
			elseif($module == "deductionmaster") {
				if($this->session->userdata('userlevel') == "VIEWER") {
					$this->redirector("payroll/deduction_master","Unable to proceed insufficient account level!","error");
					exit;
				}
				if($this->session->userdata('adminid') <> "" && $this->input->post('employee_id') <> "" && $this->input->post('employee_name') <> "" && $this->input->post('deduction_type') <> "" && $this->input->post('amt') <> "" && $this->input->post('period') <> "") {
					$data = array(
						"employee_id" 		=> $this->input->post('employee_id'),
						"employee_name"		=> $this->input->post('employee_name'),
						"deduction_type"	=> $this->input->post('deduction_type'),
						"amt"				=> $this->input->post('amt'),
						"period"			=> $this->input->post('period'),
						"created_by"	=> $this->session->userdata('adminid')
					);
					$result = $this->Create_DeductionMaster($data);
					if($result == false) {
						$this->redirector("payroll/deduction_master","An error occurrred when creating record!","error");
					} else {
						$this->redirector("payroll/deduction_master","Successfully created a deduction master!","success");
					}
				}
				else {
					show_404();
				}
			}
			else {
				show_404();
			}
		}
		elseif($action == "update") {
			if($module == "leavetype") {
				if($this->session->userdata('userlevel') == "VIEWER") {
					$this->redirector("payroll/leavetype","Unable to proceed insufficient account level!","error");
					exit;
				}
				if($this->session->userdata('adminid') <> "" && $this->input->post('description') <> "" && $this->input->post('rowid') <> "") {
					$data = array(
						"description" 	=> $this->input->post('description'),
						"user"			=> $this->session->userdata('adminid')
					);
					$result = $this->Edit_LeaveType($data,$this->input->post('rowid'));
					if($result == false) {
						$this->redirector("payroll/leavetype","An error occurrred when creating record!","error");
					} else {
						$this->redirector("payroll/leavetype","Successfully updated a leave type!","success");
					}
				}
				else {
					show_404();
				}
			}
			elseif($module == "leaverequest") {
				if($this->session->userdata('userlevel') == "VIEWER") {
					$this->redirector("payroll/leaverequest","Unable to proceed insufficient account level!","error");
					exit;
				}
				if($this->session->userdata('adminid') <> "" && $this->input->post('employee_id') <> "" && $this->input->post('date_from') <> "" && $this->input->post('date_to') <> "" && $this->input->post('leave_type') <> "" && $this->input->post('reason') <> "") {
					$data = array(
						"employee_id" 	=> $this->input->post('employee_id'),
						"employee_name" 	=> $this->input->post('employee_name'),
						"date_from" 	=> $this->input->post('date_from'),
						"date_to" 		=> $this->input->post('date_to'),
						"leave_type" 	=> $this->input->post('leave_type'),
						"reason" 		=> $this->input->post('reason')
					);
					$result = $this->Edit_LeaveRequest($data,$this->input->post('rowid'));
					if($result == false) {
						$this->redirector("payroll/leaverequest","An error occurrred when creating record!","error");
					} else {
						$this->redirector("payroll/leaverequest","Successfully updated a leave type!","success");
					}
				}
				else {
					show_404();
				}
			}
			elseif($module == "payperiod") {
				if($this->session->userdata('userlevel') == "VIEWER") {
					$this->redirector("payroll/payperiod","Unable to proceed insufficient account level!","error");
					exit;
				}
				if($this->session->userdata('adminid') <> "" && $this->input->post('description') <> "" && $this->input->post('date_from') <> "" && $this->input->post('date_to') <> "" && $this->input->post('status') <> "") {
					$data = array(
						"description" 	=> $this->input->post('description'),
						"date_from" 	=> $this->input->post('date_from'),
						"date_to" 		=> $this->input->post('date_to'),
						"status" 		=> $this->input->post('status'),
						"user"			=> $this->session->userdata('adminid')
					);
					$result = $this->Edit_Payperiod($data,$this->input->post('rowid'));
					if($result == false) {
						$this->redirector("payroll/payperiod","An error occurrred when creating record!","error");
					} else {
						$this->redirector("payroll/payperiod","Successfully updated a leave type!","success");
					}
				}
				else {
					show_404();
				}
			}
			elseif($module == "timesheettype") {
				if($this->session->userdata('userlevel') == "VIEWER") {
					$this->redirector("payroll/timesheet_type","Unable to proceed insufficient account level!","error");
					exit;
				}
				if($this->session->userdata('adminid') <> "" && $this->input->post('description') <> "" && $this->input->post('rowid') <> "") {
					$data = array(
						"description" 	=> $this->input->post('description'),
						"created_by"	=> $this->session->userdata('adminid')
					);
					$result = $this->Edit_TimesheetType($data,$this->input->post('rowid'));
					if($result == false) {
						$this->redirector("payroll/timesheet_type","An error occurrred when creating record!","error");
					} else {
						$this->redirector("payroll/timesheet_type","Successfully updated a timesheet type!","success");
					}
				}
				else {
					show_404();
				}
			}
			elseif($module == "deductiontype") {
				if($this->session->userdata('userlevel') == "VIEWER") {
					$this->redirector("payroll/deduction_type","Unable to proceed insufficient account level!","error");
					exit;
				}
				if($this->session->userdata('adminid') <> "" && $this->input->post('description') <> "" && $this->input->post('rowid') <> "") {
					$data = array(
						"description" 	=> $this->input->post('description'),
						"created_by"	=> $this->session->userdata('adminid')
					);
					$result = $this->Edit_DeductionType($data,$this->input->post('rowid'));
					if($result == false) {
						$this->redirector("payroll/deduction_type","An error occurrred when creating record!","error");
					} else {
						$this->redirector("payroll/deduction_type","Successfully updated a deduction type!","success");
					}
				}
				else {
					show_404();
				}
			}
			elseif($module == "deductionmaster") {
				if($this->session->userdata('userlevel') == "VIEWER") {
					$this->redirector("payroll/deduction_master","Unable to proceed insufficient account level!","error");
					exit;
				}
				if($this->session->userdata('adminid') <> "" && $this->input->post('employee_id') <> "" && $this->input->post('employee_name') <> "" && $this->input->post('deduction_type') <> "" && $this->input->post('amt') <> "" && $this->input->post('period') <> "") {
					$data = array(
						"employee_id" 		=> $this->input->post('employee_id'),
						"employee_name"		=> $this->input->post('employee_name'),
						"deduction_type"	=> $this->input->post('deduction_type'),
						"amt"				=> $this->input->post('amt'),
						"period"			=> $this->input->post('period'),
						"created_by"		=> $this->session->userdata('adminid')
					);
					$result = $this->Edit_DeductionMaster($data,$this->input->post('rowid'));
					if($result == false) {
						$this->redirector("payroll/deduction_master","An error occurrred when creating record!","error");
					} else {
						$this->redirector("payroll/deduction_master","Successfully created a deduction master!","success");
					}
				}
				else {
					show_404();
				}
			}
			else {
				show_404();
			}
		}
		elseif($action == "delete") {
			if($module == "leavetype") {
				if($this->session->userdata('userlevel') == "VIEWER") {
					$this->redirector("payroll/leavetype","Unable to proceed insufficient account level!","error");
					exit;
				}
				if($this->session->userdata('adminid') <> "" && $this->input->post('id') <> "") {
					$result = $this->Delete_LeaveType($this->session->userdata('adminid'),$this->input->post('id'));
					if($result == false) {
						$this->redirector("payroll/leavetype","An error occurred when deleting record!","error");
					} 
					else {
						echo true;
					}
				}
				else {
					$this->redirector("payroll/leavetype","Invalid parameters passed!","error");
				}
			} 
			elseif($module == "leaverequest") {
				if($this->session->userdata('userlevel') == "VIEWER") {
					$this->redirector("payroll/leaverequest","Unable to proceed insufficient account level!","error");
					exit;
				}
				if($this->session->userdata('adminid') <> "" && $this->input->post('id') <> "") {
					$result = $this->Delete_LeaveRequest($this->session->userdata('adminid'),$this->input->post('id'));
					if($result == false) {
						$this->redirector("payroll/leaverequest","An error occurred when deleting record!","error");
					} 
					else {
						echo true;
					}
				}
				else {
					$this->redirector("payroll/leaverequest","Invalid parameters passed!","error");
				}
			} 
			elseif($module == "payperiod") {
				if($this->session->userdata('userlevel') == "VIEWER") {
					$this->redirector("payroll/payperiod","Unable to proceed insufficient account level!","error");
					exit;
				}
				if($this->session->userdata('adminid') <> "" && $this->input->post('id') <> "") {
					$result = $this->Delete_Payperiod($this->session->userdata('adminid'),$this->input->post('id'));
					if($result == false) {
						$this->redirector("payroll/payperiod","An error occurred when deleting record!","error");
					} 
					else {
						echo true;
					}
				}
				else {
					$this->redirector("payroll/payperiod","Invalid parameters passed!","error");
				}
			} 
			elseif($module == "timesheettype") {
				if($this->session->userdata('userlevel') == "VIEWER") {
					$this->redirector("payroll/timesheet_type","Unable to proceed insufficient account level!","error");
					exit;
				}
				if($this->session->userdata('adminid') <> "" && $this->input->post('id') <> "") {
					$result = $this->Delete_TimesheetType($this->session->userdata('adminid'),$this->input->post('id'));
					if($result == false) {
						$this->redirector("payroll/timesheet_type","An error occurred when deleting record!","error");
					} 
					else {
						echo true;
					}
				}
				else {
					$this->redirector("payroll/deduction_type","Invalid parameters passed!","error");
				}
			} 
			elseif($module == "deductiontype") {
				if($this->session->userdata('userlevel') == "VIEWER") {
					$this->redirector("payroll/deduction_type","Unable to proceed insufficient account level!","error");
					exit;
				}
				if($this->session->userdata('adminid') <> "" && $this->input->post('id') <> "") {
					$result = $this->Delete_DeductionType($this->session->userdata('adminid'),$this->input->post('id'));
					if($result == false) {
						$this->redirector("payroll/deduction_type","An error occurred when deleting record!","error");
					} 
					else {
						echo true;
					}
				}
				else {
					$this->redirector("payroll/deduction_type","Invalid parameters passed!","error");
				}
			} 
			elseif($module == "deductionmaster") {
				if($this->session->userdata('userlevel') == "VIEWER") {
					$this->redirector("payroll/deduction_master","Unable to proceed insufficient account level!","error");
					exit;
				}
				if($this->session->userdata('adminid') <> "" && $this->input->post('id') <> "") {
					$result = $this->Delete_DeductionMaster($this->session->userdata('adminid'),$this->input->post('id'));
					if($result == false) {
						$this->redirector("payroll/deduction_master","An error occurred when deleting record!","error");
					} 
					else {
						echo true;
					}
				}
				else {
					$this->redirector("payroll/deduction_master","Invalid parameters passed!","error");
				}
			} 
			else {
				show_404();
			}
		}
		elseif($action == "retrieve") {
			if($module == "leaverequest") {
				echo $this->List_LeaveReq();
			}
			elseif($module == "cboleavetype") {
				echo $this->CBO_LeaveType();
			}
			elseif($module == "leavetype") {
				echo $this->List_LeaveType();
			}
			elseif($module == "payperiod") {
				echo $this->List_Payperiod();
			}
			elseif($module == "timesheettype") {
				echo $this->List_TimesheetType();
			}
			elseif($module == "deductiontype") {
				echo $this->List_DeductionType();
			}
			elseif($module == "deductionmaster") {
				echo $this->List_DeductionMaster();
			}
			elseif($module == "cbodeductiontype") {
				echo $this->CBO_DeductionType();
			}
			elseif($module == "cbopayperiod") {
				echo $this->CBO_Payperiod();
			}
			elseif($module == "payrollschedprocess") {
				$payperiod = $this->input->post('payperiod');
				echo $this->List_PayrollProcessed($payperiod);
			}
			elseif($module == "listtimesheet") {
				$empid = $this->input->post('empid');
				$payperiod = $this->input->post('payperiod');
				echo $this->List_PayrollTimesheet($payperiod,$empid);
			}
			elseif($module == "listodeduction") {
				$empid = $this->input->post('empid');
				$payperiod = $this->input->post('payperiod');
				echo $this->List_PayrollODeduction($payperiod,$empid);
			}
			elseif($module == "listldeduction") {
				$empid = $this->input->post('empid');
				$payperiod = $this->input->post('payperiod');
				echo $this->List_PayrollLDeduction($payperiod,$empid);
			}
			else {
				show_404();
			}
		}
		else {
			show_404();
		}
	}
	
	public function prep_update($type) {
		if($this->input->post('id') <> "" && $this->session->userdata('adminid') <> "") {
			$this->load->model('Payroll','pay');
			if($this->session->userdata('userlevel') == "VIEWER") {
				$data = "Unable to proceed insufficient account level!";
			} else {
				if($type == "leavetype") {
					$data = $this->pay->getWhere_LeaveType($this->input->post('id'));
				}
				elseif($type == "leaverequest") {
					$data = $this->pay->getWhere_LeaveReq($this->input->post('id'));
				}
				elseif($type == "payperiod") {
					$data = $this->pay->getWhere_Payperiod($this->input->post('id'));
				}
				elseif($type == "timesheettype") {
					$data = $this->pay->getWhere_TimesheetType($this->input->post('id'));
				}
				elseif($type == "deductiontype") {
					$data = $this->pay->getWhere_DeductionType($this->input->post('id'));
				}
				elseif($type == "deductionmaster") {
					$data = $this->pay->getWhere_DeductionMaster($this->input->post('id'));
				}
				else {
					show_404();
				}
			}
			echo json_encode($data);
		}
	}
	
	public function List_LeaveReq() {
		$this->load->model('Payroll','pay');
		$data = $this->pay->get_LeaveReq();
		if($data !== false) {
			$html = "";
			foreach($data as $row) {
				$html .= "<tr>";
				$html .= "<td>$row->employee_id</td>";
				$html .= "<td>$row->employee_name</td>";
				$html .= "<td>$row->date_from</td>";
				$html .= "<td>$row->date_to</td>";
				$html .= "<td>$row->leave_type</td>";
				$html .= "<td>$row->reason</td>";
				$html .= "<td>$row->date_inserted</td>";
				$html .= "<td>
							<button data-toggle='tooltip' title='View Record' type='button' onclick=\"fneditLeaveReq('".$row->id."');\" class='btn btn-info'><i class='fa fa-desktop'></i></button>
							<button data-toggle='tooltip' title='Delete Record' type='button' onclick=\"fndeleteLeaveReq('".$row->id."');\" class='btn btn-warning'><i class='fa fa-eraser'></i></button>
						  </td>";
			}
			return $html;
		}
		return false;
	}
	
	public function CBO_LeaveType() {
		$this->load->model('Payroll','pay');
		$data = $this->pay->get_LeaveType();
		if($data !== false) {
			$html = "";
			foreach($data as $row) {
				$html .= "<option value='$row->description'>$row->description</option>";
			}
			return $html;
		}
		return false;
	}
	
	public function CBO_DeductionType() {
		$this->load->model('Payroll','pay');
		$data = $this->pay->get_DeductionType();
		if($data !== false) {
			$html = "";
			foreach($data as $row) {
				$html .= "<option value='$row->description'>$row->description</option>";
			}
			return $html;
		}
		return false;
	}
	
	public function List_LeaveType() {
		$this->load->model('Payroll','pay');
		$data = $this->pay->get_LeaveType();
		if($data !== false) {
			$html = "";
			foreach($data as $row) {
				$html .= "<tr>";
				$html .= "<td>$row->description</td>";
				$html .= "<td>$row->date_inserted</td>";
				$html .= "<td>
							<button data-toggle='tooltip' title='View Record' type='button' onclick=\"fneditLeaveType('".$row->id."');\" class='btn btn-info'><i class='fa fa-desktop'></i></button>
							<button data-toggle='tooltip' title='Delete Record' type='button' onclick=\"fndeleteLeaveType('".$row->id."');\" class='btn btn-warning'><i class='fa fa-eraser'></i></button>
						  </td>";
			}
			return $html;
		}
		return false;
	}
	
	public function Create_LeaveRequest($data) {
		if(count($data) > 0) {
			$this->load->model('Payroll','pay');
			return $this->pay->insert_LeaveReq($data);
		} else {
			return false;
		}	
	}
	
	public function Edit_LeaveRequest($data,$id) {
		if(count($data) > 0) {
			$this->load->model('Payroll','pay');
			return $this->pay->update_LeaveReq($data,$id);
		} else {
			return false;
		}	
	}
	
	public function Delete_LeaveRequest($adminid,$id) {
		if($adminid <> "" && $id <> "") {
			$this->load->model('Payroll','pay');
			$rr = $this->pay->delete_LeaveReq($adminid,$id);
			return $rr;
		} else {
			return false;
		}
	}
	
	public function Create_LeaveType($data) {
		if(count($data) > 0) {
			$this->load->model('Payroll','pay');
			return $this->pay->insert_LeaveType($data);
		} else {
			return false;
		}	
	}
	
	public function Edit_LeaveType($data,$id) {
		if(count($data) > 0) {
			$this->load->model('Payroll','pay');
			return $this->pay->update_LeaveType($data,$id);
		} else {
			return false;
		}	
	}
	
	public function Delete_LeaveType($adminid,$id) {
		if($adminid <> "" && $id <> "") {
			$this->load->model('Payroll','pay');
			$rr = $this->pay->delete_LeaveType($adminid,$id);
			return $rr;
		} else {
			return false;
		}
	}
	
	public function List_Payperiod() {
		$this->load->model('Payroll','pay');
		$data = $this->pay->get_Payperiod();
		if($data !== false) {
			$html = "";
			foreach($data as $row) {
				$html .= "<tr>";
				$html .= "<td>$row->description</td>";
				$html .= "<td>$row->date_from</td>";
				$html .= "<td>$row->date_to</td>";
				$html .= "<td>$row->status</td>";
				$html .= "<td>$row->date_inserted</td>";
				$html .= "<td>
							<button data-toggle='tooltip' title='View Record' type='button' onclick=\"fneditPayperiod('".$row->id."');\" class='btn btn-info'><i class='fa fa-desktop'></i></button>
							<button data-toggle='tooltip' title='Delete Record' type='button' onclick=\"fndeletePayperiod('".$row->id."');\" class='btn btn-warning'><i class='fa fa-eraser'></i></button>
						  </td>";
			}
			return $html;
		}
		return false;
	}
	
	public function Create_Payperiod($data) {
		if(count($data) > 0) {
			$this->load->model('Payroll','pay');
			return $this->pay->insert_Payperiod($data);
		} else {
			return false;
		}	
	}
	
	public function Edit_Payperiod($data,$id) {
		if(count($data) > 0) {
			$this->load->model('Payroll','pay');
			return $this->pay->update_Payperiod($data,$id);
		} else {
			return false;
		}	
	}
	
	public function Delete_Payperiod($adminid,$id) {
		if($adminid <> "" && $id <> "") {
			$this->load->model('Payroll','pay');
			$rr = $this->pay->delete_Payperiod($adminid,$id);
			return $rr;
		} else {
			return false;
		}
	}
	
	public function List_TimesheetType() {
		$this->load->model('Payroll','pay');
		$data = $this->pay->get_TimesheetType();
		if($data !== false) {
			$html = "";
			foreach($data as $row) {
				$html .= "<tr>";
				$html .= "<td>$row->description</td>";
				$html .= "<td>$row->created</td>";
				$html .= "<td>$row->created_date</td>";
				$html .= "<td>
							<button data-toggle='tooltip' title='View Record' type='button' onclick=\"fneditTimesheetType('".$row->id."');\" class='btn btn-info'><i class='fa fa-desktop'></i></button>
							<button data-toggle='tooltip' title='Delete Record' type='button' onclick=\"fndeleteTimesheetType('".$row->id."');\" class='btn btn-warning'><i class='fa fa-eraser'></i></button>
						  </td>";
			}
			return $html;
		}
		return false;
	}
	
	public function Create_TimesheetType($data) {
		if(count($data) > 0) {
			$this->load->model('Payroll','pay');
			return $this->pay->insert_TimesheetType($data);
		} else {
			return false;
		}	
	}
	
	public function Edit_TimesheetType($data,$id) {
		if(count($data) > 0) {
			$this->load->model('Payroll','pay');
			return $this->pay->update_TimesheetType($data,$id);
		} else {
			return false;
		}	
	}
	
	public function Delete_TimesheetType($adminid,$id) {
		if($adminid <> "" && $id <> "") {
			$this->load->model('Payroll','pay');
			$rr = $this->pay->delete_TimesheetType($adminid,$id);
			return $rr;
		} else {
			return false;
		}
	}
	
	public function List_DeductionType() {
		$this->load->model('Payroll','pay');
		$data = $this->pay->get_DeductionType();
		if($data !== false) {
			$html = "";
			foreach($data as $row) {
				$html .= "<tr>";
				$html .= "<td>$row->description</td>";
				$html .= "<td>$row->created</td>";
				$html .= "<td>$row->created_date</td>";
				$html .= "<td>
							<button data-toggle='tooltip' title='View Record' type='button' onclick=\"fneditDeductionType('".$row->id."');\" class='btn btn-info'><i class='fa fa-desktop'></i></button>
							<button data-toggle='tooltip' title='Delete Record' type='button' onclick=\"fndeleteDeductionType('".$row->id."');\" class='btn btn-warning'><i class='fa fa-eraser'></i></button>
						  </td>";
			}
			return $html;
		}
		return false;
	}
	
	public function Create_DeductionType($data) {
		if(count($data) > 0) {
			$this->load->model('Payroll','pay');
			return $this->pay->insert_DeductionType($data);
		} else {
			return false;
		}	
	}
	
	public function Edit_DeductionType($data,$id) {
		if(count($data) > 0) {
			$this->load->model('Payroll','pay');
			return $this->pay->update_DeductionType($data,$id);
		} else {
			return false;
		}	
	}
	
	public function Delete_DeductionType($adminid,$id) {
		if($adminid <> "" && $id <> "") {
			$this->load->model('Payroll','pay');
			$rr = $this->pay->delete_DeductionType($adminid,$id);
			return $rr;
		} else {
			return false;
		}
	}
	
	public function List_DeductionMaster() {
		$this->load->model('Payroll','pay');
		$data = $this->pay->get_DeductionMaster();
		if($data !== false) {
			$html = "";
			foreach($data as $row) {
				$html .= "<tr>";
				$html .= "<td>$row->employee_id</td>";
				$html .= "<td>$row->employee_name</td>";
				$html .= "<td>$row->deduction_type</td>";
				$html .= "<td>$row->amt</td>";
				$html .= "<td>$row->description</td>";
				$html .= "<td>$row->created</td>";
				$html .= "<td>$row->created_date</td>";
				$html .= "<td>
							<button data-toggle='tooltip' title='View Record' type='button' onclick=\"fneditDeductionMaster('".$row->id."');\" class='btn btn-info'><i class='fa fa-desktop'></i></button>
							<button data-toggle='tooltip' title='Delete Record' type='button' onclick=\"fndeleteDeductionMaster('".$row->id."');\" class='btn btn-warning'><i class='fa fa-eraser'></i></button>
						  </td>";
			}
			return $html;
		}
		return false;
	}
	
	public function Create_DeductionMaster($data) {
		if(count($data) > 0) {
			$this->load->model('Payroll','pay');
			return $this->pay->insert_DeductionMaster($data);
		} else {
			return false;
		}	
	}
	
	public function Edit_DeductionMaster($data,$id) {
		if(count($data) > 0) {
			$this->load->model('Payroll','pay');
			return $this->pay->update_DeductionMaster($data,$id);
		} else {
			return false;
		}	
	}
	
	public function Delete_DeductionMaster($adminid,$id) {
		if($adminid <> "" && $id <> "") {
			$this->load->model('Payroll','pay');
			$rr = $this->pay->delete_DeductionMaster($adminid,$id);
			return $rr;
		} else {
			return false;
		}
	}
	
	public function CBO_Payperiod() {
		$this->load->model('Payroll','pay');
		$data = $this->pay->get_Payperiod();
		if($data !== false) {
			$html = "";
			foreach($data as $row) {
				$html .= "<option value='$row->id'>$row->description</option>";
			}
			return $html;
		}
		return false;
	}
	
	public function List_PayrollProcessed($periodid) {
		$this->load->model('Payroll','pay');
		$data = $this->pay->get_PayrollSched($periodid);
		if($data !== false) {
			$html = "";
			foreach($data as $row) {
				$html .= "<tr>";
				$html .= "<td>$row->id</td>";
				$html .= "<td>$row->fullname</td>";
				$html .= "<td>$row->payroll_period</td>";
				$html .= "<td>$row->emp_status</td>";
				$html .= "<td><b>(<a href='#' onclick=\"showPayrollLogs('timesheet','".$row->id."','".$row->periodid."');\">".intval($row->ttl_reghrs)."</a>)</b> ".intval($row->ttl_regpay)."</td>";
				$html .= "<td><b>(<a href='#' onclick=\"showPayrollLogs('timesheet','".$row->id."','".$row->periodid."');\">".intval($row->ttl_othrs)."</a>)</b> ".intval($row->ttl_otpay)."</td>";
				$html .= "<td><a href='#' onclick=\"showPayrollLogs('odeduction','".$row->id."','".$row->periodid."');\">".intval($row->deductions)."</a></td>";
				$html .= "<td><a href='#' onclick=\"showPayrollLogs('ldeduction','".$row->id."','".$row->periodid."');\">".intval($row->leave_deduction)."</a></td>";
				$html .= "<td>".intval(($row->ttl_regpay + $row->ttl_otpay))."</td>";
				$html .= "<td>".intval(($row->ttl_regpay + $row->ttl_otpay) - ($row->deductions + $row->leave_deduction))."</td>";
				$html .= "</tr>";
			}
			return $html;
		}
		return false;
	}
	
	public function List_PayrollTimesheet($periodid,$empid) {
		$this->load->model('Payroll','pay');
		$data = $this->pay->get_PayrollTimesheet($periodid,$empid);
		if($data !== false) {
			$html = '<table style="font-size:10px;" id="tblPayperiod" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">';
			$html .= "<tr><th>Fullname</th><th>Payroll Period</th><th>Hour Rendered</th><th>OT Rendered</th><th>Date</th>";
			foreach($data as $row) {
				$html .= "<tr>";
				$html .= "<td>$row->employee_name</td>";
				$html .= "<td>$row->description</td>";
				$html .= "<td>$row->ttl_hours</td>";
				$html .= "<td>$row->ttl_ot</td>";
				$html .= "<td>$row->created_date</td>";
				$html .= "</tr>";
			}
			$html .= "</table>";
			return $html;
		}
		return false;
	}
}