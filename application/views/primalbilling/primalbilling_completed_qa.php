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
/*#contentofsite {
    height: 20px;
    overflow: hidden;
}
#showmemore:focus + #contentofsite {
    height: auto;
    overflow: visible;
}*/

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
								<td><?php echo ucfirst($sj_data->claim_note);?></td>				<!-- 	<div id="contentofsite"> </div>-->				
								<!-- <a href="#contentofsite" id="show_more">Show More</a> -->
								<td><?php echo ucfirst($sj_data->emp_id);?></td>
								<td><?php echo ucfirst($sj_data->created_date);?></td>
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
	// $('#show_more').click(function () {		
	//     $('#contentofsite').css("height", "auto");	
	// });
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