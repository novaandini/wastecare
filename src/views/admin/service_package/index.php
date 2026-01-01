<?php

Message::flash();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
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
              <a href="<?= BASEURL . '/manage_service_packages/' . $service_id . '/create' ?>" class="btn btn-inline btn-primary"><i class="fas fa-copy"></i> Create</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Nama Paket</th>
                    <th>Durasi</th>
                    <th>Biaya per KK</th>
                    <th>Status</th>
                    <th class="">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($data as $row) : ?>
                  <tr>
                    <td class=""><?= $row["package_name"] ?></td>
                    <td><?= $row["duration_value"] ?> <?= $row["duration_type"] == 'monthly' ? 'Bulan' : 'Tahun' ?></td>
                    <td>Rp<?= number_format($row["price_per_kk"], 0, ',', '.') ?></td>
                    <td style="width: 15px;">
                      <?php if ($row['is_active']) : ?>
                        Aktif
                      <?php else : ?>
                        Nonaktif
                      <?php endif; ?>
                    </td>
                    <td class="d-flex flex-wrap">
                      <a href="<?= BASEURL . '/manage_service_packages/' . $row["service_id"] . '/edit/' . $row['service_package_id'] ?>" class="btn mr-2 mb-2 btn-primary me-3">
                        <i class="fas fa-copy"></i> Edit
                      </a>
                      <form action="<?= BASEURL . '/manage_service_packages/' . $row["service_id"] . '/delete/' . $row['service_package_id'] ?>"
                      method="post"
                      class="mr-2 mb-2 delete-form">
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                      </form>
                    </td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Jenis Paket</th>
                    <th>Durasi</th>
                    <th>Biaya per KK</th>
                    <th>Status</th>
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