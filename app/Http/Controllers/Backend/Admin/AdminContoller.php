<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminContoller extends Controller
{
    public function admin_dashboard()
    {
        $total_product = Product::all()->count();
        $total_order = Order::all()->count();
        $total_user = User::all()->count();

        $order = Order::all();
        $total_revenue = 0;
        foreach ($order as $order) {
            $total_revenue = $total_revenue + $order->product->price;
        }
        $total_delivered = Order::where('delivery_status', '=', 'delivered')->get()->count();
        $total_processing = Order::where('delivery_status', '=', 'processing')->get()->count();
        // dd($total_delivered);
        $user = Auth::user(); // Get the currently authenticated user
        return view('admin.dashboard', compact('user', 'total_product', 'total_order', 'total_user', 'total_revenue', 'total_delivered', 'total_processing'));
    }
}
