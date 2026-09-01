
<!-- resources/views/auth/verify-email.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'TechResale') }} - Verify Email</title>
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
            max-width: 520px;
            width: 100%;
            padding: 3rem 2.5rem;
            border: 1px solid #e0e0e0;
            text-align: center;
        }

        .auth-logo {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            margin-bottom: 2rem;
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

        .icon-wrapper {
            width: 100px;
            height: 100px;
            background: #fff3e0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            position: relative;
        }

        .icon-wrapper i {
            font-size: 3.5rem;
            color: #ff9800;
        }

        .icon-wrapper .badge {
            position: absolute;
            bottom: 0;
            right: 0;
            background: #0066ff;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid #ffffff;
        }

        .icon-wrapper .badge i {
            font-size: 0.9rem;
            color: white;
        }

        h1 {
            font-size: 1.8rem;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .message-text {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.8;
            margin-bottom: 2rem;
        }

        .message-text strong {
            color: #1a1a1a;
        }

        .message-text .highlight {
            color: #0066ff;
            font-weight: 600;
        }

        .status-success {
            background: #d4edda;
            color: #155724;
            padding: 1rem 1.2rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            border: 1px solid #c3e6cb;
            display: flex;
            align-items: center;
            gap: 12px;
            text-align: left;
            font-size: 0.95rem;
        }

        .status-success i {
            color: #28a745;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 1rem 2.5rem;
            background: #0066ff;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.05rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            width: 100%;
            font-family: inherit;
        }

        .btn-primary:hover {
            background: #0052cc;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(0,102,255,0.3);
        }

        .btn-primary:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .btn-primary i {
            font-size: 1rem;
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0.8rem 2rem;
            background: transparent;
            color: #dc3545;
            border: 2px solid #dc3545;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            font-family: inherit;
            width: 100%;
        }

        .btn-outline:hover {
            background: #dc3545;
            color: white;
            transform: translateY(-2px);
        }

        .btn-outline i {
            font-size: 0.9rem;
        }

        .actions {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 1.5rem 0;
            color: #999;
            font-size: 0.85rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e0e0e0;
        }

        .help-text {
            font-size: 0.85rem;
            color: #999;
            margin-top: 1rem;
        }

        .help-text i {
            color: #0066ff;
        }

        .help-text a {
            color: #0066ff;
            text-decoration: none;
            font-weight: 500;
        }

        .help-text a:hover {
            text-decoration: underline;
        }

        .spinner {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 600px) {
            body {
                padding: 1rem;
            }

            .auth-container {
                padding: 2rem 1.5rem;
            }

            h1 {
                font-size: 1.5rem;
            }

            .icon-wrapper {
                width: 80px;
                height: 80px;
            }

            .icon-wrapper i {
                font-size: 2.8rem;
            }

            .icon-wrapper .badge {
                width: 28px;
                height: 28px;
            }

            .icon-wrapper .badge i {
                font-size: 0.75rem;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="auth-logo">
            <i class="fas fa-mobile-alt"></i>
            <span>TechResale</span>
        </a>

        <!-- Icon -->
        <div class="icon-wrapper">
            <i class="fas fa-envelope"></i>
            <div class="badge">
                <i class="fas fa-check"></i>
            </div>
        </div>

        <h1>Verify Your Email 📧</h1>
        
        <div class="message-text">
            Thanks for signing up! Before getting started, please verify your email address by clicking the link we just sent to 
            <strong>{{ Auth::user()->email ?? 'your email' }}</strong>
            <br><br>
            <span class="highlight">🔑 Verification required</span> — This helps us keep your account secure.
        </div>

        <!-- Success Message -->
        @if (session('status') == 'verification-link-sent')
            <div class="status-success">
                <i class="fas fa-check-circle"></i>
                <div>
                    <strong>Verification link sent!</strong><br>
                    A new verification link has been sent to your email address.
                </div>
            </div>
        @endif

        <!-- Actions -->
        <div class="actions">
            <form method="POST" action="{{ route('verification.send') }}" id="resendForm" style="width: 100%;">
                @csrf
                <button type="submit" class="btn-primary" id="resendBtn">
                    <i class="fas fa-paper-plane"></i>
                    <span id="btnText">Resend Verification Email</span>
                </button>
            </form>

            <div class="divider">or</div>

            <form method="POST" action="{{ route('logout') }}" style="width: 100%;">
                @csrf
                <button type="submit" class="btn-outline">
                    <i class="fas fa-sign-out-alt"></i>
                    Log Out
                </button>
            </form>
        </div>

        <!-- Help Text -->
        <div class="help-text">
            <i class="fas fa-info-circle"></i>
            Didn't receive the email? Check your spam folder or 
            <a href="#" onclick="event.preventDefault(); document.getElementById('resendForm').submit();">
                click here to resend
            </a>
        </div>

        <div class="help-text" style="margin-top: 0.5rem;">
            <i class="fas fa-clock" style="color: #ff9800;"></i>
            Verification link expires in <strong style="color: #1a1a1a;">60 minutes</strong>
        </div>
    </div>

    <script>
        document.getElementById('resendForm')?.addEventListener('submit', function(e) {
            const btn = document.getElementById('resendBtn');
            const btnText = document.getElementById('btnText');
            
            // Disable button and show loading
            btn.disabled = true;
            btnText.textContent = 'Sending...';
            btn.innerHTML = '<i class="fas fa-spinner spinner"></i> Sending...';
            
            // Re-enable after 3 seconds (in case of error)
            setTimeout(() => {
                btn.disabled = false;
                btnText.textContent = 'Resend Verification Email';
                btn.innerHTML = '<i class="fas fa-paper-plane"></i> Resend Verification Email';
            }, 3000);
        });

        // Auto-resend if user clicks on "click here" link
        document.querySelector('.help-text a')?.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('resendForm').submit();
        });
    </script>
</body>
</html>