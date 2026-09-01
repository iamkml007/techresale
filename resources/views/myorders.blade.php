{{-- resources/views/myorders.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - TechResale</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin/vendor/bootstrap/css/bootstrap.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f8f9fa;
            color: #1a1a1a;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-header h1 {
            font-size: 2rem;
            font-weight: 700;
            color: #1a1a1a;
        }

        .page-header h1 span {
            color: #0066ff;
        }

        .btn-primary {
            background: #0066ff;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            background: #0052cc;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,102,255,0.3);
        }

        .btn-success {
            background: #28a745;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.875rem;
            transition: all 0.3s;
        }

        .btn-success:hover {
            background: #218838;
            transform: scale(1.05);
        }

        .btn-danger {
            background: #dc3545;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.875rem;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn-danger:hover {
            background: #c82333;
            transform: scale(1.05);
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border-left: 4px solid #0066ff;
        }

        .stat-card .stat-label {
            font-size: 0.875rem;
            color: #666;
        }

        .stat-card .stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1a1a1a;
        }

        /* Orders Table */
        .orders-table-container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
        }

        .orders-table thead {
            background: #f8f9fa;
        }

        .orders-table th {
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: #666;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e0e0e0;
        }

        .orders-table td {
            padding: 1rem;
            border-bottom: 1px solid #e0e0e0;
            vertical-align: middle;
        }

        .orders-table tr:hover {
            background: #f8f9fa;
        }

        .product-cell {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            background: #f5f5f5;
        }

        .product-name {
            font-weight: 500;
            color: #1a1a1a;
        }

        .product-price {
            color: #0066ff;
            font-weight: 600;
        }

        /* Status Badges */
        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: capitalize;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-processing {
            background: #cce5ff;
            color: #004085;
        }

        .status-shipped {
            background: #d1ecf1;
            color: #0c5460;
        }

        .status-delivered {
            background: #d4edda;
            color: #155724;
        }

        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state i {
            font-size: 4rem;
            color: #ccc;
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            color: #666;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: #999;
            margin-bottom: 1.5rem;
        }

        /* Alerts */
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .orders-table {
                display: block;
                overflow-x: auto;
            }

            .orders-table th,
            .orders-table td {
                padding: 0.75rem;
                font-size: 0.875rem;
            }

            .product-cell {
                flex-direction: column;
                align-items: flex-start;
            }

            .product-image {
                width: 40px;
                height: 40px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        <!-- Page Header -->
        <div class="page-header">
            <h1>My <span>Orders</span></h1>
            <div style="display: flex; gap: 1rem;">
                <a href="{{ route('home') }}" class="btn-primary">
                    <i class="fas fa-arrow-left"></i> Continue Shopping
                </a>
            </div>
        </div>

        <!-- Stats -->
        

        <!-- Orders Table -->
        @if($allOrder->count() > 0)
        <div class="orders-table-container">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allOrder as $order)
                    <tr>
                        <td>
                            <strong>#{{ $order->id }}</strong>
                        </td>
                        <td>
                            <div class="product-cell">
                              <img class="product-image" src="{{ 
                                  $order->product && $order->product->images 
                                      ? (is_array($order->product->images) 
                                          ? asset($order->product->images[0] ?? 'images/no-image.png') 
                                          : (json_decode($order->product->images, true)[0] ?? asset('images/no-image.png')))
                                      : ($order->product && $order->product->image 
                                          ? asset('products/' . $order->product->image) 
                                          : asset('images/no-image.png')) 
                              }}" alt="{{ $order->product->name ?? 'Product' }}">
                            <div>
                                    <div class="product-name">{{ $order->product->name ?? 'Product Unavailable' }}</div>
                                    <small style="color: #666;">Qty: 1</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="product-price">₹{{ number_format($order->product->price ?? 0, 2) }}</div>
                        </td>
                        <td>
                            <div style="font-size: 0.875rem;">
                                {{ $order->created_at->format('d M Y') }}
                                <br>
                                <small style="color: #999;">{{ $order->created_at->format('h:i A') }}</small>
                            </div>
                        </td>
                        <td>
                            <span class="status-badge status-{{ $order->status }}">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('view-product', $order->product_id) }}" class="btn-success">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                
                                <!-- <a href="" class="btn-success" style="background: #17a2b8;">
                                    <i class="fas fa-file-pdf"></i> Invoice
                                </a> -->

                                @if($order->status == 'pending' || $order->status == 'processing')
                                <form action="{{ route('order.cancel', $order->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn-danger" onclick="return confirm('Are you sure you want to cancel this order?')">
                                        <i class="fas fa-times"></i> Cancel
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
</br>
                {{ $allOrder->links('pagination::bootstrap-5') }}
        </div>
        @else
        <!-- Empty State -->
        <div class="empty-state">
            <i class="fas fa-shopping-bag"></i>
            <h3>No Orders Yet</h3>
            <p>Looks like you haven't placed any orders. Start shopping now!</p>
            <a href="{{ route('home') }}" class="btn-primary">
                <i class="fas fa-shopping-cart"></i> Start Shopping
            </a>
        </div>
        @endif
    </div>

</body>
</html>