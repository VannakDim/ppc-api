@extends('admin.layouts.app')
@section('title', 'Public Resources')


@section('style')

	<link rel="stylesheet" href="{{ asset('admin/datatable/css/dataTables.bootstrap.min.css')}}" />
	<link rel="stylesheet" href="{{ asset('admin/datatable/css/buttons.dataTables.min.css')}}">
	<style type="text/css">
		.modal-title{
			font-weight: bold;
		}
	</style>
@endsection

@section('content')
	<!-- resource header -->
	<section class="content-header">
		<h1>
			RESOURCES FOR FREE
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ route('admin.dashboardRoute') }}"><i class="fa fa-home"></i> Dashboard</a></li>
			<li class="active">resource</li>
		</ol>
	</section>
	<!-- /.resource header -->

	<!-- Main content -->
	<section class="content">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Manage Resources</h3>

				<div class="box-tools">
					<a href="{{ route('admin.resources.create') }}" class="btn btn-info btn-sm btn-flat add-button"><i class="fa fa-plus"></i> Add Resource</a>
					{{-- <button type="button" class="btn btn-info btn-sm btn-flat add-button"><i class="fa fa-plus"></i> Add Resource</button> --}}
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div style="width: 100%; padding-left: -10px;">
					<div class="table-responsive">
						<table id="resources-table" class="table table-striped table-hover dt-responsive display nowrap" cellspacing="0">
							<thead>
								<tr>
									<th>Title</th>
									<th>Description</th>
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
		</div>
	</section>
	<!-- /.main content -->

	<!-- view resource modal -->
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
					<h4 class="modal-title" id="view-resource-name"></h4>
				</div>
				<div class="modal-body">
					<table class="table table-bordered table-striped">
						<tbody>
							<tr>
								<td colspan="2"><img src="" id="view-resource-thumbnail" class="img-responsive img-thumbnail img-rounded" width="100%"></td>
							</tr>
							<tr>
								<td width="20%">Resources title</td>
								<td id="view-resource-title"></td>
							</tr>
							<tr>
								<td>Description</td>
								<td id="view-resource-description"></td>
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
	<!-- /.view resource modal -->

	<!-- edit resource modal -->
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
							Edit Resource
						</h4>
					</div>
					<form role="form" id="resource_edit_form" method="post" enctype="multipart/form-data">
						{{method_field('PATCH')}}
						{{csrf_field()}}
						<input type="hidden" name="resource_id" id="edit-resource-id">
						<div class="modal-body">
							
							<div class="form-group">
								<label>Resource Title</label>
								<input type="text" name="resource_title" class="form-control" id="edit-resource-title" placeholder="ex: title">
								<span class="text-danger resource-title-error"></span>
							</div>
							<div class="form-group">
								<label>Description</label>
								<input type="text" name="resource_description" class="form-control" id="edit-resource-description" placeholder="ex: resource_description">
								<span class="text-danger resource-description-error"></span>
							</div>
							<div class="form-group">
								<label>Resource File</label>
								<input type="file" name="resource_file" id="edit-resource-file" class="form-control">
								<span class="text-danger resource-file-error"></span>
							</div>
							<div class="form-group">
								<label>Thumbnail</label>
								<input type="file" name="resource_thumbnail" id="edit-resource-thumbnial" class="form-control">
								<span class="text-danger resource-thumbnail-error"></span>
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
		<!-- /.edit resource modal -->

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

	<!-- delete resource modal -->
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
@endsection
@section('script')
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


		/** View **/
		$("#resources-table").on("click", ".view-button", function(){
			var resource_id = $(this).data("id");
			var url = "{{ route('admin.resources.show', 'resource_id') }}";
			url = url.replace("resource_id", resource_id);
			$.ajax({
				url: url,
				method: "GET",
				dataType: "json",
				success:function(data){
					var src = '{{ get_resource_thumbnail_url() }}/';
					var no_image = '{{ get_resource_thumbnail_url('no_image.jpg') }}';
					$('#view-modal').modal('show');
					$('#view-resource-title').text(data['title']);
					$('#view-resource-description').text(data['description']);
					$('#view-created-by').text(data['user']['name']);
					if(data['thumbnail']){
						$("#view-resource-thumbnail").attr("src", src+data['thumbnail']);
					}else{
						$("#view-resource-thumbnail").attr("src", no_image);
					}
					if(data['publication_status'] == 1){
						$('#view-publication-status').text('Published');
					}else{
						$('#view-publication-status').text('Unpublished');
					}
					
				}});
		});

		
		/** Delete **/
		$("#resources-table").on("click", ".delete-button", function(){
			var resource_id = $(this).data("id");
			var url = "{{ route('admin.resources.destroy', 'resource_id') }}";
			url = url.replace("resource_id", resource_id);
			$('#delete-modal').modal('show');
			$('#delete_form').attr('action', url);
		});


		/** Get datatable **/
		function get_table_data(){
			$('#resources-table').DataTable({
				dom: 'Blfrtip',
				buttons: [
				{ extend: 'copy', exportOptions: { columns: ':visible'}},
				{ extend: 'print', exportOptions: { columns: ':visible'}},
				{ extend: 'pdf', orientation: 'landscape', resourceSize: 'A4', exportOptions: { columns: ':visible'}},
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
				ajax: "{{ route('admin.getResource') }}",
				columns: [
				{data: 'title'},
				{data: 'description'},
				{data: 'thumbnail'},
				{data: 'username', name: 'username', orderable: true, searchable: true},
				{data: 'created_at'},
				{data: 'updated_at'},
				{data: 'publication_status', name: 'publication_status', orderable: false, searchable: false},
				{data: 'action', name: 'action', orderable: false, searchable: false},
				],
				order: [[4, 'desc']],
			});
		}

		/** User View **/
		$("#resources-table").on("click", ".user-view-button", function(){
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

		/** Edit **/
		$("#resources-table").on("click", ".edit-button", function(){
			var resource_id = $(this).data("id");
			var url = "{{ route('admin.resources.show', 'resource_id') }}";
			url = url.replace("resource_id", resource_id);
			$.ajax({
				url: url,
				method: "GET",
				dataType: "json",
				success:function(data){
					$('#edit-modal').modal('show');
					$('#edit-resource-id').val(data['id']);
					$('#edit-resource-title').val(data['title']);
					$('#edit-resource-description').val(data['description']);
					$('#edit-publication-status').val(data['publication_status']);
				}});
		});

		/** Update **/
		$(".update-button").click(function(){
			var resource_id = $('#edit-resource-id').val();
			var url = "{{ route('admin.resources.update', 'resource_id') }}";
			url = url.replace("resource_id", resource_id);

			var postData = new FormData($("#resource_edit_form")[0]);
			// $( '.resource-title-error' ).html( "" );
			// $( '.resource-description-error' ).html( "" );
			// $( '.resource-file-error' ).html( "" );
			// $( '.resource-thumbnail-error' ).html( "" );
			// $( '.publication-status-error' ).html( "" );
			$.ajax({
				type:'POST',
				url: url,
				processData: false,
				contentType: false,
				data : postData,
				success:function(data) {
					console.log(data);
					if(data.errors) {
						// if(data.errors.resource_title){
						// 	$( '.resource-title-error' ).html( data.errors.resource_title[0] );
						// }
						// if(data.errors.resource_description){
						// 	$( '.resource-description-error' ).html( data.errors.resource_description[0] );
						// }
						// if(data.errors.resource_featured_image){
						// 	$( '.resource-file-error' ).html( data.errors.resource_file[0] );
						// }
						// if(data.errors.resource_featured_image){
						// 	$( '.resource-thumbnail-error' ).html( data.errors.resource_thumbnail[0] );
						// }
						if(data.errors.publication_status){
							$( '.publication-status-error' ).html( data.errors.publication_status[0] );
						}
					}
					if(data.success) {
						window.location.href = '{{ route('admin.resources.index') }}';
					}
				},
			});
		});
	</script>
@endsection