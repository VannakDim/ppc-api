@extends('admin.layouts.app')
@section('title', 'Post')


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
		MEMBERS
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
			<h3 class="box-title">Add Member</h3>

			<div class="box-tools">
				<a href="{{ route('admin.members.index') }}" class="btn btn-info btn-sm btn-flat"><i class="fa fa-list"></i> Manage Members</a>
			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<form name="post_add_form" class="form-horizontal" action="{{ route('admin.members.store') }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-group{{ $errors->has('post_title') ? ' has-error' : '' }}">
					<label for="company" class="col-md-2 control-label">Company</label>
					<div class="col-md-9">
						<input type="text" name="company" class="form-control" id="company" value="{{ old('company') }}" placeholder="ex: company title">
						@if ($errors->has('company'))
						<span class="help-block">
							<strong>{{ $errors->first('company') }}</strong>
						</span>
						@endif
					</div>
				</div>
				<div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
					<label for="post_slug" class="col-md-2 control-label">Telephone</label>
					<div class="col-md-9">
						<input type="text" name="telephone" class="form-control" id="telephone" value="{{ old('telephone') }}" placeholder="ex: telephone">
						@if ($errors->has('telephone'))
						<span class="help-block">
							<strong>{{ $errors->first('telephone') }}</strong>
						</span>
						@endif
					</div>
				</div>
				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<label for="post_slug" class="col-md-2 control-label">Email</label>
					<div class="col-md-9">
						<input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" placeholder="ex: your@email.com">
						@if ($errors->has('email'))
						<span class="help-block">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
						@endif
					</div>
				</div>

                {{-- Number of workers --}}
				<div class="form-group{{ $errors->has('number_of_worker') ? ' has-error' : '' }}">
					<label for="number_of_worker" class="col-md-2 control-label">Number of Workers</label>
					<div class="col-md-9">
						<input type="text" name="number_of_worker" class="form-control" id="number_of_worker" value="{{ old('number of worker') }}" placeholder="ex: 1000">
						@if ($errors->has('number_of_worker'))
						<span class="help-block">
							<strong>{{ $errors->first('number_of_worker') }}</strong>
						</span>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has('owner') ? ' has-error' : '' }}">
					<label for="owner" class="col-md-2 control-label">Owner from</label>
					<div class="col-md-5">
						<select name="country" class="form-control" id="country_id">
							<option value="" selected disabled>Select One</option>
							@foreach($countries as $country)
							<option value="{{ $country->id }}">{{ $country->country }}</option>
							@endforeach
						</select>
						@if ($errors->has('country_id'))
						<span class="help-block">
							<strong>{{ $errors->first('country_id') }}</strong>
						</span>
						@endif
					</div>
				</div>
				<div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">
					<label for="type_id" class="col-md-2 control-label">Process type</label>
					<div class="col-md-5">
						<select name="type" class="form-control" id="type_id">
							<option value="" selected disabled>Select One</option>
							@foreach($types as $type)
							<option value="{{ $type->id }}">{{ $type->title}}</option>
							@endforeach
						</select>
						@if ($errors->has('type_id'))
						<span class="help-block">
							<strong>{{ $errors->first('type_id') }}</strong>
						</span>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has('product') ? ' has-error' : '' }}">
					<label for="product" class="col-md-2 control-label">Produc</label>
					<div class="col-md-5">
						<select class="form-control select2-post-tag" name="products[]" multiple="multiple" id="product">
							<option disabled>Product</option>
							@foreach($products as $product)
							<option value="{{ $product->id }}">{{ $product->title }}</option>
							@endforeach
						</select>
						@if ($errors->has('product'))
						<span class="help-block">
							<strong>{{ $errors->first('product') }}</strong>
						</span>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has('member_image') ? ' has-error' : '' }}">
					<label for="member_image" class="col-md-2 control-label">Company logo</label>
					<div class="col-md-5">
						<input type="file" name="member_image" id="member_image" class="form-control">
						<p class="help-block">Example block-level help text here.</p>
						@if ($errors->has('member_image'))
						<span class="help-block">
							<strong>{{ $errors->first('member_image') }}</strong>
						</span>
						@endif
					</div>
				</div>

                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
					<label for="post_slug" class="col-md-2 control-label">Address</label>
					<div class="col-md-9">
						<input type="text" name="address" class="form-control" id="address" value="{{ old('address') }}" placeholder="ex: Address">
						@if ($errors->has('address'))
						<span class="help-block">
							<strong>{{ $errors->first('address') }}</strong>
						</span>
						@endif
					</div>
				</div>

                <div class="form-group{{ $errors->has('map') ? ' has-error' : '' }}">
					<label for="post_slug" class="col-md-2 control-label">Map</label>
					<div class="col-md-9">
						<input type="text" name="map" class="form-control" id="map" value="{{ old('map') }}" placeholder="ex: Map">
						@if ($errors->has('map'))
						<span class="help-block">
							<strong>{{ $errors->first('map') }}</strong>
						</span>
						@endif
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-offset-2 col-md-10">
						<button type="submit" class="btn btn-info btn-flat" {{ is_null(is_demo_admin()) ? '' : 'disabled'}}>Add Member</button>
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
	$(function () {
		var date = new Date();
		//date.setDate(date.getDate()-1);
        $('#post_date').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            startDate: date,
        });
        $('#post_date').datepicker('setDate', 'now');
	});
</script>
<script type="text/javascript">
	$(function(){
	$('.summernote').summernote({
		height: 200
	})
})
</script>
<script type="text/javascript">
	document.forms['post_add_form'].elements['category_id'].value = "{{ old('category_id') }}";
	document.forms['post_add_form'].elements['publication_status'].value = "{{ old('publication_status') }}";
</script>
@endsection