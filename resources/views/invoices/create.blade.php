@extends('layouts.main1')
@section('content')
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0  shadow-none border-radius-xl">
   <div class="container-fluid">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Invoices</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Add Invoice</li>
        </ol>
    </nav>
   </div>
</nav>

@endsection
<div class="container-fluid p-2">
   <div class="row ">
    <div class="col-12 col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="font-weight-bolder mb-0">Add invoice</h5>
            <hr class="horizontal dark mt-2">
            <!-- invoice add form started here  -->
            <form action="{{route('invoices.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
            <!-- company and name fields  -->
       
                <div class="row ">
                   <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="customer">Company Name</label>
                            <select id="user_id" name="user_id" class="form-control multi-select">
                                <option value=""></option>
                                @foreach($users as $user)
                                 <option {{old('user_id') == $user->id ? 'selected' : ''}}  value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('user_id') {{$message}} @enderror</span>
                        </div>
                    </div>
                    
                     <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Customer No. <span class="text-danger">*</span></label>
                            <input value="{{old('customer_no')}}" type="text" id="customer_no" class="form-control" name="customer_no" required>
                            <span class="text-danger">@error('customer_no') {{$message}} @enderror</span>

                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Customer PO No. <span class="text-danger">*</span></label>
                            <input value="{{old('po_no')}}" type="text" id="po_no" class="form-control" name="po_no" required>
                            <span class="text-danger">@error('po_no') {{$message}} @enderror</span>

                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Invoice No. <span class="text-danger">*</span></label>
                            <input value="{{old('invoiceId')}}" type="text" class="form-control" name="invoiceId" required>
                            <span class="text-danger">@error('invoiceId') {{$message}} @enderror</span>

                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Delivery Order No. </label>
                            <input value="{{old('do_no')}}" type="text" class="form-control" name="do_no" >
                            <span class="text-danger">@error('do_no') {{$message}} @enderror</span>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Invoice Date <span class="text-danger">*</span></label>
                            <input id="invoiceDate" value="{{old('invoice_date')}}"  type="date" class="form-control" name="invoice_date" required>
                            <span class="text-danger">@error('invoice_date') {{$message}} @enderror</span>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Due Date <span class="text-danger">*</span></label>
                            <input  id="dueDate" value="{{old('date')}}" type="date" class="form-control" name="date" required>
                            <span class="text-danger">@error('date') {{$message}} @enderror</span>

                        </div>
                    </div>
                         <!-- email and invoice fields  -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="invoice_doc">Invoice Document <span class="text-danger">*</span></label>
                            <input type="file" value="{{old('file')}}" class="form-control" name="file" required accept=".pdf,.doc,.xlsx,.docx">
                            <span   class="text-danger text-sm ">@error('file') {{$message}} @enderror</span>

                        </div>
                    </div>
                <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="amount">Amount (MYR) <span class="text-danger">*</span></label>
                            <input id="amount" type="amount" 
                            value="{{old('amount')}}"
                            class="form-control" 
                            name="amount" required>
                            <span   class="text-danger text-sm ">@error('amount') {{$message}} @enderror</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="remarks">Remarks</label>
                        <textarea  class="form-control" name="remarks">{{old('remarks')}}</textarea>
                    </div>
                </div>
            <!-- amount and invoice ends  -->
                
            <!-- Add  Button  -->
                <div class="button-row d-flex mt-2 ">
                    <button class="btn bg-gradient-info ms-auto mb-0 js-btn-next" 
                    type="submit">Add invoice</button>
                </div>
            </form>
        </div>
    </div>
    </div>
   </div>
</div>
@endsection
@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
     $(".multi-select").select2();
     $(".selection").addClass('form-select');
     $(".selection").css("padding","6px");
     $(".select2-selection").addClass('form-select');
     $(".select2-selection").css({"border":"none", "padding":"0px"});
</script>
<script>
function getLastDayOfMonth(year, month) {
  return new Date(year, month + 1, 0);
}
$(document).ready(function(){ 
    $('#invoiceDate').change(function() {
        invoiceDate = new Date($('#invoiceDate').val());
        output_f=new Date(invoiceDate.setDate(invoiceDate.getDate()+60)).toISOString().split('.');
        output_s = output_f[0].split('T');
        const date = new Date(output_s[0]);
        const lastDayCurrentMonth = getLastDayOfMonth(
          date.getFullYear(),
          date.getMonth(),
        );
        output_n = new Date(lastDayCurrentMonth).toISOString().split('.');
        outputn1 = output_n[0].split('T');
        $('#dueDate').val(outputn1[0]);
    });
});
</script>
@endsection