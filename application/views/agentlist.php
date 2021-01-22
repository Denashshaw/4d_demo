<body>
<div class="page-wrapper chiller-theme toggled">
<?php $userdata=$this->session->all_userdata(); ?>
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
						<div class="col-md-9 activity">Agent List</div>
            <?php if($_SESSION['role'] == 'admin' && $_SESSION['loggedin_client'] != ''){ ?>
            <div class="col-md-2 activity" style="padding-bottom: 20px;font-family: 'Montserrat', sans-serif;float: right;">
            <form action="<?php echo base_url('home/changeClientAgent');?>" method="POST">
            <select class="form-control"   name="client_name"  id="client_name" onchange="this.form.submit()">
              <?php foreach ($clientlist as $client) { ?>
                      <option value='<?php echo $client->keyword; ?>'  <?php if($_SESSION['loggedin_client'] == $client->keyword){ ?> selected <?php } ?>><?php echo ucfirst($client->client); ?> </option>
                  <?php } ?>
            </select>
            </form>
            </div>
            <?php } ?>
					</div>
          <!--<div class="form-group has-search">
            <span class="fa fa-search form-control-feedback"></span>
            <input type="text" class="search-input" placeholder="Search" id="search" style="width:15% !important;">
          </div> -->

          <?php echo $this->session->flashdata('msg');?>

					<div class="row emp-table">
						<div class="col-md-12 table-responsive">
							<table class="table" id="tabledata">
								<thead>
									<tr>
                    <th scope="col">Employee</th>
										<th scope="col">Emp ID</th>
										<th scope="col">Name</th>
										<th scope="col">Username</th>
										<th scope="col">Role</th>
										<th scope="col">Dept</th>
										<th scope="col">Client</th>
										<th scope="col">Action</th>
								</thead>
								<tbody>
								<?php
									if($agent_data!=''){?>
								<tr>
								<?php foreach($agent_data as $agentdata){ ?>
                <td><img src="<?php echo base_url();?>emp_images/<?php echo $agentdata->emp_image;?>" alt="" style="width:100px;border-radius:100px;"></td>
								<th scope="row"><span class="emp-id"><?php echo $agentdata->emp_id;?></span></th>
								<td><?php echo ucfirst($agentdata->name);?></td>
								<td><?php echo ucfirst($agentdata->username);?></span></td>
								<td><?php echo ucfirst($agentdata->role);?></span></td>
								<td><?php echo ucfirst($agentdata->department);?></span></td>
                <?php
                  $query = $this->db->query("SELECT client FROM client WHERE keyword IN ('" . str_replace(",", "','", $agentdata->client) . "') ");
                  // echo $this->db->last_query();
                  $result = $query->result_array();

                  $resultstr = array();
                  foreach ($result as $results) {
                    $resultstr[] = $results['client'];
                  }
                  ?>
                <td><?php echo implode(", ",$resultstr); ?></span></td>
                <td>
									<?php if(strtolower($userdata['role']) == 'admin' || ($userdata['role'] == 'manager' && $userdata['department'] == 'Data')){
										if($agentdata->activestatus == '1'){
										?>
										<a onclick="Deactivate(`<?php echo $agentdata->emp_id;?>`)" style="color:green;padding-right:5%; cursor: pointer;">Deactivate</a>
										<span class="emp-break-in"><a href="javaScript:void(0)" class="" data-toggle="modal" data-target="#edit_Modal_<?php echo $agentdata->id;?>" style=" cursor: pointer;">Edit</a></span>
	                <?php if($userdata['role'] == "admin"){ ?>
	                <span class="emp-break-out"><a href="<?php echo base_url()?>adduser/deleteuser/<?php echo $agentdata->id;?>" onClick="return doconfirm();" style="color:red;">Delete</a></span>
								<?php } ?>
									<?php }else{ ?>

											<a onclick="Activate(`<?php echo  $agentdata->emp_id;?>`,)" style="color:green;padding-right:5%; cursor: pointer;">Activate</a>
									<?php  } ?>

									<?php } ?>
								</td>
								</tr>

<!-- Update Agent Modal -->
<!--  -->
<div style="padding-top:1px;" class="modal fade agentupdatem" id="edit_Modal_<?php echo $agentdata->id;?>" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="mons modal-title">Update Agent</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body mons">
        <form method="post" action="<?php echo base_url();?>adduser/updateuser" id="formcheck" enctype="multipart/form-data">
          <p class="">Employee ID:</p>
           <input class="col-md-12 col-xs-12 form-control" type="hidden" id="userid" name="userid" placeholder="Emp ID" required="" value="<?php echo $agentdata->user_id;?>" readonly>
          <input class="col-md-12 col-xs-12 form-control" type="text" id="emp_id" name="emp_id" placeholder="Emp ID" required="" value="<?php echo $agentdata->emp_id;?>" readonly>
          <p class="">Employee Name:</p>
          <input class="col-md-12 col-xs-12 form-control" type="text" id="name" name="name" placeholder="Name" required="" value="<?php echo $agentdata->name;?>">
          <p class="">User Name:</p>
          <input class="col-md-12 col-xs-12 form-control" type="text" id="username" name="username" placeholder="UserName" required="" value="<?php echo $agentdata->username;?>">

          <p class="">Role:</p>
          <select class="form-control" name="role" required="">
            <option value="">--Select--</option>
            <option value="manager" <?php if($agentdata->role=="manager") echo 'selected="selected"'; ?>>Manager</option>
            <option value="agent" <?php if($agentdata->role=="agent") echo 'selected="selected"'; ?>>Agent</option>
            <option value="supervisor" <?php if($agentdata->role=="supervisor") echo 'selected="selected"'; ?>>Supervisor</option>
            <option value="qa" <?php if($agentdata->role=="qa") echo 'selected="selected"'; ?>>QA</option>
          </select><br>
          <?php
            $sql=$this->db->query("SELECT * FROM department");
            $dep=$sql->result();
          ?>

          <p class="">Department:</p>
            <select class="form-control" name="department" required="">
            <option value="">--Select--</option>
            <option value="Voice" <?php if($agentdata->department=="Voice") echo 'selected="selected"';?>>Voice</option>
            <option value="Data" <?php if($agentdata->department=="Data") echo 'selected="selected"'; ?>>Data</option>
            <option value="Qa" <?php if($agentdata->department=="Qa") echo 'selected="selected"'; ?>>QA-Team</option>
            </select><br>

          <?php
            $client=explode(',',$agentdata->client);
            $clisql=$this->db->query("SELECT * FROM client");
            $client_data=$clisql->result();
          ?>
          <p class="">Client:</p>
          <input type="checkbox" id="selectAllupdate"> <label for="selectAllupdate" style="font-size: 12px;">Select All Clients</label>
          <select data-placeholder="Choose Client..." class="chosen-select form-control" multiple tabindex="4" id="chosen-select" name="client[]" required="">
          <!-- <option value=""></option> -->
          <?php foreach($client_data as $cli){ ?>
            <option value="<?php echo trim($cli->keyword);?>" <?php if(in_array($cli->keyword, $client) == 1) echo 'selected="selected"'; ?>><?php echo $cli->client; ?></option>
          <?php } ?>
          </select>
          <br><br>

          <!-- <p class="">Employee Image:</p>
          <img src="<?php echo base_url();?>emp_images/<?php echo $agentdata->emp_image;?>" alt="" style="width:100px;border-radius:100px;"><br><br>
          <inpt type="text" id="edit_emp_image" name="edit_emp_image" value="<?php echo $agentdata->emp_image;?>">
          <input type="file" name="profile_img" id="profile_img" accept=".png,.jpg,.jpeg"> -->
          <p class="">Employee Image:</p><p  id="ides"></p>
          <img id="myImg<?php echo $agentdata->id;?>" src="<?php echo base_url(); ?><?php echo 'emp_images/'.$agentdata->emp_image; ?>" width="100" height="100">
          <br><br>

          <label class="btn btn-success btn-xs" style="color: white !important;font-size: 12px;">Choose image
            <input type="file"  onchange="updatecheckimage(this)" name="profile_img" id="profile_img<?php echo $agentdata->id;?>" style="display: none;" value="<?php echo base_url();?><?php echo 'emp_images/'.$agentdata->emp_image;?>" class="updateimage" />
          </label>
          <br><br>
          <br><br>

            <input type="submit" name="fupdate"  id="submitbtn" class="apply formSubmit" value="Submit" >
            <input type="button" value="Cancel" class="apply" data-dismiss="modal" >
        </form>
        <span class="blinking" id="ajaxmsg" style="color:#337ab7;font-size:15px;position:relative;top:7px;font-weight:800;"></span>
      </div>
    </div>
    <script>
    $('#edit_Modal_<?php echo $agentdata->id;?> #selectAllupdate').click(function(){
      if($('#edit_Modal_<?php echo $agentdata->id;?> #selectAllupdate').prop("checked")){
        $(" #chosen-select option").prop('selected', true);
      }else{
        $(" #chosen-select option").prop('selected', false);
      }
    });
    </script>
  </div>
</div>
<Script>




$('#submitbtn').show();
function updatecheckimage(oInput){

	var file = oInput;
	var typeval =file.files[0].type;
	var spt = typeval.split("/");
	var imagetype = spt[1].toLowerCase();

	if(imagetype == 'jpg' || imagetype == 'jpeg' || imagetype == 'png')
	{
		//alert("Validate File Formate");
		$('.modal .modal-body .formSubmit').show();
	}
	else
	{
		alert("Invalidate File Formate");
		$('.modal .modal-body .formSubmit').hide();
	}
}
</script>
<script>
  // Image upload functionality
  $('#edit_Modal_<?php echo $agentdata->id;?>').on('shown.bs.modal', function (e) {
  console.log(<?=$agentdata->id;?>);
    $("#profile_img<?php echo $agentdata->id;?>").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });

  function imageIsLoaded(e) {
      $('#myImg<?php echo $agentdata->id;?>').attr('src', e.target.result);
      console.log(e.target.result);
  };
});

  // $('#edit_Modal_<?php echo $agentdata->id;?>').on('hide.bs.modal', function (e) {
    // window.location.reload();
    // location.reload();
  // });

</script>

								<?php } } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>


</div>

<script>
function doconfirm()
{
  let del=confirm("Are you sure to delete permanently?");
  if(del!=true)
  {
    return false;
  }
}

function reset_password(){
  alert("rest");
  $('#<?php echo $userdata['emp_id'];?>_resetpass').prop("disabled",true);
    //document.getElementById("resetpass").disabled = true;
}
// $('#reset_password').click(function(){

// });

// function upimage(){
//   alert("Test");
//   up(this);
// }
  // $("#profile-img").change(function(){
  //   readURL(this);
  // });
// function readURL_edit(input){
//   var ext = $('#agent_pic').val();
//   alert(ext);
//     if($.inArray(ext, ['png','jpeg','jpg']) == -1){
//       swal("Oops...","Invalid File Format...!","error");
//       $('#agent_pic').val('');
//       //$('#view_img').remove();
//       return false;
//     }
//     else{
//       $('#view_image').show();
//       if(input.files && input.files[0]){
//         var reader = new FileReader();
//         reader.onload = function(e){
//           $('#view_image').attr('src', e.target.result);
//         }
//         reader.readAsDataURL(input.files[0]); // convert to base64 string
//       }
//     }
// }

// function update_image(){
//   alert("test");
//   readURL_edit(this);
// }
</script>
<script>
function Deactivate(empid){
	$.ajax({
		method : 'post',
		url    : '<?php echo base_url();?>Adduser/Deactivateagent',
		data   : {id:empid},
		dataType: 'json',
		success : function(data){
			console.log(data);
			window.location.reload();
		}
	});
}

function Activate(empid){
	$.ajax({
		method : 'post',
		url    : '<?php echo base_url();?>Adduser/Activateagent',
		data   : {id:empid},
		dataType: 'json',
		success : function(data){
			console.log(data);
			window.location.reload();
		}
	});
}
</script>
</body>
</html>
