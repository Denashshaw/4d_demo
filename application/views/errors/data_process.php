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
						<div class="col-md-12 activity">4D GLOBAL DATA Productivity Module</div>
					</div>

					<?php echo $this->session->flashdata('msg');?>
          <?php if($userdata['role'] == 'agent' || $userdata['role']=='supervisor'){ ?>
					<div class="row activity-row">
							<div class="col-md-12 activity"><button class="add_button start-break" onclick="addinfoBtn()" style="background-color:#007bff;font-size:12px;"> Add Process</button></div>
					</div>
        <?php } ?>
        <div class="row  activity-row">
          <div id="addinfobox" class="col-md-12" style="border: 1px solid #e1e5e6;margin:1px 15px;display:none;">
            <div class="col-md-12" style="text-align:center;padding-top:2%;color:#6f8aea;font-weight:bold"><h3>&nbsp;&nbsp;Data Productivity</h3><br></div>
            <form action="<?php echo base_url();?>Dataprocess/addDataProcess" method="POST" id="addform">
            <div class="row">
              <div class="col-md-3">
                  <p >Date: <span id="start">*</span></p>
                  <input class="col-md-12 col-xs-12 form-control" type="date"  value="<?php echo date('Y-m-d'); ?>" id="dateprocess" name="dateprocess" placeholder="DD-MM-YYYY" required="">
                  <br>
              </div>
              <div class="col-md-3">
                  <p >Employee Name: <span id="start">*</span></p>
                      <input class="col-md-12 col-xs-12 form-control" value="<?php echo $userdata['emp_id'].'/'.$userdata['name']; ?>" type="text" id="empname" name="empname"  required="" readonly>
                  <br>
              </div>
              <div class="col-md-3">
                  <p >Client Code: <span id="start">*</span></p>
                  <select class="col-md-12 col-xs-12 form-control" id="clientcode" name="clientcode" placeholder="EnterClient Code" required="" style="width:100%">
                    <?php foreach($clientdetails as $cc){ ?>
                      <option value="<?php echo $cc->ClientCode; ?>"><?php echo $cc->ClientCode; ?></option>

                    <?php } ?>
                  </select>

                  <br>
              </div>
              <div class="col-md-3">
                  <p >Demos Entered: </p>
                  <input class="col-md-12 col-xs-12 form-control" type="text" id="demos" name="demos" placeholder="Enter Demos Entered" >
                  <br>
              </div>
            </div>
            <div class="row">

              <div class="col-md-3">
                  <p >Charges Entered: </p>
                  <input class="col-md-12 col-xs-12 form-control" type="text" id="chargesEntered" name="chargesEntered" placeholder="Enter Charges Entered" >
                  <br>
              </div>
              <div class="col-md-3">
                  <p >Online Eligiblity Verified: </p>
                  <input class="col-md-12 col-xs-12 form-control" type="text" id="onlineEligiblity" name="onlineEligiblity" placeholder="Enter Online Eligiblity">
                  <br>
              </div>
              <div class="col-md-3">
                  <p >Manual Posting:</p>
                  <input class="col-md-12 col-xs-12 form-control" type="text" id="ManualPosting" name="ManualPosting" placeholder="Enter Manual Posting" >
                  <br>
              </div>
              <div class="col-md-3">
                  <p >ERA Posting: </p>
                  <input class="col-md-12 col-xs-12 form-control" type="text" id="ERAPosting" name="ERAPosting" placeholder="Enter ERA Posting">
                  <br>
              </div>
            </div>
            <div class="row">

              <div class="col-md-3">
                  <p >Denials Captured: </p>
                  <input class="col-md-12 col-xs-12 form-control" type="text" id="DenialsCaptured" name="DenialsCaptured" placeholder="Enter Denials Captured">
                  <br>
              </div>
              <div class="col-md-3">
                  <p >Demo/Charges QC: </p>
                  <input class="col-md-12 col-xs-12 form-control" type="text" id="demo_chargesQC" name="demo_chargesQC" placeholder="Enter Demo/Charges QC">
                  <br>
              </div>
              <div class="col-md-3">
                  <p >Payments QC:</p>
                  <input class="col-md-12 col-xs-12 form-control" type="text" id="PaymentsQC" name="PaymentsQC" placeholder="Enter Payments QC" >
                  <br>
              </div>
            </div>
              <div class="row">
                  <?php if($userdata['role']=='supervisor'){ ?>
                    <div class="col-md-3">
                        <p >Expected Production: </p>
                        <input class="col-md-12 col-xs-12 form-control" type="text" id="ExpectedProduction" name="ExpectedProduction" placeholder="Enter Expected Production">
                        <br>
                    </div>
                <div class="col-md-3">
                    <p >Total Production: </p>
                    <input class="col-md-12 col-xs-12 form-control" type="text" id="TotalProduction" onclick="gettotalproduction()"  name="TotalProduction" placeholder="Enter Total Production">
                    <br>
                </div>

                <div class="col-md-3">
                    <p >Production Percentage:</p>
                    <input class="col-md-12 col-xs-12 form-control" type="text" id="ProductionPercentage"  name="ProductionPercentage" placeholder="Enter Production Percentage" >
                    <br>
                </div>
              <?php  } ?>
              <div align="col-md-12" style="padding-top:2%;padding-left:40%">
                    <input type="submit" class="check-in" style="margin-left:10px;float:right">
                    <input type="reset" class="check-in" style="background-color:red;">
                </div>
            </div>
          </form>

          </div>
        </div>
					<div class="row emp-table">
						<div class="col-md-12 table-responsive">
							<table class="table" id="tabledata">
								<thead>
									<tr>
										<th scope="col" class="heading">Date</th>
										<th scope="col" class="heading">Employee Name</th>
										<th scope="col" class="heading">Client Code</th>
										<th scope="col" class="heading">Demos Entered</th>
										<th scope="col" class="heading">Charges Entered</th>
										<th scope="col" class="heading">Online Eligiblity Verified</th>
										<th scope="col" class="heading">Manual Posting</th>
										<th scope="col" class="heading">ERA Posting</th>
										<th scope="col" class="heading">Denials Capture</th>
										<th scope="col" class="heading">Demo/Charges QC</th>
										<th scope="col" class="heading">Payments QC</th>
                    <th scope="col" class="heading">Expected Production</th>
                    <th scope="col" class="heading">Total Production</th>
                    <th scope="col" class="heading">Production Percentage</th>
										<th scope="col" class="heading">Action</th>
								</thead>
								<tbody>


								<?php if($dataproductvalue) {
                  foreach($dataproductvalue as $r){
                  ?><tr>
  								<td><?php echo ucfirst($r->Date);?></td>
  								<td><?php echo ucfirst($r->Emp_ID."/".$r->Emp_name);?></td>
  								<td><?php echo ucfirst($r->ClientCode);?></td>
  								<td><?php echo ucfirst($r->DemosEntered);?></td>
  								<td><?php echo ucfirst($r->ChargesEntered);?></td>
  								<td><?php echo ucfirst($r->OnlineEligiblity);?></td>
  								<td><?php echo ucfirst($r->ManualPosting);?></td>
  								<td><?php echo ucfirst($r->ERAPosting);?></td>
  								<td><?php echo ucfirst($r->DenialsCaptured);?></td>
  								<td><?php echo ucfirst($r->demo_chargesQC);?></td>
  								<td><?php echo ucfirst($r->PaymentsQC);?></td>
  								<td><?php echo ucfirst($r->ExpectedProduction);?></td>
                  <td><?php echo ucfirst($r->TotalProduction);?></td>
                  <td><?php echo ucfirst($r->ProductionPercentage);?></td>
                  <td>
                    <?php if($userdata['role'] == 'admin'){ ?>
                  <span class="emp-break-in"  style="font-size:12px;cursor: pointer;"  onclick="setUpdate(`<?php echo $r->id;?>`)">Edit</span>
                <?php }else{
                  if($r->Emp_ID == $userdata['emp_id']) ?>
                    <span class="emp-break-in"  style="font-size:12px;cursor: pointer;"  onclick="setUpdate(`<?php echo $r->id;?>`)">Edit</span>
                <?php } ?>
                <?php if($userdata['role'] == 'admin'){ ?>
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
          <form action="<?php echo base_url();?>Dataprocess/updateDataProcess" method="POST" id="updateform" style="font-size:12px;">
            <input type="hidden" id="updateid" name="updateid">
        <div class="row">
          <div class="col-md-3">
              <p >Date: <span id="start">*</span></p>
              <input class="col-md-12 col-xs-12 form-control" type="date" id="Updatedateprocess" name="Updatedateprocess" placeholder="DD-MM-YYYY" required="" readonly>
              <br>
          </div>
          <div class="col-md-3">
              <p >Employee Name: <span id="start">*</span></p>
              <input class="col-md-12 col-xs-12 form-control" id="Updateempname" name="Updateempname" placeholder="Enter Employee Name" required="" readonly>
                <!-- <?php foreach($getuserlistdatapr as $user){ ?>
                  <option value="<?php echo $user->emp_id.'/'.$user->name; ?>"><?php echo $user->emp_id.'/'.$user->name; ?></option>

                <?php } ?>
              </select> -->

              <br>
          </div>
          <div class="col-md-3">
              <p >Client Code: <span id="start">*</span></p>
              <select class="col-md-12 col-xs-12 form-control" id="Updateclientcode" name="Updateclientcode" placeholder="EnterClient Code" required="" style="width:100%">
                <?php foreach($clientdetails as $cc){ ?>
                  <option value="<?php echo $cc->ClientCode; ?>"><?php echo $cc->ClientCode; ?></option>

                <?php } ?>
              </select>
              <br>
          </div>
          <div class="col-md-3">
              <p >Demos Entered: </p>
              <input class="col-md-12 col-xs-12 form-control" type="text" id="Updatedemos" name="Updatedemos" placeholder="Enter Demos Entered" >
              <br>
          </div>
        </div>
        <div class="row">

          <div class="col-md-3">
              <p >Charges Entered: </p>
              <input class="col-md-12 col-xs-12 form-control" type="text" id="UpdatechargesEntered" name="UpdatechargesEntered" placeholder="Enter Charges Entered" >
              <br>
          </div>
          <div class="col-md-3">
              <p >Online Eligiblity Verified: </p>
              <input class="col-md-12 col-xs-12 form-control" type="text" id="UpdateonlineEligiblity" name="UpdateonlineEligiblity" placeholder="Enter Online Eligiblity">
              <br>
          </div>
          <div class="col-md-3">
              <p >Manual Posting:</p>
              <input class="col-md-12 col-xs-12 form-control" type="text" id="UpdateManualPosting" name="UpdateManualPosting" placeholder="Enter Manual Posting" >
              <br>
          </div>
          <div class="col-md-3">
              <p >ERA Posting: </p>
              <input class="col-md-12 col-xs-12 form-control" type="text" id="UpdateERAPosting" name="UpdateERAPosting" placeholder="Enter ERA Posting">
              <br>
          </div>
        </div>
        <div class="row">

          <div class="col-md-3">
              <p >Denials Captured: </p>
              <input class="col-md-12 col-xs-12 form-control" type="text" id="UpdateDenialsCaptured" name="UpdateDenialsCaptured" placeholder="Enter Denials Captured">
              <br>
          </div>
          <div class="col-md-3">
              <p >Demo/Charges QC: </p>
              <input class="col-md-12 col-xs-12 form-control" type="text" id="Updatedemo_chargesQC" name="Updatedemo_chargesQC" placeholder="Enter Demo/Charges QC">
              <br>
          </div>
          <div class="col-md-3">
              <p >Payments QC:</p>
              <input class="col-md-12 col-xs-12 form-control" type="text" id="UpdatePaymentsQC" name="UpdatePaymentsQC" placeholder="Enter Payments QC" >
              <br>
          </div>
        </div>
          <div class="row">
          <?php if($userdata['role']=='supervisor'){ ?>
            <div class="col-md-3">
                <p >Expected Production: </p>
                <input class="col-md-12 col-xs-12 form-control" type="text" id="UpdateExpectedProduction" name="UpdateExpectedProduction" placeholder="Enter Expected Production">
                <br>
            </div>
            <div class="col-md-3">
                <p >Total Production: </p>
                <input class="col-md-12 col-xs-12 form-control" type="text" id="UpdateTotalProduction" name="UpdateTotalProduction"  onclick="UpdateGettotalproduction()" placeholder="Enter Total Production">
                <br>
            </div>

            <div class="col-md-3">
                <p >Production Percentage:</p>
                <input class="col-md-12 col-xs-12 form-control" type="text" id="UpdateProductionPercentage" name="UpdateProductionPercentage" placeholder="Enter Production Percentage" >
                <br>
            </div>
          <?php } ?>
          <div align="col-md-12" style="padding-top:2%;padding-left:40%">
                <input type="submit" class="check-in" style="margin-left:10px;float:right">
                <input type="reset" class="check-in" style="background-color:red;">
            </div>
          </form>
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
    a=a+1;
  }
  if($('#UpdatechargesEntered').val().length > 0)
  {
    a=a+1;
  }
  if($('#UpdateonlineEligiblity').val().length > 0)
  {
    a=a+1;
  }
  if($('#UpdateManualPosting').val().length > 0)
  {
    a=a+1;
  }
  if($('#UpdateERAPosting').val().length > 0)
  {
    a=a+1;
  }
  if($('#UpdateDenialsCaptured').val().length > 0)
  {
    a=a+1;
  }
  if($('#Updatedemo_chargesQC').val().length > 0)
  {
    a=a+1;
  }
  if($('#UpdatePaymentsQC').val().length > 0)
  {
    a=a+1;
  }
  $('#UpdateTotalProduction').val(a);
  if($('#UpdateExpectedProduction').val() != ''){
    var ProductionPercentage=(a/$('#UpdateExpectedProduction').val());
  }else{
    var ProductionPercentage=(a/0);
  }
  $('#UpdateProductionPercentage').val(ProductionPercentage);

}

function gettotalproduction(){
  var a=0;

  if($('#demos').val().length > 0)
  {
    a=a+1;
  }
  if($('#chargesEntered').val().length > 0)
  {
    a=a+1;
  }
  if($('#onlineEligiblity').val().length > 0)
  {
    a=a+1;
  }
  if($('#ManualPosting').val().length > 0)
  {
    a=a+1;
  }
  if($('#ERAPosting').val().length > 0)
  {
    a=a+1;
  }
  if($('#DenialsCaptured').val().length > 0)
  {
    a=a+1;
  }
  if($('#demo_chargesQC').val().length > 0)
  {
    a=a+1;
  }
  if($('#PaymentsQC').val().length > 0)
  {
    a=a+1;
  }
  $('#TotalProduction').val(a);
  if($('#ExpectedProduction').val() != ''){
    var ProductionPercentage=(a/$('#ExpectedProduction').val());
  }else{
    var ProductionPercentage=(a/0);
  }
  $('#ProductionPercentage').val(ProductionPercentage);


}

function addinfoBtn(){
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
     $('.updatemodal #Updatedemos').val(data[0]['DemosEntered']);


     $('.updatemodal #UpdatechargesEntered').val(data[0]['ChargesEntered']);
     $('.updatemodal #UpdateonlineEligiblity').val(data[0]['OnlineEligiblity']);
     $('.updatemodal #UpdateManualPosting').val(data[0]['ManualPosting']);
     $('.updatemodal #UpdateERAPosting').val(data[0]['ERAPosting']);
     $('.updatemodal #UpdateDenialsCaptured').val(data[0]['DenialsCaptured']);
     $('.updatemodal #Updatedemo_chargesQC').val(data[0]['demo_chargesQC']);
      $('.updatemodal #UpdatePaymentsQC').val(data[0]['PaymentsQC']);
       $('.updatemodal #UpdateExpectedProduction').val(data[0]['ExpectedProduction']);
        $('.updatemodal #UpdateTotalProduction').val(data[0]['TotalProduction']);
         $('.updatemodal #UpdateProductionPercentage').val(data[0]['ProductionPercentage']);

    }
  });
}

$(document).ready(function() {

    $('#clientcode').select2({width: 'resolve'});

    $('#Updateclientcode').select2({width: 'resolve'});
});
</script>
</html>
