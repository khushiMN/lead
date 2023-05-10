@extends('layouts.mainlayout')
@section('title')
Campaign Pages
@endsection
@section('content')
        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                    <h1 class="mt-4">Campaign Details</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a>/Campaign</li>
                    </ol>
                    @include('message')
                    <div class="card mb-4 ">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Campaign Details
                            <a href="{{route('campaign.create')}}"><button type="button" class="btn btn-outline-primary float-right" style="float:right;">Add</button></a>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Cost per lead</th>
                                        <th>Conversion cost per lead</th>
                                        <th>Total Agent</th>
                                        <th>Total Leads</th>
                                        <th>No. of lead processed</th>
                                        <th>No. of lead remaining</th>
                                        <th>created date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Cost per lead</th>
                                        <th>Conversion cost per lead</th>
                                        <th>Total Agent</th>
                                        <th>Total Leads</th>
                                        <th>No. of lead processed</th>
                                        <th>No. of lead remaining</th>
                                        <th>created date</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @if(!empty($data) && $data->count())
                                    @foreach ($data as $value)
                                    <tr>
                                        {{-- {{dd($value)}} --}}
                                        <td>{{$value->campaign_name}}</td>
                                        <td>{{$value->description}}</td>
                                        <td>{{$value->cost_per_lead}}</td>
                                        <td>{{$value->conversion_cost_per_lead}}</td>
                                        <td>{{$value->agent_campaigns->count('id')}}</td>
                                        <td>
                                            {{$value->leads->count('id')}}
                                        </td>
                                        <td>{{$value->leads->where('status','conveted')->count()}}</td>
                                        <td>{{$value->leads->where('status','!=','conveted')->count()}}</td>
                                        <td>{{$value->created_at}}</td>
                                        <td>
                                            <div class="form-group mb-3 w-75">
                                                <form id="myForm-{{$value->id}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="file" class="form-control file-input" id="csv-{{$value->id}}" data-id="{{$value->id}}" name="csv" accept=".csv" data-toggle="modal" data-target="#My-Modal" >
                                                    @if (count($errors) > 0)
                                                    <span class="text-danger">{{ $errors->first('csv') }}</span>
                                                    @endif
                                                </form>
                                            </div>
                                            <div class="row">
                                            <div class="col-auto">
                                            <form method="post" action="{{ route('campaign.show',[$value->id]) }}">
                                                @method('get') 
                                                @csrf
                                                <button type="submit" class="btn btn-outline-info" >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                      </svg>
                                                </button>
                                            </form>
                                            </div>
                                            <div class="col-auto">
                                            <form method="post" action="{{ route('campaign.edit',[$value->id]) }}">
                                                @method('get')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-success" >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                    </svg>    
                                                </button>
                                            </form>
                                            </div>
                                            <div class="col-auto">
                                            <form method="post" action="{{ route('campaign.destroy',[$value->id]) }}">
                                                @method('delete') 
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger show_confirm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                                                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                    </svg> 
                                                </button>
                                            </form>
                                            </div>
                                            <div class="col-auto">
                                                <form method="post" action="{{ route('addLead',[$value->id]) }}">
                                                    @method('get') 
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                                                            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                                          </svg>
                                                    </button>
                                                </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    {{-- @else
                                    <tr>
                                        <td colspan="8">There are no data.</td>
                                    </tr> --}}
                                @endif
                                </tbody>
                            </table>
                            {!! $data->links() !!}
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade modal-xl" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">field Selected</h4>
                            <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="card mb-4 ">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Users Details
                                 </div>
                                <div class="card-body">
                                    <form method="post" action="{{route('userData')}}">
                                        @method('post')
                                        @csrf
                                    <table id="usertable" class="table-bordered w-100 text-center">
                                        <thead>
                                            <tr>
                                                
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                            
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <tr>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <span id="column"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                       <button type="submit" name="saveModel" id="saveModel" class="btn btn-primary">Save changes</button>
                        </form>
                        <button type="button" class="btn btn-secondary close" name="close" data-bs-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>
                {{-- end model --}}
            </main>
            <script>
                $(document).ready(function() {

                    $(document).on('change','.file-input',function(){
                        
                        var id=$(this).attr('id');
                        
                        var campaign_id = $(this).data('id');

                        var formData = new FormData(document.getElementById("myForm-"+campaign_id));
                        var files=$('#myForm-'+campaign_id+' input[type="file"]')[0].value;
                        formData.append("files", files);
                        formData.append("campaign_id", campaign_id);
                       
                        console.log(formData);

                        // Allowing file type
                        var allowedExtensions =/(\.csv|\.txt)$/i;
                        
                        if (!allowedExtensions.exec($(this).val())) {
                            alert('Invalid file type');
                            fileInput.value = '';
                            return false;
                        }
                        else
                        {
                            $.ajax({
                                type: 'POST',
                                url: '{{url("upload")}}',
                                data: formData,
                                contentType: false,
                                processData: false,
                                cache: false,
                                success: function(response) {
                                    console.log(response);
                                    if(response.success){
                                        $('#myModal').modal('show');
                                        for(var i=0; i<response.column.length; i++){
                                            var column = "<th class='column' align='center'>" + response.column[i] + "</th>" ;
                                            var recordes = "<td  class='recordes' align='center'>" + response.user[0][i] + "</td>" ;
                                            $("#usertable thead tr").append(column);
                                            $("#usertable tbody tr").append(recordes);
                                            $("#usertable tfoot tr").append("<td  class='select'><select id='mylist["+i+"]' name='column["+i+"]'>" +
                                                "<option value='' selected>" + 'select' + "</option>" +
                                                "<option value='name'>" + 'Name' + "</option>" +
                                                "<option value='email'>" + 'email' + "</option>" +
                                                "<option value='phone_no'>" + 'phone_no' + "</option>" +
                                                "</select></td>");
                                        }
                                            
                                            var campaign_record = "<tr hidden>" +
                                            "<td align='center'>" + "<input type='text' name='campaign_id' value='" + response.campaign_id + "'>" + "</td>" +
                                            "</tr>";

                                        $("#usertable tbody").append(campaign_record);

                                        var filename = "<tr hidden>" +
                                            "<td align='center'>" + "<input type='text' name='filename' value='" + response.filename + "'>" + "</td>" +
                                            "</tr>";

                                        $("#usertable tbody").append(filename);
                                        }else{
                                            alert('empty csv file upload');
                                        }
                                    },
                                    error: function(xhr,errorThrown) {
                                    console.log(xhr.responseText);
                                }
                            });
                        }
                    }) 
                });
                
                
                // mapping---------------
                var uniq=[];
                $(document).on('change', '#usertable tfoot tr select', function() {
                    // alert(selectedOption.val());
                    var selectedOption = $(this);
                    var id=$(this).attr('id');
                    
                    if(!uniq.includes(selectedOption.val())){
                        uniq.push(selectedOption.val());
                        console.log('khushi');
                        // $("#usertable tfoot tr select option[value='" +selectedOption.val()+"']").prop('disabled', true);
                    }else{
                        alert('you have already selected '+ selectedOption.val());
                        $(this).find("option[value='" +selectedOption.val()+"']").attr("disabled", true);
                        $(this).val("");
                    };
                    console.log(uniq);
                });
                
                //// clear model--------------------
                $(document).on('click','.close', function () {
                    $('.column').remove();
                    $('.recordes').remove();
                    $('.select').remove();
                });
                
                $(document).on("click",".show_confirm",function() {
                    var form =  $(this).closest("form");
                    var name = $(this).data("name");
                    
                    event.preventDefault();
                    swal({
                            title: "Are you sure you want to delete this record?",
                            text: "If you delete this, it will be gone forever.",
                            icon: 'warning',
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

