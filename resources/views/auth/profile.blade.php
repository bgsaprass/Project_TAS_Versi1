<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Akun</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f6fdf4;
      font-family: 'Segoe UI', sans-serif;
    }
    .profile-card {
      max-width: 480px;
      margin: auto;
      margin-top: 80px;
      padding: 30px;
      border: 1px solid #cdeac0;
      border-radius: 12px;
      background-color: #fff;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.05);
    }
    .profile-card h2 {
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
    <div class="profile-card text-center">
      <h2 class="mb-4">Profil Akun</h2>
      <div class="mb-3">
        <i class="fa fa-user-circle fa-4x text-success mb-3"></i>
        <h5 class="mb-1">{{ Auth::user()->name }}</h5>
        <p class="text-muted">{{ Auth::user()->email }}</p>
      </div>

      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-green w-100">
          <i class="fa fa-sign-out-alt me-2"></i> Logout
        </button>
      </form>
    </div>
  </main>
</body>
</html>
