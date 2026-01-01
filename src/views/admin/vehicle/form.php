<?php
$data = Message::getData();
$region_id = '';
$vehicle_code = '';
$vehicle_name = '';
$type = '';
$capacity_kg = '';
$is_active = '';
$notes = '';
if ($data || $vehicle) {
  $region_id = $data['region_id'] ?? $vehicle['region_id'];
  $vehicle_code = $data['vehicle_code'] ?? $vehicle['vehicle_code'];
  $vehicle_name = $data['vehicle_name'] ?? $vehicle['vehicle_name'];
  $type = $data['type'] ?? $vehicle['type'];
  $capacity_kg = $data['capacity_kg'] ?? $vehicle['capacity_kg'];
  $is_active = $data['is_active'] ?? $vehicle['is_active'];
  $notes = $data['notes'] ?? $vehicle['notes'];
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
  	<form action="<?php echo $vehicle ? BASEURL.'/manage_vehicles/update/'.$id : BASEURL.'/manage_vehicles/store' ?>" method="POST" enctype="multipart/form-data">
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title text-capitalize">Daftar Kendaraan Baru</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
								<div class="row">
									<div class="col-sm-6">
									<!-- select -->
										<div class="form-group">
											<label for="region_id">Daerah Cakupan</label>
											<select name="region_id" class="form-control">
												<?php foreach ($regions as $region) : ?>
												<option value="<?= $region['region_id'] ?>" <?= $region_id == $region['region_id'] ? 'selected' : '' ?>><?= $region['region_name'] ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<div class="col-sm-6">
									<!-- select -->
										<div class="form-group">
											<label for="type">Jenis Kendaraan</label>
											<select name="type" class="form-control">
												<option value="truck" <?= $type == 'truck' ? 'selected' : '' ?>>Truk</option>
												<option value="pickup" <?= $type == 'pickup' ? 'selected' : '' ?>>Pick Up</option>
												<option value="motor" <?= $type == 'motor' ? 'selected' : '' ?>>Motor</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
									<!-- text input -->
										<div class="form-group">
											<label for="vehicle_name">Nama</label>
											<input name="vehicle_name" type="text" class="form-control" placeholder="Enter ..." value="<?= $vehicle_name ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
									<!-- text input -->
										<div class="form-group">
											<label for="vehicle_code">Kode</label>
											<input name="vehicle_code" type="text" class="form-control" placeholder="Enter ..." value="<?= $vehicle_code ?>">
										</div>
									</div>
									<div class="col-sm-6">
									<!-- text input -->
										<div class="form-group">
											<label for="capacity_kg">Kapasitas (Kg)</label>
											<input name="capacity_kg" type="text" class="form-control" placeholder="Enter ..." value="<?= $capacity_kg ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
									<!-- text input -->
										<div class="form-group">
											<label for="notes">Catatan</label>
											<input name="notes" type="text" class="form-control" placeholder="Enter ..." value="<?= $notes ?>">
										</div>
									</div>
									<div class="col-sm-6">
										<!-- select -->
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