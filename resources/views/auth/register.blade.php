<!-- resources/views/auth/register.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'TechResale') }} - Register</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* Same base styles as login */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .auth-container {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            max-width: 520px;
            width: 100%;
            padding: 3rem 2.5rem;
            border: 1px solid #e0e0e0;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .auth-logo {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            margin-bottom: 1rem;
        }

        .auth-logo i {
            font-size: 2rem;
            color: #0066ff;
        }

        .auth-logo span {
            font-size: 1.8rem;
            font-weight: 800;
            color: #1a1a1a;
        }

        .auth-header h1 {
            font-size: 1.8rem;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .auth-header p {
            color: #666;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.4rem;
            color: #1a1a1a;
            font-size: 0.9rem;
        }

        .form-group label i {
            color: #0066ff;
            margin-right: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s;
            background: #fafafa;
            color: #1a1a1a;
            font-family: inherit;
        }

        .form-group input:focus {
            border-color: #0066ff;
            outline: none;
            box-shadow: 0 0 0 4px rgba(0,102,255,0.1);
            background: #ffffff;
        }

        .form-group input.error {
            border-color: #dc3545;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.8rem;
            margin-top: 0.3rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .password-hint {
            font-size: 0.8rem;
            color: #666;
            margin-top: 0.3rem;
        }

        .password-hint i {
            color: #0066ff;
        }

        .btn-register {
            width: 100%;
            padding: 1rem;
            background: #0066ff;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-register:hover {
            background: #0052cc;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(0,102,255,0.3);
        }

        .terms {
            margin: 1.5rem 0;
            font-size: 0.85rem;
            color: #666;
            text-align: center;
        }

        .terms a {
            color: #0066ff;
            text-decoration: none;
            font-weight: 500;
        }

        .terms a:hover {
            text-decoration: underline;
        }

        .auth-footer {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e0e0e0;
        }

        .auth-footer p {
            color: #666;
            font-size: 0.95rem;
        }

        .auth-footer a {
            color: #0066ff;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .auth-footer a:hover {
            color: #0052cc;
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 600px) {
            body {
                padding: 1rem;
            }

            .auth-container {
                padding: 2rem 1.5rem;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .auth-header h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <!-- Header -->
        <div class="auth-header">
            <a href="{{ route('home') }}" class="auth-logo">
                <i class="fas fa-mobile-alt"></i>
                <span>TechResale</span>
            </a>
            <h1>Create Account 🚀</h1>
            <p>Join India's trusted tech marketplace</p>
        </div>

        <!-- Register Form -->
        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name">
                    <i class="fas fa-user"></i> Full Name
                </label>
                <input 
                    id="name" 
                    type="text" 
                    name="name" 
                    value="{{ old('name') }}" 
                    required 
                    autofocus 
                    placeholder="John Doe"
                    class="@error('name') error @enderror"
                >
                @error('name')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">
                    <i class="fas fa-envelope"></i> Email Address
                </label>
                <input 
                    id="email" 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    placeholder="you@example.com"
                    class="@error('email') error @enderror"
                >
                @error('email')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Password & Confirm -->
            <div class="form-row">
                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock"></i> Password
                    </label>
                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        required 
                        placeholder="Min 8 chars"
                        class="@error('password') error @enderror"
                    >
                    @error('password')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="password-hint">
                        <i class="fas fa-info-circle"></i> At least 8 characters, 1 uppercase & number
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">
                        <i class="fas fa-check-circle"></i> Confirm
                    </label>
                    <input 
                        id="password_confirmation" 
                        type="password" 
                        name="password_confirmation" 
                        required 
                        placeholder="Confirm password"
                    >
                </div>
            </div>

            <!-- Terms -->
            <div class="terms">
                <i class="fas fa-shield-alt" style="color: #0066ff;"></i>
                By registering, you agree to our 
                <a href="#">Terms of Service</a> and 
                <a href="#">Privacy Policy</a>
            </div>

            <!-- Register Button -->
            <button type="submit" class="btn-register">
                <i class="fas fa-user-plus"></i> Create Account
            </button>
        </form>

        <!-- Footer -->
        <div class="auth-footer">
            <p>Already have an account? <a href="{{ route('login') }}">Log In</a></p>
        </div>
    </div>

    <script>
        // Password validation
        document.getElementById('registerForm')?.addEventListener('submit', function(e) {
            const password = document.getElementById('password');
            const confirm = document.getElementById('password_confirmation');
            let isValid = true;

            // Reset errors
            document.querySelectorAll('.error-message').forEach(el => el.remove());
            document.querySelectorAll('.error').forEach(el => el.classList.remove('error'));

            // Validate password strength
            const passwordValue = password.value;
            if (passwordValue.length < 8) {
                showFieldError(password, 'Password must be at least 8 characters');
                isValid = false;
            }

            // Check password match
            if (passwordValue !== confirm.value) {
                showFieldError(confirm, 'Passwords do not match');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
            }
        });

        function showFieldError(input, message) {
            input.classList.add('error');
            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message';
            errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
            input.closest('.form-group').appendChild(errorDiv);
        }

        // Real-time password match check
        document.getElementById('password_confirmation')?.addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirm = this.value;
            
            // Remove existing error
            const existingError = this.closest('.form-group').querySelector('.error-message');
            if (existingError) existingError.remove();
            this.classList.remove('error');

            if (confirm && password !== confirm) {
                showFieldError(this, 'Passwords do not match');
            }
        });
    </script>
</body>
</html>