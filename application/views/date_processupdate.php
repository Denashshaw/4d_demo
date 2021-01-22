<form action="<?php echo base_url();?>Dataprocess/updateDataProcess" method="POST" id="updateform" style="font-size:12px;">
  <input type="hidden" id="updateid" name="updateid">
  <div class="row">
    <div class="col-md-3">
        <p  style="font-size: 12px;">Date: <span id="start">*</span></p>
        <input class="col-md-12 col-xs-12 form-control" type="text"   id="Updatedateprocess" name="Updatedateprocess" placeholder="DD-MM-YYYY" required="" readonly>
        <br>
    </div>
    <div class="col-md-3">
        <p >Employee Name: <span id="start">*</span></p>
            <input class="col-md-12 col-xs-12 form-control"  type="text" id="Updateempname" name="Updateempname"  required="" readonly>
        <br>
    </div>
    <div class="col-md-3">
        <p  style="font-size: 12px;">Client Code: <span id="start">*</span></p>
        <select class="col-md-12 col-xs-12 form-control" id="Updateclientcode" name="Updateclientcode" placeholder="EnterClient Code" required="" style="width:100%">
          <?php foreach($clientdetails as $cc){ ?>
            <option value="<?php echo $cc->ClientCode; ?>"><?php echo $cc->ClientCode; ?></option>

          <?php } ?>
        </select>

        <br>
    </div>

  </div>
  <div class="row emp-table">
    <div class="col-md-12"><h5><u>Demo/Charges Production</u></h5></div><br>
    <table class="table" id="tabledata"  >
      <thead >
        <tr >
          <th style="font-size:12px;">Demo's Entered</th>
          <th style="font-size:12px;">Charges Entered</th>
          <th style="font-size:12px;">Online Eligiblity Verified</th>
          <th style="font-size:12px;">Expected Production</th>
          <th style="font-size:12px;">Total Production</th>
          <th style="font-size:12px;">Production Production</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><input class="col-md-12 col-xs-12 form-control updatedemo" type="text" id="updatedemos" name="updatedemos" pattern="[0-9]+" maxlength="4"></td>
          <td><input class="col-md-12 col-xs-12 form-control updatedemo" type="text" id="UpdatechargesEntered" name="UpdatechargesEntered"   pattern="[0-9]+"   maxlength="4"></td>
          <td><input class="col-md-12 col-xs-12 form-control updatedemo" type="text" id="UpdateonlineEligiblity" name="UpdateonlineEligiblity" pattern="[0-9]+" maxlength="4" ></td>
          <td>
                <input class="col-md-12 col-xs-12 form-control" type="text" id="updatedemochargesExp" name="updatedemochargesExp" pattern="[0-9]+"  maxlength="4"
                <?php if($userdata['role']=='agent'){ ?> readonly <?php  } ?> >
          </td>
          <td>
                <input class="col-md-12 col-xs-12 form-control" type="text" id="updatedemochargesTotal" name="updatedemochargesTotal" pattern="[0-9]+" readonly>
          </td>
            <td><input class="col-md-12 col-xs-12 form-control" type="text" id="updateDemoPP" name="updateDemoPP" readonly></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="row emp-table">
    <div class="col-md-12"><h5><u>Payments Production</u></h5></div><br>
    <table class="table" id="tabledata"  >
      <thead >
        <tr >
          <th style="font-size:12px;">Manual Posting</th>
          <th style="font-size:12px;">ERA Posting</th>
          <th style="font-size:12px;">Denials Captured</th>
          <th style="font-size:12px;">Expected Production</th>
          <th style="font-size:12px;">Total Production</th>
          <th style="font-size:12px;">Production Production</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><input class="col-md-12 col-xs-12 form-control updatepayinput" type="text" id="updatemanualpost" name="updatemanualpost" pattern="[0-9]+" maxlength="4" ></td>
          <td><input class="col-md-12 col-xs-12 form-control updatepayinput" type="text" id="updateERApost" name="updateERApost"   pattern="[0-9]+"   maxlength="4"></td>
          <td><input class="col-md-12 col-xs-12 form-control updatepayinput" type="text" id="updateDenialsCaptured" name="updateDenialsCaptured" pattern="[0-9]+"  maxlength="4"></td>
          <td>
               <input class="col-md-12 col-xs-12 form-control" type="text" id="updatepaymentExp" name="updatepaymentExp" pattern="[0-9]+"  maxlength="4" <?php if($userdata['role']=='agent'){ ?> readonly <?php  } ?>>
          </td>
          <td>
                <input class="col-md-12 col-xs-12 form-control" type="text" id="updatepaymentTotal" name="updatepaymentTotal" pattern="[0-9]+" readonly>
          </td>
            <td><input class="col-md-12 col-xs-12 form-control" type="text" id="updatePaymentPP" name="updatePaymentPP" readonly></td>
        </tr>
      </tbody>
    </table>
  </div>

    <div class="row emp-table">
      <div class="col-md-6"><h5><u>Audit Production</u></h5></div><br>
      <table class="table" id="tabledata"  >
        <thead >
          <tr >
            <th style="font-size:12px;">Demo/Charges QC</th>
            <th style="font-size:12px;">Expected Production</th>
            <th style="font-size:12px;">Production Percentage</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input class="col-md-6 col-xs-6 form-control" type="text" id="updateAuditDemochar"  maxlength="4" name="updateAuditDemochar" pattern="[0-9]+" ></td>
            <td><input class="col-md-6 col-xs-6  form-control" type="text" id="updateAuditExpe1"  maxlength="4" name="updateAuditExpe1"   pattern="[0-9]+"  <?php if($userdata['role']=='agent'){ ?> readonly <?php  } ?> ></td>
            <td><input class="col-md-6 col-xs-6  form-control" type="text" id="updateAuditPP1"   name="updateAuditPP1" readonly ></td>
          </tr>
        </tbody>
      </table>
      <table class="table" id="tabledata"  >
        <thead >
          <tr >
            <th style="font-size:12px;">Payments QC</th>
            <th style="font-size:12px;">Expected Production</th>
            <th style="font-size:12px;">Production Percentage</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input class="col-md-6 col-xs-6 form-control" type="text" id="updateAuditpayments"  maxlength="4" name="updateAuditpayments" pattern="[0-9]+" ></td>
            <td><input class="col-md-6 col-xs-6  form-control" type="text" id="updateAuditExpe2"  maxlength="4" name="updateAuditExpe2"   pattern="[0-9]+"  <?php if($userdata['role']=='agent'){ ?> readonly <?php  } ?> ></td>
            <td><input class="col-md-6 col-xs-6  form-control" type="text" id="updateAuditPP2"  name="updateAuditPP2" readonly></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="row">
    <div align="col-md-12" style="padding-top:2%;padding-left:40%">
          <input type="submit" class="check-in" style="margin-left:10px;float:right">
          <input type="reset" class="check-in" style="background-color:red;">
    </div>
  </div>
  </form>
