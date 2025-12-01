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
              <a href="<?= BASEURL . '/admin/services/create' ?>" class="btn btn-inline btn-primary"><i class="fas fa-copy"></i> Create</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Institution</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($data as $row) : ?>
                  <tr>
                    <td><?= $row->service_name ?></td>
                    <td><?= $row->institution->name ?></td>
                    <td><?= $row->price ?>/td>
                    <td><?= $row->status ?></td>
                    <td>
                      <a href="<?= BASEURL . 'services/edit/' . $row->service_id ?>">
                        <i class="fas fa-copy"></i> Edit
                      </a>
                      <form action="<?= BASEURL . '/services/delete/' . $row->service_id ?>" method="post">
                        <button type="submit">
                          <i class="fas fa-copy"></i> Delete
                        </button>
                      </form>
                    </td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Institution</th>
                    <th>Price</th>
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