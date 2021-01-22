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
						<div class="col-md-9 activity">QA Dashboard :
							<?php echo ucfirst($_SESSION['loggedin_client']); ?>
						</div>

						<?php if($_SESSION['role'] == 'admin' && $_SESSION['loggedin_client'] != ''){ ?>
			            <div class="col-md-2 activity" style="padding-bottom: 20px;font-family: 'Montserrat', sans-serif;float: right;">
			            <form action="<?php echo base_url('Start_qa/changeQaModuleDash');?>" method="POST">
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
              <table class="table" id="mytable">
                <thead style="text-align:center">
                  <tr>
                    <th scope="col" class="heading">S.No</th>
                    <th scope="col" class="heading">Agent</th>
                    <th scope="col" class="heading">Production</th>
                    <th scope="col" class="heading">Audited</th>
                    <th scope="col" class="heading">Audit %</th>
                    <th scope="col" class="heading">Total Error</th>
                    <th scope="col" class="heading">Quality %</th>
                  </tr>
                </thead>
                <tbody style="text-align:center">
                  <?php
                      $i=0;
                      foreach($qa_viewReport as $data){ ?>
                      <tr>
                        <td><?php echo $i+1;?></td>
                        <td><?php echo ucfirst($data->emp_id." / ".$data->emp_name);?></td>
                        <td><?php echo $data->production;?></td>
                        <td><?php echo $data->Audited;?></td>
                        <td><?php echo (!is_nan(($data->Audited/$data->production)*100) ? (($data->Audited/$data->production)*100) : 0)."%";?></td>
                        <td><?php echo $data->nooferror;?></td>
                        <td><?php echo (!is_nan(($data->nooferror/$data->Audited)*100) ? (($data->nooferror/$data->Audited)*100) : 0)."%";?></td>
                      </tr>

                    <?php
                    $i++;
                  } ?>
                </tbody>
              </table>
            </div>
          </div>



					<!-- <?php
					if($qa_viewReport!=''){?>

					<div class="row emp-table">
						<div class="col-md-12 table-responsive">
							<table class="table" id="mytable">
								<thead>
									<tr>
										<th scope="col" class="heading">SL</th>
										<th scope="col" class="heading">Claim Id</th>
										<th scope="col" class="heading">Patient Name</th>
										<th scope="col" class="heading">Agent Name</th>
										<th scope="col" class="heading">Production Date</th>
										<th scope="col" class="heading">Error Identified on</th>
										<th scope="col" class="heading">No. Of Errors</th>
										<th scope="col" class="heading">Types Of Error</th>
										<th scope="col" class="heading">Error Details</th>
										<th scope="col" class="heading">QA Notes</th>
										<th scope="col" class="heading">Error Category</th>
										<th scope="col" class="heading">Notes</th>
										<th scope="col" class="heading">DPO</th>
										<th scope="col" class="heading">Error Correction Responses</th>
								</thead>
								<tbody>

							<?php foreach($qa_details as $sj_data){ ?>
							<tr>
								<td><?php echo ucfirst($sj_data->emp_id);?></td>
								<td><?php echo ucfirst($sj_data->claim_id);?></td>
								<td><?php echo ucfirst($sj_data->patient);?></td>
								<td><?php echo ucfirst($sj_data->emp_name);?></td>
								<td><?php echo ucfirst($sj_data->c_date);?></td>
								<td><?php echo ucfirst($sj_data->qa_date);?></td>
								<td><?php echo ucfirst($sj_data->total);?></td>
								<td><?php echo ucfirst($sj_data->error_type);?></td>
								<td><?php echo ucfirst($sj_data->error_description);?></td>
								<td><?php echo ucfirst($sj_data->qa_notes);?></td>
								<td><?php echo ucfirst($sj_data->fatal_error == 'YES'? 'Fatal Error': 'Not Fatal Error');?></td>
								<td><?php echo ucfirst($sj_data->notes);?></td>
								<td><?php echo ucfirst($sj_data->total);?></td>
								<td><?php echo 500;?></td>
								</tr>

						<?php }} ?>
				</tbody>

					</table>


						</div>
					</div> -->
				</div>

			</main>
		</div>
	</body>

<script type="text/javascript">

</script>
</html>
