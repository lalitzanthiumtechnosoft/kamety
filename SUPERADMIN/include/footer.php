<!-- Footer -->

 <footer class="bg-white iq-footer" style="margin-top: auto">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6">
        <ul class="list-inline mb-0">
          <li class="list-inline-item"><a href="javascript:void(0)">Privacy Policy</a></li>
          <li class="list-inline-item"><a href="javascript:void(0)">Terms of Use</a></li>
        </ul>
      </div>
      <div class="col-lg-6 text-right">
        Copyright <?php echo date('Y'); ?> <a href="https://futurevison.world/">Digital Kamety </a> All Rights Reserved.
      </div>
    </div>
  </div>
</footer>
<!-- Footer END -->
   </div>
</div>
<!-- Wrapper END -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<!-- Appear JavaScript -->
<script src="../assets/js/jquery.appear.js"></script>
<!-- Countdown JavaScript -->
<script src="../assets/js/countdown.min.js"></script>
<!-- Counterup JavaScript -->
<script src="../assets/js/waypoints.min.js"></script>
<script src="../assets/js/jquery.counterup.min.js"></script>
<!-- Wow JavaScript -->
<script src="../assets/js/wow.min.js"></script>
<!-- Apexcharts JavaScript -->
<script src="../assets/js/apexcharts.js"></script>
<!-- Slick JavaScript -->
<script src="../assets/js/slick.min.js"></script>
<!-- Select2 JavaScript -->
<script src="../assets/js/select2.min.js"></script>
<!-- Owl Carousel JavaScript -->
<script src="../assets/js/owl.carousel.min.js"></script>
<!-- Magnific Popup JavaScript -->
<script src="../assets/js/jquery.magnific-popup.min.js"></script>
<!-- Smooth Scrollbar JavaScript -->
<script src="../assets/js/smooth-scrollbar.js"></script>
<!-- lottie JavaScript -->
<script src="../assets/js/lottie.js"></script>
<!-- am core JavaScript -->
<script src="../assets/js/core.js"></script>
<!-- am charts JavaScript -->
<script src="../assets/js/charts.js"></script>
<!-- am animated JavaScript -->
<script src="../assets/js/animated.js"></script>
<!-- am kelly JavaScript -->
<script src="../assets/js/kelly.js"></script>
<!-- Flatpicker Js -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- Chart Custom JavaScript -->
<script src="../assets/js/chart-custom.js"></script>
<!-- Custom JavaScript -->
<script src="../assets/js/custom.js"></script>
<!-- Datatables-->
<script src="../assets/js/DataTable/js/jquery.dataTables.min.js"></script>
<script src="../assets/js/DataTable/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/js/DataTable/js/dataTables.buttons.min.js"></script>
<script src="../assets/js/DataTable/js/buttons.bootstrap4.min.js"></script>
<script src="../assets/js/DataTable/js/jszip.min.js"></script>
<script src="../assets/js/DataTable/js/pdfmake.min.js"></script>
<script src="../assets/js/DataTable/js/vfs_fonts.js"></script>
<script src="../assets/js/DataTable/js/buttons.html5.min.js"></script>
<script src="../assets/js/DataTable/js/buttons.print.min.js"></script>
<script src="../assets/js/DataTable/js/buttons.bootstrap.js"></script>
<!-- DATETIMEPICKER-->
<script src="../assets/datepicker/bootstrap-datepicker.min.js"></script>
<script src="../assets/sweetalert/dist/sweetalert.min.js"></script>
<script>
$('#from_date').datepicker({
  format: 'dd-mm-yyyy'
})
$('#to_date').datepicker({
  format: 'dd-mm-yyyy'
})
$(document).ready(function() {
    var table = $('#example').DataTable({
        lengthChange: false,
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );
</script>