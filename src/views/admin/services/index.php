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
              <a href="<?= BASEURL . '/manage_services/create' ?>" class="btn btn-inline btn-primary"><i class="fas fa-copy"></i> Create</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th class="">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($data as $row) : ?>
                  <tr>
                    <td><?= $row["name"] ?></td>
                    <td style="width: 15px;">
                      <?php if ($row['is_active']) : ?>
                        Aktif
                      <?php else : ?>
                        Nonaktif
                      <?php endif; ?>
                    </td>
                    <td class="d-flex flex-wrap">
                      <a href="<?= BASEURL . '/manage_services/edit/' . $row["service_id"] ?>" class="btn mr-2 mb-2 btn-primary me-3">
                        <i class="fas fa-copy"></i> Edit
                      </a>
                      <form action="<?= BASEURL ?>/manage_services/delete/<?= $row['service_id'] ?>"
                      method="post"
                      class="mr-2 mb-2 delete-form">
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                      </form>
                      <a href="<?= BASEURL . '/manage_service_details/' . $row["service_id"] ?>" class="mr-2 mb-2 btn btn-info me-3">
                        <i class="fas fa-copy"></i> Detail
                      </a>
                      <a href="<?= BASEURL . '/manage_service_packages/' . $row["service_id"] ?>" class="mr-2 mb-2 btn btn-secondary me-3">
                        <i class="fas fa-copy"></i> Package
                      </a>
                    </td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Name</th>
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