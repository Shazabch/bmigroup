@extends('layouts.main')
@section('content')
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid ">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admins</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Users</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Show User</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection
<div class="row mt-2 p-2">
    <div class="col m-2">
        <div class="card mt-2">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="font-weight-bolder mb-0">User Details</h5>
                    </div>
                </div>
                <br>
               <div class="row">
                   <div class="col-md-4">
                        <b>Name</b>    
                        <p>{{$admins->name}}</p>
                   </div>
                   <div class="col-md-4">
                        <b>Email</b>    
                        <p>{{$admins->email}}</p>
                   </div>
                   <div class="col-md-4">
                        <b>Created At</b>    
                        <p>{{$admins->created_at ? date_formatter($admins->created_at) : ''}}</p>
                   </div>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection