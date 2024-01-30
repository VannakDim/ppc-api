@extends('admin.layouts.app')
@section('title', 'Member')


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
		<!-- Banner header -->
		<section class="content-header">
			<h1>
				Members
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ route('admin.dashboardRoute') }}"><i class="fa fa-home"></i> Dashboard</a></li>
				<li class="active">Members</li>
			</ol>
		</section>
		<!-- /.banner header -->	

		<!-- Main content -->
		<section class="content">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Manage Members</h3>

					<div class="box-tools">
						{{-- <button type="button" class="btn btn-info btn-sm btn-flat add-button"><i class="fa fa-plus"></i> Add Member</button> --}}
						<a href="{{ route('admin.members.create') }}" class="btn btn-info btn-sm btn-flat"><i class="fa fa-plus"></i> Add Member</a>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div style="width: 100%; padding-left: -10px;">
						<div class="table-responsive">
							<table id="members-table" class="table table-striped table-hover dt-responsive display nowrap" cellspacing="0">
								<thead>
									<tr>
										<th>Company</th>
										<th>Logo</th>
										<th>Owner from</th>
										<th>Type</th>
										<th>Workers</th>
										<th>Telephone</th>
										<th>Created By</th>
										<th width="50px">Action</th>
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

		<!-- delete banner modal -->
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
			<!-- /.delete banner modal -->
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


		/** Delete **/
		$("#members-table").on("click", ".delete-button", function(){
			var member_id = $(this).data("id");
			var url = "{{ route('admin.members.destroy', 'member_id') }}";
			url = url.replace("member_id", member_id);
			$('#delete-modal').modal('show');
			$('#delete_form').attr('action', url);
		});


		/** Get datatable **/
		function get_table_data(){
			$('#members-table').DataTable({
				dom: 'Blfrtip',
				buttons: [
				{ extend: 'copy', exportOptions: { columns: ':visible'}},
				{ extend: 'print', exportOptions: { columns: ':visible'}},
				{ extend: 'pdf', orientation: 'landscape', bannerSize: 'A4', exportOptions: { columns: ':visible'}},
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
				ajax: "{{ route('admin.getMembersRoute') }}",
				columns: [
				{data: 'company'},
				{data: 'company_logo'},
				{data: 'owner_from'},
				{data: 'type'},
				{data: 'number_of_worker'},
				{data: 'telephone'}, 
				{data: 'username', name: 'username', orderable: true, searchable: true},
				{data: 'action', name: 'action', orderable: false, searchable: false},
				],
				// order: [[0, 'desc']],
			});
		}

	</script>
@endsection