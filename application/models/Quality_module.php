<?php
 class quality_module extends CI_Model
 {
  	public function agentlist(){
      $userdata=$this->session->all_userdata();
      $usercate = $userdata['loggedin_client'];
	   	$dep = $this->db->query("SELECT * FROM users where role!='admin'and role='agent' and client like '%".$usercate."%'");
		  return $dep->result();
	 }

   public function get_qa_dash($data){
      $userdata =$this->session->all_userdata();
      $table_claims = $userdata['loggedin_client']."_claims";
      $table_qa = $userdata['loggedin_client']."_qa";
      $table_call_entry = $userdata['loggedin_client']."_call_entry";

      $fromDate=$data['fromDate'];
      $toDate=$data['toDate'];
      $emp=$data['agent'];

      //Select a.emp_id,a.emp_name,(select count(*) from sjhealth_call_entry as b where a.emp_id=b.emp_id  ) as production,(select count(*) from sjhealth_qa as c where a.emp_id=c.emp_id  ) as Audited,(select count(*) from sjhealth_qa as c where c.emp_id=a.emp_id and c.error='Yes') as nooferror,(select count(*) from sjhealth_qa as c where c.emp_id=a.emp_id and c.error='Yes' and c.error_source='Internal Error') as internalerror,(select count(*) from sjhealth_qa as c where c.emp_id=a.emp_id and c.error='Yes' and c.error_source='External Error') as externalerror from sjhealth_claims as a  where a.emp_id!='' group by a.emp_id

      if($emp == 'all'){
         $query="Select a.emp_id,(select d.name from users d where  a.emp_id=d.emp_id) as emp_name,(select count(*) from $table_call_entry as b where a.emp_id=b.emp_id  ) as production,(select count(*) from $table_qa as c where a.emp_id=c.emp_id  ) as Audited,(select count(*) from $table_qa as c where c.emp_id=a.emp_id and c.error='Yes') as nooferror ,(select count(*) from $table_qa as c where c.emp_id=a.emp_id and c.error='Yes' and c.error_source='Internal Error') as internalerror,(select count(*) from $table_qa as c where c.emp_id=a.emp_id and c.error='Yes' and c.error_source='External Error') as externalerror from $table_claims as a  where a.emp_id!='' and a.created_date BETWEEN '$fromDate' AND '$toDate' group by a.emp_id ";
 
      }else{
        $query="Select a.emp_id,(select d.name from users d where  a.emp_id=d.emp_id) as emp_name,(select count(*) from $table_call_entry as b where a.emp_id=b.emp_id  ) as production,(select count(*) from $table_qa as c where a.emp_id=c.emp_id  ) as Audited,(select count(*) from $table_qa as c where c.emp_id=a.emp_id and c.error='Yes') as nooferror ,(select count(*) from $table_qa as c where c.emp_id=a.emp_id and c.error='Yes' and c.error_source='Internal Error') as internalerror,(select count(*) from $table_qa as c where c.emp_id=a.emp_id and c.error='Yes' and c.error_source='External Error') as externalerror from $table_claims as a  where a.emp_id='$emp' and a.created_date BETWEEN '$fromDate' AND '$toDate' group by a.emp_id ";

      }
       $result = $this->db->query($query);
      
       return $result->result();
    }

  
 }
 ?>
