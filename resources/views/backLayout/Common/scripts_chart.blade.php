<!-- jQuery 3 -->
<script src="{{ asset('/assets/vendor/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('/assets/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('/assets/js/adminlte.min.js') }}"></script>
<!-- Funcoes compartilhadas -->
<script src="{{ asset('/assets/js/geral.js') }}"></script>

<script src="{{ asset('/assets/js/relatorios_chart.js') }}"></script>

<script src="{{ asset('/assets/js/jquery.highchartTable.js') }}"></script>
<script src="{{ asset('/assets/js/highcharts.src.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('/assets/vendor/chart.js/Chart.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('/assets/vendor/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ asset('/assets/vendor/jqueryMask/jquery.mask.min.js') }}"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree();
    $('table.highchart').highchartTable();
  });
</script>