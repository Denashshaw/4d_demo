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
                                        <!-- <th scope="col" class="heading" id="sl_ins" style="cursor:pointer;color:red !important;font-style:italic;">Created Date</th> -->
                                        <th scope="col" class="heading">System</th>
                                        <th scope="col" class="heading">Claim Id</th>
                                        <th scope="col" class="heading">INS</th>
                                        <th scope="col" class="heading">Patient</th>
                                        <th scope="col" class="heading">Charge</th>

                                        <th scope="col" class="heading">DOS From</th>
                                        <!-- <th scope="col" class="heading" id="sl" style="cursor:pointer;color:red !important;font-style:italic;">Service</th> -->
                                        <th scope="col" class="heading">DOS To</th>
                                        <th scope="col" class="heading">Sent</th>
                                        <th scope="col" class="heading">Fu Date</th>
                                        <th scope="col" class="heading">Level Of Care</th>
                                        <th scope="col" class="heading">Status</th>
                                        <th scope="col" class="heading">Facility</th>
                                        <th scope="col" class="heading">Worked Date</th>
                                        <th scope="col" class="heading">Worked Rep</th>
                                        <th scope="col" class="heading">Notes</th>
                                        <th scope="col" class="heading">Completed</th>
                                        <th scope="col" class="heading">Claim</th>
                                        <th scope="col" class="heading">Allowed</th>
                                        <th scope="col" class="heading">Paid</th>
                                        <th scope="col" class="heading">Interest</th>
                                        <th scope="col" class="heading">Coinsurance</th>
                                        <th scope="col" class="heading">Copay</th>
                                        <th scope="col" class="heading">Deductible</th>
                                        <th scope="col" class="heading">Date Paid</th>
                                        <th scope="col" class="heading">Cashed Date</th>
                                        <th scope="col" class="heading">Payer</th>
                                        <th scope="col" class="heading">Method</th>
                                        <th scope="col" class="heading">Payment</th>
                                        <th scope="col" class="heading">Bulk AMount</th>
                                        <th scope="col" class="heading">Created Date</th>
                                    </tr>
								</thead>
								<tbody>   
								
							<?php foreach($not_workable as $sj_data){ 
							//$sj_complete=$this->db->query("SELECT * FROM sjhealth_call_entry WHERE unique_id='".$sj_data->unique_id."' ");
							//$sjcom = $sj_complete->result();
							//if(!in_array($sjcom[0]->call_status, array("completed"),true)){?>
							<tr>
								<td><?php echo ucfirst($sj_data->system);?></td>
                                <td><?php echo ucfirst($sj_data->claim_id);?></td>
                                <td><?php echo ucfirst($sj_data->ins);?></td>
                                <td><?php echo ucfirst($sj_data->patient);?></td>
                                <td><?php echo ucfirst($sj_data->charge);?></td>
                                <td><?php echo ucfirst($sj_data->dos_from);?></td>
                                <td><?php echo ucfirst($sj_data->dos_to);?></td>
                                <td><?php echo ucfirst($sj_data->sent);?></td>
                                <td><?php echo ucfirst($sj_data->fu_date);?></td>
                                <td><?php echo ucfirst($sj_data->level_of_care);?></td>
                                <td><?php echo ucfirst($sj_data->status);?></td>
                                <td><?php echo ucfirst($sj_data->facility);?></td>
                                <td><?php echo ucfirst($sj_data->worked_date);?></td>
                                <td><?php echo ucfirst($sj_data->worked_rep);?></td>
                                <td><?php echo ucfirst($sj_data->notes);?></td>
                                <td><?php echo ucfirst($sj_data->completed);?></td>
                                <td><?php echo ucfirst($sj_data->claim);?></td>
                                <td><?php echo ucfirst($sj_data->allowed);?></td>
                                <td><?php echo ucfirst($sj_data->paid);?></td>
                                <td><?php echo ucfirst($sj_data->interest);?></td>
                                <td><?php echo ucfirst($sj_data->coinsurance);?></td>
                                <td><?php echo ucfirst($sj_data->copay);?></td>
                                <td><?php echo ucfirst($sj_data->deductible);?></td>
                                <td><?php echo ucfirst($sj_data->date_paid);?></td>
                                <td><?php echo ucfirst($sj_data->cashed_date);?></td>
                                <td><?php echo ucfirst($sj_data->payer);?></td>
                                <td><?php echo ucfirst($sj_data->method);?></td>
                                <td><?php echo ucfirst($sj_data->payment);?></td>
                                <td><?php echo ucfirst($sj_data->bulk_amount);?></td>
                                <td><?php echo $sj_data->created_date;?></td>

								
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