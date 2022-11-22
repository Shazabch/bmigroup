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
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Account Statement</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection
<div class="container-fluid p-2 mt-2">
   <div class="row ">
    <div class="col-12 col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="font-weight-bolder mb-0">Edit Account Statement</h5>
            </p>
            <hr class="horizontal dark mt-2">
            <!-- deliveryorder add form started here  -->
            <form action="{{route('statements.update',$statements->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <!-- company and name fields  -->
                <div class="row ">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="customer">Company Name</label>
                            <select id="user_id" name="user_id" class="form-control multi-select" required>
                                <option value=""></option>
                                @foreach($users as $user)
                                 <option {{$user->id == $statements->user_id ? 'selected' : ''}} value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('user_id') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Customer No.</label>
                            <input id="customer_no" value="{{$statements->customer_no}}" type="text" class="form-control customer_no" name="customer_no" required>
                            <span class="text-danger">@error('customer_no') {{$message}} @enderror</span>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Statement Doc</label>
                            <input   type="file" class="form-control file" name="statement_doc" required>
                            <span id="file_prepopulate"></span>
                            <span class="text-danger">@error('statement_doc') {{$message}} @enderror</span>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Statement Date</label>
                            <input id="invoiceDate"  type="date" class="form-control " name="statement_date" required>
                            <span class="text-danger">@error('statement_date') {{$message}} @enderror</span>

                        </div>
                    </div>
                
                
            <!-- email and deliveryorder fields  -->
              
                    
                    
                </div>
              
            <!-- Add  Button  -->
                <div class="button-row d-flex mt-2 ">
                    <button class="btn bg-gradient-info ms-auto mb-0 js-btn-next" 
                    type="submit">Update Statement</button>
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
        var a = "<?= $statements->statement_doc; ?>";
        if (a) {
            $('.file').attr("required", false);
        }
        $('#file_prepopulate').text(a);
    });
</script>
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
    
    $(document).ready(function(){ 
        var a = {!! json_encode($statements->statement_date) !!}
        invdte = new Date(a);
        output_f=new Date(invdte.setDate(invdte.getDate())).toISOString().split('.');
        output_s = output_f[0].split('T');
        $('#invoiceDate').val(output_s[0]);
        
    });
</script>
@endsection
