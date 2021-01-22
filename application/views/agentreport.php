<body>
<div class="page-wrapper chiller-theme toggled">
	<?php include('header.php');?>
	<main class="page-content">
		<div class="container-fluid p-0">
			<div class="row">
				<div class="col-12 col-md-12 content" style="min-height:780px;">
					<div class="row head-content">
						<div class="col-9 col-md-4 logo"><img src="<?php echo base_url();?>img/logo.jpg"></div>
						<div class="col-3 col-md-8 text-right logout"><a href="<?php echo base_url();?>login/signout">Logout</a></div>
					</div>
					<div class="row activity-row">
						<div class="col-md-9 activity">Agent Report</div>
						<?php if($_SESSION['role'] == 'admin' && $_SESSION['loggedin_client'] != ''){ ?>
						<div class="col-md-2 activity" style="padding-bottom: 20px;font-family: 'Montserrat', sans-serif;">
							<form action="<?php echo base_url('home/agentrepotchangeclient');?>" method="POST">
								<select class="form-control"   name="client_name"  id="client_name" onchange="this.form.submit()">
									<?php foreach ($clientlist as $client) {
										?><option value='<?php echo $client->keyword ?>'  <?php if($_SESSION['loggedin_client'] == $client->keyword){ ?> selected <?php } ?>><?php echo ucfirst($client->client); ?> </option><?php
									}
									?>

								</select>

							</form>
						</div>
						<?php } ?>
					</div>
					<div class="row emp-table">
						<div class="col-md-12">
              <form method="post" action="<?php echo base_url();?>agentreport">
                <div class="row">
									<div class="col">
                  <input type="text" class="form-control" placeholder="FromDate" name="fromdate" id="fromdate" required="" value="<?php echo $_POST['fromdate'];?>" required>
								</div>
								<div class="col">
                  <input type="text" class="form-control" placeholder="ToDate" name="todate" id="todate" required="" value="<?php echo $_POST['todate'];?>" required>
								</div>
								<div class="col">
									<select name="agentname" class="form-control" style="margin-top:3%" placeholder="ToDate">
										<option value="">Select Agent</option>
											<?php foreach($agent_data as $a){
												if($a->role == 'agent'){
													echo "<option value=".$a->emp_id.">".$a->name."</option>";
												}
											} ?>
									</select>
								</div>
                  <br><br>
                  <input type="submit" value="submit" name="submit" class="check-in">
                </div>
              </form>
					  </div>
				  	</div>

						<div class="row emp-table">
							<div class="col-md-12 table-responsive">
								<table class="table" id="mytable">
									<thead>
										<tr>
											<th scope="col" class="heading">Agent</th>
											<th scope="col" class="heading">Assigned</th>
											<th scope="col" class="heading">Completed</th>
											<th scope="col" class="heading">Pending </th>
											<th scope="col" class="heading">Not Workable</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($agentReprot as $agent){ ?>
										<tr>
											<td><?php echo $agent['agentname'];?></td>
											<td><?php echo $agent['agentvalue'];?></td>
											<td><?php echo $agent['completed'];?></td>
											<td><?php  if($agent['agentvalue'] != 0){
												echo $agent['agentvalue'] - ($agent['completed']+$agent['notwork']);
											 }else{
												echo "0";
											  }?></td>
											<td><?php echo $agent['notwork'];?></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>


			  	</div>
	    	</div>
	  	</div>
  	</main>
</div>
</body>

<script type="text/javascript">
  $(document).ready(function(){
    $('#fromdate').datetimepicker();
    $('#todate').datetimepicker();
  });
</script>
