<?php
require_once 'core/init.php';

$commision = new commision();
if(Input::exists()){
	$editcommisionid = escape(Input::get('editcommisionid'));
	$editcommisioncode = escape(Input::get('editcommisioncode'));
	$editcommisiondesc = escape(Input::get('editcommisionDesc'));

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

	$editcommisioncodeerror = exists($editcommisioncode);
	$editcommisiondescerror = exists($editcommisiondesc);

	$condition = condition($editcommisioncodeerror, $editcommisiondescerror);

	if($condition === "Passed"){
		$commision = new commision();
		$commision->editcommision(array(
			'commision_code' => $editcommisioncode,
			'commisionDesc' => $editcommisiondesc,
			), $editcommisionid, "commision_id");
		$array = [
			"condition" => $condition,
		];
		
	}else{
		$array = [
			"commision_code" => $editcommisioncodeerror,
			"commisionDesc" => $editcommisiondescerror,
			"condition" => $condition
		];
	}
	
	echo json_encode($array);
}
?>