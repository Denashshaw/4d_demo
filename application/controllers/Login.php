<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ERROR);
class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Mainmodel");
	}

	public function index()
	{
        $details=$this->input->post();
        $oriCaptcha = $this->input->post('oriCaptcha');
		$captcha = $this->input->post('captcha');
		//print_r($details);
	  if($oriCaptcha == $captcha){
		if(isset($_POST['login'])) {
			$result=$this->Mainmodel->logincheck($details);
			if($result == false)
			{
				$login["errors"]="<p style='color:red'>Username or password is wrong</p>";
				$this->load->view('login',$login);
			}
			else
			{
				$client = $this->db->query("SELECT keyword FROM client")->result_array();    
			    $count = count($client);
			    foreach ($client as $i => $value) {
			      $test .= $value['keyword'];
			      
			      if($i < ($count - 1)){
			        $test .= ',';
			      }
			    }

			  $res = $this->db->query("SELECT FIND_IN_SET('".$result[0]->client."' , '".$test."')  as res")->row();			  
			  $client_exists = $res->res;
			  
			  if($client_exists){
				$userdata = array(
					'userid'	=> $result[0]->id,
					'emp_id'    => $result[0]->emp_id,
					'user_id'	=> $result[0]->user_id,
					'department'=> $result[0]->department,
                   	'username'  => $result[0]->username,
                   	'name'      => $result[0]->name,
				   	'role' 		=> $result[0]->role,
				   	'client'    => $result[0]->client,
				   	'emp_image' => $result[0]->emp_image,
                   	'crm_logged_in' => TRUE
               );

				$this->db->query("UPDATE users SET status='loggedin' WHERE user_id='".$userdata['user_id']."' ");

				if($result[0]->role=='agent' || $result[0]->role=='supervisor' || $result[0]->role=='manager'){
					$this->session->set_userdata($userdata);
					redirect('login_client/index');
				}
				else{
					// $defaultClient = $this->db->query('SELECT client FROM client LIMIT 1');
					$query = $this->db->query("SELECT client,keyword FROM client LIMIT 1;");
					$res = $query->result();

					$this->db->query("UPDATE users SET loggedin_client='".$res[0]->keyword."' WHERE user_id='".$userdata['user_id']."'");
					$userdata['loggedin_client'] = $res[0]->keyword;
					$this->session->set_userdata($userdata);				
					redirect('home/index');
				}
			  }else{
			  	$login["errors"]="<p style='color:red'>Your client is not available!</p>";
				$this->load->view('login',$login);
			  }
			}
		} else {
			$this->load->view('login');
		}
	  }else{
	  	$login["errors"]="<p style='color:red'>Please enter the captcha correctly</p>";
		$this->load->view('login',$login);
	  }

	}


	public function client_login()
	{
        $details=$this->input->post();
		if(isset($_POST['login']))
		{
			$userdata = $this->session->userdata($userdata);
			$userdata['loggedin_client'] = $details['client'];
			$this->session->set_userdata($userdata);
			$userdata=$this->session->all_userdata();

			$this->db->query("UPDATE users SET loggedin_client='".$details['client']."' WHERE user_id='".$userdata['user_id']."'");

			redirect('home/index');
		}
		else{
			$this->load->view('login');
		}

	}

	public function signout()
	{
		$userdata=$this->session->all_userdata();

		$this->db->query("UPDATE users SET status='loggedout' WHERE user_id='".$userdata['user_id']."' ");

		$this->db->query("UPDATE users SET loggedin_client=NULL WHERE user_id='".$userdata['user_id']."' ");

  		$this->session->unset_userdata('crm_logged_in');
		redirect("login/index");
	}

}

?>
