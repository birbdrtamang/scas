@if(session('role') === 'Club')
@extends('clubs.club')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club Dashboard</title>
    <link rel="stylesheet" href="{{asset('./assets/css/dashboard.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>
    @section('content')
    <div class="dash-container">
        <div class="dash-header">
            <span>Dashboard</span>
            <button class="button2">
                <a href="{{route('addDocument')}}" class="addbtn">
                    Add Document 
                </a>
            </button>
        </div>
        
        <div class="data-container">
            <!-- data representation -->
            <div class="data-represent">
                <div class="total-container">
                    <div class="total" style="background:#004f98">
                        <span style="font-size:small">Total Inflow</span>
                        <span style="font-size:20px; font-weight:bold">{{ $totalInflow }}</span>
                        <span style="font-size:small">BTN</span>
                    </div>
                    <div class="total" style="background:#bb1311">
                        <span style="font-size:small">Total Outflow</span>
                        <span style="font-size:20px; font-weight:bold">{{ $totalOutflow }}</span>
                        <span style="font-size:small">BTN</span>
                    </div>
                    <div class="total" style="background:green">
                        <span style="font-size:small">Total Balance</span>
                        <span style="font-size:20px; font-weight:bold">{{ $totalBalance }}</span>
                        <span style="font-size:small">BTN</span>
                        
                    </div>
                </div>

                <div class="graph">
                    <canvas id="barGraph" ></canvas>
                    <canvas id="lineGraph"></canvas>
                </div>
            </div>

            <!-- Notifications -->
            <div class="noti-container">
                <span class="noti-header">Recent notifications</span>
                <div class="notifications">
                    @if(count($notifications)>0)
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
                    @else
                    <div>
                        <p>No notifications yet.</p>
                    </div>
                    @endif
                </div>
                
            </div>
        </div>
        
    </div>
    <script>
        var data = @json($data);
        var labels = data.map(data => data.id);
        var inflowData = data.map(data=> data.inflow);
        var outflowData = data.map(data => data.outflow);
        var balanceData = data.map(data => data.balance);

        var ctx = document.getElementById('barGraph').getContext('2d');
        var lineGraph = document.getElementById('lineGraph').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Inflow',
                        data: inflowData,
                        backgroundColor: '#004f98',
                    },
                    {
                        label: 'Outflow',
                        data: outflowData,
                        backgroundColor: '#bb1311',
                    },
                    {
                        label: 'Balance',
                        data: balanceData,
                        backgroundColor: 'green',
                    },
                ],
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Document ID',
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Amount',
                        },
                        beginAtZero: true,
                    },
                },
            },
        });

        // line graph 
        new Chart(lineGraph, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Inflow',
                        data: inflowData,
                        backgroundColor: '#004f98',
                    },
                    {
                        label: 'Outflow',
                        data: outflowData,
                        backgroundColor: '#bb1311',
                    },
                    {
                        label: 'Balance',
                        data: balanceData,
                        backgroundColor: 'green',
                    },
                ],
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Document ID',
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Amount',
                        },
                        beginAtZero: true,
                    },
                },
            },
        });
    </script>
    @endsection
</body>

</html>


@elseif(session('role') === 'Audit')
    <div>
        <p>Sorry, you dont have the access to this page.</p>
    </div>
@endif