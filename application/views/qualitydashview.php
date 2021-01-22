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

<?php error_reporting(0);
include('header.php');?>
	<main class="page-content">
		<div class="container-fluid p-0">
			<div class="row">
				<div class="col-12 col-md-12 content">
					<div class="row head-content">
						<div class="col-9 col-md-4 logo"><img src="<?php echo base_url();?>img/logo.jpg"></div>
						<div class="col-3 col-md-8 text-right logout"><a href="<?php echo base_url();?>login/signout">Logout</a></div>
					</div>

					<div class="row activity-row">
						<div class="col-md-9 activity">Quality Dashboard :
							<?php echo ucfirst($_SESSION['loggedin_client']); ?>
						</div>

						<?php if($_SESSION['role'] == 'admin' && $_SESSION['loggedin_client'] != ''){ ?>
			            <div class="col-md-2 activity" style="padding-bottom: 20px;font-family: 'Montserrat', sans-serif;float: right;">
			            <form action="<?php echo base_url('qualitydash/changeQaModuleDash');?>" method="POST">
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

          <div class="row emp-table">
            <div class="col-md-12 table-responsive">

			            <form method="post" action="<?php echo base_url();?>qualitydash/getReport" id="expreport" class="expreport">
			                <div class="row">
								<div class="col-md-3">
									<p>From Date</p>
				                  <input type="text" class="form-control" placeholder="FromDate" name="fromdate" id="fromdate" required="" value="<?php echo $dataset['fromDate'];?>" readonly>
								</div>
								<div class="col-md-3">
									<p>To Date</p>
				                  	<input type="text" class="form-control" placeholder="ToDate" name="todate" id="todate" required="" value="<?php echo $dataset['toDate'];?>" readonly>
								</div>
								<div class="col-md-3">
									<p>Agent:</p>
				                  	<select class="form-control" id="agentname" name="agentname">
				                  		<option value="all" <?php if($dataset['agent'] == 'all'){ echo "selected"; }?>>All</option>
				                  		<?php foreach ($agentlist as $value) {
				                  			# code...
				                  			?><option value="<?php echo $value->emp_id; ?>"  <?php if($dataset['agent'] == $value->emp_id){ echo "selected"; }?>><?php echo $value->name; ?></option><?php

				                  		}
				                  		?>
				                  	</select>
								</div>
								<div class="col-md-3"><br>
									<input type="submit" class="btn btn-success">
								</div>
							</div>
						</form>
						<div class="row">
							<div class="card col-md-4 text-center text-white bg-secondary " style="max-width:250px;margin-left:5%">
								<div class="card-body">
									<p style="">Total Productiuon</p>
									<h2><?php echo array_sum( array_column($qa_viewReport,'production')); ?></h2>
								</div>
							</div>
							<div class="card  col-md-4  text-center text-white bg-danger"  style="max-width:250px;margin-left:5%">
								<div class="card-body">
									<p style="">Total QA Claims</p>
									<h2><?php echo array_sum( array_column($qa_viewReport,'Audited')); ?></h2>
								</div>
							</div>
							<div class="card col-md-4  text-center text-white bg-success"  style="max-width:250px;margin-left:5%">
								<div class="card-body">
									<p style=""> Quality Percentage</p>
									<h2 id="qualiview">0%</h2>
								</div>
							</div>
						</div>
              <table class="table" id="mytable">
                <thead style="text-align:center">
                  <tr>
                    <th scope="col" class="heading">S.No</th>
                    <th scope="col" class="heading">Agent</th>
                    <th scope="col" class="heading">Production</th>
                    <th scope="col" class="heading">QA Claims</th>
                    <!-- <th scope="col" class="heading">Audit %</th> -->
                    <th scope="col" class="heading">Internal Error</th>
                    <th scope="col" class="heading">External Error</th>
                    <th scope="col" class="heading">Quality %</th>
                  </tr>
                </thead>
                <tbody style="text-align:center">
                   <?php
                      $i=0;
                      $j=0;
                      $sumofqula=0;
                      foreach($qa_viewReport as $data){
                      	$qualityval=(!is_nan((($data->Audited - $data->nooferror)/ $data->Audited)*100) ? ((($data->Audited - $data->nooferror)/$data->Audited)*100) : 0);
                       ?>
                      <tr>
                        <td><?php echo $i+1;?></td>
                        <td><?php echo ucfirst($data->emp_id." / ".$data->emp_name);?></td>
                        <td><?php echo $data->production;?></td>
                        <td><?php echo $data->Audited;?></td>
                       <!--  <td><?php echo (!is_nan(($data->Audited/$data->production)*100) ? (($data->Audited/$data->production)*100) : 0)."%";?></td> 
                        <td><?php echo $data->nooferror;?></td>-->
                        <td><?php echo $data->internalerror;?></td>
                        <td><?php echo $data->externalerror;?></td>

                        <td><?php echo $qualityval."%";?></td>
                      </tr>

                    <?php
                    if($qualityval != 0){
                    	$sumofqula += $qualityval;
                    	$j++;
                    }


                    $i++;
                  } ?> 
                </tbody>
              </table>
            </div>
          </div>
          <script type="text/javascript">
          		$('#qualiview').html(<?php echo $sumofqula/$j; ?>+'%');
          </script>
					</div>

			</main>
		</div>
	</body>

<script type="text/javascript">
 $('#fromdate').datetimepicker();
    $('#todate').datetimepicker();
</script>
</html>
