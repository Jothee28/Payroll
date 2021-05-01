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
        $socsolist =array();
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
      if ($selectReport==='borang2') {
        if ($selectDepartment) {
          if ($selectemployee) {
            $userobject = new User();
            $useresult = $userobject->searchOnly($selectemployee);
            if($useresult){
              array_push($socsolist, $useresult->userID);
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
                 array_push($socsolist, $useresult->userID);
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
              array_push($socsolist, $useresult->userID);
            }
          }
          else{//checkbalik condition all user
            if ($resultresult->role === "Chief") {
              $userobject = new User();
              $useresult = $userobject->searchWithCorporate($resultresult->corporateID);
              if ($useresult) {
                foreach ($useresult as $row) {
                  array_push($socsolist, $row->userID);
                }
              }
            }
            elseif ($companyresult && $resultresult->role === "Superior") {
              foreach ($variable as $key => $value) {
                $userobject = new User();
                $useresult = $userobject->searchWithCompany($row->companyID);
                if ($useresult) {
                  foreach ($useresult as $row) {
                    array_push($socsolist, $row->userID);
                  }
                }
              }
            }
          }
        }
      }
      //second report condition
      elseif($selectReport==='borang8a'){ // summary
          if($selectDepartment){
            if($selectemployee){
              $userobject = new User();
              $useresult = $userobject->searchOnly($selectemployee);
              if($useresult){
                array_push($socsolist, $useresult->userID);
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
                  array_push($socsolist, $useresult->userID);
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
                    array_push($socsolist, $row->userID);
                  }
                }
              }elseif($companyresult && $resultresult->role === "Superior"){
                foreach ($companyresult as $row) {
                  $userobject = new User();
                  $useresult = $userobject->searchWithCompany($row->companyID);
                  if($useresult){
                    foreach ($useresult as $row) {
                      array_push($socsolist, $row->userID);
                    }
                  }
                }
              }
            }
          }
        }
        //third report condition
      elseif($selectReport==='lampiranA'){ // summary
          if($selectDepartment){
            if($selectemployee){
              $userobject = new User();
              $useresult = $userobject->searchOnly($selectemployee);
              if($useresult){
                array_push($socsolist, $useresult->userID);
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
                  array_push($socsolist, $useresult->userID);
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
                    array_push($socsolist, $row->userID);
                  }
                }
              }elseif($companyresult && $resultresult->role === "Superior"){
                foreach ($companyresult as $row) {
                  $userobject = new User();
                  $useresult = $userobject->searchWithCompany($row->companyID);
                  if($useresult){
                    foreach ($useresult as $row) {
                      array_push($socsolist, $row->userID);
                    }
                  }
                }
              }
            }
          }
        }
        //fourth report condition
        else{ // summary
          if($selectDepartment){
            if($selectemployee){
              $userobject = new User();
              $useresult = $userobject->searchOnly($selectemployee);
              if($useresult){
                array_push($socsolist, $useresult->userID);
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
                  array_push($socsolist, $useresult->userID);
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
                    array_push($socsolist, $row->userID);
                  }
                }
              }elseif($companyresult && $resultresult->role === "Superior"){
                foreach ($companyresult as $row) {
                  $userobject = new User();
                  $useresult = $userobject->searchWithCompany($row->companyID);
                  if($useresult){
                    foreach ($useresult as $row) {
                      array_push($socsolist, $row->userID);
                    }
                  }
                }
              }
            }
          }
        }

        $socsolist = array_unique($socsolist);
        $socsolist = array_values($socsolist);
        print_r($socsolist);
        if ($selectReport==='borang2') {
          for ($i=0; $i < count($socsolist) ; $i++) { 
            $userobject = new User();
            $useresult = $userobject->searchOnly($socsolist[$i]);
            echo "
            <div class='container'>
            <h6 class='font-weight-bold' align='center' style='font-family:verdana; font-size: x-small;'>BORANG 2  </h6>
            <h6 align='center' style='font-family:verdana; font-size: x-small;'>BORANG PENDAFTARAN PEKERJA  </h6>
            <h6 align='center' style='font-family:verdana; font-size: x-small;'>PERATURAN-PERATURAN (AM) KESELAMATAN SOSIAL PEKERJA 1971</h6>
            <h6 align='center' style='font-family:verdana; font-size: x-small;'>Peraturan 10, 12 dan 12A)</h6>

            <img src='img/perkeso.png' width='90' height='100' align='left' &nbsp;> 

            <table align='right' style='font-family:verdana; font-size: x-small; '>
            <tr>
              <td style='background-color: #0d40d9; color: white'> NO KOD MAJIKAN/ MyCoID</td>
              <td></td>
            </tr>
            </table>

          <br><br><br><br><br> 
          <h6 style='background-color: #0d40d9; color: white' >BORANG 2- PENDAFTARAN PEKERJA</h6>
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
          <td>Sila tandakan (/) pekerja yang bergaji melebihi RM3000.00 sebulan</td>
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
        elseif ($selectReport==='borang8a') {
          for ($i=0; $i < count($socsolist) ; $i++) { 
            $userobject = new User();
            $useresult = $userobject->searchOnly($socsolist[$i]);
            echo "
              <div class='container' style='border-style: solid;border-width: 1px;border-color: black'>
              <h6 class='font-weight-bold' align='center' style='font-family:verdana; '>PERTUBUHAN KESELAMATAN SOSIAL</h6>
              <h6 align=;'center' style='font-family:verdana; font-size: small;'>PERATURAN-PERATURAN (AM) KESELAMATAN SOSIAL PEKERJA 1971 (PER.44A)</h6>
              <h6 align='center' style='font-family:verdana; '>CARUMAN GAJI BULAN</h6>
              <img src='img/perkeso.png' width='90' height='100' align='left' &nbsp; &nbsp;> 
              &nbsp;<br>
              
              <table style='font-family:verdana; font-size: small; width:99.5%;' align='center' class='table table-bordered'>
      <tr>
        <td>No. Kod Majikan</td>
        <td>No. MyCoID/ No. Pendaftaran Perniagaan</td>
        <td>Amaun Caruman (RM)</td>
      </tr>
      <tr>
        <td>124811885454</td>
        <td>77C9D36E</td>
        <td>477.10</td>
      </tr>
      <tr>
        <td colspan='2'>Amaun caruman di atas hendaklah dibayar kepada PERKESO/EJEN PEMUNGUT tidak lewat daripada</td>
        <td>15/03/2021</td>
      </tr>
      <tr>
        <td>Nama dan Alamat Majikan</td>
        <td>Lembaran</td>
        <td>Bil. Pekerja</td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </table>

    <table style='font-family:verdana; font-size: small; width:99.5%;' align='center' class='table table-bordered'>
        <tr>
          <td>TARIKH MULA/BERHENTI KERJA</td>
          <td>STATUS</td>
          <td>NO. KAD PENGENALAN</td>
          <td>NAMA PEKERJA (MENGIKUT KAD PENGENALAN)</td>
          <td>CARUMAN</td>
        </tr> 
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td>".$useresult->firstname."  ".$useresult->lastname." </td>
          <td></td>
        </tr>
      </table>

      <table>
        <tr style='font-family:verdana; font-size: small; '>
          <td> Tandatangan</td>
          <td></td>
          <td></td>
        </tr>

        <tr style='font-family:verdana; font-size: small; '>
          <td> Nama</td>
          <td></td>
          <td></td>
        </tr>
        <tr style='font-family:verdana; font-size: small; '>
          <td> No Tel &</td>
          <td></td><td></td>
        </tr>

        <tr style='font-family:verdana; font-size: small; '>
          <td> Cop Majikan</td>
          <td></td><td></td>
        </tr>
      </table>
      </div>
      <p style='page-break-before:always'>&nbsp;</p>
              
              ";
          }
        }
        elseif ($selectReport==='lampiranA') {
          for ($i=0; $i < count($socsolist) ; $i++) { 
            $userobject = new User();
            $useresult = $userobject->searchOnly($socsolist[$i]);
            echo "
              <div class='container' style='border-style: solid; border-width: 1px; border-color: black;'>
                <br>
                
                <h6 class='font-weight-bold' align='right' style='font-family:verdana; font-size: small; '>LAMPIRAN A</h6>
                <h6 class='font-weight-bold' align='center' style='font-family:verdana; font-size: small; '>PERTUBUHAN KESELAMATAN SOSIAL</h6><br>
                
                <img src='img/perkeso.png' width='85' height='110' align='left'>
                
                <h6 class='font-weight-bold' align='center' style='font-family:verdana; font-size: small; '>BORANG BAYARAN CARUMAN BULANAN/ TUNGGAKAN CARUMAN /</h6>

                <h6 class='font-weight-bold' align='center' style='font-family:verdana; font-size: small; '>KEKURANGAN CARUMAN MENGGUNAKAN CD/DISKET UNTUK </h6>

                <h6 class='font-weight-bold' align='center' style='font-family:verdana; font-size: small; '>BULAN ..... HINGGA .....</h6>

    
                <br>
                <h6 align='center' style='font-family:verdana; font-size: small; '>Tarikh Butiran Caruman Dihantar: ........../..../.........</h6> 
                <h6 align='center' style='font-family:verdana; font-size: small; '>(Melalui Sistem Penghantaran menggunakan CD/Disket) </h6>

                <br>

                <h6 align='center' style='font-family:verdana; font-size: small; '>Bilangan Pekerja: </h6>


                <table style='font-family:verdana; font-size: small; width:99.5%;' align='center' >

                  <tr style='border-style: solid;border-width: 1px;border-color: black'>
                    <td style='border-style: solid;border-width: 1px;border-color: black'><br>
                      <p>&nbsp;&nbsp;Cek/ Kiriman Wang/ Wang Pos/ Draf Bank</p>
                      <p>&nbsp;&nbsp;No: ....................... disertakan</p>
                    </td>
                    <td style='border-style: solid;border-width: 1px;border-color: black'>
                      <p align='center'>Amaun</p>
                      <p align='center'>RM .........</p>
                    </td> 
                  </tr>
      
                  <tr style='border-style: solid;border-width: 1px;border-color: black'>
                    <td colspan='2' style='border-style: solid;border-width: 1px;border-color: black'>
                    <br>
                      <p>&nbsp;&nbsp;Kod Majikan&nbsp; &nbsp; &nbsp;: ........................</p>
                      <p>&nbsp;&nbsp;Nama Majikan&nbsp;: ........................</p>
                      <p>&nbsp;&nbsp;Alamat&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;: ........................</p>
                    </td> 
                  </tr>
                  </table>

                  <br>
                  <table>
                  <tr style='font-family:verdana; font-size: small; '>
                    <td> Tandatangan&nbsp;:</td>
                    <td>.....................................</td>
                  </tr>

                  <tr style='font-family:verdana; font-size: small; '>
                    <td> Nama Penuh&nbsp;:</td>
                    <td>.....................................</td>
                  </tr>
        
                  <tr style='font-family:verdana; font-size: small; '>
                    <td> Telefon&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; :</td>
                    <td>.....................................</td>
                  </tr>

                  <tr style='font-family:verdana; font-size: small; '>
                    <td> Emel&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; :</td>
                    <td>.....................................</td>
                  </tr>
                  </table>
      
                  <p>......................................................................................................................................................................................................</p>
                  <p class='font-weight-bold' align='center' style='font-family:verdana; font-size: small;'>DIISI OLEH PERKESO</p>
                  <p class='font-weight-bold'  style='font-family:verdana; font-size: small;'>AKUAN PENERIMAAN</p>

                  <p style='font-family:verdana; font-size: small;'>Adalah diakui bahawa caruman yang dibayar menggunakan cd/disket berkenaan telah diterima.</p>

                  <table align='center' >
                  <tr style='font-family:verdana; font-size: small;'>
                    <td> Nama Majikan:</td>
                    <td colspan='3'>.....................................</td>
                  </tr>

                  <tr style='font-family:verdana; font-size: small;'>
                    <td> No Cek Kiriman Wang/Wang Pos/ Draf Bank&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; :</td>
                    <td>.....................................</td>
                    <td> Bulan Caruman&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; :</td>
                    <td>.....................................</td>
                  </tr>

                  <tr style='font-family:verdana; font-size: small;'>
                    <td> Amaun&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; :</td>
                    <td> RM...............................</td>
                    <td> Tarikh&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; :</td>
                    <td>.....................................</td>
                  </tr>

                  <tr style='font-family:verdana; font-size: small;'>
                    <td> Tandatangan Pegawai&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; :</td>
                    <td>.....................................</td>
                    <td> Cop Pejabat Tempatan&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; :</td>
                    <td>.....................................</td>
                  </tr>

                  <tr style='font-family:verdana; font-size: small;'>
                    <td class='font-weight-bold'> Nama Pegawai:</td>
                    <td colspan='3'>.....................................</td>
                  </tr>
                  </table>

                  </div>
                  <p style='page-break-before:always'>&nbsp;</p>
              ";
          }
        }
        else{
          for ($i=0; $i < count($socsolist) ; $i++) { 
            $userobject = new User();
            $useresult = $userobject->searchOnly($socsolist[$i]);
            echo "
            <h6 class='font-weight-bold' align='center'>SOCSO CONTRIBUTION SCHEDULE</h6>
              <table class='table table-bordered'>

              <tr class='bg-secondary'>
                <td class='text-white'>Code</td>
                <td class='text-white'>SOCSO No.</td>
                <td class='text-white'>Name</td>
                <td class='text-white'>Employee SOCSO</td>
                <td class='text-white'>Employee SOCSO</td>
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
