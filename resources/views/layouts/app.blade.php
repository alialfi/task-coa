<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chart of Account</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .custom-navbar {
            background-color: #0d5cab !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar mb-4">
        <div class="container">
            <a class="navbar-brand" href="/home">Chart of Account</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="/home" class="nav-link" style="color: white;">Home</a></li>
                    <li class="nav-item"><a href="/categories" class="nav-link" style="color: white;">Kategori</a></li>
                    <li class="nav-item"><a href="/coa" class="nav-link" style="color: white;">COA</a></li>
                    <li class="nav-item"><a href="/transactions" class="nav-link" style="color: white;">Transaksi</a></li>
                    <li class="nav-item"><form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-link nav-link" type="submit" style="color: white;">Logout</button>
                    </form></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
