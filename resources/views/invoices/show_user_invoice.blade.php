@extends('layouts.main')
@section('content')
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Invoice</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Invoice Details</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection
<div class="row p-2">
    <div class="col m-2">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="font-weight-bolder mb-0">Invoice Details</h5>
                    </div>
                    
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <b>Customer Name</b>
                        <p>{{$invoice[0]->user->name}}</p>
                    </div>
                    <div class="col">
                        <b>Due Date</b>
                        <p>{{date_formatter($invoice[0]->date)}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <b>Invoice Document</b>
                        <p><a class="text-info" href="{{route('download_inv',$invoice[0]->id)}}">{{$invoice[0]->invoice_doc}}</a></p>
                    </div>
                    <div class="col">
                        <b>Amount (MYR)</b>
                        <p>{{number_format($invoice[0]->amount)}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection