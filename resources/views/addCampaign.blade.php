@extends('layouts.mainlayout')
@section('title')
Add Campaign page
@endsection
@section('content')

<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
        <!-- Main content -->
        <div class="container-fluid px-4">
            <h1 class="mt-4">Add Campaign</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a>/<a href="{{route('campaign.index')}}">Campaign</a>/Add Campaign</li>
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
                            <form method="post" action="{{route('campaign.store')}}" id="form" >
                                @method('post')
                                @csrf
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="exampleInputTitle">Campaign Name</label>
                                        <input type="text" class="form-control text-black" id="campaign_name" name="campaign_name" value="{{ old('campaign_name') }}" placeholder="Enter campaign name">
                                        @if (count($errors) > 0)
                                        <span class="text-danger">{{ $errors->first('campaign_name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="exampleInputDesc">Description</label>
                                        <textarea class="form-control" id="description" name="description"  placeholder="Enter description">{{ old('description') }}</textarea>
                                        @if (count($errors) > 0)
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="exampleInputSlug">cost per lead</label>
                                        <input type="text" class="form-control text-black" id="cost_per_lead" name="cost_per_lead" value="{{ old('cost_per_lead') }}" placeholder="Enter cost per lead">
                                        @if (count($errors) > 0)
                                        <span class="text-danger">{{ $errors->first('cost_per_lead') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="exampleInputSlug">conversion cost per lead</label>
                                        <input type="text" class="form-control text-black" id="conversion_cost_per_lead" name="conversion_cost_per_lead" value="{{ old('conversion_cost_per_lead') }}" placeholder="Enter conversion cost per lead">
                                        @if (count($errors) > 0)
                                        <span class="text-danger">{{ $errors->first('conversion_cost_per_lead') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="exampleInputFile">Select Agents</label>
                                          <select class="selectpicker" name="user_id[]" id="user_id[]" multiple data-live-search="true">
                                            @foreach($data as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
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
                                maxlength: 100
                            },
                            cost_per_lead: {
                                required: true,
                                digits: true,
                            },
                            conversion_cost_per_lead: {
                                required: true,
                                digits: true,
                            },
                            'user_id[]': {
                                required: true,
                            },
                        },
                        messages: {
                            campaign_name: {
                                required: "Please enter campaign name",
                            },
                            cost_per_lead: {
                                required: "Please enter cost per lead",
                            },
                            conversion_cost_per_lead: {
                                required: "Please enter conversion cost per lead",
                            },
                            'user_id[]': {
                                required: "Please select agent",
                            },
                        },
                    })
                }
            }); 
        </script>

@endsection