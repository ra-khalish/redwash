<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
  <div class="sidebar-brand-icon rotate-n-15">
    <i class="fab fa-rockrms"></i>
  </div>
  <div class="sidebar-brand-text mx-3">Redwash</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item <?= ($this->uri->uri_string() == 'admin') ? 'active' : '' ?>">
  <a class="nav-link" href="index.html">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Main
</div>

<li class="nav-item <?= ($title == 'Motorcycle Queue') ? 'active' :'' ?>">
  <a class="nav-link pb-0" href="<?= base_url('admin/mcqueue');?>">
    <i class="fas fa-fw fa-motorcycle"></i>
    <span>Queue Motorcycle</span></a>
</li>
<li class="nav-item <?= ($title == 'Booking') ? 'active' :'' ?>">
  <a class="nav-link pb-0" href="<?= base_url('admin/csbooking');?>">
    <i class="fas fa-fw fa-bookmark"></i>
    <span>Booking</span></a>
</li>
<li class="nav-item <?= ($title == 'Transaction') ? 'active' :'' ?>">
  <a class="nav-link" href="<?= base_url('admin/transaction');?>">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Transaction</span></a>
</li>

  <?php if($this->session->userdata('status')=='admin'):?>
  <!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Report & Data
</div>

<!-- Nav Item - Charts -->
<li class="nav-item">
  <a class="nav-link pb-0" href="charts.html">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>Users Data</span></a>
</li>

<li class="nav-item">
  <a class="nav-link pb-0" href="charts.html">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>Charts</span></a>
</li>

<!-- Nav Item - Tables -->
<li class="nav-item">
  <a class="nav-link" href="tables.html">
    <i class="fas fa-fw fa-table"></i>
    <span>Tables</span></a>
</li>
<?php endif;?>

<?php if($this->session->userdata('status')=='user'):?>
<!-- Divider -->
<hr class="sidebar-divider">
  
  <!-- Heading -->
  <div class="sidebar-heading">
    User Settings
  </div>
  
  <!-- Nav Item - Charts -->
  <li class="nav-item <?= ($this->uri->segment(2)=='userProfile')?'active':''?>">
    <a class="nav-link pb-0" href="<?= base_url('user/userProfile')?>">
      <i class="fas fa-fw fa-address-card"></i>
      <span>My Profile</span></a>
  </li>
  
  <li class="nav-item <?= ($this->uri->segment(2)=='userEdit')?'active':''?>">
    <a class="nav-link pb-0" href="<?= base_url('user/userEdit')?>">
      <i class="fas fa-fw fa-user-edit"></i>
      <span>Edit Profile</span></a>
  </li>
  
  <!-- Nav Item - Tables -->
  <li class="nav-item <?= ($this->uri->segment(2)=='userCPass')?'active':''?>">
    <a class="nav-link" href="<?= base_url('user/userCPass')?>">
      <i class="fas fa-fw fa-key"></i>
      <span>Change Password</span></a>
  </li>
  <?php endif;?>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->