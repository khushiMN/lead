@extends('layouts.mainlayout')
@section('title')
Show Lead page
@endsection
@section('content')
        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Leads</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Leads</li>
                        </ol>
                        <div class="row">
                        <table class="table mt-5 w-50 mx-auto h-100 ">
                            <thead class="table-info">
                                <a href="{{route('viewLead',['id'=>Auth::user()->id])}}"><button type="button" class="btn mx-auto btn-outline-dark">Back</button></a>
                                <tr>
                                    <th scope="col">id</th>
                                    <td>{{$data->id}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                <th scope="col">Name</th>
                                <td>{{$data->name}}</td>
                                <td></td>
                                </tr>
                                <tr>
                                    <th scope="col">Email</th>
                                    <td>{{$data->email}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="col">Phone No.</th>
                                    <td>{{$data->phone_no}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                <th scope="col">Status</th>
                                <td>{{$data->status}}</td>
                                <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </main>
@endsection
