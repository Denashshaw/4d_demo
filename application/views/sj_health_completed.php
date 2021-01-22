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
						<div class="col-md-12 activity">Completed Claims : 
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
									<!-- <th scope="col">Emp Id</th> -->
										<!-- <th scope="col" class="heading">Action</th> -->
                    <?php
                      if($logedinuser != 'sandstone'){
                     ?>
										<th scope="col" class="heading">Notes</th>
                    <?php
                  } ?>
										<th scope="col" class="heading">Date Assigned (MM/DD)</th>

										<th scope="col" class="heading" id="sl_ins" style="cursor:pointer;color:red !important;font-style:italic;">Insurance</th>
										<th scope="col" class="heading">Facility</th>

										<th scope="col" class="heading">Claim Id</th>
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
								</thead>
								<tbody>

							<tr>
								<?php foreach($sj_health as $sj_data){
                  $userdata =$this->session->all_userdata();
                  $table_call_entry = $userdata['loggedin_client']."_call_entry";
								$sql=$this->db->query("SELECT * FROM $table_call_entry WHERE unique_id='".$sj_data->unique_id."' ");
								$sj_notes = $sql->result();?>
                <?php
                  if($logedinuser != 'sandstone'){
                 ?>
								<td><?php echo ucfirst($sj_notes[0]->notes);?></td>
              <?php } ?>
								<td><?php $assign_date=substr($sj_data->created_date,5);
								echo substr($assign_date,0,-3);?></td>

								<td><?php echo ucfirst($sj_data->insurance);?></td>
								<td><?php echo ucfirst($sj_data->facility);?></td>
        
								<td><?php echo ucfirst($sj_data->claim_id);?></td>
								<td><?php echo ucfirst($sj_data->patient);?></td>
								<td><?php echo ucfirst($sj_data->status);?></td>
								<td><?php echo ucfirst($sj_data->service);?></td>
								<td><?php $dos_start=substr($sj_data->dos_start,0,-8);
								echo $dos_start;?></td>
								<td><?php $dos_end=substr($sj_data->dos_end,0,-8);
								echo $dos_end;?></td>
								<td><?php echo ucfirst($sj_data->charges);?></td>
								<td><?php $follow_up=substr($sj_data->follow_up,0,-8);
								echo $follow_up;?></td>
								<td><?php echo ucfirst($sj_data->last_action_date);?></td>
								<td><?php echo ucfirst($sj_data->days_outstanding);?></td>
								<td><?php echo ucfirst($sj_data->queue);?></td>
								<td><?php echo ucfirst($sj_data->assigned_to_client);?></td>
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
