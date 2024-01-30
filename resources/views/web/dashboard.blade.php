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
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
			</ul>
		</div>

		<div class="about-us">
		@if(auth()->user()->role_id==1)
			<div class="row">
				<div class="col-md-12">
					<h3 class="pull-left">Balance record</h3>
					<a href="{{ route('dashboard') }}" class="btn btn-primary pull-right btn-flat"><i class="fa fa-plus"></i> Add Record</a>
				</div>
			</div>
			<hr>
		@endif
		@if(auth()->user()->role_id>=1)	
			<div class="row">
				<div class="col-md-4 cus">	
					<div class="col-md-12">
						<div class="post-grid-style">
							<div class="post-detail">
								<h3 class="pull-left">Income</h3>
									<ul class="post-meta3">
									<h3>$ {{ number_format($income_usd,2) }}</h3>
									<h3>៛ {{ number_format($income_riel) }}</h3>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 cus">	
					<div class="col-md-12">
						<div class="post-grid-style">
							<div class="post-detail">
								<h3 class="pull-left">Expense</h3>
									<ul class="post-meta3">
									<h3>$ {{ number_format($expense_usd,2) }}</h3>
									<h3>៛ {{ number_format($expense_riel) }}</h3>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 cus">
					<div class="col-md-12">
						<div class="post-grid-style">
							<div class="post-detail">
								<h3 class="pull-left">Balance</h3>
									<ul class="post-meta3">
									<h3>$ {{ number_format($balance_usd,2) }}</h3>
									<h3>៛ {{ number_format($balance_riel) }}</h3>
								</ul>
							</div>
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