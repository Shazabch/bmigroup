@extends('layouts.main1')
@section('content')
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0  shadow-none border-radius-xl">
   <div class="container-fluid ">
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Statements</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Upload Statements</li>
        </ol>
    </nav>
   </div>
</nav>
@endsection
   <div class="container-fluid p-2">
   <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card card-body">
            <h5 class="font-weight-bolder mb-0">Upload Statements</h5>
            <p class="mb-0 text-sm">Please upload maximum of 20 files at once.</p>
            </p>
            <hr class="horizontal dark mt-2">
            <form action="{{route('statements.bulkUpload')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-2">
                <input  id="file-upload" name="file[]" type="file" multiple />
                </div>
                <span class="text-danger">@error('file') Please select some statements to continue ! @enderror</span>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" name="button" class="btn bg-gradient-info m-0 ms-2">Upload Statements</button>
                </div>
            </form>
            
            </div>
            
        </div>
    </div>
   </div>
@endsection
@section('scripts')
  <script>
      // Get a reference to the file input element
      const inputElement = document.querySelector('input[id="file-upload"]');
      // Create a FilePond instance
      const pond = FilePond.create(inputElement);
      FilePond.setOptions({
        server: {
          url: '/getupload/statements' ,
          headers:{
            'X-CSRF-TOKEN' : '{{ csrf_token() }}'
          }
        }
      }); 
  </script>
@endsection