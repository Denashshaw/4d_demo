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
						<div class="col-md-9 activity">Not Workable Claims : 
							<?php echo ucfirst($_SESSION['loggedin_client']); ?>
						</div>

						<?php if($_SESSION['role'] == 'admin' && $_SESSION['loggedin_client'] != ''){ ?>
			            <div class="col-md-2 activity" style="padding-bottom: 20px;font-family: 'Montserrat', sans-serif;float: right;">
			            <form action="<?php echo base_url('home/changeNotWorkable');?>" method="POST">
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

					<?php if($not_workable!=''){?>

					<div class="row emp-table">
						<div class="col-md-12 table-responsive">              
							<table class="table" id="mytable">
								<thead>
									<tr>
									<th scope="col" class="heading">Charge Current Payor Name</th>
									<th scope="col" class="heading">Charge Claim Id</th>
									<th scope="col" class="heading"  id="sl_ins" style="cursor:pointer;color:red !important;font-style:italic;">Claim Id</th>
									<th scope="col" class="heading">Facility Address 1</th>
									<th scope="col" class="heading">Patient Id</th>
									<th scope="col" class="heading" id="sl" style="cursor:pointer;color:red !important;font-style:italic;">Patient Full Name</th>
									<th scope="col" class="heading">Patient Followup</th>
									<th scope="col" class="heading">Charge From Date</th>
									<th scope="col" class="heading">Patient Recall</th>
									<th scope="col" class="heading"></th>
									<th scope="col" class="heading">Charge To Date</th>
									<th scope="col" class="heading">Charge Amount</th>
									<th scope="col" class="heading">Charge Status</th>
									<th scope="col" class="heading">Charge CPT Code</th>
									<th scope="col" class="heading">Charge First Bill</th>
									<th scope="col" class="heading">Charge Last Bill</th>
									<th scope="col" class="heading">Status</th>
									<th scope="col" class="heading">Date Worked</th>
									<th scope="col" class="heading">Collector</th>
									<th scope="col" class="heading">Claim Note</th>
									<th scope="col" class="heading">Worked By</th>
									<th scope="col" class="heading">Worked Date</th>
								</thead>
								<tbody>   
								
							<?php foreach($not_workable as $sj_data){ ?>
							<tr>								
								<td><?php echo ucfirst($sj_data->payer_name);?></td>
								<td><?php echo ucfirst($sj_data->charge_claim_id);?></td>
								<td><?php echo ucfirst($sj_data->claim_id);?></td>
								<td><?php echo ucfirst($sj_data->facility_address_1);?></td>
								<td><?php echo ucfirst($sj_data->patient_id);?></td>
								<td><?php echo ucfirst($sj_data->patient);?></td>
								<td><?php echo ucfirst($sj_data->patient_followup);?></td>
								<td><?php echo ucfirst($sj_data->charge_from_date);?><td>
								<td><?php echo ucfirst($sj_data->patient_recall);?></td>
								<td><?php echo ucfirst($sj_data->charge_to_date);?></td>
								<td><?php echo ucfirst($sj_data->charge_amount);?></td>
								<td><?php echo ucfirst($sj_data->charge_status);?></td>
								<td><?php echo ucfirst($sj_data->charge_cpt_code);?></td>
								<td><?php echo ucfirst($sj_data->charge_first_bill_date);?></td>
								<td><?php echo ucfirst($sj_data->charge_last_bill_date);?></td>
								<td><?php echo ucfirst($sj_data->status);?></td>
								<td><?php echo ucfirst($sj_data->date_worked);?></td>
								<td><?php echo ucfirst($sj_data->collector);?></td>
								<td><?php echo ucfirst($sj_data->claim_note);?></td>	
								<td><?php echo ucfirst($sj_data->emp_id);?></td>
								<td><?php echo ucfirst($sj_data->created_date);?></td>
								</tr>

						<?php }}//} ?> 
				</tbody>

					</table>
						<div class="plinks"><?php echo $links;?></div>

						</div>
					</div>
				</div>

			</main>
		</div>
	</body>

<script type="text/javascript">
	
</script>
</html>