@extends('web.layouts.app')
@section('title', 'Dashboard')


@section('style')
<style>
	.cus{
		padding-left:0;
	}
</style>
@endsection

@section('content')
<div class="col-md-8">
	<div class="home-news-block block-no-space">
		
		<div class="crumb inner-page-crumb">
			<ul>
				<li><i class="ti-home"></i><a href="/">Home</a> / </li>
				<li><a href="{{ route('dashboard') }}">Dashboard</a> / </li>
				<li>Add Expense</li>
			</ul>
		</div>

		<div class="about-us">
		@if(auth()->user()->role_id==1)
			<div class="row">
				<div class="col-md-12">
					<h3 class="pull-left">Add Expense</h3>
				</div>
				@if(Session::has('message'))
					<p class="alert alert-success">{{ Session::get('message') }}</p>
				@endif
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12">
					<div class="post-grid-style">
						<div class="post-detail">
							<form action="/expense" method="POST">
								{{ csrf_field() }}
								<div class="form-group">
									<label for="formGroupExampleInput">Expense Title</label>
									<input type="text" name="title" class="form-control  @error('title') is-invalid @enderror"  id="tiitle" placeholder="Expense title" required autocomplete="title" autofocus>
								
									@error('title')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								
								<div class="form-group">
									<label for="formGroupExampleInput">Dollar</label>
									<input type="number" name="usd" class="form-control  @error('usd') is-invalid @enderror" id="usd" placeholder="$" required autocomplete="usd">
									@error('usd')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								
								<div class="form-group">
									<label for="formGroupExampleInput">Riel</label>
									<input type="number" name="riel" class="form-control  @error('riel') is-invalid @enderror" id="riel" placeholder="៛" required autocomplete="riel">
									@error('riel')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								
								<div class="form-group">
									<label for="formGroupExampleInput">Description</label>
									<textarea type="text" name="description" class="form-control  @error('description') is-invalid @enderror" id="description" placeholder="Description" rows="5"  required autocomplete="description"></textarea>
									@error('description')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>

								<div class="row">
									<div class="col-md-12">
										<p style="display: inline;">សូមពិនិត្យផ្ទៀងផ្ទាត់មើលទិន្នន័យ</p>
										<button type="submit" class="btn btn-primary pull-right">Add expense</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row postgrid-horiz grid-style-2">
			{{-- {{ $comments->links() }} --}}
		</div>
		@endif
	</div>
</div>
@endsection

@section('sidebar')
@include('web.includes.user_sidebar')
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
@endsection