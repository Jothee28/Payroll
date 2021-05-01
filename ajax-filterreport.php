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
$ClaimType = new ClaimType();
if(Input::exists()){
	$code = escape(Input::get('addcodeclaimtype'));
	$description = escape(Input::get('adddescclaimtype'));
	$active = escape(Input::get('addactiveclaimtype'));
	$limited = escape(Input::get('addlimitedclaimtype'));
	$amount = escape(Input::get('addamountclaimtype'));


	function exists($data){
		if(empty($data)){
			return "Required";
		}else{
			return "Valid";
		}
	}

	function condition($data1, $data2, $data3, $data4, $data5){
		if($data1 === "Valid" && $data2 === "Valid" && $data3 === "Valid" && $data4 === "Valid" && $data5 === "Valid"){
			return "Passed";
		}else{
			return "Failed";
		}
	}

	$codeclaimtypeerror = exists($code);
	$descclaimtypeerror = exists($description);
	$activeclaimtypeerror = exists($active);
	$limitedclaimtypeerror = exists($limited);
	$amountclaimtypeerror = exists($amount);

	$condition = condition($codeclaimtypeerror, $descclaimtypeerror, $activeclaimtypeerror, $limitedclaimtypeerror, $amountclaimtypeerror);

	if($condition === "Passed"){
		try{
			$ClaimType = new ClaimType();
			$ClaimType->addclaimtype(array(
				'claimCode' => $code,
				'claimDesc' => $description,
				'claimActive' => $active,
				'claimLimited' => $limited,
				'claimAmount'=> $amount,
				'userID' => $resultresult->userID
			));
			$array = [
				"condition" => $condition,
			];
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		
	}else{
		$array = [
			"claimCode" => $codeclaimtypeerror,
			"claimDesc" => $descclaimtypeerror,
			"claimActive" => $activeclaimtypeerror,
			"claimLimited" => $limitedclaimtypeerror,
			"claimAmount" => $amountclaimtypeerror,
			"condition" => $condition
		];
	}
	
	echo json_encode($array);
}
?>