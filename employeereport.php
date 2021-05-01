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
          <h4 class="m-0"><i class=""></i> Employee Report</h4>
        </div>
      </div>
  
    <form action="employeedetailreport.php" class="mt-5" method="POST" id="employeereportform">
    <div class="two">
      <div class="row">  
            <div class="col-sm-4">
                    <label style="padding:5px">Report Type:</label>
                </div>
                <div class="col-sm-8">
                    <div class='input-group'>
                        <select class="form-control" id="selectReport" name="selectReport" >
                            <option value="">Report Type</option>
                            <option value="detailreport">Employee Detail Report</option>
                            <option value="summaryreport">Employee Summary Report</option>
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
                            <option value="">---</option>
                            
                            
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
                          <option value="">---</option>
                           

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
                    <input type='date' id='fromjoinDate' name="fromjoinDate" class="form-control" /> &nbsp &nbsp
                    <input type='date' id='tojoinDate' name="tojoinDate" class="form-control" />
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
                    <input type='date' id='fromresignDate' name="fromresignDate" class="form-control" /> &nbsp &nbsp
                    <input type='date' id='toresignDate' name="toresignDate" class="form-control" />
                </div>
            </div>
        </div>
            <br>
            <div style="text-align:center">
                <button type="submit" value="submit" name="submit" id="btnGenerateReport"  class="btn btn-primary btn-lg">Generate Report</button>                
            </div>
            <br> 
        </div>
    </div>

</form>
  
  
</body>
</html>


