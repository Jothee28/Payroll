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

$commisionobject = new CommisionEmployee();
if(Input::exists()){
    $commisionpayrolltype = escape(Input::get('addcommisionpayrolltype'));
	$commision_amount = escape(Input::get('addcommision_amount'));
	$commision_date = escape(Input::get('addcommision_date'));
	$commision_id = escape(Input::get('addcommision_id'));
	


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

	$commisionpayrolltypeerror = exists($commisionpayrolltype);
	$commision_amounterror = exists($commision_amount);
	$commision_dateerror = exists($commision_date);
	$commision_iderror= exists($commision_id);
	
	
	
$condition = condition($commisionpayrolltypeerror,$commision_amounterror, $commision_dateerror,$commision_iderror);

	if($condition === "Passed"){
		try{
			$commisionobject = new CommisionEmployee();
			$commisionobject->addCommisionEmployee(array(
                'commisionpayrolltype' => $commisionpayrolltype,
				'commision_amount' => $commision_amount,
				'commision_date' => $commision_date,
				'commision_id'=>$commision_id
			));
			
			$array = [
				"condition" => $condition,
			];
		} catch (Exception $e) {
			echo $e->getMessage();
		} 
		
	}else{
		$array = [
			"commisionpayrolltype" => $commisionpayrolltype,
			"commision_amount" => $commision_amounterror,
			"commision_date" => $commision_dateerror,
			"commision_id" =>$commision_id,
			"condition" => $condition
		];
	}
	
	echo json_encode($array);
}
?>