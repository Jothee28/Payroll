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

if(Input::exists()){
  $commision_eid  = escape(Input::get('commision_eid'));

  $commision = new CommisionEmployee();
  $data = $commision->searchCommisionEmployee($commision_eid);
  if($data){
      $array = [
        'commision_eid'=> $data->commision_eid,
        'commisionpayrolltype'=> $data->commisionpayrolltype,
        'commision_id'=>$data->commision_id,
        'commision_amount'=> $data->commision_amount,
        'commision_note'=> $data->commision_note,
        'commision_date'=> $data->commision_date
    ];
  }


  echo json_encode($array);
}
?>



                  