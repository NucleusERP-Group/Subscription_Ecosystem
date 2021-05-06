<!-- Dashboard Core Js -->
<script src="../public/assets/js/purpose.core.js"></script>
<!-- Purpose JS -->
<script src="../public/assets/js/purpose.js"></script>
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