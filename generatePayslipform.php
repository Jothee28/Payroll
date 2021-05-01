 <script type="text/javascript">
  $(document).ready(function(){
    var emparray = [];

    var form = $('#generatepayslipform');
    form.on('submit', function(e){
      e.preventDefault();
      e.stopPropagation();
      var paysliptype = document.getElementById("paysliptype").value;
      var desc = document.getElementById("desc").value;
      var month = document.getElementById("month").value;
      var year = document.getElementById("year").value;
      var leavecutoff = document.getElementById("leavecutoff").value;
      var comid = document.getElementById("groupcompany").value;
      var include = document.getElementById("include").checked;
      var bonusmonth = document.getElementById("bonusmonth").value;

      $("input:checkbox[name=type]:checked").each(function(){
        emparray.push($(this).val());
      });

      if(leavecutoff == "lastday"){
        leavecutoff = new Date(year, parseFloat(month) + 1, 0).getDate();
        leavecutoff = JSON.stringify(leavecutoff);
      }

      var newarray = JSON.stringify(emparray);

      var alldata = 
      {
        paysliptype:paysliptype,
        desc:desc,
        month:month,
        year:year,
        leavecutoff:leavecutoff,
        comid:comid,
        newarray:newarray,
        include:include,
        bonusmonth:bonusmonth
      }

      console.log(alldata);
      $.ajax({
        url: "ajax-addpayroll_history.php?lang=<?php echo $extlg;?>",
        type: "POST",
        data: alldata,
        dataType: "json",
        success:function(data){
          console.log(data);
          if(data.condition === "Passed"){
            $("#payslip").modal("hide");
            console.log("testing1");
            getviewgeneratePayslip();
          }else{
            checkvalidity("paysliptypeerror","#paysliptypeerror", "#paysliptype", data.payroll_type);
            checkvalidity("montherror","#montherror", "#month", data.montherror);
            checkvalidity("arrayerror","#arrayerror", "#employeeName", data.arrayerror);
          }
        }
      }); 

      var spans = document.getElementsByTagName("span");
      for(i=0;i<spans.length;i++)
      {
        if(spans[i].innerHTML == "Required"){
          emparray = [];
        }
      }
    });

    $("#payslip").on('hidden.bs.modal', function(){
      document.getElementById("generatepayslipform").reset(); 
      clearform("paysliptypeerror", "paysliptypeerror", "#paysliptype");
      clearform("montherror", "montherror", "#month");
      clearform("arrayerror", "arrayerror", "#employeeName");
       $("#leavecutoff").html("");
      emparray = [];
    });

    $(document).on('click', "#closepayslip", function(){
      $("#payslip").modal("hide");
      getviewgeneratePayslip(); 
    });

    function getviewgeneratePayslip(){
      console.log("testing4");
      $.ajax({
        url:"ajax-getviewgeneratePayslip.php",
        success:function(data){
          $("#showpayroll_historylist").html(data);
        }
      });
    }
  });

  function checkvalidity(data1, data2, data3, data4){
    document.getElementById(data1).innerHTML = data4;
    if(data4 === "Required"){
      $(data2).removeClass("text-success").addClass("text-danger");
      $(data3).removeClass("border-success").addClass("border-danger");
    }else if(data4 === "Valid"){
      $(data2).removeClass("text-danger").addClass("text-success");
      $(data3).removeClass("border-danger").addClass("border-success");
    }else{
      $(data2).removeClass("text-success").addClass("text-danger");
      $(data3).removeClass("border-success").addClass("border-danger");
    }
  }

  function clearform(data1, data2, data3){
    $(data1).removeClass("text-success").removeClass("text-danger");
    document.getElementById(data2).textContent="";
    $(data3).removeClass("border-success").removeClass("border-danger");
  }

</script>

<div id="payslip" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Generate Payslip</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <form id="generatepayslipform">
            <div class="form-group row">
              <label for="paysliptype" class="col-sm-2 col-form-label">Payslip Type</label>
              <div class="col-sm-4">
                <select class="form-control" id="paysliptype">
                  <option style="display:none;"></option>
                  <option value="First Half">First Half</option>
                  <option value="Month End/Second Half">Month End/Second Half</option>
                  <option value="Bonus">Bonus</option>
                  <option value="Commission">Commission</option>
                  <option value="Claim">Claim</option>
                </select>
              </div>
              <div id="showbonus" style="display: none;">
                <label for="include" class="col col-form-label"><input class="control" type="checkbox" id="include"> Include fix allowance and deduction</label>
              </div>
            </div>
            <small><span id="paysliptypeerror"></span></small>
            <div class="form-group row">
              <label for="desc" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm">
                <input type="text" class="form-control" id="desc">
              </div>
            </div>
            <h5>Payroll Period<hr/></h5>
            <div class="form-group">
              <div class="form-group row">
                <label for="month" class="col-sm-2 col-form-label">Month</label>
                <div class="col-sm-4">
                  <select class="form-control col" id="month">
                    <option style="display: none;"></option>
                    <option value="0">January</option>
                    <option value="1">February</option>
                    <option value="2">March</option>
                    <option value="3">April</option>
                    <option value="4">May</option>
                    <option value="5">June</option>
                    <option value="6">July</option>
                    <option value="7">August</option>
                    <option value="8">September</option>
                    <option value="9">October</option>
                    <option value="10">November</option>
                    <option value="11">December</option>
                  </select>
                </div>
                <small><span id="montherror"></span></small>
              </div>
            


                <div class="col-2">
                  <label for="year" class="col-sm-2 col-form-label">Year</label>
              
                <select class="form-control col" id="year">
                    <option style="display: none;"></option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                  </select>
              </div>
              


              <div class="form-group row">
                <label for="leavecutoff" class="col-sm-2 col-form-label">Leave Cut Off Date</label>
                <div class="col-sm-4" id="leavecutoffoptions">
                  <select class='form-control col' id="leavecutoff">
                  </select>
                </div>
                <div class="col-2" id="showbonus1" style="display: none;">
                  <label for="bonusmonth">No. of Bonus Month</label>
                </div>
                <div class="col-sm-4" id="showbonus2" style="display: none;">
                  <input type="number" class="form-control" value="1" id="bonusmonth">
                </div>
              </div>
             

            
            <h5>Group By<hr/></h5>
              <div class="form-group">
                <select class="form-control" id="groupcompany">
                  <?php 
                  $comobject = new Company();
                  $comresult = $comobject->searchCompanyCorporate($resultresult->corporateID);
                  if($comresult){
                    foreach($comresult as $row){
                      echo "<option value='".$row->companyID."'>".$row->company."</option>";
                    }
                  }
                  ?>
                </select>
              </div>
              <input id="employeefilter" class="form-control" type="search" placeholder="Search for Employee"><br>
              <div class="dropdown">  
                <button class="btn bg-transparent btn-sm btn-inline" type="button"data-toggle="collapse" data-target="#employeeName"><i class="fa fa-caret-down fa-caret-text"></i></button>
                <input id="checkall" type="checkbox" onclick="toggle(this);"> 
                <label id="companyname"></label>
                <div><small><span id="arrayerror"></span></small></div>
                <div class="collapse" id="employeeName">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-success" type="submit">Generate</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Discard</button>
            </div>
          </form>
        </div>
      </div>
    </div> 
  </div>
</div>

<script type="text/javascript">
  $(document).on('change', '#employeeName', function() {
    $("#checkall").prop("checked", false);
  });

  $(document).ready(function(){
    $('#month').change(function(e){
      var id = document.getElementById("month").value;
      var yid = document.getElementById("year").value;

      var alldata = 
        {
          id:id,
          yid:yid
        }
        console.log(alldata);
      $.ajax({
        url:"ajax-getmonthdate.php?lang=<?php echo $extlg;?>",
        method:"POST",
        data: alldata,
        success:function(data){
          $("#leavecutoff").html(data);
      }
    });
  });
});

  $(document).ready(function(){
    $('#paysliptype').change(function(e){
      if(document.getElementById("paysliptype").value !== "Month End/Second Half"){
        console.log(document.getElementById("paysliptype").value);
        document.getElementById("leavecutoff").setAttribute("disabled", "disabled");
      }
      else{
        $('#leavecutoff').prop('disabled', false);
      }
    });
  });

  $(document).ready(function(){
    $('#paysliptype').change(function(e){
      if(document.getElementById("paysliptype").value === "Bonus"){
        document.getElementById("showbonus").style.display = "block";
        document.getElementById("showbonus1").style.display = "block";
        document.getElementById("showbonus2").style.display = "block";
      }
      else{
        document.getElementById("showbonus").style.display = "none";
        document.getElementById("showbonus1").style.display = "none";
        document.getElementById("showbonus2").style.display = "none";
      }
    });
  });

    function toggle(source) {
    var checkboxes = document.querySelectorAll('#employeeName input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i] != source)
        checkboxes[i].checked = source.checked;
    }
  }

  var input = document.getElementById("employeefilter");
  input.addEventListener("input", myFunction);

function myFunction(e) {
  var filter = e.target.value.toUpperCase();

  var list = document.getElementById("employeeName");
  var divs = list.getElementsByTagName("div");
  for (var i = 0; i < divs.length; i++) {
    var a = divs[i].getElementsByTagName("label")[0];
    
    if (a) {
      if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
        divs[i].style.display = "";
      } else {
        divs[i].style.display = "none";
      }
    }       
  }

}
    
</script>

 <!-- Delete payroll Modal -->
    <div class="modal" id="deletepayrollmodal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
          <button type="button" class="close" id="closedeletepayrollmodal" data-dismiss="modal">&times;</button>
          </div>
          <div class="col-1">
          </div>
           <div class="col-12 col-sm-10 py-4">
            <h4 class="modal-title">Delete Payroll</h4>
            <form class="mt-5" id="deletepayrollform">
             Are you sure want to delete payroll?
             <input type="hidden" id="deletepayroll_history_id">
              <div class="row">
                <div class="col text-right" id="deletepayroll">
                   <button name="submit" type="submit" class="btn btn-sm btn-danger deletepayroll">DELETE</button>
                </div>
              </div>
            </form>
          </div>
          <div class="col-1"></div>
         </div>
        </div>
        </div>
      </div>
    </div>



<!-- Script for delete payroll-->
 <script type="text/javascript">
     $(document).ready(function(){
     var form = $('#deletepayrollform');

    $(document).on('click', ".deletepayroll", function(){
      var payroll_history_id = $(this).data('id');
    $.ajax({
        url:"ajax-getpayroll_history.php?lang=<?php echo $extlg;?>",
        method:"POST",
        data:{payroll_history_id:payroll_history_id},
        dataType:"json",
        success:function(data){
        $("#deletepayroll_history_id").val(data.payroll_history_id);
        }
      });
    });

    form.on('submit', function(e){
      e.preventDefault();
      e.stopPropagation();

      var deletepayroll_history_id = document.getElementById("deletepayroll_history_id").value;
      var alldata= {
        deletepayroll_history_id:deletepayroll_history_id
      };
      console.log(alldata);
      $.ajax({
        url: "ajax-deletepayroll_history.php?lang=<?php echo $extlg;?>",
        type: "POST",
        data: alldata,
        success:function(obj){
         console.log(obj);
          if(obj.condition === "Passed"){
          $("#deletepayrollmodal").modal("hide");
          getviewdelete();  

          }
        }
      });
    });
    
    $(document).on('click', "#closedeletepayrollmodal", function(){
      $("#deletepayrollmodal").modal("hide");
      getviewdelete();
    });

    function getviewdelete(){
      $.ajax({
        url:"ajax-getviewgeneratePayslip.php", 
        success:function(data){
          $("#showpayroll_historylist").html(data);
        }
      });
    }

    function checkvalidity(data1, data2, data3, data4){
      document.getElementById(data1).innerHTML = data4;
      if(data4 === "Required"){
        $(data2).removeClass("text-success").addClass("text-danger");
        $(data3).removeClass("border-success").addClass("border-danger");
      }else if(data4 === "Valid"){
        $(data2).removeClass("text-danger").addClass("text-success");
        $(data3).removeClass("border-danger").addClass("border-success");
      }else{
        $(data2).removeClass("text-success").addClass("text-danger");
        $(data3).removeClass("border-success").addClass("border-danger");
      }
    }

    function clearform(data1, data2, data3){
      $(data1).removeClass("text-success").removeClass("text-danger");
      document.getElementById(data2).textContent="";
      $(data3).removeClass("border-success").removeClass("border-danger");
    }


    
  });  
</script>

