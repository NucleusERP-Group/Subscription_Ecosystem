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
<!-- Search Data In Data Tables -->
<script>
    function search() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("SearchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("DataTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }


    /* Sort Data Table */
    function sortTable() {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("DataTable");
        switching = true;
        /* Make a loop that will continue until
        no switching has been done: */
        while (switching) {
            // Start by saying: no switching is done:
            switching = false;
            rows = table.rows;
            /* Loop through all table rows (except the
            first, which contains table headers): */
            for (i = 1; i < (rows.length - 1); i++) {
                // Start by saying there should be no switching:
                shouldSwitch = false;
                /* Get the two elements you want to compare,
                one from current row and one from the next: */
                x = rows[i].getElementsByTagName("TD")[0];
                y = rows[i + 1].getElementsByTagName("TD")[0];
                // Check if the two rows should switch place:
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
                /* If a switch has been marked, make the switch
                and mark that a switch has been done: */
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }
    
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