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
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
<!-- High Charts CDNS -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/variable-pie.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<!-- Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<!-- Search Data In Data Tables -->
<!-- Load Charts Analytics -->
<?php require_once('chart_analytics.php'); ?>
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
        $('#ReportsDataTable').DataTable({
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

    /* Subsciprions Per Package Settings */
    var pieColors = (function() {
        var colors = [],
            base = Highcharts.getOptions().colors[0],
            i;

        for (i = 0; i < 10; i += 1) {
            // Start out with a darkened base color (negative brighten), and end
            // up with a much brighter color
            colors.push(Highcharts.color(base).brighten((i - 3) / 7).get());
        }
        return colors;
    }());

    /* Subscriptions Per Package Chart */
    Highcharts.chart('Subscriptions_Per_Package', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Percentage Subscriptions Per Package'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                colors: pieColors,
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                    distance: -50,
                    filter: {
                        property: 'percentage',
                        operator: '>',
                        value: 4
                    }
                }
            }
        },
        series: [{
            name: 'Subscriptions',
            data: [{
                    name: 'Community Version',
                    y: <?php echo $community_version; ?>
                },
                {
                    name: 'Enterprise Version',
                    y: <?php echo $enterprise_version; ?>
                }
            ]
        }]
    });
</script>
<!-- Alert Js -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<?php if (isset($success)) { ?>
    <!--This code for injecting success alert-->
    <script>
        alertify.success('<?php echo $success; ?>');
    </script>

<?php } ?>

<?php if (isset($err)) { ?>
    <!--This code for injecting error alert-->
    <script>
        alertify.error('<?php echo $err; ?>');
    </script>

<?php } ?>

<?php if (isset($info)) { ?>
    <!--This code for injecting info alert-->
    <script>
        alertify.warning('<?php echo $info; ?>');
    </script>

<?php }
?>