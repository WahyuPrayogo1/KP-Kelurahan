<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - SALAMIN KE BANG JAYI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #6F3A68;
            --primary-hover: #5a2d53;
            --text-color: #4a4a4a;
            --light-gray: #f8f9fa;
            --border-color: #e0e0e0;
        }

        body {
            background-color: var(--light-gray);
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            line-height: 1.6;
        }

        .auth-container {
            max-width: 480px;
            margin: 2rem auto;
            padding: 2.5rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .auth-title {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
        }

        .auth-subtitle {
            color: #6c757d;
            font-size: 0.95rem;
        }

        .form-label {
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            color: var(--text-color);
        }

        .form-control {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(111, 58, 104, 0.15);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 0.75rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
        }

        .input-group-text {
            background-color: white;
            border-right: none;
            color: #6c757d;
        }

        .phone-input {
            border-left: none;
            padding-left: 0.5rem;
        }

        .input-hint {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 0.5rem;
        }

        .alert {
            border-radius: 8px;
            padding: 0.75rem 1.25rem;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            color: var(--primary-color);
            font-weight: 500;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: var(--primary-hover);
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="auth-container">
            <div class="auth-header">
                <h1 class="auth-title">Reset Password</h1>
                <p class="auth-subtitle">Masukkan nomor WhatsApp yang terdaftar</p>
            </div>

            <!-- Alert Messages -->
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show mb-4">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('password.send') }}" id="resetForm">
                @csrf

                <!-- Hidden field for formatted number -->
                <input type="hidden" name="formatted_whatsapp_number" id="formattedWhatsappNumber">

                <div class="mb-4">
                    <label for="whatsapp_number" class="form-label">Nomor WhatsApp</label>
                    <div class="input-group">
                        <span class="input-group-text">+62</span>
                        <input type="tel"
                               class="form-control phone-input @error('whatsapp_number') is-invalid @enderror"
                               id="whatsapp_number"
                               name="whatsapp_number"
                               value="{{ old('whatsapp_number') }}"
                               required
                               placeholder="8123456789"
                               pattern="[0-9]*"
                               inputmode="numeric"
                               minlength="9"
                               maxlength="15">
                    </div>
                    <div class="input-hint">Masukkan nomor tanpa 0 di depan (contoh: 8123456789)</div>
                    @error('whatsapp_number')
                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 mb-4" id="submitBtn">
                    <span class="spinner-border spinner-border-sm d-none me-2" role="status" aria-hidden="true"></span>
                    <i class="bi bi-whatsapp me-2"></i>Kirim Link Reset
                </button>

                <div class="text-center pt-2">
                    <a href="{{ route('login') }}" class="back-link">
                        <i class="bi bi-arrow-left-short me-1"></i>Kembali ke login
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('resetForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Format nomor sebelum submit
            const phoneInput = document.getElementById('whatsapp_number');
            let phoneNumber = phoneInput.value.replace(/\D/g, '');

            // Hilangkan leading 0 jika ada
            if (phoneNumber.startsWith('0')) {
                phoneNumber = phoneNumber.substring(1);
            }

            // Pastikan nomor dimulai dengan 8
            if (!phoneNumber.startsWith('8')) {
                phoneNumber = '8' + phoneNumber;
            }

            // Format ke 628 untuk dikirim ke server
            const formattedNumber = '62' + phoneNumber;

            // Set nilai ke hidden field
            document.getElementById('formattedWhatsappNumber').value = formattedNumber;

            // Tampilkan loading state
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.querySelector('.spinner-border').classList.remove('d-none');

            // Submit form
            this.submit();
        });

        // Validasi input hanya angka
        document.getElementById('whatsapp_number').addEventListener('input', function(e) {
            this.value = this.value.replace(/\D/g, '');
        });
    </script>
</body>
</html>
