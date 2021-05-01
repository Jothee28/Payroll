<script type="text/javascript">
  $(document).ready(function(){
  var form = $('#addcommisionform');
  form.on('submit', function(e){
    e.preventDefault();
    e.stopPropagation();
    var commisioncode = document.getElementById("commisioncodem").value;
    var commisiondesc = document.getElementById("commisiondescm").value;

    var alldata = 
    {
      commisioncode:commisioncode,
      commisiondesc:commisiondesc,
    }

   console.log(alldata);
    $.ajax({
      url: "ajax-addcommision.php?lang=<?php echo $extlg;?>",
      type: "POST",
      data: alldata,
      dataType: "json",
      success:function(data){
        console.log(data);
        if(data.condition === "Passed"){
          $("#commisionmodal").modal("hide");
          console.log("testing1");
          getviewcommision(); 
        }else{
          checkvalidity("commisioncodeerror","#commisioncodeerror", "#commisioncodem", data.commision_code);
          checkvalidity("commisiondescerror","#commisiondescerror", "#commisiondescm", data.commisionDesc);
        }
      }
    });
  });

  $("#commisionmodal").on('hidden.bs.modal', function(){
    document.getElementById("addcommisionform").reset(); 
    clearform("commisioncodeerror","commisioncodeerror", "#commisioncodem");
    clearform("commisiondescerror","commisiondescerror", "#commisiondescm");
  });

  $(document).on('click', "#closecommisionmodal", function(){
    $("#commisionmodal").modal("hide");
    getviewcommision(); 
  });

  function getviewcommision(){ 
    console.log("testing");
    $.ajax({
      url:"ajax-getviewcommision.php", 
      success:function(data){
         console.log("testing");
        $("#showcommisionlist").html(data);
      }
    });
  }
});
</script>

<div id="commisionmodal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Create New Commision</h4>
        <button type="button" id="closecommisionmodal" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <form id="addcommisionform">
            <div class="form-group row">
              <label for="commisioncodeerror" class="col-sm-2 col-form-label">Code</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="commisioncodem">
                <small><span id="commisioncodeerror"></span></small>
              </div>
            </div>
            <div class="form-group row">
              <label for="commisiondescm" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm">
                <input type="text" class="form-control" id="commisiondescm">
                <small><span id="commisiondescerror"></span></small>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Discard</button>
        </div>
      </form>
    </div>
  </div>
</div> 

<script type="text/javascript">
  $(document).ready(function(){
    
    $(document).on('click', ".editcommision", function(){
      var commision_id = $(this).data('id');
      console.log(commision_id);
      $.ajax({
        url:"ajax-getcommision.php?lang=<?php echo $extlg;?>",
        method:"POST",
        data:{commision_id:commision_id},
        dataType:"json",
        success:function(data){
          console.log(data);
          $("#editcommisionid").val(data.commision_id);
          $("#editcommisioncode").val(data.commision_code);
          $("#editcommisionDesc").val(data.commisionDesc);
        }
        });
    });

      var form = $('#editcommisionform');
      form.on('submit', function(e){
      e.preventDefault();
      e.stopPropagation();
      var editcommisionid = document.getElementById("editcommisionid").value;
      var editcommisioncode = document.getElementById("editcommisioncode").value;
      var editcommisionDesc = document.getElementById("editcommisionDesc").value;

      var alldata = 
      {
      	editcommisionid:editcommisionid,
        editcommisioncode:editcommisioncode,
        editcommisionDesc:editcommisionDesc
      }
      console.log(alldata);
      $.ajax({
        url: "ajax-editcommision.php?lang=<?php echo $extlg;?>",
        type: "POST",
        data: alldata,
        dataType:"json",
        success:function(data){
          console.log(data);
          if(data.condition === "Passed"){
            $("#editcommisionmodal").modal("hide");
            getvieweditcommision();
          }else{
            checkvalidity("editcommisioncodeerror","#editcommisioncodeerror", "#editcommisioncode", data.commision_code);
            checkvalidity("editcommisiondescerror","#editcommisiondescerror", "#editcommisionDesc", data.commisionDesc);
          }
        }
      });
    });

    $(document).on('click', "#closeeditcommisionmodal", function(){
      $("#editcommisionmodal").modal("hide");
       clearform("editcommisioncodeerror", "editcommisioncodeerror", "#editcommisioncode");
      clearform("editcommisiondescerror", "editcommisiondescerror", "#editcommisionDesc");
      getvieweditcommision();
    });

    $("#editcommisionmodal").on('hidden.bs.modal', function(){
        clearform("editcommisioncodeerror", "editcommisioncodeerror", "#editcommisioncode");
        clearform("editcommisiondescerror", "editcommisiondescerror", "#editcommisionDesc");
      });

    function getvieweditcommision(){ 
      console.log("testing");
      $.ajax({
        url:"ajax-getviewcommision.php", 
        success:function(data){
           console.log("testing");
          $("#showcommisionlist").html(data);
        }
      });
    }

    
  });  
</script>
<!--modal for edit button-->
<div id="editcommisionmodal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Commision</h4>
        <button type="button" id="closeeditcommisionmodal" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <form id="editcommisionform">
            <div class="form-group row">
              <input type="hidden" id="editcommisionid">
              <label for="editcommisioncode" class="col-sm-2 col-form-label">Code</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="editcommisioncode">
                <small><span id="editcommisioncodeerror"></span></small>
              </div>
            </div>
            <div class="form-group row">
              <label for="editcommisionDesc" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm">
                <input type="text" class="form-control" id="editcommisionDesc">
                <small><span id="editcommisiondescerror"></span></small>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" value="submit" class="btn btn-primary">Save</button>
            <button id="closeeditcommisionmodal" type="button" class="btn btn-danger" data-dismiss="modal">Discard</button>
        </div>
      </form>
    </div>
  </div>
</div> 

<script type="text/javascript">
  $(document).ready(function(){
    var form = $('#deletecommisionform');

    $(document).on('click', ".deletecommision", function(){
      var commision_id = $(this).data('id');
      $.ajax({
        url:"ajax-getcommision.php?lang=<?php echo $extlg;?>",
        method:"POST",
        data:{commision_id:commision_id},
        dataType:"json",
        success:function(data){
          $("#deletecommisionid").val(data.commision_id);
        }
      });
    });

    form.on('submit', function(e){
      e.preventDefault();
      e.stopPropagation();
      var deletecommisionid = document.getElementById("deletecommisionid").value;

      var alldata =
      {
      	deletecommisionid:deletecommisionid
      }

      console.log(alldata);
      $.ajax({
        url: "ajax-deletecommision.php?lang=<?php echo $extlg;?>",
        type: "POST",
        data: alldata,
        success:function(data){
          var obj = JSON.parse(data);
          if(obj.condition === "Passed"){
          $("#deletecommisionmodal").modal("hide");
          getviewdeletecommision();  
          }
        }
      });
    });
    
    $(document).on('click', "#closedeletecommisionmodal", function(){
      $("#deletecommisionmodal").modal("hide");
      getviewdeletecommision();
    });

    function getviewdeletecommision(){
      console.log("testing4");
      $.ajax({
        url:"ajax-getviewcommision.php", 
        success:function(data){
           console.log("testing");
          $("#showcommisionlist").html(data);
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

    window.onload = function clearform(data1, data2, data3){
      $(data1).removeClass("text-success").removeClass("text-danger");
      document.getElementById(data2).textContent="";
      $(data3).removeClass("border-success").removeClass("border-danger");
    }
  });  
</script>

<div id="deletecommisionmodal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Delete Commision</h4>
        <button type="button" id="closedeletecommisionmodal" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <form id="deletecommisionform">
          	<input type="hidden" id="deletecommisionid">
          	Are you sure you want to delete the commision?
          	<div class="modal-footer">
		        <button type="submit" value="submit" class="btn btn-primary">Yes</button>
		        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
		    </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>



