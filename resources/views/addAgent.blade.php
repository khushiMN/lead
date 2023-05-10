@extends('layouts.mainlayout')
@section('title')
Add Agent page
@section('content')
<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
        <!-- Main content -->
        <main>
            <div class="container-fluid ">
                <h1 class="mt-4">Add Agent</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a>/<a href="{{route('agent.index')}}">Agents</a>/Add Agent</li>
                </ol>

                {{-- @include('message') --}}
                
                <div class="container-fluid m-5">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-2 "></div>
                        <div class="col-md-8 ">
                            <!-- general form elements -->
                            
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add Agent</h3>
                            </div>
                            <!-- /.card-header -->
                            
                            <!-- form start -->
                            <form method="post" action="{{route('agent.store')}}" id="form" enctype="multipart/form-data" >
                                @method('post')
                                @csrf
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="exampleInputTitle">Name</label>
                                        <input type="text" class="form-control text-black" id="name" name="name" value="{{ old('name') }}" placeholder="Enter Name">
                                        @if (count($errors) > 0)
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="exampleInputSlug">Phone No.</label><br>
                                        <input type="tel" class="form-control text-black" id="phone_no" style="width:100%;!important" name="phone_no" value="{{ old('phone_no') }}" placeholder="Enter Phone Number">
                                        @if (count($errors) > 0)
                                        <span class="text-danger">{{ $errors->first('phone_no') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="exampleInputDesc">Address</label>
                                        <textarea class="form-control" id="address" name="address" placeholder="Enter Address">{{ old('address') }}</textarea>
                                        @if (count($errors) > 0)
                                        <span class="text-danger">{{ $errors->first('address') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="exampleInputTitle">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter Email">
                                        @if (count($errors) > 0)
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="exampleInputTitle">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                                        @if (count($errors) > 0)
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="exampleInputTitle">Role</label>
                                        <select class="form-control" name="role">
                                            <option value="agent">Agent</option>
                                        </select>
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
            </div>
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
                    name: {
                        required: true,
                        // lettersonly: true,
                        maxlength: 20
                    },
                    phone_no: {
                        required: true,
                        digits:true,
                    },
                    email: {
                        required: true,
                    },
                    password: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Please enter name",
                    },
                    phone_no: {
                        required: "Please enter phone_no",
                    },
                    email: {
                        required: "Please enter valid email",
                    },
                    password: {
                        required: "Please enter Password",
                    },
                },
            })
        }
    }); 
</script>

@endsection