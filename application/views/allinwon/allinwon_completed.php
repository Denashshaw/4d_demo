<body>
<style type="text/css">
.brktime td{
line-height:25px;
}
.plinks{
  margin-left:30%;
    font-size: 20px;
  }
  .plinks a{
    margin-left: 10px;
    font-size: 20px;
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
						<div class="col-md-12 activity">Completed Claims :12 
							<?php
								$query = $this->db->query("select client from client WHERE keyword = '".$_SESSION['loggedin_client']."' ");
								$result = $query->first_row();
								echo $result->client;
							?>
						</div>
					</div>

					<?php echo $this->session->flashdata('msg');?>

					<?php if($sj_health!=''){?>

					<div class="row emp-table">
						<div class="col-md-12 table-responsive">
							<table class="table" id="tabledata">
								<thead>
									<tr>
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

							<tr>
								<?php foreach($sj_health as $sj_data){
				               ?>

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

						<?php }} ?>
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
