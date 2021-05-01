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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Generate Payslip - DoerHRM</title> 
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
						<h1 style="text-align:center;"class="font-weight-light">Process Payroll<br><br></h1>
						 <div style="float:right;padding:15px">
            <input type="text" id="payrollSearch" placeholder="Search??">          
        </div>
					</div>
				</div>
<script type="text/javascript">

    $("#payrollSearch").on("keyup", function() 
    {
        var value = $(this).val().toLowerCase();
        $("#showpayroll_historylist tr").filter(function() 
        {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
</script>

				<script type="text/javascript">
					$(document).ready(function(){
						function getviewgeneratePayslip(){
							$.ajax({
								url:"ajax-getviewgeneratePayslip.php",
								success:function(data){
									$("#showpayroll_historylist").html(data);
								}
							});
						}
						getviewgeneratePayslip();
					});
				</script>
				<div id="showpayroll_historylist"></div>
			</div>
			<div style="text-align: center;">
				<button type="button" class="btn btn-light btn-lg btn-outline-dark" data-toggle ="modal" data-backdrop='static' data-keyboard='false' data-target="#payslip">Process Payroll</button>
			</div>
			<?php include "generatePayslipform.php" ?>
			<script type="text/javascript">
				$(document).ready(function(){
					$("#sidebar-wrapper .active").removeClass("active");
					document.getElementById("payrolltab").style.backgroundColor = "DeepSkyBlue";
				});

				$(document).ready(function(){
					$('#groupcompany').change(function() {
						var id = document.getElementById("groupcompany").value;
						$.ajax({
							url:"ajax-getcompany.php?lang=<?php echo $extlg;?>",
 							method:"POST",
							data:{id:id},
							dataType:"json",
							success:function(data){
								console.log(data);
								document.getElementById("companyname").innerHTML = data.company;
							}
				 		});
						$.ajax({
							url:"ajax-getempyear.php?lang=<?php echo $extlg;?>",
							method:"POST",
							data:{cid:id},
							success:function(data){
								console.log(data);
								$("#selectoptions").html(data);
							}

						});

						$.ajax({
							url:"ajax-getempcom.php?lang=<?php echo $extlg;?>",
							method:"POST",
							data:{cid:id},
							success:function(data){
								console.log(data);
								$("#employeeName").html(data);
							}
						});
					});
				});

					$(document).ready(function(){
						var id = document.getElementById("groupcompany").value;
						$.ajax({
							url:"ajax-getcompany.php?lang=<?php echo $extlg;?>",
							method:"POST",
							data:{id:id},
							dataType:"json",
							success:function(data){
								document.getElementById("companyname").innerHTML = data.company;
							}
						});

						$.ajax({
							url:"ajax-getempyear.php?lang=<?php echo $extlg;?>",
							method:"POST",
							data:{cid:id},
							success:function(data){
								console.log(data);
								$("#selectoptions").html(data);
							}
						});

						$.ajax({
							url:"ajax-getempcom.php?lang=<?php echo $extlg;?>",
							method:"POST",
							data:{cid:id},
							success:function(data){
								console.log(data);
								$("#employeeName").html(data);
							}
						});
					});

					$('#employeeName').on('shown.bs.collapse', function () {
					  this.scrollIntoView();
					});

					$(document).ready(function(){
						$(document).on('click', ".payslipdetails", function(){
							var payroll_history_id = $(this).data('id');	
							console.log(payroll_history_id);
							$.ajax({
						        url:"payslipSummary.php?lang=<?php echo $extlg;?>",
						        method:"POST",
						        data:{payroll_history_id:payroll_history_id},
						        dataType:"json",
						        success:function(data){
                              $("#payroll_history_id").val(data.payroll_history_id);
						        }
						    })
						})
					})


					$(document).ready(function(){
						$(document).on('click', ".deletepayroll", function(){
							var deletepayroll_history_id = $(this).data('id');	
							console.log(deletepayroll_history_id);
							$.ajax({
						        url:"ajax-deletepayroll_history.php?lang=<?php echo $extlg;?>",
						        method:"POST",
						        data:{deletepayroll_history_id:deletepayroll_history_id},
						        dataType:"json",
						        success:function(data){
                                 $("#deletepayroll_history_id").val(data.payroll_history_id);
						        }
						    })
						})
					})
			</script>
			<?php
			include 'includes/footer.php';
			?>
</body>
</html>