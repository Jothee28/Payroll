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
    $advance = new Advance();
$advanceresult = $advance->searchAdvanceUser($userID);
$view = 
"
<table class='table table-striped' id='showadvancelist'>
  <thead class='bg-primary text-light'>
    <tr>
      <th scope='col' style='width: 20%; text-align:center;'>Payroll Type</th>
      <th scope='col' style='width: 20%; text-align:center;'>Amount</th>
      <th scope='col' style='width: 20%; text-align:center;'>Date</th>
       <th scope='col' style='width: 20%; text-align:center;'>Note</th>
      <th scope='col' style='width: 20%; text-align:center;'>Action</th>
    </tr>
  </thead>
  <tbody>
";
 if($advanceresult){
  foreach ($advanceresult as $row){
    $view .=  
    "
   
      <tr>
      <td>".$row->advance_payrolltype."</td>
      <td>".$row->advance_amount."</td>
       <td>".$row->advance_date."</td> 
         <td>".$row->advance_note."</td> 
      <td style='text-align:center;'>
      <a href='#' class='btn btn-sm btn-secondary editadvance' data-toggle='modal' data-id='".$row->advance_id."'data-target='#editadvancemodal'>Edit</a> I  <a href='#' class='btn btn-danger deleteadvance' data-toggle='modal' data-id='".$row->advance_id."' data-target='#deleteadvancemodal'>Delete</a></td>
      </tr>
   
    ";
  }
 }else{
  $view .="<tr><td> No Advance </td></tr>";
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
                    