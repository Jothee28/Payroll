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
$selectReport = escape(Input::get('selectReport'));
$selectemployee = escape(Input::get('selectemployee'));
$selectDepartment = escape(Input::get('selectDepartment'));
$joinDate = escape(Input::get('joinDate'));
$resignDate = escape(Input::get('resignDate'));

$memberlist = array();

if ($selectemployee == '') {
  $groupresult1 = $groupobject->searchGroupMember($groupplan);
    if ($groupresult1) {
      foreach ($groupresult1 as $row1){
        $userobject = new User();
        $userresult = $userobject->searchOnly($row1->member_id);
        if($userresult){
          
            array_push($memberlist, $userresult->userID);
            
          }
        } 
      }
    
  }else{//adauser
    $userobject = new User();
        $userresult = $userobject->searchOnly($selectemployee);
        if($userresult){
          
            array_push($memberlist, $userresult->userID);
            
          }
        }
  }
  $memberlist = array_unique($memberlist);
  $memberlist = array_values($memberlist);

if($data){
      $array = [
        "userID" => $data->userID,
        "groupID" => $data->groupID,
        "empdet_join_date" => $data->empdet_join_date,
        "empdet_resign_date" => $data->empdet_resign_date,
        
    ];
  }
  echo json_encode($array);
}
?>