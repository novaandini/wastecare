<?php
// var_dump($service_package); die;
$data = Message::getData();
$package_name = '';
$duration_type = '';
$duration_value = '';
$price_per_kk = '';
$is_active = '';
if ($data || $service_package) {
  $package_name = $data['package_name'] ?? $service_package['package_name'];
  $duration_type = $data['duration_type'] ?? $service_package['duration_type'];
  $duration_value = $data['duration_value'] ?? $service_package['duration_value'];
  $price_per_kk = $data['price_per_kk'] ?? $service_package['price_per_kk'];
  $is_active = $data['is_active'] ?? $service_package['is_active'];
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
  	<form action="<?php echo $service_package ? BASEURL.'/manage_service_packages/'.$service_id.'/update/'.$id : BASEURL.'/manage_service_packages/'.$service_id.'/store' ?>" method="POST" enctype="multipart/form-data">
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Form Paket</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
								<div class="row">
									<div class="col-sm-6">
									<!-- text input -->
										<div class="form-group">
											<label for="package_name">Nama Paket</label>
											<input name="package_name" type="text" class="form-control" placeholder="Enter ..." value="<?= $package_name ?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="duration_value">Durasi</label>
											<div class="input-group">
												<input name="duration_value" type="number" class="form-control" value="<?= $duration_value ?>">
												<div class="input-group-append">
													<select name="duration_type" class="form-control">
														<option value="monthly" <?= $duration_type == 'monthly' ? 'selected' : '' ?>>Bulan</option>
														<option value="yearly" <?= $duration_type == 'yearly' ? 'selected' : '' ?>>Tahun</option>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
									<!-- text input -->
										<div class="form-group">
											<label for="price_per_kk">Biaya per KK</label>
											<input name="price_per_kk" type="number" class="form-control" placeholder="Enter ..." value="<?= $price_per_kk ?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="is_active">Status</label>
											<select name="is_active" class="form-control">
												<option value="1" <?= $is_active == 1 ? 'selected' : '' ?>>Active</option>
												<option value="0" <?= $is_active == 0 ? 'selected' : '' ?>>Non Active</option>
											</select>
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