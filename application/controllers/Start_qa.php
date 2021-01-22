<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ERROR);
class Start_qa extends CI_Controller {

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
		$data['claim_qa']  = $this->Sj_health_model->start_qa($unique_id);

		$switchClient = $this->session->userdata('loggedin_client');
		
		if($switchClient == 'sandstone'){
			$this->load->view('sandstone/sandstone_start_qa',$data);
		}else{
			$this->load->view('start_qa',$data);
		}
	}

	public function completed_qa_data(){
		$unique_id = $this->uri->segment(3);
		$data['claim_qa']  = $this->Sj_health_model->start_qa($unique_id);

		$this->load->view('completed_qa_data',$data);
	}

//jagan start
	public function submit_qa(){

		$userdata=$this->session->all_userdata();
		date_default_timezone_set('Asia/Kolkata');
		$time = date('Y-m-d H:i:s');

		$data = array(
			'error' 		    => $this->input->post('error'),
	        'error_source'    	=> $this->input->post('error_source'),
	        'error_type'    	=> $this->input->post('error_type'),
	        'error_description' => $this->input->post('error_description'),
	        'claim_type' 		=> $this->input->post('claim_type'),
	        'fatal_error'  		=> $this->input->post('fatal_error'),
	        'escalate_to_tl'   	=> $this->input->post('escalate_to_tl'),
	        'qa_notes'    		=> $this->input->post('qa_notes'),
	        'qa_status' 		=> 'completed',
	        'created_by'    	=> $userdata['name'],
	        'created_date' 		=> $time,
	        'unique_id'			=> $this->input->post('unique_id'),
	        'emp_id' 			=> $userdata['emp_id']
	    );
  		$result = $this->Sj_health_model->add_qa($data);
    	echo json_encode($result);
	}
//jagan end
	public function completed_qa(){
		$this->load->library("pagination");
		$data["allcnt"] = count($this->Sj_health_model->completed_qa_countrows());
		$config = array();
        $config["base_url"]    = base_url() . "start_qa/completed_qa";
        $config["total_rows"]  = $data["allcnt"];
        $config["per_page"]    = 10;
        $config["uri_segment"] = 3;
	    $this->pagination->initialize($config);

	    $page    = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['sj_health']  = $this->Sj_health_model->sj_health_data_completed_qa($config["per_page"],$page);
		$data["links"]  = $this->pagination->create_links();
		$data['clientlist'] = $this->Mainmodel->getuserlist();

		$switchClient = $this->session->userdata('loggedin_client');
		if(	$switchClient == 'sjhealth'){
				$this->load->view('completed_qa',$data);
		}else{
			$filename=$switchClient.'_completed_qa';
			$this->load->view($switchClient.'/'.$filename,$data);
		}
	}

	//jagan start
public function changeQaModuleDash(){
	$client = $this->input->post('client_name');
	$this->session->unset_userdata('loggedin_client');
	$this->session->set_userdata(array("loggedin_client" => $client));
	redirect('qa_dashboard');
}
public function qa_dashboard(){
	$data['qa_viewReport'] = $this->Mainmodel->get_qa_dash();
$this->load->view('qa_dash',$data);
}
//jagan end

	public function changeQaModule(){
		$client = $this->input->post('client_name');
		$this->session->unset_userdata('loggedin_client');
		$this->session->set_userdata(array("loggedin_client" => $client));
		redirect('start_qa/qa_report');
	}

	public function qa_report(){
		$data['qa_details'] = $this->Mainmodel->get_qa_details();
		$this->load->view('qa_report', $data);
	}

	public function changeReworkModule(){
		$client = $this->input->post('client_name');
		$this->session->unset_userdata('loggedin_client');
		$this->session->set_userdata(array("loggedin_client" => $client));
		redirect('start_qa/rework_claims');
	}

	public function rework_claims(){
		$this->load->library("pagination");
		$data["allcnt"] = count($this->Sj_health_model->completed_qa_countrows());
		$config = array();
		$config["base_url"]    = base_url() . "start_qa/completed_qa";
		$config["total_rows"]  = $data["allcnt"];
		$config["per_page"]    = 10;
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$page    = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['sj_health']  = $this->Mainmodel->rework_data_completed_qa($config["per_page"],$page);
		$data["links"]  = $this->pagination->create_links();
		$data['clientlist'] = $this->Mainmodel->getuserlist();
		$switchClient = $this->session->userdata('loggedin_client');
		if($switchClient == 'sjhealth' || $switchClient == 'sandstone'){
			$this->load->view('rework_claims',$data);
		}else{
			$filename=$switchClient.'_rework';
			$this->load->view($switchClient.'/'.$filename,$data);
		}
	}
	public function reworkDetails(){
		$insert_status = $this->Mainmodel->insertReworkClaim();
		if($insert_status){
			$this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;"> QA Rework Updated successfully!..');
			redirect('start_qa/qa_report');
		}else{
			$this->session->set_flashdata('msg','<p style="color:red;margin-left:3%;margin-top:3%;">QA Rework not Updated!..');
			redirect('start_qa/rework_claims');
		}
	}
}

?>
