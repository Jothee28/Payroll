<?php
require_once 'core/init.php';
$userlevel = "";
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
  <div class="d-flex" id="wrapper">
    <?php include 'includes/navbar.php';?>
    <div id="page-content-wrapper">
      <div class="container-fluid" id="content"> 
        <h4 class="my-5 font-weight-light">Government Report</h4>
        
        <ul class="nav nav-tabs row px-2" id="governmentalltab">
          <li class='nav-item col-12 col-xl-2 p-0'>
            <a class='nav-link active rounded-0 text-center' data-toggle='tab' href='#epf'><span class="font-weight-bold">EPF</span></a>
          </li>
          <li class='nav-item col-12 col-xl-2 p-0'>
            <a class='nav-link rounded-0 text-center' data-toggle='tab' href='#socso'><span class="font-weight-bold">SOCSO</span></a>
          </li>
          <li class='nav-item col-12 col-xl-2 p-0'>
            <a class='nav-link  rounded-0 text-center' data-toggle='tab' href='#eis'><span class="font-weight-bold">EIS</span></a>
          </li>
          
        </ul>

   <!-- Tab panes -->
   <!-- Tab epf -->
  <div class="tab-content">
    <div id="epf" class="container tab-pane active"><br>
      <form action="dashboard-epf.php" class="mt-5" method="POST" id="epfreportform">
    <div class="two">
      <div class="row">  
            <div class="col-sm-4">
                    <label style="padding:5px">Report Type:</label>
                </div>
                <div class="col-sm-8">
                    <div class='input-group'>
                        <select class="form-control" id="selectReport" name="selectReport" required>
                            <option value="">Report Type</option>
                            <option value="boranga">Borang A</option>
                            <option value="borang17a">Borang 17A</option>
                            <option value="monthlyepf">Monthly EPF Listing</option>
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
                    <label style="padding:5px">Department:</label>
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
                <label style="padding:5px">Period:</label>
            </div>
            <div class="col-sm-8">
                <div class='input-group date' >
                    <input type='month' id='period' name="period" class="form-control" /> &nbsp &nbsp
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

<!-- Tab socso -->

    <div id="socso" class="container tab-pane fade"><br>
      <form action="dashboard-socso.php" class="mt-5" method="POST" id="socsoreportform">
    <div class="two">
      <div class="row">  
            <div class="col-sm-4">
                    <label style="padding:5px">Report Type:</label>
                </div>
                <div class="col-sm-8">
                    <div class='input-group'>
                        <select class="form-control" id="selectReport" name="selectReport" required>
                            <option value="">Report Type</option>
                            <option value="borang2">Borang 2</option>
                            <option value="borang8a">Borang 8A</option>
                            <option value="lampiranA">Lampiran A</option>
                            <option value="monthlysocso">Monthly Socso Listing</option>
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
                    <label style="padding:5px">Department:</label>
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
                <label style="padding:5px">Period:</label>
            </div>
            <div class="col-sm-8">
                <div class='input-group date' >
                    <input type='month' id='period' name="period" class="form-control" /> &nbsp &nbsp
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

<!-- Tab eis -->

    <div id="eis" class="container tab-pane fade"><br>
      <form action="dashboard-eis.php" class="mt-5" method="POST" id="eiseportform">
    <div class="two">
      <div class="row">  
            <div class="col-sm-4">
                    <label style="padding:5px">Report Type:</label>
                </div>
                <div class="col-sm-8">
                    <div class='input-group'>
                        <select class="form-control" id="selectReport" name="selectReport" required>
                            <option value="">Report Type</option>
                            <option value="borangsip2">Borang SIP 2</option>
                            <option value="monthlyeis">Monthly EIS Listing</option>
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
                    <label style="padding:5px">Department:</label>
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
                <label style="padding:5px">Period:</label>
            </div>
            <div class="col-sm-8">
                <div class='input-group date' >
                    <input type='month' id='period' name="period" class="form-control" /> &nbsp &nbsp
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
</body>
</html>