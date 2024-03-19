<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="{{asset('./assets/css/resetPassword.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>
    <div class="container-fluid">
        <div class="mt-5">
            @if($errors->any())
                <div class="col-12">
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{$error}}</div>
                    @endforeach
                </div>
            @endif

            <!-- printing the error  -->
            @if(session()->has('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
            @endif

            <!-- printing the success message  -->
            @if(session()->has('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
        </div>

        <h4 data-aos="fade-down" data-aos-duration="1000">Reset Password</h4>
        <form action="{{route('reset-password.post')}}" method="POST" class="resetForm" data-aos="fade-zoom-in" data-aos-duration="1000">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control">
            </div> 
            <div class="mb-3">
                <label for="newpassword" class="form-label">New Password</label>
                <input type="password" name="new_password" class="form-control">
            </div> 
            <div class="mb-3">
                <label for="confirmpassword" class="form-label">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control">
            </div> 
            <button type="submit" data-aos="fade-up" data-aos-duration="1000">Submit</button>
        </form>
    </div>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
</body>
</body>
</html>
