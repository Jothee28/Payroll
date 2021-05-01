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
  

  div {
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

      <?php 
      if(Input::exists()){
        $epflist =array();
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
      if ($selectReport==='boranga') {
        if ($selectDepartment) {
          if ($selectemployee) {
            $userobject = new User();
            $useresult = $userobject->searchOnly($selectemployee);
            if($useresult){
              array_push($epflist, $useresult->userID);
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
                 array_push($epflist, $useresult->userID);
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
              array_push($epflist, $useresult->userID);
            }
          }
          else{//checkbalik condition all user
            if ($resultresult->role === "Chief") {
              $userobject = new User();
              $useresult = $userobject->searchWithCorporate($resultresult->corporateID);
              if ($useresult) {
                foreach ($useresult as $row) {
                  array_push($epflist, $row->userID);
                }
              }
            }
            elseif ($companyresult && $resultresult->role === "Superior") {
              foreach ($variable as $key => $value) {
                $userobject = new User();
                $useresult = $userobject->searchWithCompany($row->companyID);
                if ($useresult) {
                  foreach ($useresult as $row) {
                    array_push($epflist, $row->userID);
                  }
                }
              }
            }
          }
        }
      }
      //second report condition
      elseif($selectReport==='borang17a'){ // summary
          if($selectDepartment){
            if($selectemployee){
              $userobject = new User();
              $useresult = $userobject->searchOnly($selectemployee);
              if($useresult){
                array_push($epflist, $useresult->userID);
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
                  array_push($epflist, $useresult->userID);
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
                    array_push($epflist, $row->userID);
                  }
                }
              }elseif($companyresult && $resultresult->role === "Superior"){
                foreach ($companyresult as $row) {
                  $userobject = new User();
                  $useresult = $userobject->searchWithCompany($row->companyID);
                  if($useresult){
                    foreach ($useresult as $row) {
                      array_push($epflist, $row->userID);
                    }
                  }
                }
              }
            }
          }
        }
        //third report condition
        else{ // summary
          if($selectDepartment){
            if($selectemployee){
              $userobject = new User();
              $useresult = $userobject->searchOnly($selectemployee);
              if($useresult){
                array_push($epflist, $useresult->userID);
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
                  array_push($epflist, $useresult->userID);
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
                    array_push($epflist, $row->userID);
                  }
                }
              }elseif($companyresult && $resultresult->role === "Superior"){
                foreach ($companyresult as $row) {
                  $userobject = new User();
                  $useresult = $userobject->searchWithCompany($row->companyID);
                  if($useresult){
                    foreach ($useresult as $row) {
                      array_push($epflist, $row->userID);
                    }
                  }
                }
              }
            }
          }
        }

        $epflist = array_unique($epflist);
        $epflist = array_values($epflist);
        print_r($epflist);
        if ($selectReport==='boranga') {
          for ($i=0; $i < count($epflist) ; $i++) { 
            $userobject = new User();
            $useresult = $userobject->searchOnly($epflist[$i]);
            echo "
            <div class='container'>
            <img src='img/kwsp.png' width='100' height='100' align='left'>
            <h3 align='center'>KUMPULAN WANG SIMPANAN PEKERJA</h3>
            <h6 align='center' style='font-family:verdana;'>PERATURAN-PERATURAN DAN KAEDAH KAEDAH KWSP 1991 KAEDAH 11(1)</h6><br>
            <h2 align='right'>Borang A</h2> <br>

            
            <table style='font-family:verdana;  font-size: small; width:70%;'  align='center' class='table table-bordered'>
              
              <tr>
                <td>No Rujukan Majikan</td>
                <td> Caruman</td>
                <td>Amaun Caruman</td>
                <td>No Rujukan Borang A</td>
              </tr>
              
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
        
              <tr>
                 <td colspan='4'>
                 <h6 style='font-family:verdana; font-size: small;'>Jumlah Caruman untuk bulan di atas hendaklah dibayar kepada KWSP/Agen Kutipan KWSP sebelum/Pada 15hb setiap bulan</h6>
                 <h6 style='font-family:verdana; font-size: small;'>
                 <p >Wang Tunai</p>
                 <p>Cek/Kiriman Wang/Wang Pos/Draf Bank*No/EFT/TT:</p>
                 </h6>
                 </td>
              </tr>
        
              <tr>
                 <td colspan='4'>
                 <h6 style='font-family:verdana; font-size: small;'>Demo-642 Tarikh DiCetak: </h6> &nbsp 
                 <h6 style='font-family:verdana; font-size: small;' align='right'>Tarikh DiCetak: </h6>
                 <h6 style='font-family:verdana; font-size: small;'>
                 Alamat
                 </h6>
                 </td>
              </tr>
              
              </table>
              </div>
              <br>

              <div class='container'>
              <table style='font-family:verdana; font-size: small; color:black;' align='center' class='table table-bordered'>
              
              <tr>
                <td>Bil</td>
                <td>NO.AHLI</td>
                <td>NK</td>
                <td>NO. KAD PENGENALAN</td>
                <td>NAMA PEKERJA/AHLI</td>
                <td>UPAH(RM)</td>
                <td>
                  CARUMAN(RM)
                </td>
              </tr>  
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>".$useresult->firstname."  ".$useresult->lastname."</td>
                <td></td>
                <td></td>
              </tr>
              <tr>
              <td class='font-weight-bold text-align='right' colspan='6'>JUMLAH (RM)</td>
              <td></td>
              </tr>
              </table>
              </div>

              <br>

              <table class='container' style=' width:45%;'>
              <tr style='font-family:verdana; font-size: small; '>
                <td> Tandatangan Wakil Majikan</td>
                <td><u></u></td>
              </tr>
    
              <tr style='font-family:verdana; font-size: small; '>
                <td> Nama</td>
                <td><u>JOYCELIN</u></td>
              </tr>
    
              <tr style='font-family:verdana; font-size: small; '>
                <td> No. Pengenalan Diri</td>
                <td><u>831032105837</u></td>
              </tr>
    
              <tr style='font-family:verdana; font-size: small; '>
                <td> Jawatan</td>
                <td><u>HR MANAGER</u></td>
              </tr>

              <tr style='font-family:verdana; font-size: small; '>
                <td> No.Telefon/ Bimbit</td>
                <td><u>03-32144878</u></td>
              </tr>
    
              <tr style='font-family:verdana; font-size: small; '>
                <td> E-Mel</td>
                <td><u>joycelin@doerhm.com</u></td>
              </tr>
    
              <tr style='font-family:verdana; font-size: small; '>
                <td> Tarikh</td>
                <td><u>24/02/2021</u></td>
              </tr>
              </table>
              <p style='page-break-before:always'>&nbsp;</p>
            ";
          }
        }
        elseif ($selectReport==='borang17a') {
          for ($i=0; $i < count($epflist) ; $i++) { 
            $userobject = new User();
            $useresult = $userobject->searchOnly($epflist[$i]);
            echo "
              <div class='container'>
              <img src='img/kwsp.png' width='100' height='100' align='left'> 
              <br>
              <h6 align='left'>KUMPULAN WANG SIMPANAN PEKERJA</h6>
              <h6 class='font-weight-bold' align='left' style='font-family:verdana;'>NOTIS PILIHAN MENCARUM MELEBIHI KADAR BERKANUN (SYER PEKERJA)</h6><br>
              
              <p style='background-color: #0f1059; color: white'>A) MAKLUMAT MAJIKAN </p>
              <p style='font-family:verdana; font-size: small;'>Nombor Majikan: </p>
              <p style='font-family:verdana; font-size: small;'>Nama Majikan:</p>

              <p style='background-color: #0f1059; color: white'>B) MAKLUMAT AHLI/PEKERJA</p>
              <p class='font-weight-bold' style='font-family:verdana; font-size: small; '>Bagi Ahli/ Pekerja yang berumur tidak melebihi 60 tahun:</p>
              <p style='font-family:verdana; font-size: small; '>Saya/ Kami dengan ini membuat PILIHAN untuk mencarum sebanyak 2% melebihi kadar berkanun (9%) bagi syer pekerja yang keseluruhannya berjumlah 11%.</p>
              <p style='font-family:verdana; font-size: small; '>Pilihan ini adalah berkuat kuasa mulai upah Januari 2021 atau mulai upah bulan berikutnya notis ini diterima oleh KWSP sehingga upah bagi bulan Dsember 2021 tertakluk kepada Perintah Jadual Ketiga yang diwartakan.</p>
              <p style='font-family:verdana; font-size: small; '>Pilihan untuk mencarum melebihi kadar berkanun caruman syer pekerja yang dibuat tidak boleh dibatalkan.</p>

              <table style='font-family:verdana; font-size: small; width:99.5%;' align='center' class='table table-bordered'>
              
              <tr>
                <td>Bil</td>
                <td>NO.AHLI</td>
                <td>NO. KAD PENGENALAN</td>
                <td>NAMA AHLI</td>
                <td>Tandatangan Ahli</td>
                </tr> 
              
              <tr>
                <td></td>
                <td>".$useresult->firstname."  ".$useresult->lastname."</td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              </table>
              </div>
              <br>
              
              <div class='container'>

              <p style='background-color: #0f1059; color: white'>C) PENGESAHAN MAKLUMAT MAJIKAN</p>
              <p style='font-family:verdana; font-size: small; '>Kami dengan ini mengesahkan dan mengambil maklum bahawa pekerja dia atas telah memilih untuk mencarum kepada KWSP melebihi kadar berkanun seperti yang dinyatakan dalam notis ini.</p>

              <table>
              <tr style='font-family:verdana; font-size: small; '>
                <td> Tandatangan Majikan/Wakil Majikan</td>
                <td></td>
              </tr>
    
              <tr style='font-family:verdana; font-size: small; '>
                <td> Nama</td>
                <td></td>
              </tr>
    
              <tr style='font-family:verdana; font-size: small; '>
                <td> No. Pengenalan Diri</td>
                <td></td>
              </tr>
    
              <tr style='font-family:verdana; font-size: small; '>
                <td> Jawatan</td>
                <td></td>
              </tr>
    
              <tr style='font-family:verdana; font-size: small; '>
                <td> E-Mel</td>
                <td></td>
              </tr>
    
              <tr style='font-family:verdana; font-size: small; '>
                <td> No.Telefon/ Bimbit</td>
                <td></td>
              </tr>
    
              <tr style='font-family:verdana; font-size: small; '>
                <td> Tarikh</td>
                <td></td>
              </tr>
              </table>
              <br>


              <p class='font-weight-bold' style='font-family:verdana; font-size: x-small; '>SILA PASTIKAN:</p>
              <p style='font-family:verdana; font-size: x-small; '> Butiran ahli ahli yang disenaraikan di atas hendaklah dikunci masuk di dalam i-Akaun (Majikan) mulai 14 Disember 2020.</p>
              <p style='font-family:verdana; font-size: x-small; '> Sila hubungi Pusat Pengurusan KWSP 03-8922-6000 untuk sebarang pertanyaan berkaitan permohonan ini.</p>
              <div align='right'><p class='font-weight-bold' style='font-family:verdana; font-size: x-small; '>CAP RASMI MAJIKAN</p></div>
              </div>
              <p style='page-break-before:always'>&nbsp;</p>
              
              ";
          }
        }
        else{
          for ($i=0; $i < count($epflist) ; $i++) { 
            $userobject = new User();
            $useresult = $userobject->searchOnly($epflist[$i]);
            echo "
            <h6 class='font-weight-bold' align='center'>EPF CONTRIBUTION SCHEDULE</h6>
              <table class='table table-bordered'>

              <tr class='bg-secondary'>
                <td class='text-white'>Code</td>
                <td class='text-white'>EPF No.</td>
                <td class='text-white'>Name</td>
                <td class='text-white'>Employee EPF</td>
                <td class='text-white'>Employer EPF</td>
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


</body>
</html>
