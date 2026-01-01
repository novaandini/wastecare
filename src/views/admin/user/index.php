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
              <a href="<?= BASEURL . '/manage_users/' . $role . '/create' ?>" class="btn btn-inline btn-primary"><i class="fas fa-copy"></i> Create</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Nomor Telepon</th>
                    <th>Alamat</th>
                    <th class="">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($data as $row) : ?>
                  <tr>
                    <td class=""><?= $row["name"] ?></td>
                    <td><?= $row["email"] ?></td>
                    <td><?= $row['phone_number'] ?></td>
                    <td><?= $row['address'] ?></td>
                    <td class="d-flex flex-wrap">
                      <a href="<?= BASEURL . '/manage_users/' . $row["role"] . '/edit/' . $row['user_id'] ?>" class="btn mr-2 mb-2 btn-primary me-3">
                        <i class="fas fa-copy"></i> Edit
                      </a>
                      <form action="<?= BASEURL . '/manage_users/' . $row["role"] . '/delete/' . $row['user_id'] ?>"
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
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Nomor Telepon</th>
                    <th>Alamat</th>
                    <th class="">Action</th>
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