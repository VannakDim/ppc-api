@extends('web.layouts.app')

@section('title', 'Expense')
@section('keywords', 'Expense')
@section('description', 'Expense information')

@section('style')
<style>
	.cus{
		/* background: rgb(188, 188, 200); */
		display: flex;
		justify-content: space-between;
		align-items: center;
	}
</style>
@endsection

@section('content')
<div class="col-md-8">
	<div class="crumb inner-page-crumb">
		<ul>
			<li><i class="ti-home"></i><a href="/">Home</a> / </li>
			<li><a class="active" href="/expense">Expense</a></li>
		</ul>
	</div>
	<div class="about-us">
		@if(auth()->user()->role_id==1)
			<div class="row">
				<div class="col-md-12 cus">
					{{-- <h3>Income list</h3>
					<a>+ Income</a> --}}
					<div class="top"><h3>Expense list</h3></div>
					<div class="bottom"><a href="{{ route('addExpense') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Expense</a></div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12">
					<div class="post-grid-style">
						<div class="post-detail">
							<!-- /.box-header -->
		<div class="box-body">
			<div style="width: 100%; padding-left: -10px;">
				<div class="table-responsive">
					<table id="posts-table" class="table table-striped table-hover dt-responsive display nowrap" cellspacing="0">
						<thead>
							<tr>
								<th>Date</th>
								<th>Title</th>
								<th>USD</th>
								<th>RIEL</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
                            @foreach ($expense as $item)
                            <tr>
                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                <td>{{ $item->title }}</td>
                                <td>${{ number_format($item->usd, 2) }}</td>
                                <td>{{ number_format($item->riel) }}</td>
                                <td>{{ $item->description }}</td>
                                {{-- <td>
                                    <a href="" class="btn btn-primary btn-sm">Edit</a>
                                </td>
                                <td>
                                    <a href="" class="btn btn-danger btn-sm">Delete</a>
                                </td> --}}
                            </tr>
                            @endforeach
                        </tbody>
					</table>
					<div class="d-flex">
						{!! $expense->links() !!}
					</div>
				</div>
			</div>
		</div>
		<!-- /.box-body -->
		<div class="box-footer clearfix">
		</div>
						</div>
					</div>
				</div>
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