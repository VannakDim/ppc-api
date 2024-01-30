@extends('admin.layouts.app')
@section('title', 'Add resource')


@section('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('admin/css/bootstrap-datepicker.min.css') }}">
<style type="text/css">
.modal-body {
    position: relative;
    padding: 25px;
}
.modal-content {
    position: relative;
    background-color: #fff;
    border: 1px solid #999;
    border: 1px solid rgba(0,0,0,.2);
    border-radius: 6px;
    -webkit-box-shadow: 0 3px 9px rgba(0,0,0,.5);
    box-shadow: 0 3px 9px rgba(0,0,0,.5);
    background-clip: padding-box;
    outline: 0;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice {
	background-color: #3c8dbc ;
	border: 1px solid #367fa9;
	border-radius: 4px;
	cursor: default;
	float: left;
	margin-right: 5px;
	margin-top: 5px;
	padding: 0 5px;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
	color: black;
	cursor: pointer;
	display: inline-block;
	font-weight: bold;
	margin-right: 4px;
}
</style>
@endsection

@section('content')
<!-- Page header -->

<section class="content-header">
	<h1>
		RESOURCES
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('admin.dashboardRoute') }}"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="{{ route('admin.members.index') }}">Members</a></li>
		<li class="active">Add Member</li>
	</ol>
</section>
<!-- /.page header -->

<!-- Main content -->
<section class="content">
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Add Resource</h3>

			<div class="box-tools">
				<a href="{{ route('admin.resources.index') }}" class="btn btn-info btn-sm btn-flat"><i class="fa fa-list"></i> Manage Resource</a>
			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<form name="resource_add_form" class="form-horizontal" action="{{ route('admin.resources.store') }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-group{{ $errors->has('post_title') ? ' has-error' : '' }}">
					<label for="title" class="col-md-2 control-label">Title</label>
					<div class="col-md-9">
						<input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}" placeholder="ex: title">
						@if ($errors->has('title'))
						<span class="help-block">
							<strong>{{ $errors->first('title') }}</strong>
						</span>
						@endif
					</div>
				</div>
				<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
					<label for="post_slug" class="col-md-2 control-label">Description</label>
					<div class="col-md-9">
						<input type="text" name="description" class="form-control" id="description" value="{{ old('description') }}" placeholder="ex: description">
						@if ($errors->has('description'))
						<span class="help-block">
							<strong>{{ $errors->first('description') }}</strong>
						</span>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has('resource_file') ? ' has-error' : '' }}">
					<label for="resource_file" class="col-md-2 control-label">File</label>
					<div class="col-md-5">
						<input type="file" name="resource_file" id="resource_file" class="form-control">
						<p class="help-block">This is the public resource.</p>
						@if ($errors->has('resource_file'))
						<span class="help-block">
							<strong>{{ $errors->first('resource_file') }}</strong>
						</span>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has('thumbnail') ? ' has-error' : '' }}">
					<label for="thumbnail" class="col-md-2 control-label">Thumbnail</label>
					<div class="col-md-5">
						<input type="file" name="thumbnail" id="thumbnail" class="form-control">
						<p class="help-block">Image of your resource.</p>
						@if ($errors->has('thumbnail'))
						<span class="help-block">
							<strong>{{ $errors->first('thumbnail') }}</strong>
						</span>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has('publication_status') ? ' has-error' : '' }}">
					<label for="publication_status" class="col-md-2 control-label">Publication Status</label>
					<div class="col-md-5">
						<select name="publication_status" class="form-control" id="publication_status">
							<option value="" selected disabled>Select One</option>
							<option value="1">Published</option>
							<option value="0">Unpublished</option>
						</select>
						@if ($errors->has('publication_status'))
						<span class="help-block">
							<strong>{{ $errors->first('publication_status') }}</strong>
						</span>
						@endif
					</div>
				</div>

				{{-- Button Save --}}
				<div class="form-group">
					<div class="col-md-offset-2 col-md-10">
						<button type="submit" class="btn btn-info btn-flat" {{ is_null(is_demo_admin()) ? '' : 'disabled'}}>Add resource</button>
					</div>
				</div>
			</form>
		</div>
		<!-- /.box-body -->
		<div class="box-footer clearfix">
		</div>
	</div>
</section>
<!-- /.main content -->
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.select2-post-tag').select2();
	});
</script>
<script type="text/javascript" src="{{ asset('admin/js/bootstrap-datepicker.min.js') }}"></script>

<script type="text/javascript">
	document.forms['resource_add_form'].elements['publication_status'].value = "{{ old('publication_status') }}";
</script>
@endsection