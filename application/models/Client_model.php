<?php
 class Client_model extends CI_Model
 {

   public function update_client($old,$new){
     $update=$this->db->query("UPDATE client SET client='".$new."' WHERE client='".$old."'");
     if($update){ return true;}
 		else{ return false;}
   }
	public function add_client_data($client){


		$insert = $this->db->insert_batch('client',$client);
		if($insert){ return true;}
		else{ return false;}
        // $this->session->set_flashdata('msg','<p style="color:green;font-size:16px;margin-top:2%;margin-left:3.2%;">Client Added Successfully!');
	}

	public function client_data(){
		$dep = $this->db->query("SELECT * FROM client ORDER BY client asc");
		return $dep->result();
	}
  //jagan start
  public function check_client($data){
    $res = $this->db->query("SELECT * FROM client WHERE client like '%".$data."%' ");
    return $res->result();
  }
  //jagan end
  public function unlikeclient_data(){
    $res = $this->db->query("SELECT * FROM hideclient");
    return $res->result();
  }

  public function deact($data){
    $userdata=$this->session->all_userdata();
    $role=$userdata['role'];
    $client=$data['client'];
    $key=$data['key'];

    $res = $this->db->query("Delete FROM client WHERE client='".$client."' AND keyword='".$key."'");

    $res1 = $this->db->query("Insert into hideclient(client,keyword,created_date,created_by) values('".$client."','".$key."','".date('Y-m-d H:i:s')."','".$role."')");

  }

  public function act($data){
    $userdata=$this->session->all_userdata();
    $role=$userdata['role'];
    $client=$data['client'];
    $key=$data['key'];

    $res = $this->db->query("Delete FROM hideclient WHERE client='".$client."' AND keyword='".$key."'");

    $res1 = $this->db->query("Insert into client(client,keyword,created_date,created_by) values('".$client."','".$key."','".date('Y-m-d H:i:s')."','".$role."')");

  }
 }
 ?>
