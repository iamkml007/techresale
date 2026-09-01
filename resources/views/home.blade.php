@extends('layouts.app')
@section('content')
<!-- ========== CATEGORY SECTION ========== -->
<section class="categories">
    <h2 class="section-title">Shop by <span>Category</span></h2>
    <div class="category-grid">
        @foreach($categories as $category)
          <div class="category-card">
              <div class="category-icon">
              </div>
              <img src="{{asset('categories/'.$category->image)}}" alt="{{$category->name}}" class="category-img">
              <h3>{{$category->name}}</h3>
              <p>{{$category->description ?? 'Premium second-hand products'}}</p>
              <!-- <small>{{$category->products_count ?? 0}}+ products</small> -->
          </div>
        @endforeach
    </div>
</section>



<!-- ========== FEATURED PRODUCTS ========== -->
<section class="featured-products">
    <h2 class="section-title">Featured <span>Deals</span></h2>
    <div class="products-grid">
        @if(isset($products) && count($products) > 0)
            @foreach($products as $product)
                <div class="product-card" onclick="window.location.href='{{ route('view-product', $product->id) }}'">
                    <div class="product-image">
                        @if($product->first_image_url)
                            <img src="{{ $product->first_image_url }}" 
                                 alt="{{ $product->name }}"
                                 style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <i class="fas fa-mobile-alt"></i>
                        @endif
                        
                        @if($product->condition)
                            <span class="condition-badge">{{ $product->condition }}</span>
                        @elseif($product->is_new)
                            <span class="condition-badge">New</span>
                        @else
                            <span class="condition-badge">Pre-owned</span>
                        @endif
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">{{ $product->name }}</h3>
                        
                        @if($product->rating)
                            <div class="product-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= round($product->rating))
                                        ★
                                    @else
                                        ☆
                                    @endif
                                @endfor
                                <span style="color:#666">({{ number_format($product->rating, 1) }})</span>
                            </div>
                        @endif
                        
                        <div class="product-price">
                            ₹{{ number_format($product->price, 2) }}
                            @if($product->original_price)
                                <span class="product-original-price">₹{{ number_format($product->original_price, 2) }}</span>
                            @endif
                        </div>
                        
                        @if($product->sold_count)
                            <span class="sold-count">
                                <i class="fas fa-chart-line"></i> {{ $product->sold_count }}+ sold
                            </span>
                        @endif
                        <br>
                        <a href="{{ route('add.cart',$product->id) }}" class="add-to-cart"><i class="fas fa-shopping-cart"></i>Cart</a>
                        <a href="{{ route('add.wishlist',$product->id) }}" class="add-to-wishlist"><i class="fas fa-heart"></i> Wishlist</a>
                        <a href="{{ route('view-product',$product->id) }}" class="add-to-cart"><i class="fas fa-eye"></i> See</a>
                        <!-- <button class="add-to-cart" type="submit">
                            <i class="fas fa-shopping-cart"></i> Add to Cart
                        </button> -->
                    </div>
                </div>
            @endforeach
        @else
            <!-- Fallback if no products -->
            <div class="product-card">
                <div class="product-image">
                    <i class="fas fa-mobile-alt"></i>
                    <span class="condition-badge">Available</span>
                </div>
                <div class="product-info">
                    <h3 class="product-title">No products found</h3>
                    <div class="product-price">Check back later</div>
                </div>
            </div>
        @endif
    </div>
</section>

@endsection
