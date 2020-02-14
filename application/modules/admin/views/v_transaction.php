        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800"><?= $title;?></h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Transaction</h6>
            </div>
            <div class="card-body">
              <div class="table">
                <table class="table table-bordered" id="tswashing" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Position</th>
                      <th>Office</th>
                      <th>Age</th>
                      <th>Start date</th>
                      <th>Salary</th>
                      <th>Salary</th>
                      <th>Salary</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Position</th>
                      <th>Office</th>
                      <th>Age</th>
                      <th>Start date</th>
                      <th>Salary</th>
                      <th>Salary</th>
                      <th>Salary</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

<!-- Modal Update Status-->
<form id="add-row-form" action="<?php echo site_url('admin/update_transaction');?>" method="post">
<div class="modal fade" id="ModalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Update status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="code_booking" class="col-form-label">Code Booking:</label>
            <input type="text" name="code_booking" class="form-control" placeholder="Code Booking" readonly>
          </div>
          <div class="form-group">
            <label for="noplat" class="col-form-label">Plat Number:</label>
            <input type="text" name="noplat" class="form-control" placeholder="Plat Number" readonly>
          </div>
          <div class="form-group">
            <label for="status" class="col-form-label">Status:</label>
            <select name="status" class="form-control" required>
              <?php foreach ($chstatus as $key => $cs): ?>
              <option value="<?= $cs?>"><?= $cs;?></option>
              <?php endforeach?>
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Update</button>
      </div>
    </div>
  </div>
</div>
</form>

<!-- Modal Delete Transaction-->
<form id="add-row-form" action="<?php echo site_url('admin/delete_transaction');?>" method="post">
<div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Delete transaction</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="code_booking" class="form-control" required>
          <strong>Are you sure to delete this record?</strong>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-success">Yes</button>
      </div>
    </div>
  </div>
</div>
</form>