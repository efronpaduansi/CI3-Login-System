
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6 order-md-2">
          <img src="<?= base_url('assets/') ?>images/undraw_file_sync_ot38.svg" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3>Sign Up to <strong>CI3 App</strong></h3>
            </div>
            <form action="<?= base_url('/auth/register'); ?>" method="post">
              <div class="form-group first">
                <label for="fullname">Fullname</label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="<?= set_value('fullname'); ?>" autofocus>
								<?= form_error('fullname', '<small class="text-danger">', '</small>'); ?>
              </div>
              <div class="form-group first">
                <label for="email">Email Address</label>
                <input type="text" class="form-control" id="email" name="email" value="<?= set_value('email'); ?>">
									<?= form_error('email', '<small class="text-danger">', '</small>'); ?>
              </div>
              <div class="form-group last mb-4">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
								<?= form_error('password', '<small class="text-danger">', '</small>'); ?>
              </div>
              <div class="form-group last mb-4">
                <label for="passconf">Konfirmasi Password</label>
                <input type="password" class="form-control" id="passconf" name="passconf">
								<?= form_error('passconf', '<small class="text-danger">', '</small>'); ?>
              </div>
              <input type="submit" value="Sign Up" name="register" class="btn text-white btn-block btn-primary">
							<br>
							<p>Already have an account? <a href="<?= base_url('/auth') ?>">Sign In</a></p>
            </form>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>

  
