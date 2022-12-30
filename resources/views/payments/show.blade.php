@extends('layouts.main')
@section('content')
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid ">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Customer</a></li>
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
                        <b>Amount</b>
                        <p>{{convert_currency($payment->amount)}}</p>
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
<div class="row mt-2 p-2">
    <div class="col m-2">
        <div class="card mt-2">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="font-weight-bolder mb-0">Invoices Involved</h5>
                    </div>
                    <div class="table-responsive">
    <div class="dataTable-wrapper dataTable-loading no-footer sortable fixed-height fixed-columns">
      <div class="dataTable-top">
        
        <table class="table align-items-center mb-0">
            
          <thead class="mt-2">
            <tr>
              <!--<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer Name</th>-->
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Due Date</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Invoice No.</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Do No.</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount (MYR)</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Outstanding (MYR)</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Invoice Doc</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Do Doc</th>
              <!--<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created at</th>-->
            </tr>
          </thead>
          <tbody>
            @foreach($invoices as $invoice)
            <tr>
                <td>
                    <p class="text-xs text-secondary mb-0 text-center">{{date_formatter($invoice->date)}}</p>
              </td>
              <!--<td>-->
              <!--  <div class="d-flex px-2 py-1">-->
              <!--    <div class="d-flex flex-column justify-content-center">-->
              <!--      <p class="text-xs text-secondary mb-0">{{$invoice->user->name}}</p>-->
              <!--    </div>-->
              <!--  </div>-->
              <!--</td>-->
              <td>
                    <p class="text-xs text-secondary mb-0 text-center">{{$invoice->invoiceId}}</p>
              </td>
               <td>
                    <p class="text-xs text-secondary mb-0 text-center">{{$invoice->do_no}}</p>
              </td>
              <td>
                    <p class="text-xs text-secondary mb-0 text-center">{{number_format($invoice->amount,2)}}</p>
              </td>
              <td>
              <p class="text-xs text-secondary mb-0 text-center">{{number_format($invoice->outstanding,2)}}</p>
              </td>
              <td>
                    <p class="text-xs text-secondary mb-0 text-center"><a class="text-info" href="{{route('download_inv',$invoice->id)}}">{{$invoice->invoice_doc}}</a></p>
              </td>
             
              <!--<td class="align-middle text-center">-->
              <!--  <span class="text-secondary text-xs font-weight-bold">{{$invoice->created_at ?  $invoice->created_at->diffForHumans() : 'N/A'}}</span>-->
              <!--</td>-->
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection