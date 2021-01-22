<?php
 class Mainmodel extends CI_Model
 {


   public function logincheck($details){      
   $q=$this->db->query("SELECT * FROM `4d_hrms`.`users` WHERE username='".$details['username']."' and password='".md5($details['password'])."' ");  
    if($q->num_rows() == 0){
      return false;
    }

   else
   {
     $this->db->where(array('username' => $details['username'],'password'=>md5($details['password'])));
     $query  =  $this->db->get('`4d_hrms`.`users`');     
     // echo $this->db->last_query();die;
     return $query->result();
   }

 }

	  public function logindata(){
		  $userdata=$this->session->all_userdata();
		  $login =$this->db->query("SELECT * FROM users WHERE username='".$userdata['username']."' ");
  		return $login->result();
  	}



public function agentdata(){
  $userdata=$this->session->all_userdata();
  if($userdata['department']=='Data'){
    $user = $this->db->query("SELECT * FROM users WHERE role!='admin' AND department='Data' ");
    return $user->result();
  }else{


  $query = $this->db->query("SELECT * FROM client WHERE keyword = '".$userdata['loggedin_client']."' ");
  $result = $query->first_row();
  $user = $this->db->query("SELECT * FROM users WHERE role!='admin' AND FIND_IN_SET('".$result->keyword."', client) ");
  return $user->result();
  }
}


public function change_password($details){
  $userdata =$this->session->all_userdata();
  if($details['new_password']==$details['confirm_password'])
  {
    $this->db->query("UPDATE users SET password='".md5($details['confirm_password'])."' WHERE user_id='".$details['userid']."' ");
  }
  else{
    $this->session->set_flashdata('msg','<p style="color:red">Confirm Password & New Password Does Not Match!..');
      if($userdata['role'] != 'admin'){
          redirect('home/index');
        }else{
          redirect('home/agentlist');
        }
  }

  if($this->db->affected_rows() > 0){
        $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Password Updated successfully!..');
        redirect('home/agentlist');
        return TRUE;
    }
    else{
        $this->session->set_flashdata('msg','<p style="color:red;margin-left:3%;margin-top:3%;">Password not Updated!..');
        redirect('home/agentlist');
        return FALSE;
    }
}

public function reset_password($details){

  if($details['reset_new_password']==$details['reset_confirm_password'])
  {
    $this->db->query("UPDATE users SET password='".md5($details['reset_confirm_password'])."' WHERE user_id='".$details['userid']."' ");
  }
  else{
    $this->session->set_flashdata('msg','<p style="color:red">Confirm Password & New Password Does Not Match!..');
        redirect('home/agentlist');
        return FALSE;
  }

  if($this->db->affected_rows() > 0){
        $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Password Updated successfully!..');
        redirect('home/agentlist');
        return TRUE;
    }
    else{
        $this->session->set_flashdata('msg','<p style="color:red;margin-left:3%;margin-top:3%;">Password not Updated!..');
        redirect('home/agentlist');
        return FALSE;
    }
}


//jagan start
     public function agentreport($data){
       $userdata =$this->session->all_userdata();
       $table_call_entry = $userdata['loggedin_client']."_call_entry";
       $table_claims = $userdata['loggedin_client']."_claims";

       $fromdateval = new DateTime($data['fromdate']);
       $fromdate = $fromdateval->format('Y-m-d H:i:s');

       $todateval = new DateTime($data['todate']);
       $todate = $todateval->format('Y-m-d H:i:s');

       $agentid = $data['agentname'];


       $response =array();

       if($agentid != ''){

         $agentname =$this->db->query("SELECT name FROM users where emp_id='".$agentid."'")->result();
         array_push($response,array("agentname"=>$agentname[0]->name));

         $query1="SELECT count(*) as assigned FROM $table_claims where emp_id='".$agentid."' AND created_date between '$fromdate' AND '$todate'";
         $assignTotal =$this->db->query($query1)->result();
         if($assignTotal){
           $response[0]["agentvalue"]=$assignTotal[0]->assigned;
         }
         else{
             $response[0]["agentvalue"]=0;
         }

         $completed =$this->db->query("SELECT count(*) as completed FROM $table_call_entry where emp_id='".$agentid."'  and work_status!='Not Workable' and call_status='completed' and create_date between '$fromdate' AND '$todate'")->result();
         if($completed){
           $response[0]["completed"]=$completed[0]->completed;
         }else{
             $response[0]["completed"]=0;
         }

         $notwork =$this->db->query("SELECT count(*) as notwork FROM $table_call_entry where emp_id='".$agentid."'  and work_status='Not Workable' and call_status='completed' and create_date between '$fromdate' AND '$todate'")->result();
         if($notwork){
           $response[0]["notwork"]=$completed[0]->completed;
         }else{
           $response[0]["notwork"]=0;
         }

       }
       else{
         $agentname =$this->db->query("SELECT * FROM users where role='agent' AND FIND_IN_SET('".$userdata['loggedin_client']."', client)")->result();
         $k=0;
         foreach ($agentname as $a) {
           $empid=$a->emp_id;

           $response[$k]["agentname"] = $a->name;
           $query1="SELECT count(*) as assigned FROM $table_claims where emp_id='".$empid."'  AND created_date between '$fromdate' AND '$todate'";
         $assignTotal =$this->db->query($query1)->result();
         if($assignTotal){
           $response[$k]["agentvalue"]=$assignTotal[0]->assigned;
         }
         else{
             $response[$k]["agentvalue"]=0;
         }

         $completed =$this->db->query("SELECT count(*) as completed FROM $table_call_entry where emp_id='".$empid."'  and work_status!='Not Workable' and call_status='completed'")->result();
         if($completed){
           $response[$k]["completed"]=$completed[0]->completed;
         }else{
             $response[$k]["completed"]=0;
         }

         $notwork =$this->db->query("SELECT count(*) as notwork FROM $table_call_entry where emp_id='".$empid."'  and work_status='Not Workable' and call_status='completed'")->result();
         if($notwork){
           $response[$k]["notwork"]=$completed[0]->completed;
         }else{
           $response[$k]["notwork"]=0;
         }
         $k++;
         }

       }
      return $response;
    }

    public function getuserlist(){
      $user =$this->db->query("SELECT * FROM client");
      return $user->result();
    }
//jagan end
public function getAgentExport(){
  $userdata =$this->session->all_userdata();
  $dep =$userdata['department'];
  if($userdata['role'] !='admin'){
    $user =$this->db->query("SELECT * FROM users where role!='admin' and department='$dep'");
  }
  else{
    $user =$this->db->query("SELECT * FROM users where role!='admin'");
  }
 
  return $user->result();
}

public function get_qa_dash(){
  $userdata =$this->session->all_userdata();
  $table_claims = $userdata['loggedin_client']."_claims";
  $table_qa = $userdata['loggedin_client']."_qa";
  $table_call_entry = $userdata['loggedin_client']."_call_entry";

   $result = $this->db->query("Select users.emp_id,users.name,(select count(*) from $table_call_entry as b where a.emp_id=b.emp_id  ) as production,(select count(*) from $table_qa as c where a.emp_id=c.emp_id  ) as Audited,(select count(*) from $table_qa as c where c.emp_id=a.emp_id and c.error='Yes') as nooferror from $table_claims as a, (select * from users) as users WHERE a.emp_id=users.emp_id group by a.emp_id");

   return $result->result();
}

//denash shaw start
public function get_qa_details(){
  $userdata =$this->session->all_userdata();
  $table_claims = $userdata['loggedin_client']."_claims";
  $table_qa = $userdata['loggedin_client']."_qa";
  $table_call_entry = $userdata['loggedin_client']."_call_entry";

  if($userdata['role'] == 'agent'){
    $result = $this->db->query("SELECT users.name as agent_name, sc.created_date as c_date,sqa.created_date as qa_date, sc.*, sqa.* FROM $table_claims sc LEFT JOIN $table_qa sqa ON sqa.unique_id=sc.unique_id LEFT JOIN users ON users.emp_id = sc.emp_id WHERE sqa.emp_id='".$_SESSION['emp_id']."' AND sqa.error='Yes' AND sqa.qa_status = 'completed' AND sqa.err_correct_res!='' ");
    // echo $this->db->last_query();die;
    return $result->result();
    }else{
     $result = $this->db->query("SELECT users.name as agent_name,sc.created_date as c_date,sqa.created_date as qa_date, sc.*, sqa.* FROM $table_claims sc LEFT JOIN $table_qa sqa ON sqa.unique_id=sc.unique_id LEFT JOIN users ON users.emp_id = sc.emp_id WHERE sqa.error='Yes' AND sqa.qa_status = 'completed' AND sqa.err_correct_res!='' ");
      return $result->result();
    }
}

public function rework_data_completed_qa($limit=NULL,$start=NULL){
 $userdata =$this->session->all_userdata();
 $table_claims = $userdata['loggedin_client']."_claims";
   $table_call_entry = $userdata['loggedin_client']."_call_entry";
   $table_client_qa = $userdata['loggedin_client']."_qa";
   if($userdata['loggedin_client'] == '') return 0;

 $client_claims =$this->db->query("SELECT *,t2.id as qaId FROM $table_claims t1,$table_client_qa t2 WHERE t1.unique_id=t2.unique_id and t2.qa_status='completed' AND t2.error='Yes' AND err_correct_res = '' limit $start,$limit");
 return $client_claims->result();
}

public function insertReworkClaim(){
 $userdata =$this->session->all_userdata();
 $table_client_qa = $userdata['loggedin_client']."_qa";

 $qaId = $this->input->post('qaId');
 $err_correct_res = $this->input->post('err_correct_res');
 $err_correct_res_note = $this->input->post('err_correct_res_note');

 $result = $this->db->query("UPDATE $table_client_qa SET err_correct_res = '".$err_correct_res."', err_correct_res_note='".$err_correct_res_note."',emp_id= '".$_SESSION['emp_id']."' WHERE id='".$qaId."' ");
 return $result;
}

//denash shaw end

//jagan $start
public function deactAgent($from,$to,$data){
  $id=$data['id'];
    $res1 = ("INSERT INTO $to (user_id, emp_id, name, username,password,role,department,client,emp_image,status,created_on,created_by) SELECT user_id, emp_id, name, username,password,role,department,client,emp_image,status,created_on,created_by FROM $from WHERE emp_id='$id'");
    $this->db->query($res1);
    $res = $this->db->query("Delete FROM $from WHERE emp_id='$id'");
}

public function hideagentdata(){
    $res = $this->db->query("Select * from hideusers")->result();
    return $res;
}
//jagan end

}

 ?>
