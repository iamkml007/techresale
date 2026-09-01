@extends('dashboard')

@section('title', 'My Wishlist - TechResale')

@section('content')
<style>
    /* Wishlist Page Specific Styles */
    .wishlist-page {
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

    .wishlist-container {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid #e0e0e0;
    }

    .wishlist-header {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr 0.5fr;
        background: #f8f9fa;
        padding: 1rem 1.5rem;
        font-weight: 600;
        color: #1a1a1a;
        border-bottom: 1px solid #e0e0e0;
    }

    .wishlist-item {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr 0.5fr;
        align-items: center;
        padding: 1.5rem;
        border-bottom: 1px solid #f0f0f0;
        transition: background 0.3s;
    }

    .wishlist-item:hover {
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
        font-size: 1.1rem;
    }

    .product-price .original-price {
        text-decoration: line-through;
        color: #999;
        font-size: 0.85rem;
        margin-left: 0.5rem;
    }

    .add-to-cart-form {
        display: inline-block;
    }

    .add-to-cart-btn {
        text-decoration: none;
        background: #0066ff;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        cursor: pointer;
        font-size: 0.8rem;
        transition: all 0.3s;
        width: 100%;
        max-width: 120px;
    }

    .add-to-cart-btn:hover {
        background: #0052cc;
        transform: translateY(-1px);
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

    /* Summary Section */
    .wishlist-summary {
        margin-top: 2rem;
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid #e0e0e0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .total-section {
        font-size: 1.2rem;
    }

    .total-label {
        font-weight: 600;
        color: #1a1a1a;
    }

    .total-amount {
        font-weight: bold;
        color: #0066ff;
        font-size: 1.3rem;
        margin-left: 1rem;
    }

    .add-all-form {
        display: inline-block;
    }

    .add-all-to-cart {
        background: linear-gradient(135deg, #0066ff, #0052cc);
        color: white;
        border: none;
        padding: 0.8rem 1.5rem;
        border-radius: 10px;
        cursor: pointer;
        font-size: 1rem;
        font-weight: 600;
        transition: all 0.3s;
    }

    .add-all-to-cart:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,102,255,0.3);
    }

    /* Empty Wishlist */
    .empty-wishlist {
        text-align: center;
        padding: 4rem;
        background: white;
        border-radius: 15px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid #e0e0e0;
    }

    .empty-wishlist i {
        font-size: 5rem;
        color: #0066ff;
        margin-bottom: 1rem;
    }

    .empty-wishlist h2 {
        margin-bottom: 1rem;
        color: #1a1a1a;
    }

    .empty-wishlist p {
        color: #666;
        margin-bottom: 1rem;
    }

    .shop-now-btn {
        display: inline-block;
        margin-top: 1rem;
        padding: 1rem 2rem;
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
    @media (max-width: 968px) {
        .wishlist-page {
            padding: 0 1.5rem;
        }

        .wishlist-header {
            display: none;
        }

        .wishlist-item {
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

        .product-price {
            text-align: center;
        }

        .add-to-cart-btn {
            margin: 0 auto;
            display: block;
        }

        .add-to-cart-form {
            text-align: center;
        }

        .remove-btn {
            justify-content: center;
            width: fit-content;
            margin: 0 auto;
            display: flex;
        }

        .wishlist-summary {
            flex-direction: column;
            text-align: center;
        }
    }

    @media (max-width: 576px) {
        .wishlist-page {
            padding: 0 1rem;
        }

        .page-title {
            font-size: 1.5rem;
        }

        .wishlist-item {
            padding: 1rem;
        }

        .product-image {
            width: 100px;
            height: 100px;
        }

        .empty-wishlist {
            padding: 2rem;
        }

        .empty-wishlist i {
            font-size: 3rem;
        }
    }
</style>

<div class="wishlist-page">
    <h1 class="page-title">My <span>Wishlist</span></h1>
    
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
        @if(isset($wishlists) && count($wishlists) > 0)
            <div class="wishlist-container">
                <div class="wishlist-header">
                    <div>Product</div>
                    <div>Price</div>
                    <div>Category</div>
                    <div>Action</div>
                    <div>Remove</div>
                </div>
                
                @php $total = 0; @endphp
                @foreach($wishlists as $wishlist)
                @php $total += $wishlist->product->price; @endphp
                <div class="wishlist-item">
                    <div class="product-info">
                        <div class="product-image">
                            @if($wishlist->product->first_image_url)
                                <img src="{{ $wishlist->product->first_image_url }}" alt="{{ $wishlist->product->name }}">
                            @elseif($wishlist->product->image)
                                <img src="{{ asset('products/'.$wishlist->product->image) }}" alt="{{ $wishlist->product->name }}">
                            @else
                                <i class="fas fa-mobile-alt"></i>
                            @endif
                        </div>
                        <div class="product-details">
                            <h3>{{ $wishlist->product->name }}</h3>
                            <p class="product-category">
                                <i class="fas fa-tag"></i> {{ $wishlist->product->category->name ?? 'Uncategorized' }}
                            </p>
                        </div>
                    </div>
                    <div class="product-price">
                        ₹{{ number_format($wishlist->product->price, 2) }}
                        @if($wishlist->product->original_price)
                            <span class="original-price">₹{{ number_format($wishlist->product->original_price, 2) }}</span>
                        @endif
                    </div>
                    <div>
                        {{ $wishlist->product->category->name ?? 'Uncategorized' }}
                    </div>
                    <div>
                        <!-- <form action="" method="POST" class="add-to-cart-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $wishlist->product->id }}">
                            <input type="hidden" name="wishlist_id" value="{{ $wishlist->id }}">
                            <button type="submit" class="add-to-cart-btn">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                        </form> -->
                        <a href="{{ route('add.cart',$wishlist->product->id) }}" class="add-to-cart-btn"><i class="fas fa-shopping-cart"></i>Cart</a>
                    </div>
                    <div>
                        <a href="{{ route('wishlist-delete', $wishlist->id) }}" 
                           class="remove-btn"
                           onclick="return confirm('Are you sure you want to remove this item from wishlist?')">
                            <i class="fas fa-trash-alt"></i> Remove
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Wishlist Summary -->
            <div class="wishlist-summary">
                <div class="total-section">
                    <span class="total-label">Total Value:</span>
                    <span class="total-amount">₹{{ number_format($total, 2) }}</span>
                </div>
                <div>
                    <form action="" method="POST" class="add-all-form">
                        @csrf
                        <button type="submit" class="add-all-to-cart" onclick="return confirm('Add all items to cart?')">
                            <i class="fas fa-cart-plus"></i> Add All to Cart
                        </button>
                    </form>
                </div>
            </div>
        @else
            <!-- Empty Wishlist -->
            <div class="empty-wishlist">
                <i class="fas fa-heart"></i>
                <h2>Your wishlist is empty</h2>
                <p>Start adding your favorite products to your wishlist!</p>
                <a href="{{ route('home') }}" class="shop-now-btn">
                    Shop Now <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        @endif
    @else
        <!-- User Not Logged In -->
        <div class="empty-wishlist">
            <i class="fas fa-sign-in-alt"></i>
            <h2>Please Login to View Wishlist</h2>
            <p>You need to be logged in to view your wishlist items.</p>
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
    
    // Show loading spinner on form submit
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