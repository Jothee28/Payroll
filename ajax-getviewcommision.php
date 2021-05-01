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

$commision = new commision();

if($resultresult->corporateID == "NULL"){
  $commisionresult = $commision->searchcommisionCompany($resultresult->companyID);
}
else{
  $commisionresult = $commision->searchcommisionCorporate($resultresult->corporateID);
}

$view = 
"
<table class='table table-bordered table-hover' id='showcommisionlist'>
  <thead class='bg-primary text-light'>
    <tr>
      <th scope='col' style='width: 7%; text-align:center;'>Code</th>
      <th scope='col' style='width: 20%; text-align:center;'>Description</th>
      <th scope='col' style='width: 7%; text-align:center;'>Created On</th>
      <th scope='col' style='width: 5%; text-align:center;'>Action</th>
    </tr>
  </thead>
";
if($commisionresult){
	foreach ($commisionresult as $row) {

	  $view .= 
	  "
    <tbody id='commisiontable'>
      <tr>
      <td>".$row->commision_code."</td>
      <td>".$row->commisionDesc."</td>
      <td>".$row->date."</td>
      <td style='text-align:center;'><button class='btn btn-sm btn-secondary editcommision' data-toggle ='modal' data-backdrop='static' data-keyboard='false' data-id='".$row->commision_id."' data-target='#editcommisionmodal'>edit</button> <button id='delete' class='btn btn-sm btn-danger deletecommision' data-toggle ='modal' data-backdrop='static' data-keyboard='false' data-id='".$row->commision_id."' data-target='#deletecommisionmodal'>delete</button></td>
      </tr>
    </tbody>
	  ";
	}
}else{
  $view .= 
  "
  <tbody>
    <tr>
      No data added
    </tr>
  ";
}
$view .= 
"
</table>
";

echo $view;
 ?>