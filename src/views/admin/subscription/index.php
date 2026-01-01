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
          <h1 class="text-capitalize"><?= $title ?></h1>
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
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Nama Paket</th>
                    <th>Lokasi</th>
                    <th>Penanggung Jawab</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($data as $row) : ?>
                  <tr>
                    <td><?= $row['package_name'] ?></td>
                    <td><?= $row['village_name'].', '.$row['district_name'].', '.$row['city_name'] ?></td>
                    <td><?= $row['contact_name'].' ('.$row['contact_phone'].')' ?></td>
                    <td>
                      <a class="btn btn-warning" href="<?= BASEURL . '/admin/subscription/edit/' . $row['subscription_id'] ?>">
                        <i class="fas fa-copy"></i> Edit
                      </a>
                    </td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Nama Paket</th>
                    <th>Lokasi</th>
                    <th>Penanggung Jawab</th>
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