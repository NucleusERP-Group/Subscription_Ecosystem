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