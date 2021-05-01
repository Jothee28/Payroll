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
        
        </div>
      </div>
      <?php 
      if(Input::exists()){
        $hrlist =array();
        $selectReport = escape(Input::get('selectReport'));
        $selectemployee = escape(Input::get('selectemployee'));
        $selectDepartment = escape(Input::get('selectDepartment'));
        $fromjoinDate = escape(Input::get('fromjoinDate'));
        $tojoinDate = escape(Input::get('tojoinDate'));
        $fromresignDate = escape(Input::get('fromresignDate'));
        $toresignDate = escape(Input::get('toresignDate'));
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
      if ($selectReport==='promotion') {
        if ($selectDepartment) {
          if ($selectemployee) {
            $userobject = new User();
            $useresult = $userobject->searchOnly($selectemployee);
            if($useresult){
              array_push($hrlist, $useresult->userID);
            }
          }
          else{
            $groupobject = new Group();
            $groupresult = $groupobject->searchGroupMember($selectDepartment);
            if ($groupresult) {
              foreach ($groupresult as $row) {
                $userobject = new User();
                $useresult = $userobject->searchOnly($row->member_id);
                if ($useresult) {
                 array_push($hrlist, $useresult->userID);
               } 
              }
            }
          }
        }
        else{
          if($selectemployee){
            $userobject = new User();
            $useresult = $userobject->searchOnly($selectemployee);
            if($useresult){
              array_push($hrlist, $useresult->userID);
            }
          }
          else{//checkbalik condition all user
            if ($resultresult->role === "Chief") {
              $userobject = new User();
              $useresult = $userobject->searchWithCorporate($resultresult->corporateID);
              if ($useresult) {
                foreach ($useresult as $row) {
                  array_push($hrlist, $row->userID);
                }
              }
            }
            elseif ($companyresult && $resultresult->role === "Superior") {
              foreach ($variable as $key => $value) {
                $userobject = new User();
                $useresult = $userobject->searchWithCompany($row->companyID);
                if ($useresult) {
                  foreach ($useresult as $row) {
                    array_push($hrlist, $row->userID);
                  }
                }
              }
            }
          }
        }
      }
      //second report condition
      elseif($selectReport==='termination'){ // summary
          if($selectDepartment){
            if($selectemployee){
              $userobject = new User();
              $useresult = $userobject->searchOnly($selectemployee);
              if($useresult){
                array_push($hrlist, $useresult->userID);
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
                  array_push($hrlist, $useresult->userID);
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
                    array_push($hrlist, $row->userID);
                  }
                }
              }elseif($companyresult && $resultresult->role === "Superior"){
                foreach ($companyresult as $row) {
                  $userobject = new User();
                  $useresult = $userobject->searchWithCompany($row->companyID);
                  if($useresult){
                    foreach ($useresult as $row) {
                      array_push($hrlist, $row->userID);
                    }
                  }
                }
              }
            }
          }
        }
        //third report condition
        elseif($selectReport==='warning'){ // summary
          if($selectDepartment){
            if($selectemployee){
              $userobject = new User();
              $useresult = $userobject->searchOnly($selectemployee);
              if($useresult){
                array_push($hrlist, $useresult->userID);
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
                  array_push($hrlist, $useresult->userID);
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
                    array_push($hrlist, $row->userID);
                  }
                }
              }elseif($companyresult && $resultresult->role === "Superior"){
                foreach ($companyresult as $row) {
                  $userobject = new User();
                  $useresult = $userobject->searchWithCompany($row->companyID);
                  if($useresult){
                    foreach ($useresult as $row) {
                      array_push($hrlist, $row->userID);
                    }
                  }
                }
              }
            }
          }
        }
        //fourth report condition
        elseif($selectReport==='permit'){ // summary
          if($selectDepartment){
            if($selectemployee){
              $userobject = new User();
              $useresult = $userobject->searchOnly($selectemployee);
              if($useresult){
                array_push($hrlist, $useresult->userID);
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
                  array_push($hrlist, $useresult->userID);
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
                    array_push($hrlist, $row->userID);
                  }
                }
              }elseif($companyresult && $resultresult->role === "Superior"){
                foreach ($companyresult as $row) {
                  $userobject = new User();
                  $useresult = $userobject->searchWithCompany($row->companyID);
                  if($useresult){
                    foreach ($useresult as $row) {
                      array_push($hrlist, $row->userID);
                    }
                  }
                }
              }
            }
          }
        }
        //fifth report condition
        else{ // summary
          if($selectDepartment){
            if($selectemployee){
              $userobject = new User();
              $useresult = $userobject->searchOnly($selectemployee);
              if($useresult){
                array_push($hrlist, $useresult->userID);
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
                  array_push($hrlist, $useresult->userID);
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
                    array_push($hrlist, $row->userID);
                  }
                }
              }elseif($companyresult && $resultresult->role === "Superior"){
                foreach ($companyresult as $row) {
                  $userobject = new User();
                  $useresult = $userobject->searchWithCompany($row->companyID);
                  if($useresult){
                    foreach ($useresult as $row) {
                      array_push($hrlist, $row->userID);
                    }
                  }
                }
              }
            }
          }
        }

        $hrlist = array_unique($hrlist);
        $hrlist = array_values($hrlist);
        print_r($hrlist);
        if ($selectReport==='promotion') {
          for ($i=0; $i < count($hrlist) ; $i++) { 
            $userobject = new User();
            $useresult = $userobject->searchOnly($hrlist[$i]);
            echo "
            <p> 31 January 2021 </p><br>

              <p> ".$useresult->firstname."  ".$useresult->lastname." </p>
              <p> IC Num </p>
              <p> Address</p><br>

              <p> Dear ".$useresult->firstname."  ".$useresult->lastname."</p>
              <br>
              <p><b><u> Promotion Letter </u></b> </p>
              <br>

              <p> We are pleased to inform that you have been promoted as (job title) in the ( groupname ) department of the company. </p
              <br>

              <p> Your latest monthly salary will be increased to RM ( salary),  effective ( date ). Others term & condition will remain unchanged. </p> 
              <br>

              <p> We would like to take this opportunity to congratulate you on your promotion. We look forward to your continued good contribution to the company. </p
              <br>  

              <p> Thank You </p>  

              <br> <br>
              <p>Sincerely,</p>
              <br> <br>
              <p>_________</p>
              <p>(Admin Name)</p>
              <p>(Job Title)</p>
              <div style='page-break-before:always'>&nbsp;</div>
            ";
          }
        }
        elseif ($selectReport==='termination') {
          for ($i=0; $i < count($hrlist) ; $i++) { 
            $userobject = new User();
            $useresult = $userobject->searchOnly($hrlist[$i]);
            echo "
            <p> 31 January 2021 </p><br>

              <p> ".$useresult->firstname."  ".$useresult->lastname." </p>
              <p> IC Num </p>
              <p> Address</p><br>

              <p> Dear ".$useresult->firstname."  ".$useresult->lastname."</p>
              <br>
              <p><b><u> Termination of Employment </u></b> </p>
              <br>

              <p> Kindly informed that the Management decided to terminate your employment effective ( 28 February 2021 ). It is due to ( Termination Reason ). </p
              <br> 

              <p> Wish you all the best for your future. </p>  

              <br> <br>
              <p>Sincerely,</p>
              <br> <br>
              <p>_________</p>
              <p>(Admin Name)</p>
              <p>(Job Title)</p>
              <div style='page-break-before:always'>&nbsp;</div>
              ";
          }
        }
        elseif ($selectReport==='warning') {
          for ($i=0; $i < count($hrlist) ; $i++) { 
            $userobject = new User();
            $useresult = $userobject->searchOnly($hrlist[$i]);
            echo "
            <p> 31 January 2021 </p><br>

              <p> ".$useresult->firstname."  ".$useresult->lastname." </p>
              <p> IC Num </p>
              <p> Address</p><br>

              <p> Dear ".$useresult->firstname."  ".$useresult->lastname."</p>
              <br>
              <p><b><u>First / Second / Final Warning Letter</u></b> </p>
              <br>

              <p>Kindly informed that this letter serves as an official warning to you. It is due to (  ) example: you are frequently late come to work for the last 3 months.</p
              <br> 

              <p>We hope that you will improve your performance regarding the above matter. Otherwise, the company will serve the right to take further action on it.</p
              <br>

              <p>Thank you.</p>  

              <br> <br>
              <p>Sincerely,</p>
              <br> <br>
              <p>_________</p>
              <p>(Admin Name)</p>
              <p>(Job Title)</p>
              <div style='page-break-before:always'>&nbsp;</div>
              ";
          }
        }
        elseif ($selectReport==='permit') {
          for ($i=0; $i < count($hrlist) ; $i++) { 
            $userobject = new User();
            $useresult = $userobject->searchOnly($hrlist[$i]);
            echo "string";
          }
        }
        else{
          for ($i=0; $i < count($hrlist) ; $i++) { 
            $userobject = new User();
            $useresult = $userobject->searchOnly($hrlist[$i]);
            echo "4";
          }
        }
      ?>

</div>
</div>
</body>
</html>
