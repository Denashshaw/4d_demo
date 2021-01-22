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
						<div class="col-md-9 activity">Production Dashboard : 
							<?php echo ucfirst($_SESSION['loggedin_client']); ?>
						</div>

						<?php if($_SESSION['role'] == 'admin' && $_SESSION['loggedin_client'] != ''){ ?>
			            <div class="col-md-2 activity" style="padding-bottom: 20px;font-family: 'Montserrat', sans-serif;float: right;">
			            <form action="<?php echo base_url('home/changeProdDashboard');?>" method="POST">
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

					<form action="<?php echo base_url('Prod_dashboard/index'); ?>" method="POST">
					<div class="row activity-row">
						<div class="col-md-2">
							<label>From Date</label>
							<input type="date" name="from_date" value="2020-08-01" id="from_date" class="form-control" readonly>
							<input type="hidden" value="<?php echo base_url(); ?>" id="base_url">
						</div>
						<div class="col-md-2">
							<label>To Date</label>
							<input type="date" name="to_date" value="2020-06-01" class="form-control" id="to_date" readonly>
						</div>
						<div class="col-md-2">
							<label>Agent Name</label>						
							<select class="form-control mt-2" name="agent_id">
							<?php if($_SESSION['role'] == 'agent'){
								echo "<option value='".$_SESSION['emp_id']."'>".$_SESSION['name']."</option>";
							} else { ?>
								<option value="">All</option>
							<?php $sql = $this->db->query("SELECT emp_id,name FROM users WHERE role='agent' ")->result(); 
								foreach ($sql as $key => $value) {
									if($_POST['agent_id'] == $value->emp_id){
										$selected_val = 'selected';
									}else{
										$selected_val = '';
									}
									echo "<option value='".$value->emp_id."' $selected_val> ".ucwords(strtolower($value->name))." </option>";
								}
							} ?>
							</select>
						</div>
						<div class="col-md-1 mt-2"><br>
							<input type="submit" value="submit" class="btn btn-outline-primary">				
						</div>
						<div class="col-md-2 mt-2"><br>
						<input type="button" class="btn btn-primary" id="expected_prod" value="Update Expected Production">
						</div>
					</div>
					</form>

					<div class="row" align="center" style="color:white;">
						<div class="col-md-3 pl-5">
							<div class="card" style="background-color: green;"><br>
								<h4>Total Production</h4>
								<div class="card-body">
									<h2><?php echo $prod_details[0]->total; ?></h2>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card" style="background-color: #007bff;"><br>
								<h4>Expected Production</h4>
								<div class="card-body">
									<h2 class="expected_prod">
										<?php $count = $this->db->query("SELECT expected_count FROM expected_production LIMIT 1")->row(); 
										echo $count->expected_count;
										?>
									</h2>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card" style="background-color: #fd7e14;"><br>
								<h4>Total Days Present</h4>
								<div class="card-body">
									<h2 class="total"></h2>
								</div>
							</div>
						</div>
						<div class="col-md-3 pr-5">
							<div class="card" style="background-color: #01295F;"><br>
								<h4>Daily Average</h4>
								<div class="card-body">
									<h2 class="dailyAvg"></h2>
								</div>
							</div>
						</div>
					</div>					

					<div class="row">
						<div class="col-md-5 table-responsive emp-table">  
							<table class="table" id="mytable">
							<thead>
								<tr>
									<!-- <th scope="col" class="heading" colspan="4"></th> -->
									<th scope="col" class="heading" colspan="3" style="text-align: center;">Summary of Insurances Claimed</th>
								</tr>
								<tr>
								<th scope="col" class="heading">Insurance Name</th>
								<th scope="col" class="heading">Total Claims</th>
								<th scope="col" class="heading">Total Charges</th>								
								</tr>
							</thead>
							<tbody>
								<?php if($insurance_details){
									foreach ($insurance_details as $key => $value) { ?>
								<tr>							
									<td><?php echo $value['insurance']; ?></td>									
									<td><?php echo $value['total_claims']; ?></td>
									<td><?php echo '$'.$value['charges'].'.00'; ?></td>
								</tr>
							<?php } } else{ ?>
								<tr><td>No Data Found</td></tr>
							<?php } ?> 
								</tbody>
							</table>
						</div>
						<div class="col-md-5 table-responsive emp-table">  
							<table class="table" id="mytable">
							<thead>
								<tr>
									<!-- <th scope="col" class="heading" colspan="3">Summary of Disposition</th> -->
									<th scope="col" class="heading" colspan="3" style="text-align: center;">Summary of Disposition</th>
								</tr>
								<tr>
								<th scope="col" class="heading" style="">Disposition Name</th>
								<th scope="col" class="heading">Total Claims</th>
								<th scope="col" class="heading" style="">Total Charges</th>
								</tr>
							</thead>
							<tbody>
								<?php if($disposition_details){
									foreach ($disposition_details as $key => $value) { ?>
								<tr>							
									<td><?php echo $value['disposition_claims']; ?></td>									
									<td><?php echo $value['total_dis_claims']; ?></td>
									<td><?php echo '$'.$value['dis_charges'].'.00'; ?></td>
								</tr>
							<?php } } else{ ?>
								<tr><td>No Data Found</td></tr>
							<?php } ?> 
								</tbody>
							</table>
						</div>
					</div>

			</main>
		</div>
	</body>
</html>

<script type="text/javascript">
$(document).ready(function(){

	$('#expected_prod').click(function(){
		var base_url = $('#base_url').val();		
		var init_val = parseInt($('.expected_prod').text());		
		var expected_prod = prompt("Update Expected Production", init_val);
		if (expected_prod != null) {
			$.ajax({
				url: base_url+'Prod_dashboard/update_expctd_val',
				method: 'POST',
				data: {
					'expected_count' : expected_prod					
				},
				success: function(res){					
					alert('Expected Count is Updated');
				},failed: function(err){
					console.log(err);
				}
			})
			$('.expected_prod').text(expected_prod);
		}
	});

	var today = new Date();
	var dd = String(today.getDate()).padStart(2, '0');
	var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
	var yyyy = today.getFullYear();

	var today1 = yyyy + '-' + mm + '-' + '01';
	var today = yyyy + '-' + mm + '-' + dd;

	$('#from_date').val(today1);
	$('#to_date').val(today);

	// 2020-08-01     2020/08/17
	var now = new Date();
	var total_days_in_month = new Date(now.getFullYear(), now.getMonth()+1, 0).getDate();
	var remaining_days = total_days_in_month - now.getDate();
	var completed_days = total_days_in_month - remaining_days;
	$('.total').text(remaining_days);
	var total = "<?php echo $prod_details[0]->total; ?>";
	// Math.round(total/completed_days)
	var avg = total/completed_days;
	$('.dailyAvg').text(avg.toFixed(2));
});



</script>