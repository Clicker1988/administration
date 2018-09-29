<?php

class Assets extends CI_Model {
	
	function get_tbl_item($tabl,$param) {
		$query = $this->db->query("SELECT * FROM $tabl");
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	public function get_AssetList(){
		$query = $this->db->query("SELECT * FROM Assets order by id desc");
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	public function getLastStat($id){
		$query = $this->db->query("SELECT * FROM asset_repair where asset_id = '".$id."' order by id desc limit 1");
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	public function get_RepairAssetList(){
		//$query = $this->db->query("SELECT a.`name`, a.modelno, a.stock_type, a.condition, a.ownership, a.manufacturer, b.* FROM `assets` AS a LEFT JOIN `asset_repair` AS b ON a.id = b.asset_id");
		$query = $this->db->query("SELECT  a.`name`, a.modelno, a.stock_type, a.ownership, a.manufacturer ,b.* FROM `assets` AS a INNER JOIN `asset_repair` AS b ON  a.id = b.asset_id and b.status <> 'Ready for Service'");
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	
	public function getAssetLogs($id){
		$query = $this->db->query("SELECT b.*, a.`name`, a.modelno, a.stock_type, a.ownership, a.manufacturer  FROM `asset_repair` AS b  LEFT JOIN  `assets` AS a ON  a.id = b.asset_id WHERE b.asset_id = '".$id."'");
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	function inserttotable($tbl, $array){
		$query = $this->db->insert($tbl, $array);
		if($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function getWhere($tbl, $id) {
		$query = $this->db->query('SELECT * FROM '.$tbl.' WHERE id = ? ORDER by id',$id);
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	function getAuditLog($id) {
		$query = $this->db->query('SELECT * FROM asset_repair_details WHERE asset_id = ? order by id desc limit 100',$id);
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	function update_Asset($param,$id) {
		$this->db->where('id', $id);
		$this->db->update('Assets', $param);
		if($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function updateTable($tbl, $array, $id){
		
		$this->db->where('id', $id);
		$this->db->update($tbl, $array);
		if($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function delete_Asset($blt, $id) {
		$this->db->where('id', $id);
		$this->db->delete($blt);
		if($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function get_mylastLocation($id){
		$query = $this->db->query('SELECT * FROM asset_location WHERE gps_id = ? ORDER by id desc limit 1',$id);
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	function get_asset_Location($asset){
		$query = $this->db->query('SELECT MAX(a.latitude) AS latitude, MAX(a.longitude) AS longitude, MAX(a.status) AS stat, MAX(a.message) AS message, b.* FROM `asset_location` AS a , `assets` AS b WHERE a.gps_id IN(SELECT gps_id FROM `assets` WHERE `name` IN('.$asset.')) GROUP BY a.gps_id ORDER BY id DESC');
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	function get_Location_history($asset){
		$query = $this->db->query('SELECT a.id AS locid, a.*, b.* FROM `asset_location`AS a  LEFT JOIN `assets` AS b ON a.gps_id = b.gps_id WHERE `name` IN('.$asset.')  ORDER BY a.id desc limit 10');
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	function get_asset_coordinate($locid){
		if($locid == "ALL"){
			$query = $this->db->query("SELECT b.gps_id, MAX(latitude) AS latitude, MAX(longitude) AS longitude, MAX(STATUS) AS status, MAX(message) AS message , a.* FROM `asset_location` AS b  LEFT JOIN (SELECT * FROM  assets)AS a ON a.gps_id = b.gps_id  GROUP BY b.gps_id");
		}else{
			$query = $this->db->query("SELECT a.*, b.* FROM `asset_location`AS a  LEFT JOIN `assets` AS b ON a.gps_id = b.gps_id WHERE a.id ='".$locid."' ORDER BY a.id");
		}
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	function get_distinct($tabl,$itm) {
		$query = $this->db->query("SELECT distinct $itm FROM  $tabl");
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	function get_distinct_count($tabl,$itm) {
		$query = $this->db->query("SELECT $itm as item, count($itm) as cnt FROM  $tabl group by $itm");
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	function checkRows($tabl,$itm){
		$query = $this->db->query("SELECT * FROM $tabl where id='".$itm."'");
		if($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function stillUnderRapair($id){
		$query = $this->db->query("SELECT * FROM `asset_repair_details` WHERE asset_id = '".$id."' AND repair_status <> 'Finished'");
		if($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	
}