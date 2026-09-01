@extends('dashboard')

@section('content')
<!-- Dashboard CSS -->
<style>
    /* Dashboard Specific Styles */
    .dashboard-page {
        max-width: 1400px;
        margin: 2rem auto;
        padding: 0 2rem;
    }

    .page-title {
        font-size: 2rem;
        margin-bottom: 2rem;
        color: #1a1a1a;
        font-weight: 700;
    }

    .page-title span {
        color: #0066ff;
    }

    .dashboard-container {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 2rem;
    }

    /* Main Profile Card */
    .profile-main {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid #e0e0e0;
    }

    .profile-header {
        display: flex;
        align-items: center;
        gap: 2rem;
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid #e0e0e0;
    }

    .profile-avatar-large {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: #0066ff;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 3rem;
        font-weight: 700;
        flex-shrink: 0;
        position: relative;
    }

    .online-status {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 20px;
        height: 20px;
        background: #28a745;
        border-radius: 50%;
        border: 3px solid white;
    }

    .profile-name h2 {
        font-size: 1.8rem;
        color: #1a1a1a;
        margin-bottom: 0.3rem;
    }

    .profile-name .user-type {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f0f7ff;
        color: #0066ff;
        padding: 0.3rem 1rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .profile-name .join-date {
        display: block;
        color: #666;
        font-size: 0.9rem;
        margin-top: 0.5rem;
    }

    /* Profile Info Grid */
    .profile-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .info-card {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 1.2rem;
        border: 1px solid #e0e0e0;
        transition: all 0.3s;
    }

    .info-card:hover {
        border-color: #0066ff;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,102,255,0.1);
    }

    .info-card .label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.8rem;
        color: #666;
        font-weight: 500;
        margin-bottom: 5px;
    }

    .info-card .label i {
        color: #0066ff;
        width: 16px;
    }

    .info-card .value {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1a1a1a;
        word-break: break-word;
    }

    .info-card .value i {
        color: #0066ff;
        margin-right: 5px;
    }

    /* Edit Button */
    .edit-profile-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 0.8rem 2rem;
        background: #0066ff;
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        font-size: 0.95rem;
    }

    .edit-profile-btn:hover {
        background: #0052cc;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,102,255,0.3);
        color: white;
    }

    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #e0e0e0;
    }

    .stat-card {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 1.2rem;
        text-align: center;
        border: 1px solid #e0e0e0;
        transition: all 0.3s;
    }

    .stat-card:hover {
        border-color: #0066ff;
        transform: translateY(-2px);
    }

    .stat-card .stat-icon {
        font-size: 1.8rem;
        margin-bottom: 0.3rem;
    }

    .stat-card .stat-label {
        display: block;
        font-size: 0.8rem;
        color: #666;
        font-weight: 500;
    }

    .stat-card .stat-value {
        display: block;
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-top: 2px;
    }

    /* Quick Actions Sidebar */
    .quick-actions {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid #e0e0e0;
        position: sticky;
        top: 100px;
        height: fit-content;
    }

    .quick-actions h3 {
        font-size: 1.2rem;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #0066ff;
        color: #1a1a1a;
    }

    .quick-actions h3 i {
        color: #0066ff;
        margin-right: 10px;
    }

    .action-btn {
        display: flex;
        align-items: center;
        gap: 12px;
        width: 100%;
        padding: 0.8rem 1rem;
        background: #f8f9fa;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        color: #1a1a1a;
        text-decoration: none;
        transition: all 0.3s;
        margin-bottom: 0.8rem;
        font-weight: 500;
    }

    .action-btn:last-child {
        margin-bottom: 0;
    }

    .action-btn:hover {
        background: #f0f7ff;
        border-color: #0066ff;
        color: #0066ff;
        transform: translateX(5px);
    }

    .action-btn i {
        width: 20px;
        color: #0066ff;
        font-size: 1.1rem;
    }

    .action-btn.logout-btn {
        color: #dc3545;
    }

    .action-btn.logout-btn i {
        color: #dc3545;
    }

    .action-btn.logout-btn:hover {
        background: #fde8e8;
        border-color: #dc3545;
        color: #dc3545;
    }

    /* Alert Messages */
    .alert-custom {
        padding: 1rem;
        border-radius: 10px;
        margin-bottom: 1rem;
        animation: slideDown 0.3s ease;
    }

    .alert-success-custom {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-danger-custom {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    @keyframes slideDown {
        from {
            transform: translateY(-20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .dashboard-page {
            padding: 0 1.5rem;
        }
    }

    @media (max-width: 968px) {
        .dashboard-container {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .profile-header {
            flex-direction: column;
            text-align: center;
        }

        .profile-name h2 {
            font-size: 1.5rem;
        }

        .profile-info-grid {
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .quick-actions {
            position: static;
            margin-top: 1rem;
        }

        .stats-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 576px) {
        .dashboard-page {
            padding: 0 1rem;
        }

        .page-title {
            font-size: 1.5rem;
        }

        .profile-main {
            padding: 1.5rem;
        }

        .profile-info-grid {
            grid-template-columns: 1fr;
        }

        .profile-avatar-large {
            width: 80px;
            height: 80px;
            font-size: 2rem;
        }

        .stats-grid {
            grid-template-columns: 1fr 1fr;
            gap: 0.8rem;
        }

        .stat-card .stat-value {
            font-size: 1.2rem;
        }

        .quick-actions {
            padding: 1.5rem;
        }
    }
</style>

<div class="dashboard-page">
    <h1 class="page-title">My <span>Dashboard</span></h1>
    
    <!-- Display Success/Error Messages -->
    @if(session('success'))
        <div class="alert-custom alert-success-custom">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert-custom alert-danger-custom">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif
    
    @if(Auth::check())
        <div class="dashboard-container">
            <!-- Main Profile Section -->
            <div class="profile-main">
                <!-- Profile Header -->
                <div class="profile-header">
                    <div class="profile-avatar-large">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        <span class="online-status"></span>
                    </div>
                    <div class="profile-name">
                        <h2>{{ Auth::user()->name }}</h2>
                        <span class="user-type">
                            <i class="fas fa-user-tag"></i> 
                            {{ ucfirst(Auth::user()->user_type ?? 'Customer') }}
                        </span>
                        <span class="join-date">
                            <i class="fas fa-calendar-alt"></i> 
                            Joined {{ Auth::user()->created_at->format('F d, Y') }}
                        </span>
                    </div>
                </div>

                <!-- Profile Information -->
                <div class="profile-info-grid">
                    <div class="info-card">
                        <span class="label"><i class="fas fa-envelope"></i> Email Address</span>
                        <span class="value">{{ Auth::user()->email }}</span>
                    </div>

                    @if(Auth::user()->phone)
                    <div class="info-card">
                        <span class="label"><i class="fas fa-phone"></i> Phone Number</span>
                        <span class="value">{{ Auth::user()->phone }}</span>
                    </div>
                    @endif

                    @if(Auth::user()->address)
                    <div class="info-card">
                        <span class="label"><i class="fas fa-map-marker-alt"></i> Address</span>
                        <span class="value">{{ Auth::user()->address }}</span>
                    </div>
                    @endif

                    <div class="info-card">
                        <span class="label"><i class="fas fa-calendar-check"></i> Member Since</span>
                        <span class="value">{{ Auth::user()->created_at->format('d M, Y') }}</span>
                    </div>
                </div>

                <!-- Edit Profile Button -->
                <a href="{{ route('profile.edit') }}" class="edit-profile-btn">
                    <i class="fas fa-edit"></i> Edit Profile
                </a>

                <!-- Stats -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon" style="color: #28a745;">🛒</div>
                        <span class="stat-label">Total Orders</span>
                        <span class="stat-value">{{ $totalOrders ?? 0 }}</span>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" style="color: #dc3545;">❤️</div>
                        <span class="stat-label">Wishlist Items</span>
                        <span class="stat-value">{{ $wishlistCount ?? 0 }}</span>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" style="color: #ffc107;">⭐</div>
                        <span class="stat-label">Reviews Given</span>
                        <span class="stat-value">{{ $reviewsCount ?? 0 }}</span>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" style="color: #0066ff;">📦</div>
                        <span class="stat-label">Products Sold</span>
                        <span class="stat-value">{{ $productsSold ?? 0 }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Sidebar -->
            <div class="quick-actions">
                <h3><i class="fas fa-bolt"></i> Quick Actions</h3>

                <a href="{{ route('profile.edit') }}" class="action-btn">
                    <i class="fas fa-user-edit"></i> Edit Profile
                </a>

                <a href="{{ route('myorders') }}" class="action-btn">
                    <i class="fas fa-box"></i> My Orders
                </a>

                <a href="{{ route('wishlist')}}" class="action-btn">
                    <i class="fas fa-heart"></i> Wishlist
                </a>

                <a href="{{ route('cart')}}" class="action-btn">
                    <i class="fas fa-shopping-cart"></i> My Cart
                </a>

                <!-- <a href="" class="action-btn">
                    <i class="fas fa-plus-circle"></i> Sell Product
                </a>

                <a href="" class="action-btn">
                    <i class="fas fa-bell"></i> Notifications
                    @if(isset($notificationCount) && $notificationCount > 0)
                        <span style="background: #dc3545; color: white; padding: 2px 8px; border-radius: 50px; font-size: 0.7rem; margin-left: auto;">
                            {{ $notificationCount }}
                        </span>
                    @endif
                </a> -->

                <form method="POST" action="{{ route('logout') }}" style="width: 100%;">
                    @csrf
                    <button type="submit" class="action-btn logout-btn" style="background: none; border: 1px solid #e0e0e0; cursor: pointer; width: 100%; text-align: left;">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    @else
        <!-- User Not Logged In -->
        <div class="profile-main" style="text-align: center; padding: 4rem;">
            <i class="fas fa-user-circle" style="font-size: 5rem; color: #0066ff; margin-bottom: 1rem;"></i>
            <h2 style="margin-bottom: 0.5rem;">Please Login</h2>
            <p style="color: #666; margin-bottom: 1.5rem;">You need to be logged in to view your dashboard.</p>
            <a href="{{ route('login') }}" class="edit-profile-btn" style="display: inline-flex;">
                <i class="fas fa-sign-in-alt"></i> Login Now
            </a>
        </div>
    @endif
</div>

<!-- Loading Spinner -->
<div class="loading" id="loading">
    <div class="spinner"></div>
</div>

<style>
    .loading {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.5);
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }

    .loading.active {
        display: flex;
    }

    .spinner {
        width: 50px;
        height: 50px;
        border: 5px solid #f3f3f3;
        border-top: 5px solid #0066ff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<script>
    // Auto-hide alerts after 3 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert-custom');
        alerts.forEach(function(alert) {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.remove();
            }, 500);
        });
    }, 3000);
    
    // Show loading on form submit
    document.querySelectorAll('form').forEach(function(form) {
        form.addEventListener('submit', function() {
            const loading = document.getElementById('loading');
            if (loading) {
                loading.classList.add('active');
            }
        });
    });
</script>

@endsection