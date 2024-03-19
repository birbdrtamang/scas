@if(session('role') === 'Club')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <link rel="stylesheet" href="{{asset('./assets/css/sidebar.css')}}">
</head>
<body>
    <div class="container">
        <ul>
            <a href="{{ route('clubdashboard')}}"><li>Dashboard</li></a>
            <a href="{{ route('cashdisbursement') }}"><li>Cash Disbursement</li></a>
            <a href="#"><li>Notifications</li></a>
            <a href="#"><li>Members</li></a>
        </ul>
    </div>
</body>
</html>

@elseif(session('role') === 'Audit')
    <div>
        <p>Sorry, you dont have the access to this page.</p>
    </div>
@endif
