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
<style>
  #border {
  border-style: solid;
  border-width: 1px;
  border-color: black;
  }
  
  
  </style>
</head>
<body>
  <script>
  $(document).ready(function () {
    window.print();
  });
  </script>

<form class='mt-5' id='epfreportdetail'>
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
        <td></td>
        <td></td>
        <td></td>
      </tr>
      
    </table>

      </div>
      <p style='page-break-before:always'>&nbsp;</p>
</form>
<body>
</html>
