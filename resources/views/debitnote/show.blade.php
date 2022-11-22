@extends('layouts.main1')
@section('content')
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Debit Note</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">DN Details</li>
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
                        <h5 class="font-weight-bolder mb-0">DN Details</h5>
                    </div>
                    
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <b>Customer No.</b>
                        <p>{{$debitnotes->customer_no}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>Company Name</b>
                        <p>{{$debitnotes->user->name}}</p>
                    </div>
                    
                    <div class="col-md-6">
                        <b>DN No.</b>
                        <p>{{$debitnotes->dn_no}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>DN Date</b>
                        <p>{{date_formatter($debitnotes->dn_date)}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>Customer PO No.</b>
                        <p>{{$debitnotes->po_no}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>Reference No.</b>
                        <p>{{$debitnotes->ref_no ? $debitnotes->ref_no : '0' }}</p>
                    </div>
                    <div class="col-md-6">
                        <b>Amount</b>
                        <p>{{$debitnotes->amount}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>DN Document</b>
                        <p><a class="text-info">
                        {{$debitnotes->dn_doc}}</a></p>
                    </div>
                </div>
                @if($debitnotes->remarks)
                <div class="row">
                        <div class="col">
                            <b>Remarks</b>
                            <p>{{$debitnotes->remarks}}</p>
                        </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection