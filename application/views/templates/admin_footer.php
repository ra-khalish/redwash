<!-- Footer -->
<footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; RedWash <?= date('Y');?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?= base_url('logout');?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url('assets/');?>js/jquery-3.3.1.js"></script>
  <!--<script src="<?= base_url('assets/');?>vendor/jquery/jquery.min.js"></script>-->
  <script src="<?= base_url('assets/');?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url('assets/');?>vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url('assets/');?>js/sb-admin-2.min.js"></script>
  <script src="<?= base_url('assets/');?>js/script.js"></script>

  <!-- Page level plugins -->
  <script src="<?= base_url('assets/');?>js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="<?= base_url('assets/');?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <script>
  $(document).ready(function(){
        // Setup datatables
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
      {
          return {
              "iStart": oSettings._iDisplayStart,
              "iEnd": oSettings.fnDisplayEnd(),
              "iLength": oSettings._iDisplayLength,
              "iTotal": oSettings.fnRecordsTotal(),
              "iFilteredTotal": oSettings.fnRecordsDisplay(),
              "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
              "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
          };
      };

      var table = $("#tswashing").dataTable({
          initComplete: function() {
              var api = this.api();
              $('#tswashing_filter input')
                  .off('.DT')
                  .on('input.DT', function() {
                      api.search(this.value).draw();
              });
          },
              oLanguage: {
              sProcessing: "loading..."
          },
              processing: true,
              serverSide: true,
              ajax: {"url": "<?php echo base_url().'admin/get_transaction'?>", "type": "POST"},
                    columns: [
                        {"data": "nm_consumer"},
                        {"data": "contact"},
                        {"data": "code_booking"},
                        {"data": "noplat"},
                        //render number format for price
                        {"data": "tot_cost", render: $.fn.dataTable.render.number(',', '.', '')},
                        {"data": "status"},
                        {"data": "ctime"},
                        {"data": "view"}
                  ],
                order: [[2, 'desc']],
          rowCallback: function(row, data, iDisplayIndex) {
              var info = this.fnPagingInfo();
              var page = info.iPage;
              var length = info.iLength;
              $('td:eq(0)', row).html();
          }

      });
            // end setup datatables

            // get Edit Records
            $('#tswashing').on('click','.edit_record',function(){
              var booking = $(this).data('booking');
              var noplat  = $(this).data('noplat');
              var status  = $(this).data('status');
            $('#ModalUpdate').modal('show');
              $('[name="code_booking"]').val(booking);
              $('[name="noplat"]').val(noplat);
              $('[name="status"]').val(status);
            });
            // End Edit Records

            // get delete Records
            $('#tswashing').on('click','.delete_record',function(){
            var booking = $(this).data('booking');
            $('#ModalDelete').modal('show');
            $('[name="code_booking"]').val(booking);
            });
            // End delete Records
    });
	// $(document).ready(function() {
	// 	$('#tswashing').DataTable({
  //     "processing": true,
  //     "serverSide": true,
	// 		"ajax": {
  //       "url": "<?=base_url('admin/get_transaction')?>",
  //       "type": "POST"
  //     },
  //     "order": [[2, "desc" ]],
  //     "columns": [
  //           { "output": "nm_consumer" },
  //           { "output": "contact" },
  //           { "output": "code_booking" },
  //           { "output": "noplat" },
  //           { "output": "tot_cost" },
  //           { "output": "status" },
  //           { "output": "cashier" },
  //           { "output": "ctime" }
  //       ]
	// 	});
	// });
</script>
</body>

</html>
