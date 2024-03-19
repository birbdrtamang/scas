@if(session('role') === 'Club')
@extends('clubs.club') 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('./assets/css/addDoc.css')}}">
</head>
<body>
    @section('content')
    <div class="addDocument">
        <div class="form-title">
            <div>
                <span>Add Document</span>
            </div>
        </div>
        
        <div class="addDoc">
            <form method="POST" action="{{route('addDocument.post')}}" enctype= "multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="col">
                        <label for="desc">Description</label>
                        <input type="text" class="form-control" name="desc" id="desc">
                    </div>
                    <div class="col">
                        <label for="openingBalance">Opening Balance</label>
                        <input type="number" class="form-control" name="openingBalance" id="openingBalance" value="{{ $openingBalance }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for="inflow">Inflow</label>
                        <input type="number" class="form-control" name="inflow" id="inflow" required>
                    </div>
                    <div class="col">
                        <label for="outflow">Outflow</label>
                        <input type="number" class="form-control" name="outflow" id="outflow" required>
                    </div>
                </div>
                <div class="file">
                    <label for="doc">Supportive Document :</label><br>
                    <input type="file" accept=".pdf" name="doc" id="doc" required>
                </div>
                <button class="button2">
                    <a style="color:white">
                        Upload
                    </a>
                </button>
            </form>
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