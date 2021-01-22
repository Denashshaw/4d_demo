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
						<div class="col-md-9 activity">Reallocate Claims</div>
              <?php if($_SESSION['role'] == 'admin' && $_SESSION['loggedin_client'] != ''){ ?>
              <div class="col-md-2 activity" style="font-family: 'Montserrat', sans-serif;">
                <form action="<?php echo base_url('home/changeReallocateClaims');?>" method="POST">
                  <select class="form-control"   name="client_name"  id="client_name" onchange="this.form.submit()">
                          <?php foreach ($clientlist as $client) { ?>
                            <option value='<?php echo $client->keyword; ?>'  <?php if($_SESSION['loggedin_client'] == $client->keyword){ ?> selected <?php } ?>><?php echo ucfirst($client->client); ?> </option>
                        <?php } ?>
                  </select>
                </form>
              </div>
            </div>
            <?php } ?>
            <?php echo $this->session->flashdata('msg');?>
					<div class="row emp-table">
	          <!-- <form action="<?php echo base_url();?>client/add_client" method="post" enctype="multipart/form-data">
              <div class="field_wrapper">
                <div class="row">
                  <div class="col-md-12">
                    <p class="">Enter Client Name:</p>
                    <input type="text" name="client[]" id="clientval" placeholder="Enter Client" class="col-md-12 col-xs-12 form-control" required=""/>
                  </div>
                </div>
              </div>
              <br><input type="submit" name="csubmit" value="submit" class="check-in">
            </form> -->
              <!-- <div class="col-md-3" style="margin-top:4%;">
                <a href="javascript:void(0);" title="Add field">
                  <button class="add_button start-break">Add</button>
                </a>
              </div> -->
                  <div class="col-md-12 table-responsive">
                    <table class="table" id="tabledata">
                      <thead>
                        <tr>
                          <th scope="col">Agent Id</th>
                          <th scope="col">Agent Name</th>
                          <th scope="col">Claim Count</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                              <?php foreach ($claims_report as $key => $value) { ?>
                                <?php if($value->emp_id != ''){ ?>
                                <tr>
                                  <td><span class="emp-id"><?php echo ucfirst($value->emp_id);?></span></td>
                                  <td><?php echo ucfirst($value->emp_name);?></td>
                                  <td><?php echo ucfirst($value->total);?></td>
                                  <td><a href="<?php echo base_url('home/reallocate_claims/').$value->emp_id;?>" class="btn btn-sm btn-success">Reassign</a></td>
                                  <?php } ?>
                                </tr>
                              <?php } ?>
                      </tbody>
                    </table>
                  </div>
				      </div>
			  </div>
		  </div>
	  </div>
  </main>
</div>
<div style="padding-top:1px;" class="modal fade" role="dialog" id="addBookDialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="mons modal-title">Update Client</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body mons">
				<form action="<?php echo base_url();?>client/update_client" method="post">
        <p>Client:</p>
        <input type="text" name="clientnameold" id="clientnameold" value="" style="display:none"/>
				<input type="text" name="clientnamenew" id="clientnamenew" value="" />
				<br>
				<input type="submit" class="btn btn-success" value="Update">
			</form>

		</div>
		  </div>
			  </div>
</div>

</body>
</html>
