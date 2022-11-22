@extends('layouts.main1')
@section('content')
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
   <div class="container-fluid ">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Customers</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit Customer</li>
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
            <h5 class="font-weight-bolder mb-0">Edit Customer</h5>
            <p class="mb-0 text-sm">Mandatory informations <span class="text-danger">*</span>
            &nbsp;

            </p>
            <hr class="horizontal dark mt-2">
            <!-- Customer add form started here  -->
            <form action="{{route('customers.update',$users->id)}}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
            <!-- company and name fields  -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="company">Company/Business Name <span class="text-danger">*</span></label>
                            <input value="{{$users->company}}" type="company" class="form-control " name="company" required>
                            <span class="text-danger">@error('company') {{$message}} @enderror</span>
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Business Contact Name <span class="text-danger">*</span></label>
                            <input value="{{$users->name}}" type="text" class="form-control" name="name" required>
                            <span class="text-danger">@error('name') {{$message}} @enderror</span>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Customer No. <span class="text-danger">*</span></label>
                            <input value="{{$users->customer_no}}" type="text" class="form-control" name="customer_no" required>
                            <span class="text-danger">@error('customer_no') {{$message}} @enderror</span>

                        </div>
                    </div>
               
                <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="email">Business E-mail (Primary) <span class="text-danger">*</span></label>
                            <input value="{{$users->email}}" type="email" class="form-control" name="email" required>
                            <span   class="text-danger text-sm ">@error('email') {{$message}} @enderror</span>

                        </div>
                </div>
                <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="email">Business E-mail 2 </label>
                            <input value="{{$users->email2}}" type="email" class="form-control" name="email2" >
                            <span   class="text-danger text-sm ">@error('email2') {{$message}} @enderror</span>

                        </div>
                </div>
                <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="email">Business E-mail 3 </label>
                            <input value="{{$users->email3}}" type="email" class="form-control" name="email3">
                            <span   class="text-danger text-sm ">@error('email3') {{$message}} @enderror</span>

                        </div>
                </div>
                <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="email">Billing Address</label>
                            <input value="{{$users->address}}" type="email" class="form-control" name="address">
                            <span   class="text-danger text-sm ">@error('address') {{$message}} @enderror</span>

                        </div>
                </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="payment_term">{{__('labels.payment_term')}} (Days)</label>
                            <input value="{{$users->payment_term}}" type="number" class="form-control" name="payment_term">
                        </div>
                    </div>
            <!-- email and password fields  -->
            <!-- password repeat and status fields  -->
                
                <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="phone">Business Contact Number <span class="text-danger">*</span></label>
                            <input value="{{$users->phone}}" type="text" class="form-control" name="phone">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" id="">
                                <option {{$users->status == 1 ? 'selected' : ''}} value="1">Active</option>
                                <option {{$users->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                            </select>
                            <span   class="text-danger text-sm ">@error('status') {{$message}} @enderror</span>
                        </div>
                    </div>
                    
                     <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="file1">Upload Credit Application Form (CC1)</label>
                    </label>
                                    <input type="file" class="form-control" name="file1">
                                    <span class="small">{{$users->file1}}</span>
                                    <span class="text-danger">@error('file1') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="file2">Upload Form 24</label>
                                    <input type="file" class="form-control" name="file2">
                                    <span class="small">{{$users->file2}}</span>
                                    <span class="text-danger">@error('file2') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="file3">Upload Form 9</label>
                                    <input type="file" class="form-control" name="file3">
                                    <span class="small">{{$users->file3}}</span>
                                    <span class="text-danger">@error('file3') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="file4">Upload Financial Statements</label>
                                    <input type="file" class="form-control" name="file4">
                                    <span class="small">{{$users->file4}}</span>
                                    <span class="text-danger">@error('file4') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="file5">Upload PDPA</label>
                                    <input type="file" class="form-control" name="file5">
                                    <span class="small">{{$users->file5}}</span>
                                    <span class="text-danger">@error('file5') {{$message}} @enderror</span>
                                </div>
                            </div>
                </div>
                
            <!-- Add Customer Button  -->
                <div class="button-row d-flex ">
                    <button class="btn bg-gradient-info ms-auto mb-0 js-btn-next" 
                    type="submit">Update Customer</button>
                </div>


                
            </form>
        </div>
    </div>
    </div>
   </div>
</div>
@endsection