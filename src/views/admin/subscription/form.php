<?php
$data = Message::getData();
$region_id = null;
$region_name = '';
$province = '';
if ($data || $region) {
  $region_id = $data['region_id'] ?? $region['region_id'];
  $region_name = $data['region_name'] ?? $region['region_name'];
  $province = $data['province'] ?? $region['province'];
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
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?= $title ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="<?php echo $region ? BASEURL . '/manage_regions/update/' . $region_id : BASEURL . '/manage_regions/store' ?>" method="POST">
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="region_name">Kota/Kabupaten</label>
                        <input name="region_name" type="text" class="form-control" placeholder="Enter ..." value="<?= $region_name ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="province">Provinsi</label>
                        <input name="province" type="text" class="form-control" placeholder="Enter ..." value="<?= $province ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->