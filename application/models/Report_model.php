<?php
 class Report_model extends CI_Model{

 	public function __construct(){
 		date_default_timezone_set('Asia/Kolkata');
 	}

 	public function get_reports(){
	 	$userdata =$this->session->all_userdata();
	 	$table_claims = $userdata['loggedin_client']."_claims";
	    $table_call_entry = $userdata['loggedin_client']."_call_entry";
	    $table_qa = $userdata['loggedin_client']."_qa";

	    $fromdate = $this->input->post('fromdate');
	    $todate = $this->input->post('todate');
	    $report_type = $this->input->post('report_type');
	    $clientlist = $this->input->post('clientlist');

	    if($clientlist != 'all') { $clientlist='AND users.emp_id= "'.$clientlist.'" '; }
	    else { $clientlist=''; }

 		return $this->db->query("SELECT t3.claim_id,t3.patient,users.name,t3.created_date as qa_date,t1.created_date as c_date,t1.error_type,t1.error_description,t1.qa_notes,t1.fatal_error,t1.err_correct_res_note,t1.err_correct_res,t1.error_source from $table_qa t1 LEFT JOIN $table_call_entry t2 ON t1.unique_id = t2.unique_id LEFT JOIN users ON users.emp_id = t2.emp_id LEFT JOIN $table_claims t3 ON t3.unique_id=t2.unique_id WHERE t1.err_correct_res!='' AND t1.created_date BETWEEN '".$fromdate."' AND '".$todate."' $clientlist")->result();
 		//echo $this->db->last_query();
 	}

 	public function get_custom_reports($searchVal){
	 	$userdata =$this->session->all_userdata();
	 	$table_claims = $userdata['loggedin_client']."_claims";
	    $table_call_entry = $userdata['loggedin_client']."_call_entry";
	    $table_qa = $userdata['loggedin_client']."_qa";

	    $fromdate = $this->input->post('fromdate');
	    $todate = $this->input->post('todate');
	    $report_type = $this->input->post('report_type');
	    $clientlist = $this->input->post('clientlist');

	    if($clientlist != 'all') { $clientlist='AND users.emp_id= "'.$clientlist.'" '; }
	    else { $clientlist=''; }

 		return $this->db->query("SELECT $searchVal from $table_qa t1 LEFT JOIN $table_call_entry t2 ON t1.unique_id = t2.unique_id LEFT JOIN users ON users.emp_id = t2.emp_id LEFT JOIN $table_claims t3 ON t3.unique_id=t2.unique_id WHERE t1.err_correct_res!='' AND t1.created_date BETWEEN '".$fromdate."' AND '".$todate."' $clientlist")->result();
 		//echo $this->db->last_query();
 	}

 	// Model for Production Dashboard
 	public function getprod_details(){
 		$userdata = $this->session->all_userdata();
	 	$table_claims = $userdata['loggedin_client']."_claims";
	    $table_call_entry = $userdata['loggedin_client']."_call_entry";
	    $table_qa = $userdata['loggedin_client']."_qa";

	   	$from_date = date('Y-m-01 00:00:00');
       	$to_date = date('Y-m-d H:i:s');
       	
       	if($_SESSION['role'] == 'agent'){
       		$agent_id = $_SESSION['emp_id'];
       	}else{
       		$agent_id = $this->input->post('agent_id');
       	}
       	
       	if($agent_id){
       		$agent_data = "AND u.emp_id='".$agent_id."'";
       	}else{
       		$agent_data = '';
       	}
		// ,sum(trim(replace(a.charges, '$', '')) + 0.0) as charges,a.insurance
	     return $total_prod = $this->db->query("SELECT count(*) as total from $table_call_entry as b LEFT JOIN $table_claims a ON a.unique_id=b.unique_id LEFT JOIN users u ON u.emp_id = a.emp_id WHERE b.create_date between '$from_date' AND '$to_date' $agent_data ")->result();
	    echo $this->db->last_query();
 	}

 	public function get_insurance_claimed(){
 		$userdata = $this->session->all_userdata();
	 	$table_claims = $userdata['loggedin_client']."_claims";
	    $table_call_entry = $userdata['loggedin_client']."_call_entry";
	    $table_qa = $userdata['loggedin_client']."_qa";

	    $from_date = date('Y-m-01 00:00:00');
       	$to_date = date('Y-m-d H:i:s');
       	
       	if($_SESSION['role'] == 'agent'){
       		$agent_id = $_SESSION['emp_id'];
       	}else{
       		$agent_id = $this->input->post('agent_id');
       	}
       	
       	if($agent_id){
       		$agent_data = "AND u.emp_id='".$agent_id."'";
       	}else{
       		$agent_data = '';
       	}

       	if($_SESSION['loggedin_client'] == 'sjhealth' || $_SESSION['loggedin_client'] == 'sandstone'){
       		$charges = "b.charges";
       		$insurance = "b.insurance";
       	}elseif($_SESSION['loggedin_client'] == 'ava' || $_SESSION['loggedin_client'] == 'lightningsteps'){
       		$charges = "b.billed";
       		$insurance = "b.payor";
       	}elseif($_SESSION['loggedin_client'] == 'elevatedbilling'){
                     $charges = "b.charge";
                     $insurance = "b.ins";
              }elseif($_SESSION['loggedin_client'] == 'medisys' || $_SESSION['loggedin_client'] == 'allinwon'){
                     $charges = "b.charge_amount";
                     $insurance = "b.insurance";
              }elseif($_SESSION['loggedin_client'] == 'clarin'){
                     $charges = "b.charge_amount";
                     $insurance = "b.carrier_name";
              }

 		return $this->db->query("SELECT $insurance as insurance,count(*) as total_claims,SUM(replace(replace($charges, '$', ''), ',', '')) as charges FROM $table_call_entry a LEFT JOIN $table_claims b ON a.unique_id=b.unique_id LEFT JOIN users u ON u.emp_id = a.emp_id WHERE b.unique_id=a.unique_id AND a.create_date between '$from_date' AND '$to_date' $agent_data GROUP BY $insurance")->result_array();
 		echo $this->db->last_query();
 	}


 	public function get_disposition_details(){
 		$userdata = $this->session->all_userdata();
	 	$table_claims = $userdata['loggedin_client']."_claims";
	    $table_call_entry = $userdata['loggedin_client']."_call_entry";
	    $table_qa = $userdata['loggedin_client']."_qa";

	    $from_date = date('Y-m-01 00:00:00');
       	$to_date = date('Y-m-d H:i:s');

       	if($_SESSION['role'] == 'agent'){
       		$agent_id = $_SESSION['emp_id'];
       	}else{
       		$agent_id = $this->input->post('agent_id');
       	}
       	
       	if($agent_id){
       		$agent_data = "AND u.emp_id='".$agent_id."'";
       	}else{
       		$agent_data = '';
       	}

       	if($_SESSION['loggedin_client'] == 'sjhealth' || $_SESSION['loggedin_client'] == 'sandstone'){
       		$charges = "b.charges";       		
       	}elseif($_SESSION['loggedin_client'] == 'ava' || $_SESSION['loggedin_client'] == 'lightningsteps'){
       		$charges = "b.billed";
       	}elseif($_SESSION['loggedin_client'] == 'elevatedbilling'){
                     $charges = "b.charge";
                     $insurance = "b.ins";
              }elseif($_SESSION['loggedin_client'] == 'medisys' || $_SESSION['loggedin_client'] == 'allinwon'){
                     $charges = "b.charge_amount";
                     $insurance = "b.insurance";
              }elseif($_SESSION['loggedin_client'] == 'clarin'){
                     $charges = "b.charge_amount";
                     $insurance = "b.carrier_name";
              }

 		return $this->db->query("SELECT a.disposition_claims,count(*) as total_dis_claims, SUM(replace(replace($charges, '$', ''), ',', '')) as dis_charges FROM $table_call_entry a LEFT JOIN $table_claims b ON a.unique_id=b.unique_id LEFT JOIN users u ON u.emp_id = a.emp_id WHERE b.unique_id=a.unique_id AND a.create_date between '$from_date' AND '$to_date' $agent_data GROUP BY a.disposition_claims")->result_array();
 		echo $this->db->last_query();
 	}

 	public function update_expctd_value() {

 		$arr_data = array(
 			'expected_count' => $this->input->post('expected_count'),
 			'updated_by' => $_SESSION['name']
 		);
 		return $this->db->where('id', '1')->update('expected_production', $arr_data);
 	}
 }





