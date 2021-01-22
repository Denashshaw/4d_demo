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
						<div class="col-md-9 activity">Completed QAs :
							<?php
            					$query = $this->db->query("select client from client WHERE keyword = '".$_SESSION['loggedin_client']."' ");
            					$result = $query->first_row();
            					echo $result->client;
            				?>
						</div>
						<?php if($_SESSION['role'] == 'admin' && $_SESSION['loggedin_client'] != ''){ ?>
				            <div class="col-md-2 activity" style="padding-bottom: 20px;font-family: 'Montserrat', sans-serif;float: right;">
				            <form action="<?php echo base_url('home/changeCompleted_qa');?>" method="POST">
				            <select class="form-control"   name="client_name"  id="client_name" onchange="this.form.submit()">
				              <?php foreach ($clientlist as $client) { ?>
			                <option value='<?php echo $client->keyword; ?>'  <?php if($_SESSION['loggedin_client'] == $client->keyword){ ?> selected <?php } ?>><?php echo ucfirst($client->client); ?> </option>
			            <?php } ?>
				            </select>
				            </form>
				            </div>
				            <?php } ?>
					</div>

					<?php echo $this->session->flashdata('msg');?>

					<?php if($sj_health!=''){?>

					<div class="row emp-table">
						<div class="col-md-12 table-responsive">
						<!-- <div class="wrapper1">
    <div class="div1">
    </div>
</div>
<div class="wrapper2">
    <div class="div2">  -->
							<table class="table" id="mytable">
								<thead>
									<tr>
										<th scope="col" class="heading">Action</th>
										<th scope="col" class="heading">Emp Id</th>
										<th scope="col" class="heading">Emp Name</th>
										<th scope="col" class="heading">Date Assigned (MM/DD)</th>
                    <th scope="col" class="heading">Tags</th>

                    <th scope="col" class="heading" id="sl_ins" style="cursor:pointer;color:red !important;font-style:italic;">Date Range</th>
                    <th scope="col" class="heading">Claim</th>

                    <th scope="col" class="heading" id="sl" style="cursor:pointer;color:red !important;font-style:italic;">Clients Name</th>
                    <th scope="col" class="heading">Service</th>
                    <th scope="col" class="heading">Location</th>
                    <th scope="col" class="heading">Payor</th>
                    <th scope="col" class="heading">Billed</th>
                    <th scope="col" class="heading">Payment</th>
                    <th scope="col" class="heading">Adjustment</th>
                    <th scope="col" class="heading">Writeoff</th>
                    <th scope="col" class="heading">Balance</th>
                    <th scope="col" class="heading">Expected Revenue</th>
                    <th scope="col" class="heading">Expected Collection</th>
                    <th scope="col" class="heading">Internal Status</th>
                    <th scope="col" class="heading"> Status</th>
                    <th scope="col" class="heading">Allowed Amount</th>
                    <th scope="col" class="heading">Deductible</th>
                    <th scope="col" class="heading">CoInsurance</th>
                    <th scope="col" class="heading">Copay</th>
                    <th scope="col" class="heading">Amount Paid</th>
                    <th scope="col" class="heading">Date Paid</th>
                    <th scope="col" class="heading">Last Follow up Date</th>
                    <th scope="col" class="heading">Claim Notes</th>
                    <th scope="col" class="heading">Claim Numbers</th>
                    <th scope="col" class="heading">Check Numbers</th>
                    <th scope="col" class="heading">EFT Number</th>
                    <th scope="col" class="heading">Created Data</th>
									</tr>
								</thead>
								<tbody>

								<tr>
								<?php foreach($sj_health as $sj_data){
									$userdata =$this->session->all_userdata();
							    	$table_call_entry = $userdata['loggedin_client']."_call_entry";
								$sj_qa=$this->db->query("SELECT * FROM $table_call_entry WHERE unique_id='".$sj_data->unique_id."' ");
								$sjcom = $sj_qa->result();
									?>

								<td><span class="emp-break-in"><a href="<?php echo base_url();?>start_qa/completed_qa_data/<?php echo $sj_data->unique_id;?>" class="" target="_blank" ><button class="start-break" id="checkin">Completed QA</button></a></span>
								</td>
								<td><?php echo ucfirst($sjcom[0]->emp_id);?></td>
								<td><?php echo ucfirst($sjcom[0]->created_by);?></td>
								<td><?php $assign_date=substr($sj_data->created_date,5);
								echo substr($assign_date,0,-3);?></td>
                <td><?php echo ucfirst($sj_data->Tags);?></td>
								<td><?php echo ucfirst($sj_data->Date_Range);?></td>
								<td><?php echo ucfirst($sj_data->claim_id);?></td>

								<td><?php echo ucfirst($sj_data->patient);?></td>
								<td><?php echo ucfirst($sj_data->Service);?></td>
								<td><?php echo ucfirst($sj_data->Location);?></td>
								<td><?php echo ucfirst($sj_data->Payor);?></td>
								<td><?php echo ucfirst($sj_data->Billed);?></td>
								<td><?php echo ucfirst($sj_data->Payment);?></td>
								<td><?php echo ucfirst($sj_data->Adjustment);?></td>

								<td><?php echo ucfirst($sj_data->Writeoff);?></td>
								<td><?php echo ucfirst($sj_data->Balance);?></td>
								<td><?php echo ucfirst($sj_data->Expected_Revenue);?></td>
								<td><?php echo ucfirst($sj_data->Expected_Collection);?></td>

                <td><?php echo ucfirst($sj_data->Internal_Status);?></td>
                <td><?php echo ucfirst($sj_data->Status);?></td>
                <td><?php echo ucfirst($sj_data->Allowed_Amount);?></td>
                <td><?php echo ucfirst($sj_data->Deductible);?></td>

                <td><?php echo ucfirst($sj_data->CoInsurance);?></td>
                <td><?php echo ucfirst($sj_data->Copay);?></td>
                <td><?php echo ucfirst($sj_data->Amount_Paid);?></td>
                <td><?php echo substr($sj_data->Date_Paid,0,-8);?></td>
                <td><?php echo substr($sj_data->Last_Follow_up_Date,0,-8);?></td>
                <td><?php echo ucfirst($sj_data->Claim_Notes);?></td>
                <td><?php echo ucfirst($sj_data->Claim_Numbers);?></td>
                <td><?php echo ucfirst($sj_data->Check_Numbers);?></td>
                <td><?php echo ucfirst($sj_data->EFT_Number);?></td>
                <td><?php echo substr($sj_data->created_date,0,-8);?></td>
								</tr>

							<?php } } ?>
						</tbody>

					</table>
				<!-- </div></div> -->
						<div class="plinks"><?php echo $links;?></div>

						</div>
					</div>
				</div>

			</main>
		</div>
	</body>

<script type="text/javascript">
// $(function(){
//     $(".wrapper1").scroll(function(){
//         $(".wrapper2")
//             .scrollLeft($(".wrapper1").scrollLeft());
//     });
//     $(".wrapper2").scroll(function(){
//         $(".wrapper1")
//             .scrollLeft($(".wrapper2").scrollLeft());
//     });
// });

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
