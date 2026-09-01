<!-- Even more compact version -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        @page { margin: 8px 12px; }
        body { 
            font-family: 'DejaVu Sans', sans-serif; 
            font-size: 9px; 
            color: #333;
            margin: 0;
            padding: 0;
        }
        
        .header { 
            background: #667eea; 
            color: white; 
            padding: 8px 15px; 
            display: flex; 
            justify-content: space-between;
            border-radius: 4px 4px 0 0;
        }
        .header h1 { font-size: 18px; margin: 0; }
        .header .inv-no { font-size: 13px; background: rgba(255,255,255,0.2); padding: 2px 12px; border-radius: 12px; }
        
        .info { 
            display: grid; 
            grid-template-columns: 1fr 1fr; 
            gap: 8px; 
            padding: 6px 15px; 
            background: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }
        .info-box { padding: 4px 8px; }
        .info-box .lbl { font-size: 7px; text-transform: uppercase; color: #6c757d; font-weight: 600; }
        .info-box .val { font-size: 9px; line-height: 1.3; }
        
        .details { 
            display: grid; 
            grid-template-columns: repeat(4, 1fr); 
            gap: 5px; 
            padding: 5px 15px; 
            background: white;
            border-bottom: 1px solid #e9ecef;
        }
        .detail-item { text-align: center; padding: 4px; background: #f8f9fa; border-radius: 4px; }
        .detail-item .lbl { font-size: 7px; text-transform: uppercase; color: #6c757d; }
        .detail-item .val { font-size: 10px; font-weight: 700; }
        
        .badge { font-size: 8px; padding: 1px 6px; border-radius: 10px; font-weight: 600; }
        .badge-success { background: #d4edda; color: #155724; }
        .badge-warning { background: #fff3cd; color: #856404; }
        
        .table-wrap { padding: 4px 15px; }
        table { width: 100%; border-collapse: collapse; font-size: 8px; }
        table thead { background: #667eea; color: white; }
        table th, table td { padding: 3px 6px; text-align: left; }
        table th.text-right, table td.text-right { text-align: right; }
        table th.text-center, table td.text-center { text-align: center; }
        table tbody tr { border-bottom: 1px solid #f0f0f0; }
        
        .totals { 
            padding: 4px 15px; 
            display: flex; 
            justify-content: flex-end;
        }
        .totals-box { 
            width: 200px; 
            background: #f8f9fa; 
            padding: 6px 10px; 
            border-radius: 4px;
        }
        .total-row { 
            display: flex; 
            justify-content: space-between; 
            padding: 2px 0; 
            font-size: 8px;
            border-bottom: 1px solid #e9ecef;
        }
        .total-row:last-child { 
            border-bottom: none; 
            border-top: 2px solid #667eea;
            padding-top: 4px;
        }
        .total-row.grand-total .val { font-size: 12px; font-weight: 700; color: #667eea; }
        
        .footer { 
            background: #f8f9fa; 
            padding: 4px 15px; 
            text-align: center; 
            font-size: 7px;
            border-top: 1px solid #e9ecef;
            border-radius: 0 0 4px 4px;
        }
    </style>
</head>
<body>

<div class="header">
    <div><h1>INVOICE</h1><div style="font-size:7px;opacity:0.8;">GIFTOS</div></div>
    <div style="text-align:right;">
        <div class="inv-no">#INV-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</div>
        <div style="font-size:7px;opacity:0.8;">{{ $order->created_at ? $order->created_at->format('d M Y') : date('d M Y') }}</div>
    </div>
</div>

<div class="info">
    <div class="info-box">
        <div class="lbl">From</div>
        <div class="val"><strong>Giftos</strong><br>875 N Coast Hwy, Laguna Beach, CA</div>
    </div>
    <div class="info-box">
        <div class="lbl">Bill To</div>
        <div class="val"><strong>{{ $order->customer_name }}</strong><br>{{ $order->customer_address ?? 'N/A' }}</div>
    </div>
</div>

<div class="details">
    <div class="detail-item"><div class="lbl">Order ID</div><div class="val">#{{ $order->id }}</div></div>
    <div class="detail-item"><div class="lbl">Date</div><div class="val">{{ $order->created_at ? $order->created_at->format('d/m/Y') : date('d/m/Y') }}</div></div>
    <div class="detail-item"><div class="lbl">Payment</div><div class="val"><span class="badge badge-success">Paid</span></div></div>
    <div class="detail-item">
        <div class="lbl">Status</div>
        <div class="val">
            <span class="badge {{ $order->status == 'Delivered' ? 'badge-success' : 'badge-warning' }}">
                {{ $order->status ?? 'Pending' }}
            </span>
        </div>
    </div>
</div>

@php
    $subtotal = 0;
    $qty = $order->quantity ?? 1;
    $price = $order->product->price ?? 0;
    $total = $qty * $price;
    $subtotal += $total;
    $tax = $subtotal * 0.10;
    $shipping = $subtotal > 100 ? 0 : 15;
    $grandTotal = $subtotal + $tax + $shipping;
@endphp

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th style="width:5%;">#</th>
                <th style="width:50%;">Product</th>
                <th class="text-center" style="width:10%;">Qty</th>
                <th class="text-right" style="width:17%;">Price</th>
                <th class="text-right" style="width:18%;">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>{{ $order->product->name ?? 'Product' }}</td>
                <td class="text-center">{{ $qty }}</td>
                <td class="text-right">${{ number_format($price, 2) }}</td>
                <td class="text-right">${{ number_format($total, 2) }}</td>
            </tr>
        </tbody>
    </table>
</div>

<div class="totals">
    <div class="totals-box">
        <div class="total-row"><span>Subtotal</span><span>${{ number_format($subtotal, 2) }}</span></div>
        <div class="total-row"><span>Tax (10%)</span><span>${{ number_format($tax, 2) }}</span></div>
        <div class="total-row"><span>Shipping</span><span>${{ number_format($shipping, 2) }}</span></div>
        <div class="total-row grand-total"><span>Total</span><span>${{ number_format($grandTotal, 2) }}</span></div>
    </div>
</div>

<div class="footer">
    Thank you for your business! Payment due within 7 days
</div>

</body>
</html>