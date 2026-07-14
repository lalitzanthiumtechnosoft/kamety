   <?php require_once 'include/head.php'; ?>

<body>
    <div class="wrapper">
<?php
require_once 'loginCheck.php';
require_once 'include/header.php';
require_once 'include/menu.php';
?>
<div id="content">
<?php
require_once 'include/nav.php';
?>

		<div class="main-box">
		<div class="BankDetails">
			<h4>Help Desk</h4>
			<div class="box">
							 <form action="supportProcess" enctype="multipart/form-data" method="POST" role="form">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel"  style="color:#000;">Create a new ticket</h4>
                       
                        </div>
                        <div class="modal-body">
                          <div class="form-horizontal">
                            <div class="form-group">
                              <label class="col-md-12">Subject</label>
                              <div class="col-md-12">
                                <select class="form-control" required id="subjectId" name="subjectId">
                                  <option value=""> Select One </option>
                                  <?php $querySubject = mysqli_query($con, 'SELECT subjectId,subjectName FROM config_support_subject WHERE subjectStatus=1');
while ($valSubject = mysqli_fetch_assoc($querySubject)) { ?>
                                    <option value="<?php echo $valSubject['subjectId']; ?>"> <?php echo $valSubject['subjectName']; ?> </option>
                                  <?php } ?>
                                </select>
                                <input type="hidden" name="memberId" value="<?php echo $memberId; ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-12">Priority</label>
                              <div class="col-md-12">
                                <select class="form-control" required id="priorityId" name="priorityId">
                                  <option value=""> Select One </option>
                                  <?php $queryPriority = mysqli_query($con, 'SELECT priorityId,priorityName FROM config_support_priority WHERE priorityStatus=1');
while ($valPriority = mysqli_fetch_assoc($queryPriority)) { ?>
                                    <option value="<?php echo $valPriority['priorityId']; ?>"> <?php echo $valPriority['priorityName']; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-12">Message</label>
                              <div class="col-md-12">
                                <textarea class="form-control" cols="20" data-val="true" data-val-required="Message is Required" id="ticketMessage" name="ticketMessage" placeholder="Enter Message" rows="2"></textarea>
                                <span class="field-validation-valid" data-valmsg-for="msg" data-valmsg-replace="true"></span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success" name="supportTicket"><i class="fa fa-info"></i> Submit</button>
                          <button type="button" class="btn btn-default float-right" data-dismiss="modal">Cancel</button>
                        </div>
                      </div>
                    </form>
			</div>
		</div>
	</div>

		</div>
	</div>

<?php
require_once 'include/footer.php'; ?>

</body>
</html>
