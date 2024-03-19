<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Document</title>
    <link rel="stylesheet" href="{{asset('assets/css/document.css')}}">
</head>
<body>
    <div class="document-container">
        <div class="header">
            <div>
                <span class="title">{{$data->desc}}</span>
                @if ($data->status === 'Pending')
                    <span style="color:#4682B4;font-size:small">{{$data->status}}</span>
                @elseif ($data->status === 'Valid')
                    <span style="color:green;font-size:small">{{$data->status}}</span>
                @else
                    <span style="color:#DC143C;font-size:small">{{$data->status}}</span>
                @endif
                
            </div>
            <div>
                <span class="id">Document ID : {{$data->id}}</span>
            </div>
            <div>
                <span class="date">Uploaded on {{$data->date}}</span>
            </div>
        </div>

        <!-- view pdf  -->
        <div class="document">
            <iframe width="100%" height="100%" src="/assets/docs/{{$data->docs}}"></iframe>
        </div>

    </div>
    
    
   
</body>
</html>