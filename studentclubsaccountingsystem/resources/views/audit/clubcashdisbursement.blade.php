@if(session('role') === 'Audit')
@extends('audit.audit')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club CashDisbursement</title>
    <link rel="stylesheet" href="{{asset('./assets/css/clubtable.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    @section('content')
    <div class="main-container">
        <div class="header">
            <span>{{$club}} Club</span>
        </div>
        <div class="table-container">
        <table class="table">
                <thead class="thead">
                    <th>ID</th>
                    <th>Description</th>
                    <th>Opening Balance</th>
                    <th>Inflow</th>
                    <th>Outflow</th>
                    <th>Balance</th>
                    <th>Document</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody >
                    @foreach($items as $data)
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
                                <span style="color:rgb(55, 118, 253)">{{$data->status}}</span>
                            </td>
                            <td class="feedback-btn">
                                <a  href="{{route('giveremark',['id' => $data->id])}}">
                                    Add feedback
                                </a>
                            </td>
                        @elseif($data->status === 'Invalid')
                            <td >
                                <span style="color:red">{{$data->status}}</span>
                            </td>
                            <td class="feedback-btn">
                                <a  href="{{route('giveremark',['id' => $data->id])}}">
                                  Add feedback
                                </a>
                            </td>
                        @else
                            <td>
                                <span style="color:green">
                                     {{$data->status}}
                                </span>
                            </td>
                            <td>
                                <span style="color:green">
                                  Completed
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
            function goBack() {
                window.history.back();
            }
        </script>
    @endsection
</body>
</html>


@elseif(session('role') === 'Club')
    <div>
        <p>Sorry, you dont have the access to this page.</p>
    </div>
@endif