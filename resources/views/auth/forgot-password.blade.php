<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lupa Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f6fdf4;
      font-family: 'Segoe UI', sans-serif;
    }
    .forgot-card {
      max-width: 420px;
      margin: auto;
      margin-top: 80px;
      padding: 30px;
      border: 1px solid #cdeac0;
      border-radius: 12px;
      background-color: #fff;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.05);
    }
    .forgot-card h2 {
      color: #7fc242;
      font-weight: 600;
    }
    .btn-green {
      background-color: #7fc242;
      border-color: #7fc242;
      color: #fff;
    }
    .btn-green:hover {
      background-color: #6bb03a;
      border-color: #6bb03a;
    }
  </style>
</head>
<body>
  <main class="container">
    <form method="POST" action="{{ route('password.email') }}" class="forgot-card">
      @csrf
      <h2 class="mb-4 text-center">Lupa Password</h2>

      @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
      @endif

      <div class="form-floating mb-4">
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
               name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
        <label for="email"><i class="fa fa-envelope me-2"></i>Email</label>
        @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="btn btn-green w-100">
        <i class="fa fa-paper-plane me-2"></i> Kirim Link Reset
      </button>
    </form>
  </main>
</body>
</html>
