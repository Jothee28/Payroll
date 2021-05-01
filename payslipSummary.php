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
$payroll_history= new payroll_history();
$payroll_history_id = escape(Input::get('payroll_history_id'));
$payroll_historyresultOnly =$payroll_history->searchOnlypayroll_history($payroll_history_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Payslip Summary - DoerHRM</title> 
  <?php
  include 'includes/header.php';
  ?>
</head>
<body>
  <?php include 'includes/topbar.php';?>
  <div class="d-flex" id="wrapper">
    <?php include 'includes/navbar.php';?>
    <div id="page-content-wrapper">
      <div class="container-fluid" id="content"> 
        <div class="row my-5">
          <div class="col">
            <h1 style="text-align:center;"class="font-weight-light">Payslip Summary<br><br></h1>
          </div>
        </div>
        <form id="summaryform">
        <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Summary</a>
            <a class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Details</a>
          </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <br>
            <div class="container-fluid">
              <div class="row">
                <button class="btn btn-primary">Commit All</button>
              </div>
              <br> 
              <div class="row text-light">
                <div class="col border rounded" style="background-color:#00ccff;">
                  <p style="text-align: center;">TOTAL EMPLOYEE AMOUNT</p>
                  <p class="h3" style="text-align: center;">
                     <?php 
                      $payroll_history_id = escape(Input::get('payroll_history_id'));
                      $empobject = new payroll_history();
                      $empresult = $empobject->searchOnly($payroll_history_id);
                    
                       echo $empresult->employeecount;
                     
                    ?>
                  </p>
                </div>
                <div class="col border rounded mx-1" style="background-color:#00ccff;">
                  <p style="text-align: center;">TOTAL NET PAY</p>
                  <p class="h3" style="text-align: center;">
                   
                  </p>
                </div>
                <div class="col border rounded" style="background-color:#00ccff;">
                  <p style="text-align: center;">LEAVE CUT OFF DATE</p>
                  <p class="h3" style="text-align: center;">
                    <?php
                      $empobject = new payroll_history();
                      $payroll_history = escape(Input::get('payroll_history_id'));
                      $empresult = $empobject->searchOnly($payroll_history_id);
                      echo $empresult->leavecutoffdate;
                      ?>
                  </p>
                </div>
              </div>
              <br>
              <div class="row border">
                <div class="col bg-light">
                  <p style="text-align: center;">TOTAL PCB</p>
                  <p class="h4" style="text-align: center;">
                    
                  </p>
                </div>
                <div class="col border-left bg-light">
                  <p style="text-align: center;">TOTAL EPF</p>
                  <p class="h4" style="text-align: center;">10000</p>
                </div>
                <div class="col border-left bg-light">
                  <p style="text-align: center;">TOTAL SOCSO</p>
                  <p class="h4" style="text-align: center;">1</p>
                </div>
                <div class="col border-left bg-light">
                  <p style="text-align: center;">TOTAL EIS</p>
                  <p class="h4" style="text-align: center;">1</p>
                </div>
              </div>
              <br> <br> 
              <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle=    "dropdown" aria-haspopup="true" aria-expanded="false">Summary Files</button>
           <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
           <a class="dropdown-item" href="#">Payslip Report</a>
          <a class="dropdown-item" href="#">Summary Report</a>
         </div>
          </div>
           <br>
              <div class="row float-left">
                <div class="input-group">
                    <input class="form-control py-2 border-right-0 border" type="search" value="Filter..." id="example-search-input">
                    <span class="input-group-append">
                        <div class="input-group-text bg-transparent"><i class="fa fa-search"></i></div>
                    </span>
                </div>
              </div>
              <br><br>
              <table class="table table-bordered table-hover">
                  <thead class="bg-primary text-light">
                    <tr>
                      <th scope="col">Employee</th>
                      <th scope="col">Job Title</th>
                      <th scope="col">Role</th>
                      <th scope="col">Salary</th>
                      <th scope="col">Gross Pay</th>  
                      <th scope="col">Total Deduction</th>  
                      <th scope="col">Net Pay</th>  
                    </tr>
                  </thead>
                  <tbody>
                    
                    
                      <?php
                     $userobject = new User();
                if($resultresult->corporateID){
            $userresult = $userobject->searchWithCorporate($resultresult->corporateID);
                }else{
                $userresult = $userobject->searchWithCompany($resultresult->companyID);
                   }
                      if ($userresult){
                              foreach($userresult as $row){
                                // calculation 
                                $employeeobject= new Employee ();
                                $employeeresult= $employeeobject->searchOnlyEmployeePersonalInformation($row->userID);
                                if($employeeresult){
                                 $salary=$employeeresult->salary;
                                }else{
                                  $salary=0;
                                }

                    
                 $payroll_historyobject= new payroll_history();
    $payroll_historyresult= $payroll_historyobject->searchempallowance($row->userID,$payroll_historyresultOnly->payroll_date,$payroll_historyresultOnly->leavecutoffdate);
                                 if($payroll_historyresult){
                                  $totalallowance=0;
                                  foreach($payroll_historyresult as $row2){
                                    $totalallowance=$totalallowance+$row2->allowanceAmount;
                                  }
                       } else{
                        $totalallowance=0;
                       }   
                            $payroll_historyobject= new payroll_history();
          $payroll_historyresult= $payroll_historyobject->searchempbonus($row->userID,$payroll_historyresultOnly->payroll_date,$payroll_historyresultOnly->leavecutoffdate);
                                 if($payroll_historyresult){
                                  $totalbonus=0;
                                  foreach($payroll_historyresult as $row3){
                                    $totalbonus=$totalbonus+$row3->bonus_amount;
                                  }
                       } else{
                        $totalbonus=0;
                       }       

                        $payroll_historyobject= new payroll_history();
          $payroll_historyresult= $payroll_historyobject->searchempovertime($row->userID,$payroll_historyresultOnly->payroll_date,$payroll_historyresultOnly->leavecutoffdate);
                                 if($payroll_historyresult){
                                  $totalovertime=0;
                                  foreach($payroll_historyresult as $row4){
                                    $totalovertime=$totalovertime+$row4->overtimeAmount;
                                  }
                       } else{
                        $totalovertime=0;
                       }       

                       $payroll_historyobject= new payroll_history();
          $payroll_historyresult= $payroll_historyobject->searchempcommission($row->userID,$payroll_historyresultOnly->payroll_date,$payroll_historyresultOnly->leavecutoffdate);
                                 if($payroll_historyresult){
                                  $totalcommission=0;
                                  foreach($payroll_historyresult as $row5){
                                    $totalcommission=$totalcommission+$row5->commision_amount;
                                  }
                       } else{
                        $totalcommission=0;
                       }       


                              $employeeobject= new Employee ();
                $employeeresult= $employeeobject->searchOnlyEmployeePersonalInformation($row->userID);
                if($employeeresult){
                                 $salary=$employeeresult->salary;
                                }else{
                                  $salary=0;
                                }

             $grosspay= $salary+$totalallowance+$totalbonus+$totalovertime+$totalcommission;


            $payroll_historyobject= new payroll_history();
    $payroll_historyresult= $payroll_historyobject->searchempdeduction($row->userID,$payroll_historyresultOnly->payroll_date,$payroll_historyresultOnly->leavecutoffdate);
                                 if($payroll_historyresult){
                                  $totaldeduction=0;
                                  foreach($payroll_historyresult as $row6){
                                    $totaldeduction=$totaldeduction+$row6->deductionAmount;
                                  }
                       } else{
                        $totaldeduction=0;
                       }   

                        $payroll_historyobject= new payroll_history();
    $payroll_historyresult= $payroll_historyobject->searchempadvance($row->userID,$payroll_historyresultOnly->payroll_date,$payroll_historyresultOnly->leavecutoffdate);
                                 if($payroll_historyresult){
                                  $totaladvance=0;
                                  foreach($payroll_historyresult as $row7){
                                    $totaladvance=$totaladvance+$row7->advance_amount;
                                  }
                       } else{
                        $totaladvance=0;
                       }   

                         $payroll_historyobject= new payroll_history();
    $payroll_historyresult= $payroll_historyobject->searchempcp38($row->userID,$payroll_historyresultOnly->payroll_date,$payroll_historyresultOnly->leavecutoffdate);
                                 if($payroll_historyresult){
                                  $totalcp38=0;
                                  foreach($payroll_historyresult as $row7){
                                    $totalcp38=$totalcp38+$row7->cp38_amount;
                                  }
                       } else{
                        $totalcp38=0;
                       }   

                        $payroll_historyobject= new payroll_history();
    $payroll_historyresult= $payroll_historyobject->searchempparrears($row->userID,$payroll_historyresultOnly->payroll_date,$payroll_historyresultOnly->leavecutoffdate);
                                 if($payroll_historyresult){
                                  $totalpArrears=0;
                                  foreach($payroll_historyresult as $row8){
                                    $totalpArrears=$totalpArrears+$row8->pArrearsAmount;
                                  }
                       } else{
                        $totalpArrears=0;
                       }   

                        $payroll_historyobject= new payroll_history();
    $payroll_historyresult= $payroll_historyobject->searchemploan($row->userID,$payroll_historyresultOnly->payroll_date,$payroll_historyresultOnly->leavecutoffdate);
                                 if($payroll_historyresult){
                                  $totalloan=0;
                                  foreach($payroll_historyresult as $row9){
                                    $totalloan=$totalloan+$row9->loan_amount;
                                  }
                       } else{
                        $totalloan=0;
                       }   

                     



                    

            $totaldeduction= $totaldeduction+$totaladvance+$totalcp38+$totalpArrears+$totalloan;

            $netpay=$grosspay-$totaldeduction;




                                


               
                        

                                echo "
                                <tr>
                                  <td>".$row->firstname. " " .$row->lastname."</td>
                                  <td>".$row->jobposition."</td>
                                  <td>".$row->role."</td>
                                  <td>".$salary."</td>
                                  <td>".$grosspay."</td>
                                  <td>".$totaldeduction."</td>
                                  <td>".$netpay."</td>
                                </tr>
                                ";

                              }
                          }
                      ?>
                    
                    
                  
                    
                  </tbody>
                   
              </table>
            </div>
          </div>

          <!-- Payslip Details Part -->
          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <br>
            <div class="row">
              <div class="col-3">
              <input type="hidden" id="payslip_startdate" value="<?php echo $payroll_historyresultOnly->payroll_date?>">
               <input type="hidden" id="payslip_enddate" value="<?php echo $payroll_historyresultOnly->leavecutoffdate?>">
               <select class="form-control my-1" id="payslipType">
                  <?php 

                       $userobject = new User();
                if($resultresult->corporateID){
            $userresult = $userobject->searchWithCorporate($resultresult->corporateID);
                }else{
                $userresult = $userobject->searchWithCompany($resultresult->companyID);
                   }
                      if ($userresult){
                        foreach($userresult as $row){
                          ?>
                             <option value="<?php echo $row->userID?>"><?php echo $row->firstname." ".$row->lastname;?></option>
                           <?php
                        }
                      }
                  ?>
                </select>
              </div>

               <div class="col">
                <button class="btn btn-primary">PCB Calculation Details</button>
              </div>

              <div class="col">
                <button class="btn btn-primary">LHDN Calculation</button>
              </div>


              <div class="col">
                <button class="btn btn-primary" type="reset" value="Reset">Reset</button>
              </div>


                <button class="btn btn-danger float-right">Remove Employee's Payslip</button>
                <div id="employeedropdown">
                  <button class="btn dropdown-toggle float-right" type="button" id="employeedropdownname" data-toggle="dropdown"></button>
                  <div class="dropdown-menu col-2">
                    <div class="pl-2">
                       <select class="form-control my-1" id="remove_payslipType">
                 <?php 

                       $userobject = new User();
                if($resultresult->corporateID){
            $userresult = $userobject->searchWithCorporate($resultresult->corporateID);
                }else{
                $userresult = $userobject->searchWithCompany($resultresult->companyID);
                   }
                      if ($userresult){
                        foreach($userresult as $row){
                          ?>
                             <option value="<?php echo $row->userID?>"><?php echo $row->firstname." ".$row->lastname;?></option>
                           <?php
                        }
                      }
                  ?>
                </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>


              <div id="payslip_details"></div>
                <script type="text/javascript">
                  payslip_details();
                    $('#payslipType').change(function () {
                    payslip_details();
                });

        function payslip_details(){ 
    var payslipType = document.getElementById("payslipType").value;
    var payslip_startdate = document.getElementById("payslip_startdate").value;
    var payslip_enddate = document.getElementById("payslip_enddate").value;

    var alldata={
        userID:payslipType,
        startdate:payslip_startdate,
        enddate:payslip_enddate
};
  console.log(alldata);
    $.ajax({
      url:"ajax-getpayslip_details.php",
      type:"POST",
      dataType:"json",
      data:alldata,
      success:function(data){
      console.log(data);
      $("#payslip_details").html(data.view);  
      }
    });
  }
              </script>
           
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $(document).ready(function(){
       $("#sidebar-wrapper .active").removeClass("active");
       document.getElementById("payrolltab").style.backgroundColor = "DeepSkyBlue";
    });
  </script>
  <script type="text/javascript">
    var triggerTabList = [].slice.call(document.querySelectorAll('#nav-tab a'))
    triggerTabList.forEach(function (triggerEl) {
      var tabTrigger = new bootstrap.Tab(triggerEl)

      triggerEl.addEventListener('click', function (event) {
        event.preventDefault()
        tabTrigger.show()
      })
    })
  </script>
  <script type="text/javascript">
    $('#employeedropdown').on('hide.bs.dropdown', function (e) {
      if (e.clickEvent) {
        e.preventDefault();
      }
    })
  </script>
  <?php
  include 'includes/footer.php';
  ?>
</body>
</html>


