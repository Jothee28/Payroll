<?php
require_once 'core/init.php';
if(Input::exists()){
	$deleteallowanceid = escape(Input::get('deleteallowanceid'));

	$allowance = new allowance();
	$deleteresult = $allowance->deleteAllowance($deleteallowanceid);
	$condition = "Failed";
	if($deleteresult == true){
		$condition = "Passed";
	}else{
		$condition = "Failed";
	}


    $array = [
    	"condition" => $condition
	];

	echo json_encode($array);
}
?>