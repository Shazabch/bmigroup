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
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{__('labels.dn')}}</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">All Debit Notes</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection
<div class="card card-body mt-2">
    <div class="accordion" id="accordionExample">
      <div class="accordion-item">
          <button class="collapsed btn bg-gradient-info ms-auto mb-3 mt-4 js-btn-next mt-3 filter-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fa fa-filter"></i>
            Filter
          </button>
          <a href="{{route('DN.excel')}}">
            <button name="exportFilter" 
          class=" btn bg-gradient-dark ms-auto mb-3 mt-4 js-btn-next mt-3 filter-btn" 
          type="button">
            Export
          </button>
        </a>
        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <form action="{{route('debitnotes.index')}}" method="GET">
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
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7">DN No.</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7">DN Date</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Customer PO No.</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Reference No.</th>
                  <th class=" text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Amount (MYR)</th>
                </tr>
              </thead>
              <tbody>
                @foreach($debitnotes as $debitnote)
                <tr>
                    <tr>
                     <td class="align-middle">
                         &nbsp; <a class="dropdown-item" href="{{route('debitnotes.show',$debitnote->id)}}"><i class="fa fa-eye text-info" aria-hidden="true"></i></a> 
                         &nbsp; <a class="dropdown-item" href="{{route('debitnotes.edit',$debitnote->id)}}"><i class="fa fa-pencil text-dark" aria-hidden="true"></i></a>
                         &nbsp; <a class="dropdown-item" href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('delete-form').submit(); "><i class="fa fa-bitbucket text-danger" aria-hidden="true"></i></a>
                          <form id="delete-form" action="{{route('debitnotes.destroy',$debitnote->id)}}" method="post">
                            @csrf
                            @method('delete')
                          </form>
                  </td>
                    <!-- <td style="display: none;">
                    <p class="text-xs font-weight-bold mb-0 ">{{$debitnote->id}}</p>
                    </td> -->
                  <td>
                    <div class="mx-3">
                      <div class="flex-column ">
                        <p class="text-xs text-secondary mb-0">{{$debitnote->customer_no}}</p>
                      </div>
                    </div>
                  </td>
                  
                  <td>
                    <div class="mx-3">
                      <div class="flex-column ">
                        <p class="text-xs text-secondary mb-0">{{$debitnote->user->name}}</p>
                      </div>
                    </div>
                  </td>
                  
                  <td>
                    <div class="mx-3">
                      <div class="flex-column ">
                        <p class="text-xs text-secondary mb-0">{{$debitnote->dn_no}}</p>
                      </div>
                    </div>
                  </td>
                  
                  <td>
                    <div class="mx-3">
                      <div class="flex-column ">
                        <p class="text-xs text-secondary mb-0">{{date_formatter($debitnote->dn_date)}}</p>
                      </div>
                    </div>
                  </td>
                  
                  <td>
                    <div class="mx-3">
                      <div class="flex-column ">
                        <p class="text-xs text-secondary mb-0">{{$debitnote->po_no}}</p>
                      </div>
                    </div>
                  </td>
                  
                  <td>
                    <div class="mx-3">
                      <div class="flex-column ">
                        <p class="text-xs text-secondary mb-0">{{$debitnote->ref_no}}</p>
                      </div>
                    </div>
                  </td>
                  
                  <!-- <td>
                    <div class="mx-3">
                      <div class="flex-column ">
                        <p class="text-xs text-secondary mb-0">{{$debitnote->date}}</p>
                      </div>
                    </div>
                  </td> -->
                  
                  
                  
                  
                  <td>
                    <div class="mx-3">
                      <div class="flex-column ">
                        <p class="text-xs text-secondary mb-0">{{$debitnote->amount}}</p>
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
     $(".multi-select").select2();
     $(".selection").addClass('form-select');
     $(".selection").css("padding","6px");
     $(".select2-selection").addClass('form-select');
     $(".select2-selection").css({"border":"none", "padding":"0px"});
    //  $(".select2-selection").css("padding", "0px");});
</script>>
@endsection
