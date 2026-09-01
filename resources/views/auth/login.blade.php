

<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'TechResale') }} - Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
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
            max-width: 480px;
            width: 100%;
            padding: 3rem 2.5rem;
            border: 1px solid #e0e0e0;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 2.5rem;
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
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #1a1a1a;
            font-size: 0.95rem;
        }

        .form-group label i {
            color: #0066ff;
            margin-right: 8px;
        }

        .form-group .input-wrapper {
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 0.9rem 1rem;
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

        .form-group .input-wrapper i {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            cursor: pointer;
            transition: color 0.3s;
        }

        .form-group .input-wrapper i:hover {
            color: #0066ff;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.85rem;
            margin-top: 0.3rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .error-message i {
            font-size: 0.75rem;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 1.5rem 0;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #4a4a4a;
            cursor: pointer;
        }

        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #0066ff;
            cursor: pointer;
        }

        .forgot-link {
            color: #0066ff;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.3s;
        }

        .forgot-link:hover {
            color: #0052cc;
            text-decoration: underline;
        }

        .btn-login {
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
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-login:hover {
            background: #0052cc;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(0,102,255,0.3);
        }

        .btn-login:active {
            transform: translateY(0);
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

        .social-login {
            margin-top: 1.5rem;
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        .social-btn {
            flex: 1;
            padding: 0.8rem;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            background: white;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-weight: 500;
            color: #1a1a1a;
            text-decoration: none;
        }

        .social-btn:hover {
            border-color: #0066ff;
            background: #f0f7ff;
            transform: translateY(-2px);
        }

        .social-btn i {
            font-size: 1.2rem;
        }

        .social-btn.google i {
            color: #ea4335;
        }

        .social-btn.github i {
            color: #333;
        }

        .session-status {
            background: #d4edda;
            color: #155724;
            padding: 0.8rem 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            border: 1px solid #c3e6cb;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95rem;
        }

        .session-status i {
            color: #28a745;
        }

        /* Responsive */
        @media (max-width: 600px) {
            body {
                padding: 1rem;
            }

            .auth-container {
                padding: 2rem 1.5rem;
            }

            .auth-header h1 {
                font-size: 1.5rem;
            }

            .remember-forgot {
                flex-direction: column;
                gap: 0.8rem;
                align-items: flex-start;
            }

            .social-login {
                flex-direction: column;
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
            <h1>Welcome Back! 👋</h1>
            <p>Login to your account to continue</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="session-status">
                <i class="fas fa-check-circle"></i>
                {{ session('status') }}
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf

            <!-- Email -->
            <div class="form-group">
                <label for="email">
                    <i class="fas fa-envelope"></i> Email Address
                </label>
                <div class="input-wrapper">
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus 
                        autocomplete="username"
                        placeholder="you@example.com"
                        class="@error('email') error @enderror"
                    >
                </div>
                @error('email')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">
                    <i class="fas fa-lock"></i> Password
                </label>
                <div class="input-wrapper">
                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        required 
                        autocomplete="current-password"
                        placeholder="Enter your password"
                        class="@error('password') error @enderror"
                    >
                    <i class="fas fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                </div>
                @error('password')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Remember & Forgot -->
            <div class="remember-forgot">
                <label class="remember-me">
                    <input type="checkbox" name="remember" id="remember_me">
                    Remember me
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">
                        Forgot password?
                    </a>
                @endif
            </div>

            <!-- Login Button -->
            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> Log In
            </button>
        </form>

        <!-- Social Login -->
        <div class="social-login">
            <a href="#" class="social-btn google">
                <i class="fab fa-google"></i> Google
            </a>
            <a href="#" class="social-btn github">
                <i class="fab fa-github"></i> GitHub
            </a>
        </div>

        <!-- Footer -->
        <div class="auth-footer">
            <p>Don't have an account? <a href="{{ route('register') }}">Sign Up</a></p>
        </div>
    </div>

    <script>
        // Toggle Password Visibility
        document.getElementById('togglePassword')?.addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        // Form Validation
        document.getElementById('loginForm')?.addEventListener('submit', function(e) {
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            let isValid = true;

            // Reset errors
            document.querySelectorAll('.error-message').forEach(el => el.remove());
            document.querySelectorAll('.error').forEach(el => el.classList.remove('error'));

            // Validate email
            if (!email.value.trim()) {
                showFieldError(email, 'Email address is required');
                isValid = false;
            } else if (!isValidEmail(email.value)) {
                showFieldError(email, 'Please enter a valid email address');
                isValid = false;
            }

            // Validate password
            if (!password.value.trim()) {
                showFieldError(password, 'Password is required');
                isValid = false;
            } else if (password.value.length < 6) {
                showFieldError(password, 'Password must be at least 6 characters');
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

        function isValidEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        }
    </script>
</body>
</html>