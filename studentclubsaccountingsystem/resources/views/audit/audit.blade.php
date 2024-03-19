@if(session('role') === 'Audit')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit</title>
    <link rel="stylesheet" href="{{asset('./assets/css/audit.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>
<body>

<div class="maincontainer">
        <div class="sidebar">
            <div class="title">
                <span> 
                    @auth
                        {{session('club')}} Club
                    @endauth
                </span>
            </div>
            
            <div class="nav-container">
                <a class="{{'auditdashboard' == request()->path() ? 'active' : ''}}" href="{{route('auditdashboard')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M4 13h6c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v8c0 .55.45 1 1 1zm0 8h6c.55 0 1-.45 1-1v-4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v4c0 .55.45 1 1 1zm10 0h6c.55 0 1-.45 1-1v-8c0-.55-.45-1-1-1h-6c-.55 0-1 .45-1 1v8c0 .55.45 1 1 1zM13 4v4c0 .55.45 1 1 1h6c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1h-6c-.55 0-1 .45-1 1z"/></svg>Dashboard</a>
                <a href="{{route('auditnotifications')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512"><path fill="currentColor" d="M440.08 341.31c-1.66-2-3.29-4-4.89-5.93c-22-26.61-35.31-42.67-35.31-118c0-39-9.33-71-27.72-95c-13.56-17.73-31.89-31.18-56.05-41.12a3 3 0 0 1-.82-.67C306.6 51.49 282.82 32 256 32s-50.59 19.49-59.28 48.56a3.13 3.13 0 0 1-.81.65c-56.38 23.21-83.78 67.74-83.78 136.14c0 75.36-13.29 91.42-35.31 118c-1.6 1.93-3.23 3.89-4.89 5.93a35.16 35.16 0 0 0-4.65 37.62c6.17 13 19.32 21.07 34.33 21.07H410.5c14.94 0 28-8.06 34.19-21a35.17 35.17 0 0 0-4.61-37.66ZM256 480a80.06 80.06 0 0 0 70.44-42.13a4 4 0 0 0-3.54-5.87H189.12a4 4 0 0 0-3.55 5.87A80.06 80.06 0 0 0 256 480Z"/></svg>Notifications</a>
                <a href="{{route('getClubs') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M5 7a2 2 0 1 0 0-4a2 2 0 0 0 0 4Zm14 0a2 2 0 1 0 0-4a2 2 0 0 0 0 4Zm2 12a2 2 0 1 1-4 0a2 2 0 0 1 4 0ZM5 21a2 2 0 1 0 0-4a2 2 0 0 0 0 4ZM7.83 6a2.995 2.995 0 0 0 0-2h4.67A2.5 2.5 0 0 1 15 6.5V9h2.5a2.5 2.5 0 0 1 2.5 2.5v4.67a2.997 2.997 0 0 0-2 0V11.5a.5.5 0 0 0-.5-.5H15v1.5a2.5 2.5 0 0 1-2.5 2.5H11v2.5a.5.5 0 0 0 .5.5h4.67a2.997 2.997 0 0 0 0 2H11.5A2.5 2.5 0 0 1 9 17.5V15H6.5A2.5 2.5 0 0 1 4 12.5V7.83a2.995 2.995 0 0 0 2 0v4.67a.5.5 0 0 0 .5.5H9v-1.5A2.5 2.5 0 0 1 11.5 9H13V6.5a.5.5 0 0 0-.5-.5H7.83ZM13 12.5V11h-1.5a.5.5 0 0 0-.5.5V13h1.5a.5.5 0 0 0 .5-.5Z"/></svg>Clubs</a>
                <a href="{{route('auditMembers')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M2 22a8 8 0 1 1 16 0H2Zm8-9c-3.315 0-6-2.685-6-6s2.685-6 6-6s6 2.685 6 6s-2.685 6-6 6Zm7.363 2.233A7.505 7.505 0 0 1 22.983 22H20c0-2.61-1-4.986-2.637-6.767Zm-2.023-2.276A7.98 7.98 0 0 0 18 7a7.964 7.964 0 0 0-1.015-3.903A5 5 0 0 1 21 8a4.999 4.999 0 0 1-5.66 4.957Z"/></svg>Members</a>
            </div>

            <div class="currentuser">
                <span>
                    @auth
                        {{auth()->user()->name}}
                    @endauth
                </span>
            </div>
                
            <div class="logout">
                @auth
                    <a href="{{route('logout')}}">Logout</a>
                @endauth 
            </div>
            <hr class="hr">
            <div class="footer" >
                <span>Copyright <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 256 256"><path fill="currentColor" d="M128 20a108 108 0 1 0 108 108A108.12 108.12 0 0 0 128 20Zm0 192a84 84 0 1 1 84-84a84.09 84.09 0 0 1-84 84Zm41.59-52.79a52 52 0 1 1 0-62.43a12 12 0 1 1-19.18 14.42a28 28 0 1 0 0 33.6a12 12 0 1 1 19.18 14.41Z"/></svg> 2023</span><br>
                <span>Gyelpozhing College of Information Technology<br>All Rights Reserved.</span>
            </div>
            
        </div>

        <div class="content" style="background:#f0f8ff">
            @yield('content')
        </div>
    </div>
</body>
</html>
@elseif(session('role') === 'Club')
    <div>
        <p>Sorry, you dont have the access to this page.</p>
    </div>
@endif

