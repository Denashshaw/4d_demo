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
.search-input{
	width:50% !important;
}
.search-btn{
	margin-top:-11%;
	margin-left:55%;
}
</style>

<div class="page-wrapper chiller-theme toggled">

<?php include('header.php');
// $logedinuser =  $this->session->userdata('loggedin_client') ;
?>
	<main class="page-content">
		<div class="container-fluid p-0">
			<div class="row">
				<div class="col-12 col-md-12 content">
					<div class="row head-content">
						<div class="col-9 col-md-4 logo"><img src="<?php echo base_url();?>img/logo.jpg"></div>
						<div class="col-3 col-md-8 text-right logout"><a href="<?php echo base_url();?>login/signout">Logout</a></div>
					</div>

					<div class="row activity-row">
            			<div class="col-md-9 activity">Claims Assigned:
            				<?php
            					$query = $this->db->query("select client from client WHERE keyword = '".$_SESSION['loggedin_client']."' ");
            					$result = $query->first_row();
            					echo $result->client;
            				?>
						</div><br><br>
						<?php if($_SESSION['role'] == 'admin' && $_SESSION['loggedin_client'] != ''){ ?>
						<div class="col-md-2 activity" style="padding-bottom: 20px;font-family: 'Montserrat', sans-serif;">
						<form action="<?php echo base_url('changeAllocateClient');?>" method="POST">
						<select class="form-control"   name="client_name"  id="client_name" onchange="this.form.submit()">
			              <?php foreach ($clientlist as $client) { ?>
			                <option value='<?php echo $client->keyword; ?>'  <?php if($_SESSION['loggedin_client'] == $client->keyword){ ?> selected <?php } ?>><?php echo ucfirst($client->client); ?> </option>
			            <?php } ?>
						</select>
						</form>
						</div>
						<?php } ?><br><br>
					</div><br>
					<?php echo $this->session->flashdata('msg');?>

					<div class="row emp-table">
						<div class="col-md-12 table-responsive">
							<form action="<?php echo base_url('home/reupdate_claims'); ?>" method="POST">
							<div class="col-md-4">
								<label>Allocate FROM</label>
								<select class="form-control">
									<option value="<?php echo $agent_detail[0]->emp_id;?>"><?php echo $agent_detail[0]->emp_name;?></option>
								</select>
							</div>
							<div class="col-md-4">
								<label>Allocate TO</label>
								<select name="emp_name" class="form-control">
									<?php foreach ($all_agents as $key => $value) { 
										// if($value->emp_id == $agent_detail[0]->emp_id){
										// 	unset($value->emp_id[$key]);
										// }
										?>
										<option value="<?php echo $value->emp_id;?>"><?php echo ucfirst(strtolower($value->name)); ?></option>
									<? } ?>
								</select>
							</div><br>
							<div class="col-md-2">
								<button type="submit" class="btn btn-primary">SUBMIT</button>
							</div>
							<br><br> <br>
							<table class="table" id="mytable">
								<thead>
									<tr>
										<!-- <th scope="col">Emp Id</th> -->
										<th scope="col" class="heading">Action</th>
										<th scope="col" class="heading">Date Assigned (MM/DD)</th>

										<th scope="col" class="heading">Insurance</th>
										<th scope="col" class="heading">Facility</th>

										<th scope="col" class="heading" id="sl_ins" style="cursor:pointer;color:red !important;font-style:italic;">Claim Id</th>
										<th scope="col" class="heading" id="sl" style="cursor:pointer;color:red !important;font-style:italic;">Patient Name</th>
										<th scope="col" class="heading">Status</th>
										<th scope="col" class="heading">Service</th>
										<th scope="col" class="heading">DOS Start</th>
										<th scope="col" class="heading">DOS End</th>
										<th scope="col" class="heading">Charges</th>
										<th scope="col" class="heading">Follow Up</th>
										<th scope="col" class="heading">Last Action Date</th>
										<th scope="col" class="heading">Days Outstanding</th>
										<th scope="col" class="heading">Queue</th>
										<th scope="col" class="heading">Assngned to Client</th>
									</tr>
								</thead>
								<tbody>

							<?php foreach($agent_detail as $claims_data){ ?>
							<tr>
								<td><input type="checkbox" name="claims_id[]" value="<?php print_r($claims_data->id); ?>"></td>
								<td><?php print_r($claims_data->created_date); ?></td>
								<td><?php print_r($claims_data->insurance); ?></td>
								<td><?php print_r($claims_data->facility); ?></td>
								<td><?php print_r($claims_data->claim_id); ?></td>
								<td><?php print_r($claims_data->patient); ?></td>
								<td><?php print_r($claims_data->status); ?></td>
								<td><?php print_r($claims_data->service); ?></td>
								<td><?php print_r($claims_data->dos_start); ?></td>
								<td><?php print_r($claims_data->dos_end); ?></td>
								<td><?php print_r($claims_data->charges); ?></td>
								<td><?php print_r($claims_data->follow_up); ?></td>
								<td><?php print_r($claims_data->last_action_date); ?></td>
								<td><?php print_r($claims_data->days_outstanding); ?></td>
								<td><?php print_r($claims_data->queue); ?></td>
								<td><?php print_r($claims_data->assigned_to_client); ?></td>

							</tr>
							</form>
						<?php } //} ?>
				</tbody>

					</table>
					<?php if($_POST['ins_value'] ==''){ ?>
						<div class="plinks"><?php echo $links;?></div>
					<?php } ?>
						</div>
					</div>
				</div>

			</main>
		</div>
	</body>

<script type="text/javascript">
	function sortTable(f,n){
    var rows = $('#mytable tbody  tr').get();
    rows.sort(function(a, b){
        var A = getVal(a);
        var B = getVal(b);

        if(A < B){
          return -1*f;
        }
        if(A > B){
          return 1*f;
        }
        return 0;
    });

    function getVal(elm){
        var v = $(elm).children('td').eq(n).text().toUpperCase();
        if($.isNumeric(v)){
          v = parseInt(v,10);
        }
        return v;
    }

    $.each(rows, function(index,row){
      $('#mytable').children('tbody').append(row);
    });
}

var f_sl = 1;
$("#sl").click(function(){
    f_sl *= -1;
    var n = $(this).prevAll().length;
    sortTable(f_sl,n);
});
$("#sl_ins").click(function(){
    f_sl *= -1;
    var n = $(this).prevAll().length;
    sortTable(f_sl,n);
});

</script>
</html>
