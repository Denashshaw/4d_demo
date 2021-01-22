<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ERROR);
class Start_call extends CI_Controller {

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

	public function index()
	{
		$data['login_data'] = $this->Mainmodel->logindata();
		$data['emp_data']   = $this->Mainmodel->agentdata();

		$unique_id = $this->uri->segment(3);
		$data['start_call']  = $this->Sj_health_model->start_call($unique_id);
		$data['sj_disp_data'] = $this->Sj_health_model->getusercallentry($unique_id);
		$switchClient = $this->session->userdata('loggedin_client');
		if(	$switchClient == 'sjhealth'){
				$this->load->view('start_call',$data);
		}else{
			$filename=$switchClient.'_start_call';
			$this->load->view($switchClient.'/'.$filename,$data);
		}
	}

//jagan start
	public function submit_claim(){
		$userdata=$this->session->all_userdata();
		date_default_timezone_set('Asia/Kolkata');
		$time = date('Y-m-d H:i:s');

		if($this->input->post('disposition_claims_suggest')!=''){
			$disposition_claims .= $this->input->post('disposition_claims_suggest');
		}
		if($this->input->post('disposition_claims_yes')!=''){
			$disposition_claims .= $this->input->post('disposition_claims_yes');
		}

			$data = array(
				'time_spent' 					 => $this->input->post('call_time'),
                'call_made'    					 => $this->input->post('call_made'),
                'work_status'		 			 => $this->input->post('work_status'),
                'website_utilized'  			 => $this->input->post('website_utilized'),
                'type_of_work'  				 => $this->input->post('type_of_work'),
                'disposition'   				 => $this->input->post('disposition'),
                'disposition_claims' 			 => $disposition_claims,
                'insurance_company'				 => $this->input->post('insurance_company'),
                'client_instruction' 			 => $this->input->post('client_instruction'),
                'notes'    						 => $this->input->post('notes'),
                'spell_check_grammarly' 		 => $this->input->post('spell_check'),
                'era_reviewed'  				 => $this->input->post('era_reviewed'),
                'previous_notes_reviewed' 	 	 => $this->input->post('previous_notes_reviewed'),
                'line_item_payment_received'   	 => $this->input->post('line_item_ptayment'),
                'fee_schedule_verified' 		 => $this->input->post('fee_schedule_verified'),
                'patient_responsibility_reviewed'=> $this->input->post('patient_responsiblity_reviewed'),
                'updated_correct_status' 		 => $this->input->post('updated_correct_status'),
                'updated_correct_issue_tag'      => $this->input->post('updated_correct_issue_tag'),
                'updated_followup'    			 => $this->input->post('updated_followup'),
                'notes_posted' 					 => $this->input->post('notes_posted'),
                'call_status' 					 => 'completed',
                'created_by'    				 => $userdata['name'],
                'create_date' 					 => $time,
                'unique_id'						 => $this->input->post('unique_id'),
                'emp_id' 						 => $userdata['emp_id']
            );

    		$result = $this->Sj_health_model->add_claim($data);
    		//$this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Claim Successfully Submitted..!</p>');
        	echo json_encode($result);
	}
	//jagan end


}

?>
