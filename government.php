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
        <h3 class="my-5 font-weight-light">Government Report</h3>
        
        <ul class="nav nav-tabs row px-2" id="governmentalltab">
          <li class='nav-item col-12 col-xl-2 p-0'>
            <a class='nav-link active rounded-0 text-center' data-toggle='tab' href='#epf'><span class="font-weight-bold">EPF</span></a>
          </li>
          <li class='nav-item col-12 col-xl-2 p-0'>
            <a class='nav-link active rounded-0 text-center' data-toggle='tab' href='#socso'><span class="font-weight-bold">SOCSO</span></a>
          </li>
          <li class='nav-item col-12 col-xl-2 p-0'>
            <a class='nav-link active rounded-0 text-center' data-toggle='tab' href='#eis'><span class="font-weight-bold">EIS</span></a>
          </li>
          <li class='nav-item col-12 col-xl-2 p-0'>
            <a class='nav-link active rounded-0 text-center' data-toggle='tab' href='#incometax'><span class="font-weight-bold">INCOME-TAX </span></a>
          </li>
        </ul>

   <!-- Tab panes -->
  <div class="tab-content">
    <div id="epf" class="container tab-pane active"><br>
      <h3>HOME</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>

    <div id="socso" class="container tab-pane fade"><br>
      <h3>Menu 1</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>

    <div id="eis" class="container tab-pane fade"><br>
      <h3>Menu  </h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>

    <div id="incometax" class="container tab-pane fade"><br>
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>

  </div>
</div>
</div>
</div>
</div>
</body>
</html>