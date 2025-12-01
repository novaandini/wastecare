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
                <h3 class="card-title">Form Service</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="<?= BASEURL . '/manage_services/store' ?>" method="POST">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="name">Nama Layanan</label>
                        <input name="name" type="text" class="form-control" placeholder="Enter ...">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- select -->
                      <div class="form-group">
                        <label for="user_id">Institusi</label>
                        <select name="user_id" class="form-control">
                          <option>option 1</option>
                        </select>
                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="price">Harga</label>
                            <input name="price" type="number" class="form-control" placeholder="Enter ...">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="category">Kategori</label>
                            <input name="category" type="text" class="form-control" placeholder="Enter ...">
                        </div>
                    </div>
                    <div class="col-sm-4">
                      <!-- select -->
                      <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                          <option value="1">Active</option>
                          <option value="0">Non Active</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- textarea -->
                      <div class="form-group">
                        <label for="description">Deskripsi Layanan</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Enter ..."></textarea>
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