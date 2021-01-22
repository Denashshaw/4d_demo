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
$logedinuser =  $this->session->userdata('loggedin_client') ;
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
						<form action="<?php echo base_url('home/changeClient');?>" method="POST">
						<select class="form-control"   name="client_name"  id="client_name" onchange="this.form.submit()">
			              <?php foreach ($clientlist as $client) { ?>
			                <option value='<?php echo $client->keyword; ?>'  <?php if($_SESSION['loggedin_client'] == $client->keyword){ ?> selected <?php } ?>><?php echo ucfirst($client->client); ?> </option>
			            <?php } ?>
						</select>
						</form>
						</div>
						<?php } ?><br><br>

						<div class="col-md-12">
							<div class="row">
						 		<div class="col-md-2 activity"> Assigned  : <?php echo $claims_count[0]->assigned;?></div>
						 		<div class="col-md-2 activity"> Completed : <?php echo $counts[0]->completed;?></div>
						 		<?php $pending = $claims_count[0]->assigned - ($counts[0]->completed + $counts[0]->not_workable);?>
						 		<div class="col-md-2 activity"> Pending      : <?php  if($pending > 0){ echo $pending; }else{ echo "0"; }?></div>
						 		<div class="col-md-2 activity"> Not Workable : <?php echo $counts[0]->not_workable;?></div>
						 		<div class="col-md-4 activity">

						 			<div class="form-group has-search">
						 				<form method="post" action="<?php echo base_url();?>/home/index" >
										<span class="fa fa-search form-control-feedback"></span>

										<input type="text" class="search-input" placeholder="Search Insurance" name="ins_value" id="search" value="<?php echo $_POST['ins_value'];?>">
										<input type="submit" name="search" class="check-in search-btn" value="search">
									</form>
									</div>
						 		</div>
							</div>
						</div>
					</div>

					<?php echo $this->session->flashdata('msg');?>

					<?php if($sj_health!=''){?>

					<div class="row emp-table">
						<div class="col-md-12 table-responsive">
							<table class="table" id="mytable">
								<thead>
									<tr>
										<!-- <th scope="col">Emp Id</th> -->
										<th scope="col" class="heading">Action</th>

										<th scope="col" class="heading">Account</th>
										<th scope="col" class="heading" id="sl_ins" style="cursor:pointer;color:red !important;font-style:italic;">Patient Name</th>
										<th scope="col" class="heading">Charge Code</th>
										<th scope="col" class="heading">Charge Amount</th>
										<th scope="col" class="heading">Date</th>
										<th scope="col" class="heading" id="sl" style="cursor:pointer;color:red !important;font-style:italic;">Date Filed</th>
										<th scope="col" class="heading">Insurance</th>
										<th scope="col" class="heading">Date Paid</th>
										<th scope="col" class="heading">Allowed</th>
										<th scope="col" class="heading">Deductible</th>
										<th scope="col" class="heading">Coins</th>
										<th scope="col" class="heading">Adjusted</th>
										<th scope="col" class="heading">Paid</th>
										<th scope="col" class="heading">Other payments</th>
										<th scope="col" class="heading">Quantity</th>
										<th scope="col" class="heading">Due</th>
										<th scope="col" class="heading">Provider</th>
										<th scope="col" class="heading">Location</th>
										<th scope="col" class="heading">Ar Comments</th>
										<th scope="col" class="heading">Status Code</th>
										<th scope="col" class="heading">Date Worked</th>
									</tr>
								</thead>
								<tbody>

							<?php
							foreach($sj_health as $sj_data){ ?>							
							<tr>
								<?php
			                  	$userdata =$this->session->all_userdata();
			                  	$table_call_entry = $userdata['loggedin_client']."_call_entry";
								$sj_complete=$this->db->query("SELECT * FROM $table_call_entry WHERE unique_id='".$sj_data->unique_id."' ");
								$sjcom = $sj_complete->result();
								// echo $sjcom[0]->unique_id;
								// echo $sjcom[0]->call_status;exit;
								if($sjcom[0]->call_status!="completed"){?>
								<!-- <th scope="row"><span class="emp-id"><?php echo $sj_data->emp_id;?></span></th> -->
								<td><span class="emp-break-in"><a href="<?php echo base_url();?>start_call/index/<?php echo $sj_data->unique_id;?>" class="" target="_blank" ><button class="check-in" id="checkin">Start</button></a></span>
								</td>
								<td><?php echo ucfirst($sj_data->claim_id);?></td>
								<td><?php echo ucfirst($sj_data->patient);?></td>                
								<td><?php echo ucfirst($sj_data->charge_code);?></td>
								<td><?php echo ucfirst($sj_data->charge_amount);?></td>
								<td><?php echo ucfirst($sj_data->date);?></td>
								<td><?php echo ucfirst($sj_data->date_filed);?></td>
								<td><?php echo ucfirst($sj_data->insurance);?></td>
								<td><?php echo ucfirst($sj_data->date_paid);?></td>
								<td><?php echo ucfirst($sj_data->allowed);?></td>
								<td><?php echo ucfirst($sj_data->deductible);?></td>
								<td><?php echo ucfirst($sj_data->coins);?></td>
								<td><?php echo ucfirst($sj_data->adjusted);?></td>
								<td><?php echo ucfirst($sj_data->paid);?></td>
								<td><?php echo ucfirst($sj_data->other_payment);?></td>
								<td><?php echo ucfirst($sj_data->quantity);?></td>
								<td><?php echo ucfirst($sj_data->amount_due);?></td>
								<td><?php echo ucfirst($sj_data->provider);?></td>
								<td><?php echo ucfirst($sj_data->location);?></td>
								<td><?php echo ucfirst($sj_data->ar_comments);?></td>
								<td><?php echo ucfirst($sj_data->status_code);?></td>
								<td><?php echo ucfirst($sj_data->date_worked);?></td>
							</tr>

						<?php }} } ?>
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
	var search_val = document.getElementById('search').value;
	$(document).ready(() => {
		if(search_val != '') {
			var page_link = document.getElementsByClassName('plinks');		
			page_link[0].style.display='none';
		}
	});
	
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
