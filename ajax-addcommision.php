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

$commisionobject = new commision();

if(Input::exists()){
	$commisioncode = escape(Input::get('commisioncode'));
	$commisiondesc = escape(Input::get('commisiondesc'));

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

	$commisioncodeerror = exists($commisioncode);
	$commisiondescerror = exists($commisiondesc);

	$condition = condition($commisioncodeerror, $commisiondescerror);

	if($condition === "Passed"){
		try{
			$commisionobject = new commision();
			$commisionobject->addcommision(array(
				'commision_code' => $commisioncode,
				'commisionDesc' => $commisiondesc,
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
			"commision_code" => $commisioncodeerror,
			"commisionDesc" => $commisiondescerror,
			"condition" => $condition
		];
	}

	echo json_encode($array);
}
?>