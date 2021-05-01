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
  <title>Report - DoerHRM</title> 
  <?php
  include 'includes/header.php';
  ?>
</head>
<body>
<?php include 'includes/topbar.php';?>
<div class="d-flex bg-white" id="wrapper">
<?php include 'includes/navbar.php'; ?>
<div class="container" id="content">
<div id="page-content-wrapper">
    <div class="container-fluid" id="content"> 
      <div class="row my-4">
        <div class="col">
          <h4 class="m-0"><i class=""></i> Human Resource Letter</h4>
        </div>
      </div>
  
    <form action="hrdetailreport.php" method="post" id="hrreportform">
    <div class="two">
      <div class="row">  
            <div class="col-sm-4">
                    <label style="padding:5px">Letter Type:</label>
                </div>
                <div class="col-sm-8">
                    <div class='input-group'>
                        <select class="form-control" id="selectReport" name="selectReport" required>
                            <option value="">Letter Type</option>
                            <option value="promotion">Promotion letter</option>
                            <option value="termination">Termination Letter</option>
                            <option value="warning">Warning Letter</option>
                            <option value="permit">Permit Letter</option>
                            <option value="probation">Extend Probation Letter</option>
                        </select>
                    </div>
                </div>
            </div> 
        <br>

        <div class="row">  
            <div class="col-sm-4">
                    <label style="padding:5px">Employee Name:</label>
                </div>
                <div class="col-sm-8">
                    <div class='input-group'>
                        <select class="form-control" id="selectemployee" name="selectemployee">
                          <option value="">--</option>
                            <option value="all">All Employee</option> 
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
                    </div>
                </div>
            </div> 
        <br>

        <div class="row">  
            <div class="col-sm-4">
                    <label style="padding:5px">Department</label>
                </div>
                <div class="col-sm-8">
                    <div class='input-group'>
                        <select class="form-control" id="selectDepartment" name="selectDepartment">
                            <option value="">--</option>
                            <option value="all">All Department</option>
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
                    </div>
                </div>
            </div> 
        <br>

        <div class="row">
            <div class="col-sm-4">
                <label style="padding:5px">JOIN DATE:</label>
            </div>
            <div class="col-sm-8">
                <div class='input-group date' >
                    <input type='date' id='fromJoinDate' name="fromJoinDate" class="form-control" /> &nbsp &nbsp
                    <input type='date' id='toJoinDate' name="toJoinDate" class="form-control" />
                </div>
            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-sm-4">
                <label style="padding:5px">RESIGN DATE:</label>
            </div>
            <div class="col-sm-8">
                <div class='input-group date' >
                    <input type='date' id='fromResignDate' name="fromResignDate" class="form-control" /> &nbsp &nbsp
                    <input type='date' id='toResignDate' name="toResignDate" class="form-control" />
                </div>
            </div>
            
        </div>
            <br>
            <div style="text-align:center">
                <button type="submit"  id="submit" class="btn btn-primary btn-lg">Generate Report</button>
            </div>
            <br> 
        </div>
    </div>

</form>
  
  
</body>
</html>


