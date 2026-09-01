@extends('dashboard')

@section('content')
<!-- Cart Page CSS -->
<style>
    /* Cart Page Specific Styles */
    .cart-page {
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

    .cart-container {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 2rem;
    }

    /* Cart Items Table */
    .cart-items {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid #e0e0e0;
    }

    .cart-header {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr 0.5fr;
        background: #f8f9fa;
        padding: 1rem 1.5rem;
        font-weight: 600;
        color: #1a1a1a;
        border-bottom: 1px solid #e0e0e0;
    }

    .cart-item {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr 0.5fr;
        align-items: center;
        padding: 1.5rem;
        border-bottom: 1px solid #f0f0f0;
        transition: background 0.3s;
    }

    .cart-item:hover {
        background: #f8f9fa;
    }

    .product-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .product-image {
        width: 80px;
        height: 80px;
        background: #f5f5f5;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        flex-shrink: 0;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-image i {
        font-size: 2rem;
        color: #0066ff;
    }

    .product-details h3 {
        font-size: 1rem;
        margin-bottom: 0.25rem;
        color: #1a1a1a;
        font-weight: 600;
    }

    .product-category {
        font-size: 0.8rem;
        color: #666;
    }

    .product-price {
        font-weight: 600;
        color: #1a1a1a;
    }

    .quantity-form {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .quantity-input {
        width: 60px;
        text-align: center;
        padding: 0.5rem;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        font-size: 0.9rem;
    }

    .update-btn {
        background: #0066ff;
        color: white;
        border: none;
        padding: 0.5rem 0.8rem;
        border-radius: 5px;
        cursor: pointer;
        font-size: 0.8rem;
        transition: all 0.3s;
    }

    .update-btn:hover {
        background: #0052cc;
        transform: translateY(-1px);
    }

    .item-total {
        font-weight: 600;
        color: #0066ff;
    }

    .remove-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        background: #ff4444;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        text-decoration: none;
        font-size: 0.8rem;
        transition: all 0.3s;
    }

    .remove-btn:hover {
        background: #cc0000;
        transform: translateY(-1px);
        color: white;
    }

    /* Cart Summary */
    .cart-summary {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid #e0e0e0;
        position: sticky;
        top: 100px;
        height: fit-content;
    }

    .summary-title {
        font-size: 1.3rem;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #0066ff;
        color: #1a1a1a;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
        padding: 0.5rem 0;
        color: #4a4a4a;
    }

    .summary-row.total {
        border-top: 2px solid #e0e0e0;
        margin-top: 1rem;
        padding-top: 1rem;
        font-size: 1.2rem;
        font-weight: bold;
        color: #0066ff;
    }

    .checkout-btn {
        width: 100%;
        padding: 1rem;
        background: #0066ff;
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: 1rem;
    }

    .checkout-btn:hover {
        background: #0052cc;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,102,255,0.3);
    }

    .continue-shopping {
        display: block;
        text-align: center;
        margin-top: 1rem;
        color: #0066ff;
        text-decoration: none;
        transition: all 0.3s;
    }

    .continue-shopping:hover {
        color: #0052cc;
        text-decoration: underline;
    }

    /* Shipping Form */
    .shipping-section {
        margin-top: 3rem;
    }

    .shipping-container {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid #e0e0e0;
    }

    .shipping-title {
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
        color: #1a1a1a;
        font-weight: 600;
    }

    .shipping-title span {
        color: #0066ff;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 1rem;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s;
        font-family: inherit;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #0066ff;
        box-shadow: 0 0 0 3px rgba(0,102,255,0.1);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 100px;
    }

    .confirm-order-btn {
        width: 100%;
        background: linear-gradient(135deg, #0066ff, #0052cc);
        color: white;
        padding: 1rem;
        border: none;
        border-radius: 10px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .confirm-order-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,102,255,0.3);
    }

    /* Empty Cart */
    .empty-cart {
        text-align: center;
        padding: 4rem;
        background: white;
        border-radius: 15px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid #e0e0e0;
    }

    .empty-cart i {
        font-size: 5rem;
        color: #0066ff;
        margin-bottom: 1rem;
    }

    .empty-cart h2 {
        margin-bottom: 1rem;
        color: #1a1a1a;
    }

    .empty-cart p {
        color: #666;
        margin-bottom: 1rem;
    }

    .shop-now-btn {
        display: inline-block;
        text-align: center;
        padding: 10px;
        background: #0066ff;
        color: white;
        text-decoration: none;
        border-radius: 10px;
        transition: all 0.3s;
    }

    .shop-now-btn:hover {
        background: #0052cc;
        transform: translateY(-2px);
        color: white;
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

    /* Loading Spinner */
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

    /* Responsive Design */
    @media (max-width: 1200px) {
        .cart-page {
            padding: 0 1.5rem;
        }
    }

    @media (max-width: 968px) {
        .cart-container {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .cart-header {
            display: none;
        }
        
        .cart-item {
            grid-template-columns: 1fr;
            gap: 1rem;
            padding: 1.2rem;
        }
        
        .product-info {
            flex-direction: column;
            text-align: center;
        }
        
        .product-details h3 {
            text-align: center;
        }
        
        .product-category {
            text-align: center;
        }
        
        .quantity-form {
            justify-content: center;
        }
        
        .product-price {
            text-align: center;
        }
        
        .item-total {
            text-align: center;
        }
        
        .remove-btn {
            justify-content: center;
            width: fit-content;
            margin: 0 auto;
        }
        
        .form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }
        
        .cart-summary {
            position: static;
            margin-top: 1rem;
        }
    }

    @media (max-width: 576px) {
        .cart-page {
            padding: 0 1rem;
        }
        
        .page-title {
            font-size: 1.5rem;
        }
        
        .cart-item {
            padding: 1rem;
        }
        
        .product-image {
            width: 100px;
            height: 100px;
        }
        
        .quantity-form {
            flex-direction: column;
            align-items: center;
        }
        
        .quantity-input {
            width: 80px;
        }
        
        .update-btn {
            width: 80px;
        }
        
        .shipping-container {
            padding: 1.5rem;
        }
        
        .shipping-title {
            font-size: 1.2rem;
        }
        
        .empty-cart {
            padding: 2rem;
        }
        
        .empty-cart i {
            font-size: 3rem;
        }
    }
</style>

<div class="cart-page">
    <h1 class="page-title">Your <span>Shopping Cart</span></h1>
    
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
        @if(isset($carts) && count($carts) > 0)
            <div class="cart-container">
                <!-- Cart Items -->
                <div class="cart-items">
                    <div class="cart-header">
                        <div>Product</div>
                        <div>Price</div>
                        <!-- <div>Quantity</div> -->
                        <div>Total</div>
                        <div>Action</div>
                    </div>
                    
                    @php $subtotal = 0; @endphp
                    @foreach($carts as $cart)
                    @php 
                        $itemTotal = $cart->product->price * ($cart->quantity ?? 1);
                        $subtotal += $itemTotal;
                    @endphp
                    <div class="cart-item">
                        <div class="product-info">
                            <div class="product-image">
                                @if($cart->product->first_image_url)
                                    <img src="{{ $cart->product->first_image_url }}" alt="{{ $cart->product->name }}">
                                @elseif($cart->product->image)
                                    <img src="{{ asset('products/'.$cart->product->image) }}" alt="{{ $cart->product->name }}">
                                @else
                                    <i class="fas fa-mobile-alt"></i>
                                @endif
                            </div>
                            <div class="product-details">
                                <h3>{{ $cart->product->name }}</h3>
                                <p class="product-category">
                                    <i class="fas fa-tag"></i> {{ $cart->product->category->name ?? 'Uncategorized' }}
                                </p>
                            </div>
                        </div>
                        <div class="product-price">
                            ₹{{ number_format($cart->product->price, 2) }}
                        </div>
                        <!-- <div>
                            <form action="" method="POST" class="quantity-form">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                                <input type="number" name="quantity" class="quantity-input" 
                                       value="{{ $cart->quantity ?? 1 }}" min="1" max="99">
                                <button type="submit" class="update-btn">
                                    <i class="fas fa-sync-alt"></i> Update
                                </button>
                            </form>
                        </div> -->
                        <div class="item-total">
                            ₹{{ number_format($itemTotal, 2) }}
                        </div>
                        <div>
                            <a href="{{ route('cart-delete', $cart->id) }}" 
                               class="remove-btn"
                               onclick="return confirm('Are you sure you want to remove this item?')">
                                <i class="fas fa-trash-alt"></i> Remove
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Cart Summary -->
                <div class="cart-summary">
                    <h3 class="summary-title">Order Summary</h3>
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>₹{{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping</span>
                        <span>Free</span>
                    </div>
                    <div class="summary-row">
                        <span>Tax (GST 18%)</span>
                        <span>₹{{ number_format($subtotal * 0.18, 2) }}</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total</span>
                        <span>₹{{ number_format($subtotal + ($subtotal * 0.18), 2) }}</span>
                    </div>
                    <button class="checkout-btn" onclick="document.getElementById('shipping-section').scrollIntoView({behavior: 'smooth'})">
                        Proceed to Checkout <i class="fas fa-arrow-right"></i>
                    </button>
                    <a href="{{ route('home') }}" class="continue-shopping">
                        <i class="fas fa-shopping-bag"></i> Continue Shopping
                    </a>
                </div>
            </div>
            
            <!-- Shipping Details Form -->
            <div class="shipping-section" id="shipping-section">
                <div class="shipping-container">
                    <h2 class="shipping-title">Shipping <span>Details</span></h2>
                    <form action="{{ route('order') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Full Name" required value="{{ old('name', Auth::user()->name ?? '') }}">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Email Address" required value="{{ old('email', Auth::user()->email ?? '') }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <input type="tel" name="phone" placeholder="Phone Number" required value="{{ old('phone') }}">
                            </div>
                            <div class="form-group">
                                <input type="text" name="city" placeholder="City" required value="{{ old('city') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea name="address" placeholder="Complete Address" required>{{ old('address') }}</textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <input type="text" name="pincode" placeholder="Pincode" required value="{{ old('pincode') }}">
                            </div>
                            <div class="form-group">
                                <input type="text" name="landmark" placeholder="Landmark (Optional)" value="{{ old('landmark') }}">
                            </div>
                        </div>
                        <button type="submit" class="confirm-order-btn">
                            Confirm Order <i class="fas fa-check-circle"></i>
                        </button>
                    </form>
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="empty-cart">
                <i class="fas fa-shopping-cart"></i>
                <h2>Your cart is empty</h2>
                <p>Looks like you haven't added any items to your cart yet.</p>
                <a href="{{ route('home') }}" class="shop-now-btn">
                    Shop Now 
                </a>
            </div>
        @endif
    @else
        <!-- User Not Logged In -->
        <div class="empty-cart">
            <i class="fas fa-sign-in-alt"></i>
            <h2>Please Login to View Cart</h2>
            <p>You need to be logged in to view your cart items.</p>
            <a href="{{ route('login') }}" class="shop-now-btn">
                Login Now <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    @endif
</div>

<!-- Loading Spinner -->
<div class="loading" id="loading">
    <div class="spinner"></div>
</div>

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
    
    // Quantity input validation
    document.querySelectorAll('.quantity-input').forEach(function(input) {
        input.addEventListener('change', function() {
            let value = parseInt(this.value);
            if (isNaN(value) || value < 1) {
                this.value = 1;
            }
            if (value > 99) {
                this.value = 99;
            }
        });
    });
    
    // Remove border color on focus
    document.querySelectorAll('input, textarea').forEach(function(field) {
        field.addEventListener('focus', function() {
            this.style.borderColor = '#e0e0e0';
        });
    });
</script>
@endsection