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

$advance = new Advance();
//if(Input::exists()){
    $advance_id = escape(Input::get('addadvance_id'));
	$advance_payrolltype = escape(Input::get('addadvance_payrolltype'));
	$advance_date = escape(Input::get('addadvance_date'));
	$advance_amount = escape(Input::get('addadvance_amount'));
	$advance_note = escape(Input::get('addadvance_note'));
	$emp_id = escape(Input::get('addemp_id'));
	


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
    $advance_payrolltypeerror = exists($advance_payrolltype);
	$advance_dateerror = exists($advance_date);
	$advance_amounterror = exists($advance_amount);
	
	$condition = condition($advance_payrolltypeerror,$advance_dateerror, $advance_amounterror);

	if($condition === "Passed"){
		try{
			$advance = new Advance();
		$advance->addAdvance(array(
                'advance_id' => $advance_id,
				'advance_payrolltype' => $advance_payrolltype,
				'advance_date' => $advance_date,
				'advance_amount' => $advance_amount,
				'advance_note' => $advance_note,
				 'emp_id'=> $emp_id
				));
			
			 $array = [ 
			     "advance_id" => $advance_id,
                "advance_payrolltype" => $advance_payrolltype,
                 "advance_amount" => $advance_amount,
                "advance_date" => $advance_date,
                "advance_note" => $advance_note,
                 "userID"=>$emp_id,
                 "condition" => $condition
    ];
    } catch (Exception $e) {
      echo $e->getMessage();
    } 
    
  }else{
    $array = [  
      "advance_payrolltype" => $advance_payrolltypeerror,
      "advance_amount" => $advance_amounterror,
      "advance_date" => $advance_dateerror,
       "condition" => $condition
    ];
  }
  
  echo json_encode($array);
//}
?>