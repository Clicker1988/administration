<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Google\Cloud\Storage\StorageClient;

class Asset_controller extends CI_Controller {
	
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
	
	public function uniqidReal($lenght = 13) {
		if (function_exists("random_bytes")) {
			$bytes = random_bytes(ceil($lenght / 2));
		} elseif (function_exists("openssl_random_pseudo_bytes")) {
			$bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
		} else {
			throw new Exception("no cryptographically secure random function available");
		}
		return substr(bin2hex($bytes), 0, $lenght);
	}
	
	public function crud($action = '',$module = '',$search = '') {
		if($action == "create" && $this->session->userdata('adminid') <> "") {
			if($module == "assetlist") {
				if($this->session->userdata('userlevel') == "VIEWER") {
					$this->redirector("asset/asset_manager","Unable to proceed insufficient account level!","error");
					exit;
				}

				if($this->session->userdata('adminid') <> "" && 
					$this->input->post('name') <> "" && 
					$this->input->post('stock_type') <> "" && 
					$this->input->post('condition') <> "" && 
					$this->input->post('serialno') <> "" && 
					$this->input->post('modelno') <> "" && 
					$this->input->post('description') <> "" && 
					$this->input->post('cost') <> "" && 
					$this->input->post('manufacturer') <> "" && 
					$this->input->post('ownership') <> "") {
					$data = array(
						"name"				=> addslashes($this->input->post('name')),
						"stock_type"		=> addslashes($this->input->post('stock_type')),
						"serialno"			=> addslashes($this->input->post('serialno')),
						"modelno"			=> addslashes($this->input->post('modelno')),
						"description"		=> addslashes($this->input->post('description')),
						"cost"				=> addslashes($this->input->post('cost')),
						"manufacturer"		=> addslashes($this->input->post('manufacturer')),
						"procurement_date"	=> addslashes($this->input->post('procurement_date')),
						"warranty_exp_date"	=> addslashes($this->input->post('warranty_exp_date')),
						"condition"			=> addslashes($this->input->post('condition')),
						"ownership"			=> addslashes($this->input->post('ownership')),
						"comment"			=> addslashes($this->input->post('comment')),
						"gps_id"			=> addslashes($this->input->post('gps_id')),
						"created_by"		=> $this->session->userdata('adminid'),
						"created_datetime"	=> date('Y-m-d H:i:s')
					);
				$result = $this->createRecord('assets',$data);
					if($result == false) {
						$this->redirector("asset/asset_manager","An error occurrred when creating record!","error");
					} else {
						$this->redirector("asset/asset_manager","Successfully created a Equipment Rate!","success");
					}
						
				}
				else {
					$this->redirector("asset/asset_manager","Incomplete required parameter!","error");
				}
			}
			elseif($module == "assetRepairlist") {
				if($this->session->userdata('userlevel') == "VIEWER") {
					$this->redirector("asset/asset_maintenance","Unable to proceed insufficient account level!","error");
					exit;
				}

				if($this->session->userdata('adminid') <> "" && 
					$this->input->post('repair_asset_id') <> "" && 
					$this->input->post('repair_item') <> "" && 
					$this->input->post('assigned_team') <> "" && 
					$this->input->post('repair_asset_reason') <> "") {
					
					//check primary table
					$exist = $this->isExist('asset_repair', trim($this->input->post('repair_asset_id')));
					if($exist == false){
						$data = array(
							'asset_id' => addslashes($this->input->post('repair_asset_id')),
							'repair_reason' => addslashes($this->input->post('repair_asset_reason')),
							'repair_details' => addslashes($this->input->post('repair_asset_details')),
							'status' => addslashes($this->input->post('repair_asset_status')),
							'created_by' => $this->session->userdata('adminid'),
							'created_date' => date('Y-m-d H:i:s'),
							);
						$result = $this->createRecord('asset_repair',$data);
						if($result == false) {
							//$this->redirector("asset/asset_maintenance","An error occurrred when creating record!","error");
							echo "error";
						} else {
							$data = array(
								'asset_id' => addslashes($this->input->post('repair_asset_id')),
								'repair_item' => addslashes($this->input->post('repair_item')),
								'repair_description' => addslashes($this->input->post('repair_description')),
								'assigned_team' => addslashes($this->input->post('assigned_team')),
								'repair_status' => addslashes($this->input->post('repair_status')),
								'repair_cost' => addslashes($this->input->post('repair_cost')),
								'action_taken' => addslashes($this->input->post('action_taken')),
								'created_by' => $this->session->userdata('adminid'),
								'created_date' => date('Y-m-d H:i:s'),
								);
							$result = $this->createRecord('asset_repair_details',$data);
							if($result == false) {
								//$this->redirector("asset/asset_maintenance","An error occurrred when creating record!","error");
								echo "error";
							} else {
								//$this->redirector("asset/asset_maintenance","Successfully created a Equipment Rate!","success");
								echo "success";
							}
						}
					}
					else {
						$data = array(
								'asset_id' => addslashes($this->input->post('repair_asset_id')),
								'repair_item' => addslashes($this->input->post('repair_item')),
								'repair_description' => addslashes($this->input->post('repair_description')),
								'assigned_team' => addslashes($this->input->post('assigned_team')),
								'repair_status' => addslashes($this->input->post('repair_status')),
								'repair_cost' => addslashes($this->input->post('repair_cost')),
								'action_taken' => addslashes($this->input->post('action_taken')),
								'created_by' => $this->session->userdata('adminid'),
								'created_date' => date('Y-m-d H:i:s'),
								);
							$result = $this->createRecord('asset_repair_details',$data);
							if($result == false) {
								echo "error";
							} else {
								echo "success";
							}
					}
				}
				else {
					//$this->redirector("asset/asset_maintenance","Incomplete required parameter!","error");
					echo "parameter";
				}
	
			}

			else {
				show_404();
			}
		} 
		elseif($action == "update" && $this->session->userdata('adminid') <> "") {
			if($this->session->userdata('userlevel') == "VIEWER") {
					$this->redirector("projects/projlist","Unable to proceed insufficient account level!","error");
					exit;
			}
			if($module == "assetlist") {
				
				if($this->session->userdata('adminid') <> "" && 
					$this->input->post('edit_Name') <> "" && 
					$this->input->post('edit_stock_type') <> "" && 
					$this->input->post('edit_condition') <> "" && 
					$this->input->post('edit_serialno') <> "" && 
					$this->input->post('edit_modelno') <> "" && 
					$this->input->post('edit_description') <> "" && 
					$this->input->post('edit_cost') <> "" && 
					$this->input->post('edit_manufacturer') <> "" && 
					$this->input->post('edit_ownership') <> "" &&
					$this->input->post('edit_id') <> ""){
					
					$data = array(
						"name"				=> addslashes($this->input->post('edit_Name')),
						"stock_type"		=> addslashes($this->input->post('edit_stock_type')),
						"serialno"			=> addslashes($this->input->post('edit_serialno')),
						"modelno"			=> addslashes($this->input->post('edit_modelno')),
						"description"		=> addslashes($this->input->post('edit_description')),
						"cost"				=> addslashes($this->input->post('edit_cost')),
						"manufacturer"		=> addslashes($this->input->post('edit_manufacturer')),
						"procurement_date"	=> addslashes($this->input->post('edit_procurement_date')),
						"warranty_exp_date"	=> addslashes($this->input->post('edit_warranty_exp_date')),
						"condition"			=> addslashes($this->input->post('edit_condition')),
						"ownership"			=> addslashes($this->input->post('edit_ownership')),
						"comment"			=> addslashes($this->input->post('edit_comment')),
						"gps_id"			=> addslashes($this->input->post('edit_gps_id')),
						"modified_by"		=> $this->session->userdata('adminid'),
						"modified_datetime"	=> date('Y-m-d H:i:s')
					);
					
					$result = $this->Edit_AssetItem($data,$this->input->post('edit_id'));
					if($result == false) {
						$this->redirector("asset/asset_manager","An error occurrred when updating record!","error");
					} else {
						$this->redirector("asset/asset_manager","Successfully updated the project!","success");
					}
				} 
				else {
					
					$this->redirector("asset/asset_manager","Incomplete required parameters!","error");
				}
			} 
			
			elseif($module == "assetRepairLoglist") {
				
				if($this->session->userdata('adminid') <> "" && 
					$this->input->post('edit_log_id') <> "" && 
					$this->input->post('edit_asset_id') <> "" && 
					$this->input->post('edit_repair_item') <> "" && 
					$this->input->post('edit_assigned_team') <> "" && 
					$this->input->post('edit_asset_reason') <> "") {
					
					$data = array(
						'asset_id' => addslashes($this->input->post('edit_asset_id')),
						'repair_item' => addslashes($this->input->post('edit_repair_item')),
						'repair_description' => addslashes($this->input->post('edit_repair_description')),
						'assigned_team' => addslashes($this->input->post('edit_assigned_team')),
						'repair_status' => addslashes($this->input->post('edit_repair_status')),
						'repair_cost' => addslashes($this->input->post('edit_repair_cost')),
						'action_taken' => addslashes($this->input->post('edit_action_taken')),
						'modified_by' => $this->session->userdata('adminid'),
						'modified_date' => date('Y-m-d H:i:s'),
					);
				
					$result = $this->UpdateItem('asset_repair_details',$data, $this->input->post('edit_log_id'));
					$this->load->model('Assets','ass');
					$stillForRepair = $this->ass->stillUnderRapair($this->input->post('edit_asset_id'));
					if($stillForRepair == false){
						$data = array(
							'status' => 'Ready for Service',
							'modified_by' => $this->session->userdata('adminid'),
							'modified_date' => date('Y-m-d H:i:s'),
						);
						$result = $this->UpdateItem('asset_repair',$data, $this->input->post('edit_repair_detail_id'));
					}
					if($result == false) {
						echo "error";
					} else {
						echo "success";
					}
					
				}
				else {
					echo "parameter";
				}
	
			}
			elseif($module == "asset_repair_update"){
				if($this->session->userdata('adminid') <> "" && 
					$this->input->post('id') <> "" && 
					$this->input->post('asset_id') <> "" && 
					$this->input->post('asset_stat') <> "" && 
					$this->input->post('asset_reason') <> "" && 
					$this->input->post('asset_details') <> "") {
					
					if($this->input->post('asset_stat') == "Ready for Service"){
						$this->load->model('Assets','ass');
						$stillForRepair = $this->ass->stillUnderRapair($this->input->post('asset_id'));
						if($stillForRepair == false){
							$data = array(
								'status' => 'Ready for Service',
								'modified_by' => $this->session->userdata('adminid'),
								'modified_date' => date('Y-m-d H:i:s'),
							);
							$result = $this->UpdateItem('asset_repair',$data, $this->input->post('id'));
							if($result == false) {
								echo "error";
							} else {
								echo "success";
							}
							
						}else{
							echo "there are still pending items in your asset for repair";
							exit();
						}
					}
					
					
					$data = array(
						'asset_id' => addslashes($this->input->post('asset_id')),
						'repair_reason' => addslashes($this->input->post('asset_reason')),
						'repair_details' => addslashes($this->input->post('asset_details')),
						'status' => addslashes($this->input->post('asset_stat')),
						'modified_by' => $this->session->userdata('adminid'),
						'modified_date' => date('Y-m-d H:i:s'),
					);
					$result = $this->UpdateItem('asset_repair',$data, $this->input->post('id'));
					if($result == false) {
						echo "error";
					} else {
						echo "success";
					}
					
				}
				else {
					echo "parameter";
				}
			}
			else {
				show_404();
			}
		}
		elseif($action == "retrieve" && $this->session->userdata('adminid') <> "") {
			
				if($module == "stocktype") {
					$param = $this->input->post('searchTerm');
					echo $this->CBO_items('asset_type', $param);
				}
				elseif($module == "condition") {
					$param = $this->input->post('searchTerm');
					echo $this->CBO_items('asset_condition', $param);
				}
				elseif($module == "ownership") {
					$param = $this->input->post('searchTerm');
					echo $this->CBO_items('asset_ownership',$param );
				}
				elseif($module == "assetlist") {
					echo $this->AssetListData();
				}
				elseif($module == "lastlocation"){
					$param = $this->input->post('gpsid');
					echo $this->Get_Location($param);
				}
				elseif($module == "asset_list_names"){
					echo $this->get_unique('Assets', 'name');
				}
				elseif($module == "asset_location"){
					$param = $this->input->post('assetlist');
					echo $this->Get_Location_Assets($param);
				}
				elseif($module == "asset_coordinates"){
					$param = $this->input->post('locid');
					echo $this->Get_Coordinates($param);
				}
				elseif($module == "asset_history"){
					$param = $this->input->post('assetlist');
					echo $this->Get_history($param);
				}
				elseif($module == "piechart"){
					$param = $this->input->post('chartitem');
					echo $this->Get_PieChart($param);
				}
				elseif($module == "repair_stat") {
					$param = $this->input->post('searchTerm');
					echo $this->CBO_items('asset_repair_status', $param);
				}
				elseif($module == "repair_asset_list") {
					$param = $this->input->post('searchTerm');
					echo $this->CBO_AssetList('assets', $param);
				}
				elseif($module == "repair_audit_logs") {
					$param = $this->input->post('searchTerm');
					echo $this->repairAudit($param);
				}
				elseif($module == "assetOnRepairList") {
					echo $this->AssetRepairData();
				}
				else {
					show_404();
				}
			}
		elseif($action == "delete" && $this->session->userdata('adminid') <> "") {
				if($module == "assetlist") {
					if($this->session->userdata('userlevel') == "VIEWER") {
						$this->redirector("projects/list","Unable to proceed insufficient account level!","error");
						exit;
					}
					if($this->session->userdata('adminid') <> "" && $this->input->post('id') <> "") {
						$result = $this->Delete_Item('Assets', $this->session->userdata('adminid'),$this->input->post('id'));
						if($result == false) {
							$this->redirector("projects/list","An error occurred when deleting record!","error");
						} 
						else {
							echo true;
						}
					}
					else {
						$this->redirector("projects/list","Invalid parameters passed!","error");
					}
				} 
				
				elseif($module == "asset_repair_log") {
					if($this->session->userdata('userlevel') == "VIEWER") {
						$this->redirector("projects/asset_maintenance","Unable to proceed insufficient account level!","error");
						exit;
					}
					if($this->session->userdata('adminid') <> "" && $this->input->post('id') <> "") {
						$result = $this->Delete_Item('asset_repair_details', $this->session->userdata('adminid'),$this->input->post('id'));
						if($result == false) {
							echo "error";
						} 
						else {
							echo "success";
						}
					}
					else {
						echo "param";
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
	
	public function prep_update($type) {
		
		if($this->input->post('id') <> "" && $this->session->userdata('adminid') <> "") {
			$this->load->model('Assets','ass');
			if($this->session->userdata('userlevel') == "VIEWER") {
				$data = "Unable to proceed insufficient account level!";
			} else {
				if($type == "assetInfo") {
					$data = $this->ass->getWhere('Assets',$this->input->post('id'));
				}
				elseif($type == "repairitem") {
					$data = $this->ass->getWhere('asset_repair_details', $this->input->post('id'));
				}
				elseif($type == "repairlog") {
					//$data = $this->ass->getWhere('asset_repair', $this->input->post('id'));
					$data = $this->ass->getAssetLogs($this->input->post('id'));
				}
				elseif($type == "assetrepairstat") {
					$data = $this->ass->getLastStat($this->input->post('id'));
				}
				else {
					
					show_404();
				}
			}
			echo json_encode($data);
		}
		else {
		
			//show_404();
		}
	
	}
	
	public function createRecord($tbl, $arr){
		if($tbl <> "" &&  $arr <> "" ) {
			$this->load->model('Assets','ass');
			$rr = $this->ass->inserttotable($tbl,$arr);
			return $rr;
		} else {
			return false;
		}
	}
	
	public function AssetListData() {
		$this->load->model('Assets','ass');
		$data = $this->ass->get_AssetList();
		if($data !== false) {
			$html = "";
			$gps = "";
			foreach($data as $row) {
				$html .= "<tr>";
				$html .= "<td>$row->name</td>";
				$html .= "<td>$row->serialno</td>";
				$html .= "<td>$row->modelno</td>";
				$html .= "<td>$row->stock_type</td>";
				$html .= "<td>$row->description</td>";
				$html .= "<td>$row->cost</td>";
				$html .= "<td>$row->manufacturer</td>";
				$html .= "<td>$row->procurement_date</td>";
				$html .= "<td>$row->warranty_exp_date</td>";
				if($row->gps_id <> ""){
					$gps = "<button data-toggle='tooltip' title='Delete Record' type='button' onclick=\"fnfindme('".$row->gps_id."');\" class='btn btn-success'><i class='fa fa-map-marker'></i></button>";
				}
				$html .= "<td style='display:inline-block; width:150px;'>
							<button data-toggle='tooltip' title='View Record' type='button' onclick=\"fneditAssetData('".$row->id."');\" class='btn btn-info'><i class='fa fa-desktop'></i></button>
							<button data-toggle='tooltip' title='Delete Record' type='button' onclick=\"fndeleteAssetData('".$row->id."');\" class='btn btn-warning'><i class='fa fa-eraser'></i></button>
						  ".$gps."
						  </td>";
			}
			return $html;
		}
		return false;
	}
	
	public function CBO_items($tbl, $param) {
		$this->load->model('Assets','asset');
		$data = $this->asset->get_tbl_item($tbl, $param);
		if($data !== false) {
			$html = array();
			foreach($data as $row) {
				$html[] = array("id"=>$row->description,"text"=>$row->description);
			}
			return json_encode($html);
		}
		return false;
	}
	
	public function CBO_AssetList($tbl, $param) {
		$this->load->model('Assets','asset');
		$data = $this->asset->get_tbl_item($tbl, $param);
		if($data !== false) {
			$html = array();
			foreach($data as $row) {
				$html[] = array("id"=>$row->id,"text"=>$row->name);
			}
			return json_encode($html);
		}
		return false;
	}
	
	public function Create_Types($data) {
		if(count($data) > 0) {
			$this->load->model('Project','proj');
			return $this->proj->insert_ProjType($data);
		} else {
			return false;
		}	
	}
	
	public function Edit_AssetItem($data,$id) {
		if(count($data) > 0) {
			$this->load->model('Assets','ass');
			return $this->ass->update_Asset($data,$id);
		} else {
			return false;
		}	
	}
	
	public function UpdateItem($tbl, $data,$id) {
		if(count($data) > 0) {
			$this->load->model('Assets','ass');
			return $this->ass->updateTable($tbl, $data,$id);
		} else {
			return false;
		}	
	}
	
	public function Delete_Item($tbl, $adminid,$id) {
		if($adminid <> "" && $id <> "") {
			$this->load->model('Assets','ass');
			return $this->ass->delete_Asset($tbl, $id);
		} else {
			return false;
		}	
	}

	public function Get_Location($gps){
		$this->load->model('Assets','ass');
		$data = $this->ass->get_mylastLocation($gps);
		if($data !== false) {
			foreach($data as $row) {
				$loc = array('latitude' => $row->latitude,
						'longitude' => $row->longitude,
						'status' => $row->status,
						'msg' => '<h5>Status : '.$row->status.'</h5>'.'<p>'.$row->message.'</p>'.'<a href="#" target="">GPS ID: '.$gps.'</a>'
						);
			}
			return json_encode($loc);
		}else{
			return "no records found";
		}
	}
	
	public function Get_Location_Assets($assets){
		$this->load->model('Assets','ass');
		$asset_list = '';
		foreach($assets as $key){
			$asset_list .= "'". addslashes($key) . "'," ;
		}
		$asslist = substr($asset_list, 0, -1);
		$data = $this->ass->get_asset_Location($asslist);
		if($data !== false) {
			$itmarray = array();
			foreach($data as $row) {
				if($row->stat == "PROBLEM"){
					$icon = "issue";
					$color = "red";
				}else{
					$icon = "running";
					$color = "green";
				}
				
				$gps = "new google.maps.LatLng(".$row->latitude.",".$row->longitude.")";
				$loc = array('position' => $gps,
						'latitude' => $row->latitude,
						'longitude' => $row->longitude,				
						'type' => $icon,
						'content' => '<h5 style="color: '.$color.';">Status :'.$row->stat.'</h5>'.
									'<p><small>Asset Name : '.$row->name.'</small></p>'.
									'<p>'.$row->message.'</p>'.
									'<a href="#" target="_blank" style="font-size:11px;">Model No : [ '.$row->modelno.' ]</a>&nbsp;&nbsp;'.
									'<a href="#" target="_blank" style="font-size:11px;">Serial No :[ '.$row->serialno.' ]</a>',
						);
		
				array_push($itmarray, $loc);
			}
			
			echo json_encode($itmarray);
		
		}else{
			return "no records found";
		}
	}
	
	public function Get_Coordinates($id){
		$this->load->model('Assets','ass');
		$data = $this->ass->get_asset_coordinate($id);
		if($data !== false) {
			$itmarray = array();
			foreach($data as $row) {
				if($row->status == "PROBLEM"){
					$icon = "issue";
					$color = "red";
				}else{
					$icon = "running";
					$color = "green";
				}
				
				$gps = "new google.maps.LatLng(".$row->latitude.",".$row->longitude.")";
				$loc = array('position' => $gps,
						'latitude' => $row->latitude,
						'longitude' => $row->longitude,				
						'type' => $icon,
						'content' => '<h5 style="color: '.$color.';">Status :'.$row->status.'</h5>'.
									'<p><small>Asset Name : '.$row->name.'</small></p>'.
									'<p>'.$row->message.'</p>'.
									'<a href="#" target="_blank" style="font-size:11px;">Model No : [ '.$row->modelno.' ]</a>&nbsp;&nbsp;'.
									'<a href="#" target="_blank" style="font-size:11px;">Serial No :[ '.$row->serialno.' ]</a>',
						);
		
				array_push($itmarray, $loc);
			}
			
			echo json_encode($itmarray);
		
		}else{
			return "no records found";
		}
	}
	
	public function Get_history($assets){
		$this->load->model('Assets','ass');
		$htm = "";
		foreach($assets as $key){
			$asset_list = "'". addslashes($key) . "'" ;
			$data = $this->ass->get_Location_history($asset_list);
			if($data !== false) {
					foreach($data as $row) {
						if($row->status == "PROBLEM"){
							$icon = "issue";
							$color = "red";
						}else{
							$icon = "running";
							$color = "green";
						}
						$htm .= '<li>
									<a href="javascript:void(0)" style="border-bottom:1px solid #e2e2e2;" onclick="historyitem('.$row->locid.');">
										<img src="../public/assets/images/placeholder.png" alt="user-img" class="img-circle"> </img>
										<span>'.$key.'
											<small style="color:'.$color.';">'.$row->status.'</small>
										</span>
										<span>
											<small>&nbsp;</small>
											<small class="text-muted" style="word-wrap: break-word;">'.$row->message.'</small> 
											<small>&nbsp;</small>
											<small class="text-info">Lat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ ' .$row->latitude. ' ]</small>
											<small class="text-info">Long &nbsp;&nbsp;[ '.$row->longitude.' ]</small>
										</span>
									</a>
								</li>
								';
						
					}
					
				}
		}
		return $htm;
	}
	
	public function get_unique($tbl, $itm) {
		$this->load->model('Assets','asset');
		$data = $this->asset->get_distinct($tbl, $itm);
		if($data !== false) {
			$html = array();
			foreach($data as $row) {
				$html[] = array("id"=>$row->name,"text"=>$row->name);
			}
			return json_encode($html);
		}
		return false;
	}
	
	public function Get_PieChart($itm){
		$tbl = "";
		$html = "";
		$itmarray = array();
		$this->load->model('Assets','asset');
		$color = array('');
		$color = array("#4f5467", "#26c6da", "#009efb", "#7460ee");
		$data = $this->asset->get_distinct_count("assets", $itm);
			$i = 0; 
			foreach($data as $row) {
				if(count($data) < 3){
					$html[] = array('label' => "$row->item", 'data'=> $row->cnt, 'color' => $color[$i],);
				}else{
					$html[] = array('label' => "$row->item", 'data'=> $row->cnt,);
				}
				
				$i++;
				//$html .= '{label: "'.$row->item.'", data: '. $row->cnt.', color: '.$color[$i].', }, ';
			}
			return json_encode($html);
			//echo "[".$html."]";
		
	}
	
	public function repairAudit($id){
		$this->load->model('Assets','ass');
		$data = $this->ass->getAuditLog($id);
		$html = "";
		if($data !== false) {
			$gps = "";
			foreach($data as $row) {
				$html .= "<tr>";
				$html .= "<td>$row->repair_item</td>";
				$html .= "<td>$row->repair_description</td>";
				$html .= "<td>$row->assigned_team</td>";
				$html .= "<td>$row->repair_status</td>";
				$html .= "<td>$row->repair_cost</td>";
				$html .= "<td>$row->action_taken</td>";
				$html .= "<td style='display:inline-block; width:150px;'>
							<button data-toggle='tooltip' title='View Record' type='button' onclick=\"fnPrevRepair('".$row->id."');\" class='btn btn-info'><i class='fa fa-desktop'></i></button>
							<button data-toggle='tooltip' title='Delete Record' type='button' onclick=\"fnDelRepair('".$row->id."');\" class='btn btn-warning'><i class='fa fa-eraser'></i></button>
						  </td>";
				$html .= "</tr>";
			}
		}else{
			$html .= "<tr>";
			$html .= "<td>No Data Available</td>";
			$html .= "<td>No Data Available</td>";
			$html .= "<td>No Data Available</td>";
			$html .= "<td>No Data Available</td>";
			$html .= "<td>No Data Available</td>";
			$html .= "<td>No Data Available</td>";
			$html .= "<td style='display:inline-block; width:150px;'>No Data Available</td>";
			$html .= "</tr>";
		}
		return $html;
	}
	
	public function isExist($tbl, $key){
		
		$this->load->model('Assets','asset');
		return $this->asset->checkRows($tbl, $key);
	}
	
	public function AssetRepairData(){
		$this->load->model('Assets','ass');
		$data = $this->ass->get_RepairAssetList();
		if($data !== false) {
			$html = "";
			$gps = "";
			foreach($data as $row) {
				$html .= "<tr>";
				$html .= "<td>$row->name</td>";
				$html .= "<td>$row->modelno</td>";
				$html .= "<td>$row->stock_type</td>";
				$html .= "<td>$row->ownership</td>";
				$html .= "<td>$row->repair_reason</td>";
				$html .= "<td>$row->repair_reason</td>";
				$html .= "<td style='display:inline-block; width:150px;'>
							<button data-toggle='tooltip' title='View Record' type='button' onclick=\"viewRepair('".$row->asset_id."', '".$row->id."');\" class='btn btn-info'><i class='fa fa-desktop'></i></button>
						 </td>";
			}
			return $html;
		}
		return false;
	}
	
}

