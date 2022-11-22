@extends('layouts.main')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('/css/pagination_style.css') }}" />
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Customer</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Payments</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{__('labels.payments_all')}}</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection
<div class="card p-2 mt-2">
  <div class="table-responsive">
    <div class="dataTable-wrapper dataTable-loading no-footer sortable fixed-height fixed-columns">
      <div class="dataTable-top">
        <table class="table align-items-center mb-0">
          <thead>
            <tr>
              <!-- <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">ID</th> -->
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Actions</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Reference No.</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Invoice No.</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Invoice Doc</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount Paid</th>
              <!--<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Due Date</th>-->
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Payment Date</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Proof Of Payment</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($payments as $payment)
            <tr>
                <td class="text-center">
                    <a href="{{route('payment.show',$payment->id)}}"><i class="fa fa-eye text-info" title="View Payment" aria-hidden="true"></i></a>
                </td>
              <td class="text-center">
                <div class="d-flex px-2 py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <p class="text-xs text-secondary mb-0">
                      {{$payment->reference_id}}
                    </p>
                  </div>
                </div>
              </td>
              
              <td class="text-center">
                <div class="d-flex px-2 py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <p class="text-xs text-secondary mb-0">
                      {!! preg_replace("/,/", '</br>', ($payment->user_invoices)) !!}
                    </p>
                  </div>
                </div>
              </td>
               
              <td class="text-center">
                <div class="d-flex px-2 py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <p class="text-xs text-secondary mb-0">{!! preg_replace("/,/", '</br>', ($payment->invoice_doc)) !!}</p>
                  </div>
                </div>
              </td>
              <td class="text-center">
                <div class="d-flex px-2 py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <p class="text-xs text-secondary mb-0">{{$payment->amount}}</p>
                  </div>
                </div>
              </td>
              <td class="text-center">
                <div class="d-flex px-2 py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <p class="text-xs text-secondary mb-0">{{date_formatter($payment->payment_date)}}</p>
                  </div>
                </div>
              </td>
              <td class="text-center">
                <div class="d-flex px-2 py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <p class="text-xs text-secondary mb-0"><a style="color:#009fe3;" href="{{route('payments.download',$payment->id)}}">
                            {{$payment->proof}}</a></p>
                  </div>
                </div>
              </td>
              <td class="align-middle text-center">
              <span class="badge badge-sm {{$payment->status == 0 ? 'badge-secondary' : 'badge-success'}}">{{$payment->status == 0 ? 'PENDING ACKNOWLEDGEMENT' : 'ACKNOWLEDGED'}}</span>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="dataTable-bottom">
        <div class="dataTable-pagination">
            <ul class="dataTable-pagination-list m-4">
              <li>{{$payments->links()}}</li>
            </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection