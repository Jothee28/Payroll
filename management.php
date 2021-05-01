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
  <title>Payroll - DoerHRM</title> 
  <?php
  include 'includes/header.php';
  ?>


 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">



  <!--Bootstrap 4-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>

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
          <h4 class="m-0"><i class=""></i> Management Report</h4>
        </div>
      </div>
      
     

      <ul class="nav nav-tabs row px-2">
        <li class="nav-item col-12 col-xl-2 p-0">
          <a class="nav-link rounded-0 text-center active" data-toggle="tab" href="#epf"><span class="font-weight-bold">PAYSLIP</span></a>
        </li>
        
        <li class="nav-item col-12 col-xl-2 p-0">
          <a class="nav-link rounded-0 text-center" data-toggle="tab" href="#socso"><span class="font-weight-bold">PAYROLL</span></a>  
        </li>

        <li class="nav-item col-12 col-xl-2 p-0">
          <a class="nav-link rounded-0 text-center" data-toggle="tab" href="#eis"><span class="font-weight-bold">LEAVE</span></a>  
        </li>

        <li class="nav-item col-12 col-xl-2 p-0">
          <a class="nav-link rounded-0 text-center" data-toggle="tab" href="#calendarshow"><span class="font-weight-bold">CLAIM</span></a>  
        </li>
        
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div class="tab-pane active" id="epf">
          <div class="row mt-3">
            <div class="col-xl-12 col-12">
              <div class="row mb-3">
                <div class="col-12 col-xl-5 px-2">
                   <select class="form-control  rounded-0 border">
                      <option value="">Report Type</option>
                    </select>
                </div>
                <div class="col-12 col-xl-5 px-2">
                   <select class="form-control  rounded-0 border">
                      <option value="">Employee Name</option>
                    </select>
                </div>
              </div>
            </div>
          </div>

          
              <div class="row mb-3">
                <div class="col-12 col-xl-5 px-2">
                   <select class="form-control  rounded-0 border">
                      <option value="">From Month</option>
                    </select>
                </div>
                <div class="col-12 col-xl-5 px-2">
                   <select class="form-control  rounded-0 border">
                      <option value="">To Month</option>
                    </select>
                </div>
              </div>
            
              <div class="row mb-3">
                <div class="col-12 col-xl-5 px-2">
                   <select class="form-control  rounded-0 border">
                      <option value="">Department</option>
                    </select>
                </div>
              </div>

            
              

              <div class="mb-5" id='epf'></div>
            </div>
          </div>
        </div>
            
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 px-2">
              <button type="button" name="generate_pdf"  id="btnGenerateReport" onclick="myFunction()" class="btn btn-primary btn-block rounded-0">Generate Report</button>
                <script>
                  function myFunction() {
                    window.print();
                  }
                </script>
            </div>
          </div>

          <div class="tab-pane" id="eis"> 
            
        </div>
      </div>

      
    </div>
  </div>
</div>
  
  
</body>
</html>


