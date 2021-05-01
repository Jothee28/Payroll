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
     $userID = escape(Input::get('userID'));
     $commision = new CommisionEmployee();
$commisionresult = $commision->searchCommisionUser($userID);
$view = 
"
<table class='table table-striped' id='showcommisionemployeelist'>
  <thead class='bg-primary text-light'>
    <tr>
      <th scope='col' style='width: 15%; text-align:center;'>Payroll Type</th>
      <th scope='col' style='width: 15%; text-align:center;'>Commision Description</th>
      <th scope='col' style='width: 15%; text-align:center;'>Amount</th>
      <th scope='col' style='width: 15%; text-align:center;'>Date</th>
      <th scope='col' style='width: 15%; text-align:center;'>Note</th>
      <th scope='col' style='width: 15%; text-align:center;'>Action</th>
    </tr>
  </thead>
  <tbody>  
";
 if($commisionresult){
  foreach ($commisionresult as $row){
    $view .=  
    "
   
      <tr>
      <td>".$row->commisionpayrolltype."</td>
      <td>".$row->commision_id."</td>
      <td>".$row->commision_amount."</td>
       <td>".$row->commision_date."</td> 
        <td>".$row->commision_note."</td> 
      <td style='text-align:center;'>
     <a href='#' class='btn btn-sm btn-secondary editcommision' data-toggle='modal' data-id='".$row->commision_eid."'data-target='#editcommisionmodal'>Edit</a> I  <a href='#' class='btn btn-danger deletecommision' data-toggle='modal' data-id='".$row->commision_eid."' data-target='#deletecommisionmodal'>Delete</a></td>
      </tr>
   
    ";
  }
 }else{
  $view .="<tr><td> No Commision </td></tr>";
 }
  
{
 
$view .= 
"
 </tbody>
</table>
";
}
echo $view;
}

 ?>