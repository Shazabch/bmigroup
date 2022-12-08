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
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{__('labels.cn')}}</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">All Credit Notes</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection
<div class="card card-body p-2 mt-2">
    <div class="accordion" id="accordionExample">
      <div class="accordion-item">
          <button class="collapsed btn bg-gradient-info ms-auto mb-3 mt-4 js-btn-next mt-3 filter-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fa fa-filter"></i>
            Filter
          </button>
          <a href="{{route('CN.excel')}}">
            <button name="exportFilter" 
          class=" btn bg-gradient-dark ms-auto mb-3 mt-4 js-btn-next mt-3 filter-btn" 
          type="button">
            Export
          </button>
        </a>
        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <form action="{{route('creditnotes.index')}}" method="GET">
          <div class="accordion-body row">

              <div class="col-3">
                <select style="width: 100%;" name="user_id" class="multi-select form-select">
                  <option selected> -- Select -- </option>
                  <?php
                    $users = get_all_users();
                  ?>
                  @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-3">
                <input type="text" name="do_no" class="form-control" placeholder="DO No">
              </div>
              @csrf

              <div class="button-row d-flex">
                <button style="margin-right: 8%" class="btn bg-gradient-info ms-auto mb-0 mt-4 js-btn-next" type="submit">Apply</button>
            </div>
            
        </div>

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
                  <!-- <th style="display: none;" class="text-uppercase  text-dark text-xxs font-weight-bolder opacity-7">ID</th> -->
                 <th class="text-dark opacity-7">Actions</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Customer No.</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Company Name</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7">CN No.</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7">CN Date</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Customer PO No.</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Reference No.</th>
                  <th class=" text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Amount (MYR)</th>
                </tr>
              </thead>
              <tbody>
                @foreach($creditnotes as $creditnote)
                <tr>
                <input type="hidden" value="{{$creditnote->id}}" class="deleteid">
                    <!-- <td style="display: none;">
                    <p class="text-xs font-weight-bold mb-0 ">{{$creditnote->id}}</p>
                    </td> -->
                    <td class="align-middle">
                         &nbsp; <a class="dropdown-item" href="{{route('creditnotes.show',$creditnote->id)}}"><i class="fa fa-eye text-info" aria-hidden="true"></i></a> 
                         &nbsp; <a class="dropdown-item" href="{{route('creditnotes.edit',$creditnote->id)}}"><i class="fa fa-pencil text-dark" aria-hidden="true"></i></a>
                         &nbsp; <a class="dropdown-item" href="javascript:void(0);" ><i class="fa fa-bitbucket text-danger deletebtn" aria-hidden="true"></i></a>
                  </td>
                  <td>
                    <div class="mx-3">
                      <div class="flex-column ">
                        <p class="text-xs text-secondary mb-0">{{$creditnote->customer_no}}</p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="mx-3">
                      <div class="flex-column ">
                        <p class="text-xs text-secondary mb-0">{{$creditnote->user->name}}</p>
                      </div>
                    </div>
                  </td>
                  <!-- <td>
                    <div class="mx-3">
                      <div class="flex-column ">
                        <p class="text-xs text-secondary mb-0">{{$creditnote->date}}</p>
                      </div>
                    </div>
                  </td> -->
                  <td>
                    <div class="mx-3">
                      <div class="flex-column ">
                        <p class="text-xs text-secondary mb-0">{{$creditnote->cn_no}}</p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="mx-3">
                      <div class="flex-column ">
                        <p class="text-xs text-secondary mb-0">{{date_formatter($creditnote->cn_date)}}</p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="mx-3">
                      <div class="flex-column ">
                        <p class="text-xs text-secondary mb-0">{{$creditnote->po_no}}</p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="mx-3">
                      <div class="flex-column ">
                        <p class="text-xs text-secondary mb-0">{{$creditnote->ref_no}}</p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="mx-3">
                      <div class="flex-column ">
                        <p class="text-xs text-secondary mb-0">{{$creditnote->amount}}</p>
                      </div>
                    </div>
                  </td>
                  
                </tr>
                <tr>
                  
                </tr>
                @endforeach
                
              </tbody>
        
      </table>
      </div>
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
    //  $(".select2-selection").css("padding", "0px");});
</script>
<script>
    $(document).ready(function(){
        $('.deletebtn').on('click',function(e){
            e.preventDefault();
            const delete_id = $(this).closest("tr").find('.deleteid').val();
            console.log(delete_id);
            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {
                var data = {
                    "_token" : '<?php echo csrf_token() ?>' ,
                    "id" : delete_id,
                };
                var url = "{{ route('creditnotes.destroy', ":id") }}";
                url = url.replace(':id', delete_id);
                $.ajax({
                  type: "DELETE" ,
                  url: url,
                  data: data,
                  success:function(response){
                    Swal.fire(
                      'Deleted!',
                      'CN has been deleted !',
                      'success'
                    ).then((result) => {
                        location.reload();
                    });
                  }
                });
              }
            })
        });
    });
</script>
@endsection
