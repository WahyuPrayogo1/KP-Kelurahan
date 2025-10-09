<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SALAMIN KE BANG JAYI</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        body {
            background-color: #f3e5f5;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
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
            min-height: 300px;
        }

        .label-form {
            font-size: 14px;
            font-weight: 500;
            color: #6F3A68;
        }

        .form-control:focus {
            border-color: #6F3A68;
            box-shadow: 0 0 5px rgba(111, 58, 104, 0.5);
        }

        .form-control {
            border: none;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

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
            transition: all 0.3s;
            box-shadow: 0 2px 5px rgba(111, 58, 104, 0.3);
        }

        .btn-custom:hover {
            background-color: #5a2d53;
            color: white;
        }

        .input-group-text {
            background-color: white;
            border-right: none;
        }

        .phone-input {
            border-left: none;
            padding-left: 0.5rem;
        }

        .input-hint {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }

        .register-container {
            min-height: 100vh;
        }

        .register-form {
            padding: 2rem;
        }

        @media (min-width: 768px) {
            .register-image {
                min-height: 100vh;
            }

            .register-form {
                padding: 3rem;
            }
        }

        @media (max-width: 767.98px) {
            .register-form {
                width: 100%;
                max-width: 100%;
                padding: 1.5rem;
            }

            h1 {
                font-size: 1.75rem !important;
            }

            .register-image {
                display: none;
            }
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 74%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6F3A68;
            cursor: pointer;
        }

        .password-container {
            position: relative;
        }
    </style>
</head>

<body>
    <div class="container-fluid p-0 register-container">
        <div class="row g-0 min-vh-100">
            <!-- Kolom Kiri: Form Register -->
            <div class="col-md-6 d-flex align-items-center justify-content-center register-form">
                <div style="width: 100%; max-width: 400px;">
                    <h1 class="fw-bold fs-1 mb-3">REGISTER</h1>
                    <p class="mb-4">Daftar untuk bergabung di <span style="color: #6F3A68; font-weight: bold">SALAMIN KE BANG JAY!</span></p>

                    <!-- Laravel Register Form -->
                    <form class="mt-4" method="POST" action="{{ route('register') }}" id="registerForm">
                        @csrf

                        <!-- Hidden field for formatted number -->
                        <input type="hidden" name="formatted_whatsapp_number" id="formattedWhatsappNumber">

                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="name" class="form-label label-form">Nama Lengkap</label>
                            <input type="text" class="form-control shadow-sm rounded" id="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Nomor WhatsApp -->
                        <div class="mb-3">
                            <label for="whatsapp_number" class="form-label label-form">Nomor WhatsApp</label>
                            <div class="input-group shadow-sm rounded">
                                <span class="input-group-text">+62</span>
                                <input type="tel"
                                       class="form-control phone-input"
                                       id="whatsapp_number"
                                       name="whatsapp_number"
                                       value="{{ old('whatsapp_number') }}"
                                       required
                                       autocomplete="tel"
                                       placeholder="8123456789"
                                       pattern="[0-9]*"
                                       inputmode="numeric">
                            </div>
                            <div class="input-hint">Masukkan nomor tanpa 0 di depan (contoh: 8123456789)</div>
                            <div class="alert alert-warning mt-2 py-2 px-3" style="font-size: 13px; background-color: #fdf4ff; color: #6F3A68; border: 1px solid #e0b3de;">
                                <i class="bi bi-info-circle me-1"></i>
                                Pastikan nomor WhatsApp yang kamu masukkan benar. Nomor ini akan digunakan untuk menerima notifikasi dari sistem kami.
                            </div>

                            @error('whatsapp_number')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                            @error('formatted_whatsapp_number')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3 password-container">
                            <label for="password" class="form-label label-form">Password</label>
                            <input type="password" class="form-control shadow-sm rounded" id="password" name="password" required autocomplete="new-password">
                            <button type="button" class="password-toggle" id="togglePassword">
                                <i class="bi bi-eye"></i>
                            </button>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="mb-3 password-container">
                            <label for="password_confirmation" class="form-label label-form">Konfirmasi Password</label>
                            <input type="password" class="form-control shadow-sm rounded" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                            <button type="button" class="password-toggle" id="togglePasswordConfirmation">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>

                        <!-- Tombol Register -->
                        <button type="submit" class="btn btn-custom w-100 py-2 mt-2 shadow-sm">REGISTER</button>
                    </form>

                    <div class="mt-3 text-center">
                        <p>Sudah punya Akun? <a href="{{ route('login') }}" class="link">Login</a></p>
                        <a href="{{route('home')}}">Kembali</a>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Gambar -->
            <div class="col-md-6 register-image d-none d-md-block"></div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const phoneInput = document.getElementById('whatsapp_number');
            let phoneNumber = phoneInput.value.replace(/\D/g, '');

            // Validasi nomor WhatsApp
            if (phoneNumber.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Nomor WhatsApp Kosong',
                    text: 'Silakan masukkan nomor WhatsApp Anda',
                    confirmButtonColor: '#6F3A68'
                });
                return;
            }

            // Validasi harus dimulai dengan 8
            if (!phoneNumber.startsWith('8')) {
                Swal.fire({
                    icon: 'error',
                    title: 'Format Nomor Salah',
                    html: 'Nomor WhatsApp harus dimulai dengan angka <strong>8</strong> (contoh: 8123456789)',
                    confirmButtonColor: '#6F3A68'
                });
                return;
            }

            // Validasi panjang nomor (10-13 digit setelah 0 dihilangkan)
            if (phoneNumber.length < 10 || phoneNumber.length > 13) {
                Swal.fire({
                    icon: 'error',
                    title: 'Nomor WhatsApp Tidak Valid',
                    html: 'Nomor WhatsApp harus terdiri dari <strong>10-13 digit</strong> (tidak termasuk kode negara)',
                    confirmButtonColor: '#6F3A68'
                });
                return;
            }

            // Validasi password
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;

            if (password !== passwordConfirmation) {
                Swal.fire({
                    icon: 'error',
                    title: 'Password Tidak Cocok',
                    text: 'Password dan konfirmasi password harus sama',
                    confirmButtonColor: '#6F3A68'
                });
                return;
            }

            // Hilangkan leading 0 jika ada
            if (phoneNumber.startsWith('0')) {
                phoneNumber = phoneNumber.substring(1);
            }

            // Format ke 628 untuk dikirim ke server
            const formattedNumber = '62' + phoneNumber;

            // Set nilai ke hidden field
            document.getElementById('formattedWhatsappNumber').value = formattedNumber;
            // Setelah nomor sudah divalidasi dan diformat
            Swal.fire({
                icon: 'info',
                title: 'Perhatian!',
                html: 'Nomor WhatsApp <strong>+' + formattedNumber + '</strong> akan digunakan untuk menerima notifikasi dari sistem kami. Pastikan nomornya benar sebelum melanjutkan.',
                confirmButtonText: 'Ya, benar',
                showCancelButton: true,
                cancelButtonText: 'Periksa Lagi',
                confirmButtonColor: '#6F3A68'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });

        // Validasi input hanya angka dan maksimal 13 digit
        document.getElementById('whatsapp_number').addEventListener('input', function(e) {
            this.value = this.value.replace(/\D/g, '');

            // Batasi panjang input maksimal 13 digit
            if (this.value.length > 13) {
                this.value = this.value.substring(0, 13);
                Swal.fire({
                    icon: 'warning',
                    title: 'Maksimal 13 Digit',
                    text: 'Nomor WhatsApp maksimal 13 digit (tidak termasuk kode negara)',
                    confirmButtonColor: '#6F3A68',
                    timer: 2000,
                    timerProgressBar: true
                });
            }
        });

        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const togglePasswordConfirmation = document.getElementById('togglePasswordConfirmation');
        const password = document.getElementById('password');
        const passwordConfirmation = document.getElementById('password_confirmation');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
        });

        togglePasswordConfirmation.addEventListener('click', function() {
            const type = passwordConfirmation.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirmation.setAttribute('type', type);
            this.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
        });

        // Tampilkan pesan error dari server jika ada
        @if($errors->any())
            @foreach($errors->all() as $error)
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ $error }}',
                    confirmButtonColor: '#6F3A68'
                });
            @endforeach
        @endif
    </script>
</body>
</html>
