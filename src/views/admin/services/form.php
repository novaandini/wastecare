<?php
// var_dump($service); die;
$data = Message::getData();
$name = '';
$user_id = '';
$is_active = '';
$description = '';
$image = '';
$service_id = '';
$service_regions = [];
if ($data) {
  $name = $data['name'];
  $is_active = $data['is_active'];
  $description = $data['description'];
  $image = $data['image'];
}
if ($service) {
  $name = $service['name'];
  $user_id = $service['user_id'];
  $is_active = $service['is_active'];
  $description = $service['description'];
  $image = $service['image'];
  $service_id = $service['service_id'];
  $service_regions = $service['region'];
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
  	<form action="<?php echo $service ? BASEURL . '/manage_services/update/' . $service_id : BASEURL . '/manage_services/store' ?>" method="POST" enctype="multipart/form-data">
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Form Layanan</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
								<div class="row">
									<div class="col-sm-12">
									<!-- text input -->
										<div class="form-group">
											<label for="name">Nama Layanan</label>
											<input name="name" type="text" class="form-control" placeholder="Enter ..." value="<?= $name ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
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
								<div class="row">
									<div class="col-sm-6">
									<!-- textarea -->
										<div class="form-group">
											<label for="description">Deskripsi Layanan</label>
											<textarea name="description" class="form-control" rows="3" placeholder="Enter ..."><?= $description ?></textarea>
										</div>
									</div>
									<div class="col-sm-6">
									<!-- select -->
										<div class="form-group">
											<label for="region_id[]">Wilayah</label>
											<select name="region_id[]" multiple class="form-control">
												<?php foreach ($regions as $region): ?>
													<option
														value="<?= $region['region_id'] ?>"
														<?= in_array($region['region_id'], ($service_regions)) ? 'selected' : '' ?>
													>
														<?= htmlspecialchars($region['region_name']) ?>
													</option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-4 col-md-12">
										<div class="form-group">
											<label for="image">Gambar</label>
											<input type="file" name="image" accept="image/*" class="dropify" data-max-file-size="2M" data-allowed-file-extensions="png jpg jpeg" data-default-file="<?= BASEURL . '/public/uploads/services/' . $image ?>" data-width="500">
										</div>
									</div>
								</div>
								<!-- /.card-body -->
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