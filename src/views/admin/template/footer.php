	<footer class="main-footer">
		<div class="float-right d-none d-sm-block">
			<b>Version</b> 3.1.0
		</div>
		<strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  	</footer>

  	<!-- Control Sidebar -->
  	<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  	</aside>
  	<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../../../public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../../../public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dropify/dist/js/dropify.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../../../public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../../../public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../../../public/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../../../public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../../../public/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../../../public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../../../public/plugins/jszip/jszip.min.js"></script>
<script src="../../../../public/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../../../public/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../../../public/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../../../public/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../../../public/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../../../../public/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../../../public/js/demo.js"></script>
<!-- Page specific script -->
<script>
  	$(function () {
		$("#example1").DataTable({
		"responsive": true, "lengthChange": false, "autoWidth": false,
		"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		$('#example2').DataTable({
		"paging": true,
		"lengthChange": false,
		"searching": false,
		"ordering": true,
		"info": true,
		"autoWidth": false,
		"responsive": true,
		});
  	});

  	$(document).ready(function () {
		$('.dropify').dropify();

		$(document).on('submit', '.delete-form', function (e) {
			e.preventDefault();

			let form = this;

			Swal.fire({
				title: 'Yakin ingin menghapus?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Hapus'
			}).then((result) => {
				if (result.isConfirmed) {
					form.submit();
				}
			});
		});
  	});
  	$(document).ready(function () {
      	$("#add-item").click(function () {
          	let row = `
          	<div class="row mb-3">
              	<div class="col-md-12">
                  	<div class="form-group">
						<label for="title">Judul</label>
						<input name="title[]" type="text" class="form-control" placeholder="Enter ..." value="">
					</div>
					<div class="form-group">
						<label for="content">Konten</label>
						<textarea name="content[]" class="form-control" rows="3" placeholder="Enter ..."></textarea>
					</div>
					<div class="form-group">
						<button type="button" class="btn btn-danger remove-item">Remove</button>
					</div>
              	</div>
          	</div>
          	`;

          	$("#item-wrapper").append(row);
      	});

      	// Important: Event Delegation
      	$(document).on("click", ".remove-item", function () {
          	$(this).closest(".item-row").remove();
      	});
  	});
</script>
</body>
</html>