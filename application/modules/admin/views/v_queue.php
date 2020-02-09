<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>

<?= $this->session->flashdata('msg');?>

<div class="card-deck">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">In Queue</h5>
      <table class="table">
      <thead class="table-info">
        <tr>
          <th scope="col">#</th>
          <th scope="col">No Plat</th>
        </tr>
      </thead>
      <tbody>
      <?php $no=1;?>
      <?php foreach ($queue as $key => $q): ?>
        <tr>
          <th scope="row"><?= $no;?></th>
          <td><?= $q['noplat'];?></td>
        </tr>
      <?php $no++;?>
      <?php endforeach;?>
      </tbody>
    </table>
    </div>
    <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Processed</h5>
      <table class="table">
      <thead class="table-warning">
        <tr>
          <th scope="col">#</th>
          <th scope="col">No Plat</th>
        </tr>
      </thead>
      <tbody>
      <?php $no=1;?>
      <?php foreach ($processed as $key => $p): ?>
        <tr>
          <th scope="row"><?= $no;?></th>
          <td><?= $p['noplat'];?></td>
        </tr>
      <?php $no++;?>
      <?php endforeach;?>
      </tbody>
    </table>
    </div>
    <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Completed</h5>
      <table class="table">
      <thead class="table-success">
        <tr>
          <th scope="col">#</th>
          <th scope="col">No Plat</th>
        </tr>
      </thead>
      <tbody>
      <?php $no=1;?>
      <?php foreach ($completed as $key => $c): ?>
        <tr>
          <th scope="row"><?= $no;?></th>
          <td><?= $c['noplat'];?></td>
        </tr>
      <?php $no++;?>
      <?php endforeach;?>
      </tbody>
    </table>
    </div>
    <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->