@if(session('role') === 'Audit')
@extends('audit.audit')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Dashboard</title>
    <link rel="stylesheet" href="{{asset('./assets/css/auditDashboard.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    @section('content')
    <div class="dash-container">
        <div class="dash-header">
            <span>Dashboard</span>
        </div>

        <div class="data-container">
            <!-- data representation -->
            <div class="data-represent">
                <div class="graph">
                    <canvas id="barChart" ></canvas>
                </div>
            </div>

            <div class="noti-container">
                <span class="noti-header">Recent notifications</span>
                <div class="notifications">
                @foreach($notifications as $notifications)
                        <div class="item" >
                            <div>
                                <span class="fullname">{{$notifications->fullname}}</span>
                            </div>
                            <div class="content">
                                <p >{{$notifications->content}}</p>
                            </div>
                            <div class="date">
                                <span >{{$notifications->date}}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
        

        <script>
            // Get the statusCounts data from your Laravel variable
            var statusCounts = @json($statusCounts);

            // Extract club names and status counts
            var clubs = statusCounts.map(function(entry) {
                return entry.club;
            });

            var validCounts = statusCounts.map(function(entry) {
                return entry.valid_count;
            });

            var invalidCounts = statusCounts.map(function(entry) {
                return entry.invalid_count;
            });

            var pendingCounts = statusCounts.map(function(entry) {
                return entry.pending_count;
            });

            // Create a bar chart using Chart.js
            var ctx = document.getElementById('barChart').getContext('2d');
            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: clubs,
                    datasets: [
                        {
                            label: 'Valid',
                            backgroundColor: 'green',
                            data: validCounts,
                        },
                        {
                            label: 'Invalid',
                            backgroundColor: '#bb1311',
                            data: invalidCounts,
                        },
                        {
                            label: 'Pending',
                            backgroundColor: '#004f98',
                            data: pendingCounts,
                        },
                    ],
                },
                options: {
                    scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Clubs',
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Number of status',
                        },
                        beginAtZero: true,
                    },
                },
                },
            });
        </script>

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