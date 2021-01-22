<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ERROR);
class Login_client extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Mainmodel");
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
		$this->load->view('client_login',$data);
	}

}

?>