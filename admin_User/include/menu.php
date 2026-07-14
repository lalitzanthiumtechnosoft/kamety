<?php require_once 'include/header.php'; ?>
<nav id="sidebar">
    <div class="sidebar-header">
        <img src="./assets/images/namelogo.png" class="img-fluid ">
    </div>
    <ul class="list-unstyled components">
        <li>
            <a href="index.php" class="main"><i class="fas fa-layer-group"></i> Dashboard</a>
        </li>
        <li>
            <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                    class="fa fa-user"></i> My Profile</a>
            <ul class="collapse list-unstyled" id="pageSubmenu2">
                <li><a href="userProfileAuth">My Profile</a></li>
                <li><a href="changePassword">Change Login Password</a></li>

            </ul>
        </li>
        <li>
            <a href="#pageSubmenu4" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                    class="fas fa-money-bill"></i> Fund Manager</a>
            <ul class="collapse list-unstyled" id="pageSubmenu4">
                <li><a href="fundRequest">Add Fund</a></li>
            </ul>
        </li>

        <li>
            <a href="#pageSubmenu0" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                    class="fa fa-cog"></i>Activation</a>
            <ul class="collapse list-unstyled" id="pageSubmenu0">

                <li><a href="authActiveUser">Activation</a></li>

            </ul>
        </li>

        <?php if ($topupFlag == 1) {?>
        <li>
            <a href="addMember" class="main"><i class="fa fa-cog"></i>Add Member</a>
        </li>
        <?php } ?>


        <li>
            <a href="#pageSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                    class="fas fa-sitemap"></i> Team and Network</a>
            <ul class="collapse list-unstyled" id="pageSubmenu3">
                <li><a href="myReferral">Refferal Team</a></li>
            </ul>
        </li>


        <li>
            <a href="#pageSubmenu7" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                    class="fas fa-dollar-sign"></i>Financial Report</a>
            <ul class="collapse list-unstyled" id="pageSubmenu7">

                <li><a href="referralIncome">Direct Income</a></li>


            </ul>
        </li>

        <li>
            <a href="#pageSubmenu9" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                    class="fas fa-ticket-alt"></i> Customer Support</a>
            <ul class="collapse list-unstyled" id="pageSubmenu9">
                <li><a href="support">Support Ticket</a></li>
                <li><a href="supportList">Ticket Status</a></li>
            </ul>
        </li>
        <li><a href="authSignDash"><i class="fa fa-sign-out-alt"></i> Logout</a></li>
    </ul>
</nav>


<script type="text/javascript">
$(document).ready(function() {
    $('#sidebarCollapse').on('click', function() {
        $('#sidebar').toggleClass('active');
    });
});
</script>
<script>
function myFunction() {
    var copyText = document.getElementById("myInput");
    copyText.select();
    document.execCommand("copy");
    alert("Copied the text: " + copyText.value);
}
</script>

<!-- Add only once in page -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    if ($.fn.DataTable.isDataTable('#example')) {
        $('#example').DataTable().clear().destroy();
    }

    $('#example').DataTable({
        "pageLength": 10,
        "lengthMenu": [5, 10, 25, 50, 100],
        "order": [],
    });
});
</script>

</script>