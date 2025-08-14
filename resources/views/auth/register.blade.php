<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mekar Tani Desa Sukaraja</title>

  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      font-family: sans-serif;
    }

    .container {
      max-width: 450px;
      width: 100%;
      padding: 20px;
      background-color: #ffffff;
      border: 1px solid #ddd;
      border-radius: 5px;
    }

    .text-center img {
      width: 90px;
      margin-bottom: 10px;
    }

    h3 {
      font-size: 1.3rem;
      text-align: center;
      font-weight: bold;
      color: #333;
    }

    .heading-login {
      font-size: 1rem;
      text-align: center;
      color: #555;
      margin-bottom: 20px;
    }

    .form-control-user {
      padding: 0.5rem;
      font-size: 1rem;
      border-radius: 4px;
      border: 1px solid #ccc;
    }

    .btn-user {
      width: 100%;
      padding: 0.5rem;
      font-size: 1rem;
      background-color: #4e73df;
      color: white;
      border: none;
      border-radius: 4px;
    }

    .btn-user:hover {
      background-color: #3c5fd3;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .alert {
      font-size: 0.9rem;
    }

    .text-center.mt-2 a {
      font-size: 0.9rem;
      color: #4e73df;
      text-decoration: none;
    }

    .text-center.mt-2 a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="text-center">
      {{-- <img src="{{ asset('img/logo.png') }}" alt="Logo">
      <h3>Rencana Kebutuhan Petani</h3> --}}
      <div class="heading-login">Create Account</div>
    </div>

    <form action="{{ route('register.simpan') }}" method="POST" class="user">
      @csrf
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <div class="form-group">
        <input name="nama" type="text" class="form-control form-control-user" placeholder="Name">
      </div>
      <div class="form-group">
        <input name="email" type="email" class="form-control form-control-user" placeholder="Email Address">
      </div>
      <div class="form-group row">
        <div class="col-6">
          <input name="password" type="password" class="form-control form-control-user" placeholder="Password">
        </div>
        <div class="col-6">
          <input name="password_confirmation" type="password" class="form-control form-control-user" placeholder="Repeat Password">
        </div>
      </div>

      <button type="submit" class="btn-user">Register Account</button>
    </form>

    <div class="text-center mt-2">
      <a href="{{ route('login') }}">Already have an account? Login!</a>
    </div>
  </div>

  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
