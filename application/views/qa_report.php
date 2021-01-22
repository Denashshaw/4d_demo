<body>
<style type="text/css">
.brktime td{
line-height:25px;
}
.plinks{
  margin-left:30%;
  font-size: 20px;
  font-family: 'Montserrat', sans-serif !important;
} 
.heading{
  color:#2a316a !important;
}
.plinks a {
margin-left: 10px;
font-size: 15px;
font-family: 'Montserrat', sans-serif !important;
text-decoration: none !important;
color: #212529 !important;

}
.page-active {    
    background: #2a316a;
    padding: 1px 7px 1px 7px;
    border-radius: 4px;
    color: #ffF;
}
.plinks strong {    
    background: #2a316a;
    padding: 1px 7px 1px 7px;
    border-radius: 4px;
    color: #ffF;
    font-weight:500;
    font-size:15px;
    margin-left:10px;
}
</style>

<div class="page-wrapper chiller-theme toggled">

<?php include('header.php');?>
	<main class="page-content">
		<div class="container-fluid p-0">
			<div class="row">
				<div class="col-12 col-md-12 content">
					<div class="row head-content">
						<div class="col-9 col-md-4 logo"><img src="<?php echo base_url();?>img/logo.jpg"></div>
						<div class="col-3 col-md-8 text-right logout"><a href="<?php echo base_url();?>login/signout">Logout</a></div>
					</div>

					<div class="row activity-row">
						<div class="col-md-9 activity">QA Module : 
							<?php echo ucfirst($_SESSION['loggedin_client']); ?>
						</div>

						<?php if($_SESSION['role'] == 'admin' && $_SESSION['loggedin_client'] != ''){ ?>
			            <div class="col-md-2 activity" style="padding-bottom: 20px;font-family: 'Montserrat', sans-serif;float: right;">
			            <form action="<?php echo base_url('Start_qa/changeQaModule');?>" method="POST">
			            <select class="form-control"   name="client_name"  id="client_name" onchange="this.form.submit()">
			              <?php foreach ($clientlist as $client) { ?>
			                <option value='<?php echo $client->keyword ?>'  <?php if($_SESSION['loggedin_client'] == $client->keyword){ ?> selected <?php } ?>><?php echo ucfirst($client->client); ?> </option>
			            <?php } ?>
			            </select>
			            </form>
			            </div>
			            <?php } ?>
					</div>
				
					<?php echo $this->session->flashdata('msg');?>

					<div class="row emp-table">
						<div class="col-md-12 table-responsive">              
							<table class="table" id="mytable">
								<thead>
									<tr>
										<th scope="col" class="heading">SL</th>
										<th scope="col" class="heading">Claim Id</th>
										<th scope="col" class="heading">Patient Name</th>
										<th scope="col" class="heading">Agent Name</th>
										<th scope="col" class="heading">Production Date</th>
										<th scope="col" class="heading">Error Identified on</th>
										<th scope="col" class="heading">No. Of Errors</th>
										<th scope="col" class="heading">Types Of Error</th>
										<th scope="col" class="heading">Error Details</th>
										<th scope="col" class="heading">QA Notes</th>
										<th scope="col" class="heading">Error Category</th>
										<th scope="col" class="heading">Notes</th>
										<th scope="col" class="heading">Error Source</th>
										<th scope="col" class="heading">DPO</th>
										<th scope="col" class="heading">Error Correction Responses</th>
								</thead>
						<tbody>  
							<?php if(count($qa_details) > 0){ $i=1;
								 foreach($qa_details as $sj_data){ ?>
							<tr>
								<td><?php echo $i++;?></td>
								<td><?php echo ucfirst($sj_data->claim_id);?></td>
								<td><?php echo ucfirst($sj_data->patient);?></td>
								<td><?php echo ucfirst($sj_data->agent_name);?></td>
								<td><?php echo ucfirst($sj_data->c_date);?></td>
								<td><?php echo ucfirst($sj_data->qa_date);?></td>
								<td><?php echo 1; ?></td>
								<td><?php echo ucfirst($sj_data->error_type);?></td>
								<td><?php echo ucfirst($sj_data->error_description);?></td>
								<td><?php echo ucfirst($sj_data->qa_notes);?></td>
								<td><?php echo ucfirst($sj_data->fatal_error == 'YES'? 'Fatal Error': 'Not Fatal Error');?></td>
								<td><?php echo ucfirst($sj_data->err_correct_res_note);?></td>
								<td><?php echo ucfirst($sj_data->error_source); ?></td>
								<td><?php echo 1; ?></td>
								<td><?php echo ucfirst($sj_data->err_correct_res); ?></td>
							</tr>
							<?php } } ?> 
						</tbody>
							</table>
							<div class="plinks"><?php if(isset($links)) echo $links;?></div>
						</div>
					</div>
				</div>

			</main>
		</div>
	</body>
</html>