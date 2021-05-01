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
  <title>Commision - DoerHRM</title> 
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
            <h1 style="text-align:center;"class="font-weight-light">Commision<br><br></h1>
          </div>
        </div>
        <div class="row float-right">
            <div class="col">
                <div class="input-group">
                    <input id="commisionfilter" class="form-control py-2 border-right-0 border" type="search" placeholder="Filter...">
                    <span class="input-group-append">
                        <div class="input-group-text bg-transparent"><i class="fa fa-search"></i></div>
                    </span>
                </div>
            </div>
            <?php include "commisionform.php" ?>   
            <button class="btn btn-primary" data-toggle ="modal" data-backdrop='static' data-keyboard='false' data-target="#commisionmodal">Add New</button>
          </div>
          <br><br><br>
          <script type="text/javascript">
             $(document).ready(function(){
                function getviewcommision(){
                  $.ajax({
                  url:"ajax-getviewcommision.php",
                  success:function(data){
                    $("#showcommisionlist").html(data);
                  }
                });
              }
              getviewcommision();
            });

             $(document).ready(function(){
              function getvieweditcommision(){

                console.log("testing3");
                $.ajax({
                url:"ajax-getviewcommision.php",
                success:function(data){
                  $("#showcommisionlist").html(data);
                }
              });
            }
            getvieweditcommision();
          });

             $(document).ready(function(){
              function getviewdeletecommision(){

                $.ajax({
                  url:"ajax-getviewcommision.php",
                  success:function(data){
                    $("#showcommisionlist").html(data);
                  }
                });
              }
              getviewdeletecommision();
            });
          </script>
          <div id="showcommisionlist"></div>
        </div>
      </div>
    </div>

  <script type="text/javascript">
    $(document).ready(function(){
       $("#sidebar-wrapper .active").removeClass("active");
       document.getElementById("toolstab").style.backgroundColor = "DeepSkyBlue";
    });

    $(document).ready(function(){
      $("#commisionfilter").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#commisiontable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
  </script>
  <?php
  include 'includes/footer.php';
  ?>
</body>
</html>


