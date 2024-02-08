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
				<li>Dashboard</li>
			</ul>
		</div>

		@if(auth()->user()->role_id>=1)
		<div class="about-us">
			<div class="row">
				<div class="col-md-12">
					<h3 class="pull-left">Balance summary</h3>
					
				</div>
			</div>
			<hr>
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
									<a href="{{ route('detailIncome') }}" class="btn btn-success pull-left btn-flat">Income list</a>
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
								<a href="{{ route('detailExpense') }}" class="btn btn-danger pull-left btn-flat">Expense list</a>
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