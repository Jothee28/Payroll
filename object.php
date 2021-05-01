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
  $planobject = new Plan();
if(Input::exists()){
	$plan = escape(Input::get('addplannamedaily'));
	$startdate = escape(Input::get('addplanstartdate'));
	$enddate = escape(Input::get('addplanenddate'));
	$userID = escape(Input::get('userID'));


	function exists($data){
		if(empty($data)){
			return "Required";
		}else{
			return "Valid";
		}
	}

	function condition($data1, $data2, $data3){
		if($data1 === "Valid" && $data2 === "Valid" && $data3 === "Valid"){
			return "Passed";
		}else{
			return "Failed";
		}
	}

	$planerror = exists($plan);
	$startdateerror = exists($startdate);
	$enddateerror = exists($enddate);


	$condition = condition($planerror, $startdateerror, $enddateerror);

	if($condition === "Passed"){
		try{
			$planobject = new Plan();
			$planobject->addPlan(array(
				'plan' => $plan,
				'startdate' => $startdate,
				'enddate' => $enddate,
				'week' => date('W'),
				'year' => date('Y'),
				'userID' => $userID,
				'status' => "In Progress"
			));
			$array = [
				"condition" => $condition,
			];
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		
	}else{
		$array = [
			"plan" => $planerror,
			"startdate" => $startdateerror,
			"enddate" => $enddateerror,
			"condition" => $condition
		];
	}
}
	
	//EDIT PLAN
	if(Input::exists()){
	$plan = escape(Input::get('editplannamedaily'));
	$startdate = escape(Input::get('editplanstartdate'));
	$enddate = escape(Input::get('editplanenddate'));
	$status = escape(Input::get('editplanstatus'));
	$planID = escape(Input::get('editplanid'));


	function exists($data){
		if(empty($data)){
			return "Required";
		}else{
			return "Valid";
		}
	}

	function condition($data1, $data2, $data3, $data4){
		if($data1 === "Valid" && $data2 === "Valid" && $data3 === "Valid" && $data4 === "Valid"){
			return "Passed";
		}else{
			return "Failed";
		}
	}

	$planerror = exists($plan);
	$startdateerror = exists($startdate);
	$enddateerror = exists($enddate);


	if($startdateerror === "Valid" && $enddateerror === "Valid"){
		if($startdate <= $enddate){
			$enddateerror = "Valid";
		}else{
			$enddateerror = "End date must after start date";
		}
	}else{
		$enddateerror = "Required";
	}
	$allstatus = array("Stuck", "Issue", "In Progress", "Done");
	$statuserror = exists($status);
	if($statuserror === "Valid"){
		if (in_array($status, $allstatus)){
			$statuserror = "Valid";
		}else{
			$statuserror = "Invalid";
		}
	}

	$condition = condition($planerror, $startdateerror, $enddateerror, $statuserror);

	if($condition === "Passed"){
		try{
			$planobject = new Plan();
			$planobject->updatePlan(array(
				'plan' => $plan,
				'startdate' => $startdate,
				'enddate' => $enddate,
				'status' => $status
			), $planID, "planID");
			$array = [
				"condition" => $condition,
			];
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		
	}else{
		$array = [
			"plan" => $planerror,
			"startdate" => $startdateerror,
			"enddate" => $enddateerror,
			"condition" => $condition
		];
	}
	
	//DELETE PLAN
	
	
	echo json_encode($array);
}



?>