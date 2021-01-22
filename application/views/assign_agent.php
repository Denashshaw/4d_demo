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
						<div class="col-md-12 activity"> Assign Claims</div>
					</div>
					<div class="row emp-table">
						<div class="col-md-9">
							<?php echo $this->session->flashdata('msg');?>

		              		<form action="<?php echo base_url();?>assign_agents/assign_agents_data" method="post" enctype="multipart/form-data">
			              		<div class="row">
			              			<div class="col-md-3">
			              				<select class="activity form-control" name="client" required="" style="margin-top:10px;">
				            			<option value="">Select Client</option>
													<?php foreach ($clientlist as $client) { ?>
														<option value='<?php echo $client->keyword; ?>'  <?php if($_SESSION['loggedin_client'] == $client->client){ ?> selected <?php } ?>><?php echo ucfirst($client->client); ?> </option>
												<?php } ?>
				          				</select>

			              			</div>
			              			<div class="col-md-4">
			              				<input type="file" name="upexcel" class="form-control">
			              				<p class=""style="color:red !important;font-size: 15px;fon">Please Upload Only CSV files...</p>
			              			</div>
			              		</div>
			              		<input type="submit" value="submit" name="submit" class="check-in">
		            		</form>
						</div>
				  	</div>
			  	</div>
	    	</div>
	  	</div>
  	</main>
</div>
</body>
