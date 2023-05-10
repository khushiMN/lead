
@if(session('success'))
{{-- {{dd(session('success'))}} --}}
<div class="alert alert-success alert-dismissible">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>Success!</strong> {{session('success')}}
  </div>
@endif

@if(session('error'))
  <div class="alert alert-danger alert-dismissible">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>Error!</strong> {{session('error')}}
  </div>
  @endif

            
            
 