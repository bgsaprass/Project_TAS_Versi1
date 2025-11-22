<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Fruitables</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body { background-color: #f6fdf4; font-family: 'Segoe UI', sans-serif; }
    .login-card {
      max-width: 420px; margin: auto; margin-top: 80px;
      padding: 30px; border: 1px solid #cdeac0; border-radius: 12px;
      background-color: #fff; box-shadow: 0 0 30px rgba(0,0,0,0.05);
    }
    .login-card h1 { color: #7fc242; font-weight: 600; }
    .form-control:focus {
      border-color: #7fc242;
      box-shadow: 0 0 0 0.2rem rgba(127, 194, 66, 0.25);
    }
    .btn-green {
      background-color: #7fc242; border-color: #7fc242; color: #fff;
    }
    .btn-green:hover {
      background-color: #6bb03a; border-color: #6bb03a;
    }
    .form-check-input:checked {
      background-color: #7fc242; border-color: #7fc242;
    }
    .forgot-link {
      font-size: 0.9rem; color: #7fc242;
    }
    .forgot-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <main class="container">
    <form method="POST" action="{{ route('login') }}" class="login-card">
      @csrf
      <h1 class="h3 mb-4 text-center">Login</h1>

      @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif

      <div class="form-floating mb-3">
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
               name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
        <label for="email"><i class="fa fa-envelope me-2"></i>Email</label>
        @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-floating mb-3">
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
               name="password" placeholder="Password" required>
        <label for="password"><i class="fa fa-lock me-2"></i>Password</label>
        @error('password')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
          <label class="form-check-label" for="remember">Remember Me</label>
        </div>
        <a href="{{ route('password.request') }}" class="forgot-link">Forgot Password?</a>
      </div>

      <button class="w-100 btn btn-lg btn-green" type="submit">Sign in</button>
    </form>
  </main>
</body>
</html>
