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
  $advance_id = escape(Input::get('advance_id'));

  $advance = new Advance();
  $data = $advance->searchOnlyAdvance($advance_id);
  if($data){
      $array = [
        'advance_id' => $data->advance_id,
        'advance_payrolltype' => $data->advance_payrolltype,
        'advance_amount' => $data->advance_amount,
        'advance_date' => $data->advance_date,
        'advance_note' => $data->advance_note,
        'emp_id' =>$data->emp_id
    ];
  }


  echo json_encode($array);
}
?>