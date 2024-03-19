@if(session('role') === 'Audit')
@extends('audit.audit')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members</title>
    <link rel="stylesheet" href="{{asset('./assets/css/members.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    @section('content')
    <div class="members">
            <div class="dash-header">
                <span>Members</span>
            </div>
            <div class="mem-container">
                 @foreach ($members as $members)
                <div class="item">
                    <div>
                        <span class="fullname">{{$members->name}}</span>
                    </div>
                    <div class="content">
                        <p >{{$members->email}}</p>
                    </div>
                </div>
                @endforeach
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