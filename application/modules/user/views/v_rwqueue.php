    <section id="queue">
      <div class="container">
      <?= $this->session->flashdata('alert');?>
        <div class="row block">
          <div class="col-lg-9">
            <ul class="breadcrumb">
              <li class="breadcrumb-item">Queue</li>
            </ul>
            <h1><?= $title;?></h1>
        </div>
    </div>
    
    <a class="lead btn btn-primary mb-3" href="<?= base_url('user/fbooking');?>" role="button"><i class="fas fa-plus-circle"></i>Booking</></a>
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
              <?php $no='#';?>
              <?php foreach ($queue as $key => $q): ?>
                <tr>
                  <th scope="row"><?= $q['code_booking']?></th>
                  <td><?= $q['noplat'];?></td>
                </tr>
              <?php $no++;?>
              <?php endforeach;?>
              </tbody>
            </table>
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
              <?php $no='#';?>
              <?php foreach (array_slice($processed,0,2) as $key => $p): ?>
                <tr>
                  <th scope="row"><?= $p['code_booking']?></th>
                  <td><?= $p['noplat'];?></td>
                </tr>
              <?php $no++;?>
              <?php endforeach;?>
              </tbody>
            </table>
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
              <?php $no='#';?>
              <?php foreach ($completed as $key => $c): ?>
                <tr>
                  <th scope="row"><?= $c['code_booking']?></th>
                  <td><?= $c['noplat'];?></td>
                </tr>
              <?php $no++;?>
              <?php endforeach;?>
              </tbody>
            </table>
            </div>
          </div>
        </div>
        </div>
      </div>
    </section>