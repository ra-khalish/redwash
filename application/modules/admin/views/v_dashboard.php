<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>

    <!-- Content Row -->
    <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
        <div class="row no-gutters align-items-center">
            <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Monthly)</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($monthly->totMonth, 0, ",", ".");?></div>
            </div>
            <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
        </div>
        </div>
    </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
        <div class="row no-gutters align-items-center">
            <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (Annual)</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($annual->totYear, 0, ",", ".");?></div>
            </div>
            <div class="col-auto">
            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
        </div>
        </div>
    </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
        <div class="row no-gutters align-items-center">
            <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">In Process</div>
            <div class="row no-gutters align-items-center">
                <div class="col-auto">
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $process->statusp?></div>
                </div>
            </div>
            </div>
            <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
        </div>
        </div>
    </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
        <div class="row no-gutters align-items-center">
            <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">In Queue</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $queue->statusq?></div>
            </div>
            <div class="col-auto">
            <i class="fas fa-tags fa-2x text-gray-300"></i>
            </div>
        </div>
        </div>
    </div>
    </div>
    </div>

    <!-- Content Row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->