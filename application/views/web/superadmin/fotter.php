</body>


<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<!-- END OF FOTTER -->
<script>
  $(document).ready(function() {
    $("#table_id").DataTable({
      responsive: true,
    });

    $(".preloader").fadeOut();

    $("#table_id2").DataTable({
      responsive: true,
    });

    $("#table_id3").DataTable({
      responsive: true,
    });
    $("#table_id4").DataTable({
      responsive: true,
    });
  });
</script>

</html>