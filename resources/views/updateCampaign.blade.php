@extends('layouts.mainlayout')
@section('title')
Edit Campaign page
@endsection
@section('content')

<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
        <!-- Main content -->
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Campaign Detail</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a>/<a href="{{route('campaign.index')}}">Campaign detail</a>/Edit Campaign Detail</li>
            </ol>
            @include('message')
            <div class="container-fluid m-5">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-2 "></div>
                    <div class="col-md-8 ">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add Campaign</h3>
                            </div>
                            <!-- /.card-header -->
                            
                            <!-- form start -->
                            <form method="post" action="{{ route('campaign.update',[$value->id]) }}" id="form" enctype="multipart/form-data" >
                                @method('patch')
                                @csrf
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="exampleInputTitle">Campaign Name</label>
                                        <input type="text" class="form-control" id="campaign_name" name="campaign_name" value="{{$value->campaign_name}}" placeholder="Enter Name">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="exampleInputDesc">Description</label>
                                        <textarea class="form-control" id="description" name="description" placeholder="Enter description">{{$value->description}}</textarea>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="exampleInputSlug">cost per lead</label>
                                        <input type="text" class="form-control" id="cost_per_lead" name="cost_per_lead" value="{{$value->cost_per_lead}}" placeholder="Enter cost per lead">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="exampleInputSlug">conversion cost per lead</label>
                                        <input type="text" class="form-control" id="conversion_cost_per_lead" name="conversion_cost_per_lead" value="{{$value->conversion_cost_per_lead}}" placeholder="Enter conversion cost per lead">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="exampleInputFile">Select Agents</label>
                                          <select class="selectpicker" name="user_id[]" id="user_id[]" multiple data-live-search="true">
                                            @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                          </select>
                                          @if (count($errors) > 0)
                                        <span class="text-danger">{{ $errors->first('user_id[]') }}</span>
                                        @endif
                                    </div>
                                    
                                    </div>
                                    
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary w-25" name="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-2 "></div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </main>
        <script>
            $(document).ready(function() {
                if ($("#form").length > 0) {
                    $("#form").validate({
                        rules: {
                            campaign_name: {
                                required: true,
                                // lettersonly: true,
                                maxlength: 20
                            },
                            cost_per_lead: {
                                required: true,
                                digits: true,
                            },
                            conversion_cost_per_lead: {
                                required: true,
                                digitsonly: true,
                            },
                            'user_id[]': {
                                required: true,
                            },
                        },
                        messages: {
                            campaign_name: {
                                required: "Please enter campaign_name",
                            },
                            cost_per_lead: {
                                required: "Please enter cost_per_lead",
                            },
                            conversion_cost_per_lead: {
                                required: "Please enter conversion_cost_per_lead",
                            },
                            'user_id[]': {
                                required: "Please enter user_id[]",
                            },
                        },
                    })
                }
            }); 
        </script>
@endsection