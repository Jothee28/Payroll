  <?php  
require_once 'core/init.php';
if(Input::exists()){ 
	$deleteadvance_id = escape(Input::get('deleteadvance_id'));

	$advance = new Advance(); 
	$deleteresult = $advance->deleteAdvanceEmployee($deleteadvance_id);
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