@extends('layouts.main1')
@section('content')
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl">
   <div class="container-fluid py-1 px-3">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Customers</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Add Customer</li>
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
            <h5 class="font-weight-bolder mb-0">Add Customer</h5>
            </p>
            <hr class="horizontal dark mt-2">
            <!-- Customer add form started here  -->
            <form action="{{route('customers.store')}}" method="POST">
                @csrf
            <!-- company and name fields  -->
                <div class="row ">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="company">Company/Business Name <span class="text-danger">*</span></label>
                            <input type="company" class="form-control " name="company" required>
                            <span class="text-danger">@error('company') {{$message}} @enderror</span>
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Business Contact Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" required>
                            <span class="text-danger">@error('name') {{$message}} @enderror</span>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Customer No. </label>
                            <input type="text" class="form-control" name="customer_no" required>
                            <span class="text-danger">@error('customer_no') {{$message}} @enderror</span>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Payment Term</label>
                            <input type="number" class="form-control" name="payment_term" required>
                            <span class="text-danger">@error('payment_term') {{$message}} @enderror</span>

                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="email">Business E-mail (Primary) <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" required>
                            <span   class="text-danger text-sm ">@error('email') {{$message}} @enderror</span>

                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="email">Business E-mail 2</label>
                            <input type="email" class="form-control" name="email2" >
                            <span   class="text-danger text-sm ">@error('email2') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="email">Business E-mail 3 </label>
                            <input type="email" class="form-control" name="email3" >
                            <span   class="text-danger text-sm ">@error('email3') {{$message}} @enderror</span>
                        </div>
                    </div>
                    
                   
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" 
                            class="form-control" 
                            name="password" required>
                            <span   class="text-danger text-sm ">@error('password') {{$message}} @enderror</span>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="password">Repeat Password <span class="text-danger">*</span></label>
                            <input type="password" 
                            id="password_confirmation"
                             class="form-control"
                              name="password_confirmation" required>
                            <span   class="text-danger text-sm ">@error('password_confirmation') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="email">Billing Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="address" required>
                            <span   class="text-danger text-sm ">@error('address') {{$message}} @enderror</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control" id="" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <span   class="text-danger text-sm ">@error('status') {{$message}} @enderror</span>
                        </div>
                    </div>
                    
                     <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="file1">Upload Credit Application Form (CC1) </label>
                                    <input type="file" class="form-control" name="file1" >
                                    <span class="text-danger">@error('file1') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="file2">Upload Form 24</label>
                                    <input type="file" class="form-control" name="file2">
                                    <span class="text-danger">@error('file2') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="file3">Upload Form 9</label>
                                    <input type="file" class="form-control" name="file3">
                                    <span class="text-danger">@error('file3') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="file4">Upload Financial Statements</label>
                                    <input type="file" class="form-control" name="file4">
                                    <span class="text-danger">@error('file4') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="file5">Upload PDPA</label>
                                    <input type="file" class="form-control" name="file5">
                                    <span class="text-danger">@error('file5') {{$message}} @enderror</span>
                                </div>
                            </div>
                </div>
            <!-- Add Customer Button  -->
                <div class="button-row d-flex ">
                    <button class="btn bg-gradient-info ms-auto mb-0 js-btn-next" 
                    type="submit">Add Customer</button>
                </div>


                
            </form>
        </div>
    </div>
    </div>
   </div>
</div>
@endsection