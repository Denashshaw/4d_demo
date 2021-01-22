<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ERROR);
class Sj_health extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Mainmodel");
		$this->load->Model("Sj_health_model");
		$userdata=$this->session->all_userdata();
		if($userdata["crm_logged_in"] != TRUE){
			redirect('login/index');
		}
	}

	public function add_sjdata()
	{
		$userdata=$this->session->all_userdata();

		if($userdata["crm_logged_in"] != TRUE ){
			redirect('login/index');
		}

		if(isset($_POST['fadd']))
		{
			date_default_timezone_set('Asia/Kolkata');
			$time = date('Y-m-d H:i:s');

			$details=$this->input->post();

			$check=$this->db->query("SELECT * FROM sj_health_disposition WHERE unique_id='".$details['unique_id']."' ");

			if($check->num_rows() == 0){

				$data = array(
        			'emp_id'    				=> $details['emp_id'],
					'emp_name'					=> $userdata['name'],
					'spell_check_performed'  	=> $details['spell_check'],
					'era_reviewed'  			=> $details['era_reviewed'],
					'previous_notes_reviewed'   => $details['previous_notes_reviewed'],
					'line_item_payment_received'=> $details['line_item_payment'],
					'fee_schedule_verified'    	=> $details['fee_schedule_verified'],
					'patient_responsibility_reviewed' => $details['patient_responsibility_reviewed'],
					'notes_posted' 				=> $details['notes_posted'],
					'created_date'				=> $time,
					'created_by'				=> $userdata['name'],
					'unique_id'					=> $details['unique_id']
				);

		  		$this->db->insert('sj_health_disposition',$data);

				$this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Data Created Successfully ..!</p>');
			}
			else{

				$data = array(
        			'emp_id'    				=> $details['emp_id'],
					'emp_name'					=> $userdata['name'],
					'spell_check_performed'  	=> $details['spell_check'],
					'era_reviewed'  			=> $details['era_reviewed'],
					'previous_notes_reviewed'   => $details['previous_notes_reviewed'],
					'line_item_payment_received'=> $details['line_item_payment'],
					'fee_schedule_verified'    	=> $details['fee_schedule_verified'],
					'patient_responsibility_reviewed' => $details['patient_responsibility_reviewed'],
					'notes_posted' 				=> $details['notes_posted'],
					'created_date'				=> $time,
					'created_by'				=> $userdata['name']
				);

				$this->db->where('unique_id',$details['unique_id']);
		  		$this->db->update('sj_health_disposition',$data);

				$this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Data Updated Successfully ..!</p>');
			}
			redirect('home/index');
		}

	}


	public function completed(){
		$this->load->library("pagination");
		$data["allcnt"] = count($this->Sj_health_model->completed_countrows());
		$config = array();
        $config["base_url"]    = base_url() . "sj_health/completed";
        $config["total_rows"]  = $data["allcnt"];
        $config["per_page"]    = 10;
        $config["uri_segment"] = 3;
	    $this->pagination->initialize($config);

	    $page    = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['sj_health']  = $this->Sj_health_model->sj_health_data_completed($config["per_page"],$page);
		$data["links"]  = $this->pagination->create_links();

		$switchClient = $this->session->userdata('loggedin_client');
		if(	$switchClient == 'medisys'){
			$filename=$switchClient.'_completed';
			$this->load->view($switchClient.'/'.$filename,$data);
		}else{
			$this->load->view('sj_health_completed',$data);
		}
	}

//jagan start
	public function overall_completed(){
		$this->load->library("pagination");
		$data["allcnt"] = count($this->Sj_health_model->completed_countrows_overall());
		$config = array();
        $config["base_url"]    = base_url() . "sj_health/overall_completed";
        $config["total_rows"]  = $data["allcnt"];
        $config["per_page"]    = 10;
        $config["uri_segment"] = 3;
	    $this->pagination->initialize($config);
	    $search = trim($_POST['ins_value']);

	    $page    = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['sj_health']  = $this->Sj_health_model->sj_health_data_completed_overall($config["per_page"],$page,$search);
		$data['clientlist'] = $this->Mainmodel->getuserlist();
		$data["links"]  = $this->pagination->create_links();
		$switchClient = $this->session->userdata('loggedin_client');
		if(	$switchClient == 'sjhealth'){
				$this->load->view('sj_health_completed_overall',$data);
		}else{
			$filename=$switchClient.'_completed_overall';
			$this->load->view($switchClient.'/'.$filename,$data);
		}
	}
//jagan end

	public function not_workable(){

		$this->load->library("pagination");
		$data["allcnt"] = count($this->Sj_health_model->countrows_notworkable());
		$config = array();
        $config["base_url"]    = base_url() . "not_workable";
        $config["total_rows"]  = $data["allcnt"];
        $config["per_page"]    = 10;
        $config["uri_segment"] = 3;
	    $this->pagination->initialize($config);

	    $page    = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['not_workable']  = $this->Sj_health_model->sj_health_not_workable($config["per_page"],$page);
		$data["links"]  = $this->pagination->create_links();

		$switchClient = $this->session->userdata('loggedin_client');
		if(	$switchClient == 'sjhealth'){
				$this->load->view('not_workable',$data);
		}else{
			$filename=$switchClient.'_not_workable';
			$this->load->view($switchClient.'/'.$filename,$data);
		}
	}

	public function export_report(){
		$this->load->model("DataProductivityModle");
		$data['clientlist'] = $this->Mainmodel->getuserlist();
		$data['agentlist'] = $this->Mainmodel->getAgentExport();
		$data['getclientcode'] = $this->DataProductivityModle->getClientcode();

		$this->load->view('export_report',$data);
	}

	public function download_report()
    {

        if ($_POST["fromdate"] != "") {
            $fromdate = date("Y-m-d H:i", strtotime($_POST["fromdate"])) . ':00';
        }
        if ($_POST["todate"] != "") {
            $todate = date("Y-m-d H:i", strtotime($_POST["todate"])) . ':59';
        }

        // $conn = new mysqli('localhost', 'root', '');
        // mysqli_select_db($conn, 'dtvcrm');

        $report_query = $this->db->query('SELECT t1.insurance,t1.facility,t1.claim_id,t1.patient,t1.status,t1.service,t1.dos_start,t1.dos_end,t1.charges,t1.follow_up,t1.last_action_date,t1.days_outstanding,t1.queue,t1.assigned_to_client,t2.call_made,t2.work_status,t2.notes,t2.disposition,t2.disposition_claims,t2.website_utilized,t2.type_of_work,t2.insurance_company,t2.client_instruction,t2.spell_check_grammarly,t2.era_reviewed,t2.previous_notes_reviewed,t2.line_item_payment_received,t2.fee_schedule_verified,t2.patient_responsibility_reviewed,t2.updated_correct_status,t2.updated_correct_issue_tag,t2.updated_followup,t2.notes_posted,t2.emp_id,t2.created_by,t2.create_date FROM sjhealth t1, sjhealth_call_entry t2 where t2.unique_id=t1.unique_id and t2.create_date BETWEEN "' . $fromdate . '" and "' . $todate . '"');

        //$setRec = mysqli_query($conn,$setSql);

        //$columnHeader ='';
        $columnHeader = "Insurance" . "\t" . "Facility" . "\t" . "Claim Id" . "\t" . "Patient" . "\t" . "Status" . "\t" . "Service" . "\t" . "DOS Start" . "\t" . "DOS End" . "\t" . "Charges" . "\t" . "Follow Up" . "\t" .  "Last action date" . "\t" . "Days Outstanding" . "\t" . "Queue" . "\t" . "Assigned to Client" . "\t" . "Call Made" . "\t" . "Work Status" . "\t"  . "Notes" . "\t" . "Disposition" . "\t" . "Disposition Claims" . "\t" . "Website Utilized" . "\t" . "Type of Work" . "\t" .  "\t" . "Insurance Company" . "\t" . "Client Instruction" . "\t" . "Spell Check Grammarly" . "\t" . "ERA Reviewed" . "\t" . "Previous Notes Reviewed" . "\t" . "Line item Payment Received" . "\t" . "Fee Schedule Verified" . "\t" . "Patient Responsibility Reviewed" . "\t" . "Updated Correct Status" . "\t" . "Updated Correct Issue Tag" ."\t" . "Updated Followup" ."\t" . "Notes Posted" ."\t" . "Emp Id" ."\t" . "Emp Name" ."\t" . "Date" ."\t";


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
        header("Content-Disposition: attachment; filename=SJ_Health_Reoprt.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo ucwords($columnHeader) . "\n" . $setData . "\n";
    }

    public function agent_report(){
    	$data['userdetails'] = $this->Sj_health_model->all_users();
		// $data['empName'] = $this->Sj_health_model->get_emp_names();
		$this->load->view('agent_report', $data);
	}

	public function getSearchData(){
		$fromDate = $this->input->post('fromDate');
		$toDate = $this->input->post('toDate');
		$userName = $this->input->post('userName');

		$data['empName'] = $this->Sj_health_model->get_emp_names();
		$data['userdetails'] = $this->Sj_health_model->getSearchData($fromDate, $toDate, $userName);

		$data['searchVal'] =  array('fromDate' => $fromDate, 'toDate' => $toDate, 'userName' => $userName);
		$this->load->view('agent_report', $data);
	}
//jagan start
	public function changeClientCompletedclimes(){
		$client = $this->input->post('client_name');
		$this->session->unset_userdata('loggedin_client');
		$this->session->set_userdata(array("loggedin_client" => $client));
		redirect('overall_completed');
	}
	//jagan end

}

?>
