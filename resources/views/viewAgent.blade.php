@extends('layouts.mainlayout')
@section('title')
Agent Pages
@endsection
@section('content')
        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                    <h1 class="mt-4">Agent Details</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a>/Agent</li>
                    </ol>
                    @include('message')
                    <div class="card mb-4 ">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Agent Details
                            <a href="{{route('agent.create')}}"><button type="button" class="btn btn-outline-primary float-right" style="float:right;">Add</button></a>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone No.</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone No.</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                @if(!empty($data) && $data->count())
                                    @foreach ($data as $value)
                                    <tr>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->phone_no}}</td>
                                        <td>{{$value->address}}</td>
                                        <td>{{$value->email}}</td>
                                        <td>
                                            <div class="row">
                                            <div class="col-auto">
                                            <form method="post" action="{{ route('agent.show',[$value->id]) }}">
                                                @method('get') 
                                                @csrf
                                                <button type="submit" class="btn btn-outline-info" >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                      </svg>
                                                </button>
                                            </form>
                                            </div>
                                            <div class="col-auto">
                                            <form method="post" action="{{ route('agent.edit',[$value->id]) }}">
                                                @method('get')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-success" >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                    </svg>    
                                                </button>
                                            </form>
                                            </div>
                                            <div class="col-auto">
                                            <form method="post" class="form1"  action="{{ route('agent.destroy',[$value->id]) }}"> 
                                                @method('delete') 
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-flat show_confirm"> 
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                                                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                    </svg> 
                                                </button>
                                            </form>
                                            </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                {{-- @else
                                    <tr>
                                        <td colspan="10">There are no data.</td>
                                    </tr> --}}
                                @endif
                                </tbody>
                            </table>
                            {!! $data->links() !!}
                        </div>
                    </div>
                </div>
                </main>
           
              
<script type="text/javascript">
    $(document).on("click",".show_confirm",function() {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          console.log(form);
          event.preventDefault();
          swal({
                title: "Are you sure you want to delete this record?",
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                type: "warning",
                buttons: ["Cancel","Yes!"],
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((willDelete) => {
                if (willDelete) {
                    console.log(willDelete);
                    $(this).closest("form").submit();
                }
            });
     });
</script>
@endsection
