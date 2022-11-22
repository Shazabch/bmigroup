@extends('layouts.main1')
@section('content')
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0  shadow-none border-radius-xl">
   <div class="container-fluid ">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">DN</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Upload DN</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection
<div class="container-fluid p-2">
   <div class="row ">
    <div class="col-10 col-lg-10">
    
            <div class="card card-body">
            <h5 class="font-weight-bolder mb-0">Upload Debit Notes</h5>
            </p>
            </div>
            <!-- invoice add form started here  -->
            <form action="{{route('debitnote.upload1')}}" method="POST" enctype="multipart/form-data">
                @csrf
                
           @for($i=0 ; $i<$files ; $i++)
           <div class="card mt-2">
        <div class="card-body">
           <h5 class="font-weight-bolder mb-0">DN #{{$i + 1}}</h5>
           <hr class="horizontal dark mt-2">

            <!-- company and name fields  -->
            <div class="row ">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="customer">Company Name</label>
                            <select id="dynamic-name" name="user_id[]" class="form-control" rqeuired>
                                <option value=""></option>
                                @foreach($users as $user)
                                 <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('user_id') {{$message}} @enderror</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Customer No.</label>
                            <input value="{{$customer_no[$i]}}" type="text" class="form-control customer_no" name="customer_no[]" required>
                            <span class="text-danger">@error('customer_no') {{$message}} @enderror</span>

                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Customer PO No.</label>
                            <input value="{{$po_no[$i]}}" type="text" class="form-control" name="po_no[]" required>
                            <span class="text-danger">@error('po_no') {{$message}} @enderror</span>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Reference No.</label>
                            <input value="{{$ref_no[$i]}}" type="text" class="form-control" name="ref_no[]" required>
                            <span class="text-danger">@error('ref_no') {{$message}} @enderror</span>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Amount (MYR)</label>
                            <input value="{{$amount[$i]}}" type="text" class="form-control" name="amount[]" required>
                            <span class="text-danger">@error('amount') {{$message}} @enderror</span>

                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">{{__('labels.dn_no')}}</label>
                            <input value="{{$dn_no[$i]}}" type="text" class="form-control" name="dn_no[]" required>
                            <span class="text-danger">@error('invoiceId') {{$message}} @enderror</span>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="invoice_doc">DN Document</label>
                            <input type="hidden" name="dn_doc[]" value="{{$data[$i]}}">
                            <span class="badge badge-secondary p-3 badge-block  w-100">{{$data[$i]}}</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">{{__('labels.dn_date')}}</label>
                            <input type="date" value="{{date('Y-m-d',strtotime($dn_date[$i]))}}" class="form-control dnDate" name="dn_date[]" required>
                            <span class="text-danger">@error('date') {{$message}} @enderror</span>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Due Date</label>
                            <input type="date" class="form-control dueDate" name="payment_term[]" required>
                            <span class="text-danger">@error('date') {{$message}} @enderror</span>

                        </div>
                    </div>
                </div>
                <div class="row">
                   <div class="col">
                       <label for="remarks">Remarks</label>
                        <textarea class="form-control" name="remarks[]"></textarea>
                   </div>
                </div>
            <!-- amount and invoice ends  -->
            </div>
    </div>
           @endfor
                
            <!-- Add  Button  -->
                <div class="button-row d-flex mt-2">
                    <button class="btn bg-gradient-info ms-auto mb-0 js-btn-next" 
                    type="submit">Upload DN</button>
                </div>


                
            </form>
        
    </div>
   </div>
</div>
@endsection


@section('scripts')
<script type="text/javascript">
     $(".multi-select").select2();
     $(".selection").addClass('form-select');
     $(".selection").css("padding","6px");
     $(".select2-selection").addClass('form-select');
     $(".select2-selection").css({"border":"none", "padding":"0px"});
</script>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    //Add new due date on the invoice date with payment terms
    $(document).ready(function(){ 
        $('.dnDate').each(function(index , element){
                const invoiceDte = $(element).val();
                invoiceDate = new Date(invoiceDte);
                output_f=new Date(invoiceDate.setDate(invoiceDate.getDate()+60)).toISOString().split('.');
                output_s = output_f[0].split('T');
                const dueDte = $(element).parent().parent().parent().find('.dueDate');
                dueDte.val(output_s[0]);
        }); 
    });
</script>