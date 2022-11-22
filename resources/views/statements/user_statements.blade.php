@extends('layouts.main')
@section('content')
<?php
  // print_r($invoices);die;
?>
<link rel="stylesheet" type="text/css" href="{{ url('/css/pagination_style.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('/css/filter_style.css') }}" />


@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid ">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-01 pt- px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Statements</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">All Statements</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection
<hr class="horizontal dark mb-0 mt-0">
<div class="card card-body p-2 m-2">
   
    
  <div class="table-responsive">
    <div class="dataTable-wrapper dataTable-loading no-footer sortable fixed-height fixed-columns">
      <div class="dataTable-top">
        <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-center text-dark opacity-7">Actions</th>
                  <th style="display: none;" class="text-uppercase  text-dark text-xxs font-weight-bolder opacity-7">ID</th>
                  <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Customer No.</th>
                  <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Company Name</th>  
                  <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Statement Doc</th>
                  <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Statement Date</th>
                </tr>
              </thead>
              <tbody>
                @foreach($statements as $statement)
                <tr>
                     <td class="align-middle text-center">
                         &nbsp; <a class="dropdown-item" href="{{route('show_user_statements',$statement->id)}}"><i class="fa fa-eye text-info" aria-hidden="true"></i></a> 
                  </td>
                    <td style="display: none;">
                        <p class="text-xs font-weight-bold mb-0 ">{{$statement->id}}</p>
                    </td>
                    <td class="text-center">
                        <p class="text-xs font-weight-bold mb-0 ">{{$statement->customer_no}}</p>
                    </td>
                    
                    <td>
                    <div class="text-center">
                      <div class="d-flex flex-column justify-content-center">
                        <p class="text-xs text-secondary mb-0">{{$statement->user->name ? $statement->user->name : 'N/A' }}</p>
                      </div>
                    </div>
                  </td>
                  
                  <td>
                    <div class="text-center">
                      <div class="d-flex flex-column justify-content-center">
                        <p class="text-xs text-secondary mb-0">{{$statement->statement_doc}}</p>
                      </div>
                    </div>
                  </td>
                  
                  <td>
                    <div class="text-center">
                      <div class="d-flex flex-column justify-content-center">
                        <p class="text-xs text-secondary mb-0">{{$statement->statement_date ? date_formatter($statement->statement_date) : ''}}</p>
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
                
              </tbody>
        
      </table>
      </div>
      <div class="dataTable-bottom">
          <div class="dataTable-pagination">
              <ul class="dataTable-pagination-list m-4">
                <li>{{$statements->links()}}</li>
              </ul>
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
  function thousandSeparator(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
</script>
@endsection