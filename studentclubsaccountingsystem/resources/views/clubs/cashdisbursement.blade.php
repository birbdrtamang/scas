@if(session('role') === 'Club')
@extends('clubs.club')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CashDisbursement</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('./assets/css/cashdisbursement.css')}}">
</head>
<body>
     @section('content')
        <div class="dash-container">
            <div class="dash-header">
                <span>Cash Disbursement</span>
                <button class="button2">
                    <a href="{{route('addDocument')}}">
                        Add Document 
                    </a>
                </button>
            </div>

            <div class="table-container">
                <table class="table" cellspacing="0" width="100%">
                    <thead class="thead-dark">
                        <th>ID</th>
                        <th>Description</th>
                        <th>Opening Balance</th>
                        <th>Inflow</th>
                        <th>Outflow</th>
                        <th>Balance</th>
                        <th>Document</th>
                        <th>Date</th>
                        <th>Status</th>
                    </thead>
                    <tbody >
                        @foreach($data as $data)
                        <tr>
                            <th>{{$data->id}}</th>
                            <td>{{$data->desc}}</td>
                            <td>{{$data->openingBalance}}</td>
                            <td>{{$data->inflow}}</td>
                            <td>{{$data->outflow}}</td>
                            <td>{{$data->balance}}</td>
                            <td><a href="{{url('/document',$data->id)}}">{{$data->docs}}</a></td>
                            <td>{{$data->date}}</td>

                            @if($data->status === 'Pending')
                                <td>
                                    <span style="color:#008aff;">{{$data->status}}</span>
                                    <a href="{{ route('edit', ['id' => $data->id]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32"><path fill="currentColor" d="M27.87 7.863L23.024 4.82l-7.89 12.566l4.843 3.04L27.87 7.863zM14.395 21.25l-.107 2.855l2.527-1.337l2.35-1.24l-4.673-2.936l-.097 2.658zM29.163 3.24L26.63 1.647a1.364 1.364 0 0 0-1.88.43l-1 1.588l4.843 3.042l1-1.586c.4-.64.21-1.483-.43-1.883zm-3.965 23.82c0 .275-.225.5-.5.5h-19a.5.5 0 0 1-.5-.5v-19a.5.5 0 0 1 .5-.5h13.244l1.884-3H5.698c-1.93 0-3.5 1.57-3.5 3.5v19c0 1.93 1.57 3.5 3.5 3.5h19c1.93 0 3.5-1.57 3.5-3.5V11.097l-3 4.776v11.19z"/></svg>
                                    </a>
                                </td>
                            @elseif($data->status === 'Invalid')
                                <td>
                                    <span style="color:#bb1311">{{$data->status}}</span>
                                    <a href="{{ route('edit', ['id' => $data->id]) }}" style="margin-left:5px">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32"><path fill="currentColor" d="M27.87 7.863L23.024 4.82l-7.89 12.566l4.843 3.04L27.87 7.863zM14.395 21.25l-.107 2.855l2.527-1.337l2.35-1.24l-4.673-2.936l-.097 2.658zM29.163 3.24L26.63 1.647a1.364 1.364 0 0 0-1.88.43l-1 1.588l4.843 3.042l1-1.586c.4-.64.21-1.483-.43-1.883zm-3.965 23.82c0 .275-.225.5-.5.5h-19a.5.5 0 0 1-.5-.5v-19a.5.5 0 0 1 .5-.5h13.244l1.884-3H5.698c-1.93 0-3.5 1.57-3.5 3.5v19c0 1.93 1.57 3.5 3.5 3.5h19c1.93 0 3.5-1.57 3.5-3.5V11.097l-3 4.776v11.19z"/></svg>
                                    </a>
                                </td>
                            @else
                                <td>
                                    <span style="color:green">
                                        {{$data->status}}
                                    </span>
                                </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $('#dtDynamicVerticalScrollExample').DataTable({
                    "scrollY": "80vh",
                    "scrollCollapse": true,
                });
                $('.dataTables_length').addClass('bs-select');
            });
        </script>
    @endsection
</body>
</html>

@elseif(session('role') === 'Audit')
    <div>
        <p>Sorry, you dont have the access to this page.</p>
    </div>
@endif