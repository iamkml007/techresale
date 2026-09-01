<!-- resources/views/auth/forgot-password.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'TechResale') }} - Reset Password</title>
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

        .auth-header .icon-wrapper {
            width: 80px;
            height: 80px;
            background: #f0f7ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }

        .auth-header .icon-wrapper i {
            font-size: 2.5rem;
            color: #0066ff;
        }

        .auth-header h1 {
            font-size: 1.8rem;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .auth-header p {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.6;
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

        .error-message {
            color: #dc3545;
            font-size: 0.85rem;
            margin-top: 0.3rem;
            display: flex;
            align-items: center;
            gap: 5px;
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
            font-size: 1.2rem;
        }

        .btn-submit {
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

        .btn-submit:hover {
            background: #0052cc;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(0,102,255,0.3);
        }

        .btn-submit:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
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

        .back-to-login {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #666;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
            margin-top: 0.5rem;
        }

        .back-to-login:hover {
            color: #0066ff;
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
            <div class="icon-wrapper">
                <i class="fas fa-key"></i>
            </div>
            <h1>Reset Password 🔑</h1>
            <p>Enter your email address and we'll send you a link to reset your password.</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="session-status">
                <i class="fas fa-check-circle"></i>
                {{ session('status') }}
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('password.email') }}" id="resetForm">
            @csrf

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
                    autofocus 
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

            <!-- Submit Button -->
            <button type="submit" class="btn-submit" id="submitBtn">
                <i class="fas fa-paper-plane"></i> 
                <span id="btnText">Send Reset Link</span>
            </button>
        </form>

        <!-- Footer -->
        <div class="auth-footer">
            <a href="{{ route('login') }}" class="back-to-login">
                <i class="fas fa-arrow-left"></i> Back to Login
            </a>
            <p style="margin-top: 1rem;">
                Don't have an account? <a href="{{ route('register') }}">Sign Up</a>
            </p>
        </div>
    </div>

    <script>
        document.getElementById('resetForm')?.addEventListener('submit', function(e) {
            const email = document.getElementById('email');
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            
            // Reset errors
            document.querySelectorAll('.error-message').forEach(el => el.remove());
            email.classList.remove('error');

            // Validate email
            if (!email.value.trim()) {
                showFieldError(email, 'Email address is required');
                e.preventDefault();
                return;
            }

            if (!isValidEmail(email.value)) {
                showFieldError(email, 'Please enter a valid email address');
                e.preventDefault();
                return;
            }

            // Show loading state
            submitBtn.disabled = true;
            btnText.textContent = 'Sending...';
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
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

        // Real-time validation
        document.getElementById('email')?.addEventListener('input', function() {
            const error = this.closest('.form-group').querySelector('.error-message');
            if (error) error.remove();
            this.classList.remove('error');
        });
    </script>
</body>
</html>