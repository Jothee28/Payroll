
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Kanban Board</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<body>
  
<style>
/* Style the tab */
.tab 
{
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
    margin-left : 10px;
    margin-right : 10px;
}

/* Style the buttons inside the tab */
.tab button 
{
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}

tr:hover{
    cursor: pointer;
    background-color: #ccc;
}

div.one 
{
    border: 1px;
    border-style: solid;
    border-color: black;
    margin: 25px 50px;
    background-color: white;
}
div.button
{
    margin: 25px 50px;
    text-align: right; 
}
div.two 
{
    border: 10px;
    margin: 25px 50px;
    background-color: white;
}
div.tax 
{
    margin: 10px 10px;
    background-color: white;
}
</style>
</head>

<body>
<form action="kanbanBoard.php" method="post">
    <br><br>
    <h2 style="text-align:center"><b><u>KANBAN BOARD</u></b></h2>
    
    <br>

    <div class="container mt-3">
  
  <div class="input-group mb-3">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    <div class="input-group-prepend">
      <button type="button"   id="btnaddTask"   class="btn btn-success btn-sm ml-3">Add New</button>  
    </div> 
    <input type="text"  id="addplan" placeholder="Add Task Here!!!">

     <div class="input-group-prepend">
      <button <a href="#" data-toggle="modal" data-target="#add-new-task-modal" id="search" class="btn btn-primary btn-sm ml-3">Search</a></button>  
    </div> 
    <br>

    <br>
    <input type="text"  id="SeachTask" placeholder="Search Task Here!!!">
</div>
  </div>
</div>

 

<div class="container-fluid border p-1" style="border-color: Black ">

  <div class=" card-columns" style="column-span: 15px; grid-column-start:left 15px">
    
    <div class="col-12 col-lg-4">




      <div class="card bg-warning">
        <div class="card-header bg-light">
          <h3 class="card-title h5 mb-1">TO-DO LIST</h3>
         </div>
        <div class="card-body">
          <div class="tasks" id="to-do-list">
            <tr>
            <td>Plan</td>
          </tr>
         
         </div>
        </div>
      </div>

      
      <div class="card bg-primary">
        <div class="card-header bg-light">
          <h3 class="card-title h5 mb-1">IN PROGRESS</h3>
         </div>
        <div class="card-body" >
          <div class="tasks" id="inprogress">
         </div>
        </div>
      </div>
 

      <div class="card bg-success">
        <div class="card-header bg-light">
          <h3 class="card-title h5 mb-1">DONE</h3>
         </div>
        <div class="card-body">
          <div class="tasks" id="done">
         </div>
        </div>
      </div>


 
 <script type="text/javascript">
 $(document).ready(function() {
  
});

   
    $('#btnaddTask').click(function()
    {
         
        var plan  =  document.getElementById("addplan").value;
       
       
        var alldata= {
          
          addplan:plan
          
      };

       console.log(alldata);
        $.ajax({
        url:"ajax-addplan.php",
        type: "POST",
        data: alldata,
        dataType:"json",
        success:function(obj){
         console.log(obj);
          if(obj.condition === "Passed"){
         
          }else{
              checkvalidity("addplanerror","#addplanerror", "#addplan", obj.plan);
   
          } }
    }); 
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
    //search text box for plan
    $("#SeachTask").on("keyup", function() 
    {
        var value = $(this).val().toLowerCase();
        $("#showplanlist tr").filter(function() 
        {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
  </script>


</div>
</form>
</body>
   
   




   