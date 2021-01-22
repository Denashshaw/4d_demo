<body>
<style type="text/css">
.brktime td{
line-height:25px;
}
.plinks{
  margin-left:30%;
    font-size: 20px;
  }
  .plinks a{
    margin-left: 10px;
    font-size: 20px;
  }
  #start{
    color:red;
  }
.updatemodal p{
  font-size: 12px;
}
p{
  font-weight: bold;

}
.color1{
   background-color:LightGray;
}
.color2{
   background-color: #00ffbf;
}

.sticky-col {
  position: sticky;
  position: -webkit-sticky;
  background-color: white;

}

.first-col {
  width: 100px;
  min-width: 100px;
  max-width: 100px;
  left: 0px;


}

.second-col {
  width: 150px;
  min-width: 150px;
  max-width: 150px;
  left: 100px;


}
table, th, td,tr {
  border: 2px solid gray;
}
</style>

<div class="page-wrapper chiller-theme toggled">

<?php include('header.php');

?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
	<main class="page-content">
		<div class="container-fluid p-0">
			<div class="row">
				<div class="col-12 col-md-12 content">
					<div class="row head-content">
						<div class="col-9 col-md-4 logo"><img src="<?php echo base_url();?>img/logo.jpg"></div>
						<div class="col-3 col-md-8 text-right logout"><a href="<?php echo base_url();?>login/signout">Logout</a></div>
					</div>

					<div class="row activity-row">
						<div class="col-md-12 activity">4D GLOBAL DATA Productivity Module <span style="float:right;padding-right:10%;color:rgb(63, 201, 142);"><?php echo $userdata['emp_id'].'/'.$userdata['name']; ?></span></div>
					</div>

					<?php echo $this->session->flashdata('msg');?>
          <?php if($userdata['role'] == 'agent' || $userdata['role']=='supervisor' || $userdata['role']=='manager'){ ?>
					<div class="row activity-row">
							<div class="col-md-12 activity"><button class="add_button start-break" onclick="addinfoBtn();"  style="background-color:#007bff;font-size:12px;"> Add Process</button></div>
					</div>
        <?php } ?>
        <div class="row  activity-row">
          <div id="addinfobox" class="col-md-12" style="border: 1px solid #e1e5e6;margin:1px 15px;display:none;">
            <div class="col-md-12" style="text-align:center;padding-top:2%;color:#6f8aea;font-weight:bold"><h3>&nbsp;&nbsp;Data Productivity</h3><br></div>
            <form action="<?php echo base_url();?>Dataprocess/addDataProcess" method="POST" id="addform">
            <div class="row">
              <div class="col-md-3">
                  <p  style="font-size: 12px;">Date: <span id="start">*</span></p>
                  <input class="col-md-12 col-xs-12 form-control" type="text"  value="<?php echo date('Y-m-d H:i:s'); ?>" id="dateprocess" name="dateprocess" placeholder="DD-MM-YYYY" required="" >
                  <br>
              </div>
              <div class="col-md-3" >

                <?php if($userdata['role']!='agent'){ ?>
                  <p >Employee Name: <span id="start">*</span></p>
                <select id="empname" name="empname"  required="" class="col-md-12 col-xs-12 form-control">
                <?php foreach($getuserlistdatapr as $age){
                    if($age->department == 'Data' ){
                  ?>
                    <option value="<?php echo $age->emp_id.'/'.$age->name; ?>" <?php if( $userdata['emp_id'] == $age->emp_id){ echo "selected"; }?>><?php echo $age->emp_id.'/'.$age->name; ?></option>
                <?php } }?>
              </select>
            <?php  }else{ ?>
              <p >Employee Name: <span id="start">*</span></p>
                      <input  value="<?php echo $userdata['emp_id'].'/'.$userdata['name']; ?>" type="text"  readonly>
                  <?php  } ?>
                  <br>
              </div>
              <div class="col-md-3">
                  <p  style="font-size: 12px;">Client Code: <span id="start">*</span></p>
                  <select class="col-md-12 col-xs-12 form-control" id="clientcode" name="clientcode" placeholder="EnterClient Code" required="" style="width:100%;min-height:300px;">
                    <?php foreach($clientdetails as $cc){ ?>
                      <option value="<?php echo $cc->ClientCode; ?>"><?php echo $cc->ClientCode; ?></option>

                    <?php } ?>
                  </select>

                  <br>
              </div>

            </div>
            <div class="row emp-table">
              <div class="col-md-12"><h5><u>Demo/Charges Production</u></h5></div><br>
              <table class="table" id="tabledata"  >
                <thead >
                  <tr >
                    <th style="font-size:12px;">Demo's Entered</th>
                    <th style="font-size:12px;">Charges Entered</th>
                    <th style="font-size:12px;">Online Eligiblity Verified</th>
                    <th style="font-size:12px;">Expected Production</th>
                    <th style="font-size:12px;">Total Production</th>
                    <th style="font-size:12px;">Production Production</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input class="col-md-12 col-xs-12 form-control demoinput" type="text" id="demos" name="demos" pattern="[0-9]+" maxlength="4"></td>
                    <td><input class="col-md-12 col-xs-12 form-control demoinput" type="text" id="chargesEntered" name="chargesEntered"   pattern="[0-9]+"   maxlength="4"></td>
                    <td><input class="col-md-12 col-xs-12 form-control demoinput" type="text" id="onlineEligiblity" name="onlineEligiblity" pattern="[0-9]+" maxlength="4" ></td>
                    <td>

                          <input class="col-md-12 col-xs-12 form-control " type="text" id="demochargesExp" name="demochargesExp" pattern="[0-9]+"  maxlength="4"
                          <?php if($userdata['role']=='agent'){ ?> readonly <?php  } ?> >
                    </td>
                    <td>

                          <input class="col-md-12 col-xs-12 form-control" type="text" id="demochargesTotal" name="demochargesTotal" pattern="[0-9]+" readonly>
                    </td>
                      <td><input class="col-md-12 col-xs-12 form-control" type="text" id="DemoPP" name="DemoPP" readonly></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="row emp-table">
              <div class="col-md-12"><h5><u>Payments Production</u></h5></div><br>
              <table class="table" id="tabledata"  >
                <thead >
                  <tr >
                    <th style="font-size:12px;">Manual Posting</th>
                    <th style="font-size:12px;">ERA Posting</th>
                    <th style="font-size:12px;">Denials Captured</th>
                    <th style="font-size:12px;">Expected Production</th>
                    <th style="font-size:12px;">Total Production</th>
                    <th style="font-size:12px;">Production Production</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input class="col-md-12 col-xs-12 form-control payinput" type="text" id="manualpost" name="manualpost" pattern="[0-9]+" maxlength="4" ></td>
                    <td><input class="col-md-12 col-xs-12 form-control payinput" type="text" id="ERApost" name="ERApost"   pattern="[0-9]+"   maxlength="4"></td>
                    <td><input class="col-md-12 col-xs-12 form-control payinput" type="text" id="DenialsCaptured" name="DenialsCaptured" pattern="[0-9]+"  maxlength="4"></td>
                    <td>
                         <input class="col-md-12 col-xs-12 form-control" type="text" id="paymentExp" name="paymentExp" pattern="[0-9]+"  maxlength="4" <?php if($userdata['role']=='agent'){ ?> readonly <?php  } ?>>
                    </td>
                    <td>
                          <input class="col-md-12 col-xs-12 form-control" type="text" id="paymentTotal" name="paymentTotal" pattern="[0-9]+" readonly>
                    </td>
                      <td><input class="col-md-12 col-xs-12 form-control" type="text" id="PaymentPP" name="PaymentPP" readonly></td>
                  </tr>
                </tbody>
              </table>
            </div>

              <div class="row emp-table">
                <div class="col-md-6"><h5><u>Audit Production</u></h5></div><br>
                <table class="table" id="tabledata"  >
                  <thead >
                    <tr >
                      <th style="font-size:12px;">Demo/Charges QC</th>
                      <th style="font-size:12px;">Expected Production</th>
                      <th style="font-size:12px;">Production Percentage</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><input class="col-md-6 col-xs-6 form-control " type="text" id="AuditDemochar"  maxlength="4" name="AuditDemochar" pattern="[0-9]+" ></td>
                      <td><input class="col-md-6 col-xs-6  form-control " type="text" id="AuditExpe1"  maxlength="4" name="AuditExpe1"   pattern="[0-9]+"  <?php if($userdata['role']=='agent'){ ?> readonly <?php  } ?>></td>
                      <td><input class="col-md-6 col-xs-6  form-control" type="text" id="AuditPP1"   name="AuditPP1" readonly ></td>
                    </tr>
                  </tbody>
                </table>
                <table class="table" id="tabledata"  >
                  <thead >
                    <tr >
                      <th style="font-size:12px;">Payments QC</th>
                      <th style="font-size:12px;">Expected Production</th>
                      <th style="font-size:12px;">Production Percentage</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><input class="col-md-6 col-xs-6 form-control" type="text" id="Auditpayments"  maxlength="4" name="Auditpayments" pattern="[0-9]+" ></td>
                      <td><input class="col-md-6 col-xs-6  form-control" type="text" id="AuditExpe2"  maxlength="4" name="AuditExpe2"   pattern="[0-9]+"  <?php if($userdata['role']=='agent'){ ?> readonly <?php  } ?>></td>
                      <td><input class="col-md-6 col-xs-6  form-control" type="text" id="AuditPP2"   name="AuditPP2" readonly></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="row">
              <div align="col-md-12" style="padding-top:2%;padding-left:40%">
                    <input type="submit" class="check-in" style="margin-left:10px;float:right">
                    <input type="reset" class="check-in" style="background-color:red;">
              </div>
            </div>
          </form>

          </div>
        </div>
					<div class="row emp-table">
		        <h5 style="padding-left:40%"><?php echo "Report From ".date('Y-m-d',strtotime('-2 weeks'))." To ".date("d-m-Y"); ?></h5>

    				<div class="col-md-12 table-responsive">
							<table class="table" id="tabledata">

									<tr>
										<th scope="col" class="heading sticky-col first-col" rowspan="2" style="font-size:18px; font-weight: bold;text-align:center">Date</th>
										<th scope="col" class="heading sticky-col second-col" rowspan="2" style="font-size:18px; font-weight: bold;text-align:center;border-right:2px solid green;" >Employee<br> Name</th>
										<th scope="col" class="heading" rowspan="2" >Client Code</th>
										<th scope="col" class="heading color1" colspan="6" style="text-align:center;font-weight:bold;font-size:15px">Demo/Charges Production</th>
										<th scope="col" class="heading color2" colspan="6"  style="text-align:center;font-weight:bold;font-size:15px">Payment Production</th>
										<th scope="col" class="heading color3" colspan="6"  style="text-align:center;font-weight:bold;font-size:15px">Audit Production</th>
										<th scope="col" class="heading" rowspan="2">Action</th>
                  </tr>
                  <tr>

                    <th scope="col" class="heading color1"  >Domain's Entered</th>
                    <th scope="col" class="heading color1"  >Charges Entered</th>
                    <th scope="col" class="heading color1" >Online Eligiblity Verified</th>
                    <th scope="col" class="heading color1" >Expected Production</th>
                    <th scope="col" class="heading color1" >Total Production</th>
                    <th scope="col" class="heading color1">Production Percentage</th>

                    <th scope="col" class="heading color2" >Manual Posting</th>
                    <th scope="col" class="heading color2" >ERA Posting</th>
                    <th scope="col" class="heading color2">Denials Captured</th>
                    <th scope="col" class="heading color2">Expected Production</th>
                    <th scope="col" class="heading color2">Total Production</th>
                    <th scope="col" class="heading color2">Production Percentage</th>

                    <th scope="col" class="heading" >Demo/Charges QC</th>
                  <th scope="col" class="heading">Expected Production</th>
                  <th scope="col" class="heading">Production Percentage</th>
                    <th scope="col" class="heading">Payments QC</th>
                    <th scope="col" class="heading">Expected Production</th>
                    <th scope="col" class="heading">Production Percentage</th>
                  </tr>

								<tbody>


								<?php if($dataproductvalue) {
                  foreach($dataproductvalue as $r){
                  ?><tr>
  								<td class="sticky-col first-col"><?php echo ucfirst($r->Date);?></td>
  								<td class="sticky-col second-col" style="border-right:2px solid green;"><?php echo ucfirst($r->Emp_ID."/".$r->Emp_name);?></td>
  								<td><?php echo ucfirst($r->ClientCode);?></td>
  								<td  class="color1"><?php echo ucfirst($r->DemosEntered);?></td>
  								<td class="color1"><?php echo ucfirst($r->Demo_ChargesEntered);?></td>
  								<td class="color1"><?php echo ucfirst($r->Demo_OnlineEligible);?></td>
  								<td class="color1"><?php echo ucfirst($r->Demo_ExpProduct);?></td>
  								<td class="color1"><?php echo ucfirst($r->Demo_TotalPRoduct);?></td>
  								<td class="color1"><?php echo ucfirst($r->Demo_PP);?></td>
  								<td class="color2"><?php echo ucfirst($r->Payment_ManualPosting);?></td>
  								<td  class="color2"><?php echo ucfirst($r->Payment_ERAPosting);?></td>
  								<td  class="color2"><?php echo ucfirst($r->Payment_DenialsCaptured);?></td>
                  <td  class="color2"><?php echo ucfirst($r->Payment_ExpProduct);?></td>

                  <td class="color2"><?php echo ucfirst($r->Payment_TotalPRoduct);?></td>
                  <td class="color2"><?php echo ucfirst($r->Payment_PP);?></td>
                  <td><?php echo ucfirst($r->demo_chargesQC);?></td>
                  <td><?php echo ucfirst($r->demo_chargesQC_EP);?></td>
                  <td><?php echo ucfirst($r->demo_chargesQC_PP);?></td>
                  <td><?php echo ucfirst($r->PaymentsQC);?></td>
                  <td><?php echo ucfirst($r->PaymentsQC_EP);?></td>
                  <td><?php echo ucfirst($r->PaymentsQC_PP);?></td>

                  <td>
                    <?php if($userdata['role'] == 'admin'){ ?>
                  <span class="emp-break-in"  style="font-size:12px;cursor: pointer;"  onclick="setUpdate(`<?php echo $r->id;?>`)">Edit</span>
                <?php }else{
                  if($r->Emp_ID == $userdata['emp_id']) ?>
                    <span class="emp-break-in"  style="font-size:12px;cursor: pointer;"  onclick="setUpdate(`<?php echo $r->id;?>`)">Edit</span>
                <?php } ?>
                <?php if($userdata['role'] == 'supervisor'){ ?>
                    <span class="emp-break-out" style="color:red;font-size:12px;float:right;cursor: pointer;" onclick="setremoveid(`<?php echo $r->id;?>`)">Delete</span>
                <?php } ?>
                  </td>
  							</tr>

  						<?php }}?>
				</tbody>

					</table>
						<!-- <div class="plinks"><?php echo $links;?></div> -->

						</div>
					</div>
				</div>

			</main>
		</div>
	</body>
  <!-- Delete Model -->
<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLongTitle" style="color:red;">Delete Data Production Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
			<form action="<?php echo base_url();?>Dataprocess/DeleteDataProdu" method="GET">
      <div class="modal-body">
				<input type="hidden" name="id" id="empidDelete">
        Are you sure? You want to delete...
      </div>
      <div class="modal-footer">
        <input type="submit" value="Yes" class="check-in" style="margin-left:10px;float:right">
        <input type="button" value="No" class="check-in" data-dismiss="modal" style="background-color:red;">

      </div>
		</form>
    </div>
  </div>
</div>

<!-- Update Model -->
<div class="modal fade updatemodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLongTitle" style="color:#007bff;">Update Data Production Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php include('date_processupdate.php'); ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
function UpdateGettotalproduction(){
  var a=0;

  if($('#Updatedemos').val().length > 0)
  {
    a=a+parseInt($('#Updatedemos').val());
  }
  if($('#UpdatechargesEntered').val().length > 0)
  {
    a=a+parseInt($('#UpdatechargesEntered').val());
  }

  if($('#UpdateERAPosting').val().length > 0)
  {
    a=a+parseInt($('#UpdateERAPosting').val());
  }
  if($('#UpdateDenialsCaptured').val().length > 0)
  {
    a=a+parseInt($('#UpdateDenialsCaptured').val());
  }
  // if($('#Updatedemo_chargesQC').val().length > 0)
  // {
  //   a=a+parseInt($('#Updatedemo_chargesQC').val());
  // }
  // if($('#UpdatePaymentsQC').val().length > 0)
  // {
  //   a=a+parseInt($('#UpdatePaymentsQC').val());
  // }
  $('#UpdateTotalProduction').val(a);
  if($('#UpdateExpectedProduction').val() != ''){
    var ProductionPercentage=(parseInt(a)/parseInt($('#UpdateExpectedProduction').val()));
  }
  $('#UpdateProductionPercentage').val(ProductionPercentage);

}


function addinfoBtn(){
  $("#addform")[0].reset()
	var x = document.getElementById("addinfobox");
 if (x.style.display === "none") {
	 x.style.display = "block";
 } else {
	 x.style.display = "none";
 }
}
function setremoveid(id){
	$('#deleteModel').modal('toggle');
	$('#empidDelete').val(id);
}
function setUpdate(id){
  $('.updatemodal').modal('toggle');
  $.ajax({
    method : 'post',
    url    : '<?php echo base_url();?>Dataprocess/getuserdetials',
    data   : {id:id},
    dataType: 'json',
    success : function(data){
      console.log(data);
        $('.updatemodal #updateid').val(data[0]['id']);
      $('.updatemodal #Updatedateprocess').val(data[0]['Date']);
     $('.updatemodal #Updateempname').val(data[0]['Emp_ID']+"/"+data[0]['Emp_name']);
     $('.updatemodal #Updateclientcode').val(data[0]['ClientCode']);
      $('.updatemodal #Updateclientcode').select2({width: 'resolve'});

     $('.updatemodal #updatedemos').val(data[0]['DemosEntered']);
     $('.updatemodal #UpdatechargesEntered').val(data[0]['Demo_ChargesEntered']);
     $('.updatemodal #UpdateonlineEligiblity').val(data[0]['Demo_OnlineEligible']);
     $('.updatemodal #updatedemochargesExp').val(data[0]['Demo_ExpProduct']);
     $('.updatemodal #updatedemochargesTotal').val(data[0]['Demo_TotalPRoduct']);
     $('.updatemodal #updateDemoPP').val(data[0]['Demo_PP']);

     $('.updatemodal #updatemanualpost').val(data[0]['Payment_ManualPosting']);
     $('.updatemodal #updateERApost').val(data[0]['Payment_ERAPosting']);
     $('.updatemodal #updateDenialsCaptured').val(data[0]['Payment_DenialsCaptured']);
     $('.updatemodal #updatepaymentExp').val(data[0]['Payment_ExpProduct']);
     $('.updatemodal #updatepaymentTotal').val(data[0]['Payment_TotalPRoduct']);
     $('.updatemodal #updatePaymentPP').val(data[0]['Payment_PP']);

     $('.updatemodal #updateAuditDemochar').val(data[0]['demo_chargesQC']);
     $('.updatemodal #updateAuditExpe1').val(data[0]['demo_chargesQC_EP']);
     $('.updatemodal #updateAuditPP1').val(data[0]['demo_chargesQC_PP']);

     $('.updatemodal #updateAuditpayments').val(data[0]['PaymentsQC']);
     $('.updatemodal #updateAuditExpe2').val(data[0]['PaymentsQC_EP']);
     $('.updatemodal #updateAuditPP2').val(data[0]['PaymentsQC_PP']);

    }
  });
}

$(document).ready(function() {

    $('#clientcode').select2({width: 'resolve'});

    $('#Updateclientcode').select2({width: 'resolve'});
});



var updatetotalPr=0;
function updateexpDemo(){
  updatetotalPr = parseInt($('#updatedemos').val()) + parseInt($('#UpdatechargesEntered').val())  + parseInt($('#UpdateonlineEligiblity').val());
  $('#updatedemochargesTotal').val(totalPr);
}
function updateexpDemo(){
  updatetotalPr = parseInt($('#updatedemos').val()) + parseInt($('#UpdatechargesEntered').val())  + parseInt($('#UpdateonlineEligiblity').val());
  $('#updatedemochargesTotal').val(updatetotalPr);
  var per = Math.round((parseInt(updatetotalPr) / parseInt($('#updatedemochargesExp').val()))*100);
  $('#updateDemoPP').val(per+'%');
}





var updatetotald=0;
function updateaddPay(){
  updatetotald = parseInt($('#updatemanualpost').val()) + parseInt($('#updateERApost').val())  + parseInt($('#updateDenialsCaptured').val());
  $('#updatepaymentTotal').val(updatetotald);
}
function updateexpPay(){
  updatetotald = parseInt($('#updatemanualpost').val()) + parseInt($('#updateERApost').val())  + parseInt($('#updateDenialsCaptured').val());
  $('#updatepaymentTotal').val(updatetotald);
  var per = Math.round((parseInt(updatetotald) / parseInt($('#updatepaymentExp').val()))*100);
  $('#updatePaymentPP').val(per+'%');
}


</script>
<Script>
$(document).ready(function(){
		$(".demoinput").each(function() {
			$(this).keyup(function(){
				calculateSumDemo();
			});
		});
    $("#demochargesExp").each(function() {
      $(this).keyup(function(){
        var per = Math.round((parseInt($('#demochargesTotal').val()) / parseInt($('#demochargesExp').val()))*100);
        $('#DemoPP').val(per+'%');
      });
    });
});
function calculateSumDemo() {
		var sum = 0;
		$(".demoinput").each(function() {
			if(!isNaN(this.value) && this.value.length!=0) {
				sum += parseFloat(this.value);
			}
		});

		$("#demochargesTotal").val(sum);
	}

  $(document).ready(function(){
  		$(".payinput").each(function() {
  			$(this).keyup(function(){
  				calculateSumPAy();
  			});
  		});
      $("#paymentExp").each(function() {
        $(this).keyup(function(){
          var per = Math.round((parseInt($('#paymentTotal').val()) / parseInt($('#paymentExp').val()))*100);
          $('#PaymentPP').val(per+'%');
        });
      });
  });
  function calculateSumPAy() {
  		var sum = 0;
  		$(".payinput").each(function() {
  			if(!isNaN(this.value) && this.value.length!=0) {
  				sum += parseFloat(this.value);
  			}
  		});

  		$("#paymentTotal").val(sum);
  	}

$(document).ready(function(){
  $("#AuditExpe1").each(function() {
    $(this).keyup(function(){
      var per = Math.round((parseInt($('#AuditDemochar').val()) / parseInt($('#AuditExpe1').val()))*100);
      $('#AuditPP1').val(per+'%');
    });
  });
  $("#AuditExpe2").each(function() {
    $(this).keyup(function(){
      var per = Math.round((parseInt($('#Auditpayments').val()) / parseInt($('#AuditExpe2').val()))*100);
      $('#AuditPP2').val(per+'%');
    });
  });
});
</script>
<script>
$(document).ready(function(){
		$(".updatedemo").each(function() {
			$(this).keyup(function(){
				updatecalculateSumDemo();
			});
		});
    $("#updatedemochargesExp").each(function() {
      $(this).keyup(function(){
        var per = Math.round((parseInt($('#updatedemochargesTotal').val()) / parseInt($('#updatedemochargesExp').val()))*100);
        $('#updateDemoPP').val(per+'%');
      });
    });
});
function updatecalculateSumDemo() {
		var sum = 0;
		$(".updatedemo").each(function() {
			if(!isNaN(this.value) && this.value.length!=0) {
				sum += parseFloat(this.value);
			}
		});
		$("#updatedemochargesTotal").val(sum);
	}


    $(document).ready(function(){
    		$(".updatepayinput").each(function() {
    			$(this).keyup(function(){
    				updatecalculateSumPAy();
    			});
    		});
        $("#updatepaymentExp").each(function() {
          $(this).keyup(function(){
            var per = Math.round((parseInt($('#updatepaymentTotal').val()) / parseInt($('#updatepaymentExp').val()))*100);
            $('#updatePaymentPP').val(per+'%');
          });
        });
    });
    function updatecalculateSumPAy() {
    		var sum = 0;
    		$(".updatepayinput").each(function() {
    			if(!isNaN(this.value) && this.value.length!=0) {
    				sum += parseFloat(this.value);
    			}
    		});

    		$("#updatepaymentTotal").val(sum);
    	}

  $(document).ready(function(){
    $("#updateAuditExpe1").each(function() {
      $(this).keyup(function(){
        var per = Math.round((parseInt($('#updateAuditDemochar').val()) / parseInt($('#updateAuditExpe1').val()))*100);
        $('#updateAuditPP1').val(per+'%');
      });
    });
    $("#updateAuditExpe2").each(function() {
      $(this).keyup(function(){
        var per = Math.round((parseInt($('#updateAuditpayments').val()) / parseInt($('#updateAuditExpe2').val()))*100);
        $('#updateAuditPP2').val(per+'%');
      });
    });
  });

    $('#dateprocess').datetimepicker();
</script>
</html>
