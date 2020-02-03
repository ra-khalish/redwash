<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>

<!-- Basic Card Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Booking Form</h6>
  </div>
    <div class="card-body">
    <div class="card mx-auto" style="max-width: 640px;">
    <div class="card-body">
    <h5 class="card-title">Booking Form</h5>
    <h6 class="card-subtitle text-muted">Fill input form for booking</h6>
    <hr class="sidebar-divider pb-3">

    <form>
  <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="name" value="<?= $user['user_name']?>" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label for="pnumber" class="col-sm-2 col-form-label">Phone Number</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="pnumber">
    </div>
  </div>
  <div class="form-group row">
    <label for="noplat" class="col-sm-2 col-form-label">No Plat</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="noplat">
    </div>
  </div>
  <div class="form-group row">
    <label for="typemotor" class="col-sm-2 col-form-label">Type</label>
    <div class="col-sm-10">
    <select class="form-control" id="typemotor">
      <option>Motor Bebek</option>
      <option>Motor Naked</option>
      <option>Motor Scooter</option>
      <option>Motor Sport(Max 300cc)</option>
      <option>Motor Super Sport</option>
    </select>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">Checkbox</div>
    <div class="col-sm-10">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="gridCheck1">
        <label class="form-check-label" for="gridCheck1">
          Example checkbox
        </label>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary float-left">Sign in</button>
    </div>
  </div>
</form>

    </div>
    </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->