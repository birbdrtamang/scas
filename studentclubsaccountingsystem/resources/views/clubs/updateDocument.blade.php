@if(session('role') === 'Club')
@extends('clubs.club') 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('./assets/css/updateDoc.css')}}">
</head>
<body>
   
    @section('content')
    <div class="addDocument">
        <div class="form-title">
            <div>
                <span>Update Document</span>
            </div>
        </div>
        
        <div class="addDoc">
            <form method="POST" action="{{ route('update', ['id' => $data->id]) }}" enctype= "multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="col">
                        <label for="desc">Description</label>
                        <input type="text" class="form-control" name="desc" id="desc" value="{{ old('desc', $data->desc) }}">
                    </div>
                    <div class="col">
                        <label for="openingBalance">Opening Balance</label>
                        <input type="number" class="form-control" name="openingBalance" id="openingBalance" value="{{ old('openingBalance', $data->openingBalance) }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for="inflow">Inflow</label>
                        <input type="number" class="form-control" name="inflow" id="inflow" value="{{ old('inflow', $data->inflow) }}">
                    </div>
                    <div class="col">
                        <label for="outflow">Outflow</label>
                        <input type="number" class="form-control" name="outflow" id="outflow" value="{{ old('outflow', $data->outflow) }}">
                    </div>
                </div>
                <div class="file">
                    <label for="doc">Supportive Document:</label><br>
                    <input type="file" accept=".pdf" name="doc" id="doc" value="{{ old('docs', $data->docs) }}">
                </div>
                <div class="button">
                    <button type="submit" >Update</button>
                </div>
            </form> 

            <!-- remarks -->
            <div class="remarks">
                <h5>Remarks</h5>
                <div class="remark-content">
                @if(count($remarks) > 0)
                    @foreach ($remarks as $remark)
                            <div class="item">
                                <div>
                                    <span class="fullname">{{$remark->auditor}}</span>
                                </div>
                                <div class="content">
                                    <p >{{$remark->content}}</p>
                                </div>
                                <div class="date">
                                    <span >{{$remark->date}}</span>
                                </div>
                            </div>
                    @endforeach
                @else
                <div>
                    <p>There are no remarks given yet.</p>
                </div>
                @endif
                </div>
            </div>
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


@elseif(session('role') === 'Audit')
    <div>
        <p>Sorry, you dont have the access to this page.</p>
    </div>
@endif