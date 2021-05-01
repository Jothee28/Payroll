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
        $eislist =array();
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
      if ($selectReport==='borangsip2') {
        if ($selectDepartment) {
          if ($selectemployee) {
            $userobject = new User();
            $useresult = $userobject->searchOnly($selectemployee);
            if($useresult){
              array_push($eislist, $useresult->userID);
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
                 array_push($eislist, $useresult->userID);
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
              array_push($eislist, $useresult->userID);
            }
          }
          else{//checkbalik condition all user
            if ($resultresult->role === "Chief") {
              $userobject = new User();
              $useresult = $userobject->searchWithCorporate($resultresult->corporateID);
              if ($useresult) {
                foreach ($useresult as $row) {
                  array_push($eislist, $row->userID);
                }
              }
            }
            elseif ($companyresult && $resultresult->role === "Superior") {
              foreach ($variable as $key => $value) {
                $userobject = new User();
                $useresult = $userobject->searchWithCompany($row->companyID);
                if ($useresult) {
                  foreach ($useresult as $row) {
                    array_push($eislist, $row->userID);
                  }
                }
              }
            }
          }
        }
      }
      //second report condition
        else{ // summary
          if($selectDepartment){
            if($selectemployee){
              $userobject = new User();
              $useresult = $userobject->searchOnly($selectemployee);
              if($useresult){
                array_push($eislist, $useresult->userID);
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
                  array_push($eislist, $useresult->userID);
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
                    array_push($eislist, $row->userID);
                  }
                }
              }elseif($companyresult && $resultresult->role === "Superior"){
                foreach ($companyresult as $row) {
                  $userobject = new User();
                  $useresult = $userobject->searchWithCompany($row->companyID);
                  if($useresult){
                    foreach ($useresult as $row) {
                      array_push($eislist, $row->userID);
                    }
                  }
                }
              }
            }
          }
        }

        $eislist = array_unique($eislist);
        $eislist = array_values($eislist);
        print_r($eislist);
        if ($selectReport==='borangsip2') {
          for ($i=0; $i < count($eislist) ; $i++) { 
            $userobject = new User();
            $useresult = $userobject->searchOnly($eislist[$i]);
            echo "
            <div class='container'>
            <h6 class='font-weight-bold' align='center' style='font-family:verdana; font-size: x-small;'>BORANG SIP 2  </h6>
            <h6 align='center' style='font-family:verdana; font-size: x-small;'>BORANG PENDAFTARAN PEKERJA  </h6>
            <h6 align='center' style='font-family:verdana; font-size: x-small;'>PERATURAN-PERATURAN (AM) KESELAMATAN SOSIAL PEKERJA 1971</h6>
            <h6 align='center' style='font-family:verdana; font-size: x-small;'>(Peraturan 4)</h6>

            <img src='img/perkeso.png' width='90' height='100' align='left' &nbsp;> 

            <table align='right' style='font-family:verdana; font-size: x-small; '>
            <tr>
              <td style='background-color: #0d40d9; color: white'> NO KOD MAJIKAN/ MyCoID</td>
              <td></td>
            </tr>
            </table>

          <br><br><br><br><br> 
          <h6 style='background-color: #0d40d9; color: white' >BORANG SIP 2- PENDAFTARAN PEKERJA</h6>
          <h6 style='background-color: #0d40d9; color: white' >A. BUTIRAN PEKERJA</h6>
          

        <table style='font-family:verdana; font-size: small; width:99.5%;' align='center' class='table table-bordered'>
        <tr>
          <td>Jenis Kad Pengenalan</td>
          <td>No Kad Pengenalan</td>
          <td>Nama Pekerja</td>
          <td>Jantina (L/P)</td>
          <td>Bangsa</td>
          <td>Tarikh Mula Kerja</td>
          <td>Pekerjaan</td>
          <td>Sila tandakan (/) pekerja yang bergaji melebihi RM4000.00 sebulan</td>
        </tr> 
        <tr>
          <td></td>
          <td></td>
          <td>".$useresult->firstname."  ".$useresult->lastname."</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        </table>
        <br><br><br><br><br><br><br><br>

          <h6 style='background-color: #0d40d9; color: white' >B. PENGESAHAN MAJIKAN/ WAKIL MAJIKAN</h6>
          <p style='font-family:verdana; font-size: x-small;'>Saya mengesahkan bahwa tiada seorang pun pekerja perusahaan ini sebagaimana yang ditakrifkan dalam seksyen2(5) Akta telah tertinggal daripada senarai di atas.</p>
            <table>
              <tr style='font-family:verdana; font-size: small; '>
                <td> Tandatangan</td>
                <td></td>
                <td></td>
              </tr>
    
              <tr style='font-family:verdana; font-size: small; '>
                <td> Nama Majikan/ Nama Wakil Majikan</td>
                <td></td>
                <td></td>
              </tr>
    
              <tr style='font-family:verdana; font-size: small; '>
                <td> Nama Perusahaan</td>
                <td></td>
                <td></td>
              </tr>
    
              <tr style='font-family:verdana; font-size: small; '>
                <td> No. KPPN</td>
                <td></td>
                <td>&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;
                Jawatan:</td>
              </tr>
    
              <tr style='font-family:verdana; font-size: small; '>
                <td> No.Telefon Pejabat/No. telefon Bimbit</td>
                <td></td>
                <td> &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;
                &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;
              &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;No.Faks</td>
              </tr>
    
              <tr style='font-family:verdana; font-size: small; '>
                <td> Tarikh</td>
                <td></td>
              </tr>
              </table>
              <p style='font-family:verdana; font-size: x-small; '>Tandatangan tidak diperlukan sekiranya borang ini dihantar melalui medium elektronik tertakluk kepada pengesahan oleh PERKESO</p>
              </div>
              <p style='page-break-before:always'>&nbsp;</p>
            ";
          }
        }
        else{
          for ($i=0; $i < count($eislist) ; $i++) { 
            $userobject = new User();
            $useresult = $userobject->searchOnly($eislist[$i]);
            echo "
            <h6 class='font-weight-bold' align='center'>EIS CONTRIBUTION SCHEDULE</h6>
              <table class='table table-bordered'>

              <tr class='bg-secondary'>
                <td class='text-white'>Code</td>
                <td class='text-white'>EIS No.</td>
                <td class='text-white'>Name</td>
                <td class='text-white'>Employee EIS</td>
                <td class='text-white'>Employer EIS</td>
                <td class='text-white'>Total</td>
              </tr>
              <tr>
                <td>".$useresult->firstname."  ".$useresult->lastname."</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              <tr>
                <td class='font-weight-bold' align='right' colspan='3'  colspan='3'> Grand Total(RM):</td>
                <td ></td>
                <td></td>
                <td></td>
              </tr>
              
              </table>
              <p style='page-break-before:always'>&nbsp;</p>
            ";
          }
        }
      ?>

</div>
</div>
</body>
</html>
