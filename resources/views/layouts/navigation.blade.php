<!-- production -->
 <div class="nav-links" id="navLinks">
            <a href="{{ route('home')}}" class="nav-link">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>

            <div class="dropdown">
                <a href="#" class="nav-link">
                    <i class="fas fa-box"></i>
                    <span>Products</span>
                    <i class="fas fa-chevron-down"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="#"><i class="fab fa-android"></i> Android Phones</a>
                    <a href="#"><i class="fab fa-apple"></i> iPhone</a>
                    <a href="#"><i class="fab fa-playstation"></i> PlayStation</a>
                    <a href="#"><i class="fas fa-laptop"></i> Laptops</a>
                    <a href="#"><i class="fas fa-tablet-alt"></i> Tablets</a>
                </div>
            </div>

            <!-- <a href="#" class="nav-link">
                <i class="fas fa-tag"></i>
                <span>Sell Device</span>
            </a> -->
            @guest
                <a href="{{ route('login')}}" class="nav-link">
                    <i class="fa fa-sign-in"></i>
                    <span>Login</span>
                </a>
                <a href="{{ route('register')}}" class="nav-link">
                    <i class="fas fa-user-plus"></i>
                    <span>Register</span>
                </a>
            @endguest
            @auth
            <a href="{{ route('myorders') }}" class="nav-link">
                <i class="fas fa-shopping-bag"></i>
                <span>Orders</span>
            </a>

            <a href="{{ route('cart')}}" class="nav-link cart-badge">
                <i class="fas fa-shopping-cart"></i>
                <span>Cart</span>
                <span class="cart-count">{{ $cartCount }}</span>
            </a>
            <a href="{{ route('wishlist')}}" class="nav-link cart-badge">
                <i class="fas fa-heart"></i>
                <span>Wishlist</span>
                <span class="cart-count">{{ $wishlistCount }}</span>
            </a>

            <div class="dropdown">
                <a href="#" class="nav-link">
                    <i class="fas fa-user-circle"></i>
                    <span>Account</span>
                    <i class="fas fa-chevron-down"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="{{ route('dashboard')}}"><i class="fas fa-user"></i> Dashboard</a>
                    <!-- <a href="{{ route('wishlist')}}"><i class="fas fa-heart"></i> Wishlist</a> -->
                    <!-- <a href="#"><i class="fas fa-cog"></i> Settings</a> -->
                    <form action="{{ route('logout')}}" method="post">
                        @csrf
                        <button class="add-to-cart" type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
                        <!-- <a href="#" id="logoutBtn"><i class="fas fa-sign-out-alt"></i> Logout</a> -->
                    </form>
                </div>
            </div>
            @endauth
            
        </div>