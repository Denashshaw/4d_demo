<body>
<div class="page-wrapper chiller-theme toggled">
<style type="text/css">
  .claim_data{
    font-weight: 700;
    color: #000;
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

          <div class="row activity-row">
            <div class="col-md-12 activity">
              Call Start Time<span id="countdown"> 00 : 00 : 00 </span>
            </div>
          </div>

          <!--<div class="form-group has-search">
            <span class="fa fa-search form-control-feedback"></span>
            <input type="text" class="search-input" placeholder="Search" id="search" style="width:15% !important;">
          </div> -->

          <?php echo $this->session->flashdata('msg');?>
          <div class="row emp-table">
          <?php //print_r($start_call); ?>
          <div class="col-md-5"><br>
            <p class="activity" style="color:#2a316a;">Claim Details</p><br>
            <p class="claim_data">Date Assigned (MM/DD) : <?php $assign_date=substr($start_call[0]->created_date,5);
                echo substr($assign_date,0,-3);?> </p>
            <p class="claim_data">Insurance             : <?php echo $start_call[0]->insurance;?> </p>
            <p class="claim_data">Facility              : <?php echo $start_call[0]->facility;?> </p>
            <p class="claim_data">Claim Id              : <?php echo $start_call[0]->claim_id;?> </p>
            <p class="claim_data">Patient Name          : <?php echo $start_call[0]->patient;?> </p>
            <p class="claim_data">Status                : <?php echo $start_call[0]->status;?> </p>
            <p class="claim_data">Service               : <?php echo $start_call[0]->service;?> </p>
            <p class="claim_data">DOS Start             : <?php echo $start_call[0]->dos_start;?> </p>
            <p class="claim_data">DOS End               : <?php echo $start_call[0]->dos_end;?> </p>
            <p class="claim_data">Charges               : <?php echo $start_call[0]->charges;?> </p>
            <p class="claim_data">Follow Up             : <?php echo $start_call[0]->follow_up;?> </p>
            <p class="claim_data">Last Action Date      : <?php echo $start_call[0]->last_action_date;?></p>
            <p class="claim_data">Days Outstanding      : <?php echo $start_call[0]->days_outstanding;?> </p>
            <p class="claim_data">Queue                 : <?php echo $start_call[0]->queue;?> </p>
            <p class="claim_data">Assigned to Client    : <?php echo $start_call[0]->assigned_to_client;?> </p>
          
            <p class="claim_data"> Notes :</p> <textarea rows="7" class="form-control" style="width:400px;"><?php echo $sj_disp_data[0]->notes; ?></textarea><br><br>
          </div>
          <div class="col-md-7"><br>
    <form method="post" action="" id="claim_call">
      <?php $unid = $this->uri->segment(3);?>
      <input type="hidden" name="unique_id" id="unique_id" value="<?php echo $unid; ?>">
            <p class="activity" style="color:#2a316a;">Add Call Entry Details</p><br>

            <div class="row claim_details">
              <div class="col-md-5">
                <label class="claim_data">Work Status</label>
              </div>
              <div class="col-md-2">
                <select class="form-control" name="work_status" id="work_status" required="" style="width:300px;" onchange="workStatus()">
                  <option value="">--Select--</option>
                  <option value="Workable">Workable</option>
                  <option value="Not Workable">Not Workable</option>
                </select>
              </div>
              </div>

              <div class="row claim_details">
              <div class="col-md-5">
                <label class="claim_data">Notes</label>
              </div>
              <div class="col-md-2">
                <textarea rows="6" class="form-control" name="notes" id="notes" required="" style="width:300px;"></textarea>
              </div>
            </div>


                        <div class="row claim_details">
              <div class="col-md-5">
                <label class="claim_data">Disposition</label>
              </div>
              <div class="col-md-2">
                <select class="form-control" name="disposition" id="disposition" required="" style="width:300px;" onchange="dispos()">
                  <option value="">--Select--</option>
                  <option value="Active Disposition"> Active Disposition</option>
                  <option value="Client Instruction"> Client Instruction</option>
                </select>
              </div>
            </div>

      <div class="row claim_details" style="display:none;" id="yes_disp">
        <div class="col-md-5">
          <label class="claim_data">Active Disposition</label>
        </div>
        <div class="col-md-2">
          <select class="form-control" name="claim_yes" id="claim_yes" style="width:300px;">
            <!-- <option value="">--Select--</option>
            <option value="(0) PVF - PVF needed">(0) PVF - PVF needed</option>
            <option value="(0) PVF - Waiting for ERA; Holding PVF/Availity">(0) PVF - Waiting for ERA; Holding PVF/Availity</option>
            <option value="(1) Payer - Possible Recoupment">(1) Payer - Possible Recoupment</option>
            <option value="(1) Payer - Waiting on EOB">(1) Payer - Waiting on EOB</option>
            <option value="(1) Payer - AOR Request">(1) Payer - AOR Request</option>
            <option value="(1) Payer - Authorization Units Discrepancy">(1) Payer - Authorization Units Discrepancy</option>
            <option value="(1) Payer - Check Reissue Requested: to Patient">(1) Payer - Check Reissue Requested: to Patient</option>
            <option value="(1) Payer - Check Reissue Requested: to Provider">(1) Payer - Check Reissue Requested: to Provider</option>
            <option value="(1) Payer - Claim is being finalized">(1) Payer - Claim is being finalized</option>
            <option value="(1) Payer - Claim is being re-keyed">(1) Payer - Claim is being re-keyed</option>
            <option value="(1) Payer - Claim is being reviewed">(1) Payer - Claim is being reviewed</option>
            <option value="(1) Payer - Claim is in a Pending Status">(1) Payer - Claim is in a Pending Status</option>
            <option value="(1) Payer - Claim Rejected by Payer">(1) Payer - Claim Rejected by Payer</option>
            <option value="(1) Payer - Claim Still Processing">(1) Payer - Claim Still Processing</option>
            <option value="(1) Payer - Claim was expedited">(1) Payer - Claim was expedited</option>
            <option value="(1) Payer - Claim was Reprocessed">(1) Payer - Claim was Reprocessed</option>
            <option value="(1) Payer - Codes Bundled">(1) Payer - Codes Bundled</option>
            <option value="(1) Payer - Denied - See Issue">(1) Payer - Denied - See Issue</option>
            <option value="(1) Payer - Dispute Still Being Reviewed">(1) Payer - Dispute Still Being Reviewed</option>
            <option value="(1) Payer - Drug Screening Denied">(1) Payer - Drug Screening Denied</option>
            <option value="(1) Payer - Duplicate Payment (Payer Error)">(1) Payer - Duplicate Payment (Payer Error)</option>
            <option value="(1) Payer - EOB not Received">(1) Payer - EOB not Received</option>
            <option value="(1) Payer - Max Benefits Reached">(1) Payer - Max Benefits Reached</option>
            <option value="(1) Payer - Medical Records Denied">(1) Payer - Medical Records Denied</option>
            <option value="(1) Payer - Medical Records Incomplete">(1) Payer - Medical Records Incomplete</option>
            <option value="(1) Payer - Medical Records Sent">(1) Payer - Medical Records Sent</option>
            <option value="(1) Payer - Medical Records Still in Review">(1) Payer - Medical Records Still in Review</option>
            <option value="(1) Payer - Medical Records were Approved">(1) Payer - Medical Records were Approved</option>
            <option value="(1) Payer - Original Claim Processing">(1) Payer - Original Claim Processing</option>
            <option value="(1) Payer - Payment Agreement">(1) Payer - Payment Agreement</option>
            <option value="(1) Payer - Priced by Home plan">(1) Payer - Priced by Home plan</option>
            <option value="(1) Payer - Priced by Local">(1) Payer - Priced by Local</option>
            <option value="(1) Payer - Priced by Multiplan / Viant/GCS">(1) Payer - Priced by Multiplan / Viant/GCS</option>
            <option value="(1) Payer - Pricing Determination Upheld">(1) Payer - Pricing Determination Upheld</option>
            <option value="(1) Payer - Re-processed On Phone">(1) Payer - Re-processed On Phone</option>
            <option value="(1) Payer - Recoupment Requested">(1) Payer - Recoupment Requested</option>
            <option value="(1) Payer - Resubmit with Modifier">(1) Payer - Resubmit with Modifier</option>
            <option value="(1) Payer - Secondary claim in process">(1) Payer - Secondary claim in process</option>
            <option value="(1) Payer - Service Not a Covered Benefit">(1) Payer - Service Not a Covered Benefit</option>
            <option value="(1) Payer - Submit to Secondary">(1) Payer - Submit to Secondary</option>
            <option value="(1) Payer - Third Party Administrator (TPA) Issue">(1) Payer - Third Party Administrator (TPA) Issue</option>
            <option value="(1) Payer - Waiting on Documents/Letters">(1) Payer - Waiting on Documents/Letters</option>
            <option value="(1) Payer- Denied for no Auth on file">(1) Payer- Denied for no Auth on file</option>
            <option value="(2) Research - Claim Paid Incorrectly">(2) Research - Claim Paid Incorrectly</option>
            <option value="(2) Research - Issue Not Clear">(2) Research - Issue Not Clear</option>
            <option value="(2) Research - Issue Not Clear">(2) Research - Issue Not Clear</option>
            <option value="(3) Appeal - Appeal Upheld/Denied">(3) Appeal - Appeal Upheld/Denied</option>
            <option value="(3) Appeal - Member Submitted an Appeal">(3) Appeal - Member Submitted an Appeal</option>
            <option value="(3) Appeal - Need to submit Second Level">(3) Appeal - Need to submit Second Level</option>
            <option value="(3) Appeal - Needed, Not Written">(3) Appeal - Needed, Not Written</option>
            <option value="(3) Appeal - Received and being reviewed">(3) Appeal - Received and being reviewed</option>
            <option value="(3) Appeal - Sent - Pending Payer Response">(3) Appeal - Sent - Pending Payer Response</option>
            <option value="(4) Practice - Billing Team Needs Information/Documentation">(4) Practice - Billing Team Needs Information/Documentation</option>
            <option value="(4) Practice - COB Information Needed">(4) Practice - COB Information Needed</option>
            <option value="(4) Practice - Credentialing/Contracting Pending">(4) Practice - Credentialing/Contracting Pending</option>
            <option value="(4) Practice - EOB Needed - Sent to Practice">(4) Practice - EOB Needed - Sent to Practice</option>
            <option value="(4) Practice - Needs to update Information">(4) Practice - Needs to update Information</option>
            <option value="(4) Practice - Payer Needs Information/Documentation">(4) Practice - Payer Needs Information/Documentation</option>
            <option value="(5) Issue - BIOP PHP">(5) Issue - BIOP PHP</option>
            <option value="(6) Billing - Change claim form">(6) Billing - Change claim form</option>
            <option value="(6) Billing - EOB Awaiting Posting">(6) Billing - EOB Awaiting Posting</option>
            <option value="(6) Billing - EOB Not Received">(6) Billing - EOB Not Received</option>
            <option value="(6) Billing - Medical Notes Requested">(6) Billing - Medical Notes Requested</option>
            <option value="(6) Billing - Medical Records are not yet received">(6) Billing - Medical Records are not yet received</option>
            <option value="(6) Billing - Patient Demographics">(6) Billing - Patient Demographics</option>
            <option value="(6) Billing - Resubmit Needed">(6) Billing - Resubmit Needed</option>
            <option value="(7) Resubmit - Corrected Claim Requested">(7) Resubmit - Corrected Claim Requested</option>
            <option value="(7) Resubmit - Rejected Claim">(7) Resubmit - Rejected Claim</option>
            <option value="(8) Closed - Denied- Not Authorized">(8) Closed - Denied- Not Authorized</option>
            <option value="(1) Payer - Resubmit Claims via Email">(1) Payer - Resubmit Claims via Email</option> -->
            <option value="">--Select--</option>
            <option value="Appeal - Denied">Appeal - Denied</option>
            <option value="Appeal - Needed, Not Written">Appeal - Needed, Not Written</option>
            <option value="Appeal - Sent - Pending Payer Review">Appeal - Sent - Pending Payer Review</option>
            <option value="Billing - EOB Not Received">Billing - EOB Not Received</option>
            <option value="Billing - EOB Received">Billing - EOB Received</option>
            <option value="Billing - Pending Manager Review">Billing - Pending Manager Review</option>
            <option value="Billing - Resubmit Needed">Billing - Resubmit Needed</option>
            <option value="Billing - Waiting for EOB (Internally)">Billing - Waiting for EOB (Internally)</option>
            <option value="Closed - Denied">Closed - Denied</option>
            <option value="Closed - Paid">Closed - Paid</option>
            <option value="Closed - Paid - Patient Responsibility">Closed - Paid - Patient Responsibility</option>
            <option value="Cold Case - Denied Authorization with Low Chance of Successful Appeal">Cold Case - Denied Authorization with Low Chance of Successful Appeal</option>
            <option value="Cold Case - PTP Money Has Been Spent by Family">Cold Case - PTP Money Has Been Spent by Family</option>
            <option value="Cold Case - PTP No Contact with Family for 1yr+">Cold Case - PTP No Contact with Family for 1yr+</option>
            <option value="Cold Case - Self - Funded Plan Lost Funding">Cold Case - Self - Funded Plan Lost Funding</option>
            <option value="NO FOLLOW UP with Payor - negative experience">NO FOLLOW UP with Payor - negative experience</option>
            <option value="Payer - Claim Processed Incorrectly  - Resubmit Sent">Payer - Claim Processed Incorrectly  - Resubmit Sent</option>
            <option value="Payer - Denied - Pending Investigation">Payer - Denied - Pending Investigation</option>
            <option value="Payer - Documentation Submitted">Payer - Documentation Submitted</option>
            <option value="Payer - Medical Records Request">Payer - Medical Records Request</option>
            <option value="Payer - Medical Records Submitted">Payer - Medical Records Submitted</option>
            <option value="Payer - Original Claim Processing">Payer - Original Claim Processing</option>
            <option value="Payer - Pending Provider Relations Action">Payer - Pending Provider Relations Action</option>
            <option value="Payer - Reprocessing">Payer - Reprocessing</option>
            <option value="Payer - Re-submitted">Payer - Re-submitted</option>
            <option value="Payer - Re-submitted  - Waiting on Determination">Payer - Re-submitted  - Waiting on Determination</option>
            <option value="Payer - Secondary Claim Processing">Payer - Secondary Claim Processing</option>
            <option value="PNI - denied">PNI - denied</option>
            <option value="PNI - paid">PNI - paid</option>
            <option value="PNI - records confirmed received">PNI - records confirmed received</option>
            <option value="PNI - records requested">PNI - records requested</option>
            <option value="PNI - records submitted">PNI - records submitted</option>
            <option value="PNI - set to pay">PNI - set to pay</option>
            <option value="Practice - Payer Needs Information/Documentation">Practice - Payer Needs Information/Documentation</option>
            <option value="Research - Issue Not Clear">Research - Issue Not Clear</option>
          </select>
        </div>
      </div>

      <div class="row claim_details" style="display:none;" id="client_suggest">
        <div class="col-md-5">
          <label class="claim_data">Client Instruction</label>
        </div>
        <div class="col-md-2">
          <select class="form-control" name="claim_client_suggest" id="claim_client_suggest"  style="width:300px;">
            <option value="">--Select--</option>
            <option value="(1) Payer - Corrected Claim sent">(1) Payer - Corrected Claim sent</option>
            <option value="(1) Payer - Secondary claim sent">(1) Payer - Secondary claim sent</option>
            <option value="(1) Payer - Re-submitted">(1) Payer - Re-submitted</option>
            <option value="(1) Payer - (Re)submitted Fax">(1) Payer - (Re)submitted Fax</option>
            <option value="(1) Payer - (Re)submitted Paper">(1) Payer - (Re)submitted Paper</option>
            <option value="(1) Payer - Filed a Dispute">(1)  Payer - Filed a Dispute</option>
            <option value="(1) Payer - Filed with Plan Regulators">(1) Payer - Filed with Plan Regulators</option>
            <option value="(1) Payer - Filed with Plan Regulators">(1) Payer - Filed with Plan Regulators</option>
            <option value="(1) Payer - Decimal Balance Issue">(1) Payer - Decimal Balance Issue</option>
            <option value="(1) Payer - Legacy">(1) Payer - Legacy</option>
            <option value="(1) Payer - System Down">(1) Payer - System Down</option>
            <option value="(1) Payer - System Error with Claims">(1) Payer - System Error with Claims</option>
            <option value="(1) Payer - Payer VOB/UR Misquote">(1) Payer - Payer VOB/UR Misquote</option>
            <option value="(1) Payer - Multiplan Format Conflict">(1) Payer - Multiplan Format Conflict</option>
            <option value="(1) Payer - Review/Confirm Payment">(1) Payer - Review/Confirm Payment</option>
            <option value="(1) Payer - Claim not on file">(1) Payer - Claim not on file</option>
            <option value="(1) Payer - Claim paid">(1) Payer - Claim paid</option>
            <option value="(0) PVF - PVF Ready to Post">(0) PVF - PVF Ready to Post</option>
            <option value="(2) Avea - Other Relationship Code error">(2) Avea - Other Relationship Code error</option>
            <option value="(2) Avea bug - resolution requested">(2) Avea bug - resolution requested</option>
            <option value="(6) Billing - Facility Demographics">(6) Billing - Facility Demographics</option>
            <option value="(6) Billing - Pending Manager Review">(6) Billing - Pending Manager Review</option>
            <option value="(8) Closed - Deductible/Co-Insurance">(8) Closed - Deductible/Co-Insurance</option>
            <option value="(8) Closed - Denied as Duplicate">(8) Closed - Denied as Duplicate</option>
            <option value="(8) Closed - Denied due to Timely Filing">(8) Closed - Denied due to Timely Filing</option>
            <option value="(8) Closed - Maxed Benefits">(8) Closed - Maxed Benefits</option>
            <option value="(8) Closed - Medical Notes Insufficient">(8) Closed - Medical Notes Insufficient</option>
            <option value="(8) Closed - No OON Benefits / No SCA">(8) Closed - No OON Benefits / No SCA</option>
            <option value="(8) Closed - Non-Covered / Bundled Code">(8) Closed - Non-Covered / Bundled Code</option>
            <option value="(8) Closed - Paid">(8) Closed - Paid</option>
            <option value="(8) Closed - Paid to patient">(8) Closed - Paid to patient</option>
            <option value="(8) Closed - Paid/Already bill by previous billing comp">(8) Closed - Paid/Already bill by previous billing comp</option>
            <option value="(8) Closed - Per Admin">(8) Closed - Per Admin</option>
            <option value="(8) Closed - Per Facility">(8) Closed - Per Facility</option>
            <option value="(8) Closed - Per Scott">(8) Closed - Per Scott</option>
            <option value="(8) Closed - Plan Terminated">(8) Closed - Plan Terminated</option>
            <option value="(8) Closed - Service is not a covered benefit">(8) Closed - Service is not a covered benefit</option>
            <option value="(9) Suite 204">(9) Suite 204</option>
            <option value="(10) Member - EOB Needed - Sent to Member">(10) Member - EOB Needed - Sent to Member</option>
            <option value="(10) Member - Need Denial Letter to Submit to Secondary">(10) Member - Need Denial Letter to Submit to Secondary</option>
          </select>
        </div>
      </div>


            <div class="row claim_details">
              <div class="col-md-5">
                <label class="claim_data">Call Made</label>
              </div>
              <div class="col-md-4">
                <input type="radio" name="call_made" id="call_yes" required value="Yes">
                <label for="call_yes">Yes</label>
                <input type="radio" name="call_made" id="call_no" required value="No">
                <label for="call_no">No</label>
              </div>
                <!-- <select class="form-control" name="call_made" id="call_made" required="" style="width:300px;">
                  <option value="">--Select--</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select> -->
            </div>

              <div class="row claim_details">
                <div class="col-md-5">
                  <label class="claim_data">Website Utilized</label>
                </div>
                <div class="col-md-2">
                  <select class="form-control" name="website_utilized" id="website_utilized" required="" style="width:300px;">
                    <option value="">--Select--</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                    <option value="Not available">Not Available</option>
                  </select>
                </div>
            </div>

            <div class="row claim_details">
              <div class="col-md-5">
                <label class="claim_data">Type Of Work</label>
              </div>
              <div class="col-md-2">
                <select class="form-control" name="type_of_work" id="type_of_work" required="" style="width:300px;">
                  <option value="">--Select--</option>
                  <option value="0 to 60">0 to 60</option>
                  <option value="Client Login">Client Login</option>
                  <option value="Payment Review">Payment Review</option>
                </select>
              </div>
            </div>




<!--             <div class="row claim_details">
              <div class="col-md-5">
                <label class="claim_data">Insurance Company</label>
              </div>
              <div class="col-md-2">
                <input type="text" class="form-control" name="insurance_company" id="insurance_company" style="width:300px;" value=".">
              </div>
            </div> -->

           <!--  <div class="row claim_details">
              <div class="col-md-5">
                <label class="claim_data">Client Instruction</label>
              </div>
              <div class="col-md-2">
                <select class="form-control" name="client_instruction"  id="client_instruction" required="" style="width:300px;">
                  <option value="">--Select--</option>
                  <option value="A. Payer - Resubmit Claims via Email">A. Payer - Resubmit Claims via Email</option>
                  <option value="A. Payer - Corrected Claim sent">A. Payer - Corrected Claim sent</option>
                  <option value="A. Payer - Secondary claim sent">A. Payer - Secondary claim sent</option>
                  <option value="A. Payer - Re-submitted">A. Payer - Re-submitted</option>
                  <option value="A. Payer - (Re)submitted Fax">A. Payer - (Re)submitted Fax</option>
                  <option value="A. Payer - (Re)submitted Paper">A. Payer - (Re)submitted Paper</option>
                  <option value="A. Payer - Filed a Dispute">A. Payer - Filed a Dispute</option>
                  <option value="A. Payer - Filed with Plan Regulators">A. Payer - Filed with Plan Regulators</option>
                  <option value="A. Payer - Decimal Balance Issue">A. Payer - Decimal Balance Issue</option>
                  <option value="A. Payer - Legacy">A. Payer - Legacy</option>
                  <option value="A. Payer - System Down">A. Payer - System Down</option>
                  <option value="A. Payer - System Error with Claims">A. Payer - System Error with Claims</option>
                  <option value="A. Payer - Payer VOB/UR Misquote">A. Payer - Payer VOB/UR Misquote</option>
                  <option value="A. Payer - Multiplan Format Conflict">A. Payer - Multiplan Format Conflict</option>
                  <option value="A. Payer - Review/Confirm Payment">A.Payer - Review/Confirm Payment</option>
                  <option value="A. Payer - Claim not on file">A. Payer - Claim not on file</option>
                  <option value="A. Payer- Claim paid">A. Payer- Claim paid</option>
                  <option value="B. PVF - PVF Ready to Post">B. PVF - PVF Ready to Post</option>
                  <option value="B. Avea - &quot;Other Relationship Code&quot; error">B. Avea - "Other Relationship Code" error</option>
                  <option value="B. Avea bug - resolution requested">B. Avea bug - resolution requested</option>
                  <option value="C. Billing - Facility Demographics">C. Billing - Facility Demographics</option>
                  <option value="C. Billing - Pending Manager Review">C. Billing - Pending Manager Review</option>
                  <option value="D. Closed - Deductible/Co-Insurance">D. Closed - Deductible/Co-Insurance</option>
                  <option value="D. Closed - Denied as Duplicate">D. Closed - Denied as Duplicate</option>
                  <option value="D. Closed - Denied due to Timely Filing">D. Closed - Denied due to Timely Filing</option>
                  <option value="D. Closed - Maxed Benefits">D. Closed - Maxed Benefits</option>
                  <option value="D. Closed - Medical Notes Insufficient">D. Closed - Medical Notes Insufficient</option>
                  <option value="D. Closed - No OON Benefits / No SCA">D. Closed - No OON Benefits / No SCA</option>
                  <option value="D. Closed - Non-Covered / Bundled Code">D. Closed - Non-Covered / Bundled Code</option>
                  <option value="D. Closed - Paid">D. Closed - Paid</option>
                  <option value="D. Closed - Paid to patient">D. Closed - Paid to patient</option>
                  <option value="D. Closed - Paid/Already bill by previous billing comp.">D. Closed - Paid/Already bill by previous billing comp.</option>
                  <option value="D. Closed - Per Admin">D. Closed - Per Admin</option>
                  <option value="D. Closed - Per Facility">D. Closed - Per Facility</option>
                  <option value="D. Closed - Per Scott">D. Closed - Per Scott</option>
                  <option value="D. Closed - Plan Terminated">D. Closed - Plan Terminated</option>
                  <option value="D. Closed - Service is not a covered benefit">D. Closed - Service is not a covered benefit</option>
                  <option value="E. Suite 204">E. Suite 204</option>
                  <option value="F. Member - EOB Needed - Sent to Member">F. Member - EOB Needed - Sent to Member</option>
                  <option value="F. Member - Need Denial Letter to Submit to Secondary">F. Member - Need Denial Letter to Submit to Secondary</option>
                </select>
              </div>
            </div> -->



      <div class="row claim_details">
        <div class="col-md-5">
          <label class="claim_data">Spell Check Grammarly:</label>
        </div>
        <div class="col-md-4">
          <input type="radio" name="spell_check" id="spell_yes" required value="Yes">
          <label for="spell_yes">Yes</label>
          <input type="radio" name="spell_check" id="spell_no" required value="No">
          <label for="spell_no">No</label>
        </div>
        <!-- <div class="col-md-2">
          <select class="form-control" name="spell_check" id="spell_check" required="" style="width:300px;">
            <option value="">--Select--</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
        </div> -->
      </div>

            <div class="row claim_details">
        <div class="col-md-5">
          <label class="claim_data">ERA Reviewed:</label>
        </div>
        <!-- <div class="col-md-3">
          <select class="form-control" name="era_reviewed" id="era_reviewed" required="" style="width:300px;">
            <option value="">--Select--</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
        </div> -->
        <div class="col-md-4">
          <input type="radio" name="era_reviewed" id="era_yes" required value="Yes">
          <label for="era_yes">Yes</label>
          <input type="radio" name="era_reviewed" id="era_no" required value="No">
          <label for="era_no">No</label>
        </div>
      </div>

      <div class="row claim_details">
        <div class="col-md-5">
          <label class="claim_data">Previous Notes Reviewed :</label>
        </div>
        <div class="col-md-4">
          <input type="radio" name="previous_notes_reviewed" id="pre_notes_yes" required value="Yes">
          <label for="pre_notes_yes">Yes</label>
          <input type="radio" name="previous_notes_reviewed" id="pre_notes_no" required value="No">
          <label for="pre_notes_no">No</label>
        </div>
        <!-- <div class="col-md-2">
          <select class="form-control" name="previous_notes_reviewed" id="previous_notes_reviewed" required="" style="width:300px;">
            <option value="">--Select--</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
        </div> -->
      </div>

      <!-- <div class="row claim_details">
        <div class="col-md-5">
          <label class="claim_data">Line item payment received :</label>
        </div>
        <div class="col-md-2">
          <select class="form-control" name="line_item_payment" id="line_item_payment" required="" style="width:300px;">
            <option value="">--Select--</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
        </div>
      </div> -->

      <div class="row claim_details">
        <div class="col-md-5">
          <label class="claim_data">Fee Schedule Verified :</label>
        </div>
        <div class="col-md-4">
          <input type="radio" name="fee_schedule_verified" id="fee_yes" required value="Yes">
          <label for="fee_yes">Yes</label>
          <input type="radio" name="fee_schedule_verified" id="fee_no" required value="No">
          <label for="fee_no">No</label>
        </div>
        <!-- <div class="col-md-2">
          <select class="form-control" name="fee_schedule_verified" id="fee_schedule_verified" required="" style="width:300px;">
            <option value="">--Select--</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
        </div> -->
      </div>

      <!-- <div class="row claim_details">
        <div class="col-md-5">
          <label class="claim_data">Patient Responsibility Reviewed :</label>
        </div>
        <div class="col-md-2">
          <select class="form-control" name="patient_responsiblity_reviewed" id="patient_responsiblity_reviewed" required="" style="width:300px;">
            <option value="">--Select--</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
        </div>
      </div> -->

      <div class="row claim_details">
        <div class="col-md-5">
          <label class="claim_data">Updated Correct Status :</label>
        </div>
        <div class="col-md-4">
          <input type="radio" name="updated_correct_status" id="crt_yes" required value="Yes">
          <label for="crt_yes">Yes</label>
          <input type="radio" name="updated_correct_status" id="crt_no" required value="No">
          <label for="crt_no">No</label>
        </div>
        <!-- <div class="col-md-2">
          <select class="form-control" name="updated_correct_status" id="updated_correct_status" required="" style="width:300px;">
            <option value="">--Select--</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
        </div> -->
      </div>

      <!-- <div class="row claim_details">
        <div class="col-md-5">
          <label class="claim_data">Updated correct issue Tag & Removed Existing Issue Tag :</label>
        </div>
        <div class="col-md-2">
          <select class="form-control" name="updated_correct_issue_tag" id="updated_correct_issue_tag" required="" style="width:300px;">
            <option value="">--Select--</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
        </div>
      </div> -->

      <div class="row claim_details">
        <div class="col-md-5">
          <label class="claim_data">Updated Follow UP :</label>
        </div>
        <div class="col-md-4">
          <input type="radio" name="updated_followup" id="update_yes" required value="Yes">
          <label for="update_yes">Yes</label>
          <input type="radio" name="updated_followup" id="update_no" required value="No">
          <label for="update_no">No</label>
        </div>
        <!-- <div class="col-md-2">
          <select class="form-control" name="updated_followup" id="updated_followup" required="" style="width:300px;">
            <option value="">--Select--</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
        </div> -->
      </div>

      <div class="row claim_details">
        <div class="col-md-5">
          <label class="claim_data">Notes Posted :</label>
        </div>
        <div class="col-md-4">
          <input type="radio" name="notes_posted" id="notes_yes" required value="Yes">
          <label for="notes_yes">Yes</label>
          <input type="radio" name="notes_posted" id="notes_no" required value="No">
          <label for="notes_no">No</label>
        </div>
        <!-- <div class="col-md-2">
          <select class="form-control" name="notes_posted" id="notes_posted" required="" style="width:300px;">
            <option value="">--Select--</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
        </div> -->
      </div>
<br>
    <input type="submit" value="Submit" name="submit" id="call_submit" class="start-break" style="font-size:15px;">
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>


</div>

<script>

$(document).ready(function() {
    var time = "00:00:00",
    parts    = time.split(':'),
    hours    = +parts[0],
    minutes  = +parts[1],
    seconds  = +parts[2],
    span     = $('#countdown');

    function correctNum(num){
      return (num<10)? ("0"+num):num;
    }

    var timer = setInterval(function(){
      seconds++;
        if(seconds == 59) {
            minutes++;
            seconds=0;
            if(minutes >= 59) {
              //minutes = 59;
                hours++;
                minutes=0;
                if(hours==-1) {
                  alert("timer finished");
                  clearInterval(timer);
                  return;
                }
            }
        }
        span.text(correctNum(hours) + " : " + correctNum(minutes) + " : " + correctNum(seconds));
    }, 1000);
});

function dispos(){
  var disp_val = $('#disposition').val();
  if(disp_val=='Active Disposition'){
    $('#yes_disp').show();
    $('#client_suggest').hide();
    $('#claim_yes').prop('required',true);
    $('#claim_client_suggest').prop('required',false);
    $('#claim_client_suggest').val('');

  }
  if(disp_val=="Client Instruction"){
    $('#client_suggest').show();
    $('#yes_disp').hide();
    $('#claim_client_suggest').prop('required',true);
    $('#claim_yes').prop('required',false);
    $('#claim_yes').val('');

  }
}


function workStatus(){
  var work_status =$('#work_status').val();
  if(work_status=='Not Workable'){
    $("#claim_call :input").prop("required", false);
  }
  else{
    $("#claim_call :input").prop("required", true);
  }
}

$(document).on('submit', '#claim_call', function(event){

  var work_status                     = $('#work_status').val();
  var call_made                       = $('input[name=call_made]:checked').val();
  var website_utilized                = $('#website_utilized').val();
  var type_of_work                    = $('#type_of_work').val();
  var disposition                     = $('#disposition').val();
  var disposition_claims_yes          = $('#claim_yes').val();
  var disposition_claims_suggest      = $('#claim_client_suggest').val();
  //var insurance_company             = $('#insurance_company').val();
  //var client_instruction            = $('#client_instruction').val();
  var notes                           = $('#notes').val();
  var spell_check                     = $('input[name=spell_check]:checked').val();
  var era_reviewed                    = $('input[name=era_reviewed]:checked').val();
  var previous_notes_reviewed         = $('input[name=previous_notes_reviewed]:checked').val();
  var line_item_ptayment              = '';
  var fee_schedule_verified           = $('input[name=fee_schedule_verified]:checked').val();
  var patient_responsiblity_reviewed  = '';
  var updated_correct_status          = $('input[name=updated_correct_status]:checked').val();
  var updated_correct_issue_tag       = '';
  var updated_followup                = $('input[name=updated_followup]:checked').val();
  var notes_posted                    = $('input[name=notes_posted]:checked').val();
  var unique_id                       = $('#unique_id').val();
  var call_time                       = $('#countdown').text();


  $.ajax({
    type: "POST",
    url : '<?php echo base_url();?>start_call/submit_claim',
    data: 'call_time=' +call_time +'&call_made=' + call_made + '&work_status=' + work_status  + '&website_utilized=' + website_utilized + '&type_of_work=' + type_of_work + '&disposition=' + disposition +'&disposition_claims_yes=' + disposition_claims_yes +'&disposition_claims_suggest=' + disposition_claims_suggest + '&notes=' + notes +'&spell_check=' + spell_check + '&era_reviewed=' + era_reviewed  + '&previous_notes_reviewed=' + previous_notes_reviewed + '&line_item_ptayment=' + line_item_ptayment +'&fee_schedule_verified=' + fee_schedule_verified + '&patient_responsiblity_reviewed=' + patient_responsiblity_reviewed  + '&updated_correct_status=' + updated_correct_status + '&updated_correct_issue_tag=' + updated_correct_issue_tag + '&updated_followup=' + updated_followup + '&notes_posted=' + notes_posted + '&unique_id=' + unique_id,
    success: function(response){
      //alert(response);
      if(response=="true"){
        alert("Claim Submitted Successfully...!");
        //swal("Success...","Claim Submitted Successfully...!","success");
        $('#claim_call')[0].reset();
        //window.top.close();
        //window.history.back();
        //location.reload();
        //window.location.replace("<?php echo base_url();?>home/index");
        window.location.href='<?php echo base_url();?>home/index';
      }
    },
    error: function() { alert("Error posting feed."); }
  });

});

</script>
</body>
</html>
