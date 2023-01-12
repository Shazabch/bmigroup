@extends('layouts.main1')
@section('content')
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid ">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Customers</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Customer Details</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection
<div class="row mt-2 p-2">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="font-weight-bolder mb-0">Customer Details</h5>
                    </div>
                    <div class="col">
                    <form action="{{route('customers.formStatus',$users->id)}}" method="post">
                        @csrf
                        @method('put')
                        @if($users->form_status == 1)
                        <button class="btn  bg-gradient-dark btn-sm align-middle mt-1" type="submit">Approve</button>
                        @endif
                    </form>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <b>Company/Business Name</b>
                        <p>{{$users->company}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>Business Contact Name</b>
                        <p>{{$users->name}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>Business Email (Primary)</b>
                        <p>{{$users->email}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>Business Email 2</b>
                        <p>{{$users->email2 ? $users->email2 : 'N/A'}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>Business Email 3</b>
                        <p>{{$users->email3 ? $users->email3 : 'N/A'}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>Billing Address</b>
                        <p>{{$users->address ? $users->address : 'N/A'}}</p>
                    </div>
                    
                    
                    <div class="col-md-6">
                        <b>Business Contact Number</b>
                        <p>{{$users->phone}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>Customer No.</b>
                        <p>{{$users->customer_no}}</p>
                    </div>
                    <div class="col-md-6">
                        <b>Status</b>
                        <p> <span class="badge badge-sm {{$users->status == 0 ? 'badge-secondary' : 'badge-success'}}">{{$users->status == 0 ? 'Inactive' : 'Active'}}</span></p>
                    </div>
                    <div class="col-md-6">
                        <b>Created At</b>
                        <p>{{$users->created_at ? $users->created_at->format('m/d/y') : 'N/A'}}</p>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col">
                        <h5 class="font-weight-bolder mb-0">Uploaded Documents</h5>
                      </div>
                    <div class="row mt-3">
                        @if($users->file1)
                            <div class="col-md-12">
                               <span><a href="{{route('file.download1',$users->file1)}}">
                                   <i class="fa fa-download text-info" aria-hidden="true"></i>
                                   </a><strong> Upload Credit Application Form (CC1)</strong>
                               </span> 
                            </div>
                        @endif
                        @if($users->file2)
                        <div class="col-md-12">
                               <span><a href="{{route('file.download1',$users->file2)}}">
                                   <i class="fa fa-download text-info" aria-hidden="true"></i>
                                   </a><strong>  Form 24</strong>
                                </span>
                         </div>
                        @endif
                        @if($users->file3)
                        <div class="col-md-12">
                                <span><a href="{{route('file.download1',$users->file3)}}">
                                    <i class="fa fa-download text-info" aria-hidden="true"></i>
                                    </a><strong> Form 9</strong>
                                </span>
                         </div>
                        @endif
                        @if($users->file4)
                        <div class="col-md-12">
                                <span><a href="{{route('file.download1',$users->file4)}}">
                                    <i class="fa fa-download text-info" aria-hidden="true"></i>
                                    </a><strong> Financial Statement</strong>
                                </span>
                         </div>
                        @endif
                        @if($users->file5)
                        <div class="col-md-12">
                                <span><a href="{{route('file.download1',$users->file5)}}">
                                    <i class="fa fa-download text-info" aria-hidden="true"></i>
                                    </a><strong> PDPA</strong>
                                </span>
                         </div>
                        @endif
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection