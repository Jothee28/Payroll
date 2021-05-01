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

if(Input::exists()){
  $commision_id = escape(Input::get('commision_id'));

	$commision = new commision();

	$data = $commission->searchOnly($commision_id);
	if($data){
    	$array = [
    	  "commision_id" => $data->commision_id,
     	  "commision_code" => $data->commision_code,
    	  "commisionDesc" => $data->commisionDesc,
		];
	}

	echo json_encode($array);
}
?>
