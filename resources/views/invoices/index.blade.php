@extends('layouts.main1')
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
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Invoices</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">All Invoices</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection
<hr class="horizontal dark mb-0 mt-0">
<div class="card card-body p-2 m-2">
   
    <div class="accordion" id="accordionExample">
      <div class="accordion-item">
          <button name="searchFilter" class="collapsed btn bg-gradient-info ms-auto mb-3 mt-4 js-btn-next mt-3 filter-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fa fa-filter"></i>
            Filter
          </button>
          <a href="{{route('invoices.excel')}}">
            <button name="exportFilter" 
          class=" btn bg-gradient-dark ms-auto mb-3 mt-4 js-btn-next mt-3 filter-btn" 
          type="button">
            Export
          </button>
        </a>
        <div id="collapseOne" class="accordion-collapse collapse filter-border" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <form id="form1" action="{{route('invoices.index')}}" method="POST">
              @csrf
          <div class="accordion-body row">

              <div class="col-3">
                <select  style="width: 100%;" name="user_id" class="multi-select form-select">
                <option value="" disabled selected>Company Name</option>
                  <?php
                    $users = get_all_users();
                  ?>
                  @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-3">
                <input type="text" name="invoiceId" class="form-control" placeholder="invoice no">
              </div>
              <div class="col-3">
                <input class="form-control" name="date" type="date" placeholder="Date">
              </div>
              <div class="col-3">
                <button  class="btn bg-gradient-info ms-auto mb-0  js-btn-next" type="submit">Apply</button>
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
                  <th class="text-center text-dark opacity-7">Actions</th>
                  <th style="display: none;" class="text-uppercase  text-dark text-xxs font-weight-bolder opacity-7">ID</th>
                  <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Customer No.</th>
                  <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Company Name</th>  
                  <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">{{__('labels.invoice_no')}}</th>
                  <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Invoice Date</th>
                  <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">PO No.</th>
                  <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">{{__('labels.do_no')}}</th>
                  <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Amount (MYR)</th>
                  <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Outstanding (MYR)</th>
                  <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Due Date</th>
                </tr>
              </thead>
              <tbody>
                @foreach($invoices as $invoice)
                <tr>
                  <input type="hidden" value="{{$invoice->id}}" class="deleteid">
                     <td class="align-middle text-center">
                         &nbsp; <a class="dropdown-item" href="{{route('invoices.show',$invoice->id)}}"><i class="fa fa-eye text-info" aria-hidden="true"></i></a> 
                         &nbsp; <a class="dropdown-item" href="{{route('invoices.edit',$invoice->id)}}"><i class="fa fa-pencil text-dark" aria-hidden="true"></i></a>
                         &nbsp; <a class="dropdown-item" href="javascript:void(0);" ><i class="fa fa-bitbucket text-danger deletebtn" aria-hidden="true"></i></a>
                  </td>
                    <td style="display: none;">
                        <p class="text-xs font-weight-bold mb-0 ">{{$invoice->id}}</p>
                    </td>
                    <td class="text-center">
                        <p class="text-xs font-weight-bold mb-0 ">{{$invoice->customer_no}}</p>
                    </td>
                    
                    <td>
                    <div class="text-center">
                      <div class="d-flex flex-column justify-content-center">
                        <p class="text-xs text-secondary mb-0">{{$invoice->user->name ? $invoice->user->name : 'N/A' }}</p>
                      </div>
                    </div>
                  </td>
                  
                  <td>
                    <div class="text-center">
                      <div class="d-flex flex-column justify-content-center">
                        <p class="text-xs text-secondary mb-0">{{$invoice->invoiceId}}</p>
                      </div>
                    </div>
                  </td>
                  
                  <td>
                    <div class="text-center">
                      <div class="d-flex flex-column justify-content-center">
                        <p class="text-xs text-secondary mb-0">{{$invoice->invoice_date ? date_formatter($invoice->invoice_date) : ''}}</p>
                      </div>
                    </div>
                  </td>
                  
                    <td >
                         <div class="text-center">
                            <div class="d-flex flex-column justify-content-center">
                                <p class="text-xs text-secondary mb-0 ">{{$invoice->po_no ? $invoice->po_no : 'N/A'}}</p>
                            </div>
                        </div>
                    </td>
                  
                  
                  <td>
                    <div class="text-center">
                      <div class="d-flex flex-column justify-content-center">
                        <p class="text-xs text-secondary mb-0">{{$invoice->do_no ? $invoice->do_no : 'N/A'}}</p>
                      </div>
                    </div>
                  </td>
                  
                  <td>
                    <div class="text-center">
                      <div class="d-flex flex-column justify-content-center">
                        <p class="text-xs text-secondary mb-0">{{number_format($invoice->amount , 2)}}</p>
                      </div>
                    </div>
                  </td>
                  
                  <td>
                    <div class="text-center">
                      <div class="d-flex flex-column justify-content-center">
                        <p class="text-xs text-secondary mb-0">{{number_format($invoice->outstanding , 2)}}</p>
                      </div>
                    </div>
                  </td>
                  
                  <td>
                    <div class="text-center">
                      <div class="d-flex flex-column justify-content-center">
                        <p class="text-xs text-secondary mb-0">{{$invoice->date ? date_formatter($invoice->date) : '' }}</p>
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
      <div class="dataTable-bottom">
          <div class="dataTable-pagination">
              <ul class="dataTable-pagination-list m-4">
                <li>{{$invoices->links()}}</li>
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
</script>
<script>
    $(document).ready(function(){
        $('.deletebtn').on('click',function(e){
            e.preventDefault();

            const delete_id = $(this).closest("tr").find('.deleteid').val();
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
                $.ajax({
                  type: "DELETE" ,
                  url: "destroy/"+delete_id,
                  data: data,
                  success:function(response){
                    Swal.fire(
                      'Deleted!',
                      'Invoice has been deleted !',
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