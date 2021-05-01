<?php
require_once 'core/init.php';
if(Input::exists()){
	$deletecommisionid = escape(Input::get('deletecommisionid'));

	$commision = new commision();
	$deleteresult = $commision->deletecommision($deletecommisionid);
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