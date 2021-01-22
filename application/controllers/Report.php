<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ERROR);
class Report extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Report_model");
		$this->load->model('Mainmodel');
		$userdata=$this->session->all_userdata();

		if($userdata["crm_logged_in"] != TRUE){
		 	redirect('login/index');
		}
	}

	//jagam start
		public function report_view()
	    {
	    	$userdata =$this->session->all_userdata();
				$table_call_entry = $userdata['loggedin_client']."_call_entry";
				$table_claims = $userdata['loggedin_client']."_claims";

	    	// if(isset($_POST['clientlist'])){
				$emp_id=$_POST['clientlist'];

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
			// }
			if($userdata['department'] == "Voice" || $userdata['role'] == 'admin')
			{

			if($_POST['report_type'] == 'qa_report'){
				if(isset($_POST['submit'])){
					$data['qa_details'] = $this->Report_model->get_reports();
        			$this->load->view('export_report', $data);
	        	}elseif(isset($_POST['Excel'])){
	        		$num_errs='';
	        		$dpo='';

	        		$columnHeader = $_POST['fields'];
	        		if(count($columnHeader) < 1){
	        			die('please check atleast one checkbox');
	        		}
	        		if(isset($_POST['fields']))
	        	for($i = 0; $i < count($columnHeader);$i++){
				    if ($columnHeader[$i] == 'Claim Id'){
				       	$searchVal[$i] = "t3.claim_id";
			        }elseif($columnHeader[$i] == 'Patient Name'){
				       	$searchVal[$i] = "t3.patient";
			        }elseif($columnHeader[$i] == 'Agent Name'){
			       		$searchVal[$i] = "users.name";
			        }elseif($columnHeader[$i] == 'Production Date'){
			        	$searchVal[$i] = "t2.create_date";
			        }elseif($columnHeader[$i] == 'Error Identified On'){
			        	$searchVal[$i] = "t1.created_date";
			        }elseif($columnHeader[$i] == 'Types of Error'){
			        	$searchVal[$i] = "t1.error_type";
			        }elseif($columnHeader[$i] == 'Error Details'){
			        	$searchVal[$i] = "t1.error_description";
			        }elseif($columnHeader[$i] == 'QA Notes'){
			        	$searchVal[$i] = "t1.qa_notes";
			        }elseif($columnHeader[$i] == 'Error Category'){
			        	$searchVal[$i] = "t1.fatal_error";
			        }elseif($columnHeader[$i] == 'Notes'){
			        	$searchVal[$i] = "t1.err_correct_res_note";
			        }elseif($columnHeader[$i] == 'Error Correction Responses'){
			        	$searchVal[$i] = "t1.err_correct_res";
			        }elseif ($columnHeader[$i] == 'Error Source') {
			        	$searchVal[$i] = 't1.error_source';
			        }elseif ($columnHeader[$i] == 'No of Errors') {
			        	$num_errs = 'Number of Errors';
			        }elseif ($columnHeader[$i] == 'DPO') {
			        	$dpo = 'DPO';
			        }
				}

				$setcolData = '';
				foreach ($columnHeader as $key => $value) {
					$colData = '';
					$value = '"' . $value . '"' . "\t";
					$colData .= $value;
					$setcolData .= trim($colData) . "\t";
				}

	        	$searchVal = implode(",", $searchVal);
	        	$report_query = $this->Report_model->get_custom_reports($searchVal);

	  			$setData = '';
	        	foreach ($report_query as $row) {
					$rowData = '';
					foreach ($row as $value) {
						$value = '"' . $value . '"' . "\t";
						$rowData .= $value;
					}
					if($num_errs != ''){
						$rowData .= '1'. "\t";
					}
					if($dpo != ''){
						$rowData .= '1'. "\t";
					}
	            $setData .= trim($rowData) . "\n";
				}

	        	$userdata = $this->session->all_userdata();
	      		$filename = $userdata['loggedin_client'].'_Report.xls';
						header("Content-type: application/octet-stream");
						header("Content-Disposition: attachment; filename=$filename");
						header("Pragma: no-cache");
						header("Expires: 0");
						echo ucwords($setcolData) . "\n" . $setData . "\n";
	        	}
	        	elseif(isset($_POST['Pdf'])) {
	        		$num_errs='';
	        		$dpo='';
				$columnHeader = $_POST['fields'];

					for($i = 0; $i < count($columnHeader);$i++){
						if ($columnHeader[$i] == 'Claim Id'){
							$searchVal[$i] = "t3.claim_id";
						}elseif($columnHeader[$i] == 'Patient Name'){
							$searchVal[$i] = "t3.patient";
						}elseif($columnHeader[$i] == 'Agent Name'){
							$searchVal[$i] = "users.name";
						}elseif($columnHeader[$i] == 'Production Date'){
							$searchVal[$i] = "t2.create_date";
						}elseif($columnHeader[$i] == 'Error Identified On'){
							$searchVal[$i] = "t1.created_date";
						}elseif($columnHeader[$i] == 'Types of Error'){
							$searchVal[$i] = "t1.error_type";
						}elseif($columnHeader[$i] == 'Error Details'){
							$searchVal[$i] = "t1.error_description";
						}elseif($columnHeader[$i] == 'QA Notes'){
							$searchVal[$i] = "t1.qa_notes";
						}elseif($columnHeader[$i] == 'Error Category'){
							$searchVal[$i] = "t1.fatal_error";
						}elseif($columnHeader[$i] == 'Notes'){
							$searchVal[$i] = "t1.err_correct_res_note";
						}elseif($columnHeader[$i] == 'Error Correction Responses'){
							$searchVal[$i] = "t1.err_correct_res";
						}elseif ($columnHeader[$i] == 'Error Source') {
			        		$searchVal[$i] = "t1.error_source";
			        	}elseif ($columnHeader[$i] == 'No of Errors') {
			        		$num_errs = 'Number of Errors';
				        }elseif ($columnHeader[$i] == 'DPO') {
				        	$dpo = 'DPO';
				        }
					}

					$reshtml='';
					$pf=$userdata['loggedin_client'];
					$date=date('d-m-Y');
					$reshtml .= '<br><table class="table table-responsive" style="width:100%;border: 1px solid black;overflow-x: scroll;max-width:750px;font-size:9px;border: 1px solid gray;text-align:Center;"><thead  style="border: 1px solid gray;font-size:8px;"><tr style="border: 1px solid black;font-size:14px;font-weight:bold;background-color:#e4e2e2;"><th colspan="3"><img src="'.base_url().'img/logo.jpg" style="width:120px;height150px;align:right"></th><th colspan="7" style="font-size:16px;text-align:center;"><br>'.$pf.' - QA Report</th><th colspan="3" style="text-align:right">'.$date.'</th></tr></thead></table><table class="table table-responsive" style="width:100%;border: 1px solid black;overflow-x: scroll;max-width:750px;font-size:9px;border: 1px solid gray;text-align:Center;"><thead  style="border: 1px solid gray;font-size:8px;"><tr style="border: 1px solid gray;">';
					for($i=0;$i< sizeof($columnHeader);$i++){
						$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">'.$columnHeader[$i] .'</th>');
					}
					$reshtml .='</tr>	</thead><tbody style="font-size:8px;min-width:100%;">';

					$searchVal = implode(",", $searchVal);
					$report_query = $this->Report_model->get_custom_reports($searchVal);

					foreach ($report_query as $row) {
					$rowData = '<tr style="border: 1px solid gray;">';
						foreach ($row as $value) {
							$value = '<td  style="border: 1px solid gray;">' . $value . '</td>' ;
							$rowData .= $value;
						}

						$reshtml .= $rowData;	
						if($num_errs != ''){	
							$reshtml .=  '<td  style="border: 1px solid gray;">1</td>';	
						}	
						if($dpo != ''){	
							$reshtml .=  '<td  style="border: 1px solid gray;">1</td>';	
						}	
						$reshtml .=  '</tr>';	
	 				}
					$reshtml .='</tbody></table>';


					$userdata = $this->session->all_userdata();
					$this->load->library('Pdf');
					$pdf = new Pdf('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
					$pdf->SetTitle('QA Report');
					$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
					$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
					$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
					$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
					//	 $pdf->SetAuthor('Author');
					$pdf->SetDisplayMode('real', 'default');
					if(sizeof($_POST['fields']) > 8){
					 $pdf->AddPage('L');

					}else{
					 	$pdf->AddPage();
					}

					$pdf->writeHTML($reshtml, true, 0, true, 0);
					//  $pdf->writeHTMLCell(0, 0, '', '', $reshtml, 0, 1, 0, true, '', true);
					$pdf->Output($pf.'_QAreport.pdf', 'I');
	        	 }
			}
				elseif($_POST['report_type'] == 'qa_Productivityreport'){
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
		}



			//Data Start
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
		$report_query = $this->db->query('SELECT Date,Emp_ID,Emp_name,ClientCode,DemosEntered,Demo_ChargesEntered,Demo_OnlineEligible,Demo_ExpProduct,Demo_TotalPRoduct,Demo_PP,Payment_ManualPosting,Payment_ERAPosting,Payment_DenialsCaptured,Payment_ExpProduct,Payment_TotalPRoduct,Payment_PP,demo_chargesQC,demo_chargesQC_EP,demo_chargesQC_PP,PaymentsQC,PaymentsQC_EP,PaymentsQC_PP FROM dataproductivity where '.$setuserid.' '.$CCode.' Created_at BETWEEN "' . $fromdate . '" and "' . $todate . '"');

	
		if(isset($_POST['Excel'])){
			$filename= 'DataProductivity_Reoprt.xls';
			header("Content-type: application/xls");
			header("Content-Disposition: attachment; filename=$filename");
			header("Pragma: no-cache");
			header("Expires: 0");
			$dt='';
			$dt.= '<table border="1">';
		$date=date('Y-m-d');
		$dt.= '<thead  style="border: 1px solid gray;font-size:8px;"><tr style="font-size:14px;font-weight:bold;height:90px;"><th colspan="5" style="background-color:#e4e2e2;border: 1px solid black;"><img src="'.base_url().'img/logo.jpg" style="width:120px;height150px;align:right"></th><th colspan="10" style="border: 1px solid black;font-size:16px;text-align:center;background-color:#e4e2e2;"><br>Data Productivity Report</th><th colspan="7" style="text-align:right;background-color:#e4e2e2;border: 1px solid black;">'.$date.'</th></tr></thead>';


$dt.= '<tr style="height:50px;"><th>Date</th><th>Emp ID</th><th>Emp Name</th><th>Client Code</th><th>Demos Entered</th><th>Demo Charges Entered</th><th>Demo Online Eligible</th><th>Demo Exp Product</th><th>Demo Total Product</th><th>Demo Product Percentage</th><th>Payment Manual Posting</th><th>Payment ERA Posting</th><th>Payment Denials Captured</th><th>Payment Exp Product</th><th>Payment Total Product</th><th>Payment Product Percentage</th><th>Demo Charges QC</th><th>Demo ChargesQC Exp Product</th><th>Demo chargesQC Productive Percentage</th><th>Payments QC</th><th>ayments QC Exp Product</th><th>Payments QC Product Percentage</th></tr>';

	
		$setData = '';

		foreach ($report_query->result_array() as $row) {
		$dt.= '<tr style="height:50px;text-align:center;">';
			foreach ($row as $value) {
				//$value = '"' . $value . '"' . "\t";
				//$rowData .= $value;
			$dt.= '<td>'.htmlspecialchars($value).'</td>';
			}
			$dt.= '</tr>';
		//	$setData .= trim($rowData) . "\n";
		}
		$dt.= '</table>';
	
		echo $dt;

		//	echo ucwords($columnHeader) . "\n" . $setData . "\n";
		}//excelend
		if(isset($_POST['PDF'])){

			$reshtml='';
			$reshtml .='<table border="1" style="font-size:8px">';
			$date=date('Y-m-d');
			$reshtml .= '<thead  style="border: 1px solid gray;font-size:8px;"><tr style="font-size:14px;font-weight:bold;height:90px;"><th colspan="5" style="background-color:#e4e2e2;border: 1px solid black;"><img src="'.base_url().'img/logo.jpg" style="width:120px;height150px;align:right"></th><th colspan="10" style="border: 1px solid black;font-size:16px;text-align:center;background-color:#e4e2e2;"><br>Data Productivity Report</th><th colspan="7" style="text-align:right;background-color:#e4e2e2;border: 1px solid black;">'.$date.'</th></tr></thead>';

		
		$reshtml.='<tr style="height:50px;"><th>Date</th><th>Emp ID</th><th>Emp Name</th><th>Client Code</th><th>Demos Entered</th><th>Demo Charges Entered</th><th>Demo Online Eligible</th><th>Demo Exp Product</th><th>Demo Total Product</th><th>Demo Product Percentage</th><th>Payment Manual Posting</th><th>Payment ERA Posting</th><th>Payment Denials Captured</th><th>Payment Exp Product</th><th>Payment Total Product</th><th>Payment Product Percentage</th><th>Demo Charges QC</th><th>Demo ChargesQC Exp Product</th><th>Demo chargesQC Productive Percentage</th><th>Payments QC</th><th>ayments QC Exp Product</th><th>Payments QC Product Percentage</th></tr>';
			
			

			foreach ($report_query->result_array() as $row) {
				$reshtml.= '<tr style="height:50px;text-align:center;">';
				foreach ($row as $value) {
					//$value = '"' . $value . '"' . "\t";
					//$rowData .= $value;
					$reshtml.= '<td>'.htmlspecialchars($value).'</td>';
				}
				$reshtml.= '</tr>';
			}
			$reshtml.='</table>';



			$this->load->library('Pdf');
					$pdf = new Pdf('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
					$pdf->SetTitle('QA Report');
					$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
					$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
					$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
					$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
					//	 $pdf->SetAuthor('Author');
					$pdf->AddPage('L');
				//	$pdf->SetFont('roboto', '', 12);
					$pdf->SetDisplayMode('real', 'default');
					$pdf->writeHTML($reshtml, true, 0, true, 0);
					//  $pdf->writeHTMLCell(0, 0, '', '', $reshtml, 0, 1, 0, true, '', true);
					$pdf->Output('DataProductivityReport.pdf', 'I');
		}
		}
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

				$checkrep = $this->db->query('SELECT Date,Emp_ID,Emp_name,ClientCode,DemosEntered,Demo_ChargesEntered,Demo_OnlineEligible,Demo_ExpProduct,Demo_TotalPRoduct,Demo_PP,Payment_ManualPosting,Payment_ERAPosting,Payment_DenialsCaptured,Payment_ExpProduct,Payment_TotalPRoduct,Payment_PP,demo_chargesQC,demo_chargesQC_EP,demo_chargesQC_PP,PaymentsQC,PaymentsQC_PP FROM dataproductivity where '.$setuserid.' '.$CCode.' Created_at BETWEEN "' . $fromdate . '" and "' . $todate . '"');
				echo json_encode($checkrep->num_rows());
			}


}
