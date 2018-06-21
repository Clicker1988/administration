<?php

class Payroll extends CI_Model {
	
	function getWhere_LeaveReq($id) {
		$query = $this->db->query('SELECT * FROM leave_request WHERE id = ? ORDER by date_inserted',$id);
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	function getWhere_LeaveType($id) {
		$query = $this->db->query('SELECT * FROM leave_type WHERE id = ? ORDER by date_inserted',$id);
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	function getWhere_Payperiod($id) {
		$query = $this->db->query('SELECT * FROM payroll_period WHERE id = ? ORDER by date_inserted',$id);
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	function get_LeaveReq() {
		$query = $this->db->query('SELECT * FROM leave_request ORDER by date_inserted');
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}	
	
	function insert_LeaveReq($param) {
		$this->db->insert('leave_request',$param);
		if($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function delete_LeaveReq($admin,$id) {
		$this->db->delete('leave_request', array('id' => $id));
		if($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function update_LeaveReq($param,$id) {
		$this->db->where('id', $id);
		$this->db->update('leave_request', $param);
		if($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function get_LeaveType() {
		$query = $this->db->query('SELECT * FROM leave_type ORDER by date_inserted');
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}	
	
	function insert_LeaveType($param) {
		$this->db->insert('leave_type',$param);
		if($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function delete_LeaveType($admin,$id) {
		$this->db->delete('leave_type', array('id' => $id));
		if($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function update_LeaveType($param,$id) {
		$this->db->where('id', $id);
		$this->db->update('leave_type', $param);
		if($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function get_LeaveRequestLogs() {
		$query = $this->db->query("SELECT a.id,CONCAT(emp_last,', ',emp_first,' ',emp_mi) AS fullname,date_from,date_to,leave_type,reason,status FROM leave_request a
									JOIN employee_info b ON(a.employee_id = b.id)  ORDER by a.date_inserted,status");
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}	
	
	function get_OTRequestLogs() {
		$query = $this->db->query("SELECT a.id,CONCAT(emp_last,', ',emp_first,' ',emp_mi) AS fullname,hours,reason,status,a.date_inserted FROM overtime_request a
									JOIN employee_info b ON(a.employee_id = b.id)");
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	function update_OTReq($param,$id) {
		$this->db->where('id', $id);
		$this->db->update('overtime_request', $param);
		if($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function insert_OTReq($param) {
		$this->db->insert('overtime_request',$param);
		if($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function get_Payperiod() {
		$query = $this->db->query('SELECT * FROM payroll_period ORDER by date_inserted');
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}	
	
	function insert_Payperiod($param) {
		$this->db->insert('payroll_period',$param);
		if($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function update_Payperiod($param,$id) {
		$this->db->where('id', $id);
		$this->db->update('payroll_period', $param);
		if($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function delete_Payperiod($admin,$id) {
		$this->db->delete('payroll_period', array('id' => $id));
		if($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
}