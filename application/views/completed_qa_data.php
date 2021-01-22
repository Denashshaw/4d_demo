<body>
<div class="page-wrapper chiller-theme toggled">
<style type="text/css">
  .claim_data{
    font-weight: 700;
    color: #000 !important;
    font-family: 'Times New Roman' !important ;
    font-size: 18px;

  }
  option{
    font-family: 'Times New Roman' !important;
  }
  #countdown{
    color:red;
    font-size:20px;
  }
  .claim_details{
    margin-bottom: 10px;
  }
  label{
    color:#000 !important;
  }
</style>
<?php include('header.php');?>
  <main class="page-content">
    <div class="container-fluid p-0">
      <div class="row">
        <div class="col-12 col-md-12 content" style="min-height:780px;">
          <div class="row head-content">
            <div class="col-9 col-md-4 logo"><img src="<?php echo base_url();?>img/logo.jpg"></div>
            <div class="col-3 col-md-8 text-right logout"><a href="<?php echo base_url();?>login/signout">Logout</a></div>
          </div>

          <!-- <div class="row activity-row">
            <div class="col-md-12 activity">
              Call Start Time <span id="countdown"> 00 : 00 : 00 </span>
            </div>
          </div> -->      


  <?php echo $this->session->flashdata('msg');?>
  <div class="row emp-table">
    <div class="col-md-7"><br>
              <form method="post" action="#" id="claim_call">
              <?php $unid = $this->uri->segment(3);?>
              <input type="hidden" name="unique_id" id="unique_id" value="<?php echo $unid; ?>">
              <p class="activity" style="color:#2a316a;">Submitted Claim Deatils</p><br>
              <div class="row claim_details">
                <div class="col-md-5">
                  <label class="claim_data">Call Time:</label>
                </div>  
                <div class="col-md-2">
                  <p style="width:300px;"><?php echo $claim_qa[0]->time_spent;?>  (Hours:mins:secs)</p>
                </div>
              </div>
              <div class="row claim_details">
                <div class="col-md-5">
                  <label class="claim_data">Work Status</label>
                </div>  
                <div class="col-md-2">
                  <select class="form-control" name="work_status" id="work_status" required="" style="width:300px;" disabled="">
                    <option value="">--Select--</option>
                    <option value="Workable" <?php if($claim_qa[0]->work_status=="Workable") echo 'selected="selected"';?>>Workable</option>
                    <option value="Not Workable" <?php if($claim_qa[0]->work_status=="Not Workable") echo 'selected="selected"';?>>Not Workable</option>
                  </select>
                </div>
              </div>

            <div class="row claim_details">
              <div class="col-md-5">
                <label class="claim_data">Call Made</label>
              </div>
              <div class="col-md-2">
                <select class="form-control" name="call_made" id="call_made" required="" style="width:300px;" disabled="">
                  <option value="">--Select--</option>
                  <option value="Yes"  <?php if($claim_qa[0]->call_made=="Yes") echo 'selected="selected"';?>>Yes</option>
                  <option value="No"  <?php if($claim_qa[0]->call_made=="No") echo 'selected="selected"';?>>No</option>
                </select>
              </div>
            </div>
        
              <div class="row claim_details">
                <div class="col-md-5">
                  <label class="claim_data">Website Utilized</label>
                </div> 
                <div class="col-md-2">
                  <select class="form-control" name="website_utilized" id="website_utilized" required="" style="width:300px;" disabled="">
                    <option value="">--Select--</option>
                    <option value="Yes" <?php if($claim_qa[0]->website_utilized=="Yes") echo 'selected="selected"';?>>Yes</option>
                    <option value="No" <?php if($claim_qa[0]->website_utilized=="Yes") echo 'selected="selected"';?>>No</option>
                    <option value="Not available" <?php if($claim_qa[0]->website_utilized=="Not available") echo 'selected="selected"';?>>Not Available</option>
                  </select> 
                </div>
            </div>

            <div class="row claim_details">
              <div class="col-md-5">
                <label class="claim_data">Type Of Work</label>
              </div>
              <div class="col-md-2"> 
                <select class="form-control" name="type_of_work" id="type_of_work" required="" style="width:300px;" disabled="">
                  <option value="">--Select--</option>
                  <option value="0 to 60" <?php if($claim_qa[0]->type_of_work=="0 to 60") echo 'selected="selected"';?>>0 to 60</option>
                  <option value="Client Login" <?php if($claim_qa[0]->type_of_work=="Client Login") echo 'selected="selected"';?>>Client Login</option>
                  <option value="Payment Review" <?php if($claim_qa[0]->type_of_work=="Payment Review") echo 'selected="selected"';?>>Payment Review</option>
                </select>
              </div>
            </div>  
      
            <div class="row claim_details">
              <div class="col-md-5">
                <label class="claim_data">Disposition</label>
              </div>
              <div class="col-md-2"> 
                <select class="form-control" name="disposition" id="disposition" required="" style="width:300px;" disabled="">
                  <option value="">--Select--</option>
                  <option value="" <?php echo 'selected="selected"';?>><?php echo $claim_qa[0]->disposition;?></option>
                </select>
              </div>
            </div>
      
      <?php if($claim_qa[0]->disposition=="Active Disposition"){?>
      <div class="row claim_details" style="display:;" id="yes_disp">
        <div class="col-md-5">
          <label class="claim_data">Active Disposition</label>
        </div>
        <div class="col-md-2"> 
          <select class="form-control" name="claim_yes" id="claim_yes" style="width:300px;" disabled="">
            <option value="" <?php echo 'selected="selected"';?>><?php echo $claim_qa[0]->disposition_claims;?></option>
          </select>
        </div>
      </div>
      <?php } ?>
      <?php if($claim_qa[0]->disposition=="Client Instruction"){?>
      <div class="row claim_details" style="display:;" id="client_suggest">
        <div class="col-md-5">
          <label class="claim_data">Client Instruction</label>
        </div>
        <div class="col-md-2"> 
          <select class="form-control" name="claim_client_suggest" id="claim_client_suggest"  style="width:300px;" disabled="">
            <option value="" <?php echo 'selected="selected"';?>><?php echo $claim_qa[0]->disposition_claims;?></option>
          </select>
        </div>
      </div>  
      <?php }?>
            
            <?php if($_SESSION['loggedin_client'] == 'sandstone'){ ?>
            <div class="row claim_details">
              <div class="col-md-5">
                <label class="claim_data">Insurance Company</label>
              </div>
              <div class="col-md-2"> 
                <input type="text" class="form-control" name="insurance_company" id="insurance_company" style="width:300px;" readonly="" value="<?php echo $claim_qa[0]->insurance_company;?>">
              </div>
            </div>
            
            <div class="row claim_details">
              <div class="col-md-5">
                <label class="claim_data">Client Instruction</label>
              </div>
              <div class="col-md-2"> 
                <select class="form-control" name="client_instruction"  id="client_instruction" required="" style="width:300px;" disabled="">
                  <option value="" <?php echo 'selected="selected"';?>><?php echo $claim_qa[0]->client_instruction;?></option>
                </select>
              </div>
            </div>
            <?php } ?>
            <div class="row claim_details">
              <div class="col-md-5">
                <label class="claim_data">Notes</label>
              </div>
              <div class="col-md-2"> 
                <textarea rows="6" class="form-control" name="notes" id="notes" required="" style="width:300px;" readonly=""><?php echo $claim_qa[0]->notes; ?></textarea>
              </div>
            </div>
      
      <div class="row claim_details">
        <div class="col-md-5">
          <label class="claim_data">Spell Check Grammarly:</label>
        </div>
        <div class="col-md-2"> 
          <select class="form-control" name="spell_check" id="spell_check" required="" style="width:300px;" disabled="">
            <option value="">--Select--</option>
            <option value="Yes" <?php if($claim_qa[0]->spell_check_grammarly=="Yes") echo 'selected="selected"';?>>Yes</option>
            <option value="No" <?php if($claim_qa[0]->spell_check_grammarly=="No") echo 'selected="selected"';?>>No</option>
          </select>
        </div>
      </div>
      
            <div class="row claim_details">
        <div class="col-md-5">
          <label class="claim_data">ERA Reviewed:</label>
        </div>
        <div class="col-md-3"> 
          <select class="form-control" name="era_reviewed" id="era_reviewed" required="" style="width:300px;" disabled="">
            <option value="">--Select--</option>
            <option value="Yes" <?php if($claim_qa[0]->era_reviewed=="Yes") echo 'selected="selected"';?>>Yes</option>
            <option value="No" <?php if($claim_qa[0]->era_reviewed=="No") echo 'selected="selected"';?>>No</option>
          </select>
        </div>
      </div>
      
      <div class="row claim_details">
        <div class="col-md-5">
          <label class="claim_data">Previous Notes Reviewed :</label>
        </div>
        <div class="col-md-2"> 
          <select class="form-control" name="previous_notes_reviewed" id="previous_notes_reviewed" required="" style="width:300px;" disabled="">
            <option value="">--Select--</option>
            <option value="Yes" <?php if($claim_qa[0]->previous_notes_reviewed=="Yes") echo 'selected="selected"';?>>Yes</option>
            <option value="No" <?php if($claim_qa[0]->previous_notes_reviewed=="No") echo 'selected="selected"';?>>No</option>
          </select>
        </div>
      </div>
      
      <?php if($_SESSION['loggedin_client'] != 'sandstone'){ ?>
      <div class="row claim_details">
        <div class="col-md-5">
          <label class="claim_data">Line item payment received :</label>
        </div>
        <div class="col-md-2"> 
          <select class="form-control" name="line_item_payment" id="line_item_payment" required="" style="width:300px;" disabled="">
            <option value="">--Select--</option>
            <option value="Yes" <?php if($claim_qa[0]->line_item_payment_received=="Yes") echo 'selected="selected"';?>>Yes</option>
            <option value="No" <?php if($claim_qa[0]->line_item_payment_received=="No") echo 'selected="selected"';?>>No</option>
          </select>
        </div>
      </div>
    <?php } ?>
      
      <div class="row claim_details">
        <div class="col-md-5">
          <label class="claim_data">Fee Schedule Verified :</label>
        </div>
        <div class="col-md-2"> 
          <select class="form-control" name="fee_schedule_verified" id="fee_schedule_verified" required="" style="width:300px;" disabled="">
            <option value="">--Select--</option>
            <option value="Yes" <?php if($claim_qa[0]->fee_schedule_verified=="Yes") echo 'selected="selected"';?>>Yes</option>
            <option value="No" <?php if($claim_qa[0]->fee_schedule_verified=="No") echo 'selected="selected"';?>>No</option>
          </select>
        </div>
      </div>
      
      <?php if($_SESSION['loggedin_client'] != 'sandstone'){ ?>
      <div class="row claim_details">
        <div class="col-md-5">
          <label class="claim_data">Patient Responsibility Reviewed :</label>
        </div>
        <div class="col-md-2"> 
          <select class="form-control" name="patient_responsiblity_reviewed" id="patient_responsiblity_reviewed" required="" style="width:300px;" disabled="">
            <option value="">--Select--</option>
            <option value="Yes" <?php if($claim_qa[0]->patient_responsibility_reviewed=="Yes") echo 'selected="selected"';?>>Yes</option>
            <option value="No" <?php if($claim_qa[0]->patient_responsibility_reviewed=="No") echo 'selected="selected"';?>>No</option>
          </select>
        </div>
      </div>
    <?php } ?>
      
      <div class="row claim_details">
        <div class="col-md-5">
          <label class="claim_data">Updated Correct Status :</label>
        </div>
        <div class="col-md-2"> 
          <select class="form-control" name="updated_correct_status" id="updated_correct_status" required="" style="width:300px;" disabled="">
            <option value="">--Select--</option>
            <option value="Yes" <?php if($claim_qa[0]->updated_correct_status=="Yes") echo 'selected="selected"';?>>Yes</option>
            <option value="No" <?php if($claim_qa[0]->updated_correct_status=="No") echo 'selected="selected"';?>>No</option>
          </select>
        </div>
      </div>
      
      <?php if($_SESSION['loggedin_client'] != 'sandstone'){ ?>
      <div class="row claim_details">
        <div class="col-md-5">
          <label class="claim_data">Updated correct issue Tag & Removed Existing Issue Tag :</label>
        </div>
        <div class="col-md-2"> 
          <select class="form-control" name="updated_correct_issue_tag" id="updated_correct_issue_tag" required="" style="width:300px;" disabled="">
            <option value="">--Select--</option>
            <option value="Yes" <?php if($claim_qa[0]->updated_correct_issue_tag=="Yes") echo 'selected="selected"';?>>Yes</option>
            <option value="No" <?php if($claim_qa[0]->updated_correct_issue_tag=="No") echo 'selected="selected"';?>>No</option>
          </select>
        </div>
      </div>
    <?php } ?>
      
      <div class="row claim_details">
        <div class="col-md-5">
          <label class="claim_data">Updated Follow UP :</label>
        </div>
        <div class="col-md-2"> 
          <select class="form-control" name="updated_followup" id="updated_followup" required="" style="width:300px;" disabled=""> 
            <option value="">--Select--</option>
            <option value="Yes" <?php if($claim_qa[0]->updated_followup=="Yes") echo 'selected="selected"';?>>Yes</option>
            <option value="No" <?php if($claim_qa[0]->updated_followup=="No") echo 'selected="selected"';?>>No</option>
          </select>
        </div>
      </div>

      <div class="row claim_details">
        <div class="col-md-5">
          <label class="claim_data">Notes Posted :</label>
        </div>
        <div class="col-md-2"> 
          <select class="form-control" name="notes_posted" id="notes_posted" required="" style="width:300px;" disabled=""> 
            <option value="">--Select--</option>
            <option value="Yes" <?php if($claim_qa[0]->notes_posted=="Yes") echo 'selected="selected"';?>>Yes</option>
            <option value="No" <?php if($claim_qa[0]->notes_posted=="No") echo 'selected="selected"';?>>No</option>
          </select>
        </div>
      </div>
<br>
          </form>
          </div>

        <div class="col-md-5"><br>
          <p class="activity" style="color:#2a316a;">Completed QA </p><br>
          <?php 
          $userdata =$this->session->all_userdata();
          $table_qa = $userdata['loggedin_client']."_qa";
            $complete_qa=$this->db->query("SELECT * FROM $table_qa WHERE unique_id='".$claim_qa[0]->unique_id."' ORDER BY id DESC");
            $complete =$complete_qa->result();
          ?>
          <form method="post" id="submit_qa" action="">
          <?php $unid = $this->uri->segment(3);?>
          <input type="hidden" name="unique_id" id="unique_id" value="<?php echo $unid; ?>">       
            <div class="row claim_details">
              <div class="col-md-3">
                <label class="claim_data">Error:</label>
              </div>
              <div class="col-md-2"> 
                <select class="form-control" name="error" id="error" disabled="" style="width:250px;"> 
                  <option value="">--Select--</option>
                  <option value="Yes" <?php if($complete[0]->error=="Yes") echo 'selected="selected"'; ?>>Yes</option>
                  <option value="No" <?php if($complete[0]->error=="No") echo 'selected="selected"'; ?>>No</option>
                </select>
              </div>
            </div><br>
            <div class="row claim_details">
              <div class="col-md-3">
                <label class="claim_data">Error Type:</label>
              </div>
              <div class="col-md-2"> 
                <select class="form-control" name="error_type" id="error_type" required="" style="width:250px;" disabled=""> 
                  <option value="" <?php echo 'selected="selected"';?>><?php echo $complete[0]->error_type;?></option>
                </select>
              </div>
            </div>

            <div class="row claim_details">
              <div class="col-md-3">
                <label class="claim_data">Error Desc:</label>
              </div>
              <div class="col-md-2"> 
                <select class="form-control" name="error_description" id="error_description" required="" style="width:250px;" disabled=""> 
                  <option value="" <?php echo 'selected="selected"';?>><?php echo $complete[0]->error_description;?></option>
                </select>
              </div>            
            </div>

                        <div class="row claim_details">
              <div class="col-md-3">
                <label class="claim_data">Claim Type:</label>
              </div>
              <div class="col-md-2"> 
                <select class="form-control" name="error_description" id="error_description" required="" style="width:250px;" disabled=""> 
                  <option value="" <?php echo 'selected="selected"';?>><?php echo $complete[0]->claim_type;?></option>
                </select>
              </div>            
            </div>

            <div class="row claim_details">
              <div class="col-md-3">
                <label class="claim_data">Fatal Error:</label>
              </div>
              <div class="col-md-2"> 
                <select class="form-control" name="fatal_error" id="fatal_error" disabled="" style="width:250px;" > 
                  <option value="" <?php //echo 'selected="selected"';?>><?php echo $complete[0]->fatal_error;?></option>
                </select>
              </div>
            </div>

            <div class="row claim_details">
              <div class="col-md-3">
                <label class="claim_data">Escalate to (TL):</label>
              </div>
              <div class="col-md-2"> 
                <select class="form-control" name="escalate_to_tl" id="escalate_to_tl" required="" style="width:250px;" disabled=""> 
                  <option value="" <?php echo 'selected="selected"';?>><?php echo $complete[0]->escalate_to_tl;?></option>
                </select>
              </div>
            </div>
             <div class="row claim_details">
              <div class="col-md-3">
                <label class="claim_data">Notes:</label>
              </div>
              <div class="col-md-2"> 
                <textarea rows="6" class="form-control" name="qa_notes" id="qa_notes" readonly="" style="width:300px;"><?php echo $complete[0]->qa_notes; ?></textarea>
                <!-- <input type="submit" value="Submit" name="submit" id="submit_qa" class="start-break" style="font-size:15px;"> -->

              </div>
            </div>

          </form> 
        </div>
</div>
        </div>
      </div>
    </div>
  </div>
</main>

      
</div>
  
<script>

</script>
</body>
</html>  