@if(session('role') === 'Audit')
@extends('audit.audit')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clubs</title>
    <link rel="stylesheet" href="{{asset('./assets/css/clublist.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    @section('content')
   
        <div class="members">
            <div class="dash-header">
                <span>Clubs</span>
            </div>
            <div class="mem-container">
            @foreach ($statusCounts as $count)
            <a class="item" href="{{route('clubcashdisbursement',['club' => $count->club])}}" style="text-decoration:none; color:#333" >
                    <div>
                        <span class="fullname">{{ $count->club }}</span>
                    </div>
                    <div class="content">
                        <span class="valid">Valid - {{ $count->valid_count }}</span>
                        <span class="invalid">Invalid - {{ $count->invalid_count }}</span>
                        <span class="pending">Pending - {{ $count->pending_count }}</span>
                    </div>
                </a> 
            @endforeach
            </div>
        </div>
    </div>

    @endsection
</body>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
</html>
@elseif(session('role') === 'Club')
    <div>
        <p>Sorry, you dont have the access to this page.</p>
    </div>
@endif