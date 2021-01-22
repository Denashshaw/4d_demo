<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Capa_controller extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('Capa_model');
			$userdata=$this->session->all_userdata();
			if($userdata["crm_logged_in"] != TRUE){
				redirect('login/index');
			}
		}

		public function index()
		{
			// $data['capa_data'] = $this->Capa_model->get_capa_data();			
			$this->load->view('capa_dashboard');
		}

		public function CapaInsertPage()
		{
			$this->load->view('CapaInsertPage');
		}

		public function capa_ajax_data()
		{
			$data = $row = array();
        	// Fetch member's records
        	$memData = $this->Capa_model->getRows($_POST);

			 $i = $_POST['start'];
	        foreach($memData as $r){
	            $i++;

			/*$query = $this->db->get("capa");
			$data = [];
			foreach($query->result() as $r) {*/
				$data[] = array(
					$r->id,
					$r->client_name,
					$r->feedback_received_date,
					$r->facility,
					$r->issue,
					$r->parameter,
					$r->error_type,
					$r->criticality,
					$r->frequency,
					$r->claim_id,
					$r->production_date,
					$r->agent_name,
					$r->agent_comments,
					$r->auditor_name,
					$r->auditor_comments,
					$r->corrective_action,
					$r->preventive_action,
					$r->source,
					$r->agent_ra,
					$r->auditor_ra,
					$r->comments,
					$r->date_created,			
					$r->date_updated		
				);
			}

			 $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Capa_model->countAll(),
            "recordsFiltered" => $this->Capa_model->countFiltered($_POST),
            "data" => $data,
        );
        
        // Output to JSON format		
        echo json_encode($output);
		}

		public function insert_capa_data()
		{
			$insert_status = $this->Capa_model->insert_capa_data();
			if($insert_status){
				$this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Data Submitted Successfully ..!</p>');
			}else{
				$this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Failed to Submit ..!</p>');
			}
			redirect('Capa_controller/index');
		}

		public function get_prod_data()
		{				
			$data = $this->Capa_model->get_prod_data();
			echo json_encode($data);
		}

		public function get_agent_manager()
		{
			$data = $this->Capa_model->get_agent_manager();
			echo json_encode($data);
		}
	}
?>