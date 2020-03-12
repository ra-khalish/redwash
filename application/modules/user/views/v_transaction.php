<section id="queue">
    <div class="container">
    <?= $this->session->flashdata('alert');?>
        <div class="row block">
        <div class="col-lg-9">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url('user/queue');?>">Queue</a></li>
              <li class="breadcrumb-item"><?= $user['user_name'];?></li>
              <li class="breadcrumb-item">Transaction</li>
            </ul>
            <h1>Transaction</h1>
        </div>
        </div>
    
    <a class="lead btn btn-primary mb-3" href="<?= base_url('user/queue');?>" role="button"><i class="fas fa-arrow-circle-left"></i>Queue Page</></a>
    <table class="table table-hover table-responsive table-sm" id="tsc-user" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th scope="col">Code Booking</th>
          <th scope="col">No Plat</th>
          <th scope="col">Pay</th>
          <th scope="col">Total</th>
          <th scope="col">Change</th>
          <th scope="col">Start</th>
          <th scope="col">End</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>

        
    </div>
</section>

<!-- Modal Delete Transaction-->
<form id="delete-row-form" action="<?php echo site_url('user/deleteTransaction');?>" method="post">
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