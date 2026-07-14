<!DOCTYPE html>
<html lang="en">
<?php include("login-check.php");?>
<?php include('include/head.php');
      include('include/menu.php'); 
      include('include/header.php'); ?>
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-6 col-lg-6">
         <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
               <div class="iq-header-title">
                  <h4 class="card-title">Free Activation</h4>
               </div>
            </div>
            <div class="iq-card-body">
               <form class="text-center" method="POST" action="freeInvestmentProcess" onsubmit="return confirm('Are you sure?')" >
                  <fieldset>
                     <div class="form-card text-left">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label>User ID -:</label>
                                 <input type="text" name="sponser_id" id="sponser_id" class="form-control" placeholder="e.g. xxxxxxxxxx" onblur="sponser_valid(this.value)" required >
                                 <input type="hidden" name="loginMemberId" value="<?=$member_id?>">
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label>Name -: </label>
                                 <input type="text" id="sponser_name" class="form-control" placeholder="e.g. John Doe"  disabled="" >
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label>Amount To Invest -:</label>
                                 <input type="text" id="amount" name="amount" class="form-control" placeholder="e.g. Invest Amount" onkeypress="return onlynum(event)" required >
                              </div>
                           </div>
                        </div>
                     </div>
                     <button type="submit" name="investNow" class="btn btn-primary action-button float-left" value="Submit" >Invest Now</button>
                  </fieldset>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include('include/footer.php'); ?>
<script>
function sponser_valid(sponser_id){
   document.getElementById("sponser_name").value="";
    if(!sponser_id==""){
        if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else{// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function(){
            if(xmlhttp.readyState==4 && xmlhttp.status==200){
                var v=xmlhttp.responseText;
                if(v.trim()!=""){
                    document.getElementById("sponser_name").value=v.trim();
                }
                else{
                    alert("Invalid User ID");
                    document.getElementById("sponser_id").value="";
                }
            }
        }
        xmlhttp.open("GET","ajax_calls/get_sponser_name?sponser_id="+sponser_id,true);
        xmlhttp.send();
    }
}
var d = document.getElementById("member");
    d.className += " active";
var d = document.getElementById("freeInvestment");
    d.className += " active";
</script>
</body>
</html>