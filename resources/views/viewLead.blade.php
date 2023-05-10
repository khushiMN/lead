@extends('layouts.mainlayout')
@section('title')
Leads Pages
@endsection
@section('content')
<style>
    svg{
        /* height: 20px;  */
     w-5{display:none;}
    }
    </style>
        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                    <h1 class="mt-4"> Leads </h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a>/Leads/All Leads Details</li>
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
                                        <th>Email</th>
                                        <th>Phone No.</th>
                                        <th>Campaign_id</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone No.</th>
                                        <th>Campaign_id</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                @if(!empty($data) && $data->count())
                                    @foreach ($data as $value)
                                    <tr>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->email}}</td>
                                        <td>{{$value->phone_no}}</td>
                                        <td>{{$value->campaign_id}}</td>
                                        <td>
                                            @if($value->status != "conveted")
                                            <div class="form-group mb-3">
                                                <select class="selectpicker status" name="status" data-id="{{$value->id}}" {{$value->status=='conveted'? 'disabled': '' }} id="status">
                                                    {{-- @foreach($users as $user) --}}
                                                    <option value="pending" class="text-warning" {{$value->status=='pending'? 'selected': '' }}{{$value->status=='conveted'? 'disabled': '' }}>Pending</option>
                                                    <option value="inprocess" class="text-primary" {{$value->status=='inprocess'? 'selected': '' }}{{$value->status=='conveted'? 'disabled': '' }}>In Process</option>
                                                    <option value="onhold" class="text-info" {{$value->status=='onhold'? 'selected': '' }}{{$value->status=='conveted'? 'disabled': '' }}>On Hold</option>
                                                    <option value="conveted" class="text-success" {{$value->status=='conveted'? 'selected': '' }}{{$value->status=='conveted'? 'disabled': '' }}>Convert</option>
                                                    {{-- @endforeach --}}
                                                  </select>
                                                  @if (count($errors) > 0)
                                                <span class="text-danger">{{ $errors->first('user_id[]') }}</span>
                                                @endif
                                            </div>
                                            @else
                                                <label for="" class="text-success ml-3 label"><h4>{{$value->status}}</h4></label>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="row">
                                            <div class="col-auto">
                                            <form method="post" action="{{ route('showLead',[$value->id]) }}">
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

<script>
    $(document).on('change','#datatablesSimple select',function() {
        let status = $(this).val();
        let userId = $(this).data('id');
        console.log(status,userId);
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('updateStatus') }}',
            data: {
                'status': status,
                'id': userId
            },
            success: function(data) {
                console.log(data);
                alert(data.success);
                window.location.reload();
            }
        });
    });

</script>
@endsection
