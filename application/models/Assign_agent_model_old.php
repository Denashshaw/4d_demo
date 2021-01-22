<?php
 class Assign_agent_model extends CI_Model
 {

 	public function upexceldata($data,$client){
	 	$uid = uniqid();

	 	date_default_timezone_set('Asia/Kolkata');
        $time = date('Y-m-d H:i:s');


        if($client=='sjhealth'){
       	
       	if($data[6]  !="") { $dos_start = date("Y-m-d", strtotime($data[6]));}
       	if($data[7]  !="") { $dos_end   = date("Y-m-d", strtotime($data[7]));}
       	if($data[9]  !="") { $follow_up = date("Y-m-d", strtotime($data[9]));}
       	if($data[10] !="") { $last_action_date = date("Y-m-d", strtotime($data[10]));}

			if($data[2] != ''){
				$query_res = $this->db->query("SELECT * FROM sjhealth_claims WHERE claim_id='".$data[2]."' ");
				$count = $query_res->result();
					if(count($count) < 1) {
					$excel_data = array(
						'insurance' 	    => $data[0],
						'facility'		    => $data[1],
						'claim_id'  	    => $data[2],
						'patient'   	    => $data[3],
						'status' 		    => $data[4],
						'service'   	    => $data[5],
						'dos_start' 	    => $dos_start,
						'dos_end'   	    => $dos_end,
						'charges'   	    => $data[8],
						'follow_up' 	    => $follow_up,
						'last_action_date' 	=> $last_action_date,
						'days_outstanding' 	=> $data[11],
						'queue'            	=> $data[12],
						'assigned_to_client'=> $data[13],
						'emp_name' 			=> $data[14],
						'emp_id'    	 	=> trim($data[15]),
						'unique_id'	 		=> $uid,
						'created_date'	 	=> $time
					);
					$this->db->insert('sjhealth_claims',$excel_data);
				}else{
					$update_data = array(
						'insurance' 	    => $data[0],
						'facility'		    => $data[1],
						'claim_id'  	    => $data[2],
						'patient'   	    => $data[3],
						'status' 		    => $data[4],
						'service'   	    => $data[5],
						'dos_start' 	    => $dos_start,
						'dos_end'   	    => $dos_end,
						'charges'   	    => $data[8],
						'follow_up' 	    => $follow_up,
						'last_action_date' 	=> $last_action_date,
						'days_outstanding' 	=> $data[11],
						'queue'            	=> $data[12],
						'assigned_to_client'=> $data[13],
			            'emp_name' 			=> $data[14],
			            'emp_id'    	 	=> trim($data[15]),
          				);
					$this->db->where('claim_id', $data[2]);
					$this->db->update('sjhealth_claims',$update_data);
				}
			}
		}

		else if($client=='medisys'){

       	    if($data[5] != ''){
				$query_res = $this->db->query("SELECT * FROM medisys_claims WHERE claim_id='".$data[5]."' ");
				$count = $query_res->result();

				if(count($count) < 1) {
					 $excel_data = array(
		         	  'practice'                => $data[0],
		         	  'insurance'		    	=> $data[1],
		         	  'patient'					=> $data[2],
		         	  'chart_id'   	    		=> $data[3],
		         	  'policy' 		    		=> $data[4],
		         	  'claim_id'   	        	=> $data[5],
		         	  'dos'               		=> $data[6],
		         	  'procedure'              	=> $data[7],
		         	  'charge_amount'   	    => $data[8],
		         	  'ar_comments' 	        => $data[9],
		         	  'dispo' 	        		=> $data[10],
		         	  'date_worked' 	        => date("Y-m-d", strtotime($data[11])),
		         	  'emp_id'    				=> $data[12],
		         	  'unique_id' 				=> $uid,
		         	  'created_date'        	=> $time
		            );

					$this->db->insert('medisys_claims',$excel_data);
				}else{
					$update_data = array(
				  	  'practice'                => $data[0],
		         	  'insurance'		    	=> $data[1],
		         	  'patient'					=> $data[2],
		         	  'chart_id'   	    		=> $data[3],
		         	  'policy' 		    		=> $data[4],
		         	  'claim_id'   	        	=> $data[5],
		         	  'dos'               		=> $data[6],
		         	  'procedure'              	=> $data[7],
		         	  'charge_amount'   	    => $data[8],
		         	  'ar_comments' 	        => $data[9],
		         	  'dispo' 	        		=> $data[10],
		         	  'date_worked' 	        => date("Y-m-d", strtotime($data[11])),
		         	  'emp_id'    				=> $data[12],
	         		);
					$this->db->where('claim_id', $data[5]);
					$this->db->update('medisys_claims',$update_data);
				}
			}
		}

		else if($client == 'allinwon'){
			if($data[0] != ''){
				$query_res = $this->db->query("SELECT * FROM allinwon_claims WHERE claim_id='".$data[0]."' ");
				$count = $query_res->result();
					if(count($count) < 1) {
					$excel_data = array(
						'claim_id' 	    	=> $data[0],
						'patient'		    => $data[1],
						'charge_code'  	    => $data[2],
						'charge_amount'   	=> $data[3],
						'date' 		    	=> date("Y-m-d", strtotime($data[4])),
						'date_filed'   	    => date("Y-m-d", strtotime($data[5])),
						'insurance' 	    => $data[6],
						'date_paid'   	    => date("Y-m-d", strtotime($data[7])),
						'allowed'   	    => $data[8],
						'deductible' 	    => $data[9],
						'coins' 			=> $data[10],
						'adjusted' 			=> $data[11],
						'paid'            	=> $data[12],
						'other_payment'		=> $data[13],
						'quantity' 			=> $data[14],
						'amount_due'    	=> $data[15],
						'provider'	 		=> $data[16],
						'location'	 		=> $data[17],
						'ar_comments'    	=> $data[18],
						'status_code'	 	=> $data[19],
						'date_worked'	 	=> $data[20],
						'emp_id'	 		=> $data[21],
						'unique_id'	 		=> $uid,
					);
					$this->db->insert('allinwon_claims',$excel_data);
				}else{
					$update_data = array(
						'claim_id' 	    	=> $data[0],
						'patient'		    => $data[1],
						'charge_code'  	    => $data[2],
						'charge_amount'   	=> $data[3],
						'date' 		    	=> date("Y-m-d", strtotime($data[4])),
						'date_filed'   	    => date("Y-m-d", strtotime($data[5])),
						'insurance' 	    => $data[6],
						'date_paid'   	    => date("Y-m-d", strtotime($data[7])),
						'allowed'   	    => $data[8],
						'deductible' 	    => $data[9],
						'coins' 			=> $data[10],
						'adjusted' 			=> $data[11],
						'paid'            	=> $data[12],
						'other_payment'		=> $data[13],
						'quantity' 			=> $data[14],
						'amount_due'    	=> $data[15],
						'provider'	 		=> $data[16],
						'location'	 		=> $data[17],
						'ar_comments'    	=> $data[18],
						'status_code'	 	=> $data[19],
						'date_worked'	 	=> $data[20],
						'emp_id'	 		=> $data[21]
          );
					$this->db->where('claim_id', $data[0]);
					$this->db->update('allinwon_claims',$update_data);
				}
			}
        }


        else if($client == 'clarin'){
			if($data[2] != ''){
				$query_res = $this->db->query("SELECT * FROM clarin_claims WHERE claim_id='".$data[2]."' ");
				$count = $query_res->result();
					if(count($count) < 1) {
					$excel_data = array(
						'practice'  	    => $data[0],
						'visits' 	    	=> $data[1],
						'claim_id'   		=> $data[2],
						'patient' 			=> $data[3],
						'dob'   	    	=> date("Y-m-d", strtotime($data[4])),
						'patient_id' 	    => $data[5],
						'carrier_name'   	=> $data[6],
						'provider_name'   	=> $data[7],
						'cpt' 	    		=> $data[8],
						'dos' 				=> date("Y-m-d", strtotime($data[9])),
						'charge_amount' 	=> $data[10],
						'ar_comments'       => $data[11],
						'dispo'				=> $data[12],
						'date_worked' 		=> $data[13],
						'emp_id'    		=> $data[14],
						'unique_id'	 		=> $uid,					
					);
					$this->db->insert('clarin_claims',$excel_data);
				}else{
					$update_data = array(
						'practice'  	    => $data[0],
						'visits' 	    	=> $data[1],
						'claim_id'   		=> $data[2],
						'patient' 			=> $data[3],
						'dob'   	    	=> date("Y-m-d", strtotime($data[4])),
						'patient_id' 	    => $data[5],
						'carrier_name'   	=> $data[6],
						'provider_name'   	=> $data[7],
						'cpt' 	    		=> $data[8],
						'dos' 				=> date("Y-m-d", strtotime($data[9])),
						'charge_amount' 	=> $data[10],
						'ar_comments'       => $data[11],
						'dispo'				=> $data[12],
						'date_worked' 		=> $data[13],
						'emp_id'    		=> $data[14],
          );
					$this->db->where('claim_id', $data[2]);
					$this->db->update('clarin_claims',$update_data);
				}
			}
        }

        else if($client == 'sandstone'){
			if($data[2] != ''){
				$query_res = $this->db->query("SELECT * FROM sandstone_claims WHERE claim_id='".$data[2]."' ");
				$count = $query_res->result();
					if(count($count) < 1) {
					$excel_data = array(
						'insurance' 	    => $data[0],
						'facility'		    => $data[1],
						'claim_id'  	    => $data[2],
						'patient'   	    => $data[3],
						'status' 		    => $data[4],
						'service'   	    => $data[5],
						'dos_start' 	    => $dos_start,
						'dos_end'   	    => $dos_end,
						'charges'   	    => $data[8],
						'follow_up' 	    => $follow_up,
						'last_action_date' 	=> $last_action_date,
						'days_outstanding' 	=> $data[11],
						'queue'            	=> $data[12],
						'assigned_to_client'=> $data[13],
						'emp_name' 			=> $data[14],
						'emp_id'    	 	=> trim($data[15]),
						'unique_id'	 		=> $uid,
						'created_date'	 	=> $time
					);
					$this->db->insert('sandstone_claims',$excel_data);
				}else{
					$update_data = array(
						'insurance' 	    => $data[0],
						'facility'		    => $data[1],
						'claim_id'  	    => $data[2],
						'patient'   	    => $data[3],
						'status' 		    => $data[4],
						'service'   	    => $data[5],
						'dos_start' 	    => $dos_start,
						'dos_end'   	    => $dos_end,
						'charges'   	    => $data[8],
						'follow_up' 	    => $follow_up,
						'last_action_date' 	=> $last_action_date,
						'days_outstanding' 	=> $data[11],
						'queue'            	=> $data[12],
						'assigned_to_client'=> $data[13],
			            'emp_name' 			=> $data[14],
			            'emp_id'    	 	=> trim($data[15])
          );
					$this->db->where('claim_id', $data[2]);
					$this->db->update('sandstone_claims',$update_data);
				}
			}
        }


        else if($client=='lightningsteps'){

			if($data[20]  !="") { $date_paid            = date("Y-m-d", strtotime($data[20]));}
       	    if($data[21]  !="") { $last_followup_date   = date("Y-m-d", strtotime($data[21]));}

       	    if($data[2] != ''){
				$query_res = $this->db->query("SELECT * FROM lightningsteps_claims WHERE claim_id='".$data[2]."' ");
				$count = $query_res->result();

				if(count($count) < 1) {

				$excel_data = array(
		        	'unique_id'			  => $uid,
					'claims_bucket'		  => $data[0],
					'date_range'		  => $data[1],
					'claim_id'            => $data[2],
					'patient'  	  		  => $data[3],
					'service'  			  => $data[4],
					'location'	   		  => $data[5],
					'payor' 	   		  => $data[6],
					'billed' 	   		  => $data[7],
					'payment' 			  => $data[8],
					'adjustment'	      => $data[9],
		        	'writeoff'			  => $data[10],
					'balance'			  => $data[11],
					'expected_revenue'	  => $data[12],
					'expected_collection' => $data[13],
					'status'  			  => $data[14],
					'allowed_amount'  	  => $data[15],
					'deductible'	   	  => $data[16],
					'co_insurance' 	   	  => $data[17],
					'copay' 	   		  => $data[18],
					'amount_paid' 		  => $data[19],
					'date_paid'	    	  => $date_paid,
		        	'last_follow_up_date' => $last_followup_date,
					'claim_notes'		  => $data[22],
					'claim_numbers'		  => $data[23],
					'check_numbers'       => $data[24],
					'eft_number'  		  => $data[25],
		        	'emp_id'			  => $data[26],
		        	'created_date'        => $time
				);

				$this->db->insert('lightningsteps_claims',$excel_data);
				}else{
					$update_data = array(
					'claims_bucket'		  => $data[0],
					'date_range'		  => $data[1],
					'claim_id'            => $data[2],
					'patient'  	  => $data[3],
					'service'  			  => $data[4],
					'location'	   		  => $data[5],
					'payor' 	   		  => $data[6],
					'billed' 	   		  => $data[7],
					'payment' 			  => $data[8],
					'adjustment'	      => $data[9],
		        	'writeoff'			  => $data[10],
					'balance'			  => $data[11],
					'expected_revenue'	  => $data[12],
					'expected_collection' => $data[13],
					'status'  			  => $data[14],
					'allowed_amount'  	  => $data[15],
					'deductible'	   	  => $data[16],
					'co_insurance' 	   	  => $data[17],
					'copay' 	   		  => $data[18],
					'amount_paid' 		  => $data[19],
					'date_paid'	    	  => $date_paid,
		        	'last_follow_up_date' => $last_followup_date,
					'claim_numbers'		  => $data[23],
					'check_numbers'       => $data[24],
					'eft_number'  		  => $data[25],
          			'emp_id'			  => $data[26]
        		);
					$this->db->where('claim_id', $data[2]);
					$this->db->update('lightningsteps_claims',$update_data);
				}
			}
		}

		else if($client=='ava'){

			if($data[2] != ''){
				$query_res = $this->db->query("SELECT * FROM lightningsteps_claims WHERE claim_id='".$data[2]."' ");
				$count = $query_res->result();

				if(count($count) < 1) {

	      	    $excel_data = array(
	         	  'Tags'                => $data[0],
	         	  'Date_Range'		    => $data[1],
	         	  'claim_id'			=> $data[2],
	         	  'patient'   	    	=> $data[3],
	         	  'Service' 		    => $data[4],
	         	  'Location'   	        => $data[5],
	         	  'Payor'               => $data[6],
	         	  'Billed'              => $data[7],
	         	  'Payment'   	        => $data[8],
	         	  'Adjustment' 	        => $data[9],
	         	  'Writeoff' 	        => $data[10],
	         	  'Balance' 	        => $data[11],
	         	  'Expected_Revenue'   	=> $data[12],
	         	  'Expected_Collection' => $data[13],
	         	  'Internal_Status' 	=> Null,
	         	  'Status'    	 	    => $data[14],
	         	  'Allowed_Amount'	 	=> $data[15],
	         	  'Deductible'	 	 	=> $data[16],
	         	  'CoInsurance'	 	 	=> $data[17],
	         	  'Copay'	 		 	=> $data[18],
	         	  'Amount_Paid'	 	 	=> $data[19],
	         	  'Date_Paid' 			=> date("Y-m-d", strtotime($data[20])),
	         	  'Last_Follow_up_Date' => date("Y-m-d", strtotime($data[21])),
	         	  'Claim_Notes'	 		=> $data[22],
	         	  'Claim_Numbers'	    => $data[23],
	         	  'Check_Numbers'	 	=> $data[24],
	         	  'EFT_Number'	 		=> $data[25],
	         	  'Worked_by'	 		=> null,
	         	  'created_date' 	    => $time,
	         	  // 'emp_name'            => $data[26],
	         	  'emp_id'    			=> $data[27],
	         	  'unique_id' 			=> $uid
	            );

	            $this->db->insert('ava_claims',$excel_data);
		        }else{
		        	$update_data = array(
				      'Tags'       => $data[0],
	         	  'Date_Range'		    => $data[1],
	         	  'claim_id'			=> $data[2],
	         	  'patient'   	    	=> $data[3],
	         	  'Service' 		    => $data[4],
	         	  'Location'   	        => $data[5],
	         	  'Payor'               => $data[6],
	         	  'Billed'              => $data[7],
	         	  'Payment'   	        => $data[8],
	         	  'Adjustment' 	        => $data[9],
	         	  'Writeoff' 	        => $data[10],
	         	  'Balance' 	        => $data[11],
	         	  'Expected_Revenue'   	=> $data[12],
	         	  'Expected_Collection' => $data[13],
	         	  'Internal_Status' 	=> Null,
	         	  'Status'    	 	    => $data[14],
	         	  'Allowed_Amount'	 	=> $data[15],
	         	  'Deductible'	 	 	=> $data[16],
	         	  'CoInsurance'	 	 	=> $data[17],
	         	  'Copay'	 		 	=> $data[18],
	         	  'Amount_Paid'	 	 	=> $data[19],
	         	  'Date_Paid' 			=> date("Y-m-d", strtotime($data[20])),
	         	  'Last_Follow_up_Date' => date("Y-m-d", strtotime($data[21])),
	         	  'Claim_Numbers'	    => $data[23],
	         	  'Check_Numbers'	 	=> $data[24],
	         	  'EFT_Number'	 		=> $data[25],
	         	  'Worked_by'	 		=> null,

	         	  // 'emp_name'       => $data[26],
	         	  'emp_id'    		=> $data[27],
	         	  'unique_id' 		=> $uid);
		        	$this->db->where('claim_id', $data[2]);
					$this->db->update('ava_claims',$update_data);
		        }
		    }
        }

        else if($client=='elevatedbilling'){
        	if($data[1] != ''){
				$query_res = $this->db->query("SELECT * FROM elevatedbilling_claims WHERE claim_id='".$data[1]."' ");
				$count = $query_res->result();
				if(count($count) < 1) {

				if($data[5]  !="") { $dos_from 		= date("Y-m-d", strtotime($data[5]));}
				if($data[6]  !="") { $dos_to   		= date("Y-m-d", strtotime($data[6]));}
				if($data[7]  !="") { $sent     		= date("Y-m-d", strtotime($data[7]));}
				if($data[8]  !="") { $fu_date  		= date("Y-m-d", strtotime($data[8]));}
				if($data[12] !="") { $worked_date   = date("Y-m-d", strtotime($data[12]));}else{ $worked_date=''; }
				if($data[23] !="") { $date_paid     = date("Y-m-d", strtotime($data[23]));}else{ $date_paid=''; }
				if($data[24] !="") { $cashed_date   = date("Y-m-d", strtotime($data[24]));}else{ $cashed_date=''; }

            	$excel_data = array(
                'system'        => $data[0],
                'claim_id'      => $data[1],
                'ins'           => $data[2],
                'patient'       => $data[3],
                'charge'        => $data[4],
                'dos_from'      => $dos_from,
                'dos_to'        => $dos_to,
                'sent'          => $sent,
                'fu_date'       => $fu_date,
                'level_of_care' => $data[9],
                'status'        => $data[10],
                'facility'      => $data[11],
                'worked_date'   => $worked_date,
                'worked_rep'    => $data[13],
                'notes'         => $data[14],
                'completed'     => $data[15],
                'claim'         => $data[16],
                'allowed'       => $data[17],
                'paid'          => $data[18],
                'interest'      => $data[19],
                'coinsurance'   => $data[20],
                'copay'         => $data[21],
                'deductible'    => $data[22],
                'date_paid'     => $date_paid,
                'cashed_date'   => $cashed_date,
                'payer'         => $data[25],
                'method'        => $data[25],
                'payment'       => $data[26],
                'bulk_amount'   => $data[27],
                'unique_id'     => $uid,
                'emp_id'        => '',
                'created_date'  => $time
            	);

             	$this->db->insert('elevatedbilling_claims',$excel_data);
				}else{
				$update_data = array(
				'system'        => $data[0],
                'claim_id'      => $data[1],
                'ins'           => $data[2],
                'patient'       => $data[3],
                'charge'        => $data[4],
                'dos_from'      => $dos_from,
                'dos_to'        => $dos_to,
                'sent'          => $sent,
                'fu_date'       => $fu_date,
                'level_of_care' => $data[9],
                'status'        => $data[10],
                'facility'      => $data[11],
                'worked_date'   => $worked_date,
                'worked_rep'    => $data[13],
                'completed'     => $data[15],
                'claim'         => $data[16],
                'allowed'       => $data[17],
                'paid'          => $data[18],
                'interest'      => $data[19],
                'coinsurance'   => $data[20],
                'copay'         => $data[21],
                'deductible'    => $data[22],
                'date_paid'     => $date_paid,
                'cashed_date'   => $cashed_date,
                'payer'         => $data[25],
                'method'        => $data[25],
                'payment'       => $data[26],
                'bulk_amount'   => $data[27]);
					$this->db->where('claim_id', $data[2]);
					$this->db->update('elevatedbilling_claims',$update_data);
				}
			}
		}else{
			echo 'No Clients Found';
		}

    }

 }

?>
