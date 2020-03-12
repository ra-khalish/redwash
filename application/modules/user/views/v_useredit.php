<section id="queue">
    <div class="container">
    <?= $this->session->flashdata('alert');?>
        <div class="row block">
        <div class="col-lg-9">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('user/queue');?>">Queue</a></li>
                <li class="breadcrumb-item"><?= $user['user_name'];?></li>
                <li class="breadcrumb-item">Profile</li>
            </ul>
            <h1>Profile</h1>
        </div>
        </div>

        <a class="lead btn btn-primary mb-3" href="<?= base_url('user/queue');?>" role="button"><i class="fas fa-arrow-circle-left"></i>Queue Page</></a>
            <ul class="nav nav-tabs" id="userTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profileedit-tab" data-toggle="tab" href="#profileedit" role="tab" aria-controls="profileedit" aria-selected="false">Edit Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="chpassword-tab" data-toggle="tab" href="#chpassword" role="tab" aria-controls="chpassword" aria-selected="false">Change Password</a>
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
            <?php echo form_open('user/editProfile', array("id" => "form-profile", "class" => "form-horizontal")) ?>
                <div class="form-row my-4">
                    <div class="form-group col-md-6 mb-2">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?= $user['user_email'];?>" readonly>
                    </div>
                    <div class="form-group col-md-6 mb-2">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= $user['user_username'];?>" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $user['user_name'];?>">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                    <label for="contact">Contact</label>
                    <input type="text" class="form-control" id="contact" name="contact" value="<?= $user['user_contact'];?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="12">
                    </div>
                </div>
                <button class="form-group btn btn-primary btn-submit" type="submit">Submit form</button>
            </form>
            </div>
            <div class="tab-pane" id="chpassword" role="tabpanel" aria-labelledby="chpassword-tab">
            <?php echo form_open('user/editPass', array("id" => "form-chpass", "class" => "form-horizontal")) ?>
                <div class="form-group my-4">
                    <label for="current_password">Password</label>
                    <input type="password" class="form-control" id="current_password" name="current_password">
                </div>
                <div class="form-group">
                    <label for="new_password">Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password">
                </div>
                <div class="form-group">
                    <label for="new_conpassword">Password</label>
                    <input type="password" class="form-control" id="new_conpassword" name="new_conpassword">
                </div>
                <button type="submit" class="form-group btn btn-primary">Submit</button>
                </form>
            </div>
            </div>

    </div>
</section>