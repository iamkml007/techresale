



<!-- productation code -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #ffffff;
            color: #1a1a1a;
        }
        /* Fix for product cards - make all images uniform */
        .product-image {
            width: 100%;
            height: 250px; /* Fixed height */
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* This ensures all images fill the space */
            transition: transform 0.3s;
        }

        /* Alternative: contain with background */
        .product-image img.contain {
            object-fit: contain; /* Shows full image without cropping */
            padding: 1rem;
        }

        .product-card:hover .product-image img {
            transform: scale(1.05);
        }

        /* Import Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        /* ========== NAVBAR STYLES ========== */
        .navbar {
            background: #ffffff;
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid #e0e0e0;
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .logo-icon {
            font-size: 2rem;
            color: #0066ff;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: bold;
            color: #1a1a1a;
        }

        .logo-tag {
            font-size: 0.8rem;
            color: #666;
            margin-left: 5px;
        }

        .search-container {
            flex: 1;
            max-width: 500px;
            margin: 0 2rem;
        }

        .search-box {
            display: flex;
            align-items: center;
            background: #f5f5f5;
            border-radius: 50px;
            padding: 0.5rem 1rem;
            border: 1px solid #e0e0e0;
            transition: all 0.3s;
        }

        .search-box:hover,
        .search-box:focus-within {
            border-color: #0066ff;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(0,102,255,0.1);
        }

        .search-box i {
            color: #666;
            margin-right: 10px;
        }

        .search-box input {
            flex: 1;
            border: none;
            outline: none;
            font-size: 1rem;
            padding: 0.5rem;
            background: transparent;
            color: #1a1a1a;
        }

        .search-box input::placeholder {
            color: #999;
        }

        .search-box button {
            background: #0066ff;
            border: none;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
        }

        .search-box button:hover {
            background: #0052cc;
            transform: scale(1.02);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .nav-link {
            color: #4a4a4a;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s;
            position: relative;
            font-weight: 500;
        }

        .nav-link:hover {
            color: #0066ff;
            background: #f0f7ff;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background: #ffffff;
            min-width: 220px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
            z-index: 100;
            border: 1px solid #e0e0e0;
        }

        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
        }

        .dropdown-menu a {
            display: block;
            padding: 0.8rem 1.5rem;
            color: #4a4a4a;
            text-decoration: none;
            transition: all 0.3s;
            border-bottom: 1px solid #f0f0f0;
        }

        .dropdown-menu a:hover {
            background: #f0f7ff;
            color: #0066ff;
            padding-left: 2rem;
        }

        .cart-badge {
            position: relative;
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #0066ff;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 0.7rem;
            font-weight: bold;
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: #1a1a1a;
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* ========== HERO SECTION ========== */
        .hero {
            background: linear-gradient(135deg, #f0f7ff 0%, #ffffff 100%);
            padding: 5rem 2rem;
            text-align: center;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            color: #1a1a1a;
            font-weight: 800;
        }

        .hero .highlight {
            color: #0066ff;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: #666;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-primary {
            background: #0066ff;
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-secondary {
            background: transparent;
            color: #0066ff;
            padding: 1rem 2rem;
            border: 2px solid #0066ff;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary:hover {
            background: #0052cc;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,102,255,0.3);
        }

        .btn-secondary:hover {
            background: #0066ff;
            color: white;
            transform: translateY(-2px);
        }

        /* ========== CATEGORY SECTION ========== */
        .categories {
            padding: 5rem 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            color: #1a1a1a;
            font-weight: 700;
        }

        .section-title span {
            color: #0066ff;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .category-card {
            background: #ffffff;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s;
            cursor: pointer;
            border: 1px solid #e0e0e0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .category-card:hover {
            transform: translateY(-5px);
            border-color: #0066ff;
            box-shadow: 0 10px 25px rgba(0,102,255,0.1);
        }

        .category-icon {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            color: #0066ff;
        }

        .category-card h3 {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            color: #1a1a1a;
        }

        .category-card p {
            color: #666;
            margin-bottom: 0.5rem;
        }

        .category-card small {
            color: #0066ff;
            font-weight: 500;
        }

        /* ========== FEATURED PRODUCTS ========== */
        .featured-products {
            padding: 5rem 2rem;
            background: #f8f9fa;
        }

        .products-grid {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        .product-card {
            background: #ffffff;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s;
            cursor: pointer;
            border: 1px solid #e0e0e0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .product-card:hover {
            transform: translateY(-5px);
            border-color: #0066ff;
            box-shadow: 0 10px 25px rgba(0,102,255,0.1);
        }

        .product-image {
            width: 100%;
            height: 250px;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .product-image i {
            font-size: 5rem;
            color: #0066ff;
        }

        .condition-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.3rem 0.8rem;
            background: #0066ff;
            color: white;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .product-info {
            padding: 1.5rem;
        }

        .product-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #1a1a1a;
        }

        .product-price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #0066ff;
            margin: 0.5rem 0;
        }

        .product-original-price {
            text-decoration: line-through;
            color: #999;
            font-size: 0.9rem;
            margin-left: 0.5rem;
        }

        .product-rating {
            color: #ffc107;
            margin-bottom: 0.5rem;
        }

        .sold-count {
            color: #666;
            font-size: 0.85rem;
            margin-bottom: 1rem;
            display: block;
        }

        .add-to-cart {
            text-decoration: none;
            width: 100%;
            padding: 0.8rem;
            background: #0066ff;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
        }

        .add-to-cart:hover {
            background: #0052cc;
            transform: scale(1.02);
        }
        .add-to-wishlist {
            text-decoration: none;
            width: 100%;
            padding: 0.8rem;
            background: #d72010;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
        }

        .add-to-wishlist:hover {
            background: #9b0707;
            transform: scale(1.02);
        }

        /* ========== SELLER SECTION ========== */
        .seller-section {
            padding: 5rem 2rem;
            background: linear-gradient(135deg, #0066ff 0%, #0052cc 100%);
            color: white;
            text-align: center;
        }

        .seller-content {
            max-width: 1000px;
            margin: 0 auto;
        }

        .seller-content h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .seller-steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .step {
            text-align: center;
            padding: 2rem;
            background: rgba(255,255,255,0.1);
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }

        .step-number {
            width: 60px;
            height: 60px;
            background: white;
            color: #0066ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
            margin: 0 auto 1rem;
        }

        .seller-section .btn-primary {
            background: white;
            color: #0066ff;
        }

        .seller-section .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        /* ========== TESTIMONIALS ========== */
        .testimonials {
            padding: 5rem 2rem;
            background: #ffffff;
        }

        .testimonials-grid {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .testimonial-card {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            border: 1px solid #e0e0e0;
            transition: all 0.3s;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .testimonial-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #0066ff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }

        .testimonial-avatar i {
            font-size: 2.5rem;
            color: white;
        }

        .testimonial-card h3 {
            margin-bottom: 0.5rem;
            color: #1a1a1a;
        }

        /* ========== NEWSLETTER ========== */
        .newsletter {
            padding: 5rem 2rem;
            background: #f8f9fa;
            text-align: center;
        }

        .newsletter h2 {
            color: #1a1a1a;
            margin-bottom: 1rem;
        }

        .newsletter-form {
            max-width: 500px;
            margin: 2rem auto 0;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .newsletter-form input {
            flex: 1;
            padding: 1rem;
            border: 1px solid #e0e0e0;
            border-radius: 50px;
            font-size: 1rem;
            outline: none;
            transition: all 0.3s;
        }

        .newsletter-form input:focus {
            border-color: #0066ff;
            box-shadow: 0 0 0 3px rgba(0,102,255,0.1);
        }

        /* ========== FOOTER ========== */
        .footer {
            background: #1a1a1a;
            color: white;
            padding: 3rem 2rem 1rem;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h3 {
            margin-bottom: 1rem;
            color: #0066ff;
        }

        .footer-section a {
            color: #aaa;
            text-decoration: none;
            display: block;
            margin-bottom: 0.5rem;
            transition: color 0.3s;
        }

        .footer-section a:hover {
            color: #0066ff;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-links a {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .social-links a:hover {
            background: #0066ff;
            transform: translateY(-3px);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.1);
            color: #aaa;
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 968px) {
            .navbar {
                padding: 1rem;
            }

            .search-container {
                order: 3;
                margin: 1rem 0 0 0;
                max-width: 100%;
                width: 100%;
            }

            .mobile-menu-btn {
                display: block;
            }

            .nav-links {
                display: none;
                width: 100%;
                flex-direction: column;
                gap: 0.5rem;
                margin-top: 1rem;
            }

            .nav-links.active {
                display: flex;
            }

            .dropdown-menu {
                position: static;
                opacity: 1;
                visibility: visible;
                display: none;
                margin-top: 0.5rem;
            }

            .dropdown.active .dropdown-menu {
                display: block;
            }

            .hero h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>

<!-- ========== NAVBAR ========== -->
<nav class="navbar">
    <div class="nav-container">
        <a href="{{ route('home')}}" class="logo">
            <i class="fas fa-mobile-alt logo-icon"></i>
            <div>
                <span class="logo-text">TechResale</span>
            </div>
        </a>

        <div class="search-container">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search iPhone, PlayStation, Android..." id="searchInput">
                <button id="searchBtn">Search</button>
            </div>
        </div>

        @include('layouts.navigation')

        <button class="mobile-menu-btn" id="mobileMenuBtn">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</nav>

<!-- ========== HERO SECTION ========== -->

@yield('content')
<!-- <h1>{{ Auth::user()->name}}</h1>
<h1>{{ Auth::user()->email}}</h1>
<h1>{{ Auth::user()->user_type}}</h1> -->


<!-- ========== FOOTER ========== -->
<footer class="footer">
    <div class="footer-content">
        <div class="footer-section">
            <h3><i class="fas fa-mobile-alt"></i> TechResale</h3>
            <p>India's most trusted platform for buying and selling second-hand tech products.</p>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
        
        <div class="footer-section">
            <h3>Quick Links</h3>
            <a href="#">About Us</a>
            <a href="#">Contact Us</a>
            <a href="#">Blog</a>
            <a href="#">FAQs</a>
            <a href="#">Privacy Policy</a>
        </div>
        
        <div class="footer-section">
            <h3>Categories</h3>
            <a href="#">Android Phones</a>
            <a href="#">iPhone</a>
            <a href="#">PlayStation</a>
            <a href="#">Laptops</a>
            <a href="#">Tablets</a>
        </div>
        
        <div class="footer-section">
            <h3>Contact Info</h3>
            <p><i class="fas fa-phone"></i> +91 98765 43210</p>
            <p><i class="fas fa-envelope"></i> support@techresale.com</p>
            <p><i class="fas fa-map-marker-alt"></i> Mumbai, India</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 TechResale. All rights reserved. | Buy & Sell Second Hand Tech Products</p>
    </div>
</footer>

<script>
  
    // Search
    function performSearch() {
        const query = document.getElementById('searchInput').value.trim();
        if (query) {
            showNotification(`Searching for "${query}"...`, 'info');
        }
    }

    // Subscribe
    function subscribeNewsletter() {
        const email = document.getElementById('newsletterEmail').value;
        if (email && email.includes('@')) {
            showNotification('Subscribed successfully!', 'success');
            document.getElementById('newsletterEmail').value = '';
        } else {
            showNotification('Please enter valid email', 'error');
        }
    }

    // Logout
    function logout() {
        localStorage.removeItem('token');
        localStorage.removeItem('cart');
        showNotification('Logged out successfully', 'success');
        setTimeout(() => location.reload(), 1000);
    }

    // Mobile Menu
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const navLinks = document.getElementById('navLinks');
    
    mobileMenuBtn?.addEventListener('click', () => {
        navLinks.classList.toggle('active');
    });

    // Dropdown for Mobile
    const dropdowns = document.querySelectorAll('.dropdown');
    dropdowns.forEach(dropdown => {
        const link = dropdown.querySelector('.nav-link');
        link?.addEventListener('click', (e) => {
            if (window.innerWidth <= 968) {
                e.preventDefault();
                dropdown.classList.toggle('active');
            }
        });
    });

    // Event Listeners
    document.addEventListener('DOMContentLoaded', () => {
        displayProducts();
        updateCartCount();
        
        document.getElementById('searchBtn')?.addEventListener('click', performSearch);
        document.getElementById('searchInput')?.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') performSearch();
        });
        document.getElementById('subscribeBtn')?.addEventListener('click', subscribeNewsletter);
        document.getElementById('logoutBtn')?.addEventListener('click', logout);
    });

    // Animation Style
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    `;
    document.head.appendChild(style);
</script>

</body>
</html>