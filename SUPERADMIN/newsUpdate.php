<!DOCTYPE html>
<html lang="en">
<?php include 'login-check.php'; ?>
<?php include 'include/head.php';
include 'include/menu.php';
include 'include/header.php'; ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
       <div class="iq-card">
          <div class="iq-card-header d-flex justify-content-between">
             <div class="iq-header-title">
                <h4 class="card-title">Member News</h4>
             </div>
            <a data-id="ThisID" data-toggle="modal" data-target="#addNews" href="javascript:void(0)" class="btn btn-success btn_bg float-right" >Add News</a>
          </div>
          <div class="iq-card-body">
             <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                   <thead>
                      <tr>
                        <th>#</th>                    
                        <th>Title</th>
                        <th>News</th>
                        <th>Add Date</th>
                        <th>Action</th>
                      </tr>
                   </thead>
                   <tbody>
                      <?php
                  $count = 0;
$queryNews = mysqli_query($con, 'SELECT * from config_news_list WHERE status=1 ORDER BY addDate DESC');
while ($valNews = mysqli_fetch_assoc($queryNews)) {
    ++$count;
    ?>
                      <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $valNews['title']; ?></td>
                        <td><?php echo $valNews['news']; ?></td>
                        <td><i class="fa fa-clock"></i> <?php echo $valNews['addDate']; ?></td>
                        <td><a href="javascript:void(0)" class="btn btn-danger btn-xs" onclick="deleteNews(<?php echo $valNews['news_id']; ?>)">Delete</a></td>
                      </tr>
                    <?php } ?>  
                   </tbody>
                </table>
             </div>
          </div>
       </div>
    </div>
  </div>
</div>
<?php
  if (isset($_POST['addNews'])) {
      $title = $_POST['title'];
      $news = $_POST['news'];
      date_default_timezone_set('Asia/Kolkata');
      $d = date('Y-m-d H:i:s');
      $queryIn = "INSERT INTO config_news_list (`title`,`news`,`addDate`,`status`) VALUES('$title','$news','$d',1)";
      $resIn = mysqli_query($con, $queryIn);
      if ($resIn) { ?>
      <script>
        alert('News Added Successfully!!!');
        window.top.location.href='newsUpdate';
      </script>
      <?php } else { ?>
        <script>
          alert('News Not Added???? \n Plz Try after Sometime???...');
          window.top.location.href='newsUpdate';
      </script>
  <?php }
      } ?>
<!-- Modal For Add Latest News -->
<div class="modal fade" id="addNews">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add News :  </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <form method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label" for="title">Title</label>
            <input class="form-control" type="text" name="title" placeholder="e.g John Adem" required >
          </div>
          <div class="form-group">
            <label class="control-label" for="news">News</label>
            <textarea class="form-control" type="text" name="news" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in venenatis enim" required ></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" name="addNews" class="btn btn-success" value="Submit">
          <input type="reset" class="btn btn-danger" value="Reset">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php include 'include/footer.php'; ?>
<script>
function deleteNews(newsId){
  if(newsId!=""){
    if(confirm('Are you sure to Delete this News?')){
      $.ajax({
        type: "POST",
        url: 'ajax_calls/deleteNews',
        data: { newsId:newsId },
        cache: false,
        success: function(data){
          // alert(data);
          if(data){
            alert('News Deleted Successfully');
            location.reload();
          }
        }
      });
    }
  }
}
var d = document.getElementById("setting");
    d.className += " active";
var d = document.getElementById("newsUpdate");
    d.className += " active";
</script>
</body>
</html>