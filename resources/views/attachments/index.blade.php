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
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Attachmets</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">All Attachments</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection
<div class="row ">
    <div class="col">
        <div class="card card-body p-3 m-2">
            <div class="d-flex">
                <h4 class="m-2">All Attachments </h4> <button type="button" class="btn bg-gradient-info m-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
  +
</button>
            </div>
                <hr class="horizontal dark mt-0">
            <div class="row m-2">
                <div >
                    
                    <table class="table  table-responsive">
                            <thead>
                                <tr>
                                    <th class="text-center">Actions</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Attachment</th>
                                    <th class="text-center">Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attachments as $file)
                                <tr>
                                    <td class="text-center">
                                         <a class="dropdown-item text-center" href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('delete-form').submit(); "><i class="fa fa-bitbucket text-danger" aria-hidden="true"></i></a>
                                          <form id="delete-form" action="{{route('attachment.destroy',$file->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                          </form>
                                    </td>
                                    <td class="text-center">{{$file->name}}</td>
                                    <td class="text-center">{{$file->attachment}}</td>
                                    <td class="text-center">{{$file->created_at->format('m/d/y')}}</td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Attachment</h5>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="false">&times;</span>
                            </button>
                          </div>
                          <form method="POST" action="{{route('attachment.store')}}" enctype="multipart/form-data">
                              @csrf
                              <div class="modal-body">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" required>
                                    <label>Attachment</label>
                                    <input type="file" class="form-control" name="attachment" required>
                              </div>
                              <div class="modal-footer">
                                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn bg-gradient-info">Save</button>
                              </div>
                          </form>
                        </div>
                      </div>
                    </div>

<!-- Modal -->

@endsection