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
 
 
$commision = new CommisionEmployee();
if(Input::exists()){
    $commision_eid = escape(Input::get('editcommision_eid'));
    $commisionpayrolltype = escape(Input::get('editcommisionpayrolltype'));
    $commision_amount = escape(Input::get('editcommision_amount'));
    $commision_date = escape(Input::get('editcommision_date'));
    $commision_id = escape(Input::get('editcommision_id'));
    $commision_note = escape(Input::get('editcommision_note'));
    $emp_id = escape(Input::get('editemp_id'));
  


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
  $commision_iderror = exists($commision_id);
 

  $condition = condition($commisionpayrolltypeerror,$commision_amounterror,$commision_dateerror, $commision_iderror);


	if($condition === "Passed"){ 
    try{
      $commisionobject = new CommisionEmployee();
    $commisionobject->updateCommisionEmployee(array(
        'commision_eid' => $commision_eid,
        'commisionpayrolltype' => $commisionpayrolltype,
        'commision_amount' => $commision_amount,
        'commision_date' => $commision_date,
        'commision_id' => $commision_id,
        'commision_note' => $commision_note,
        'emp_id'=> $emp_id
        ),$commision_eid, "commision_eid");  
      
      
      $array = [  
      "commision_eid"=> $commision_eid,
      "commisionpayrolltype" => $commisionpayrolltype,
      "commision_amount" => $commision_amount,
      "commision_date" => $commision_date,
      "commision_id"=> $commision_id,
      "commision_note"=> $commision_note,
      "userID"=>$emp_id,
      "condition" => $condition
    ];
    } catch (Exception $e) {
      echo $e->getMessage();
    } 
    
  }else{
    $array = [  
      "commisionpayrolltype" => $commisionpayrolltypeerror,
      "commision_amount" => $commision_amounterror,
      "commision_date" => $commision_dateerror,
      "commision_id"=> $commision_iderror,
      "condition" => $condition
    ];
  }
  
  echo json_encode($array);
}
?>