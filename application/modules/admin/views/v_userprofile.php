<!-- Begin Page Content -->
<div class="container-fluid">
    
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title;?></h1>
    
    <?= $this->session->flashdata('alert');?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Profile Data</h6>
        </div>
        <div class="card-body">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profileedit-tab" data-toggle="tab" href="#profileedit" role="tab" aria-controls="profileedit" aria-selected="false">Edit Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false">Change Password</a>
            </li>
            </ul>

            <div class="tab-content">
            <div class="tab-pane active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <table class="table table-striped">
                    <tr>
                        <td width="220px"><span class="gt">Email</span></td>
                        <td width="20px"><span class="gt">:</span></td>
                        <td><span class="gt"><?= $user['user_email'] ?></span></td>
                    </tr>
                    <tr>
                        <td width="220px"><span class="gt">Username</span></td>
                        <td width="20px"><span class="gt">:</span></td>
                        <td><span class="gt"><?= $user['user_username'] ?></span></td>
                    </tr>
                    <tr>
                        <td width="220px"><span class="gt">Name</span></td>
                        <td width="20px"><span class="gt">:</span></td>
                        <td><span class="gt"><?= $user['user_name'] ?></span></td>
                    </tr>
                    <tr>
                        <td width="220px"><span class="gt">Contact</span></td>
                        <td width="20px"><span class="gt">:</span></td>
                        <td><span class="gt"><?= $user['user_contact'] ?></span></td>
                    </tr>
                </table>
            </div>
            <div class="tab-pane" id="profileedit" role="tabpanel" aria-labelledby="profileedit-tab">
                <form action="<?= base_url('admin/editProfile') ?>" method="post" accept-charset="utf-8">
                <div class="form-row my-4">
                    <div class="col-md-6 mb-2">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?= $user['user_email']?>" readonly>
                    </div>
                    <div class="col-md-6 mb-2">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= $user['user_username'];?>" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $user['user_name'];?>">
                    <?= form_error('name');?>
                    </div>
                    <div class="col-md-6 mb-3">
                    <label for="contact">Contact</label>
                    <input type="text" class="form-control" id="contact" name="contact" value="<?= $user['user_contact'];?>">
                    <?= form_error('contact');?>
                    </div>
                </div>
                <button class="btn btn-primary btn-submit" type="submit">Submit form</button>
                </form>
            </div>
            <div class="tab-pane" id="password" role="tabpanel" aria-labelledby="password-tab">
                <form action="<?= base_url('admin/editPassword'); ?>" method="post">
                <div class="form-group my-4">
                    <label for="current_password">Password</label>
                    <input type="password" class="form-control" id="current_password" name="current_password">
                    <?= form_error('current_password');?>
                </div>
                <div class="form-group">
                    <label for="new_password">Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password">
                    <?= form_error('new_password');?>
                </div>
                <div class="form-group">
                    <label for="new_conpassword">Password</label>
                    <input type="password" class="form-control" id="new_conpassword" name="new_conpassword">
                    <?= form_error('new_conpassword');?>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            </div>


        </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
