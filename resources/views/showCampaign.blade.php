@extends('layouts.mainlayout')
@section('title')
Show Campaign page
@endsection
@section('content')
        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Campaign</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Campaign</li>
                        </ol>
                        <div class="row">
                        <table class="table mt-5 w-50 mx-auto h-100 ">
                            <thead class="table-info">
                                <a href="{{route('campaign.index')}}"><button type="button" class="btn mx-auto btn-outline-dark">Back</button></a>
                                <tr>
                                    <th scope="col">id</th>
                                    <td>{{$value->id}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                <th scope="col">Name</th>
                                <td>{{$value->campaign_name}}</td>
                                <td></td>
                                </tr>
                                <tr>
                                <th scope="col">Description</th>
                                <td>{{$value->description}}</td>
                                <td></td>
                                </tr>
                                <tr>
                                    <th scope="col">Cost Per Lead</th>
                                    <td>{{$value->cost_per_lead}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="col">Conversion Cost Per Lead</th>
                                    <td>{{$value->conversion_cost_per_lead}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="col" class="">Agents</th>
                                    @foreach ($value->agent_campaigns as $val)
                                    <td>
                                            {{$val->name}} <br>
                                        </td>
                                        <td><div class="col-auto">
                                            <form method="post" action="{{ route('userDelete',[$val->id]) }}">
                                                @method('delete') 
                                                @csrf
                                                <input type="hidden" name="campaign_id" value="{{$value->id}}">
                                                <button type="submit" class="btn btn-outline-danger show_confirm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                                                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                    </svg> 
                                                </button>
                                            </form>
                                        </div>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </main>
                <script type="text/javascript">
                    $(document).on("click",".show_confirm",function() {
                          var form =  $(this).closest("form");
                          var name = $(this).data("name");
                          console.log(form);
                          event.preventDefault();
                          swal({
                                title: "Are you sure you want to delete this record?",
                                text: "If you delete this, it will be gone forever.",
                                icon: "warning",
                                type: "warning",
                                buttons: ["Cancel","Yes!"],
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((willDelete) => {
                                if (willDelete) {
                                    console.log(willDelete);
                                    $(this).closest("form").submit();
                                }
                            });
                     });
                </script>  
@endsection
