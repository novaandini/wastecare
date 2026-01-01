<?php
$data = Message::getData();
$name = '';
$email = '';
$password = '';
$address = '';
$phone_number = '';
if ($data || $user) {
  $name = $data['name'] ?? $user['name'];
  $email = $data['email'] ?? $user['email'];
  $address = $data['address'] ?? $user['address'];
  $phone_number = $data['phone_number'] ?? $user['phone_number'];
}
Message::flash();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1><?= $title ?></h1>
				</div>
			</div>
		</div><!-- /.container-fluid -->
  	</section>

  <!-- Main content -->
  	<form action="<?php echo $user ? BASEURL.'/manage_users/'.$role.'/update/'.$id : BASEURL.'/manage_users/'.$role.'/store' ?>" method="POST" enctype="multipart/form-data">
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title text-capitalize">Daftar Akun <?= $role ?> Baru</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
								<div class="row">
									<div class="col-sm-12">
									<!-- text input -->
										<div class="form-group">
											<label for="name">Nama</label>
											<input name="name" type="text" class="form-control" placeholder="Enter ..." value="<?= $name ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
									<!-- text input -->
										<div class="form-group">
											<label for="email">Email</label>
											<input name="email" type="email" class="form-control" placeholder="Enter ..." value="<?= $email ?>" <?= $user ? 'disabled' : '' ?>>
										</div>
									</div>
									<div class="col-sm-6">
									<!-- text input -->
										<div class="form-group">
											<label for="password">Password</label>
											<input name="password" type="password" class="form-control" placeholder="Ganti password ..." value="<?= $password ?>">
											<small>Note: Silahkan lengkapi untuk mengganti password</small>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
									<!-- text input -->
										<div class="form-group">
											<label for="phone_number">Nomor Telepon</label>
											<input name="phone_number" type="text" class="form-control" placeholder="Enter ..." value="<?= $phone_number ?>">
										</div>
									</div>
									<div class="col-sm-6">
									<!-- text input -->
										<div class="form-group">
											<label for="address">Alamat Lengkap</label>
											<input name="address" type="text" class="form-control" placeholder="Enter ..." value="<?= $address ?>">
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</form>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->