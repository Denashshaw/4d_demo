<?php
 class Sj_health_model extends CI_Model
 {

   //jagan start
     public function countrows(){
		$userdata =$this->session->all_userdata();
    $table_call_entry = $userdata['loggedin_client']."_call_entry";
    $table_claims = $userdata['loggedin_client']."_claims";
    if($userdata['loggedin_client'] == '') return 0;
		if($userdata['role']=='agent'){
			$client_claims =$this->db->query("SELECT * FROM $table_claims WHERE emp_id='".$userdata['emp_id']."'  ORDER BY id asc");
			return $client_claims->result();
		}
		else{
			$client_claims =$this->db->query("SELECT $table_claims.* FROM $table_claims WHERE  $table_claims.unique_id not in (select $table_call_entry.unique_id from $table_call_entry) ORDER BY id asc");
			return $client_claims->result();
		}
    }

	public function sj_health_data($limit=NULL,$start=NULL,$search){
		$userdata =$this->session->all_userdata();
    $table_claims = $userdata['loggedin_client']."_claims";
    if($userdata['loggedin_client'] == '') return 0;
		if($search==''){
			if($userdata['role']=='agent'){
				$client_claims =$this->db->query("SELECT * FROM $table_claims WHERE emp_id='".$userdata['emp_id']."'  limit $start,$limit ");
				return $client_claims->result();
			}
			else{
				$client_claims =$this->db->query("SELECT * FROM $table_claims limit $start,$limit ");
				return $client_claims->result();
			}
		}
		else{
			if($userdata['role']=='agent'){
				$client_claims =$this->db->query("SELECT * FROM $table_claims WHERE emp_id='".$userdata['emp_id']."' and claim_id like '%".$search."%' OR patient like '%".$search."%' limit $start,$limit ");
				return $client_claims->result();
			}
			else{
			$client_claims =$this->db->query("SELECT * FROM $table_claims WHERE claim_id like '%".$search."%' OR patient like '%".$search."%' limit $start,$limit ");
			return $client_claims->result();
			}
		}
	}


	public function completed_countrows(){
		$userdata =$this->session->all_userdata();
    $table_call_entry = $userdata['loggedin_client']."_call_entry";
    $table_claims = $userdata['loggedin_client']."_claims";
		$client_claims =$this->db->query("SELECT * FROM $table_claims t1,$table_call_entry t2 WHERE t2.emp_id='".$userdata['emp_id']."' and t1.unique_id=t2.unique_id ");
		return $client_claims->result();

    }

	public function sj_health_data_completed($limit=NULL,$start=NULL){
		$userdata =$this->session->all_userdata();
    $table_call_entry = $userdata['loggedin_client']."_call_entry";
    $table_claims = $userdata['loggedin_client']."_claims";
		$client_claims =$this->db->query("SELECT * FROM $table_claims t1,$table_call_entry t2 WHERE t2.emp_id='".$userdata['emp_id']."'  and t1.unique_id=t2.unique_id limit $start,$limit");
		return $client_claims->result();
	}
  //jagan end

	public function completed_countrows_overall(){
		$userdata =$this->session->all_userdata();
    $table_call_entry = $userdata['loggedin_client']."_call_entry";
    if($userdata['loggedin_client'] == '') return 0;
    $table_claims = $userdata['loggedin_client']."_claims";
		$client_claims =$this->db->query("SELECT * FROM $table_claims t1,$table_call_entry t2 WHERE t1.unique_id=t2.unique_id ");

		return $client_claims->result();
    }
//jagan start
	public function sj_health_data_completed_overall($limit=NULL,$start=NULL, $search=NULL){
		$userdata =$this->session->all_userdata();
    	$table_call_entry = $userdata['loggedin_client']."_call_entry";
    	$table_claims = $userdata['loggedin_client']."_claims";
	    
	    if($userdata['loggedin_client'] == '') return 0;
	    
	    if($search==''){
			$client_claims =$this->db->query("SELECT * FROM $table_claims t1,$table_call_entry t2 WHERE t1.unique_id=t2.unique_id  limit $start,$limit");
		}else{
			$client_claims =$this->db->query("SELECT * FROM $table_claims t1,$table_call_entry t2 WHERE t1.unique_id=t2.unique_id AND (t2.emp_id='".$search."' OR t1.claim_id like '%".$search."%' )limit $start,$limit");
		}
		// echo $this->db->last_query();die;
		return $client_claims->result();
	}

	public function start_call($unique_id){
		$userdata =$this->session->all_userdata();
    $table_claims = $userdata['loggedin_client']."_claims";
		$client_claims =$this->db->query("SELECT * FROM $table_claims WHERE unique_id='".$unique_id."' ");
		return $client_claims->result();
	}
  //jagan end

	public function countrows_notworkable(){
		$userdata =$this->session->all_userdata();
    	$table_claims = $userdata['loggedin_client']."_claims";
    	$table_call_entry = $userdata['loggedin_client']."_call_entry";
		$client_claims =$this->db->query("SELECT * FROM $table_claims t1,$table_call_entry t2 WHERE t1.unique_id=t2.unique_id and t2.work_status='Not Workable' ");
		return $client_claims->result();
	}
	public function sj_health_not_workable(){
		$userdata =$this->session->all_userdata();
    	$table_claims = $userdata['loggedin_client']."_claims";
    	$table_call_entry = $userdata['loggedin_client']."_call_entry";
		$client_claims =$this->db->query("SELECT * FROM $table_claims t1,$table_call_entry t2 WHERE t1.unique_id=t2.unique_id and t2.work_status='Not Workable' ");
		return $client_claims->result();
	}
//jagan start
	public function start_qa($unique_id){
		$userdata =$this->session->all_userdata();
    $table_call_entry = $userdata['loggedin_client']."_call_entry";
		$client_qa =$this->db->query("SELECT * FROM $table_call_entry WHERE unique_id='".$unique_id."' ");
		return $client_qa->result();
	}

 	public function add_claim($data){
    $userdata =$this->session->all_userdata();
    $table_call_entry = $userdata['loggedin_client']."_call_entry";
    	$check_dataexists =$this->db->query("SELECT * FROM $table_call_entry WHERE unique_id='".$data['unique_id']."'");
      if($this->db->affected_rows() > 0) {
        return FALSE;
      }else{
        $result = $this->db->insert($table_call_entry,$data);
        if($this->db->affected_rows() > 0) {return TRUE;}
        else {return FALSE;}
      }

 	}
 	public function add_qa($data){
    $userdata =$this->session->all_userdata();
    $table_qa = $userdata['loggedin_client']."_qa";
 		$result = $this->db->insert($table_qa,$data);
 		if($this->db->affected_rows() > 0) {return TRUE;}
		else {return FALSE;}
	}
//jagan end
	public function completed_qa_countrows(){
		$userdata =$this->session->all_userdata();
		$table_claims = $userdata['loggedin_client']."_claims";
    	$table_call_entry = $userdata['loggedin_client']."_call_entry";
    	$table_client_qa = $userdata['loggedin_client']."_qa";
    	if($userdata['loggedin_client'] == '') return 0;
 		// $result = $this->db->insert($table_call_entry,$data);
		$client_claims =$this->db->query("SELECT * FROM $table_claims t1,$table_client_qa t2 WHERE t1.unique_id=t2.unique_id and t2.qa_status='completed' ");
		return $client_claims->result();
	}

	public function sj_health_data_completed_qa($limit=NULL,$start=NULL){
		$userdata =$this->session->all_userdata();
		$table_claims = $userdata['loggedin_client']."_claims";
    	$table_call_entry = $userdata['loggedin_client']."_call_entry";
    	$table_client_qa = $userdata['loggedin_client']."_qa";
    	if($userdata['loggedin_client'] == '') return 0;
		$client_claims =$this->db->query("SELECT * FROM $table_claims t1,$table_client_qa t2 WHERE t1.unique_id=t2.unique_id and t2.qa_status='completed' limit $start,$limit");
		return $client_claims->result();
	}
//jagan start
		public function claims_assigned(){
		    $userdata =$this->session->all_userdata();
        	$table_claims = $userdata['loggedin_client']."_claims";
        	if($userdata['loggedin_client'] == '') return 0;
		    if($userdata['role'] == 'agent'){
		      	$client_claims_assign =$this->db->query("SELECT(SELECT COUNT(*) FROM $table_claims WHERE emp_id='".$userdata['emp_id']."') AS assigned");
		    }else{
		      	$client_claims_assign =$this->db->query("SELECT(SELECT COUNT(*) FROM $table_claims ) AS assigned");
		    }

		return $client_claims_assign->result();
	}


	public function claims_count(){
		$userdata =$this->session->all_userdata();
    $table_call_entry = $userdata['loggedin_client']."_call_entry";
    if($userdata['loggedin_client'] == '') return 0;
    if($userdata['role'] == 'agent'){
      $client_claims_count = $this->db->query("SELECT(SELECT COUNT(*) FROM $table_call_entry WHERE work_status='Not Workable' and emp_id='".$userdata['emp_id']."' and created_by !='Admin' ) AS not_workable, (SELECT COUNT(*) FROM $table_call_entry WHERE call_status ='completed' and work_status Not In ('Not Workable') and emp_id='".$userdata['emp_id']."' and created_by !='Admin' ) AS completed");

    }else{
        $client_claims_count = $this->db->query("SELECT(SELECT COUNT(*) FROM $table_call_entry WHERE work_status='Not Workable'  ) AS not_workable, (SELECT COUNT(*) FROM $table_call_entry WHERE call_status ='completed' and work_status Not In ('Not Workable') ) AS completed");

    }

	return $client_claims_count->result();
	}
//jagan End

	public function all_users(){
		// $sql = $this->db->select('*, count(*) as assigned')->from('client_claims')->group_by('emp_id')->get()->result_array();
		$sql = $this->db->query("SELECT *, count(*) as assigned FROM `client_claims` GROUP BY `emp_id`");
		// echo $this->db->last_query();die;
		return $sql->result_array();
	}

	public function get_values(){
		$sql_two = $this->db->query("SELECT * FROM client_call_entry WHERE work_status='Workable' AND emp_id='0001'");
	}

	public function get_emp_names(){
		return $this->db->distinct()->select('emp_name')->from('client_claims')->get()->result_array();
	}

	public function getSearchData($fromDate, $toDate, $userName){

		if(!empty($userName)){
			$this->db->where('emp_name', $userName);
		}

		if(!empty($fromDate) && !empty($toDate)){
			$this->db->where("created_date BETWEEN '$fromDate' AND '$toDate'");
		}else{

			if(!empty($fromDate)){
				$this->db->where('DATE_FORMAT(created_date, "%Y-%m-%d %H:%i:%s") >=', $fromDate);
			}

			if(!empty($toDate)){
				$this->db->where('DATE_FORMAT(created_date, "%Y-%m-%d %H:%i:%s") <=', $toDate);
			}
		}

		$sql = $this->db->select('*, count(*) as assigned')
		->from('client_claims')
		->group_by('emp_id')
		->get()
		->result_array();
		// print_r($this->db->last_query());
		return $sql;
	}

//jagan start
	  public function getusercallentry($data){
      $userdata =$this->session->all_userdata();
      $table_call_entry = $userdata['loggedin_client']."_call_entry";
      $sql=$this->db->query("SELECT * FROM $table_call_entry WHERE unique_id='".$data."'  ORDER BY id desc");
      return $sql->result();
    }
//jagan end
	public function get_claims_data(){	
		$userdata =$this->session->all_userdata();	
		$table_claims = $userdata['loggedin_client']."_claims";	
		$table_call_entry = $userdata['loggedin_client']."_call_entry";	
		$claims_data = $this->db->query("SELECT $table_claims.*, count(*) AS total FROM $table_claims WHERE $table_claims.unique_id not in (select $table_call_entry.unique_id from $table_call_entry) GROUP BY emp_id ORDER BY id asc");	
		return $claims_data->result();	
	}	
	public function get_emp_claims($emp_id){	
		$userdata =$this->session->all_userdata();	
		$table_claims = $userdata['loggedin_client']."_claims";	
		$table_call_entry = $userdata['loggedin_client']."_call_entry";	
		$emp_name = $this->db->query("SELECT $table_claims.* FROM $table_claims WHERE emp_id='".$emp_id."' AND $table_claims.unique_id not in (select $table_call_entry.unique_id from $table_call_entry)");	
		return $emp_name->result();	
	}	
	public function get_all_agents(){	
		return $this->db->query("SELECT * FROM users WHERE role='agent' ")->result();	
	}	
	public function reallocate_claims($emp_id, $claim_ids){	
		$arr = implode("','", $claim_ids);	
		$userdata =$this->session->all_userdata();	
		$table_claims = $userdata['loggedin_client']."_claims";	
		$this->db->query("UPDATE $table_claims SET emp_id='".$emp_id."' WHERE id IN ('".$arr."')");	
		if($this->db->affected_rows() > 0) {return TRUE;}	
		else {return FALSE;}	
	}
 }

 ?>
