@extends('layouts.mainlayout')
@section('title')
Show Agent page
@endsection
@section('content')
        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Agent</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Agent</li>
                        </ol>
                        <div class="row">
                        <table class="table mt-5 w-50 mx-auto h-100 text-center">
                            <thead class="table-info">
                                <a href="{{route('agent.index')}}"><button type="button" class="btn mx-auto btn-outline-dark">Back</button></a>
                                <tr>
                                    <th scope="col">id</th>
                                    <td>{{$value->id}}</td>
                                </tr>
                                <tr>
                                <th scope="col">Name</th>
                                <td>{{$value->name}}</td>
                                </tr>
                                <tr>
                                <th scope="col">Phone No.</th>
                                <td>{{$value->phone_no}}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Address</th>
                                    <td>{{$value->address}}</td>
                                </tr>
                                <tr>
                                    <th scope="col">email</th>
                                    <td>{{$value->email}}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Password</th>
                                    <td>{{$value->password}}</td>
                                </tr>
                                <tr>
                                    <th scope="col">role</th>
                                    <td>{{$value->role}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </main>
@endsection
