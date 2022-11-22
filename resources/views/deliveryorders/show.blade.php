@extends('layouts.main1')
@section('content')
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid ">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Delivery Order</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Delivery Order Details</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection
<div class="row p-2 mt-2">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="font-weight-bolder mb-0">DO Details</h5>
                    </div>
                    
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <b>Invoice No.</b>
                        <p>{{$deliveryOrder->invoice->invoiceId}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>Company Name</b>
                        <p>{{$deliveryOrder->user->name}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>DO No.</b>
                        <p>{{$deliveryOrder->do_no}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>DO Doc</b>
                        <p><a class="text-info"
                        href="{{route('deliveryOrder.download',$deliveryOrder->id)}}">
                        {{$deliveryOrder->do_doc}}</a></p>
                    </div>
                </div>
               @if($deliveryOrder->remarks)
                <div class="row">
                        <div class="col">
                            <b>Remarks</b>
                            <p>{{$deliveryOrder->remarks}}</p>
                        </div>
                </div>
               @endif
            </div>
        </div>
    </div>
</div>
@endsection