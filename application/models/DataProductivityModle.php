<?php
 class DataProductivityModle extends CI_Model
 {


  public function getUSers(){
     $q = $this->db->query("SELECT * FROM users where role!='admin' order by emp_id ");
    return $q->result();
  }
  public function getClientcode(){
    $q = $this->db->query("SELECT * FROM clientcodetable ");
    return $q->result();
  }
  public function getProduc(){

    $userdata=$this->session->all_userdata();
    $fromdate=date('Y-m-d 00:00:00',strtotime('-2 weeks'));
    $todate=date('Y-m-d H:i:s');

   if($userdata['role'] == 'agent'){
    $que="SELECT * FROM dataproductivity where Emp_ID='".$userdata['emp_id']."' and Created_at BETWEEN '" . $fromdate . "' and '" . $todate . "'";
   }
   else{
     $que="SELECT * FROM dataproductivity where  Created_at BETWEEN '" . $fromdate . "' and '" . $todate . "'";
   }
   $q = $this->db->query($que);
   return $q->result();

  }
	public function addProduc($data){
      $userdata=$this->session->all_userdata();
    $spt=explode("/",$data['empname']);
      if($userdata['role'] == 'supervisor' || $userdata['role'] == 'manager'){
        $val = array(
          "Date" => $data['dateprocess'],
          "Emp_ID" =>  $spt[0],
          "Emp_name" =>   $spt[1],
          "ClientCode" => $data['clientcode'],

          "DemosEntered" => $data['demos'],
          "Demo_ChargesEntered" => $data['chargesEntered'],
          "Demo_OnlineEligible" => $data['onlineEligiblity'],
          "Demo_ExpProduct" => $data['demochargesExp'],
          "Demo_TotalPRoduct" => $data['demochargesTotal'],
          "Demo_PP" => $data['DemoPP'],

          "Payment_ManualPosting" => $data['manualpost'],
          "Payment_ERAPosting" => $data['ERApost'],
          "Payment_DenialsCaptured" => $data['DenialsCaptured'],
          "Payment_ExpProduct " => $data['paymentExp'],
          "Payment_TotalPRoduct" => $data['paymentTotal'],
          "Payment_PP" => $data['PaymentPP'],

          "demo_chargesQC" => $data['AuditDemochar'],
          "demo_chargesQC_EP" => $data['AuditExpe1'],
          "demo_chargesQC_PP" => $data['AuditPP1'],

          "PaymentsQC" => $data['Auditpayments'],
          "PaymentsQC_EP" => $data['AuditExpe2'],
          "PaymentsQC_PP" => $data['AuditPP2'],

          "Created_at" => date('Y-m-d H:i:s')
        );
      }
      if($userdata['role'] == 'agent'){
        $val = array(
          "Date" => $data['dateprocess'],
          "Emp_ID" =>  $spt[0],
          "Emp_name" =>   $spt[1],
          "ClientCode" => $data['clientcode'],

          "DemosEntered" => $data['demos'],
          "Demo_ChargesEntered" => $data['chargesEntered'],
          "Demo_OnlineEligible" => $data['onlineEligiblity'],
          "Demo_TotalPRoduct" => $data['demochargesTotal'],

          "Payment_ManualPosting" => $data['manualpost'],
          "Payment_ERAPosting" => $data['ERApost'],
          "Payment_DenialsCaptured" => $data['DenialsCaptured'],
          "Payment_TotalPRoduct" => $data['paymentTotal'],

          "demo_chargesQC" => $data['AuditDemochar'],
          "PaymentsQC" => $data['Auditpayments'],

          "Created_at" => date('Y-m-d H:i:s')
        );
      }
		$res = $this->db->insert("dataproductivity",$val);
    if($res){
      $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Inserted Successfully!..');
    }else{
       $this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Inserted!..');
    }
	}

  public function removeProduc($data){
    $id = $data['id'];
    $res = $this->db->where('id',$id)->delete('dataproductivity');
   if($res){
     $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Deleted Successfully!..');
   }else{
     $this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Deleted!..');
   }
  }

  public function getProducSingle($data){
      $id = $data['id'];
      $res = $this->db->select('*')->from('dataproductivity')->where('id',$id)->get();
      return $res->result();
  }

  public function updateProduc($data){
      $userdata=$this->session->all_userdata();
    $spt=explode("/",$data['Updateempname']);

    if($userdata['role'] == 'supervisor'){
    $val = array(
      "ClientCode" => $data['Updateclientcode'],
      "DemosEntered" => $data['updatedemos'],
      "Demo_ChargesEntered" => $data['UpdatechargesEntered'],
      "Demo_OnlineEligible" => $data['UpdateonlineEligiblity'],
      "Demo_ExpProduct" => $data['updatedemochargesExp'],
      "Demo_TotalPRoduct" => $data['updatedemochargesTotal'],
      "Demo_PP" => $data['updateDemoPP'],

      "Payment_ManualPosting" => $data['updatemanualpost'],
      "Payment_ERAPosting" => $data['updateERApost'],
      "Payment_DenialsCaptured" => $data['updateDenialsCaptured'],
      "Payment_ExpProduct " => $data['updatepaymentExp'],
      "Payment_TotalPRoduct" => $data['updatepaymentTotal'],
      "Payment_PP" => $data['updatePaymentPP'],

      "demo_chargesQC" => $data['updateAuditDemochar'],
      "demo_chargesQC_EP" => $data['updateAuditExpe1'],
      "demo_chargesQC_PP" => $data['updateAuditPP1'],

      "PaymentsQC" => $data['updateAuditpayments'],
      "PaymentsQC_EP" => $data['updateAuditExpe2'],
      "PaymentsQC_PP" => $data['updateAuditPP2'],

      "Updated_on" => date('Y-m-d H:i:s')
    );
  }
  if($userdata['role'] == 'agent'){
  $val = array(
    "ClientCode" => $data['Updateclientcode'],
    "DemosEntered" => $data['updatedemos'],
    "Demo_ChargesEntered" => $data['UpdatechargesEntered'],
    "Demo_OnlineEligible" => $data['UpdateonlineEligiblity'],
    "Demo_TotalPRoduct" => $data['updatedemochargesTotal'],

    "Payment_ManualPosting" => $data['updatemanualpost'],
    "Payment_ERAPosting" => $data['updateERApost'],
    "Payment_DenialsCaptured" => $data['updateDenialsCaptured'],
    "Payment_TotalPRoduct" => $data['updatepaymentTotal'],

    "demo_chargesQC" => $data['updateAuditDemochar'],

    "PaymentsQC" => $data['updateAuditpayments'],

    "Updated_on" => date('Y-m-d H:i:s')
  );
}

    $updatepr=$this->db->where('id', $data['updateid'])->update('dataproductivity',$val);
      if($updatepr){

         $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Updated Successfully!..');
      }else{
          $this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Update!..');

      }
  }
}

 ?>
