    <section id="queue">
      <div class="container">
        <div class="row block">
          <div class="col-lg-9">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url('user/queue');?>">Queue</a></li>
              <li class="breadcrumb-item">Booking Form</li>
            </ul>
            <h1>Booking Form</h1>
          </div>
        </div>
        <a class="lead btn btn-primary mb-2" href="<?= base_url('user/queue');?>" role="button"><i class="fas fa-arrow-circle-left"></i>Back</></a>
        <!-- Begin Page Content -->
        <!-- Basic Card Example -->
        <div class="card-body">
        <div class="card mx-auto" style="max-width: 640px;">
        <div class="card-body">
        <h5><span class="badge badge-info float-right"><?= $codebooking?></span></h5>
        <h5 class="card-title">Booking Form</h5>
        <h6 class="card-subtitle text-muted">Fill input form for booking</h6>
        <hr class="sidebar-divider pb-1">

        <form action="<?= base_url('user/fbooking');?>" id="bookform" method="POST">
          <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Name <span class="text-danger">*</span></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nm_consumer" name="nm_consumer" value="<?= $user['user_name'];?>" readonly>
              <?= form_error('nm_consumer'); ?>
            </div>
            <div>
              <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?= $user['user_id'];?>" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="contact" class="col-sm-2 col-form-label">Phone <span class="text-danger">*</span></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="contact" name="contact" value="<?= $user['user_contact'];?>" readonly>
              <?= form_error('contact'); ?>
            </div>
          </div>
          <div class="form-group row">
              <input type="hidden" class="form-control" id="code_booking" name="code_booking" value="<?= $codebooking?>" readonly>
          </div>
          <div class="form-group row">
            <label for="noplat" class="col-sm-2 col-form-label">No Plat <span class="text-danger">*</span></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="noplat" name="noplat" value="<?= set_value('noplat');?>" onkeyup="this.value = this.value.toUpperCase();" maxlength="9" required>
              <?= form_error('noplat'); ?>
            </div>
          </div>
          <div class="form-group row">
            <label for="typemotor" class="col-sm-2 col-form-label">Type <span class="text-danger">*</span></label>
            <div class="col-sm-10">
            <select class="form-control" name="typemotor" id="typemotor" required>
              <option value="">Choose</option>
              <?php foreach ($typemc as $key => $tm): ?>
              <option value="<?= $tm->price?>"><?= $tm->motor_type;?></option>
              <?php endforeach?>
            </select>
            <?= form_error('typemotor'); ?>
            </div>
          </div>
          <div class="form-group row">
            <label for="total" class="col-sm-2 col-form-label">Total Amount :</label>
            <div class="col-sm-10">
              <input type="text" readonly class="form-control-plaintext form-control-lg" id="tot_cost" name="tot_cost" value="0" required>
            </div>
          </div>
          <hr class="sidebar-divider pb-3">
          <div class="form-group row">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary float-left">Submit</button>
            </div>
          </div>
        </form>

        </div>
        </div>
        </div>

        
      </div>
    </section>