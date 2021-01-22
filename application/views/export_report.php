<body>
<div class="page-wrapper chiller-theme toggled">
	<?php include('header.php');?>
	<main class="page-content">
		<div class="container-fluid p-0">
			<div class="row">
				<div class="col-12 col-md-12 content" style="min-height:780px;">
					<div class="row head-content">
						<div class="col-9 col-md-4 logo"><img src="<?php echo base_url();?>img/logo.jpg"></div>
							<div class="col-3 col-md-8 text-right logout">
								<a href="<?php echo base_url();?>login/signout">Logout</a>
							</div>
					</div>
					<div class="row activity-row">
						<div class="col-md-9 activity"> Export Report</div>
						<?php if($_SESSION['role'] == 'admin' && $_SESSION['loggedin_client'] != ''){ ?>
						<div class="col-md-2 activity" style="padding-bottom: 20px;font-family: 'Montserrat', sans-serif;">
							<form action="<?php echo base_url('home/changeClientdownload');?>" method="POST">
								<select class="form-control" name="client_name" id="client_name" onchange="this.form.submit()">
				                  	<?php foreach ($clientlist as $client) {
				                    ?><option value='<?php echo $client->keyword ?>'  <?php if($_SESSION['loggedin_client'] == $client->keyword){ ?> selected <?php } ?>><?php echo ucfirst($client->client); ?> </option>
				                	<?php } ?>
								</select>
							</form>
						</div>
						<?php } ?>
					</div>

					<div class="row emp-table">
						<div class="col-md-12">
			              <form method="post" action="<?php echo base_url();?>report/report_view" id="expreport" class="expreport">
			              	<!-- download_report-->
			              	 <?php date_default_timezone_set('Asia/Kolkata');
											 $fromdate_2week=date('Y-m-d 00:00',strtotime('-2 weeks')); ?>
			                <div class="row">
								<div class="col-md-2">
									<p>From Date</p>
				                  <input type="text" class="form-control" placeholder="FromDate" name="fromdate" id="fromdate" required="" <?php if( $_SESSION['department'] == 'Data'){ ?> value="<?php echo $fromdate_2week ?>" <?php }else{ ?> value="<?php echo date('Y-m-01 H:i:s');?>"   <?php }?>>
								</div>
								<div class="col-md-2">
									<p>To Date</p>
				                  	<input type="text" class="form-control" placeholder="ToDate" name="todate" id="todate" required="" value="<?php echo date('Y-m-d h:i:s');?>">
								</div>
								<div class="col-md-3">
									<p>Agent</p>
				                   <select class="form-control"  name="clientlist" id="clientlist" required="">
									<option value="all">All</option>
										<?php foreach ($agentlist as $a) { ?>
											<option value="<?php echo $a->emp_id; ?>" <?php if( $_SESSION['emp_id'] == $a->emp_id){ echo "selected"; } ?>><?php echo $a->name; ?></option>
										<?php } ?>
									</select>
								</div>
								<?php if( $_SESSION['department'] == 'Data'){ ?>
									<div class="col-md-2">
										<p>Client</p>
										<select class="form-control"  name="clientid" id="clientid" required="">
											<option value="all">All</option>
											<?php foreach ($getclientcode as $cc) { ?>
												<option value="<?php echo $cc->ClientCode; ?>"><?php echo $cc->ClientCode; ?></option>
											<?php } ?>
										</select>
									</div>
								<?php } ?>
								<?php if( $_SESSION['department'] != 'Data'){ ?>
								<div class="col-md-3">
									<p>Select Report</p>
									<select class="form-control" name="report_type" id="report_type" onchange="changeprocess()">
											<option value="qa_report">Voice QA Report</option>
										<option value="qa_Productivityreport">Voice Productivity Report</option>

									</select>
								</div>
								<?php } ?>

								<div class="col-md-12"><br>

								<?php if( $_SESSION['department'] == 'Data'){ ?>
													<input type="button" value="submit" class="check-in" onclick="checkdetails()">


													<div id="btnview">
															<div class="row">
				<div class="col-md-6"><input type="submit" class="check-in" value="Excel" name="Excel" style="max-width:150px;margin-left:80%">
				</div>
				<div class="col-md-6">
					<input type="submit" class="check-out" value="PDF"  name="PDF" formtarget="_blank" style="max-width:150px">
				</div>
			</div>
		</div>
									<div id="viewpreview"></div>


												<?php }else{ ?>
													<input type="submit" value="submit" name="submit" class="check-in">
											<?php	} ?>

											<?php if( $_SESSION['department'] != 'Data'){ ?>
                  					<!-- <input type="submit" value="submit" name="submit" class="check-in"> -->

                  					<?php if(count($qa_details) > 0){ ?>
                  					<a class="btn btn-primary" data-toggle="collapse" id="custColumn" href="#viewfieldlist" role="button" aria-expanded="false" aria-controls="viewfieldlist" style="font-size: 12px;float: right;">Click here for custom Column</a><br><br>
								</div>
			        </div>
	<div class="row">
	<div id="viewfieldlist" class="col-md-12 viewcolumn" style="border: 1px solid #e1e5e6;margin:1px 15px;max-width:1028px;" style="display:none;">
	    <div class="row" style="border-bottom:2px solid #e1e5e6;">
	      <table class="table table-bordered">
			<?php if( $_SESSION['department'] != 'Data'){ ?>
	        <form action="<?php echo base_url();?>empinfoControl/export" method="POST" >
	        	&nbsp;&nbsp;<input type="checkbox" name="selectall" class="selectall " id="selectall"  checked><span style="font-weight:bold;color:gray;font-size:20px;"> &nbsp;&nbsp;
	        		<label for="selectall">Select All</label>
	        <tr>
	          <td style="display:none;"><input type="text" name="fields[]" value="Claim Id" checked> Claim Id</td>
	          <td><input type="checkbox" name="fields[]" value="Patient Name" id="patient" checked> Patient Name</td>
	          <td><input type="checkbox" name="fields[]" value="Agent Name" id="emp_name" checked> Agent Name</td>
	          <td><input type="checkbox" name="fields[]" value="Production Date" id="proud_date" checked> Production Date</td>
	          <td><input type="checkbox" name="fields[]" value="Error Identified On" id="err_date" checked>Error Identified On</td>
	          <td><input type="checkbox" name="fields[]" value="Types of Error" id="type_err" checked> Types of Error</td>
	        </tr>
	        <tr>
	          <td><input type="checkbox" name="fields[]" value="Error Details" id="err_details" checked> Error Details</td>
	          <td><input type="checkbox" name="fields[]" value="QA Notes" id="qa_notes" checked> QA Notes</td>
	          <td><input type="checkbox" name="fields[]" value="Error Category" id="err_category" checked> Error Category</td>
	          <td><input type="checkbox" name="fields[]" value="Notes" id="notes" checked> Notes</td>
	          <td><input type="checkbox" name="fields[]" id="err_crr_res" value="Error Correction Responses" checked> Error Correction Responses</td>
	        </tr>
	        <tr>
	        	<td><input type="checkbox" name="fields[]" id="error_source" value="Error Source" checked> Error Source</td>
	          <td><input type="checkbox" name="fields[]" id="no_err" value="No of Errors" checked> No of Errors</td>
	        	<td><input type="checkbox" name="fields[]" id="dpo" value="DPO" checked> DPO</td>
	          	<td><input type="submit" value="Excel" name="Excel" class="check-out">
				<input type="submit" value="PDF" name="Pdf" class="check-in"  formtarget="_blank">
				</td>
	        </tr>
	        <?php } }else{
	        	if($_POST['fromdate'] != '' && $_POST['todate'] != ''){
	        		echo '<h1 style="text-align:center;">No Data Found</h1>';
	        	}
	        }?>
			<?php } ?>
	      </table>
	    </div>
	  </div>
	</div>
  </div>
</div>
				  	<?php echo $this->session->flashdata('msg');?>
					<?php if( $_SESSION['department'] != 'Data'){ ?>
					<?php if(count($qa_details) > 0){ ?>
						<div class="row emp-table" id="showtable" style="display: none;">
						</form>
						<div class="col-md-12 table-responsive">
							<table class="table" id="mytable">
								<thead>
									<tr>
										<th scope="col" class="heading">SL</th>
										<th scope="col" class="heading">Claim Id</th>
										<th scope="col" class="heading t_patient" style="display: none;">Patient Name</th>
										<th scope="col" class="heading t_emp_name" style="display: none;">Agent Name</th>
										<th scope="col" class="heading t_proud_date" style="display: none;">Production Date</th>
										<th scope="col" class="heading t_err_date" style="display: none;">Error Identified on</th>
										<th scope="col" class="heading t_type_err" style="display: none;">Types Of Error</th>
										<th scope="col" class="heading t_err_details" style="display: none;">Error Details</th>
										<th scope="col" class="heading t_qa_notes" style="display: none;">QA Notes</th>
										<th scope="col" class="heading t_err_category" style="display: none;">Error Category</th>
										<th scope="col" class="heading t_notes" style="display: none;">Notes</th>
										<th scope="col" class="heading t_err_crr_res" style="display: none;">Error Correction Responses</th>
										<th scope="col" class="heading t_error_source" style="display: none;">Error Source</th>
										<th scope="col" class="heading t_no_err" style="display: none;">No. Of Errors</th>
										<th scope="col" class="heading t_dpo" style="display: none;">DPO</th>
								</thead>
						<tbody>
							<?php
							 $i=1;
								 foreach($qa_details as $sj_data){ ?>
							<tr>
								<td><?php echo $i++;?></td>
								<td><?php echo ucfirst($sj_data->claim_id);?></td>
								<td style="display: none !important;" class='t_patient'><?php echo ucfirst($sj_data->patient);?></td>
								<td style="display: none;" class='t_emp_name'><?php echo ucfirst($sj_data->name);?></td>
								<td style="display: none;" class='t_proud_date'><?php echo ucfirst($sj_data->c_date);?></td>
								<td style="display: none;" class='t_err_date'><?php echo ucfirst($sj_data->qa_date);?></td>
								<td style="display: none;" class='t_type_err'><?php echo ucfirst($sj_data->error_type);?></td>
								<td style="display: none;" class='t_err_details'><?php echo ucfirst($sj_data->error_description);?></td>
								<td style="display: none;" class='t_qa_notes'><?php echo ucfirst($sj_data->qa_notes);?></td>
								<td style="display: none;" class='t_err_category'><?php echo ucfirst($sj_data->fatal_error == 'YES'? 'Fatal Error': 'Not Fatal Error');?></td>
								<td style="display: none;" class='t_notes'><?php echo ucfirst($sj_data->err_correct_res_note);?></td>
								<td style="display: none;" class="t_err_crr_res"><?php echo ucfirst($sj_data->err_correct_res); ?></td>
								<td style="display: none;" class="t_error_source"><?php echo ucfirst($sj_data->error_source); ?></td>
								<td style="display: none;" class='t_no_err'><?php echo 1; ?></td>
								<td style="display: none;" class="t_dpo"><?php echo 1; ?></td>
								</tr>
							<?php } } ?>
						</tbody>
							</table>
							<div class="plinks"><?php if(isset($links)) echo $links;?></div>
						</div>
					</div>
			  	</div>
	    	</div>
	  	</div>
  	</main>
</div>
<?php } ?>
</body>

<script type="text/javascript">
  $(document).ready(function(){

  	$(":checkbox").on("change", function() {
        if(!$(this).is(":checked")){
            $("#selectall").prop('checked', false);
        }
 		if($(":checkbox:checked").length == 14){
			$("#selectall").prop('checked', true);
		}

		if($(":checkbox:checked").length < 1){
			alert('Please check atleast one checkbox');
		}
    });

		$('.t_patient').show();
		$('.t_emp_name').show();
		$('.t_proud_date').show();
		$('.t_err_date').show();
		$('.t_no_err').show();
		$('.t_type_err').show();
		$('.t_err_details').show();
		$('.t_qa_notes').show();
		$('.t_err_category').show();
		$('.t_notes').show();
		$('.t_dpo').show();
		$('.t_err_crr_res').show();
		$('.t_error_source').show();

  		// For all checkbox ready

	  	if($('#selectall').is(':checked')){
	  		$('.t_patient,.t_emp_name,.t_proud_date,.t_err_date,.t_no_err,.t_type_err,.t_err_details,.t_qa_notes,.t_err_category,.t_notes,.t_dpo,.t_err_crr_res,.t_error_source').show();
	  	}else{
	  		$('.t_patient,.t_emp_name,.t_proud_date,.t_err_date,.t_no_err,.t_type_err,.t_err_details,.t_qa_notes,.t_err_category,.t_notes,.t_dpo,.t_err_crr_res,.t_error_source').hide();
	  	}

	  	if($('#patient').is(':checked')){
	  		$('.t_patient').show();
	  	}else{
	  		$('.t_patient').hide();
	  	}


  		if($('#emp_name').is(':checked')){
	  		$('.t_emp_name').show();
	  	}else{
	  		$('.t_emp_name').hide();
	  	}

  		if($('#proud_date').is(':checked')){
	  		$('.t_proud_date').show();
	  	}else{
	  		$('.t_proud_date').hide();
	  	}

  		if($('#err_date').is(':checked')){
	  		$('.t_err_date').show();
	  	}else{
	  		$('.t_err_date').hide();
	  	}

  		if($('#no_err').is(':checked')){
	  		$('.t_no_err').show();
	  	}else{
	  		$('.t_no_err').hide();
	  	}

  		if($('#type_err').is(':checked')){
	  		$('.t_type_err').show();
	  	}else{
	  		$('.t_type_err').hide();
	  	}

  		if($('#err_details').is(':checked')){
	  		$('.t_err_details').show();
	  	}else{
	  		$('.t_err_details').hide();
	  	}

  		if($('#qa_notes').is(':checked')){
	  		$('.t_qa_notes').show();
	  	}else{
	  		$('.t_qa_notes').hide();
	  	}

  		if($('#err_category').is(':checked')){
	  		$('.t_err_category').show();
	  	}else{
	  		$('.t_err_category').hide();
	  	}

  		if($('#notes').is(':checked')){
	  		$('.t_notes').show();
	  	}else{
	  		$('.t_notes').hide();
	  	}

  		if($('#dpo').is(':checked')){
	  		$('.t_dpo').show();
	  	}else{
	  		$('.t_dpo').hide();
	  	}

  		if($('#err_crr_res').is(':checked')){
	  		$('.t_err_crr_res').show();
	  	}else{
	  		$('.t_err_crr_res').hide();
	  	}

	  	if($('#error_source').is(':checked')){
	  		$('.t_error_source').show();
	  	}else{
	  		$('.t_error_source').hide();
	  	}

	// For all checkbox change event
	$('#selectall').change(function(){
		if($('#selectall').is(':checked')){
	  		$('.t_patient,.t_emp_name,.t_proud_date,.t_err_date,.t_no_err,.t_type_err,.t_err_details,.t_qa_notes,.t_err_category,.t_notes,.t_dpo,.t_err_crr_res,.t_error_source').show();
	  	}else{
	  		$('.t_patient,.t_emp_name,.t_proud_date,.t_err_date,.t_no_err,.t_type_err,.t_err_details,.t_qa_notes,.t_err_category,.t_notes,.t_dpo,.t_err_crr_res,.t_error_source').hide();
	  	}
	});

  	$('#patient').change(function(){
  		if($('#patient').is(':checked')){
	  		$('.t_patient').show();
	  	}else{
	  		$('.t_patient').hide();
	  	}
	});

	$('#emp_name').change(function(){
  		if($('#emp_name').is(':checked')){
	  		$('.t_emp_name').show();
	  	}else{
	  		$('.t_emp_name').hide();
	  	}
	});

	$('#proud_date').change(function(){
  		if($('#proud_date').is(':checked')){
	  		$('.t_proud_date').show();
	  	}else{
	  		$('.t_proud_date').hide();
	  	}
	});

	$('#err_date').change(function(){
  		if($('#err_date').is(':checked')){
	  		$('.t_err_date').show();
	  	}else{
	  		$('.t_err_date').hide();
	  	}
	});

	$('#no_err').change(function(){
  		if($('#no_err').is(':checked')){
	  		$('.t_no_err').show();
	  	}else{
	  		$('.t_no_err').hide();
	  	}
	});

	$('#type_err').change(function(){
  		if($('#type_err').is(':checked')){
	  		$('.t_type_err').show();
	  	}else{
	  		$('.t_type_err').hide();
	  	}
	});

	$('#err_details').change(function(){
  		if($('#err_details').is(':checked')){
	  		$('.t_err_details').show();
	  	}else{
	  		$('.t_err_details').hide();
	  	}
	});

	$('#qa_notes').change(function(){
  		if($('#qa_notes').is(':checked')){
	  		$('.t_qa_notes').show();
	  	}else{
	  		$('.t_qa_notes').hide();
	  	}
	});

	$('#err_category').change(function(){
  		if($('#err_category').is(':checked')){
	  		$('.t_err_category').show();
	  	}else{
	  		$('.t_err_category').hide();
	  	}
	});

	$('#notes').change(function(){
  		if($('#notes').is(':checked')){
	  		$('.t_notes').show();
	  	}else{
	  		$('.t_notes').hide();
	  	}
	});

	$('#dpo').change(function(){
  		if($('#dpo').is(':checked')){
	  		$('.t_dpo').show();
	  	}else{
	  		$('.t_dpo').hide();
	  	}
	});

	$('#err_crr_res').change(function(){
  		if($('#err_crr_res').is(':checked')){
	  		$('.t_err_crr_res').show();
	  	}else{
	  		$('.t_err_crr_res').hide();
	  	}
	});

	$('#error_source').change(function(){
  		if($('#error_source').is(':checked')){
	  		$('.t_error_source').show();
	  	}else{
	  		$('.t_error_source').hide();
	  	}
	});

  	$('#viewfieldlist').collapse();

    $('#fromdate').datetimepicker();
    $('#todate').datetimepicker();
  });


	$('#btnview').hide();
	function checkdetails()
	{
		$.ajax({
		 method : 'post',
		 url    : '<?php echo base_url();?>Home/checkReportdetails',
		 data   : $("#expreport").serialize(),
		 dataType: 'json',
		 success : function(data){
			if(data.length > 0){
				console.log(data);
				var res='';

				res +='<div class="row emp-table"><div class="col-md-12 table-responsive"><table border="1" class="table" id="tabledata"><tr><th scope="col" class="heading sticky-col first-col" rowspan="2" style="font-size:18px; font-weight: bold;text-align:center">Date</th><th scope="col" class="heading sticky-col second-col" rowspan="2" style="font-size:18px; font-weight: bold;text-align:center;border-right:2px solid green;" >Employee<br> Name</th><th scope="col" class="heading" rowspan="2" >Client Code</th><th scope="col" class="heading color1" colspan="6" style="text-align:center;font-weight:bold;font-size:15px">Demo/Charges Production</th><th scope="col" class="heading color2" colspan="6"  style="text-align:center;font-weight:bold;font-size:15px">Payment Production</th><th scope="col" class="heading color3" colspan="6"  style="text-align:center;font-weight:bold;font-size:15px">Audit Production</th></tr><tr><th scope="col" class="heading color1"  >Domains Entered</th><th scope="col" class="heading color1"  >Charges Entered</th><th scope="col" class="heading color1" >Online Eligiblity Verified</th><th scope="col" class="heading color1" >Expected Production</th><th scope="col" class="heading color1" >Total Production</th><th scope="col" class="heading color1">Production Percentage</th><th scope="col" class="heading color2" >Manual Posting</th><th scope="col" class="heading color2" >ERA Posting</th><th scope="col" class="heading color2">Denials Captured</th><th scope="col" class="heading color2">Expected Production</th><th scope="col" class="heading color2">Total Production</th><th scope="col" class="heading color2">Production Percentage</th><th scope="col" class="heading" >Demo/Charges QC</th><th scope="col" class="heading">Expected Production</th><th scope="col" class="heading">Production Percentage</th><th scope="col" class="heading">Payments QC</th><th scope="col" class="heading">Expected Production</th><th scope="col" class="heading">Production Percentage</th></tr><tbody>';

				for(var i=0;i< data.length;i++){
					res+='<tr><td class="sticky-col first-col">'+data[i]['Date']+'</td><td class="sticky-col second-col" style="border-right:2px solid green;">'+data[i]['Emp_name']+'</td><td>'+data[i]['ClientCode']+'</td><td  class="color1">'+data[i]['DemosEntered']+'</td><td class="color1">'+data[i]['Demo_ChargesEntered']+'</td><td class="color1">'+data[i]['Demo_OnlineEligible']+'</td><td class="color1">'+data[i]['Demo_ExpProduct']+'</td><td class="color1">'+data[i]['Demo_TotalPRoduct']+'</td><td class="color1">'+data[i]['Demo_PP']+'</td><td class="color2">'+data[i]['Payment_ManualPosting']+'</td><td  class="color2">'+data[i]['Payment_ERAPosting']+'</td><td  class="color2">'+data[i]['Payment_DenialsCaptured']+'</td> <td  class="color2">'+data[i]['Payment_ExpProduct']+'</td><td class="color2">'+data[i]['Payment_TotalPRoduct']+'</td><td class="color2">'+data[i]['Payment_PP']+'</td><td>'+data[i]['demo_chargesQC']+'</td><td>'+data[i]['demo_chargesQC_EP']+'</td><td>'+data[i]['demo_chargesQC_PP']+'</td><td>'+data[i]['PaymentsQC']+'</td><td>'+data[i]['PaymentsQC_EP']+'</td><td>'+data[i]['PaymentsQC_PP']+'</td></tr>';
				}


				res +='</div></div>';
					$('#viewpreview').html(res);
					$('#btnview').show();
				//$('#deleteModel').modal('toggle');
				//$(".expreport").submit();
			}else{
				  alert("No records available for your search");
			}
		 }
	 });
	}

	function changeprocess(){
		var rep =$('#report_type').val();
		if(rep == 'qa_Productivityreport'){
			$('#custColumn').hide();
			$('.viewcolumn').hide();
			$('#showtable').hide();
		}else{
			$('#custColumn').show();
			$('.viewcolumn').show();
			$('#showtable').show();
		}
	}
	changeprocess();

	$('#selectall').click(function() { $(this.form.elements).filter(':checkbox').prop('checked', this.checked);
	});
</script>
