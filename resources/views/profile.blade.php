@extends('layouts.mainlayout')
@section('title')
Agent Profile page
@section('content')
<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
        <!-- Main content -->
        <main>
            <div class="container-fluid ">
                <h1>View Profile</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a>/View Profile</li>
                </ol>

                {{-- @include('message') --}}
                
                <div class="container-fluid " style="height:670px">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-2 "></div>
                        <div class="col-md-8 ">
                            <!-- general form elements -->
                            @include('message')
                        <div class="card card-primary" >
                            <div class="card-header">
                                <a href="{{route('editProfile')}}"><button type="button" class="btn btn-outline-primary float-right mt-2" style="float:right;">Edit Profile</button></a>
                                <h3 class="card-title mt-2"><i class="fas fas fa-user-alt"></i> &nbsp; Profile</h3>
                            </div>
                            <!-- /.card-header -->
                            
                            <!-- form start -->
                            
                                <div class="card-body" >
                                    <div class="form-group mb-3">
                                        <label for="exampleInputTitle">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}" disabled>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="exampleInputSlug">Phone No.</label><br>
                                        <input type="tel" class="form-control" id="phone_no" style="width:100%;!important" name="phone_no" value="{{ $data->phone_no }}" disabled>
                                
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="exampleInputDesc">Address</label>
                                        <input type="tel" class="form-control" id="address" style="width:100%;!important" name="address" value="{{ $data->address }}" disabled>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="exampleInputTitle">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $data->email }}" disabled>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="exampleInputTitle">Role</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $data->role }}" disabled>
                                    </div>
                                    
                                </div>
                                
                                <!-- /.card-body -->
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

    jQuery.validator.addMethod("lettersonly", function (value, element) {
                return this.optional(element) || /^[a-z\s]+$/i.test(value);
            }, "Only alphabetical characters");

    $(document).ready(function() {
        if ($("#form").length > 0) {
            $("#form").validate({
                rules: {
                    name: {
                        required: true,
                        lettersonly: true,
                        maxlength: 20
                    },
                    phone_no: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    email: {
                        required: true,
                    },
                    Password: {
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
                    address: {
                        required: "Please enter address",
                    },
                    email: {
                        required: "Please enter valid email",
                    },
                    Password: {
                        required: "Please enter Password",
                    },
                },
            })
        }
    }); 
</script>

@endsection

