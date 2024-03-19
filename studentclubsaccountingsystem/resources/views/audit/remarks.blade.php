@if(session('role') === 'Audit')
@extends('audit.audit')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remarks</title>
    <link rel="stylesheet" href="{{asset('./assets/css/addFeedback.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    @section('content')
    <div class="main-container">
        @if(session()->has('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif

        <div class="header">
            <span>Add Remark</span>
        </div>

        <div class="content">
            <!-- form  -->
            <div class="form-container">
                <label>Remarks :</label>
                <form action="{{route('submit.remarks',['id' => $id])}}" method="POST">
                    @csrf
                    <textarea placeholder="Write your remarks..." name="content" id="content" cols="60" rows="5" required style="padding-left:10px;padding-top:10px"></textarea>
                    <div>
                        <label>Status :</label>
                        <label style="margin-inline:20px;margin-block:10px;color:green">
                            <input type="radio" name="status" value="Valid" required>
                            Valid
                        </label>
                        <label style="color:red">
                            <input type="radio" name="status" value="Invalid" required>
                            Invalid
                        </label>
                    </div>
                    <div class="button">
                        <button type="submit" >Submit</button>
                    </div>
                </form>
            </div>

            <!-- feedback -->
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
@elseif(session('role') === 'Club')
    <div>
        <p>Sorry, you dont have the access to this page.</p>
    </div>
@endif