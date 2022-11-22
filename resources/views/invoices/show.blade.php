    @extends('layouts.main1')
@section('content')
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
    <div class="container-fluid ">
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
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="font-weight-bolder mb-0">Invoice Details</h5>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <b>Company Name</b>
                        <p>{{$invoice->user->name}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>Customer No.</b>
                        <p>{{$invoice->customer_no}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>PO No.</b>
                        <p>{{$invoice->po_no ? $invoice->po_no : 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <b>Invoice Date</b>
                        <p>{{$invoice->invoice_date ? date_formatter($invoice->invoice_date) : 'null'}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>Due Date</b>
                        <p>{{$invoice->date ? date_formatter($invoice->date) : 'null'}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>{{__('labels.invoice_no')}}</b>
                        <p>{{$invoice->invoiceId}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>{{__('labels.do_no')}}</b>
                        <p><a class="" >
                                {{$invoice->do_no ? $invoice->do_no : 'N/A' }}
                            </a></p>
                    </div>
                    <div class="col-md-6">
                        <b>Invoice Doc</b>
                        <p><a href="{{route('invoices.download',$invoice->id)}}" class="text-info" type="submit">{{$invoice->invoice_doc}}</a></p>
                    </div>
                    <div class="col-md-6">
                        <b>Amount (MYR)</b>
                        <p>{{number_format($invoice->amount,2)}}</p>
                    </div>
                </div>
                @if($invoice->remarks)
                <div class="row">
                        <div class="col-md-6">
                            <b>Remarks</b>
                            <p>{{$invoice->remarks}}</p>
                        </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endsection