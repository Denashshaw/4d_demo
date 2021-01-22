<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ERROR);
class Assign_agents extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Mainmodel");
		$this->load->model("Assign_agent_model");
		$userdata=$this->session->all_userdata();

		if($userdata["crm_logged_in"] != TRUE){
			redirect('login/index');
		}
	}

	public function assign_agents_data()
	{
		if(isset($_POST["submit"]))
		{
			$client = $_POST['client'];
			
	        if(!empty($_FILES["upexcel"]["name"]))
	        {
	            $allowed_ext = array("csv","CSV");
	            $tmp = explode('.', $_FILES["upexcel"]["name"]);
	            $extension = end($tmp);
	            if(in_array($extension, $allowed_ext))
	            {
	                $file_data    = fopen($_FILES["upexcel"]["tmp_name"], 'r');
	               	$column_count = count(fgetcsv($file_data));
	                while($row = fgetcsv($file_data))
	                {
	                    $this->Assign_agent_model->upexceldata($row,$client);
	                }
	                $this->session->set_flashdata('msg', '<p style="color:green">File uploaded successfully</p>');
	                redirect('home/assignagents');
	            }
	            else{
	            $this->session->set_flashdata('msg', '<p style="color:red">Invalid file format. Please upload CSV file</p>');
	            redirect('home/assignagents');
	            }
	        }
	        else
	        {
	            $this->session->set_flashdata('msg', '<p style="color:red">Please select file to upload</p>');
	           	redirect('home/assignagents');
	        }
	    }
	    else{
	        $this->load->view('callback_lead',$data);
	    }
	}
}

?>
