@extends('layouts.main1')
@section('content')
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl">
   <div class="container-fluid py-1 px-3">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Invoices</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Upload Invoices</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection
<div class="container-fluid py-4">
   <div class="row ">
    <div class="col-12 col-lg-10">
    
            <div class="card card-body">
            <h5 class="font-weight-bolder mb-0">Upload Invoices</h5>
            </p>
            </div>
            <!-- invoice add form started here  -->
            <form action="{{route('invoices.bulkUpload')}}" method="POST" enctype="multipart/form-data">
                @csrf
                
           @for($i=0 ; $i<$files ; $i++)
           <div class="card mt-2">
        <div class="card-body">
           <h5 class="font-weight-bolder mb-0">Invoice #{{$i + 1}}</h5>
           <hr class="horizontal dark mt-2">

            <!-- company and name fields  -->
            <div class="row ">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="customer">Company Name</label>
                            <select id="dynamic-name" name="user_id[]" class="form-control dynamic-name" required>
                                <option value=""></option>
                                @foreach($users as $user)
                                 <option class="customer-name" value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('user_id') {{$message}} @enderror</span>
                        </div>
                    </div>
                    
                    <div class="col-md-6" >
                        <div class="form-group mb-3">
                            <label for="date">Customer No.</label>
                                @if(isset($customer_no[$i]))
                                <input value="{{$customer_no[$i]}}"  type="text" class="form-control customer_no" name="customer_no[]" required>
                                @else
                                <input value="0"  type="text" class="form-control customer_no" name="customer_no[]" required>
                                @endif
                            <span class="text-danger">@error('customer_no') {{$message}} @enderror</span>

                        </div>
                    </div>
                    
                    <div class="col-md-6" >
                        <div class="form-group mb-3">
                            <label for="date">Customer PO No.</label>
                            @if($po_no[$i])
                            <input value="{{$po_no[$i]}}" type="text" class="form-control" name="po_no[]" required>
                            @else
                            <input value="0" type="text" class="form-control" name="po_no[]" required>
                            @endif
                            <span class="text-danger">@error('po_no') {{$message}} @enderror</span>

                        </div>
                    </div>
                
                    

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Invoice No.</label>
                            <input value="{{$invoice_no[$i]}}" type="text" class="form-control" name="invoiceId[]" required>
                            <span class="text-danger">@error('invoiceId') {{$message}} @enderror</span>

                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="do_no">Delivery Order No.</label>
                            @if(isset($do_no[$i]))
                            <input value="{{$do_no[$i]}}" type="text" class="form-control" name="do_no[]" required>
                            @else
                            <input value="0" type="text" class="form-control" name="do_no[]" required>
                            @endif
                            <span class="text-danger">@error('do_no') {{$message}} @enderror</span>

                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Invoice Date</label>
                            <input type="date" value="{{date('Y-m-d',strtotime($invoice_date[$i]))}}"  class="form-control invoiceDate" name="invoice_date[]" required>
                            <span class="text-danger">@error('invoiceDate') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Due Date</label>
                            <input type="date"   class="form-control dueDate" name="date[]" required>
                            <span class="text-danger">@error('date') {{$message}} @enderror</span>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="amount">Amount (MYR)</label>
                            <input type="amount" 
                            value="{{$amount[$i]}}"
                            class="form-control" 
                            name="amount[]" required>
                            <span   class="text-danger text-sm ">@error('amount') {{$message}} @enderror</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="invoice_doc">Invoice Document</label>
                            <input type="hidden" name="file[]" value="{{$prev_files[$i]}}">
                            <span class="badge badge-secondary p-3 badge-block  w-100">{{$prev_files[$i]}}</span>
                        </div>
                    </div>
            <!-- email and invoice fields  -->
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
                    type="submit">Upload Invoices</button>
                </div>
            </form>
    </div>
   </div>
</div>
@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
function getLastDayOfMonth(year, month) {
  return new Date(year, month + 1, 0);
}
    //Add new due date on the invoice date with payment terms
    $(document).ready(function(){ 
        $('.invoiceDate').each(function(index , element){
                const invoiceDte = $(element).val();
                invoiceDate = new Date(invoiceDte);
                output_f=new Date(invoiceDate.setDate(invoiceDate.getDate()+60)).toISOString().split('.');
                output_s = output_f[0].split('T');
                const date = new Date(output_s[0]);
                   const lastDayCurrentMonth = getLastDayOfMonth(
                  date.getFullYear(),
                  date.getMonth(),
                );
                output_n = new Date(lastDayCurrentMonth).toISOString().split('.');
                outputn1 = output_n[0].split('T');
                const dueDte = $(element).parent().parent().parent().find('.dueDate');
                dueDte.val(outputn1[0]);
        }); 
        
        
            
    });
</script>
