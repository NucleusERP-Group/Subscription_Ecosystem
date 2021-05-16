<!-- Dashboard Core Js -->
<script src="../public/assets/js/purpose.core.js"></script>
<!-- Purpose JS -->
<script src="../public/assets/js/purpose.js"></script>
<!-- Progress Bar -->
<script src="../public/assets/libs/progressbar.js/dist/progressbar.min.js"></script>
<!-- Apex Charts Js -->
<script src="../public/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
<!-- Moment Js -->
<script src="../public/assets/libs/moment/min/moment.min.js"></script>
<!-- Full Calendar Js -->
<script src="../public/assets/libs/fullcalendar/dist/fullcalendar.min.js"></script>
<!-- Flatpickr -->
<script src="../public/assets/libs/flatpickr/dist/flatpickr.min.js"></script>
<!-- Select2 -->
<script src="../public/assets/libs/select2/dist/js/select2.min.js"></script>
<!-- Tag Input -->
<script src="../public/assets/libs/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<!-- Dashboard Data Table JS -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<!-- Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<!-- Search Data In Data Tables -->
<script>
    
    /* Print Contents In Div */
    function printContent(el) {
        var restorepage = $('body').html();
        var printcontent = $('#' + el).clone();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
    }
    /* Initiate Data Table */
    $(document).ready(function() {
        $('#AdminDashboardDataTables').DataTable();
    });
    /* Load Summer Note */
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>
<!-- Swal Js -->
<script src="../public/js/swal.js"></script>
<!-- Init Swal Js -->
<?php if (isset($success)) { ?>
    <!--This code for injecting success alert-->
    <script>
        setTimeout(function() {
                swal("Success", "<?php echo $success; ?>", "success");
            },
            100);
    </script>

<?php } ?>

<?php if (isset($err)) { ?>
    <!--This code for injecting error alert-->
    <script>
        setTimeout(function() {
                swal("Failed", "<?php echo $err; ?>", "error");
            },
            100);
    </script>

<?php } ?>

<?php if (isset($info)) { ?>
    <!--This code for injecting info alert-->
    <script>
        setTimeout(function() {
                swal("Success", "<?php echo $info; ?>", "warning");
            },
            100);
    </script>

<?php }
?>