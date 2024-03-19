@if(session('role') === 'Audit')
@extends('audit.audit')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="{{asset('./assets/css/notifications.css')}}">
</head>
<body>
    @section('content')
    <div class="noti-content">
        <div class="dash-header">
            <span>Notifications</span>
        </div>
        <div class="notifications">
                    @foreach ($notifications as $notifications)
                        <div class="item">
                                <div>
                                    <span class="fullname">{{$notifications->fullname}}</span>
                                </div>
                                <div>
                                    <p class="content">{{$notifications->content}}</p>
                                </div>
                                <div>
                                    <span class="date">{{$notifications->date}}</span>
                                </div>
                        </div> 
                    @endforeach
                </div>
    </div>
    @endsection
</body>


</html>


@elseif(session('role') === 'Club')
    <div>
        <p>Sorry, you dont have the access to this page.</p>
    </div>
@endif