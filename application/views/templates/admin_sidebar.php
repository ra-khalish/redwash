<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
  <div class="sidebar-brand-icon rotate-n-15">
    <i class="fab fa-rockrms"></i>
  </div>
  <div class="sidebar-brand-text mx-3">Redwash</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item <?= ($this->uri->uri_string() == 'admin') ? 'active' : '' ?>">
  <a class="nav-link" href="<?= base_url('admin');?>">
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
  <a class="nav-link pb-0" href="<?= base_url('admin/fmbooking');?>">
    <i class="fas fa-fw fa-bookmark"></i>
    <span>Booking</span></a>
</li>
<li class="nav-item <?= ($title == 'Order Management') ? 'active' :'' ?>">
  <a class="nav-link" href="<?= base_url('admin/mngbooking');?>">
    <i class="fas fa-fw fa-clipboard"></i>
    <span>Order Management</span></a>
</li>

  <!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Report & Data
</div>

<!-- Nav Item - Charts -->
<li class="nav-item <?= ($title == 'Order Archive') ? 'active' :'' ?>">
  <a class="nav-link pb-0" href="<?= base_url('admin/order_arc');?>">
    <i class="fas fa-fw fa-archive "></i>
    <span>Data Archive</span></a>
</li>

<li class="nav-item <?= ($title == 'Data Report') ? 'active' :'' ?>">
  <a class="nav-link pb-0" href="<?= base_url('admin/data_report');?>">
    <i class="fas fa-fw fa-print"></i>
    <span>Data Report</span></a>
</li>

<!-- Nav Item - Tables -->

<li class="nav-item <?= ($title == 'Employee Management') ? 'active' :'' ?>">
  <a class="nav-link" href="<?= base_url('admin/users_emply');?>">
    <i class="fas fa-fw fa-users"></i>
    <span>Employee</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">
  
  <!-- Heading -->
  <div class="sidebar-heading">
  Settings
  </div>
  
  <!-- Nav Item - Charts -->
  <li class="nav-item <?= ($title == 'My Profile')?'active':''?>">
    <a class="nav-link pb-3" href="<?= base_url('admin/userProfile')?>">
      <i class="fas fa-fw fa-address-card"></i>
      <span>My Profile</span></a>
  </li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->