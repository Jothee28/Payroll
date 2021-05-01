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
      <div class="row my-4">
        <div class="col">
          <h4 class="m-0"><i class=""></i> EMPLOYEE REPORT DETAIL</h4>
        </div>
      </div>
      <?php 
      if(Input::exists()){
        $employee = new Employee();
        $employeelist =array();
        $selectReport = escape(Input::get('selectReport'));
        $selectemployee = escape(Input::get('selectemployee'));
        $selectDepartment = escape(Input::get('selectDepartment'));
        $fromjoinDate = escape(Input::get('fromjoinDate'));
        $tojoinDate = escape(Input::get('tojoinDate'));
        $fromresignDate = escape(Input::get('fromresignDate'));
        $toresignDate = escape(Input::get('toresignDate'));
        $employeelist = array();
      }   
      echo $selectReport;
      echo $selectemployee;
      echo $selectDepartment;
      echo $fromjoinDate;
      echo $tojoinDate;
      echo $fromresignDate;
      echo $toresignDate;
      ?>
      <?php
      if($selectReport==="detailreport"){
        if($selectDepartment){
          if($selectemployee){
            $userobject = new User();
            $useresult = $userobject->searchOnly($selectemployee);
            if($useresult){
              array_push($employeelist, $useresult->userID);
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
                  array_push($employeelist, $useresult->userID);
                }
              }
            }
          }
        }else{
          if($selectemployee){
            $userobject = new User();
            $useresult = $userobject->searchOnly($selectemployee);
            if($useresult){
              array_push($employeelist, $useresult->userID);
            }
          }
          else{//checkbalik condition all user
            if($resultresult->role === "Chief"){
                $userobject = new User();
                $useresult = $userobject->searchWithCorporate($resultresult->corporateID);
                if($useresult){
                  foreach ($useresult as $row) {
                    array_push($employeelist, $row->userID);
                  }
                }
              }elseif($companyresult && $resultresult->role === "Superior"){
                foreach ($companyresult as $row) {
                  $userobject = new User();
                  $useresult = $userobject->searchWithCompany($row->companyID);
                  if($useresult){
                    foreach ($useresult as $row) {
                      array_push($employeelist, $row->userID);
                    }
                  }
                }
              }
           }
         }
        }else{ // summary
          if($selectDepartment){
            if($selectemployee){
              $userobject = new User();
              $useresult = $userobject->searchOnly($selectemployee);
              if($useresult){
                array_push($employeelist, $useresult->userID);
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
                  array_push($employeelist, $useresult->userID);
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
                    array_push($employeelist, $row->userID);
                  }
                }
              }elseif($companyresult && $resultresult->role === "Superior"){
                foreach ($companyresult as $row) {
                  $userobject = new User();
                  $useresult = $userobject->searchWithCompany($row->companyID);
                  if($useresult){
                    foreach ($useresult as $row) {
                      array_push($employeelist, $row->userID);
                    }
                  }
                }
              }
            }
          }
        }

  $employeelist = array_unique($employeelist);
  $employeelist = array_values($employeelist);
  

  print_r($employeelist);
  if ($selectReport==="detailreport") {
    for ($i=0; $i < count($employeelist) ; $i++) { 
      $employee = new Employee();
      $userobject = new User();

      $employeeresult = $employee->searchOnlyEmployeePersonalInformation($row->emp_id);
      $useresult = $userobject->searchOnlyEmploymentDetails($employeelist[$i]);
      $useresult = $userobject->searchOnly($employeelist[$i]);
      echo"
      <div class='row' >
      <table class='table table-bordered'>
      <thead >
      <tr>
        <td class='font-weight-bold'>Name</td>
        <td>".$useresult->firstname."  ".$useresult->lastname."</td>
        <td class='font-weight-bold'>Code:</td>
        <td>".$useresult->userID."</td>
      </tr>

      <tr class='bg-dark'>
        <td class='text-white'>PERSONAL INFORMATION</td>
      </tr>

      <tr>
        <td class='font-weight-bold'>I/C No:</td>
        <td> ".$employeeresult->emp_ic_num."</td>
        <td class='font-weight-bold'>Email:</td>
        <td>".$useresult->email."</td>
      </tr>

      <tr>
        <td class='font-weight-bold'>Passport No:</td>
        <td></td>
        <td class='font-weight-bold'>Martial Status</td>
        <td></td>
      </tr>

      <tr>
        <td class='font-weight-bold'>Date Of Birth:</td>
        <td></td>
        <td class='font-weight-bold'>Gender:</td>
        <td></td>
      </tr>

      <tr>
        <td class='font-weight-bold'>Old I/C No:</td>
        <td></td>
        <td class='font-weight-bold'>Nationality:</td>
        <td></td>
      </tr>

      <tr>
        <td class='font-weight-bold'>Phone No:</td>
        <td></td>
        <td class='font-weight-bold'>Race:</td>
        <td></td>
      </tr>

      <tr>
        <td class='font-weight-bold'>Mobile No:</td>
        <td></td>
        <td class='font-weight-bold'>Country:</td>
        <td></td>
      </tr>

      <tr>
        <td class='font-weight-bold'>Address:</td>
        <td></td>
      </tr>

      <tr class='bg-secondary'>
        <td class='text-white'>Spouse Information</td>
        <td></td>
        <td class='text-white'>Emergency Contact Information</td>
        <td></td>
      </tr>

      <tr>
        <td class='font-weight-bold'>Name:</td>
        <td></td>
        <td class='font-weight-bold'>Name:</td>
        <td></td>
      </tr>
      <tr>
        <td class='font-weight-bold'>I/C No:</td>
        <td></td>
        <td class='font-weight-bold'>I/C No:</td>
        <td></td>
      </tr>

      <tr>
        <td class='font-weight-bold'>Phone No:</td>
        <td></td>
        <td class='font-weight-bold'>Phone No:</td>
        <td></td>
      </tr>

      <tr class='bg-dark'>
        <td class='text-white'>EMPLOYMENT DETAIL</td>
      </tr>

      <tr class='bg-secondary'>
        <td class='text-white'>Job</td>
        <td></td>
        <td class='text-white'>Wages</td>
        <td></td>
      </tr>

      <tr>
        <td class='font-weight-bold'>Job Title:</td>
        <td></td>
        <td class='font-weight-bold'>Basic Rate(RM):</td>
        <td></td>
      </tr>

      <tr>
        <td class='font-weight-bold'>Branch:</td>
        <td></td>
        <td class='font-weight-bold'>Pay Basis</td>
        <td></td>
      </tr>

      <tr>
        <td class='font-weight-bold'>Department:</td>
        <td></td>
        <td class='font-weight-bold'>Payment Mode:</td>
        <td></td>
      </tr>

      <tr>
        <td class='font-weight-bold'>Superior:</td>
        <td></td>
        <td class='font-weight-bold' class='bg-secondary'>Bank Information:</td>
        <td></td>
      </tr>

      <tr>
        <td class='font-weight-bold'>Date Joined:</td>
        <td></td>
        <td class='font-weight-bold'>Bank A/C No:</td>
        <td></td>
      </tr>

      <tr>
        <td class='font-weight-bold'>Date Resignantion:</td>
        <td></td>
        <td class='font-weight-bold'>Bank Name:</td>
        <td></td>
      </tr>

      <tr class='bg-dark'>
        <td class='text-white'>STATUTORY REQUIREMENT</td>
      </tr>

      <tr class='bg-secondary'>
        <td class='text-white'>EPF</td>
        <td></td>
        <td class='text-white'>TAX</td>
        <td></td>
      </tr>

      <tr>
        <td class='font-weight-bold'>EPF No:</td>
        <td></td>
        <td class='font-weight-bold'>Tax No:</td>
        <td></td>
      </tr>

      <tr>
        <td class='font-weight-bold'>EPF Initial</td>
        <td></td>
        <td class='font-weight-bold'>Spouse Tax No:</td>
        <td></td>
      </tr>

      <tr class='bg-secondary'>
        <td class='text-white'>SOCSO</td>
        <td></td>
        <td class='text-white'>EIS/SIP</td>
      </tr>

      <tr>
        <td class='font-weight-bold'>SOCSO No</td>
        <td></td>
        <td class='font-weight-bold'>EIS/SIP No:</td>
        <td></td>
      </tr>
    </thead>
  </table>
</div>
<div style='page-break-before:always'>&nbsp;</div> 
      ";
    }
    
  }
  else{
    for ($i=0; $i < count($employeelist) ; $i++) { 
      $userobject = new User();
      $useresult = $userobject->searchOnly($employeelist[$i]);
      echo "
      <div class='row' >
      <table class='table table-bordered'>
      <thead>

      <tr class='table-secondary'>
      <th scope='col-2'>
      <h6>Name <br> Job Title <br> IC No</h6>
      </th>

      <th scope='col-2'>
      <h6>Gender <br> Race <br> Martial</h6>
      </th>
      
      <th scope='col-2'>
      <h6>Branch <br> Department <br>Project</h6>
      </th>
      
      <th scope='col-2'>
      <h6>Date of Birth <br> Date Joined <br> Date Confirmed</h6>
      </th>
      
      <th scope='col-2'>
      <h6>Age <br> Service Period <br> Is Active</h6>
      </th>
      
      <th scope='col-2'>
      <h6>Superior <br> BankA/C No <br> Bank Name</h6>
      </th>

      <th scope='col-2'>
      <h6>Emp Group <br> Emo Type <br> OT Code</h6>
      </th>
      
      <th scope='col-2'>
      <h6>EPF No <br> SOCSO No <br> Tax No</h6>
      </th>
      
      <th scope='col-2'>
      <h6>Pay Basis <br> Pay Mode <br> Basic(RM)</h6></th>
      </tr>
      
      <tr>
      <th scope='col-2'>
      <h6>".$useresult->firstname."  ".$useresult->lastname."<br> <br> </h6>
      </th>
      
      <th scope='col-2' class='table-secondary'>
      <h6> <br> <br> </h6>
      </th>
      
      <th scope='col-2'>
      <h6> <br> <br> </h6>
      </th>
      
      <th scope='col-2' class='table-secondary'>
      <h6> <br> <br> </h6>
      </th>
      
      <th scope='col-2'>
      <h6> <br> <br> </h6>
      </th>
      
      <th scope='col-2' class='table-secondary'>
      <h6> <br> <br> </h6>
      </th>
      
      <th scope='col-2'>
      <h6>  <br> <br> </h6>
      </th>
      
      <th scope='col-2' class='table-secondary'>
      <h6> <br> <br> </h6>
      </th>
      
      <th scope='col-2'>
      <h6> <br> <br> </h6></th>
      </tr>

      </thead>
      </table>
      </div>
      <div style='page-break-before:always'>&nbsp;</div> 
      ";
    }
  }

      ?>

</div>
</div>
</div>
</body>
</html>
