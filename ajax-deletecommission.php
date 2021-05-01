<?php
require_once 'core/init.php';
if(Input::exists()){
	$deletecommissionid = escape(Input::get('deletecommissionid'));

	$commission = new commission();
	$deleteresult = $commission->deletecommission($deletecommissionid);
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