<?php
$vehicle_id = $data['vehicle_id'] ?? ($subscription['vehicle_id'] ?? null);
$user_id = $data['user_id'] ?? ($subscription['user_id'] ?? null);
$total_kk = $data['total_kk'] ?? $subscription['total_kk'];
$subscription_id = $data['subscription_id'] ?? $subscription['subscription_id'];
$price_per_kk = $data['price_per_kk'] ?? $subscription['price_per_kk'];
$total_price = $data['total_price'] ?? $subscription['total_price'];
$contact_name = $data['contact_name'] ?? $subscription['contact_name'];
$contact_phone = $data['contact_phone'] ?? $subscription['contact_phone'];
$contact_address = $data['contact_address'] ?? $subscription['contact_address'];
$status = $data['status'] ?? $subscription['status'];
$start_date = $data['start_date'] ?? $subscription['start_date'];
$end_date = $data['end_date'] ?? $subscription['end_date'];
$village_name = $data['village_name'] ?? $subscription['village_name'];
$district_name = $data['district_name'] ?? $subscription['district_name'];
$city_name = $data['city_name'] ?? $subscription['city_name'];
$package_name = $data['package']['package_name'] ?? $subscription['package']['package_name'];
$duration_type = $data['package']['duration_type'] ?? $subscription['package']['duration_type'];
$duration_value = $data['package']['duration_value'] ?? $subscription['package']['duration_value'];
$service_name = $data['service']['name'] ?? $subscription['service']['name'];
$user_name = $data['user']['name'] ?? $subscription['user']['name'];
$user_email = $data['user']['email'] ?? $subscription['user']['email'];
$user_phone_number = $data['user']['phone_number'] ?? $subscription['user']['phone_number'];
$user_address = $data['user']['address'] ?? $subscription['user']['address'];
Message::flash();

// var_dump($vehicles); die;
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
  	<section class="content">
    	<div class="container-fluid">
      		<div class="row">
        		<div class="col-12">
          			<form action="<?= BASEURL . '/admin/subscription/'.$status.'/update/'.$subscription_id ?>" method="POST">
						<fieldset disabled>
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Informasi Layanan</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<div class="row">
										<div class="col-md-4">
										<!-- text input -->
											<div class="form-group">
												<label for="service_name">Nama Layanan</label>
												<input name="service_name" type="text" class="form-control" placeholder="Enter ..." value="<?= $service_name ?>">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="package_name">Nama Paket</label>
												<input name="package_name" type="text" class="form-control" placeholder="Enter ..." value="<?= $package_name ?>">
											</div>
										</div>
										<div class="col-md-4">
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
								</div>
							</div>
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Informasi Pemilik Akun</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">								
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="user_name">Nama</label>
												<input name="user_name" type="text" class="form-control" placeholder="Enter ..." value="<?= $user_name ?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="user_email">Email</label>
												<input name="user_email" type="text" class="form-control" placeholder="Enter ..." value="<?= $user_email ?>">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="user_phone_number">Nomor Telepon</label>
												<input name="user_phone_number" type="text" class="form-control" placeholder="Enter ..." value="<?= $user_phone_number ?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="user_address">Alamat</label>
												<input name="user_address" type="text" class="form-control" placeholder="Enter ..." value="<?= $user_address ?>">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Informasi Pengajuan Langganan</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="total_kk">Jumlah KK</label>
												<input name="total_kk" type="text" class="form-control" placeholder="Enter ..." value="<?= $total_kk ?>">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="price_per_kk">Harga Per KK</label>
												<input name="price_per_kk" type="text" class="form-control" placeholder="Enter ..." value="<?= $price_per_kk ?>">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="total_price">Total Harga</label>
												<input name="total_price" type="text" class="form-control" placeholder="Enter ..." value="<?= $total_price ?>">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4">
										<!-- text input -->
											<div class="form-group">
												<label for="contact_name">Nama Penanggung Jawab</label>
												<input name="contact_name" type="text" class="form-control" placeholder="Enter ..." value="<?= $contact_name ?>">
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label for="contact_phone">Nomor Telepon Penanggung Jawab</label>
												<input name="contact_phone" type="text" class="form-control" placeholder="Enter ..." value="<?= $contact_phone ?>">
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label for="contact_address">Alamat Penanggung Jawab</label>
												<input name="contact_address" type="text" class="form-control" placeholder="Enter ..." value="<?= $contact_address ?>">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4">
										<!-- text input -->
											<div class="form-group">
												<label for="village_name">Nama Banjar/Desa</label>
												<input name="village_name" type="text" class="form-control" placeholder="Enter ..." value="<?= $village_name ?>">
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label for="district_name">Kecamatan</label>
												<input name="district_name" type="text" class="form-control" placeholder="Enter ..." value="<?= $district_name ?>">
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label for="city_name">Kabupaten</label>
												<input name="city_name" type="text" class="form-control" placeholder="Enter ..." value="<?= $city_name ?>">
											</div>
										</div>
									</div>
								</div>
							</div>
						</fieldset>
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Informasi Pengajuan Langganan</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
								<div class="row">
									<div class="col-sm-4">
									<!-- text input -->
										<div class="form-group">
											<label for="status">Status</label>
											<select name="status" id="" class="form-control">
												<option value="pending" <?= $status == 'pending' ? 'selected' : '' ?>>Pending</option>
												<option value="active" <?= $status == 'active' ? 'selected' : '' ?>>Active</option>
												<option value="paused" <?= $status == 'paused' ? 'selected' : '' ?>>Paused</option>
												<option value="ended" <?= $status == 'ended' ? 'selected' : '' ?>>Ended</option>
											</select>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label for="start_date">Tanggal Mulai</label>
											<input name="start_date" type="date" class="form-control" placeholder="Enter ..." value="<?= $start_date ?>">
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label for="end_date">Tanggal Selesai</label>
											<input name="end_date" type="date" class="form-control" placeholder="Enter ..." value="<?= $end_date ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="vehicle_id">Kendaraan</label>
											<select name="vehicle_id" class="form-control">
												<?php foreach ($vehicles as $vehicle) : ?>
												<option value="<?= $vehicle['vehicle_id'] ?>" <?= $vehicle_id == $vehicle['vehicle_id'] ? 'selected' : '' ?>><?= $vehicle['vehicle_name'] .' - '. $vehicle['vehicle_code'] ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="user_id">Staff yang Bertugas</label>
											<select name="user_id" class="form-control">
												<?php foreach ($staffs as $staff) : ?>
												<option value="<?= $staff['user_id'] ?>" <?= $user_id == $staff['user_id'] ? 'selected' : '' ?>><?= $staff['name'] .' - '. $staff['phone_number'] ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
                  		<button type="submit" class="btn btn-primary">Submit</button>
          			</form>
      			</div>
    		</div>
		</div>
  	</section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->