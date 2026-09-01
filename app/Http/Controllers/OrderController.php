<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;



use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function view(){
        $orders = Order::orderBy('created_at', 'desc')->paginate(5);;
        return view('admin.vieworders',compact('orders'));

        $allOrder = Order::all();
        return view('admin.vieworders',compact('allOrder'));
    }
    public function userOrders(){
        
    }
    public function store(Request $request){
    // Get user's cart items
    $cart_items = Cart::where('user_id', Auth::id())->get();
    
    $address = $request->address;
    $phone = $request->phone;
    $name = $request->name;
    
    foreach($cart_items as $cart_item){
        $order = new Order();
        $order->customer_address = $address;
        $order->customer_phone = $phone;
        $order->customer_name = $name;
        $order->user_id = Auth::id();
        $order->product_id = $cart_item->product_id; 
        $order->save();
    }
    
    Cart::where('user_id', Auth::id())->delete();
    
        return redirect()->back()->with('success', 'Order placed successfully!');
    }
    public function edit($id){
        $order = Order::findOrFail($id);
        return view('admin.editorder',compact('order'));
    }
    public function update(Request $request,$id){
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        $allOrder = Order::all();
        return redirect()->back()->with('success', 'Order Updated successfully!');

        //return view('admin.vieworders',compact('allOrder','success'));
        //return redirect()->back()->with('success', 'Order Updated successfully!');
    }
    public function search(Request $request){
        $order = Order::where('customer_name','LIKE','%'.$request->search.'%')->
        orWhere('customer_phone','LIKE','%'.$request->search.'%')->
        orWhere('status','LIKE','%'.$request->search.'%')->
        paginate(2);
        $orders = Order::paginate(2);

        return view('admin.vieworders',compact('order','orders'));
    }
    public function myorder(){
        //echo Auth::id(); die;
        $allOrder = '';
        if(Auth::check()){
                    $allOrder = Order::where('user_id',Auth::id())->get();
                }else{
                    return view('login');
                }
        return view('myorders',compact('allOrder'));
    }
    public function invoice($id){
        $order = Order::with('product')->findOrFail($id);
        $pdf = Pdf::loadView('admin.invoice', compact('order'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('invoice-' . $order->id . '.pdf');
    }
    public function downloadInvoice($id){
        $order = Order::with('product')->findOrFail($id);
        $pdf = Pdf::loadView('admin.invoice', compact('order'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('invoice-' . $order->id . '.pdf');
    }
    public function invoiceview(){
        return view('admin.invoice');
    }
    public function usermyorder()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to view your orders.');
        }
    
        $allOrder = Order::where('user_id', Auth::id())
            ->with('product')
            ->orderBy('created_at', 'desc')
            ->paginate(3);
        return view('myorders', compact('allOrder'));
    }
}
