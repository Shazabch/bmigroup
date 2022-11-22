@extends('layouts.main')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('/css/pagination_style.css') }}" />
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid ">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Customer</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Invoices</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">All Invoices</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection

<div class="card card-body">
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
            <form id="form1" action="{{route('user_invoices')}}" enctype="multipart/form-data" method="POST">
              @csrf
          <div class="accordion-body row">
              <div class="col-md-4">
                    <div class="input-group mb-4">
                      <span class="input-group-text"><i class="fa fa-search text-secondary"></i></span>
                      <input type="text" name="invoiceId" class="form-control" placeholder="Invoice No">
                    </div>
                    <div class="input-group mb-4">
                         <span class="input-group-text"><i class="fa fa-search text-secondary"></i></span>
                         <input type="text" name="do_no" class="form-control" placeholder="Delivery Order No."> 
                    </div>
                
            </div>
            <div class="col-md-2">
                &nbsp;
            </div>
            <div class="col-md-2">
                 <p class="text-dark">Invoice Date : </p> <br>
                 <p class="text-dark">Due Date : </p> <br>
                 <p class="text-dark">Date From : </p> <br>
                 <p class="text-dark">Date To : </p> 
            </div>
            
            <div class="col-md-4" style="float:right;">
                <input class="form-control" name="invoice_date" type="date" placeholder="Invoice Date">  <br>
                <input class="form-control" name="date" type="date" placeholder="Due Date"> <br>
                <input class="form-control" name="from" type="date" placeholder="Due Date"> <br>
                <input class="form-control" name="to" type="date" placeholder="Due Date"> <br>
                <button style="float:right;"  class="btn bg-gradient-info ms-auto mb-0  js-btn-next" type="submit">Apply</button>
            </div>
            
        </div>
                <hr class="horizontal dark mb-0 mt-0">
                <hr class="horizontal dark mb-0 mt-0">
          </form>
        </div>
      </div>
    </div>
    <form action="{{route('payments.store2')}}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="row">
        <div class="col">
            <h4 class="m-4">Payment Records</h4>
            <hr class="horizontal dark mb-0 mt-0">
        </div>
    </div>
    <div class="row m-4">
            <div class="col-md-4">
                <label>Total Amount Paid (MYR) <span class="text-danger">*</span></label>
                <input type="text" id="amount" class="form-control" name="amount"  required>
                 <span class="text-danger">@error('amount') {{$message}} @enderror</span>
            </div>
            <div class="col-md-4">
                <label>Proof of Payment <span class="text-danger">*</span></label>
                <input type="file" class="form-control" name="proof" required>
                 <span class="text-danger">@error('proof') {{$message}} @enderror</span>
            </div>
            <div class="col-md-4">
                <label>Date of payment <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="payment_date" required>
                 <span class="text-danger">@error('payment_date') {{$message}} @enderror</span>
            </div>
            <div class="col-md-4 mt-2">
                <label>Reference No./ Cheque No. <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="reference_id" required>
                 <span class="text-danger">@error('reference_id') {{$message}} @enderror</span>
            </div>
            <div class="col-md-4 mt-2">
                <label>&nbsp;</label>
                <button class="btn bg-gradient-info mt-4">Submit</button>
            </div>
    </div>
        <hr class="horizontal dark mb-0 mt-0">
        <hr class="horizontal dark mb-0 mt-0">
  <div class="table-responsive">
    <div class="dataTable-wrapper dataTable-loading no-footer sortable fixed-height fixed-columns">
      <div class="dataTable-top">
        
        <table class="table align-items-center mb-0">
            <b>kindly select all invoices included in this payment record.</b> 
            <span class="text-danger">@error('checkbox') No invoice selected ! @enderror</span>
            <br> <br>
            
          <thead class="mt-2">
            <tr>
              <th class="text-secondary opacity-7">Actions</th>
              <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Select</th>
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
              <td class="align-middle">
                   &nbsp;  &nbsp;  &nbsp; <a  class="dropdown-item" href="{{route('show_user_invoice',$invoice->id)}}"><i  class="fa fa-eye text-info" aria-hidden="true"></i></a> 
                   <!--&nbsp; <a class="dropdown-item" href="{{route('payments.create1',$invoice->id)}}"><i title="Add Payment" class="fa fa-plus text-success" aria-hidden="true"></i></a> -->
              </td>
                <td>
                    <p class="text-xs font-weight-bold mb-0 text-center">
                        <input type="checkbox" name="checkbox[]" value="{{$invoice->id}}" >
                    </p>
                </td>
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
      <div class="dataTable-bottom">
        <div class="dataTable-pagination">
            <ul class="dataTable-pagination-list m-4">
              <li>{{$invoices->links()}}</li>
            </ul>
        </div>
      </div>
    </div>
  </div>
    </form>
</div>
@endsection
<script>
//   function thousandSeparator(num) {
//             var val = num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
//             $('#amount').val(val);
//         }
</script>