@extends('layouts.mainlayout')
@section('title')
Reports Pages
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
                                        <th>Agents</th>
                                        <th>Campaigns</th>
                                        <th>Leads</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Agents</th>
                                        <th>Campaigns</th>
                                        <th>Leads</th>
                                        <th>Status</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                @if(!empty($data) && $data->count())
                                    @foreach ($data as $value)
                                    <tr>
                                        <td>{{$value->users['name']}}</td>
                                        <td>{{$value->campaigns['campaign_name']}}</td>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->status}}</td>
                                    </tr>
                                    @endforeach
                                {{-- @else
                                    <tr>
                                        <td colspan="4"> are no data.</td>
                                    </tr> --}}
                                @endif
                            </tbody>
                        </table>
                        {!! $data->links() !!}
                        </div>
                    </div>
                </div>
                </main>
@endsection
