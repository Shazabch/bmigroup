@extends('layouts.main1')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('/css/pagination_style.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('/css/filter_style.css') }}" />

<style>
  .table-responsive{
    min-height: 300px;
  }
</style>
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Customers</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">All Customers</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection
<div class="card p-2 mt-2">
  <div class="card-body" >
    <div class="accordion" id="accordionExample">
      <div class="accordion-item"> 
          <button name="searchFilter" class="collapsed btn bg-gradient-info ms-auto mb-3 mt-4 js-btn-next mt-3 filter-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fa fa-filter"></i>
            Filter
          </button>
        <div id="collapseOne" class="accordion-collapse collapse filter-border" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <form action="{{route('customers.index')}}" method="GET">
              {{-- <div class="row"></div> --}}
              <div class="accordion-body row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Business Contact Name</label>
                    <input class="form-control" name="name" type="text" id="example-text-input">
                </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Company/Business Name</label>
                    <input class="form-control" name="company" type="text" id="example-text-input">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-email-input" class="form-control-label">Business E-mail</label>
                    <input class="form-control" name="email" type="email" id="example-text-input">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-tel-input" class="form-control-label">Business Contact Number</label>
                    <input class="form-control" name="phone" type="tel" id="example-text-input">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="exampleFormControlSelect1">Status</label>
                    <select class="form-control" name="status" id="exampleFormControlSelect1">
                      <option>Active</option>
                      <option>Inactive</option>
                    </select>
                  </div>
                </div>
                  <div class="col-md-4">
                    <button style="margin-right: 8%" class="btn bg-gradient-info ms-auto mb-0 mt-4 js-btn-next" type="submit">Apply</button>
                </div>            
                  @csrf
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
              <!-- <th class="text-uppercase  text-secondary text-xxs font-weight-bolder opacity-7">ID</th> -->
              <th class="text-dark opacity-7 text-center">Actions</th>
              <th class="text-uppercase text-dark text-center text-xxs font-weight-bolder opacity-7">Business Contact Name</th>
              <th class="text-uppercase text-dark text-xxs text-center font-weight-bolder opacity-7 ">Company/Business Name</th>
              <th class=" text-uppercase text-dark text-xxs font-weight-bolder text-center opacity-7">Status</th>
              <th class=" text-uppercase text-dark text-xxs font-weight-bolder opacity-7 text-center">Business Contact Number</th>
              <th class=" text-uppercase text-dark text-xxs font-weight-bolder opacity-7 text-center">Created At</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
            <tr>
                <td class="text-center">
                         &nbsp; <a class="dropdown-item" href="{{route('customers.show',$user->id)}}"><i class="fa fa-eye text-info" aria-hidden="true"></i></a> 
                         &nbsp; <a class="dropdown-item" href="{{route('customers.edit',$user->id)}}"><i class="fa fa-pencil text-dark" aria-hidden="true"></i></a>
                  </td>
              <td class="text-center">
                <div class=" ">
                  <div class=" ">
                    <h6 class="mb-0 text-xs">{{$user->name}}</h6>
                    <p class="text-xs text-secondary mb-0">{{$user->email}}</p>
                  </div>
                </div>
              </td>
              <td class="text-center">
                <p class="text-xs font-weight-bold mb-0">{{$user->company}}</p>
              </td>
              <td class="text-center">
                <span class="badge badge-sm {{$user->status == 0 ? 'badge-secondary' : 'badge-success'}}">{{$user->status == 0 ? 'Inactive' : 'Active'}}</span>
              </td>
              <td class="text-center">
                <p class="text-xs font-weight-bold mb-0">{{$user->phone}}</p>
              </td>
              
              <td class="text-center">
                <span class="text-secondary text-xs font-weight-bold">$user->created_at</span>
              </td>
              
              <td>
            <!-- <form action="{{route('customers.formStatus',$user->id)}}" method="post">
              @csrf
              @method('put')
            <button class="btn btn-primary btn-sm align-middle mt-1" type="submit">Approve</button>
            </form> -->
              </td>
            </tr>
            @endforeach
          </tbody>
          
        </table>
      </div>
      <div class="dataTable-bottom">
        <div class="dataTable-pagination">
            <ul class="dataTable-pagination-list m-4">
              <li>{{ $users->links() }}</li>
            </ul>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

@endsection