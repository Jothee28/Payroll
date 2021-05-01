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

$allowanceobject = new allowance();

if(Input::exists()){
	$allowancecode = escape(Input::get('allowancecode'));
	$allowancedesc = escape(Input::get('allowancedesc'));
	$allowancepayEPF = escape(Input::get('allowancepayEPF'));
	$allowancepaySOCSOEIS = escape(Input::get('allowancepaySOCSOEIS'));
	$allowancepayTax = escape(Input::get('allowancepayTax'));

	function exists($data){
		if(empty($data)){
			return "Required";
		}else{
			return "Valid";
		}
	}

	function condition($data1, $data2){
		if($data1 === "Valid" && $data2 === "Valid"){
			return "Passed";
		}else{
			return "Failed";
		}
	}

	$allowancecodeerror = exists($allowancecode);
	$allowancedescerror = exists($allowancedesc);

	$condition = condition($allowancecodeerror, $allowancedescerror);

	if($allowancepayEPF == "true"){
		$allowancepayEPF = 1;
	}
	else{
		$allowancepayEPF = 0;
	}

	if($allowancepaySOCSOEIS == "true"){
		$allowancepaySOCSOEIS = 1;
	}
	else{
		$allowancepaySOCSOEIS = 0;
	}

	if($allowancepayTax == "true"){
		$allowancepayTax = 1;
	}
	else{
		$allowancepayTax = 0;
	}

	if($condition === "Passed"){
		try{
			$allowanceobject = new allowance();
			$allowanceobject->addAllowance(array(
				'allowance_code' => $allowancecode,
				'allowanceDesc' => $allowancedesc,
				'payEPF' => $allowancepayEPF,
				'paySOCSOEIS' => $allowancepaySOCSOEIS,
				'payTAX' => $allowancepayTax,
				'date' => date("Y/m/d"),
				'corporateID' => $resultresult->corporateID,
				'companyID' => $resultresult->companyID,
			));
			$array = [
				"condition" => $condition,
			];

		} catch (Exception $e) {
			echo $e->getMessage();
		}	
	}else{
		$array = [
			"allowance_code" => $allowancecodeerror,
			"allowanceDesc" => $allowancedescerror,
			"condition" => $condition
		];
	}

	echo json_encode($array);
}
?>