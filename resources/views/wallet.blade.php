@extends('layouts.mainlayout')
@section('title')
Wallet Pages
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
                    <h1 class="mt-4">Wallet</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a>/Wallet</li>
                    </ol>
                    @include('message')

                    <div class="card bg-light mb-3" style="max-width: 18rem;">
                        <div class="card-header text-center">Total Wallet</div>
                        <div class="card-body">
                          <h5 class="card-title text-center">{{$total}}.00</h5>
                        </div>
                      </div>
                    <br><br>
                    <div class="card mb-4 ">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Wallet
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Amount</th>
                                        <th>Campaign Name</th>
                                        <th>Create at</th>
                                        <th>Lead Name</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Amount</th>
                                        <th>Campaign Name</th>
                                        <th>Create at</th>
                                        <th>Lead Name</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @if(!empty($data) && $data->count())
                                    @foreach ($data as $key=>$value) 
                                    <tr>
                                        <td>{{$value->campaigns['conversion_cost_per_lead']}}</td>
                                        <td>{{$value->campaigns['campaign_name']}}</td>
                                        <td>{{$value->created_at}}</td>
                                        <td>{{$value->leads['name']}}</td>
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
@endsection
