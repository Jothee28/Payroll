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
        $selectReport = escape(Input::get('selectReport'));
        $selectemployee = escape(Input::get('selectemployee'));
        $selectDepartment = escape(Input::get('selectDepartment'));
        $fromJoinDate =escape(Input::get('fromJoinDate'));
        $toJoinDate = escape(Input::get('fromJoinDate'));
        $fromResignDate = escape(Input::get('fromResignDate'));
        $toResignDate = escape(Input::get('toResignDate'));
      }   
      echo $selectReport;
      echo $selectemployee;
      echo $selectDepartment;
      echo $fromJoinDate;
      echo $toJoinDate;
      echo $fromResignDate;
      echo $toResignDate;
      ?>   
<form class="mt-5" id="employeesummarydetail">
  <div class='row' >
    <table class='table'>
      <thead id='employeereportlist'>
        <?php   

        $userobject = new User();
        $useresult = $userobject->searchOnly($resultresult->userID);
        $view = "";
        if($useresult){
          $view .= 
          "
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
    ";
    foreach ($useresult as $row) {
      $view .= 
      "
      <tr>
      <th scope='col-2'>
      <h6>".$resultresult->firstname."  ".$resultresult->lastname."<br> <br> </h6>
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
    ";
  }
}
  else{
    $view .= 
    "
    <li class='list-group-item'>
    No data
    </li>
    ";
  }
  $view .= 
  "
  </ul>
  ";
  echo $view;
  ?>
    
    </thead>
  </table>
</div>