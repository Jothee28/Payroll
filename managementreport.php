<?php 
require_once 'core/init.php';
$user = new User();
if(!$user->isLoggedIn()){
  Redirect::to("login.php");
}else{
  $resultresult = $user->data();
  $userlevel = $resultresult->role;
  if($resultresult->verified == false || $resultresult->superadmin == true){
    $user->logout();
    Redirect::to("login.php?error=error");
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Management - DoerHRM</title> 
  <?php
  include 'includes/header.php';
  ?>
<body>
<?php include 'includes/topbar.php';?>
<div class="d-flex bg-white" id="wrapper">
<?php include 'includes/navbar.php'; ?>
<div class="container" id="content">

  
    <div id="page-content-wrapper">
    <div class="container-fluid" id="content"> 
      <div class="row my-4">
        <div class="col">
          <h4 class="m-0"><i class=""></i> Management Report</h4>
        </div>
      </div>
      
     

      <ul class="nav nav-tabs row px-2">
        <li class="nav-item col-12 col-xl-2 p-0">
          <a class="nav-link active rounded-0 text-center active" data-toggle="tab" href="#payslip"><span class="font-weight-bold">PAYSLIP</span></a>
        </li>
        
        <li class="nav-item col-12 col-xl-2 p-0">
          <a class="nav-link rounded-0 text-center" data-toggle="tab" href="#payroll"><span class="font-weight-bold">PAYROLL</span></a>  
        </li>

        <li class="nav-item col-12 col-xl-2 p-0">
          <a class="nav-link rounded-0 text-center" data-toggle="tab" href="#leave"><span class="font-weight-bold">LEAVE</span></a>  
        </li>

        
      </ul>

  <!-- Tab panes -->
   <!-- Tab payslip -->
  <div class="tab-content">
    <div id="payslip" class="container tab-pane active"><br>
      <form action="dashboard-pasylip.php" class="mt-5" method="POST" id="employeereportform">
    <div class="two">
      <div class="row">  
            <div class="col-sm-4">
                    <label style="padding:5px">Report Type:</label>
                </div>
                <div class="col-sm-8">
                    <div class='input-group'>
                        <select class="form-control" id="selectReport" name="selectReport">
                            <option value="">Report Type</option>
                            <option value="payslipA1">Payslip A1</option>
                            <option value="payslipA2">Payslip A2</option>
                        </select>
                        <small><span id="selectReporterror"></span></small>
                    </div>
                </div>
            </div> 
        <br>

        <div class="row">  
            <div class="col-sm-4">
              <input type="hidden" id="selectemployee" name="selectemployee">
                    <label style="padding:5px">Employee Name:</label>

                </div>
                <div class="col-sm-8">
                    <div class='input-group'>
                        <select class="form-control" id="selectemployee">
                            <option value="">--</option>
                            
                     <?php
        
                      $userobject = new User();
                      $userresult = $userobject->searchAllUser();
                      if ($userresult) {
                        foreach ($userresult as $row) {
                          ?>
                        
                      <option value="<?php echo $row->userID?>"><?php echo $row->firstname." ".$row->lastname;?></option>
                      <?php
                 }
                  }
                 ?>
                      
                        </select>
                        <small><span id="selectemployeeerror"></span></small>
                    </div>
                </div>
            </div> 
        <br>

        <div class="row">  
            <div class="col-sm-4">
              <input type="hidden" id="selectDepartment" name="selectDepartment">
                    <label style="padding:5px">Department</label>
                </div>
                <div class="col-sm-8">
                    <div class='input-group'>
                        <select class="form-control" id="selectDepartment" name="filterChoice">
                            <option value="">--</option>

                            <?php
                    if($resultresult->corporateID){
                      $groupobject = new Group();
                      $groupresult = $groupobject->searchGroupWithCorporate($resultresult->corporateID);
                      if($groupresult){
                        foreach ($groupresult as $row) {
                          ?>
                          <option value="<?php echo $row->groupID?>"><?php echo $row->groups?></option>
                          <?php
                        }
                      }
                    }else{
                      $groupobject = new Group();
                      $groupresult = $groupobject->searchCompany($resultresult->companyID);
                      if($groupresult){
                        foreach ($groupresult as $row) {
                          ?>
                          <option value="<?php echo $row->groupID?>"><?php echo $row->groups?></option>
                          <?php
                        }
                      }
                    }
                    ?>
                      
                        </select>
                        <small><span id="selectDepartmenterror"></span></small>
                    </div>
                </div>
            </div> 
        <br>

        <div class="row">
            <div class="col-sm-4">
                <label style="padding:5px">Period:</label>
            </div>
            <div class="col-sm-8">
                <div class='input-group date' >
                    <input type='month' id='period' name="period" class="form-control" />
                    <small><span id="joinDateerror"></span></small>
                </div>
            </div>

        </div>
        <br>
            <div style="text-align:center">
                <button type="submit" value="submit" name="submit" id="btnGenerateReport"  class="btn btn-primary btn-lg">Generate Report</button>                
            </div>
            <br> 
      </div>
    </form>
    </div>

     <!-- Tab payroll -->

    <div id="payroll" class="container tab-pane fade"><br>
      <form action="dashboard-payroll.php" class="mt-5" method="POST" id="employeereportform">
    <div class="two">
      <div class="row">  
            <div class="col-sm-4">
                    <label style="padding:5px">Report Type:</label>
                </div>
                <div class="col-sm-8">
                    <div class='input-group'>
                        <select class="form-control" id="selectReport" name="selectReport">
                            <option value="">Report Type</option>
                            <option value="payrollsummary">Payroll Summary</option>
                            <option value="payrollallowance">Payroll Allowance</option>
                            <option value="payrolldeduction">Payroll Deduction</option>
                        </select>
                        <small><span id="selectReporterror"></span></small>
                    </div>
                </div>
            </div> 
        <br>

        <div class="row">  
            <div class="col-sm-4">
              <input type="hidden" id="selectemployee" name="selectemployee">
                    <label style="padding:5px">Employee Name:</label>

                </div>
                <div class="col-sm-8">
                    <div class='input-group'>
                        <select class="form-control" id="selectemployee">
                            <option value="">--</option>
                            
                     <?php
        
                      $userobject = new User();
                      $userresult = $userobject->searchAllUser();
                      if ($userresult) {
                        foreach ($userresult as $row) {
                          ?>
                        
                      <option value="<?php echo $row->userID?>"><?php echo $row->firstname." ".$row->lastname;?></option>
                      <?php
                 }
                  }
                 ?>
                      
                        </select>
                        <small><span id="selectemployeeerror"></span></small>
                    </div>
                </div>
            </div> 
        <br>

        <div class="row">  
            <div class="col-sm-4">
              <input type="hidden" id="selectDepartment" name="selectDepartment">
                    <label style="padding:5px">Department</label>
                </div>
                <div class="col-sm-8">
                    <div class='input-group'>
                        <select class="form-control" id="selectDepartment" name="filterChoice">
                            <option value="">--</option>

                            <?php
                    if($resultresult->corporateID){
                      $groupobject = new Group();
                      $groupresult = $groupobject->searchGroupWithCorporate($resultresult->corporateID);
                      if($groupresult){
                        foreach ($groupresult as $row) {
                          ?>
                          <option value="<?php echo $row->groupID?>"><?php echo $row->groups?></option>
                          <?php
                        }
                      }
                    }else{
                      $groupobject = new Group();
                      $groupresult = $groupobject->searchCompany($resultresult->companyID);
                      if($groupresult){
                        foreach ($groupresult as $row) {
                          ?>
                          <option value="<?php echo $row->groupID?>"><?php echo $row->groups?></option>
                          <?php
                        }
                      }
                    }
                    ?>
                      
                        </select>
                        <small><span id="selectDepartmenterror"></span></small>
                    </div>
                </div>
            </div> 
        <br>

        <div class="row">
            <div class="col-sm-4">
                <label style="padding:5px">Period:</label>
            </div>
            <div class="col-sm-8">
                <div class='input-group date' >
                    <input type='month' id='period' name="period" class="form-control" />
                    <small><span id="joinDateerror"></span></small>
                </div>
            </div>

        </div>
        <br>
            <div style="text-align:center">
                <button type="submit" value="submit" name="submit" id="btnGenerateReport"  class="btn btn-primary btn-lg">Generate Report</button>                
            </div>
            <br> 
      </div>
    </form>
    </div>

 <!-- Tab leave -->

    <div id="leave" class="container tab-pane fade"><br>
      <form action="dashboard-leave.php" class="mt-5" method="POST" id="employeereportform">
    <div class="two">
      <div class="row">  
            <div class="col-sm-4">
                    <label style="padding:5px">Report Type:</label>
                </div>
                <div class="col-sm-8">
                    <div class='input-group'>
                        <select class="form-control" id="selectReport" name="selectReport">
                            <option value="">Report Type</option>
                            <option value="leaverequest">Leave Request Listing</option>
                            <option value="leavecredit">Leave Credit Report</option>
                        </select>
                        <small><span id="selectReporterror"></span></small>
                    </div>
                </div>
            </div> 
        <br>

        <div class="row">  
            <div class="col-sm-4">
              <input type="hidden" id="selectemployee" name="selectemployee">
                    <label style="padding:5px">Employee Name:</label>

                </div>
                <div class="col-sm-8">
                    <div class='input-group'>
                        <select class="form-control" id="selectemployee">
                            <option value="">--</option>
                            
                     <?php
        
                      $userobject = new User();
                      $userresult = $userobject->searchAllUser();
                      if ($userresult) {
                        foreach ($userresult as $row) {
                          ?>
                        
                      <option value="<?php echo $row->userID?>"><?php echo $row->firstname." ".$row->lastname;?></option>
                      <?php
                 }
                  }
                 ?>
                      
                        </select>
                        <small><span id="selectemployeeerror"></span></small>
                    </div>
                </div>
            </div> 
        <br>

        <div class="row">  
            <div class="col-sm-4">
              <input type="hidden" id="selectDepartment" name="selectDepartment">
                    <label style="padding:5px">Department</label>
                </div>
                <div class="col-sm-8">
                    <div class='input-group'>
                        <select class="form-control" id="selectDepartment" name="filterChoice">
                            <option value="">--</option>

                            <?php
                    if($resultresult->corporateID){
                      $groupobject = new Group();
                      $groupresult = $groupobject->searchGroupWithCorporate($resultresult->corporateID);
                      if($groupresult){
                        foreach ($groupresult as $row) {
                          ?>
                          <option value="<?php echo $row->groupID?>"><?php echo $row->groups?></option>
                          <?php
                        }
                      }
                    }else{
                      $groupobject = new Group();
                      $groupresult = $groupobject->searchCompany($resultresult->companyID);
                      if($groupresult){
                        foreach ($groupresult as $row) {
                          ?>
                          <option value="<?php echo $row->groupID?>"><?php echo $row->groups?></option>
                          <?php
                        }
                      }
                    }
                    ?>
                      
                        </select>
                        <small><span id="selectDepartmenterror"></span></small>
                    </div>
                </div>
            </div> 
        <br>

        <div class="row">
            <div class="col-sm-4">
                <label style="padding:5px">Period:</label>
            </div>
            <div class="col-sm-8">
                <div class='input-group date' >
                    <input type='month' id='period' name="period" class="form-control" />
                    <small><span id="joinDateerror"></span></small>
                </div>
            </div>

        </div>
        <br>
            <div style="text-align:center">
                <button type="submit" value="submit" name="submit" id="btnGenerateReport"  class="btn btn-primary btn-lg">Generate Report</button>                
            </div>
            <br> 
      </div>
    </form>
    </div>

 
    </div>

  </div>
</div>
            
</div>
</div>
</div>
</body>
</html>

