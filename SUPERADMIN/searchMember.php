<!DOCTYPE html>
<html lang="en">
<?php include("login-check.php");?>
<?php include('include/head.php');
      include('include/menu.php'); 
      include('include/header.php'); ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12 ">
      <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
        </div>
        <div class="iq-card-body">
           <form method="POST">
              <div class="form-row">
                <div class="col-3">
                  <input type="text" id="search_value" class="form-control" placeholder="Search Value" id="search_value" name="user_id" onkeypress="return catchEnter(event)">
                </div>
                <div class="col-3">
                  <button type="button" class="btn btn-primary btn-lg m-l-15 waves-effect" onclick="mySearch()" id="SubmitSearch" > Search </button>
                </div>
              </div>
           </form>
        </div>
      </div>
    </div>
    <div id="show" style="overflow-x: auto; width: 100%;"></div>
  </div>
</div>
<?php include('include/footer.php'); ?>
<script>
function catchEnter(event){
  // alert(e);
  if(event.which == 13 || event.keyCode == 13){
    $("#SubmitSearch").trigger('click');
    // alert('enter is pressed');
  }
}
function mySearch() {
var search_value = $('#search_value').val();
    // alert(search_value);
    $.ajax({
      url:"ajax_calls/search-all-ajax",        
      data: { search_value: search_value },
      success:function(result){    
              
        $("#show").html(result); /* THE RETURNED DATA WILL BE SHOWN IN THIS DIV */     
    }
  });
};
function memberDashboard(userId,password,memberId){
   var url='../User/setSessionAdvice?userId='+userId+'&mID='+password+'&codeGenerate='+memberId;
   window.open(url,'_blank');
}; 
var d = document.getElementById("member");
    d.className += " active";
var d = document.getElementById("searchMember");
    d.className += " active";
</script>
</body>
</html>