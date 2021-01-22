
<style type="text/css">	
	.btn-light{
		background-color: #fff !important;
		margin-left: 8px;
		min-width: 242px;
		border-color: lightgrey;
	}
	.bootstrap-select>.dropdown-toggle{
		width: auto !important;
	}
</style>

<div class="page-wrapper chiller-theme toggled">
<?php include('header.php'); ?>
<main class="page-content">
	<div class="container-fluid p-0">
		<div class="row">
			<div class="col-12 col-md-12 content">
				<div class="row head-content">
					<div class="col-9 col-md-4 logo"><img src="<?php echo base_url();?>img/logo.jpg"></div>
					<div class="col-3 col-md-8 text-right logout"><a href="<?php echo base_url();?>login/signout">Logout</a></div>
				</div>

				<div class="row activity-row">
		            <div class="col-md-12 activity mb-5"> CAPA Insert Data: </div>
		        </div>
		        <?php echo $this->session->flashdata('msg'); ?>

		        <form action="<?php echo base_url('Capa_controller/insert_capa_data'); ?>" method="POST" class="pl-5">
				  <div class="form-group row">
				    <label for="" class="col-md-3 col-form-label">Client Name:</label>
				    <div class="col-md-3">
				      <select class="form-control" name="client_name" id="client_name">
			              <?php foreach ($clientlist as $client) { ?>
			                <option value='<?php echo $client->keyword; ?>' <?php if($_SESSION['loggedin_client'] == $client->keyword){ ?> selected <?php } ?>><?php echo ucfirst($client->client); ?> </option>
			            <?php } ?>
						</select>
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="" class="col-md-3 col-form-label pt-3">Claim/Account:</label>
				    <div class="col-md-3">
				      <input class="form-control" name="claim_id" id="claim_id" required>
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="" class="col-md-3 col-form-label pt-3">Agent’s Production date:</label>
				    <div class="col-md-3">
				      <input type="date" class="form-control" onkeydown="return false" name="production_date" required id="production_date">
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="" class="col-md-3 col-form-label pt-3">Feedback Received Date:</label>
				    <div class="col-md-3">
				      <input type="date" class="form-control" onkeydown="return false" name="feedback_received_date" required>
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="" class="col-md-3 col-form-label pt-3">Facility Name:</label>
				    <div class="col-md-3">
				      <input class="form-control" name="facility" required>
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="" class="col-md-3 col-form-label pt-3">Issue:</label>
				    <div class="col-md-3">
				      <textarea rows="5" cols="40" required name="issue"></textarea>
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="" class="col-md-3 col-form-label pt-4 mt-2">Parameter:</label>
				    <div class="col-md-3"><br>
				      <select class="form-control" name="parameter" id="parameter">
				      	<option value="action">Action</option>
				      	<option value="documentation">Documentation</option>
				      </select>
				    </div>
				  </div>

				  <div class="form-group row mt-3">
				  	<label for="" class="col-md-3 col-form-label">Error Type:</label>
				  	<select class="selectpicker ml-2" data-show-subtext="true" data-live-search="true" name="error_type">
				  	</select>
				  </div>

				  <div class="form-group row">
				    <label for="" class="col-md-3 col-form-label pt-4 mt-2">Criticality:</label>
				    <div class="col-md-3"><br>
				      <select class="form-control" name="criticality">
				  		<option value="fatal">Fatal</option>				  		
				  		<option value="non_fatal">Non Fatal</option>
				  	</select>
				    </div>
				  </div>

				  <div class="form-group row">
				  	<label for="" class="col-md-3 col-form-label pt-4 mt-2">Frequency:</label>
				  	<div class="col-md-3"><br>
				  	<select class="form-control" name="frequency">
				  		<option>New</option>				  		
				  		<option>Repeated</option>				  		
				  	</select>
				  	</div>
				  </div>				 

				  <div class="form-group row">
				    <label for="" class="col-md-3 col-form-label pt-3">Agent Name:</label>
				    <div class="col-md-3">
				      <input class="form-control" name="agent_name" id="agent_name" required>
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="" class="col-md-3 col-form-label pt-3">Agent Comments:</label>
				    <div class="col-md-3">
				      <textarea rows="5" cols="40" required name="agent_comments" id="agent_comments" required></textarea>
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="" class="col-md-3 col-form-label pt-3">Auditor Name:</label>
				    <div class="col-md-3">
				      <input class="form-control" name="auditor_name" id="auditor_name" required>
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="" class="col-md-3 col-form-label pt-3">Auditor Comments:</label>
				    <div class="col-md-3">
				      <textarea rows="5" cols="40" required name="auditor_comments" id="auditor_comments"></textarea>
				    </div>
				  </div><br>

				  <div class="form-group row">
				    <label for="" class="col-md-3 col-form-label pt-3">Corrective Action:</label>
				    <div class="col-md-3">
				      <textarea rows="5" cols="40" required name="corrective_action" required></textarea>
				    </div>
				  </div><br>

				  <div class="form-group row">
				    <label for="" class="col-md-3 col-form-label pt-3">Preventive Action:</label>
				    <div class="col-md-3">
				      <textarea rows="5" cols="40" required name="preventive_action" required></textarea>
				    </div>
				  </div>

				  <div class="form-group row">
				  	<label for="" class="col-md-3 col-form-label pt-4 mt-2">Source:</label>
				  	<div class="col-md-3"><br>
				  	<select class="form-control" name="source">
				  		<option value="email">Email</option>				  		
				  		<option value="oncall">On Call</option>				  		
				  	</select>
				  	</div>
				  </div>

				  <div class="form-group row">
				    <label for="" class="col-md-3 col-form-label pt-3">Agent's Reporting Authority:</label>
				    <div class="col-md-3">
				    	<select class="form-control mt-2" name="agent_ra" id="agent_ra">
				    		<!-- <option value="dhinesh sha">Dhinesh Sha</option>
				    		<option value="leo perez martin">Leo Perez Martin</option>
				    		<option value="mukesh">Mukesh</option>
				    		<option value="mustafa">Mustafa</option>
				    		<option value="jagadeesh">Jagadeesh</option>
				    		<option value="ganesh">Ganesh</option>
				    		<option value="mohammed ali">Mohammed Ali</option> -->
				    	</select>
				      <!-- <input class="form-control" name="agent_ra" required> -->
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="" class="col-md-3 col-form-label pt-3">Auditor's Reporting Authority:</label>
				    <div class="col-md-3">
				    	<select class="form-control mt-2" name="auditor_ra">
				    		<option value="raja kumar">Raja Kumar</option>
				    		<option value="muthusamy">Muthusamy</option>
				    	</select>
				      <!-- <input class="form-control" name="auditor_ra" required> -->
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="" class="col-md-3 col-form-label pt-3">Comments:</label>
				    <div class="col-md-3 mt-2">
				      <textarea rows="5" cols="40" required name="comments" id="comments" required></textarea>
				    </div>
				  </div><br>

				  <div class="form-group row">
				  	<label for="" class="col-md-3 col-form-label"></label>
				  	<button type="submit" class="btn btn-primary btn-block ml-3" style="width: 242px;">Submit</button>
				  </div>

				  <br><br>
				  <br><br>
				</form>
			</div>
		</div>
	</div>
</main>

<script type="text/javascript">
		changeParameter();
		get_agent_manager();

	$('#parameter').change(() => {
		changeParameter();			
	});

	function changeParameter(){
		$('.selectpicker').html('');
		var parameter = $('#parameter').val();			
		if(parameter == 'action'){
			$('.selectpicker').html(`<option>Claim history not verified</option><option>Fee schedule not verified</option><option>CPT Break up not obtained</option><option>CPT Break updated incorrectly</option><option>Outstanding balance not reviewed</option><option>Eligibility not verified</option><option>Multiple Add on Issue not Deleted previous ones</option><option>Status and Queue not Appropriate</option><option>Auth not verified</option><option>Necessary verification Missing</option><option>Incorrect Follow-up Date</option><option>Pay to address not verified</option><option>Payment already posted - Not verified</option><option>Action Code Incorrect</option><option>Client instruction not followed</option><option>EOB not placed in the path</option><option>Missing / Incorrect status Code</option><option>Missing / Incorrect Queue</option><option>Missing / Incorrect Issue tag</option>`).selectpicker('refresh');
		}else{
			// $('.bootstrap-select .filter-option').val();
			$('.selectpicker').html(`<option>Grammatical Error/Typo Error</option><option>Notes not posted</option><option>Documentation syntax not followed</option>`).selectpicker('refresh');
		}	
	}

	$('#claim_id, #production_date').change(() => {
		var base_url = "<?php echo base_url(); ?>";	
		var claim_id = $('#claim_id').val();
		var client_name = $('#client_name').val();
		var production_date = $('#production_date').val();

		if(claim_id && production_date){
			$.ajax({
				url: base_url+"Capa_controller/get_prod_data",
				method: "POST",
				data: {
					claim_id : claim_id,
					client_name:client_name,
					production_date:production_date
				},
				success: function (res){
					if(res=='null'){
						alert('No Claim Found');
						// $('#production_date').val('');
						$('#agent_name').val('');
						$('#agent_comments').val('');
						$('#auditor_name').val('');
						$('#auditor_comments').val('');
					}else{
						var data = JSON.parse(res);
						$('#production_date').val(data.create_date);
						$('#agent_name').val(data.agent_name);
						$('#agent_comments').val(data.agent_comments);
						$('#auditor_name').val(data.auditor_name);
						$('#auditor_comments').val(data.qa_notes);
					}	
				}, failed: function(){
					alert('failed');
				}
			});
		}else{
			alert('Claim Id and Production date is required!');
		}
	});


$('#client_name').change(() => {
	alert($('#client_name').val())
	get_agent_manager();
});


function get_agent_manager(){
	var base_url = "<?php echo base_url(); ?>";	
	$.ajax({
		url: base_url+'Capa_controller/get_agent_manager',
		method: 'POST',
		data: {
			client: $('#client_name').val()
		}, success: function(res){
			var json = JSON.parse(res);
			var option = '';
			json.forEach((data) => {
				option += `<option value="${data.emp_id}">${data.emp_id}/${data.name}</option>`;
			});
			$('#agent_ra').append(option);
		},failed: function(err){
			console.log(err);
		}
	});
}
</script>