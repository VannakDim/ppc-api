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
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12">
					<div class="post-grid-style">
						<div class="post-detail">
							<form action="">
								<div class="form-group">
									<label for="formGroupExampleInput">Expense Title</label>
									<input type="text" class="form-control" id="formGroupExampleInput" placeholder="Income title">
								</div>
								
								<div class="form-group">
									<label for="formGroupExampleInput">Dollar</label>
									<input type="number" class="form-control" id="formGroupExampleInput" placeholder="$">
								</div>
								
								<div class="form-group">
									<label for="formGroupExampleInput">Riel</label>
									<input type="number" class="form-control" id="formGroupExampleInput" placeholder="៛">
								</div>
								
								<div class="form-group">
									<label for="formGroupExampleInput">Description</label>
									<textarea type="text" class="form-control" id="formGroupExampleInput" placeholder="Description" rows="5"></textarea>
								</div>

								<div class="row">
									<div class="col-md-12">
										<p style="display: inline;">សូមពិនិត្យផ្ទៀងផ្ទាត់មើលទិន្នន័យ មុនពេលចុចលើប៊ូតុង Add expense</p>
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