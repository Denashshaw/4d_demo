<?php $userdata=$this->session->all_userdata();
//error_reporting(E_ERROR);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>4D Global- Clients</title>
  <meta name="theme-color" content="#ffffff">
  <meta name="description" content="HRMS" />
  <meta name="keywords" content="" />
  <meta name="robots" content="index, follow">
  <!--<link rel="canonical" href="#"/>-->
  <meta property="og:title" content="CRM"/>
  <meta property="og:type" content="website"/>
  <!--<meta property="og:url" content="#" /> -->
  <meta property="og:image" content="og.png"/>
  <!--<link rel="icon" href="img/favicon.ico" type="image/x-icon" />-->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" type="image/jpg" href="<?php echo base_url();?>img/logo.jpg" />

  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/theme.css">
  <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url('css/jquery.datetimepicker.css') ?>" />
  <link rel="stylesheet" href="<?php echo base_url('css/datepicker.css') ?>" />

  <script src="<?php echo base_url();?>js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
  <script src="<?php echo base_url('js/jquery.datetimepicker.full.js')?>"></script>
  <script src="<?php echo base_url('js/datepicker.js') ?>"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<style type="text/css">
p{
  font-family: 'Montserrat', sans-serif;
  font-size: 14px;
}

.mons{
  font-family: 'Montserrat', sans-serif;
}

::-webkit-input-placeholder {
  font-family: 'Montserrat', sans-serif;
  font-size: 14px;
  color:#5a5a5a !important;
}

:-ms-input-placeholder {
  font-family: 'Montserrat', sans-serif;
  font-size: 14px;
  color:#5a5a5a !important;
}

input{
  font-family: inherit;
  font-size: inherit;
  line-height: inherit;
  background: white;
  border: 1px solid #dbdbdb;
  padding: 8px;
  margin: 10px 0px 10px 0px;
}

.apply{
  background: #337ab7;
  color: #fff;
  padding: 10px 22px 10px 22px;
  margin: 0px 0px 0px !important;
  width: 25%;
}

.apply:hover,.apply:focus {
  background: #337ab7;
  color:#fff;
  padding:10px 22px 10px 22px;
  margin:0px 0px 0px !important;
  text-decoration:none;
}

.page-wrapper.toggled .sidebar-wrapper {
  background-color: #2a316a !important;
}
.sidebar-wrapper a {
  color: #fff;
}
#close-sidebar{
  color:#fff;
}
.agent-name{
  color:#fff;
}
.agent-type{
  background:#00a4bd;
  color:#fff;
}
.img-circle{
  border-radius: 100%;
}
label {
    color:green !important;
    font-family: 'Montserrat', sans-serif !important;
}
input[type="radio"]+label{
  color: #000 !important;
}

input[type=checkbox]:hover {
    box-shadow:0px 0px 10px #1300ff;
}
</style>
</head>
  <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
  </a>

<nav id="sidebar" class="sidebar-wrapper">
  <div class="profile-pic">
    <img src="<?php echo base_url();?>emp_images/<?php echo $userdata['emp_image']; ?>" class="img-reponsive img-circle" style="width:150px;">
  </div>
  <div class="agent-name">
    <?php echo ucfirst($userdata['name']);?>
  </div>
  <div class="agent-type">
    <?php echo ucfirst($userdata['role']);?>
  </div>
  <div class="side-menu">
    <ul class="menu">
      <?php $actlinks=$this->uri->segment(1);
      if($userdata['department']!='Data' && $userdata['department']!='Qa'){
      ?>
      <li class="<?php if($actlinks == "home") echo "active";?>"><i class="far fa-file-word"></i>
        <a class="<?php if($actlinks == "home") echo "active";?>" href="<?php echo base_url();?>home">Claims Assigned</a>
      </li>
    <?php } ?>
      <?php if($userdata['role']=='admin' || $userdata['role']=='manager'){?>
      <li class="<?php if($actlinks  == "agentlist") echo "active";?>">
        <i class="fas fa-users"></i>
        <a class="<?php if($actlinks == "agentlist") echo "active";?>" href="<?php echo base_url();?>agentlist">Agent Details</a>
      </li>
      <?php }

      if($userdata['department']!='Data'  && $userdata['department']!='Qa'){
      ?>

      <?php if($userdata['role']=='agent'){?>
      <li class="<?php if($actlinks  == "completed") echo "active";?>">
        <i class="far fa-file-word"></i>
        <a class="<?php if($actlinks == "completed") echo "active";?>" href="<?php echo base_url();?>completed">Completed Claims</a>
      </li>
      <?php }
    }?>
          <?php if($userdata['role']=='admin' || $userdata['role']=='manager'){?>
      <li class="<?php if($actlinks  == "claims_report") echo "active";?>">
        <i class="fas fa-users"></i>
        <a class="<?php if($actlinks == "claims_report") echo "active";?>" href="<?php echo base_url();?>claims_report">Reallocate Claims</a>
      </li>
      <?php } ?>

      <?php if($userdata['role']=='admin' || $userdata['role']=='manager' || ($userdata['role']=='supervisor' && $userdata['department']!='Data')){?>
      <li class="<?php if($actlinks  == "overall_completed") echo "active";?>">
      <i class="far fa-file-word"></i>
      <a class="<?php if($actlinks == "overall_completed") echo "active";?>" href="<?php echo base_url();?>overall_completed">Completed Claims</a>
      <?php } ?>

      <?php if($userdata['role']=='admin' || ($userdata['role']=='supervisor' || $userdata['role']=='manager' )){?>
      <li><i class="fas fa-user-plus"></i><a href="#" class="" data-toggle="modal" data-target="#myModal">Add Agent</a></li>
      <?php } ?>

      <?php if($userdata['role']=='admin' || $userdata['role']=='supervisor' || $userdata['role']=='manager'){?>
      <li class="<?php if($actlinks  == "add_client") echo "active";?>">
        <i class="fas fa-address-card"></i>
        <a class="<?php if($actlinks == "add_client") echo "active";?>" href="<?php echo base_url();?>add_client">Add Client</a>
      </li>
      <?php } ?>

      <?php if($userdata['role']=='admin' || $userdata['role']=='manager' || ($userdata['role']=='supervisor' && $userdata['department']!='Data')){?>
      <li class="<?php if($actlinks  == "assignagents") echo "active";?>">
        <i class="fas fa-database"></i>
        <a class="<?php if($actlinks == "assignagents") echo "active";?>" href="<?php echo base_url();?>assignagents">Assign Claims</a>
      </li>
      <?php } ?>

       <?php if($userdata['role']=='admin'  || $userdata['role']=='manager' || ($userdata['role']=='supervisor' && $userdata['department']!='Data'  || $userdata['department']=='Qa')){?>
        <li class="<?php if($actlinks  == "completed_qa") echo "active";?>">
          <i class="fas fa-address-card"></i>
          <a class="<?php if($actlinks == "completed_qa") echo "active";?>" href="<?php echo base_url();?>completed_qa">QAed Claims</a>
        </li>
      <?php } ?>

      <?php if($userdata['role']=='admin' || $userdata['role']=='manager' || ($userdata['role']=='supervisor' && $userdata['department']!='Data')){?>
      <li><i class="fas fa-lock"></i><a href="#" class="" data-toggle="modal" data-target="#resetPassword">Reset Agent Password</a></li>
      <?php } ?>

      <?php if($userdata['role']=='admin' || $userdata['role']=='manager' || ($userdata['role']=='supervisor' && $userdata['department']!='Data')){?>
       <li class="<?php if($actlinks  == "not_workable") echo "active";?>">
        <i class="fas fa-times"></i>
        <a class="<?php if($actlinks == "not_workable") echo "active";?>" href="<?php echo base_url();?>not_workable">Not Workable</a>
      </li>
      <?php } ?>
      <?php  if($userdata['department'] == "Data" && $userdata['role'] != "admin"){?>
        <li class="<?php if($actlinks  == "Dataprocess" || $actlinks  == "dataprocess") echo "active";?>">
          <i class="fas fa-shield-alt"></i>
          <a class="<?php if($actlinks == "Dataprocess"  || $actlinks  == "dataprocess") echo "active";?>" href="<?php echo base_url();?>dataprocess">Data Productivity</a>
        </li>
      <?php } ?>

      <li><i class="fas fa-unlock-alt"></i><a href="#" class="show-modal" data-toggle="modal" data-target="#changePassword" data-backdrop="static">Change Password</a></li>

      <?php if($userdata['role']=='admin' || $userdata['role']=='manager' || ($userdata['role']=='supervisor' && $userdata['department']!='Data')){?>
        <li class="<?php if($actlinks  == "export_report") echo "active";?>">
          <i class="fas fa-download"></i>
          <a class="<?php if($actlinks == "export_report") echo "active";?>" href="<?php echo base_url();?>export_report">Export Report</a>
        </li>
      <?php } ?>
      <?php if($userdata['role']=='admin' || $userdata['role']=='manager' || ($userdata['role']=='supervisor' && $userdata['department']!='Data') ){?>
        <li class="<?php if($actlinks  == "agentreport") echo "active";?>">
          <i class="fas fa-table"></i>
          <a class="<?php if($actlinks == "agentreport") echo "active";?>" href="<?php echo base_url();?>workreport">Agent Report</a>
        </li>
      <?php } ?>
      <?php if($userdata['role']=='admin' || $userdata['role']=='manager' || $userdata['role']=='agent' && $userdata['department']!='Data'){ ?>
      <li class="<?php if($actlinks  == "rework_claims") echo "active";?>">
          <i class="fas fa-address-card"></i>
          <a class="<?php if($actlinks == "rework_claims") echo "active";?>" href="<?php echo base_url();?>rework_claims">QA Rework</a>
        </li>
        <?php } ?>
      <?php if($userdata['role']=='admin' || $userdata['role']=='manager' ||($userdata['role']=='supervisor' && $userdata['department']!='Data' || $userdata['department']=='Qa')){?>
        <li class="<?php if($actlinks  == "qa_report") echo "active";?>">
          <i class="far fa-file-word"></i>
          <a class="<?php if($actlinks == "qa_report") echo "active";?>" href="<?php echo base_url();?>qa_report">QA Module</a>

      <?php if($userdata['role']=='admin' || $userdata['role']=='manager' ||  ($userdata['role']=='supervisor' && $userdata['department']!='Data' || $userdata['department']=='Qa')){?>
        <li class="<?php if($actlinks  == "qa_dashboard") echo "active";?>">
          <i class="far fa-file-word"></i>
          <a class="<?php if($actlinks == "qa_dashboard") echo "active";?>" href="<?php echo base_url();?>qa_dashboard">QA Dashboard</a>
        </li>
      <?php } ?>

       <?php if($userdata['role']=='admin' || $userdata['role']=='manager' ||  ($userdata['role']=='supervisor' && $userdata['department']!='Data' || $userdata['department']=='Qa')){?>
        <li class="<?php if($actlinks  == "quality_dashboard") echo "active";?>">
          <i class="far fa-file-word"></i>
          <a class="<?php if($actlinks == "quality_dashboard") echo "active";?>" href="<?php echo base_url();?>quality_dashboard">Quality Dashboard</a>
        </li>
      <?php }} ?>
      
      <li class="<?php if($actlinks  == "prod_dashboard") echo "active";?>">
          <i class="far fa-file-word"></i>
          <a class="<?php if($actlinks == "prod_dashboard") echo "active";?>" href="<?php echo base_url('Prod_dashboard/index');?>">Production Dashboard</a>
        </li>


       
    </ul>
  </div>
  <div class="side-menu">
    <ul class="menu">
      <li id="close-sidebar">Hide Side Menu</li>
    </ul>
  </div>
</nav>

<!--Add Agent Modal -->
<div style="padding-top:1px;" class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="mons modal-title">Add Agent</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body mons">
        <form method="post" action="<?php echo base_url();?>adduser/adduser" enctype="multipart/form-data">
          <p class="">Employee ID:</p>
          <input class="col-md-12 col-xs-12 form-control" type="text" id="userid" name="userid" placeholder="Emp ID" required="">
          <p class="">Employee Name:</p>
        <input class="col-md-12 col-xs-12 form-control" type="text" id="name" name="name" placeholder="Name" required="">
          <p class="">User Name:</p>
          <input class="col-md-12 col-xs-12 form-control" type="text" id="username" name="username" placeholder="UserName" required="">
          <p class="">Password:</p>
          <input class="col-md-12 col-xs-12 form-control" type="password" id="password" name="password" placeholder="Password" required="" >
          <input type="checkbox" onclick="myFunction()" id="showPass"><label for="checkbox"> View Password</label>
          <p id="err" style="color:red;"></p>
          <p class="">Role:</p>
          <select class="form-control" name="role" required="">
            <option value="">--Select--</option>
            <option value="manager">Manager</option>
            <option value="agent">Agent</option>
            <option value="supervisor">Supervisor</option>
            <option value="qa">QA</option>
          </select>
          <br>

          <p class="">Department:</p>
            <select class="form-control" name="department" required="">
              <option value="">--Select--</option>
                <option value="Voice">Voice</option>
                <option value="Data">Data</option>
                <option value="Qa">QA-Team</option>
            </select>
          <br>
          <p class="">Select Clients: (Hold control to select multiple clients)</p>
          <?php
          $sql=$this->db->query("SELECT * FROM client order by client");
          $clientlist = $sql->result();
         
          ?>
          <input type="checkbox" id="selectAll"> <label for="selectAll" style="font-size: 12px;">Select All Clients</label>
          <select data-placeholder="Choose Client..."  class="form-control"  name="sandstone[]" required="" multiple id="client_dropdown" style="height: 150px;">
                <!-- <option value="">--Select Client--</option> -->
                    <?php             
                     foreach ($clientlist as $client) { ?>
                      <option value="<?php echo $client->keyword; ?>" ><?php echo ucfirst($client->client); ?> </option>
                  <?php } ?>
          </select>
          <br><br>

          <label style="color:#212529 !important;">Agent Photo:</label><br>
          <label class="btn btn-xs btn-secondary" style="color: white !important;">
            <input type='file' id="imgInp" name="imgInp" accept=".png,.jpg,.jpeg" onchange="return fileValidation()" hidden />
          Upload Photo</label>
          <div id="imagePreview"></div>
          <br><br>
          <!-- <p class="">Add Photo:</p>
            <input type='file' id="imgInp" name="imgInp" required />
            <img id="view_img" src="#" alt="your image" style="width:200px;display:none;" />-->

            <input type="submit" name="fadd" class="apply formSubmit" value="Submit" id="addagentsubmit" >
            <input type="button" value="Cancel" class="apply" data-dismiss="modal" >
        </form>
        <span class="blinking" id="ajaxmsg" style="color:#337ab7;font-size:15px;position:relative;top:7px;font-weight:800;"></span>
      </div>
    </div>
  </div>
</div>

<!-- Change Password Modal -->
<div style="padding-top:1px;" class="modal fade" id="changePassword" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="mons modal-title">Change Password</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body mons">
        <form method="post" action="<?php echo base_url();?>Adduser/chpass">
          <input type="hidden" name="userid" value="<?php echo $userdata['user_id'];?>" id="user_id">
          <p class="">New Password:</p>
          <input class="col-md-12 col-xs-12 form-control" type="password" id="new_password" name="new_password" placeholder="Password" required="">

          <p class="">Confirm Password:</p>
          <input class="col-md-12 col-xs-12 form-control" type="password" id="confirm_password" name="confirm_password" placeholder="Password" required="" onChange="checkPasswordMatch();">

          <p class="divCheckPasswordMatch">.</p>

          <input type="submit" name="password" class="apply formSubmit" value="Submit" id="apply">
          <input type="button" value="Cancel" class="apply" data-dismiss="modal" >
        </form>
        <span class="blinking" id="ajaxmsg" style="color:#337ab7;font-size:15px;position:relative;top:7px;font-weight:800;"></span>
      </div>
    </div>
  </div>
</div>

<!--Reset Password Modal -->
<div style="padding-top:1px;" class="modal fade" id="resetPassword" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="mons modal-title">Reset Agent Password</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body mons">
        <form method="post" action="<?php echo base_url();?>Adduser/reset_password">
          <!-- <input type="hidden" name="userid" value="<?php echo $userdata['user_id'];?>" id="user_id"> -->
          <?php
            $userdata =$this->session->all_userdata();
            // $client = $userdata['loggedin_client'];
            $sql=$this->db->query("SELECT * FROM users WHERE role!='admin' AND FIND_IN_SET('".$userdata['loggedin_client']."', client)");
            $usr_data=$sql->result();
          ?>
          <p class="">Select Agent</p>
          <select class="form-control" name="userid" id="" required="">
            <option value="">--Select Agent--</option>
            <?php foreach($usr_data as $usr){ ?>
            <option value="<?php echo $usr->user_id;?>"><?php echo $usr->name;?></option>
          <?php }?>
          </select><br>
          <p class="">New Password:</p>
          <input class="col-md-12 col-xs-12 form-control" type="password" id="reset_new_password" name="reset_new_password" placeholder="Password" required="">

          <p class="">Confirm Password:</p>
          <input class="col-md-12 col-xs-12 form-control" type="password" id="reset_confirm_password" name="reset_confirm_password" placeholder="Password" required="" onkeyup="ResetPasswordMatch();">

          <p class="divResetPasswordMatch">.</p>

          <input type="submit" name="reset_password" class="apply formSubmit" value="Submit" id="reset_apply">
          <input type="button" value="Cancel" class="apply" data-dismiss="modal" >
        </form>
        <span class="blinking" id="ajaxmsg" style="color:#337ab7;font-size:15px;position:relative;top:7px;font-weight:800;"></span>
      </div>
    </div>
  </div>
</div>
<body>

<script>
$('#selectAll').click(function(){
      if($('#selectAll').prop("checked")){
        $("#client_dropdown option").prop('selected', true);
      }else{
        $("#client_dropdown option").prop('selected', false);
      }
    });

    $('#userid').blur(function(){
      var name = $('#userid').val();
      $('#username').val(name); 
    });

function myFunction() {
    var x = document.getElementById("password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
  function fileValidation(){
    var fileInput = document.getElementById('imgInp');
    var filePath = fileInput.value;
    console.log(fileInput, filePath);
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
        fileInput.value = '';
        $('#imagePreview').hide();
        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'" style="width:100px;height:100px;"/>';
            };
            reader.readAsDataURL(fileInput.files[0]);
            $('#imagePreview').show();
        }
    }
}

	if($(window).width() <= 767){
	  $(".page-wrapper").removeClass("toggled");
	}
	jQuery(function($){
  $(".sidebar-dropdown > a").click(function(){
    $(".sidebar-submenu").slideUp(200);
      if($(this).parent().hasClass("active"))
      {
        $(".sidebar-dropdown").removeClass("active");
        $(this).parent().removeClass("active");
      }
      else
      {
        $(".sidebar-dropdown").removeClass("active");
        $(this).next(".sidebar-submenu").slideDown(200);
        $(this).parent().addClass("active");
      }
    });

  $("#close-sidebar").click(function(){
    $(".page-wrapper").removeClass("toggled");
  });

  $("#show-sidebar").click(function(){
    $(".page-wrapper").addClass("toggled");
  });

});
</script>
