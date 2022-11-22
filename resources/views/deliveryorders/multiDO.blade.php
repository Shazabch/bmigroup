@extends('layouts.main1')
@section('content')
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0  shadow-none border-radius-xl">
   <div class="container-fluid ">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Delivery Order</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Upload DO's</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection
<div class="container-fluid p-2">
   <div class="row ">
    <div class="col-12 col-lg-10">
    
            <div class="card card-body">
            <h5 class="font-weight-bolder mb-0">Upload DO's</h5>
            </div>
            <!-- invoice add form started here  -->
            <form action="{{route('deliveryOrder.bulkUpload')}}" method="POST" enctype="multipart/form-data">
                @csrf
           @for($i=0 ; $i<$files ; $i++)
           <div class="card mt-2">
                <div class="card-body mt-3">
                <h5 class="font-weight-bolder mb-0">DO #{{$i + 1}}</h5>
                <hr class="horizontal dark mt-2">
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="invoice">Invoice No.</label>
                            <select  name="invoice_id[]" id="invoice_id" class="form-control multi-select invoice_id" required>
                                <option value=""></option>
                                @foreach($invoices as $invoice)
                                 <option value="{{$invoice->id}}">{{$invoice->invoiceId}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('user_id') {{$message}} @enderror</span>
                        </div>
                    </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="do_no">DO No.</label>
                                    <input value="{{old('do_no')}}" id="do_no" type="text" class="form-control do_no" name="do_no[]" required>
                                    <span class="text-danger">@error('do_no') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="do_doc">DO Document</label>
                                    <input type="hidden" name="do_doc[]" value="{{$data[$i]}}">
                                    <span class="badge badge-secondary p-3 badge-block  w-100">{{$data[$i]}}</span>
                                </div>
                            </div> 
                    </div>
                    <div class="row">
                   <div class="col">
                       <label for="remarks">Remarks</label>
                        <textarea class="form-control" name="remarks[]"></textarea>
                   </div>
                </div>
                </div>
            </div>
           @endfor
                
            <!-- Add  Button  -->
                <div class="button-row d-flex mt-2">
                    <button class="btn bg-gradient-info ms-auto mb-0 js-btn-next" 
                    type="submit">Upload DO</button>
                </div>


                
            </form>
        
    </div>
   </div>
</div>
@endsection
@section('scripts')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function(){ 
        $('.invoice_id').each(function(index , element){
              $(document).on('change','.invoice_id',function(){
                 const inv = $(element).val();
            var url = '{{ route("getDONo", ":id") }}';
            var selectCustomer = $(element).parent().parent().parent().find('#do_no');
            url = url.replace(':id', inv);
            $.ajax({
                 type: 'get',
                 url: url,
                 async:false,
                 dataType: 'json',
                 success: function(response) {
                    selectCustomer.val(response);
                 }
            }); 
              });
        }); 
    });
</script>
@endsection
