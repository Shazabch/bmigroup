@extends('layouts.main1')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('/css/pagination_style.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('/css/filter_style.css') }}" />
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid ">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{__('labels.cn')}}</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection
<div class="container-fluid p-2 mt-2">
   <div class="row ">
    <div class="col-12 col-lg-10">
    <div class="card">
        <div class="card-body">
            <h5 class="font-weight-bolder mb-0">{{__('labels.update_cn')}}</h5>
            </p>
            <hr class="horizontal dark mt-2">
            <!-- deliveryorder add form started here  -->
            <form action="{{route('creditnotes.update',$creditnote->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
            <!-- company and name fields  -->
                <div class="row ">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="customer">Customer</label>
                            <select id="user_id" name="user_id" class="form-control multi-select" required>
                                <option value=""></option>
                                @foreach($users as $user)
                                 <option value="{{$user->id}}" @if($creditnote->user_id == $user->id) selected @endif>{{$user->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('user_id') {{$message}} @enderror</span>
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Customer No.</label>
                            <input id="customer_no"  value="{{$creditnote->customer_no}}" type="text" class="form-control" name="customer_no" required>
                            <span class="text-danger">@error('customer_no') {{$message}} @enderror</span>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Customer PO No.</label>
                            <input   value="{{$creditnote->po_no}}" type="text" class="form-control" name="po_no" required>
                            <span class="text-danger">@error('po_no') {{$message}} @enderror</span>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Amount (MYR)</label>
                            <input   value="{{$creditnote->amount}}" type="text" class="form-control" name="amount" required>
                            <span class="text-danger">@error('amount') {{$message}} @enderror</span>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">{{__('labels.cn_no')}}</label>
                            <input  value="{{$creditnote->cn_no}}" type="text" class="form-control" name="cn_no" required>
                            <span class="text-danger">@error('cn_no') {{$message}} @enderror</span>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="cn_doc">CN Document</label>
                            <input value="{{$creditnote->cn_doc}}" type="file" class="form-control" name="file" required accept=".pdf,.doc,.xlsx,.docx">
                            <span id="file_prepopulate"></span>
                            <span   class="text-danger text-sm ">@error('file') {{$message}} @enderror</span>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">{{__('labels.cn_date')}}</label>
                            <input value="{{$creditnote->cn_date}}" type="date" class="form-control" name="cn_date" required>
                            <span class="text-danger">@error('date') {{$message}} @enderror</span>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Payment Term</label>
                            <input value="{{$creditnote->payment_term}}" type="date" class="form-control" name="payment_term" required>
                            <span class="text-danger">@error('payment_term') {{$message}} @enderror</span>

                        </div>
                    </div>
               
            <!-- email and deliveryorder fields  -->
              
                    
                    
                </div>
                
                <div class="row">
                   <div class="col">
                       <label for="remarks">Remarks</label>
                        <textarea class="form-control" name="remarks">{{$creditnote->remarks}}</textarea>
                   </div>
                </div>
            <!-- amount and deliveryorder ends  -->
                
            <!-- Add  Button  -->
                <div class="button-row d-flex mt-2 ">
                    <button class="btn bg-gradient-info ms-auto mb-0 js-btn-next" 
                    type="submit">Update CN</button>
                </div>


                
            </form>
        </div>
    </div>
    </div>
   </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        var a = "<?= $creditnote->cn_doc; ?>";
        if (a) {
            $('.file').attr("required", false);
        }
        $('#file_prepopulate').text(a);
    });
</script>
<script type="text/javascript">
     $(".multi-select").select2();
     $(".selection").addClass('form-select');
     $(".selection").css("padding","6px");
     $(".select2-selection").addClass('form-select');
     $(".select2-selection").css({"border":"none", "padding":"0px"});
    //  $(".select2-selection").css("padding", "0px");});
</script>
@endsection
