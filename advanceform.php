<!-- Advance Table-->
    <div id="advance" class="tabcontent table-responsive" style="display: none">
        <div style="float:left;padding:15px">
            <input type="text" id="advanceSearch" placeholder="Search">    
            <select id="advanceCheckData">
                <option value="">All</option>
            </select>   
        </div>
        <div style="float:right;padding:15px">
            <button class="btn" style="background-color:#00A8E6;color:white;" id="btnOpenadvanceModal" type="button">Add New</button>
        </div>
       <div id="showadvancelist"></div>
    </div>
    <!-- Advance Modal -->
    <div class="modal fade" id="addadvanceModal" role="dialog">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Advance</h4>
                 <modal class="" id="addadvance">
            </div>
            <div class="modal-body">
              <form id="addadvanceform">
                <label>Payroll Type </label>
                <br>
                <select id="addadvance_payrolltype" style="width:80%" >
                      <option value="">--</option>
                     <option value="First Half"> First Half</option>
                     <option value="Second Half/ Month End"> Second Half/ Month End</option>
                      <option value="Commission"> Commission</option>
                       <option value="Bonus"> Bonus</option>
                        <small><span id="addadvance_payrolltypeerror"></span></small>
                   </select>
                    
                <br><br>
                <label>Amount</label>
                <br>
                <input type="text" id="addadvance_amount" style="width:80%">
                 <small><span id="addadvance_amounterror"></span></small>
                <br><br>
                <label>Date</label>
                <br>
                <input type="date" id="addadvance_date" style="width:80%">
                 <small><span id="addadvance_dateerror"></span></small>
                <br><br>
                <label>Note</label>
                <br>
                <input type="text" id="addadvance_note" style="width:80%">
                <br>
                 <small><span class="text-secondary"><i><?php echo $array['optional']?></i></span></small>
                <br><br>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnAddModaladvance" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Discard</button>
            </div>
          </form>
        </div>
        </div>
    </div>

<script type="text/javascript">
    $(document).ready(function() {
    getviewadvanceEmployee();
});

   $('#btnOpenadvanceModal').click(function() 
    {
        $('#addadvanceModal').modal('show');
     });
    $('#btnAddModaladvance').click(function()
    {
        var advance_id = document.getElementById("addadvance_id").value;
        var advance_payrolltype = document.getElementById("addadvance_payrolltype").value;
        var advance_amount  =  document.getElementById("addadvance_amount").value;
        var advance_date  =  document.getElementById("addadvance_date").value;
        var advance_note  =  document.getElementById("addadvance_note").value;
        var emp_id  =  document.getElementById("emp_name").value;
       
        var alldata= {
          addadvance_id:advance_id,
          addadvance_payrolltype:advance_payrolltype,
          addadvance_amount:advance_amount,
          addadvance_date:advance_date,
          addadvance_note:advance_note,
          addemp_id:emp_id
      };

       console.log(alldata);
        $.ajax({
        url: "ajax-addadvance.php?lang=<?php echo $extlg;?>",
         type: "POST",
        data: alldata,
        dataType:"json",
       success:function(obj){
         console.log(obj);
          if(obj.condition === "Passed"){
            $("#addadvanceModal").modal("hide");
         getviewadvanceEmployee(); 
          }else{
checkvalidity("addadvance_payrolltypeerror","#addadvance_payrolltypeerror", "#addadvance_payrolltype", obj.advance_payrolltype);
  checkvalidity("addadvance_amounterror","#addadvance_amounterror", "#addadvance_amount", obj.advance_amount);
    checkvalidity("addadvance_dateerror","#addadvance_dateerror", "#addadvance_date", obj.advance_date);
   
   
          } }
    }); 
     });
      $("#addadvanceModal").on('hidden.bs.modal', function(){
    document.getElementById("addadvanceform").reset(); 
    clearform("addadvance_payrolltypeerror","#addadvance_payrolltypeerror", "#addadvance_payrolltype");
    clearform("addadvance_amounterror","#addadvance_amounterror", "#addadvance_amount");
    clearform("addadvance_dateerror","#addadvance_dateerror", "#addadvance_date");
  });

  $(document).on('click', "#closeaddadvanceModal", function(){
    $("#addadvanceModal").modal("hide");
    getviewadvanceemployee(); 
  });

  $('#emp_name').change(function () {
  getviewadvanceEmployee();
                });
  
  function getviewadvanceEmployee(){ 
    
    var emp_name = document.getElementById("emp_name").value;
    $.ajax({
      url:"ajax-getviewadvanceemployee.php",
      type:"POST",
      data:{userID:emp_name},
      success:function(data){
         
        $("#showadvancelist").html(data);
        
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
      
</script>
<!-- Modal for Edit Advance -->
<div class="modal fade" id="editadvancemodal" role="dialog">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Advance</h4>
                 <modal class="" id="editadvance">
            </div>
            <div class="modal-body">
              <form id="editadvanceform">
                <label>Payroll Type </label>
                <br>
                <select id="editadvance_payrolltype" style="width:80%" >
                      <option value="">--</option>
                     <option value="First Half"> First Half</option>
                     <option value="Second Half/ Month End"> Second Half/ Month End</option>
                      <option value="Commission"> Commission</option>
                       <option value="Bonus"> Bonus</option>
                        <small><span id="editadvance_payrolltypeerror"></span></small>
                   </select>
                    
                <br><br>
                <label>Amount</label>
                <br>
                <input type="text" id="editadvance_amount" style="width:80%">
                 <small><span id="editadvance_amounterror"></span></small>
                <br><br>
                <label>Date</label>
                <br>
                <input type="date" id="editadvance_date" style="width:80%">
                 <small><span id="editadvance_dateerror"></span></small>
                <br><br>
                <label>Note</label>
                <br>
                <input type="text" id="editadvance_note" style="width:80%">
                <br>
                 <small><span class="text-secondary"><i><?php echo $array['optional']?></i></span></small>
                <br><br>
            </div>
            <div class="modal-footer">
                <button type="submit" value="submit" class="btn btn-success">Edit</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Discard</button>
            </div>
          </form>
        </div>
        </div>
    </div>





<!-- Script for edit Advance -->
<script type="text/javascript">
  $(document).ready(function(){

    $(document).on('click',".editadvance", function(){
      var advance_id = $(this).data('id');
     console.log(advance_id);
       $.ajax({
        url:"ajax-getadvance.php?lang=<?php echo $extlg;?>",
        method:"POST",
        data:{advance_id:advance_id},
        dataType:"json",
        success:function(data){
          console.log(data);
          $("#editadvance_id").val(data.advance_id);
          $("#editadvance_payrolltype").val(data.advance_payrolltype);
          $("#editadvance_date").val(data.advance_date);
          $("#editadvance_amount").val(data.advance_amount);
          $("#editadvance_note").val(data.advance_note);
         
        }
        });
    });

     var form = $('#editadvanceform');
     form.on('submit', function(e){
      e.preventDefault();
      e.stopPropagation();

        var advance_id = document.getElementById("editadvance_id").value;
        var advance_payrolltype = document.getElementById("editadvance_payrolltype").value;
        var advance_amount  =  document.getElementById("editadvance_amount").value;
        var advance_date  =  document.getElementById("editadvance_date").value;
        var advance_note  =  document.getElementById("editadvance_note").value;
        var emp_id  =  document.getElementById("emp_name").value;
       
        var alldata= {
          editadvance_id:advance_id,
          editadvance_payrolltype:advance_payrolltype,
          editadvance_amount:advance_amount,
          editadvance_date:advance_date,
          editadvance_note:advance_note,
          editemp_id:emp_id
      };
      console.log(alldata);
         $.ajax({
        url: "ajax-editadvance.php?lang=<?php echo $extlg;?>",
        type: "POST",
        data: alldata,
        dataType:"json",
        success:function(data){
        console.log(data);
          if(data.condition === "Passed"){
            $("#editadvancemodal").modal("hide");
         getviewadvanceemployee(); 
          }else{
    checkvalidity("editadvance_payrolltypeerror","#editadvance_payrolltypeerror", "#editadvance_payrolltype", data.advance_payrolltype);
  checkvalidity("editadvance_amounterror","#editadvance_amounterror", "#editadvance_amount", data.advance_amount);
    checkvalidity("editadvance_dateerror","#editadvance_dateerror", "#editadvance_date", data.advance_date);
   
   } }

       })
     });

  });

   $("#editadvancemodal").on('hidden.bs.modal', function(){
    document.getElementById("editadvanceform").reset(); 
     clearform("editadvance_payrolltypeerror","#editadvance_payrolltypeerror", "#editadvance_payrolltype");
    clearform("editadvance_amounterror","#editadvance_amounterror", "#editadvance_amount");
    clearform("editadvance_dateerror","#editadvance_dateerror", "#editadvance_date");
  });


  $(document).on('click', "#closeeditadvancemodal", function(){
    $("#editadvancemodal").modal("hide");
    getvieweditadvanceemployee(); 
  });

  $('#emp_name').change(function () {
  getvieweditadvanceemployee();
  });
  
  function getvieweditadvanceemployee(){ 
     var emp_name = document.getElementById("emp_name").value;
    $.ajax({
      url:"ajax-getviewadvanceemployee.php",
      type:"POST",
      data:{userID:emp_name},
      success:function(data){
      
      $("#showadvancelist").html(data);
      
      }
    });
  }
  
     function clearform(data1, data2, data3){
      $(data1).removeClass("text-success").removeClass("text-danger");
      document.getElementById(data2).textContent="";
      $(data3).removeClass("border-success").removeClass("border-danger");
    }
</script>

<!-- Delete Modal for Advance -->
  <div class="modal" id="deleteadvancemodal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
          <button type="button" class="close" id="closedeleteadvancemodal" data-dismiss="modal">&times;</button>
          </div>
          <div class="col-1"></div>
           <div class="col-12 col-sm-10 py-4">
            <h4 class="modal-title">Delete Advance</h4> 
            <form class="mt-5" id="deleteadvanceform">
             Are you sure want to delete Advance?
             <input type="hidden" id="deleteadvance_id">
              <div class="row">
                <div class="col text-right" id="deleteadvance">
                   <button type="submit" value="submit" class="btn btn-danger">DELETE</button>
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

<!-- Script for Delete Advance -->

  <script type="text/javascript">
     $(document).ready(function(){
     var form = $('#deleteadvanceform');

    $(document).on('click', ".deleteadvance", function(){
      var advance_id = $(this).data('id');
      $.ajax({
        url:"ajax-getadvance.php?lang=<?php echo $extlg;?>",
        method:"POST",
        data:{advance_id:advance_id},
        dataType:"json",
        success:function(data){
          $("#deleteadvance_id").val(data.advance_id);
        }
      });
    });

    form.on('submit', function(e){
      e.preventDefault();
      e.stopPropagation();

      var deleteadvance_id = document.getElementById("deleteadvance_id").value;
      var alldata= {
        deleteadvance_id:deleteadvance_id
      };
      console.log(alldata);
      $.ajax({
        url: "ajax-deleteadvance.php?lang=<?php echo $extlg;?>",
        type: "POST",
        data: alldata,
        success:function(data){
          console.log(data);
          if(data.condition === "Passed"){
          $("#deleteadvancemodal").modal("hide");
          getviewdelete();  

          }
        }
      });
    });
    
    $(document).on('click', "#closedeleteadvancemodal", function(){
      $("#deleteadvancemodal").modal("hide");
      getviewdelete();
    });
     function getviewdelete(){
      $.ajax({
        url:"ajax-getviewadvanceemployee.php", 
        success:function(data){
          $("#showallowancelist").html(data);
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