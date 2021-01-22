<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ERROR);
class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Mainmodel");
		$this->load->model("Sj_health_model");
		$userdata=$this->session->all_userdata();

		if($userdata["crm_logged_in"] != TRUE){
		   //redirect('Logindetails/login_details');
		 	redirect('login/index');
		}

	}
//jagan start
	public function index()
{

	$data['login_data'] = $this->Mainmodel->logindata();
	$data['emp_data']   = $this->Mainmodel->agentdata();
	$data['clientlist'] = $this->Mainmodel->getuserlist();

	$data['claims_count'] = $this->Sj_health_model->claims_assigned();
	$data['counts']       = $this->Sj_health_model->claims_count();

	$this->load->library("pagination");
	$data["allcnt"] = count($this->Sj_health_model->countrows());
	$config = array();
			$config["base_url"]    = base_url() . "home/index";
			$config["total_rows"]  = $data["allcnt"];
			$config["per_page"]    = 100;
			$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
	$search = trim($_POST['ins_value']);

		$page    = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	$data['sj_health']  = $this->Sj_health_model->sj_health_data($config["per_page"],$page,$search);
	$data["links"]  = $this->pagination->create_links();

	$switchClient = $this->session->userdata('loggedin_client');
	if(	$switchClient == 'sjhealth'){
			$this->load->view('home',$data);
	}else{
		$filename=$switchClient.'_home';
		$this->load->view($switchClient.'/'.$filename,$data);
	}
}
//jagan end


	public function agentlist(){
		$currentagent_data=$this->Mainmodel->agentdata();
		$curAgent=[];	$hideAgent=[];
		$i=0;
		foreach($currentagent_data as $a){
			$curAgent[$i]=$a;
			$curAgent[$i]->activestatus='1';
			$i++;
		}
		$hideagent_data=$this->Mainmodel->hideagentdata();
		foreach($hideagent_data as $a){
			$hideAgent[$i]=$a;
			$hideAgent[$i]->activestatus='0';
			$i++;
		}
		$data['agent_data']=array_merge($curAgent,$hideAgent);
		sort($data['agent_data']);
		$this->load->view('agentlist',$data);
	}

	public function assign_break(){
		$this->load->view('assign_break');
	}

	public function assignagents(){
		$data['clientlist'] = $this->Mainmodel->getuserlist();
		$this->load->view('assign_agent',$data);
	}

	public function notfound(){
		$this->load->view('notfound');
	}

//jagam start
public function download_report()
    {
			$emp_id=$_POST['clientlist'];

			$userdata =$this->session->all_userdata();
			$table_call_entry = $userdata['loggedin_client']."_call_entry";
			$table_claims = $userdata['loggedin_client']."_claims";

        if ($_POST["fromdate"] != "") {
            $fromdate = date("Y-m-d H:i", strtotime($_POST["fromdate"])) . ':00';
        }
        if ($_POST["todate"] != "") {
            $todate = date("Y-m-d H:i", strtotime($_POST["todate"])) . ':59';
				}

				if($emp_id != 'all'){
				 $setuserid =	htmlspecialchars("t1.emp_id='$emp_id' and");
				}else{
					if($userdata['role'] == 'admin'){
						$setuserid ="";
					}
					else{
						$data = $this->Mainmodel->getAgentExport();
						$getuser=array();
						foreach($data as $getuserid){
							array_push($getuser,$getuserid->emp_id);
						}
						$agentid=implode("','",$getuser);
						$setuserid =	htmlspecialchars("t1.emp_id in ('$agentid') and");
					}

				}

		if($userdata['department'] == "Voice" || $userdata['role'] == 'admin')
		{
      if(strtolower($userdata['loggedin_client']) == 'ava'){
					$report_query = $this->db->query('SELECT t1.Tags,t1.Date_Range,t1.Claim,t1.Clients_Name,t1.Service,t1.Location,t1.Payor,t1.Billed,t1.Payment,t1.Adjustment,t1.Writeoff,t1.Balance,t1.Expected_Revenue,t1.Expected_Collection,t1.Status,t1.Allowed_Amount,t1.Deductible,t1.CoInsurance,t1.Copay,t1.Amount_Paid,t1.Date_Paid,t1.Last_Follow_up_Date,t1.Claim_Notes,t1.Claim_Numbers,t1.Check_Numbers,t1.EFT_Number,t2.call_made,t2.work_status,t2.notes,t2.disposition,t2.disposition_claims,t2.website_utilized,t2.type_of_work,t2.insurance_company,t2.client_instruction,t2.spell_check_grammarly,t2.era_reviewed,t2.previous_notes_reviewed,t2.line_item_payment_received,t2.fee_schedule_verified,t2.patient_responsibility_reviewed,t2.updated_correct_status,t2.updated_correct_issue_tag,t2.updated_followup,t2.notes_posted,t2.create_date FROM '.$table_claims.' t1, '.$table_call_entry.' t2 where '.$setuserid.' t2.unique_id=t1.unique_id and t2.create_date BETWEEN "' . $fromdate . '" and "' . $todate . '" group by t2.unique_id');

					$columnHeader = "Tags" . "\t" . "Date Range" . "\t" . "Claim" . "\t" . "Clients Name" . "\t" . "Service" . "\t" . "Location" . "\t" . "Payor" . "\t" . "Billed" . "\t" . "Payment" . "\t" . "Adjustment" . "\t" .  "Write-off" . "\t" . "Balance" . "\t" . "Expected Revenue" . "\t" . "Expected Collection" . "\t" ."Status" . "\t" ."Allowed Amount" . "\t" ."Deductible" . "\t" ."CoInsurance" . "\t" ."Copay" . "\t" ."Amount Paid" . "\t" ."Date Paid" . "\t" . "Last Follow up Date". "\t". "Claim Notes" ."\t". "Claim Numbers" ."\t". "Check Numbers" ."\t". "EFT Number" ."\t". "Call Made" . "\t" . "Work Status" . "\t"  . "Notes" . "\t" . "Disposition" . "\t" . "Disposition Claims" . "\t" . "Website Utilized" . "\t" . "Type of Work" . "\t" .  "Insurance Company" . "\t" . "Client Instruction" . "\t" . "Spell Check Grammarly" . "\t" . "ERA Reviewed" . "\t" . "Previous Notes Reviewed" . "\t" . "Line item Payment Received" . "\t" . "Fee Schedule Verified" . "\t" . "Patient Responsibility Reviewed" . "\t" . "Updated Correct Status" . "\t" . "Updated Correct Issue Tag" ."\t" . "Updated Followup" ."\t" . "Notes Posted" ."\t" . "Date" ."\t";


				}else if(strtolower($userdata['loggedin_client']) == 'lightningsteps'){
					$report_query = $this->db->query('SELECT t1.claims_bucket,t1.date_range,t1.claim,t1.clients_name,t1.service,t1.location,t1.payor,t1.billed,t1.payment,t1.adjustment,t1.writeoff,t1.balance,t1.expected_revenue,t1.expected_collection,t1.status,t1.allowed_amount,t1.deductible,t1.co_insurance,t1.copay,t1.amount_paid,t1.date_paid,t1.last_follow_up_date,t1.claim_notes,t1.claim_numbers,t1.check_numbers,t1.eft_number,t2.call_made,t2.work_status,t2.notes,t2.disposition,t2.disposition_claims,t2.website_utilized,t2.type_of_work,t2.insurance_company,t2.client_instruction,t2.spell_check_grammarly,t2.era_reviewed,t2.previous_notes_reviewed,t2.line_item_payment_received,t2.fee_schedule_verified,t2.patient_responsibility_reviewed,t2.updated_correct_status,t2.updated_correct_issue_tag,t2.updated_followup,t2.notes_posted,t2.create_date FROM '.$table_claims.' t1, '.$table_call_entry.' t2 where '.$setuserid.' t2.unique_id=t1.unique_id and t2.create_date BETWEEN "' . $fromdate . '" and "' . $todate . '" group by t2.unique_id');

					$columnHeader = "Claims Bucket" . "\t" . "Date Range" . "\t" . "Claim" . "\t" . "Clients Name" . "\t" . "Service" . "\t" . "Location" . "\t" . "Payor" . "\t" . "Billed" . "\t" . "Payment" . "\t" . "Adjustment" . "\t" .  "Write-off" . "\t" . "Balance" . "\t" . "Expected Revenue" . "\t" . "Expected Collection" . "\t" ."Status" . "\t" ."Allowed Amount" . "\t" ."Deductible" . "\t" ."CoInsurance" . "\t" ."Copay" . "\t" ."Amount Paid" . "\t" ."Date Paid" . "\t" . "Last Follow up Date". "\t". "Claim Notes" ."\t". "Claim Numbers" ."\t". "Check Numbers" ."\t". "EFT Number" ."\t". "Call Made" . "\t" . "Work Status" . "\t"  . "Notes" . "\t" . "Disposition" . "\t" . "Disposition Claims" . "\t" . "Website Utilized" . "\t" . "Type of Work" . "\t" .  "Insurance Company" . "\t" . "Client Instruction" . "\t" . "Spell Check Grammarly" . "\t" . "ERA Reviewed" . "\t" . "Previous Notes Reviewed" . "\t" . "Line item Payment Received" . "\t" . "Fee Schedule Verified" . "\t" . "Patient Responsibility Reviewed" . "\t" . "Updated Correct Status" . "\t" . "Updated Correct Issue Tag" ."\t" . "Updated Followup" ."\t" . "Notes Posted" ."\t" . "Date" ."\t";
				}else if(strtolower($userdata['loggedin_client']) == 'elevatedbilling'){
					$report_query = $this->db->query('SELECT t1.system,t1.claim_id,t1.ins,t1.patient,t1.charge,t1.dos_from,t1.dos_to,t1.sent,t1.fu_date,t1.level_of_care,t1.status,t1.facility,t1.worked_date,t1.worked_rep,t1.notes,t1.completed,t1.claim,t1.allowed,t1.paid,t1.interest,t1.coinsurance,t1.copay,t1.deductible,t1.date_paid,t1.cashed_date,t1.payer,t1.method,t1.payment,t1.bulk_amount,t1.created_date,t2.call_made,t2.work_status,t2.notes,t2.disposition,t2.disposition_claims,t2.website_utilized,t2.type_of_work,t2.insurance_company,t2.client_instruction,t2.spell_check_grammarly,t2.era_reviewed,t2.previous_notes_reviewed,t2.line_item_payment_received,t2.fee_schedule_verified,t2.patient_responsibility_reviewed,t2.updated_correct_status,t2.updated_correct_issue_tag,t2.updated_followup,t2.notes_posted,t2.create_date FROM '.$table_claims.' t1, '.$table_call_entry.' t2 where '.$setuserid.' t2.unique_id=t1.unique_id and t2.create_date BETWEEN "' . $fromdate . '" and "' . $todate . '" group by t2.unique_id');

					$columnHeader = "System" . "\t" . "Claim Id" . "\t" . "INS" . "\t" . "Patient" . "\t" . "Charge" . "\t" . "DOS From" . "\t" . "DOS To" . "\t" . "Sent" . "\t" . "FU Date" . "\t" . "Level Of Care" . "\t" .  "Status" . "\t" . "Facility" . "\t" . "Worked Date" . "\t" . "Worked Rep" . "\t" ."Notes" . "\t" ."Completed" . "\t" ."Claim" . "\t" ."Allowed" . "\t" ."Paid" . "\t" ."Interest" . "\t" ."Co-Insurance" . "\t" . "Copay". "\t". "Deductible" ."\t". "Date Paid" ."\t". "Cashed Date" ."\t". "Payer" ."\t". "Method" ."\t". "Payment" ."\t". "Bulk Amount" ."\t". "Created Date" ."\t". "Call Made" . "\t" . "Work Status" . "\t"  . "Notes" . "\t" . "Disposition" . "\t" . "Disposition Claims" . "\t" . "Website Utilized" . "\t" . "Type of Work" . "\t" .  "Insurance Company" . "\t" . "Client Instruction" . "\t" . "Spell Check Grammarly" . "\t" . "ERA Reviewed" . "\t" . "Previous Notes Reviewed" . "\t" . "Line item Payment Received" . "\t" . "Fee Schedule Verified" . "\t" . "Patient Responsibility Reviewed" . "\t" . "Updated Correct Status" . "\t" . "Updated Correct Issue Tag" ."\t" . "Updated Followup" ."\t" . "Notes Posted" ."\t" . "Date" ."\t";
				}else{
					$reportqueryval = 'SELECT t1.insurance,t1.facility,t1.claim_id,t1.patient,t1.status,t1.service,t1.dos_start,t1.dos_end,t1.charges,t1.follow_up,t1.last_action_date,t1.days_outstanding,t1.queue,t1.assigned_to_client,t2.call_made,t2.work_status,t2.notes,t2.disposition,t2.disposition_claims,t2.website_utilized,t2.type_of_work,t2.insurance_company,t2.client_instruction,t2.spell_check_grammarly,t2.era_reviewed,t2.previous_notes_reviewed,t2.line_item_payment_received,t2.fee_schedule_verified,t2.patient_responsibility_reviewed,t2.updated_correct_status,t2.updated_correct_issue_tag,t2.updated_followup,t2.notes_posted,t2.emp_id,t1.emp_name,t2.create_date FROM '.$table_claims.' t1, '.$table_call_entry.' t2 where '.$setuserid.' t2.unique_id=t1.unique_id and t2.create_date BETWEEN "' . $fromdate . '" and "' . $todate . '" group by t2.unique_id';
					$report_query=$this->db->query($reportqueryval);

					$columnHeader = "Insurance" . "\t" . "Facility" . "\t" . "Claim Id" . "\t" . "Patient" . "\t" . "Status" . "\t" . "Service" . "\t" . "DOS Start" . "\t" . "DOS End" . "\t" . "Charges" . "\t" . "Follow Up" . "\t" .  "Last action date" . "\t" . "Days Outstanding" . "\t" . "Queue" . "\t" . "Assigned to Client" . "\t" . "Call Made" . "\t" . "Work Status" . "\t"  . "Notes" . "\t" . "Disposition" . "\t" . "Disposition Claims" . "\t" . "Website Utilized" . "\t" . "Type of Work" . "\t" .  "Insurance Company" . "\t" . "Client Instruction" . "\t" . "Spell Check Grammarly" . "\t" . "ERA Reviewed" . "\t" . "Previous Notes Reviewed" . "\t" . "Line item Payment Received" . "\t" . "Fee Schedule Verified" . "\t" . "Patient Responsibility Reviewed" . "\t" . "Updated Correct Status" . "\t" . "Updated Correct Issue Tag" ."\t" . "Updated Followup" ."\t" . "Notes Posted" ."\t" . "Emp Id" ."\t" . "Emp Name" ."\t" . "Date" ."\t";

				}
				$filename= $userdata['loggedin_client'].'_Reoprt.xls';
		}
		if($userdata['department'] == "Data"){
			if($emp_id != 'all'){
				$setuserid =	htmlspecialchars("Emp_ID='$emp_id' and");
			 }else{

					 $data = $this->Mainmodel->getAgentExport();
					 $getuser=array();
					 foreach($data as $getuserid){
						 array_push($getuser,$getuserid->emp_id);
					 }
					 $agentid=implode("','",$getuser);
					 $setuserid =	htmlspecialchars("Emp_ID in ('$agentid') and ");
		 }
		 $clientcode=$_POST['clientid'];
		 if($clientcode != 'all'){
			 $CCode =	htmlspecialchars("ClientCode='$clientcode' and");
		 }
		 else{
			 $this->load->model("DataProductivityModle");
			  $data = $this->DataProductivityModle->getClientcode();
			 	$getcc=array();
				foreach($data as $getuserid){
				 	array_push($getcc,$getuserid->ClientCode);
				}
				$clientid=implode("','",$getcc);
				$CCode =	htmlspecialchars("ClientCode in ('$clientid') and ");
	 	}

			$report_query = $this->db->query('SELECT Date,Emp_ID,Emp_name,ClientCode,DemosEntered,Demo_ChargesEntered,Demo_OnlineEligible,Demo_ExpProduct,Demo_TotalPRoduct,Demo_PP,Payment_ManualPosting,Payment_ERAPosting,Payment_DenialsCaptured,Payment_ExpProduct,Payment_TotalPRoduct,Payment_PP,demo_chargesQC,demo_chargesQC_EP,demo_chargesQC_PP,PaymentsQC,PaymentsQC_PP FROM dataproductivity where '.$setuserid.' '.$CCode.' Created_at BETWEEN "' . $fromdate . '" and "' . $todate . '"');
				$columnHeader = "Date" . "\t" . "Emp ID" . "\t" . "Emp Name" . "\t" . "Client Code" . "\t" . "Demos Entered" . "\t" . "Demo Charges Entered" . "\t" . "Demo Online Eligible" . "\t" . "Demo Exp Product" . "\t" . "Demo Total Product" . "\t" . "Demo Product Percentage" . "\t" .  "Payment Manual Posting" . "\t" . "Payment ERA Posting" . "\t" . "Payment Denials Captured" . "\t" . "Payment Exp Product" . "\t" . "Payment Total Product" . "\t" . "Payment Product Percentage" . "\t"  . "Demo Charges QC" . "\t" . "Demo ChargesQC Exp Product" . "\t" . "demo chargesQC Productive Percentage" . "\t" . "Payments QC" . "\t" . "Payments QC Exp Product" . "\t" .  "Payments QC Product Percentage" . "\t";

				$filename= 'DataProductivity_Reoprt.xls';

		}
        $setData = '';

        foreach ($report_query->result_array() as $row) {
            $rowData = '';
            foreach ($row as $value) {
                $value = '"' . $value . '"' . "\t";
                $rowData .= $value;
            }
            $setData .= trim($rowData) . "\n";
        }


        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: no-cache");
        header("Expires: 0");

       echo ucwords($columnHeader) . "\n" . $setData . "\n";
    }


		//checkdata
		public function checkReportdetails(){
			$emp_id=$_POST['clientlist'];
			$userdata =$this->session->all_userdata();
				if ($_POST["fromdate"] != "") {
						$fromdate = date("Y-m-d H:i", strtotime($_POST["fromdate"])) . ':00';
				}
				if ($_POST["todate"] != "") {
						$todate = date("Y-m-d H:i", strtotime($_POST["todate"])) . ':59';
				}
			if($emp_id != 'all'){
				$setuserid =	htmlspecialchars("Emp_ID='$emp_id' and");
			 }else{
					 $data = $this->Mainmodel->getAgentExport();
					 $getuser=array();
					 foreach($data as $getuserid){
						 array_push($getuser,$getuserid->emp_id);
					 }
					 $agentid=implode("','",$getuser);
					 $setuserid =	htmlspecialchars("Emp_ID in ('$agentid') and ");
		 }
		 $clientcode=$_POST['clientid'];
		 if($clientcode != 'all'){
			 $CCode =	htmlspecialchars("ClientCode='$clientcode' and");
		 }
		 else{
			 $this->load->model("DataProductivityModle");
			  $data = $this->DataProductivityModle->getClientcode();
			 	$getcc=array();
				foreach($data as $getuserid){
				 	array_push($getcc,$getuserid->ClientCode);
				}
				$clientid=implode("','",$getcc);
				$CCode =	htmlspecialchars("ClientCode in ('$clientid') and ");
	 	}

			$checkrep = $this->db->query('SELECT Date,Emp_ID,Emp_name,ClientCode,DemosEntered,Demo_ChargesEntered,Demo_OnlineEligible,Demo_ExpProduct,Demo_TotalPRoduct,Demo_PP,Payment_ManualPosting,Payment_ERAPosting,Payment_DenialsCaptured,Payment_ExpProduct,Payment_TotalPRoduct,Payment_PP,demo_chargesQC,demo_chargesQC_EP,demo_chargesQC_PP,PaymentsQC_EP,PaymentsQC,PaymentsQC_PP FROM dataproductivity where '.$setuserid.' '.$CCode.' Created_at BETWEEN "' . $fromdate . '" and "' . $todate . '"');
			echo json_encode($checkrep->result_array());
		}



		public function workreport(){
			$data['agent_data'] = $this->Mainmodel->agentdata();
			$data['clientlist'] = $this->Mainmodel->getuserlist();
			$this->load->view('agentreport',$data);
		}
		public function agentreport(){
			$data['agent_data'] = $this->Mainmodel->agentdata();
			$data['clientlist'] = $this->Mainmodel->getuserlist();
			$data['agentReprot'] = $this->Mainmodel->agentreport($_POST);
			$this->load->view('agentreport',$data);

		}

		// public function lightning_page(){
		// 	$data['login_data'] = $this->Mainmodel->logindata();
		// 	$data['emp_data']   = $this->Mainmodel->agentdata();
		// 	$data['clientlist'] = $this->Mainmodel->getuserlist();

		// 	$data['claims_count'] = $this->Sj_health_model->claims_assigned();
		// 	$data['counts']       = $this->Sj_health_model->claims_count();

		// 	$this->load->library("pagination");
		// 	$data["allcnt"] = count($this->Sj_health_model->countrows());
		// 	$config = array();
		// 			$config["base_url"]    = base_url() . "home/index";
		// 			$config["total_rows"]  = $data["allcnt"];
		// 			$config["per_page"]    = 15;
		// 			$config["uri_segment"] = 3;
		// 		$this->pagination->initialize($config);
		// 	$search = trim($_POST['ins_value']);

		// 		$page    = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		// 	$data['sj_health']  = $this->Sj_health_model->sj_health_data($config["per_page"],$page,$search);
		// 	$data["links"]  = $this->pagination->create_links();

		// 	$this->load->view('lightningsteps/lightningsteps', $data);
		// }

		public function changeClient(){
			$client = $this->input->post('client_name');
			$this->session->unset_userdata('loggedin_client');
			$this->session->set_userdata(array("loggedin_client" => $client));
			redirect('home/index');
		}

		public function changeClientdownload(){
			$client = $this->input->post('client_name');
			$this->session->unset_userdata('loggedin_client');
			$this->session->set_userdata(array("loggedin_client" => $client));
			redirect('export_report');
		}

		public function  agentrepotchangeclient(){
			$client = $this->input->post('client_name');
			$this->session->unset_userdata('loggedin_client');
			$this->session->set_userdata(array("loggedin_client" => $client));
			redirect('workreport');
		}
		//jagam end

		// denash shaw start
		public function changeClientAgent(){
			$client = $this->input->post('client_name');
			$this->session->unset_userdata('loggedin_client');
			$this->session->set_userdata(array("loggedin_client" => $client));
			redirect('home/agentlist');	
		}

		public function changeComClaims(){
			$client = $this->input->post('client_name');
			$this->session->unset_userdata('loggedin_client');
			$this->session->set_userdata(array("loggedin_client" => $client));
			redirect('sj_health/overall_completed');	
		}

		public function changeCompleted_qa(){
			$client = $this->input->post('client_name');
			$this->session->unset_userdata('loggedin_client');
			$this->session->set_userdata(array("loggedin_client" => $client));
			redirect('start_qa/completed_qa');	
		}

		public function changeNotWorkable(){
			$client = $this->input->post('client_name');
			$this->session->unset_userdata('loggedin_client');
			$this->session->set_userdata(array("loggedin_client" => $client));
			redirect('sj_health/not_workable');	
		}

		public function changeProdDashboard(){
			$client = $this->input->post('client_name');
			$this->session->unset_userdata('loggedin_client');
			$this->session->set_userdata(array("loggedin_client" => $client));
			redirect('Prod_dashboard/index');	
		}

		public function claims_report(){	
			$data['claims_report'] = $this->Sj_health_model->get_claims_data();	
			$this->load->view('claims_report',$data);	
		}	
		public function reallocate_claims(){	
			$emp_id = $this->uri->segment(3);	
			$data['agent_detail']  = $this->Sj_health_model->get_emp_claims($emp_id);	
			$data['all_agents']  = $this->Sj_health_model->get_all_agents();	
			$this->load->view('reallocate_claims',$data);	
		}	
		public function changeReallocateClaims(){	
			$client = $this->input->post('client_name');	
			$this->session->unset_userdata('loggedin_client');	
			$this->session->set_userdata(array("loggedin_client" => $client));	
			redirect('home/claims_report');	
		}	
		public function reupdate_claims(){	
			$emp_id = $this->input->post('emp_name');	
			$claim_ids = $this->input->post('claims_id');	
			$reassigned_claims = $this->Sj_health_model->reallocate_claims($emp_id, $claim_ids);	
			if($reassigned_claims){	
				$this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Claims Reassigned Successfully ...!</p>');	
				redirect('home/claims_report');	
			}else if($claim_ids == ''){	
				$this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Please select any claims to Reassign</p>');	
				redirect('home/claims_report');	
			}else{	
				$this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Claims Reassigned Failed..! Please try again later</p>');	
				redirect('home/claims_report');	
			}	
		}
		// denash shaw end
}

?>
