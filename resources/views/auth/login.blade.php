<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Login</title>
  <!-- Custom fonts for this template-->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  @include('cookies.cookie')

  <style>
    @import url('https://fonts.googleapis.com/css?family=Raleway:400,700');

    *, *:before, *:after {
      box-sizing: border-box;
    }

    body {
      min-height: 100vh;
      font-family: 'Raleway', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0;
    }

   .container {
      position: relative;
      width: 400px;
      padding: 30px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
      border-radius: 8px;
      text-align: center;
    }

   .container h1 {
      margin-bottom: 20px;
      font-size: 24px;
      color: #ff3f81;
    }

   .container input {
      width: calc(100% - 30px);
      padding: 15px;
      margin: 10px 0;
      border-radius: 20px;
      border: 1px solid #ccc;
      font-size: 16px;
      font-family: inherit;
    }

   .container button {
      width: 90%;
      padding: 15px;
      border: none;
      border-radius: 10px;
      background: #ff3f81;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s;
    }

   .container button:hover {
      background: #3b5cb8;
    }

   .alert {
      color: #e74a3b;
      margin-bottom: 20px;
      text-align: left;
    }

    #my-background {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
    }
  </style>
</head>
<body>
  <div id="my-background"></div>
  <div class="container">
    <h1>Welcome Back!</h1>
    <form action="{{ route('login.action') }}" method="POST">
      @csrf
      @if ($errors->any())
        <div class="alert">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <input name="email" type="email" placeholder="Enter Email Address...">
      <input name="password" type="password" placeholder="Password">
      <button type="submit">Login</button>
    </form>
  </div>

  <!-- Local Scripts -->
  <script src="{{ asset('admin_assets/js/three.min.js') }}"></script>
  <script src="{{ asset('admin_assets/js/vanta.net.min.js') }}"></script>
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      VANTA.NET({
        el: "#my-background",
        mouseControls: true,
        touchControls: true,
        gyroControls: false,
        minHeight: 200.00,
        minWidth: 200.00,
        scale: 1.00,
        scaleMobile: 1.00
      });
    });
  </script>
</body>
