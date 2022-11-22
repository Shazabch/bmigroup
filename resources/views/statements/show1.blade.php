@extends('layouts.main')
@section('content')
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Account Statement</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Details</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection
<div class="row mt-2 p-2">
    <div class="col">
        <div class="card ">
            <div class="card-body ">
                <div class="row">
                    <div class="col">
                        <h5 class="font-weight-bolder mb-0">Statement Details</h5>
                    </div>
                    
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <b>Customer No.</b>
                        <p>{{$statements->customer_no}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>Company Name</b>
                        <p>{{$statements->user->name}}</p>
                    </div>
                    
                    <div class="col-md-6">
                        <b>Statement Doc</b>
                        <p>{{$statements->statement_doc}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>Statement Date</b>
                        <p>{{date_formatter($statements->statement_date)}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection