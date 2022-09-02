
                <!-- Page content-->
                <div class="container-fluid">
                    <h1 class="mt-4">Welcome, <?= $user['fullname']; ?></h1>
                    <!-- Card -->
						<div class="card mb-3" style="max-width: 540px;">
							<div class="row no-gutters">
								<div class="col-md-4">
								<img src="<?= base_url('assets/profile/') . $user['image']; ?>" height="120">
								</div>
								<div class="col-md-8">
								<div class="card-body">
									<h5 class="card-title"><?= $user['fullname']; ?></h5>
									<p class="card-text"><?= $user['email']; ?></p>
									<p class="card-text"><small class="text-muted">Bergabung pada <?= date('d M Y', $user['date_created']); ?></small></p>
								</div>
								</div>
							</div>
						</div>
					<!-- End of Card -->
                </div>
           