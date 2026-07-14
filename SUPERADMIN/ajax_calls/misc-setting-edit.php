<?php
include '../../conection.php';
$id = $_POST['id'];

$query = mysqli_query($con, "SELECT * from config_misc_setting WHERE id='$id' ");
$val1 = mysqli_fetch_array($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">All Configuration Edit</h4>
    </div>
    <form action="tds-percentage-edit" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
              <label class="control-label" for="inputSuccess">TDS Percentage</label>
              <input class="form-control" required="" name="tds_percentage" type="text" value="<?php echo $val1[3]; ?>"  >
            </div>
            <div class="form-group">
              <label class="control-label" for="inputSuccess">Service Charges</label>
              <input class="form-control" required="" name="service_percentage" type="text" value="<?php echo $val1[4]; ?>"  >
            </div>
            <div class="form-group">
              <label class="control-label" for="inputSuccess">Bank Charges</label>
              <input class="form-control" required="" name="bank_charge" type="text" value="<?php echo $val1[5]; ?>"  >
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" value="Save Changes">
        </div>
    </form>
</div>
</body>
</html>