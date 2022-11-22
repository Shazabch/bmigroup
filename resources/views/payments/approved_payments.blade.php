@extends('layouts.main1')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('/css/pagination_style.css') }}" />
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Customer</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Payments</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Paid Invoices</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection
<div class="card p-2 mt-2">
    <div class="accordion" id="accordionExample">
      <div class="accordion-item">
          <button name="searchFilter" class="collapsed btn bg-gradient-info ms-auto mb-3 mt-4 js-btn-next mt-3 filter-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fa fa-filter"></i>
            Filter
          </button>
          <a href="{{route('invoices.excel_user')}}">
            <button name="exportFilter" 
          class=" btn bg-gradient-dark ms-auto mb-3 mt-4 js-btn-next mt-3 filter-btn" 
          type="button">
            Export
          </button>
        </a>
        <div id="collapseOne" class="accordion-collapse collapse filter-border" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <form id="form1" action="{{route('payments.approved')}}" enctype="multipart/form-data" method="POST">
              @csrf
          <div class="accordion-body row">
              <div class="col-md-4">
                    <div class="input-group mb-4">
                      <span class="input-group-text"><i class="fa fa-search text-secondary"></i></span>
                      <input type="text" name="user_invoices" class="form-control" placeholder="Invoice No">
                    </div>
                    <div class="input-group mb-4">
                         <span class="input-group-text"><i class="fa fa-search text-secondary"></i></span>
                         <input type="text" name="reference_id" class="form-control" placeholder="Reference/Cheque No."> 
                    </div>
                
            </div>
            <div class="col-md-2">
                &nbsp;
            </div>
            <div class="col-md-2">
                 <p class="text-dark">Payment Date : </p> <br>
            </div>
            
            <div class="col-md-4" style="float:right;">
                <input class="form-control" name="payment_date" type="date" placeholder="Invoice Date">  <br>
                <button style="float:right;"  class="btn bg-gradient-info ms-auto mb-0  js-btn-next" type="submit">Apply</button>
            </div>
            
        </div>
                <hr class="horizontal dark mb-0 mt-0">
                <hr class="horizontal dark mb-0 mt-0">
          </form>
        </div>
      </div>
    </div>
  <div class="table-responsive">
    <div class="dataTable-wrapper dataTable-loading no-footer sortable fixed-height fixed-columns">
      <div class="dataTable-top">
        <table class="table align-items-center mb-0">
          <thead>
            <tr>
              <!-- <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">ID</th> -->
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
               <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer No.</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Company Name</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Invoice No.</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount (MYR)</th>
              <!--<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Due Date</th>-->
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Payment Date</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Proof Of Payment</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Reference No.</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Invoice Doc</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">DO DOC</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">DN DOC</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CN DOC</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($payments as $payment)
            <tr>
                <td class="text-center ">
                    <a href="{{route('payment.show1',$payment->id)}}"><i class="fa fa-eye text-dark" title="View Payment" aria-hidden="true"></i></a>
                     <a class="dropdown-item" href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('delete-form').submit(); "><i class="fa fa-bitbucket text-danger" aria-hidden="true"></i></a>
                      <form id="delete-form" action="{{route('payment.destroy',$payment->id)}}" method="post">
                            @csrf
                            @method('delete')
                      </form>
                </td>
                <td>
                <div class="d-flex px-2 py-1 text-center">
                    <p class="text-xs text-secondary text-center mb-0">
                      {{$payment->user->customer_no}}
                    </p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex px-2 py-1 text-center">
                    <p class="text-xs text-secondary text-center mb-0">
                      {{$payment->user->name}}
                    </p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex px-2 py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <p class="text-xs text-secondary mb-0">
                     {!! preg_replace("/,/", '</br>', ($payment->user_invoices)) !!}
                    </p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex px-2 py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <p class="text-xs text-secondary mb-0">{{number_format($payment->amount , 2)}}</p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex px-2 py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <p class="text-xs text-secondary mb-0">{{date_formatter($payment->payment_date)}}</p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex px-2 py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <p class="text-xs text-secondary mb-0">{{$payment->proof}}</p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex px-2 py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <p class="text-xs text-secondary mb-0">{{$payment->reference_id}}</p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex px-2 py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <p class="text-xs text-secondary mb-0">{!! preg_replace("/,/", '</br>', ($payment->invoice_doc)) !!}</p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex px-2 py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <p class="text-xs text-secondary mb-0"></p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex px-2 py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <p class="text-xs text-secondary mb-0"></p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex px-2 py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <p class="text-xs text-secondary mb-0"></p>
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