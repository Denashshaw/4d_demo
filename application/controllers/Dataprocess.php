<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ERROR);
class Dataprocess extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->Model("DataProductivityModle");
		$this->load->model("Mainmodel");
		$userdata=$this->session->all_userdata();
		if($userdata["crm_logged_in"] != TRUE){
			redirect('login/index');
		}
	}

	public function index()
	{
		$userdata=$this->session->all_userdata();
		if($userdata["crm_logged_in"] != TRUE ){
			redirect('login/index');
		}
		$data['dataproductvalue']=$this->DataProductivityModle->getProduc();
		$data['getuserlistdatapr']=$this->DataProductivityModle->getUSers();
		$data['clientdetails']=$this->DataProductivityModle->getClientcode();
		
		$this->load->view('data_process',$data);
	}

	public function addDataProcess(){
		$this->DataProductivityModle->addProduc($_POST);
		redirect('Dataprocess');
	}
	public function DeleteDataProdu(){
		$this->DataProductivityModle->removeProduc($_GET);
		redirect('Dataprocess');
	}
	public function getuserdetials(){
		$details = $this->DataProductivityModle->getProducSingle($_POST);
		echo json_encode($details);
	}
	public function updateDataProcess(){
		$this->DataProductivityModle->updateProduc($_POST);
		redirect('Dataprocess');
	}
}

?>
