 <?php 
require_once 'core/init.php';
if(Input::exists()){
	$deleteallowance_eid = escape(Input::get('deleteallowance_eid'));

	$allowance = new AllowanceEmployee(); 
	$deleteresult = $allowance->deleteAllowanceEmployee($deleteallowance_eid);
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