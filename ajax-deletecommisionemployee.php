 <?php  
require_once 'core/init.php';
if(Input::exists()){ 
	$deletecommision_eid = escape(Input::get('deletecommision_eid'));

	$commision = new CommisionEmployee(); 
	$deleteresult = $commision->deleteCommisionEmployee($deletecommision_eid);
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