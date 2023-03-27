<footer class="footer">
            <div class="row g-0 justify-content-between fs--1 mt-4 mb-3">
              <div class="col-12 col-sm-auto text-center">
                <p class="mb-0 text-600">Thank you for creating with Falcon <span class="d-none d-sm-inline-block">| </span><br class="d-sm-none" /> 2021 &copy; <a href="#">I - SECURITY</a></p>
              </div>
              <div class="col-12 col-sm-auto text-center">
                <p class="mb-0 text-600">v3.4.0</p>
              </div>
            </div>
          </footer>
        </div>
      </div>
    </main>
    
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->   
   
</body>
 <script src="<?= base_url('assets/js/web_js/')?>anchor.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<script src="<?= base_url('assets/js/web_js/')?>theme.js"></script>
<!-- END OF FOTTER -->
  <script>
      $(function() {
          $(document).ready(function() {
              $("#table_id").DataTable({
                  responsive: true,
              });
          });
      })
  </script>
</html>