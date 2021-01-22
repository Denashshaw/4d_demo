<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ERROR);
class qualitydash extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("quality_module");
		$this->load->model("Mainmodel");
		$userdata=$this->session->all_userdata();

		if($userdata["crm_logged_in"] != TRUE){
		   //redirect('Logindetails/login_details');
		 	redirect('login/index');
		}
	}

	//jagan start
	public function changeQaModuleDash(){
		$client = $this->input->post('client_name');
		$this->session->unset_userdata('loggedin_client');
		$this->session->set_userdata(array("loggedin_client" => $client));
		redirect('quality_dashboard');
	}
	public function quality_dashboard(){
		date_default_timezone_set("Asia/Kolkata");
		$data['dataset'] = array(
			"fromDate" => date('Y-m-01 00:00'),
			"toDate" => date('Y-m-d H:i'),
			"agent" => 'all'
		);
		$data['agentlist'] = $this->quality_module->agentlist();
		$data['qa_viewReport'] = $this->quality_module->get_qa_dash($data['dataset']);
	//print_r($data['qa_viewReport']);
		$this->load->view('qualitydashview',$data);
	}

	public function getReport(){
		$data['dataset'] = array(
			"fromDate" => $_POST['fromdate'],
			"toDate" => $_POST['todate'],
			"agent" => $_POST['agentname']
		);
		$data['agentlist'] = $this->quality_module->agentlist();
		$data['qa_viewReport'] = $this->quality_module->get_qa_dash($data['dataset']);
		$this->load->view('qualitydashview',$data);

	}
	//jagan end
}

?>
