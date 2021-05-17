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
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
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
    /* Initiate Reports Data Tables */
    $(document).ready(function() {
        $('.ReportsDataTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
    /* Load Summer Note */
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 150, //set editable area's height

        });
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