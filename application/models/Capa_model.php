<?php 
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	 * This model is for CAPA
	 */


	class Capa_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->table = 'capa';
        // Set orderable column fields
        $this->column_order = array('id', 'client_name','feedback_received_date','facility','issue','parameter','error_type','criticality', 'frequency', 'claim_id', 'production_date', 'agent_name', 'agent_comments', 'auditor_name', 'auditor_comments', 'corrective_action', 'preventive_action', 'source', 'agent_ra', 'auditor_ra', 'date_created', 'date_updated');
        // Set searchable column fields
        $this->column_search = array('id','client_name','feedback_received_date','facility','issue','parameter','error_type','criticality', 'frequency', 'claim_id', 'production_date', 'agent_name', 'agent_comments', 'auditor_name', 'auditor_comments', 'corrective_action', 'preventive_action', 'source', 'agent_ra', 'auditor_ra', 'date_created', 'date_updated');
        // Set default order
        $this->order = array('id' => 'asc');
	}

	public function getRows($postData){
        $this->_get_datatables_query($postData);        
        if(isset($postData['client_name'])){
    		if(count($postData['client_name']) > 1){
    			// print_r($postData['client_name']);die;
    			$where= [];
    			foreach ($postData['client_name'] as $key => $value) {
    				$where[] = $value;
    				$this->db->or_where('client_name', $value);
    			}
    		}else{
    			$this->db->where('client_name', $postData['client_name'][0]);        		
    		}
        }

        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        return $query->result();
    }
    
    /*
     * Count all records
     */
    public function countAll(){
        $this->db->from($this->table);
        if(isset($postData['client_name'])){
    		if(count($postData['client_name']) > 1){
    			// print_r($postData['client_name']);die;
    			$where= [];
    			foreach ($postData['client_name'] as $key => $value) {
    				$where[] = $value;
    				$this->db->or_where('client_name', $value);
    			}
    		}else{
    			$this->db->where('client_name', $postData['client_name'][0]);        		
    		}
        }

        return $this->db->count_all_results();
    }
    
    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */
    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        if(isset($postData['client_name'])){
    		if(count($postData['client_name']) > 1){
    			// print_r($postData['client_name']);die;
    			$where= [];
    			foreach ($postData['client_name'] as $key => $value) {
    				$where[] = $value;
    				$this->db->or_where('client_name', $value);
    			}
    		}else{
    			$this->db->where('client_name', $postData['client_name'][0]);        		
    		}
        }
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    /*
     * Perform the SQL queries needed for an server-side processing requested
     * @param $_POST filter data based on the posted parameters
     */
    private function _get_datatables_query($postData){
         
        $this->db->from($this->table);
 
        $i = 0;
        // loop searchable columns         
        foreach($this->column_search as $item){
            // if datatable send POST for search
            if($postData['search']['value']){
                // first loop
                if($i===0){
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                }else{
                    $this->db->or_like($item, $postData['search']['value']);
                }
                
                // last loop
                if(count($this->column_search) - 1 == $i){
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }
         
        if(isset($postData['order'])){
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

		/*public function get_capa_data()
		{
			return $this->db->query("SELECT * FROM capa")->result_array();
		}*/

		public function insert_capa_data()
		{
			$client_name = $this->input->post('client_name');
			$feedback_received_date = $this->input->post('feedback_received_date');
			$facility = $this->input->post('facility');
			$issue = $this->input->post('issue');
			$parameter = $this->input->post('parameter');
			$error_type = $this->input->post('error_type');
			$criticality = $this->input->post('criticality');
			$frequency = $this->input->post('frequency');
			$production_date = $this->input->post('production_date');
			$agent_name = $this->input->post('agent_name');
			$agent_comments = $this->input->post('agent_comments');
			$auditor_name = $this->input->post('auditor_name');
			$auditor_comments = $this->input->post('auditor_comments');
			$corrective_action = $this->input->post('corrective_action');
			$preventive_action = $this->input->post('preventive_action');
			$source = $this->input->post('source');
			$agent_ra = $this->input->post('agent_ra');
			$auditor_ra = $this->input->post('auditor_ra');
			$date_created = $this->input->post('date_created');

			$insert_data = array(
				'client_name' => $client_name,
				'feedback_received_date' => $feedback_received_date,
				'facility' => $facility,
				'issue' => $issue,
				'parameter' => $parameter,
				'error_type' => $error_type,
				'criticality' => $criticality,
				'frequency' => $frequency,
				'production_date' => $production_date,
				'agent_name' => $agent_name,
				'agent_comments' => $agent_comments,
				'auditor_name' => $auditor_name,
				'auditor_comments' => $auditor_comments,
				'corrective_action' => $corrective_action,
				'preventive_action' => $preventive_action,
				'source' => $source,
				'agent_ra' => $agent_ra,
				'auditor_ra' => $auditor_ra,
				'date_created' => date('Y-m-d H:i:s')
				);

			$this->db->insert('capa', $insert_data);		
			return $this->db->insert_id();
		}

		public function get_prod_data() {
			$claim_id = $this->input->post('claim_id');
			$client_name = $this->input->post('client_name');
			$production_date = $this->input->post('production_date');
			$unique_id = $this->db->query("SELECT unique_id FROM ".$client_name."_claims WHERE claim_id='".$claim_id."' ")->first_row();
			if($unique_id){
			$unique_id = $unique_id->unique_id;
				return $this->db->query("SELECT sce.notes as agent_comments, sce.emp_id, sce.created_by as agent_name,DATE(sce.create_date) as create_date, sqa.qa_notes,sqa.emp_id  as qa_id,sqa.created_by as auditor_name FROM ".$client_name."_call_entry sce LEFT JOIN sjhealth_qa sqa ON sce.unique_id = sqa.unique_id WHERE sce.unique_id='".$unique_id."' AND sce.create_date LIKE '{$production_date}%' ")->row();
				// echo $this->db->last_query();die;
			}else{
				return null;
			}
		}

		public function get_agent_manager()
		{
			$client_name = $this->input->post('client');
			return $this->db->query("SELECT emp_id, name FROM 4d_hrms.users WHERE (role='supervisor' AND department='MANAGEMENT') AND FIND_IN_SET('".$client_name."',client) ")->result_array();			
		}
	}
?>