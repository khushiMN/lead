@extends('layouts.mainlayout')
@section('title')
Add Lead page
@endsection
@section('content')

<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
        <!-- Main content -->
        <div class="container-fluid px-4">
            <h1 class="mt-4">Add Lead</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a>/Campaign/Add Campaign</li>
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
                                <h3 class="card-title">Add Lead</h3>
                            </div>
                            <!-- /.card-header -->
                            
                            <!-- form start -->
                            <form method="post" action="{{route('insertLead')}}" id="form" >
                                @method('post')
                                @csrf
                
                                <div class="card-body">
                                    <div class="form-group mb-4">
                                        <label for="exampleInputTitle">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter name">
                                        @if (count($errors) > 0)
                                        <span class="text-danger">{{ $errors->first('campaign_name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="exampleInputTitle">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter Email">
                                        @if (count($errors) > 0)
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="exampleInputSlug">Phone No.</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="tel" class="form-control" id="phone_no" style="width:100%;!important" name="phone_no" value="{{ old('phone_no') }}" placeholder="Enter Phone Number">
                                        @if (count($errors) > 0)
                                        <span class="text-danger">{{ $errors->first('phone_no') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="exampleInputFile">Select Agents</label>&nbsp;&nbsp;
                                          <select class="selectpicker" name="user_id" id="user_id">
                                            <option value="" selected>select</option>
                                            @foreach($data->agent_campaigns as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                            @endforeach
                                          </select>
                                          @if (count($errors) > 0)
                                        <span class="text-danger">{{ $errors->first('user_id') }}</span>
                                        @endif
                                    </div>
                                    <input type="hidden" name="campaign_id" value="{{$data->id}}">
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
            const phoneInputField = document.querySelector("#phone_no");
            const phoneInput = window.intlTelInput(phoneInputField, {
                utilsScript:
                    "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            });
           
            $(document).ready(function() {
                if ($("#form").length > 0) {
                    $("#form").validate({
                        rules: {
                            phone_no: {
                                required: true,
                                digits: true,
                            },
                            user_id: {
                                required: true,
                            },
                        },
                        messages: {
                            phone_no: {
                                required: "Please enter phone No.",
                            },
                            user_id: {
                                required: "Please select agent",
                            },
                        },
                    })
                }
            }); 
        </script>

@endsection