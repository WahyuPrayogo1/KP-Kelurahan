<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SALAMIN KE BANG JAYI</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f3e5f5;
            font-family: 'Poppins', sans-serif;
        }

        h1 {
            color: #6F3A68;
        }

        p {
            color: #7a7a7a;
            font-size: 14px;
        }

        a {
            font-size: 14px;
            color: #6F3A68;
            text-decoration: none;
        }

        .login-image {
            background-image: url('/images/image-desa.png');
            background-size: cover;
            background-position: center;
            height: 100%;
        }

        .label-form {
            font-size: 14px;
            font-weight: 500;
            color: #4F4F4F;
        }

        /* Warna border saat input aktif (focus) */
        .form-control:focus {
            border-color: #6F3A68;
            box-shadow: 0 0 5px rgba(111, 58, 104, 0.5);
        }

        .form-control {
            border: none;
        }

        /* Warna label input */
        .label-form {
            color: #6F3A68;
        }

        /* Warna link login */
        .link-login {
            color: #6F3A68;
            text-decoration: none;
        }

        .link-login:hover {
            color: #4a2648;
        }

        .btn-custom {
            background-color: #6F3A68;
            color: white;
            border: none;
        }

        .btn-custom:hover {
            background-color: #6F3A68;
            color: white;
            border: none;
        }
    </style>
</head>

<body>
    <div class="container-fluid p-0 login-container">
        <div class="row g-0" style="height: 100vh;">
            <!-- Kolom Kiri: Form Login -->
            <div class="col-md-6 d-flex align-items-center justify-content-center login-form">
                <div style="width: 100%; max-width: 400px;">
                    <h1 class="fw-bold fs-1">LOGIN</h1>
                    <p>Selamat datang di <small style="color: #6F3A68; font-weight: bold">SALAMIN KE BANG JAY!</small></p>

                    <!-- Laravel Login Form -->
                    <form class="mt-5" method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Nomor WhatsApp -->
                        <div class="mb-3">
                            <label for="whatsapp_number" class="form-label label-form">No. Telepon</label>
                            <input type="text" class="form-control" id="whatsapp_number" name="whatsapp_number" value="{{ old('whatsapp_number') }}" required>
                            @error('whatsapp_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label label-form">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Lupa Password -->
                        <a href="{{ route('password.request') }}" class="d-block text-end mb-3 link-login">Lupa Password?</a>

                        <!-- Tombol Login -->
                        <button type="submit" class="btn btn-primary w-100 btn-custom">LOGIN</button>
                    </form>

                    <div class="mt-3 text-center">
                        <p>Belum punya Akun? <a href="{{route('register')}}">Daftar Sekarang</a></p>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Gambar -->
            <div class="col-md-6 login-image"></div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
