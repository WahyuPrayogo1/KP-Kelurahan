<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SALAMIN KE BANG JAYI</title>
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

        .register-image {
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

        /* Warna link */
        .link {
            color: #6F3A68;
            text-decoration: none;
        }

        .link:hover {
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

        .small-placeholder::placeholder {
            font-size: 0.85rem; 
            color: #6c757d; 
        }

    </style>
</head>

<body>
    <div class="container-fluid p-0 register-container">
        <div class="row g-0" style="height: 100vh;">
            <!-- Kolom Kiri: Form Register -->
            <div class="col-md-6 d-flex align-items-center justify-content-center register-form">
                <div style="width: 100%; max-width: 400px;">
                    <h1 class="fw-bold fs-1">REGISTER</h1>
                    <p>Daftar untuk bergabung di <small style="color: #6F3A68; font-weight: bold">SALAMIN KE BANG JAY!</small></p>

                    <!-- Laravel Register Form -->
                    <form class="mt-4" method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="name" class="form-label label-form">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Nomor WhatsApp -->
                        <div class="mb-3">
                            <label for="whatsapp_number" class="form-label label-form">Nomor WhatsApp</label>
                            <input 
                                type="text" 
                                class="form-control small-placeholder" 
                                id="whatsapp_number" 
                                name="whatsapp_number" 
                                value="{{ old('whatsapp_number') }}" 
                                required 
                                autocomplete="tel"
                                maxlength="15"
                                inputmode="numeric"
                                pattern="08[0-9]{7,13}"
                                placeholder="Contoh: 08xxxxxxxxxx"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                title="Nomor harus diawali 08 dan maksimal 15 digit angka.">

                            @error('whatsapp_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label label-form">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required autocomplete="new-password">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label label-form">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                            @error('password_confirmation')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Tombol Register -->
                        <button type="submit" class="btn btn-primary w-100 btn-custom">REGISTER</button>
                    </form>

                    <div class="mt-3 text-center">
                        <p>Sudah punya Akun? <a href="{{ route('login') }}" class="link">Login</a></p>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Gambar -->
            <div class="col-md-6 register-image"></div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
