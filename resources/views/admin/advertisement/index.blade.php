@extends('admin.layouts.app')
@section('title', 'Advertisement')


@section('style')
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css"> -->

	<link rel="stylesheet" href="{{ asset('admin/datatable/css/dataTables.bootstrap.min.css')}}" />
	<link rel="stylesheet" href="{{ asset('admin/datatable/css/buttons.dataTables.min.css')}}">
	<style type="text/css">
	.modal-title{
		font-weight: bold;
	}
</style>
@endsection

@section('content')
<!-- Advertisement header -->
<section class="content-header">
	<h1>
		ADVERTISEMENT
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('admin.dashboardRoute') }}"><i class="fa fa-home"></i> Dashboard</a></li>
		<li class="active">Advertisement</li>
	</ol>
</section>
<!-- /.advertisement header -->

<!-- Main content -->
<section class="content">
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Manage Advertisements</h3>

			<div class="box-tools">
				<button type="button" class="btn btn-info btn-sm btn-flat add-button"><i class="fa fa-plus"></i> Add Advertisement</button>
			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div style="width: 100%; padding-left: -10px;">
				<div class="table-responsive">
					<table id="advertisements-table" class="table table-striped table-hover dt-responsive display nowrap" cellspacing="0">
						<thead>
							<tr>
								<th>Title</th>
								<th>URL</th>
								<th>Image</th>
								<th>Created By</th>
								<th>Created At</th>
								<th>Updated At</th>
								<th width="10%">Publication Status</th>
								<th width="7%">Action</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
		<!-- /.box-body -->
		<div class="box-footer clearfix">
		</div>
	</div>
</section>
<!-- /.main content -->

<!-- add advertisement modal -->
<div id="add-modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">
						<span class="fa-stack fa-sm">
							<i class="fa fa-square-o fa-stack-2x"></i>
							<i class="fa fa-plus fa-stack-1x"></i>
						</span>
						Add Advertisement
					</h4>
				</div>
				<form role="form" id="advertisement_add_form" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="modal-body">
						<div class="form-group">
							<label for="title">Title</label>
							<input type="text" name="title" class="form-control" id="title">
							<span class="text-danger" id="title-error"></span>
						</div>
						<div class="form-group">
							<label for="url">URL</label>
							<input type="text" name="url" class="form-control" id="url">
							<span class="text-danger" id="url-error"></span>
						</div>
						<div class="form-group">
							<label for="image">Image</label>
							<input type="file" name="image" id="image" class="form-control">
							<span class="text-danger" id="image-error"></span>
						</div>
						<div class="form-group">
							<label>Publication Status</label>
							<select class="form-control" name="publication_status" id="publication_status">
								<option selected disabled>Select One</option>
								<option value="1">Published</option>
								<option value="0">Unpublished</option>
							</select>
							<span class="text-danger" id="publication-status-error"></span>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-info btn-flat" id="store-button">Save changes</button>
					</div>
				</form>

			</div>
		</div>
	</div>
	<!-- /.add advertisement modal -->

	<!-- view advertisement modal -->
	<div id="view-modal" class="modal fade bs-example-modal-lg print-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<div class="btn-group pull-right no-print">
						<div class="btn-group">
							<button class="tip btn btn-default btn-flat btn-sm" id="print-button" data-toggle="tooltip" data-original-title="Print">
								<i class="fa fa-print"></i>
								<span class="hidden-sm hidden-xs"></span>
							</button>
						</div>
						<div class="btn-group">
							<button class="tip btn btn-default btn-flat btn-sm" data-toggle="tooltip" data-original-title="Close" data-dismiss="modal" aria-label="Close">
								<i class="fa fa-remove"></i>
								<span class="hidden-sm hidden-xs"></span>
							</button>
						</div>
					</div>
					<h4 class="modal-title" id="view-title"></h4>
				</div>
				<div class="modal-body">
					<table class="table table-bordered table-striped">
						<tbody>
							<tr>
								<td colspan="2"><img src="" id="view-image" class="img-responsive img-thumbnail img-rounded" width="100%"></td>
							</tr>
							<tr>
								<td>URL</td>
								<td id="view-url"></td>
							</tr>
							<tr>
								<td>Created By</td>
								<td id="view-created-by"></td>
							</tr>
							<tr>
								<td>Publication Status</td>
								<td id="view-publication-status"></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="modal-footer no-print">
					<button type="button" class="btn btn-default btn-flat" data-dismiss="modal" aria-label="Close">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /.view advertisement modal -->

	<!-- delete advertisement modal -->
	<div id="delete-modal" class="modal modal-danger fade" id="modal-danger">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">
							<span class="fa-stack fa-sm">
								<i class="fa fa-square-o fa-stack-2x"></i>
								<i class="fa fa-trash fa-stack-1x"></i>
							</span>
							Are you sure want to delete this ?
						</h4>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
						<form method="post" role="form" id="delete_form">
							{{csrf_field()}}
							{{method_field('DELETE')}}
							<button type="submit" class="btn btn-outline">Delete</button>
						</form>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.delete advertisement modal -->


		<!-- edit advertisement modal -->
		<div id="edit-modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">
								<span class="fa-stack fa-sm">
									<i class="fa fa-square-o fa-stack-2x"></i>
									<i class="fa fa-edit fa-stack-1x"></i>
								</span>
								Edit Advertisement
							</h4>
						</div>
						<form role="form" id="advertisement_edit_form" method="post" enctype="multipart/form-data">
							{{method_field('PATCH')}}
							{{csrf_field()}}
							<input type="hidden" name="advertisement_id" id="edit-advertisement-id">
							<div class="modal-body">
								<div class="form-group">
									<label for="title">Title</label>
									<input type="text" name="title" class="form-control" id="edit-title" placeholder="ex: advertisement">
									<span class="text-danger title-error"></span>
								</div>
								<div class="form-group">
									<label for="url">URL</label>
									<input type="text" name="url" class="form-control" id="edit-url" placeholder="ex: advertisement">
									<span class="text-danger url-error"></span>
								</div>
								<div class="form-group">
									<label for="image">Image</label>
									<input type="file" name="image" id="edit-image" class="form-control">
									<span class="text-danger image-error"></span>
								</div>
								<div class="form-group">
									<label>Publication Status</label>
									<select class="form-control" name="publication_status" id="edit-publication-status">
										<option selected disabled>Select One</option>
										<option value="1">Published</option>
										<option value="0">Unpublished</option>
									</select>
									<span class="text-danger publication-status-error"></span>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-info btn-flat update-button">Update</button>
							</div>
						</form>

					</div>
				</div>
			</div>
			<!-- /.edit advertisement modal -->

			<!-- view user modal -->
			<div id="user-view-modal" class="modal fade bs-example-modal-lg print-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<div class="btn-group pull-right no-print">
								<div class="btn-group">
									<button class="tip btn btn-default btn-flat btn-sm" id="print-button" data-toggle="tooltip" data-original-title="Print">
										<i class="fa fa-print"></i>
										<span class="hidden-sm hidden-xs"></span>
									</button>
								</div>
								<div class="btn-group">
									<button class="tip btn btn-default btn-flat btn-sm" data-toggle="tooltip" data-original-title="Close" data-dismiss="modal" aria-label="Close">
										<i class="fa fa-remove"></i>
										<span class="hidden-sm hidden-xs"></span>
									</button>
								</div>
							</div>
							<h4 class="modal-title" id="view-name"></h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-9">
									<table class="table table-bordered table-striped">
										<tbody>
											<tr>
												<td width="20%">Role</td>
												<td id="view-role"></td>
											</tr>
											<tr>
												<td>Username</td>
												<td id="view-username"></td>
											</tr>
											<tr>
												<td>Email</td>
												<td id="view-email"></td>
											</tr>
											<tr>
												<td>Gender</td>
												<td id="view-gender"></td>
											</tr>
											<tr>
												<td>Phone</td>
												<td id="view-phone"></td>
											</tr>
											<tr>
												<td>Address</td>
												<td id="view-address"></td>
											</tr>
											<tr>
												<td>Facebook</td>
												<td id="view-facebook"></td>
											</tr>
											<tr>
												<td>Twitter</td>
												<td id="view-twitter"></td>
											</tr>
											<tr>
												<td>Google Plus</td>
												<td id="view-google-plus"></td>
											</tr>
											<tr>
												<td>Linkedin</td>
												<td id="view-linkedin"></td>
											</tr>
											<tr>
												<td>Status</td>
												<td id="view-status"></td>
											</tr>
											<tr>
												<td>About</td>
												<td id="view-about"></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="col-md-3">
									<img id="view-avatar" class="img-responsive img-thumbnail img-rounded">
								</div>
							</div>
						</div>
						<div class="modal-footer no-print">
							<button type="button" class="btn btn-default btn-flat" data-dismiss="modal" aria-label="Close">Close</button>
						</div>
					</div>
				</div>
			</div>
			<!-- /.view user modal -->
			@endsection

			@section('script')
	<!-- <script type="text/javascript" src="https://datatables.yajrabox.com/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://datatables.yajrabox.com/js/datatables.bootstrap.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script> -->

	<script type="text/javascript" src="{{ asset('admin/datatable/js/jquery.dataTables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin/datatable/js/datatables.bootstrap.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin/datatable/js/dataTables.buttons.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin/datatable/js/buttons.flash.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin/datatable/js/pdfmake.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin/datatable/js/vfs_fonts.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin/datatable/js/buttons.html5.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin/datatable/js/buttons.print.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin/datatable/js/buttons.colVis.min.js') }}"></script>

	<script type="text/javascript">
		/** Load datatable **/
		$(document).ready(function() {
			get_table_data();
		});

		/** Edit **/
		$("#advertisements-table").on("click", ".edit-button", function(){
			var advertisement_id = $(this).data("id");
			var url = "{{ route('admin.advertisements.show', 'advertisement_id') }}";
			url = url.replace("advertisement_id", advertisement_id);
			$.ajax({
				url: url,
				method: "GET",
				dataType: "json",
				success:function(data){
					$('#edit-modal').modal('show');
					$('#edit-advertisement-id').val(data['id']);
					$('#edit-title').val(data['title']);
					$('#edit-url').val(data['url']);
					$('#edit-publication-status').val(data['publication_status']);
				}});
		});

		/** Update **/
		$(".update-button").click(function(){
			var advertisement_id = $('#edit-advertisement-id').val();
			var url = "{{ route('admin.advertisements.update', 'advertisement_id') }}";
			url = url.replace("advertisement_id", advertisement_id);
			var postData = new FormData($("#advertisement_edit_form")[0]);
			$( '.title-error' ).html( "" );
			$( '.url-error' ).html( "" );
			$( '.image-error' ).html( "" );
			$( '.publication-status-error' ).html( "" );
			$.ajax({
				type:'POST',
				url: url,
				processData: false,
				contentType: false,
				data : postData,
				success:function(data) {
					console.log(data);
					if(data.errors) {
						if(data.errors.title){
							$( '.title-error' ).html( data.errors.title[0] );
						}
						if(data.errors.url){
							$( '.url-error' ).html( data.errors.url[0] );
						}
						if(data.errors.image){
							$( '.image-error' ).html( data.errors.image[0] );
						}
						if(data.errors.publication_status){
							$( '.publication-status-error' ).html( data.errors.publication_status[0] );
						}
					}
					if(data.success) {
						window.location.href = '{{ route('admin.advertisements.index') }}';
					}
				},
			});
		});

		/** Delete **/
		$("#advertisements-table").on("click", ".delete-button", function(){
			var advertisement_id = $(this).data("id");
			var url = "{{ route('admin.advertisements.destroy', 'advertisement_id') }}";
			url = url.replace("advertisement_id", advertisement_id);
			$('#delete-modal').modal('show');
			$('#delete_form').attr('action', url);
		});

		/** View **/
		$("#advertisements-table").on("click", ".view-button", function(){
			var advertisement_id = $(this).data("id");
			var url = "{{ route('admin.advertisements.show', 'advertisement_id') }}";
			url = url.replace("advertisement_id", advertisement_id);
			$.ajax({
				url: url,
				method: "GET",
				dataType: "json",
				success:function(data){
					var src = '{{ get_advertisement_image_url() }}/';
					var no_image = '{{ get_advertisement_image_url('no_image.jpg') }}';
					$('#view-modal').modal('show');
					$('#view-title').text(data['title']);
					$('#view-url').text(data['url']);
					$('#view-created-by').text(data['user']['name']);
					if(data['image']){
						$("#view-image").attr("src", src+data['image']);
					}else{
						$("#view-image").attr("src", no_image);
					}
					if(data['publication_status'] == 1){
						$('#view-publication-status').text('Published');
					}else{
						$('#view-publication-status').text('Unpublished');
					}
				}});
		});

		/** Add **/
		$(".add-button").click(function(){
			$('#add-modal').modal('show');
		});

		/** Store **/
		$("#store-button").click(function(){
			var postData = new FormData($("#advertisement_add_form")[0]);
			$( '#title-error' ).html( "" );
			$( '#url-error' ).html( "" );
			$( '#image-error' ).html( "" );
			$( '#publication-status-error' ).html( "" );
			$.ajax({
				type:'POST',
				url:'{{ route('admin.advertisements.store') }}',
				processData: false,
				contentType: false,
				data : postData,
				success:function(data) {
					console.log(data);
					if(data.errors) {
						if(data.errors.title){
							$( '#title-error' ).html( data.errors.title[0] );
						}
						if(data.errors.url){
							$( '#url-error' ).html( data.errors.url[0] );
						}
						if(data.errors.image){
							$( '#image-error' ).html( data.errors.image[0] );
						}
						if(data.errors.publication_status){
							$( '#publication-status-error' ).html( data.errors.publication_status[0] );
						}
					}
					if(data.success) {
						window.location.href = '{{ route('admin.advertisements.index') }}';
					}
				},
			});
		});

		/** Get datatable **/
		function get_table_data(){
			$('#advertisements-table').DataTable({
				dom: 'Blfrtip',
				buttons: [
				{ extend: 'copy', exportOptions: { columns: ':visible'}},
				{ extend: 'print', exportOptions: { columns: ':visible'}},
				{ extend: 'pdf', orientation: 'landscape', advertisementSize: 'A4', exportOptions: { columns: ':visible'}},
				{ extend: 'csv', exportOptions: { columns: ':visible'}},
				{ extend: 'colvis', text:'Column'},
				],
				columnDefs: [ {
					targets: -1,
					visible: true
				} ],
				lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
				processing: true,
				serverSide: true,
				ajax: "{{ route('admin.getAdvertisementsRoute') }}",
				columns: [
				{data: 'title'},
				{data: 'url'},
				{data: 'image', name: 'image', orderable: false, searchable: false},
				{data: 'username', name: 'username', orderable: true, searchable: true},
				{data: 'created_at'},
				{data: 'updated_at'},
				{data: 'publication_status', name: 'publication_status', orderable: false, searchable: false},
				{data: 'action', name: 'action', orderable: false, searchable: false},
				],
				order: [[3, 'desc']],
			});
		}

		/** User View **/
		$("#advertisements-table").on("click", ".user-view-button", function(){
			var id = $(this).data("id");
			var url = "{{ route('admin.users.show', 'id') }}";
			url = url.replace("id", id);
			$.ajax({
				url: url,
				method: "GET",
				dataType: "json",
				success:function(data){
					var src = '{{ asset('avatar') }}/';
					var default_avatar = '{{ asset('avatar/user.png') }}';
					$('#user-view-modal').modal('show');

					$('#view-name').text(data['name']);
					$('#view-username').text(data['username']);
					$('#view-email').text(data['email']);
					$("#view-avatar").attr("src", src+data['avatar']);
					if(data['avatar']){
						$("#view-avatar").attr("src", src+data['avatar']);
					}else{
						$("#view-avatar").attr("src", default_avatar);
					}
					if(data['gender'] == 'm'){
						$('#view-gender').text('Male');
					}else{
						$('#view-gender').text('Female');
					}
					$('#view-phone').text(data['phone']);
					$('#view-address').text(data['address']);
					$('#view-facebook').text(data['facebook']);
					$('#view-twitter').text(data['twitter']);
					$('#view-google-plus').text(data['google_plus']);
					$('#view-linkedin').text(data['linkedin']);
					$('#view-about').text(data['about']);
					if(data['role'] == 'admin'){
						$('#view-role').text('Admin');
					}else{
						$('#view-role').text('User');
					}
					if(data['activation_status'] == 1){
						$('#view-status').text('Active');
					}else{
						$('#view-status').text('Block');
					}
				}});
		});
	</script>
	@endsection