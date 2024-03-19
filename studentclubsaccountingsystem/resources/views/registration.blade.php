<!-- to use th layout file -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="{{asset('./assets/css/signup.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>
    <div class="container">
        <div class="mt-1">
            @if($errors->any())
                <div class="col-8">
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

        <div class="login-form-container" data-aos="fade-zoom-in" data-aos-duration="1000">

            <div class="login-img">
                <div class="background-overlay">
                    <div class="overlay-text">
                        <h1 data-aos="fade-down" data-aos-duration="1000">Hello There,</h1>
                        <p data-aos="fade-up" data-aos-duration="2000" data-aos-delay="200">Balance Your Life with Our <b>Student Clubs Accounting System!</b></p>
                        <h5 data-aos="fade-up" data-aos-duration="2000" data-aos-delay="200">Register and Join Us Now!</h5>
                    </div>
                </div>
            </div>
            <div class="login-form">
                <h4>Signup</h4>
                <form action="{{route('signup.post')}}" method="POST" class="ms-auto me-auto">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Fullname</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>
                    <div class="mb-3">
                        <label for="club">Select club:</label>
                        <select name="club" id="club">
                            <option value="Rover">Rover</option>
                            <option value="Integrity">Integrity</option>
                            <option value="Tarayana">Tarayana</option>
                            <option value="G-Tech">G-Tech</option>
                            <option value="Literary & Interactive Art">Literary & Interactive Art</option>
                            <option value="Media, Marketing & Design (MMD)">Media, Marketing & Design (MMD)</option>
                            <option value="Start-Up Agency">Start-Up Agency</option>
                            <option value="Audit">Audit</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        Already registered?
                        <a href="{{route('login')}}" id="loginurl">Login</a>
                    </div>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>
</body>
</html>



    
