@extends('layouts.main')
@section('content')
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid ">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Customer</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Credit Note</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">CN Details</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection
<div class="row p-2 mt-2">
    <div class="col">
        <div class="card ">
            <div class="card-body ">
                <div class="row">
                    <div class="col">
                        <h5 class="font-weight-bolder mb-0">CN Details</h5>
                    </div>
                    
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <b>Customer Name</b>
                        <p>{{$creditnotes->user->name}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>Customer No.</b>
                        <p>{{$creditnotes->customer_no}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>Customer PO No.</b>
                        <p>{{$creditnotes->po_no}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>Amount (MYR)</b>
                        <p>{{$creditnotes->amount}}</p>
                    </div>
                    
                    <div class="col-md-6">
                        <b>CN No.</b>
                        <p>{{$creditnotes->cn_no}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>Reference No.</b>
                        <p>{{$creditnotes->ref_no}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>CN Date</b>
                        <p>{{date_formatter($creditnotes->cn_date)}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>CN Document</b>
                        <p><a class="text-info" href="{{route('download_cn',$creditnotes->id)}}">
                        {{$creditnotes->cn_doc}}</a></p>
                    </div>
                </div>
                @if($creditnotes->remarks)
                <div class="row">
                        <div class="col">
                            <b>Remarks</b>
                            <p>{{$creditnotes->remarks}}</p>
                        </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection