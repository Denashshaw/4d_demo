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
 }
 ?>
