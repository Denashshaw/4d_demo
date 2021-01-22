<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ERROR);
class Prod_dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Mainmodel");
		$this->load->model("Report_model");
		$userdata=$this->session->all_userdata();

		if($userdata["crm_logged_in"] != TRUE){
		   //redirect('Logindetails/login_details');
		 	redirect('login/index');
		}
	}

	public function index(){
		$data['prod_details'] = $this->Report_model->getprod_details();
		$data['insurance_details'] = $this->Report_model->get_insurance_claimed();
		$data['disposition_details'] = $this->Report_model->get_disposition_details();
		$this->load->view('prod_dashboard', $data);
	}

	public function update_expctd_val(){
		return $this->Report_model->update_expctd_value();
	}

}