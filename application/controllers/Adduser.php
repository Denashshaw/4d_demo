<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// error_reporting(E_ERROR);
class Adduser extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Mainmodel");	
		$userdata=$this->session->all_userdata();
		if($userdata["crm_logged_in"] != TRUE){ 
			redirect('login/index');
		}
	}

	public function adduser()
	{
		$userdata=$this->session->all_userdata();
		
		if($userdata["crm_logged_in"] != TRUE ){ 
			redirect('login/index');
		} 

		if(isset($_POST['fadd']))
		{
			date_default_timezone_set('Asia/Kolkata');
			$time = date('Y-m-d H:i:s');

			$details=$this->input->post();

			$check=$this->db->query("SELECT * FROM users WHERE emp_id='".$_POST['userid']."' OR username='".$_POST['username']."' ");
			
			if($check->num_rows() == 0){
				$file_name = $details['userid']."_".$_FILES['imgInp']['name'];
      			$file_size = $_FILES['imgInp']['size'];
      			$file_tmp  = $_FILES['imgInp']['tmp_name'];
      			$file_type = $_FILES['imgInp']['type'];
      			move_uploaded_file($file_tmp,"emp_images/".$file_name);
				$client_arr = $details['sandstone'];
				$client_val = implode(",", $client_arr);
				$digits = 4;
				$emp_id = rand(pow(10, $digits-1), pow(10, $digits)-1);
				$empid  = "4DG-".$emp_id;

				if($_FILES['imgInp']['name'] == ''){
					$file_name = 'default.jpg';	
				}

				$data = array(
					'user_id'   => $empid,
        			'emp_id'    => $details['userid'],
					'name'	    => $details['name'],
					'username'  => $details['username'],
					'password'  => md5($details['password']),
					'role'      => $details['role'],
					'department'=> $details['department'],
					'client'    => $client_val,
					'emp_image' => $file_name,
					'created_on'=> $time,
					'created_by'=> $userdata['name']
				);

		  		$this->db->insert('users',$data);

				$this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">User Successfully created..!</p>');
			}
			else{
				$this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">User Emp Id or Username already exist..!</p>');
			}
			redirect('home/agentlist');
		}
		
		}


	public function updateuser(){
		$userdata=$this->session->all_userdata();
		
		if ($userdata["crm_logged_in"] != TRUE ){ 
			redirect('login/index');
		} 

		if(isset($_POST['fupdate']))
		{
			date_default_timezone_set('Asia/Kolkata');
			$time = date('Y-m-d H:i:s');

			$details=$this->input->post();
			//print_r($details);
			//echo "Image:".$_FILES['profile_img']['name'];
			//$check=$this->db->query("SELECT * FROM users WHERE user_id='".$_POST['empid']."'");
			if($details['name'] != ''){
				$client_arr = $details['client'];
				$client_val = implode(",", $client_arr);
				if($_FILES['profile_img']['name']!=''){
					$file_name = $details['emp_id']."_".$_FILES['profile_img']['name'];
      				$file_size = $_FILES['profile_img']['size'];
      				$file_tmp  = $_FILES['profile_img']['tmp_name'];
      				$file_type = $_FILES['profile_img']['type'];
      				move_uploaded_file($file_tmp,"emp_images/".$file_name);
					$data = array(
						'name'	    => $details['name'],
						'username'  => $details['username'],
						'role'      => $details['role'],
						'department'=> $details['department'],
						'client'    => $client_val,
						'emp_image' => $file_name,
						'created_on'=> $time,
						'created_by'=> $userdata['name']
					);
				}
				else{
					$data = array(
						'name'	    => $details['name'],
						'username'  => $details['username'],
						'role'      => $details['role'],
						'department'=> $details['department'],
						'client'    => $client_val,
						'created_on'=> $time,
						'created_by'=> $userdata['name']
					);
				}
				$this->db->where('user_id',$details['userid']);
		  		$this->db->update('users',$data);

				$this->session->set_flashdata('msg', '<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">User Successfully Updated..!</p>');
			}

			else{
				$this->session->set_flashdata('msg', '<p style="color:red">Update Failed</p>');
			}
			redirect('home/agentlist');
		}
	}
	
	public function deleteuser(){	
		$id=$this->uri->segment(3);
		if($id !=""){
			$this->db->where('id',$id);
			$this->db->delete('users');
			$this->session->set_flashdata('msg', '<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">User Deleted Successfully..! </p>');
			redirect('home/agentlist');
		}
	}

	public function chpass(){
		if(isset($_POST['password'])){
			$details=$this->input->post();
			$data["pass"]=$this->Mainmodel->change_password($details);
			// $this->load->view('agentlist',$data);	
		}
		// $this->load->view('agentlist');
	}


	public function reset_password(){
		if(isset($_POST['reset_password'])){
			$details=$this->input->post();
			$data["pass"]=$this->Mainmodel->reset_password($details);
			$this->load->view('agentlist',$data);	
		}
	}

	public function Deactivateagent(){
		$data=$this->Mainmodel->deactAgent('users','hideusers',$_POST);
		echo json_encode([$res=>'1']);
	}

	public function Activateagent(){
		$data=$this->Mainmodel->deactAgent('hideusers','users',$_POST);
		echo json_encode([$res=>'1']);
	}

	
}

?>