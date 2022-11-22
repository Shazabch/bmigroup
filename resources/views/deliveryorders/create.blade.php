@extends('layouts.main1')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('/css/pagination_style.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('/css/filter_style.css') }}" />
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{__('labels.delivery_order')}}</li>
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
            <h5 class="font-weight-bolder mb-0">Add Delivery Order</h5>

            </p>
            <hr class="horizontal dark mt-2">
            <!-- invoice add form started here  -->
            <form action="{{route('deliveryOrders.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
            <!-- company and name fields  -->
                <div class="row ">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="invoice">Invoice No.</label>
                            <select name="invoice_id" id="invoice_id" class="form-control multi-select" required>
                                <option value=""></option>
                                @foreach($invoices as $invoice)
                                 <option value="{{$invoice->id}}">{{$invoice->invoiceId}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('invoice_id') {{$message}} @enderror</span>
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">{{__('labels.do_no')}}</label>
                            <input id="do_no" type="text" class="form-control" name="do_no" required>
                            <span class="text-danger">@error('do_no') {{$message}} @enderror</span>

                        </div>
                    </div>

                    
                    <!--<div class="col-md-6">-->
                    <!--    <div class="form-group mb-3">-->
                    <!--        <label for="date">Due Date</label>-->
                    <!--        <input id="dueDate" type="date" class="form-control" name="date" required>-->
                    <!--        <span class="text-danger">@error('date') {{$message}} @enderror</span>-->

                    <!--    </div>-->
                    <!--</div>-->
               
            <!-- email and invoice fields  -->
              
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="do_doc">DO Document</label>
                            <input type="file" class="form-control" name="file" required accept=".pdf,.doc,.xlsx,.docx">
                            <span   class="text-danger text-sm ">@error('file') {{$message}} @enderror</span>

                        </div>
                    </div>
                    
                </div>
                <div class="row">
                   <div class="col">
                       <label for="remarks">Remarks</label>
                        <textarea class="form-control" name="remarks"></textarea>
                   </div>
                </div>
            <!-- amount and invoice ends  -->
                
            <!-- Add  Button  -->
                <div class="button-row d-flex mt-2">
                    <button class="btn bg-gradient-info ms-auto mb-0 js-btn-next" 
                    type="submit">Add DO</button>
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
    //  $(".select2-selection").css("padding", "0px");});
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

$(document).on('change','#invoice_id',function(){
    var id = $(this).val();
    // console.log(id);
    var url = '{{ route("getDONo", ":id") }}';
    url = url.replace(':id', id);
    $.ajax({
             type: 'get',
             url: url,
             dataType: 'json',
             success: function(response) {
                 $('#do_no').val(response);

             }
         });
         
});
</script>
@endsection