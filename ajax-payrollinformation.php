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

$employee = new employee();

if(Input::exists()){
	$empID = escape(Input::get("empID"));
	$checkpayrollinforow = escape(Input::get("checkpayrollinforow"));
	$jobtitle = escape(Input::get("jobtitle"));
	$department = escape(Input::get("department"));
	$superior = escape(Input::get("superior"));
	$employeetype = escape(Input::get("employeetype"));
	$wagetype = escape(Input::get("wagetype"));
	$basicrate = escape(Input::get("basicrate"));
	$payfreq = escape(Input::get("payfreq"));
	$paymentby = escape(Input::get("paymentby"));
	$bankpayout = escape(Input::get("bankpayout"));

	function exists($data){
		if(empty($data)){
			return "Required";
		}else{
			return "Valid";
		}
	}

	function condition($data1, $data2, $data3, $data4, $data5, $data6,$data7){
		if($data1 === "Valid" && $data2 === "Valid" && $data3 === "Valid" && $data4 === "Valid" && $data5 === "Valid" && $data6 === "Valid" ){
			return "Passed";
		}else{
			return "Failed";
		}
	}

	$departmenterror = exists($department);
	$jobtitlerror = exists($jobtitle);
	$employeetypeerror = exists($employeetype);
	$wagetypeerror = exists($wagetype);
	$basicrateerror = exists($basicrate);
	$payfreqerror = exists($payfreq);
	$paymentbyerror = exists($paymentby);

	$condition = condition($departmenterror,$jobtitlerror, $employeetypeerror, $wagetypeerror, $basicrateerror, $payfreqerror, $paymentbyerror);

	if($condition==="Passed"){
		try{
			$employeeObject = new employee();
			if($checkpayrollinforow ==="None"){
				$employeeObject->addpayrollinformationrow(array(
						'payinfo_job_title'=>$jobtitle,
						'payinfo_department'=>$department,
						'payinfo_superior'=>$superior,
						'payinfo_emptype'=>$employeetype,
						'payinfo_wagetype'=>$wagetype,
						'payinfo_basicrate'=>$basicrate,
						'payinfo_payfrequency'=>$payfreq,
						'payinfo_paymentby'=>$paymentby,
						'payinfo_bankpayout'=>$bankpayout,
						'userID'=>$empID
				));
				$array = ["condition" =>$condition];
			}else{
				$employeeObject->updatePayrollInfo(array(
						'payinfo_job_title'=>$jobtitle,
						'payinfo_department'=>$department,
						'payinfo_superior'=>$superior,
						'payinfo_emptype'=>$employeetype,
						'payinfo_wagetype'=>$wagetype,
						'payinfo_basicrate'=>$basicrate,
						'payinfo_payfrequency'=>$payfreq,
						'payinfo_paymentby'=>$paymentby,
						'payinfo_bankpayout'=>$bankpayout
				),$empID,'userID');
				$array = ["condition" =>$condition];
			}
		}catch (Exception $e){
			echo $e->getMessage();
		}

	}else{
		$array = [
			"department" => $departmenterror,
			"jobtitle" => $jobtitlerror,
			"employeetype" => $employeetypeerror,
			"wagetype" => $wagetypeerror,
			"basicrate" => $basicrateerror,
			"payfreq" => $payfreqerror,
			"paymentby" => $paymentbyerror,
			"condition" => $condition
		];
	}

	echo json_encode($array);
}

?>