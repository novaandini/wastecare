<?php
// var_dump($service); die;
$data = Message::getData();
$title = '';
$content = '';
if ($data || $service_detail) {
  $title = $data['title'] ?? $service_detail['title'];
  $content = $data['content'] ?? $service_detail['content'];
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
  	<form action="<?php echo $service_detail ? BASEURL.'/manage_service_details/'.$service_id.'/update/'.$id : BASEURL.'/manage_service_details/'.$service_id.'/store' ?>" method="POST" enctype="multipart/form-data">
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
											<label for="title">Judul</label>
											<input name="title" type="text" class="form-control" placeholder="Enter ..." value="<?= $title ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
									<!-- textarea -->
										<div class="form-group">
											<label for="content">Konten</label>
											<textarea name="content" class="form-control" rows="3" placeholder="Enter ..."><?= htmlspecialchars($content) ?></textarea>
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