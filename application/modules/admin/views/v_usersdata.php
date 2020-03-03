        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800"><?= $title;?></h1>

          <?= $this->session->flashdata('alert');?>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Users Admin</h6>
            </div>
            <div class="card-body">
              <div class="table">
                <table class="table table-bordered table-responsive" id="mngwashing" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th width="15%">Code Booking</th>
                      <th width="25%">Consumer Name</th>
                      <th>Consumer Phone Number</th>
                      <th>Plat Number</th>
                      <th width="10%">Status</th>
                      <th width="15%">Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th width="15%">Code Booking</th>
                      <th width="25%">Consumer Name</th>
                      <th>Consumer Phone Number</th>
                      <th>Plat Number</th>
                      <th width="10%">Status</th>
                      <th width="15%">Action</th>
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