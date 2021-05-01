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
<div style="text-align:right">
  
  <script>
  $(document).ready(function () {
    window.print();
  });
  </script>
</div>

<div class="container" id="content">
<div id="page-content-wrapper">
    <div class="container-fluid" id="content"> 
      
      <?php 
      if(Input::exists()){
        $payrolllist =array();
        $selectReport = escape(Input::get('selectReport'));
        $selectemployee = escape(Input::get('selectemployee'));
        $selectDepartment = escape(Input::get('selectDepartment'));
        $period = escape(Input::get('period'));
      }   
      echo $selectReport;
      echo $selectemployee;
      echo $selectDepartment;
      echo $period;
      ?>
      <?php
      //first condition
      if($selectReport==="payrollsummary"){
        if($selectDepartment){
          if($selectemployee){
            $userobject = new User();
            $useresult = $userobject->searchOnly($selectemployee);
            if($useresult){
              array_push($payrolllist, $useresult->userID);
            }
          }
          else{
            $groupobject = new Group();
            $groupresult = $groupobject->searchGroupMember($selectDepartment);
            if ($groupresult) {
              foreach ($groupresult as $row) {
                $userobject = new User();
                $useresult = $userobject->searchOnly($row->member_id); 
                if($useresult){
                  array_push($payrolllist, $useresult->userID);
                }
              }
            }
          }
        }else{
          if($selectemployee){
            $userobject = new User();
            $useresult = $userobject->searchOnly($selectemployee);
            if($useresult){
              array_push($payrolllist, $useresult->userID);
            }
          }
          else{//checkbalik condition all user
            if($resultresult->role === "Chief"){
                $userobject = new User();
                $useresult = $userobject->searchWithCorporate($resultresult->corporateID);
                if($useresult){
                  foreach ($useresult as $row) {
                    array_push($payrolllist, $row->userID);
                  }
                }
              }elseif($companyresult && $resultresult->role === "Superior"){
                foreach ($companyresult as $row) {
                  $userobject = new User();
                  $useresult = $userobject->searchWithCompany($row->companyID);
                  if($useresult){
                    foreach ($useresult as $row) {
                      array_push($payrolllist, $row->userID);
                    }
                  }
                }
              }
           }
         }
        }//second condition
        elseif ($selectReport==="payrollallowance"){ // summary
          if($selectDepartment){
            if($selectemployee){
              $userobject = new User();
              $useresult = $userobject->searchOnly($selectemployee);
              if($useresult){
                array_push($payrolllist, $useresult->userID);
              }
            }
            else{
              $groupobject = new Group();
              $groupresult = $groupobject->searchGroupMember($selectDepartment);
              if ($groupresult) {
                foreach ($groupresult as $row) {
                  $userobject = new User();
                  $useresult = $userobject->searchOnly($row->member_id); 
                  if($useresult){
                  array_push($payrolllist, $useresult->userID);
                }
              }
            }
          }
        }
        else{
          if($selectemployee){
            $userobject = new User();
            $useresult = $userobject->searchOnly($selectemployee);
            }
            else{//checkbalik condition all user
              if($resultresult->role === "Chief"){
                $userobject = new User();
                $useresult = $userobject->searchWithCorporate($resultresult->corporateID);
                if($useresult){
                  foreach ($useresult as $row) {
                    array_push($payrolllist, $row->userID);
                  }
                }
              }elseif($companyresult && $resultresult->role === "Superior"){
                foreach ($companyresult as $row) {
                  $userobject = new User();
                  $useresult = $userobject->searchWithCompany($row->companyID);
                  if($useresult){
                    foreach ($useresult as $row) {
                      array_push($payrolllist, $row->userID);
                    }
                  }
                }
              }
            }
          }
        }
        //third condition
        else{ // summary
          if($selectDepartment){
            if($selectemployee){
              $userobject = new User();
              $useresult = $userobject->searchOnly($selectemployee);
              if($useresult){
                array_push($payrolllist, $useresult->userID);
              }
            }
            else{
              $groupobject = new Group();
              $groupresult = $groupobject->searchGroupMember($selectDepartment);
              if ($groupresult) {
                foreach ($groupresult as $row) {
                  $userobject = new User();
                  $useresult = $userobject->searchOnly($row->member_id); 
                  if($useresult){
                  array_push($payrolllist, $useresult->userID);
                }
              }
            }
          }
        }
        else{
          if($selectemployee){
            $userobject = new User();
            $useresult = $userobject->searchOnly($selectemployee);
            }
            else{//checkbalik condition all user
              if($resultresult->role === "Chief"){
                $userobject = new User();
                $useresult = $userobject->searchWithCorporate($resultresult->corporateID);
                if($useresult){
                  foreach ($useresult as $row) {
                    array_push($payrolllist, $row->userID);
                  }
                }
              }elseif($companyresult && $resultresult->role === "Superior"){
                foreach ($companyresult as $row) {
                  $userobject = new User();
                  $useresult = $userobject->searchWithCompany($row->companyID);
                  if($useresult){
                    foreach ($useresult as $row) {
                      array_push($payrolllist, $row->userID);
                    }
                  }
                }
              }
            }
          }
        }

  $payrolllist = array_unique($payrolllist);
  $payrolllist = array_values($payrolllist);
  print_r($payrolllist);
  if ($selectReport==="payrollsummary") {
    for ($i=0; $i < count($payrolllist) ; $i++) { 
      $userobject = new User();
      $useresult = $userobject->searchOnly($payrolllist[$i]);
      echo"
      <div class='container' style=' border-style: solid; border-width: 1px; border-color: black;' >
    <br>
    <h6 class='font-weight-bold' align='center' style='font-family:verdana; font-size: small; '>Payroll Summary Report</h6>
    <br>
    <table class='table table-bordered' >
      <tr class='bg-secondary' style='color: white; font-family:verdana; font-size: x-small;'>
        <td>No:</td>
        <td>Emp.Code</td>
        <td>Basic Salary</td>
        <td>Allowance</td>
        <td>Overtime</td>
        <td>Paid Leave</td>
        <td>Claim</td>
        <td>Deduction</td>
        <td>Advance</td>
        <td>EPF</td>
        <td>SOCSO</td>
        <td>EIS</td>
        <td>Zakat</td>
        <td>CP38</td>
        <td>Unpaid Leave</td>
        <td>Total Deduction</td>
      </tr>
      <tr class='bg-secondary' style='color: white; font-family:verdana; font-size: x-small;'>
        <td></td>
        <td>Emp Name</td>
        <td>Director Fee</td>
        <td>Bonus</td>
        <td>Commission</td>
        <td>Pay Of Arrears</td>
        <td>Total Earning</td>
        <td>Loan</td>
        <td>ASN</td>
        <td>EPF ('yer)</td>
        <td>SOCSO ('yer)</td>
        <td>EIS ('yer)</td>
        <td>Levy</td>
        <td>PCB</td>
        <td>Tabung Haji</td>
        <td>Net Pay</td>
      </tr>
      <tr style=' font-family:verdana; font-size: x-small;'>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr style=' font-family:verdana; font-size: x-small;'>
        <td></td>
        <td>".$useresult->firstname."  ".$useresult->lastname."</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </table>

      </div>
      <p style='page-break-before:always'>&nbsp;</p>
      ";
    }
    
  }
  elseif ($selectReport==="payrollallowance"){
    for ($i=0; $i < count($payrolllist) ; $i++) { 
      $userobject = new User();
      $useresult = $userobject->searchOnly($payrolllist[$i]);
      echo "
      <div class='container' style=' border-style: solid; border-width: 1px; border-color: black;' >
    <br>
    <h6 class='font-weight-bold' align='center' style='font-family:verdana; font-size: small; '>Payroll Allowance</h6>
    <br>
    <table class='table table-bordered' >
      <tr class='bg-secondary' style='color: white; font-family:verdana; font-size: x-small;'>
        <td>No:</td>
        <td>Name</td>
        <td>Allowance Type</td>
        <td>Amount</td>
      </tr>
      
      <tr style=' font-family:verdana; font-size: x-small;'>
        <td></td>
        <td>".$useresult->firstname."  ".$useresult->lastname."</td>
        <td></td>
        <td></td>
      </tr>
      
    </table>

      </div>
      <p style='page-break-before:always'>&nbsp;</p>
      ";
    }
  }
  else{
    for ($i=0; $i < count($payrolllist) ; $i++) { 
      $userobject = new User();
      $useresult = $userobject->searchOnly($payrolllist[$i]);
      echo "
      <div class='container'  >
    <br>
    <h6 class='font-weight-bold' align='center' style='font-family:verdana; font-size: small; '>PAYROLL DEDUCTION</h6>
    <br>
    <table class='table table-bordered' >
      <tr class='bg-secondary' style='color: white; font-family:verdana; font-size: x-small;'>
        <td>No:</td>
        <td>Name</td>
        <td>Deduction Type</td>
        <td>Amount</td>
      </tr>
      
      <tr style=' font-family:verdana; font-size: x-small;'>
        <td></td>
        <td>".$useresult->firstname."  ".$useresult->lastname."</td>
        <td></td>
        <td></td>
      </tr>
      
    </table>

      </div>
      <p style='page-break-before:always'>&nbsp;</p>
      ";
    }
  }

      ?>

</div>
</div>
</div>
</body>
</html>
