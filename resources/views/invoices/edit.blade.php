@extends('layouts.main1')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('/css/pagination_style.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('/css/filter_style.css') }}" />
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl">
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
            <h5 class="font-weight-bolder mb-0">Edit invoice</h5>
            </p>
            <hr class="horizontal dark mt-2">
            <!-- invoice add form started here  -->
            <form action="{{route('invoices.update',$invoice->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
            <!-- company and name fields  -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="customer">Company Name</label>
                            <select name="user_id" class="form-control multi-select">
                                <option value=""></option>
                                @foreach($users as $user)
                                 <option value="{{$user->id}}"  @if($invoice->user_id == $user->id) selected @endif>{{$user->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('user_id') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="invocieId">Customer No.</label>
                            <input type="text" value="{{$invoice->customer_no}}" class="form-control" name="customer_no" required>
                            <span class="text-danger">@error('customer_no') {{$message}} @enderror</span>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="invocieId">Customer PO No.</label>
                            <input type="text" value="{{$invoice->po_no}}" class="form-control" name="po_no" required>
                            <span class="text-danger">@error('po_no') {{$message}} @enderror</span>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="invocieId">Invoice No.</label>
                            <input type="text" value="{{$invoice->invoiceId}}" class="form-control" name="invoiceId" required>
                            <span class="text-danger">@error('invoiceId') {{$message}} @enderror</span>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="do_no">Delivery Order No.</label>
                            <input type="text" value="{{$invoice->do_no}}" class="form-control" name="do_no" required>
                            <span class="text-danger">@error('do_no') {{$message}} @enderror</span>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">{{__('labels.invoice_date')}}</label>
                            <input id="invoiceDate" value="{{$invoice->invoice_date ? date_formatter($invoice->invoice_date) : ''}}"  type="date" class="form-control" name="invoice_date" required>
                            <span class="text-danger">@error('invoice_date') {{$message}} @enderror</span>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">{{__('labels.due_date')}}</label>
                            <input id="dueDate" type="date" value="{{$invoice->date ? date_formatter($invoice->date) : ''}}" class="form-control" name="date" required>
                            <span class="text-danger">@error('date') {{$message}} @enderror</span>

                        </div>
                    </div>
            <!-- email and invoice fields  -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="invoice_doc">{{__('labels.invoice_doc')}}</label>
                            <input type="file" class="form-control file" value="{{$invoice->invoice_doc}}" name="file" required accept=".pdf,.doc,.xlsx,.docx">
                            <span id="file_prepopulate"></span>
                            <span   class="text-danger text-sm ">@error('file') {{$message}} @enderror</span>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="amount">{{__('labels.amount')}}</label>
                            <input type="amount" 
                            class="form-control" 
                            value="{{$invoice->amount}}"
                            name="amount" required>
                            <small  class="txet-small">@error('amount') {{$message}} @enderror</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                   <div class="col">
                       <label for="remarks">Remarks</label>
                        <textarea class="form-control" name="remarks">{{$invoice->remarks}}</textarea>
                   </div>
                </div>
            <!-- amount and invoice ends  -->
                
            <!-- Add  Button  -->
                <div class="button-row d-flex mt-2">
                    <button class="btn bg-gradient-info ms-auto mb-0 js-btn-next" 
                    type="submit">Update invoice</button>
                </div>


                
            </form>
        </div>
    </div>
    </div>
   </div>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        var a = "<?= $invoice->invoice_doc; ?>";
        if (a) {
            $('.file').attr("required", false);
        }
        $('#file_prepopulate').text(a);
    });
</script>

@section('scripts')
<script type="text/javascript">
     $(".multi-select").select2();
     $(".selection").addClass('form-select');
     $(".selection").css("padding","6px");
     $(".select2-selection").addClass('form-select');
     $(".select2-selection").css({"border":"none", "padding":"0px"});
    //  $(".select2-selection").css("padding", "0px");});
</script>
@endsection
<script>
    


    $(document).ready(function(){ 
        var a = {!! json_encode($invoice->invoice_date) !!}
        var b = {!! json_encode($invoice->date) !!}
        invdte = new Date(a);
        output_f=new Date(invdte.setDate(invdte.getDate())).toISOString().split('.');
        output_s = output_f[0].split('T');
        $('#invoiceDate').val(output_s[0]);
        
        invdte1 = new Date(b);
        output_f1=new Date(invdte1.setDate(invdte1.getDate())).toISOString().split('.');
        output_s1 = output_f1[0].split('T');
        $('#dueDate').val(output_s1[0]);
        
    $('#invoiceDate').change(function() {
        invoiceDate = new Date($('#invoiceDate').val());
        output_f=new Date(invoiceDate.setDate(invoiceDate.getDate()+60)).toISOString().split('.');
        output_s = output_f[0].split('T');
        $('#dueDate').val(output_s[0]);
    });
});
</script>