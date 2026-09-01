@extends('dashboard')

@section('title', $product->name . ' - TechResale')

@section('content')
<style>
    /* Product Detail Page Styles */
    .product-detail-page {
        max-width: 1400px;
        margin: 2rem auto;
        padding: 0 2rem;
    }

    .product-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid #e0e0e0;
    }

    /* Product Images Section */
    .product-gallery {
        position: sticky;
        top: 100px;
    }

    .main-image {
        width: 100%;
        height: 400px;
        background: #f8f9fa;
        border-radius: 15px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        border: 1px solid #e0e0e0;
    }

    .main-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .thumbnail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .thumbnail {
        width: 100%;
        height: 80px;
        background: #f8f9fa;
        border-radius: 10px;
        overflow: hidden;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.3s;
    }

    .thumbnail:hover {
        border-color: #0066ff;
        transform: translateY(-2px);
    }

    .thumbnail.active {
        border-color: #0066ff;
        box-shadow: 0 0 0 2px rgba(0,102,255,0.2);
    }

    .thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-count-badge {
        display: inline-block;
        background: #0066ff;
        color: white;
        padding: 0.2rem 0.8rem;
        border-radius: 20px;
        font-size: 0.8rem;
        margin-top: 0.5rem;
    }

    /* Product Info Section */
    .product-title {
        font-size: 2rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 1rem;
    }

    .product-price {
        font-size: 2rem;
        font-weight: bold;
        color: #0066ff;
        margin-bottom: 1rem;
    }

    .product-price .original-price {
        text-decoration: line-through;
        color: #999;
        font-size: 1.2rem;
        margin-left: 1rem;
    }

    .product-condition {
        display: inline-block;
        padding: 0.3rem 1rem;
        background: #28a745;
        color: white;
        border-radius: 20px;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .product-rating {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .stars {
        color: #ffc107;
        font-size: 1.1rem;
    }

    .rating-count {
        color: #666;
    }

    .product-description {
        margin: 1.5rem 0;
        padding: 1.5rem 0;
        border-top: 1px solid #e0e0e0;
        border-bottom: 1px solid #e0e0e0;
    }

    .product-description h3,
    .product-specifications h3 {
        font-size: 1.2rem;
        margin-bottom: 1rem;
        color: #1a1a1a;
    }

    .product-description p,
    .product-specifications p {
        color: #666;
        line-height: 1.6;
    }

    .product-specifications {
        margin: 1.5rem 0;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        flex-wrap: wrap;
    }

    .btn-cart {
        flex: 1;
        background: #0066ff;
        color: white;
        padding: 1rem 2rem;
        border: none;
        border-radius: 10px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-cart:hover {
        background: #0052cc;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,102,255,0.3);
        color: white;
    }

    .btn-wishlist {
        flex: 1;
        background: #ff3366;
        color: white;
        padding: 1rem 2rem;
        border: none;
        border-radius: 10px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-wishlist:hover {
        background: #cc0033;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255,51,102,0.3);
        color: white;
    }

    /* Quantity Selector */
    .quantity-selector {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .quantity-label {
        font-weight: 600;
        color: #1a1a1a;
    }

    .quantity-input {
        width: 80px;
        text-align: center;
        padding: 0.5rem;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        font-size: 1rem;
    }

    /* Related Products */
    .related-products {
        margin-top: 4rem;
    }

    .section-title {
        font-size: 1.8rem;
        margin-bottom: 2rem;
        color: #1a1a1a;
    }

    .section-title span {
        color: #0066ff;
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 2rem;
    }

    .related-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s;
        cursor: pointer;
        border: 1px solid #e0e0e0;
        text-decoration: none;
        display: block;
    }

    .related-card:hover {
        transform: translateY(-5px);
        border-color: #0066ff;
        box-shadow: 0 10px 25px rgba(0,102,255,0.1);
    }

    .related-image {
        width: 100%;
        height: 200px;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .related-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .related-info {
        padding: 1rem;
    }

    .related-title {
        font-size: 1rem;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 0.5rem;
    }

    .related-price {
        font-size: 1.2rem;
        font-weight: bold;
        color: #0066ff;
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

    /* Responsive */
    @media (max-width: 968px) {
        .product-container {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .product-gallery {
            position: static;
        }

        .product-title {
            font-size: 1.5rem;
        }

        .product-price {
            font-size: 1.5rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .related-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }
    }

    @media (max-width: 576px) {
        .product-detail-page {
            padding: 0 1rem;
        }

        .product-container {
            padding: 1rem;
        }

        .main-image {
            height: 250px;
        }

        .thumbnail-grid {
            grid-template-columns: repeat(auto-fill, minmax(60px, 1fr));
        }

        .thumbnail {
            height: 60px;
        }
    }
</style>

<div class="product-detail-page">
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

    <!-- Product Main Section -->
    <div class="product-container">
        <!-- Product Images Gallery -->
        <div class="product-gallery">
            <div class="main-image">
                <img src="{{ $product->first_image_url ?? asset('images/placeholder.jpg') }}" 
                     id="mainImage"
                     alt="{{ $product->name }}">
            </div>
            
            @if($product->has_multiple_images && count($product->all_image_urls) > 1)
                <div class="thumbnail-grid">
                    @foreach($product->all_image_urls as $index => $imageUrl)
                        <div class="thumbnail {{ $index == 0 ? 'active' : '' }}" 
                             onclick="changeImage('{{ $imageUrl }}', this)">
                            <img src="{{ $imageUrl }}" alt="Thumbnail {{ $index + 1 }}">
                        </div>
                    @endforeach
                </div>
            @endif
            
            @if($product->image_count > 0)
                <div class="image-count-badge">
                    <i class="fas fa-images"></i> {{ $product->image_count }} Images
                </div>
            @endif
        </div>
        
        <!-- Product Information -->
        <div class="product-info">
            <h1 class="product-title">{{ $product->name }}</h1>
            
            <div class="product-price">
                ₹{{ number_format($product->price, 2) }}
                @if($product->original_price)
                    <span class="original-price">₹{{ number_format($product->original_price, 2) }}</span>
                @endif
            </div>
            
            @if($product->condition)
                <div class="product-condition">
                    <i class="fas fa-check-circle"></i> {{ $product->condition }}
                </div>
            @endif
            
            @if($product->rating)
                <div class="product-rating">
                    <div class="stars">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= round($product->rating))
                                ★
                            @else
                                ☆
                            @endif
                        @endfor
                    </div>
                    <span class="rating-count">({{ number_format($product->rating, 1) }} rating)</span>
                    @if($product->sold_count)
                        <span class="rating-count">| {{ $product->sold_count }}+ sold</span>
                    @endif
                </div>
            @endif
            
            <!-- Quantity Selector -->
            <!-- <div class="quantity-selector">
                <span class="quantity-label">Quantity:</span>
                <form action="{{ route('add.cart', $product->id) }}" method="POST" id="addToCartForm">
                    @csrf
                    <input type="number" name="quantity" class="quantity-input" value="1" min="1" max="99">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                </form>
            </div> -->
            
            <!-- Action Buttons -->
            <div class="action-buttons">
                
                <a href="{{ route('add.cart',$product->id) }}" class="btn-cart"><i class="fas fa-shopping-cart"></i>Cart</a>
                <a href="{{ route('add.wishlist',$product->id) }}" class="btn-wishlist"><i class="fas fa-heart"></i> Wishlist</a>
                <!-- <a href="{{ route('add.wishlist', $product->id) }}" class="btn-wishlist" 
                   onclick="return confirm('Add this item to wishlist?')">
                    <i class="fas fa-heart"></i> Add to Wishlist
                </a> -->
            </div>
            
            <!-- Product Description -->
            @if($product->description)
            <div class="product-description">
                <h3><i class="fas fa-info-circle"></i> Description</h3>
                <p>{{ $product->description }}</p>
            </div>
            @endif
            <!-- Product Battery Health -->
            @if($product->battery_health)
            <div class="battery_health">
                <h3><i class="fas fa-battery "></i>  Battery Health</h3>
                <br>
                <p>{{ $product->battery_health }} %</p>
            </div>
            @endif
            
            <!-- Product Specifications -->
            @if($product->specifications)
            <div class="product-specifications">
                <h3><i class="fas fa-microchip"></i> Specifications</h3>
                <p>{{ $product->specifications }}</p>
            </div>
            @endif
        </div>
    </div>
    
    <!-- Related Products Section -->
    @if(isset($relatedProducts) && count($relatedProducts) > 0)
    <div class="related-products">
        <h2 class="section-title">You May Also <span>Like</span></h2>
        <div class="related-grid">
            @foreach($relatedProducts as $related)
                <a href="{{ route('view-product', $related->id) }}" class="related-card">
                    <div class="related-image">
                        @if($related->first_image_url)
                            <img src="{{ $related->first_image_url }}" alt="{{ $related->name }}">
                        @else
                            <i class="fas fa-mobile-alt" style="font-size: 3rem; color: #0066ff;"></i>
                        @endif
                    </div>
                    <div class="related-info">
                        <h3 class="related-title">{{ Str::limit($related->name, 40) }}</h3>
                        <div class="related-price">₹{{ number_format($related->price, 2) }}</div>
                    </div>
                </a>
            @endforeach
        </div>
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
    
    // Change main image when clicking thumbnail
    function changeImage(imageUrl, element) {
        const mainImage = document.getElementById('mainImage');
        if (mainImage) {
            mainImage.src = imageUrl;
        }
        
        // Update active class on thumbnails
        document.querySelectorAll('.thumbnail').forEach(thumb => {
            thumb.classList.remove('active');
        });
        element.classList.add('active');
    }
    
    // Show loading spinner on form submit
    document.querySelectorAll('form').forEach(function(form) {
        form.addEventListener('submit', function() {
            const loading = document.getElementById('loading');
            if (loading) {
                loading.classList.add('active');
            }
        });
    });
    
    // Quantity input validation
    const quantityInput = document.querySelector('.quantity-input');
    if (quantityInput) {
        quantityInput.addEventListener('change', function() {
            let value = parseInt(this.value);
            if (isNaN(value) || value < 1) {
                this.value = 1;
            }
            if (value > 99) {
                this.value = 99;
            }
        });
    }
</script>
@endsection