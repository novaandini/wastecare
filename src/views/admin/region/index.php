<?php
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
              <a href="<?= BASEURL . '/manage_regions/create' ?>" class="btn btn-inline btn-primary"><i class="fas fa-copy"></i> Create</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Kota/Kabupaten</th>
                    <th>Provinsi</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($data as $row) : ?>
                  <tr>
                    <td><?= $row['region_name'] ?></td>
                    <td><?= $row['province'] ?></td>
                    <td>
                      <a class="btn btn-warning" href="<?= BASEURL . '/manage_regions/edit/' . $row['region_id'] ?>">
                        <i class="fas fa-copy"></i> Edit
                      </a>
                      <form action="<?= BASEURL . '/manage_regions/delete/' . $row['region_id'] ?>" method="post" class="d-inline delete-form">
                        <button type="submit" class="btn btn-danger">
                          <i class="fas fa-copy"></i> Delete
                        </button>
                      </form>
                    </td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Kota/Kabupaten</th>
                    <th>Provinsi</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
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