@extends('layouts.main1')
@section('content')
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid ">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Payments</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Single Payment</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection
<div class="row mt-2 p-2">
    <div class="col m-2">
        <div class="card mt-2">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="font-weight-bolder mb-0">Payment Details</h5>
                    </div>
                    
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <b>Customer No.</b>
                        <p>{{$payment->user->customer_no}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>Company Name</b>
                        <p>{{$payment->user->name}}</p>
                    </div>
                    
                    <div class="col-md-6">
                        <b>Invocie No.</b>
                        <p>{!! preg_replace("/,/", '</br>', ($payment->user_invoices)) !!}</p>
                    </div>
                    <div class="col-md-6">
                        <b>Invoice Doc</b>
                        <p>{!! preg_replace("/,/", '</br>', ($payment->invoice_doc)) !!}</p>
                    </div>
                    <div class="col-md-6">
                        <b>Amount</b>
                        <p>{{$payment->amount}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>Status</b>
                        <p><span class="badge badge-sm {{$payment->status == 0 ? 'badge-secondary' : 'badge-success'}}">{{$payment->status == 0 ? 'PENDING ACKNOWLEDGEMENT' : 'ACKNOWLEDGED'}}</span></p>
                    </div>
                
                    <div class="col-md-6">
                        <b>Proof Document</b>
                        <p><a style="color:#009fe3;" href="{{route('payments.download',$payment->id)}}">
                            {{$payment->proof}}</a></p>
                    </div>
                    <div class="col-md-6">
                        <b>Payment Date</b>
                        <p>{{date_formatter($payment->payment_date)}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection