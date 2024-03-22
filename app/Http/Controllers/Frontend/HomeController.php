<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Product;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Stripe;
use Stripe\PaymentIntent;

class HomeController extends Controller
{
    //

    public function index()
    {
        $user = Auth::user();
        $products = Product::all(); // Fetch all products

        $comments = Comment::orderby('id', 'desc')->get();
        $reply = Reply::all();
        // dd($comment);
        return view('frontend.index', compact('user', 'products', 'comments', 'reply'));
    }
    public function show_single_product($id)
    {

        $single_product = Product::findOrFail($id);

        return view('frontend.Product.show', compact('single_product'));
    }

    public function addToCart(Request $request)
    {
        if (!Auth::check()) {
            // Save the intended URL before redirecting to the login page
            session()->put('url.intended', url()->previous());
            return redirect()->route('frontend_login.index'); // Redirect to the login route
        }

        // Id = productId
        $productId = $request->input('productId');
        $quantity = $request->input('quantity');

        // Retrieve the product's price from the database
        $product = Product::findOrFail($productId);
        $price = $product->price;

        // Check if the product already exists in the user's cart
        $cartItem = Cart::where('product_id', $productId)
            ->where('user_id', auth()->id())
            ->first();

        if ($cartItem) {
            // If the product exists, update the quantity
            $previous_quantity = $cartItem->quantity;
            $cartItem->quantity =  $previous_quantity + $quantity;
            $cartItem->price = $cartItem->quantity * $price;
            $cartItem->save();
            return redirect()->back()->with('message', 'Product added to cart');
        } else {
            // If the product doesn't exist, create a new cart item
            $cartItem = new Cart();
            $cartItem->user_id = auth()->id(); // Assuming you have authentication and want to associate with the logged-in user
            $cartItem->product_id = $productId;
            $cartItem->quantity = $quantity;
            $cartItem->price = $quantity * $price;
            $cartItem->save();
            return redirect()->back()->with('message', 'Product added to cart');
        }
        return redirect()->back()->with('message', 'Product added to cart');
    }

    public function show_Cart()
    {

        $userId = Auth::id();
        // Check if user is authenticated
        if (!$userId) {
            // Handle unauthenticated user (e.g., redirect to login)
            return redirect()->route('frontend_login.index');
        }

        // Fetch cart items for the authenticated user
        $cartItems = Cart::where('user_id', $userId)
            ->with('product')
            ->get();


        return view('frontend.Product.show_cart', compact('cartItems'));
    }
    public function show_Cart_remove($id)
    {
        $cartItem = Cart::find($id);

        if (!$cartItem) {
            // Handle case where cart item with given ID was not found
            // For example, you can return an error message or redirect back
            return redirect()->back()->with('error', 'Cart item not found.');
        }

        // Delete the cart item
        $cartItem->delete();

        // Optionally, you can redirect back with a success message
        return redirect()->back()->with('message', 'Cart item removed successfully.');
    }
    // cash_on_delivery
    public function cash_on_delivery()
    {
        $userId = Auth::id();

        // Check if user is authenticated
        if (!$userId) {
            // Handle unauthenticated user (e.g., redirect to login)
            return redirect()->route('frontend_login.index');
        }

        // Retrieve all cart items for the authenticated user
        $cartItems = Cart::where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Cart items not found.');
        }

        // Loop through each cart item to create an order
        foreach ($cartItems as $cartItem) {
            // Create a new Order record
            $order = new Order();
            $order->user_id = $cartItem->user_id;
            $order->product_id = $cartItem->product_id;
            $order->quantity = $cartItem->quantity;
            $order->payment_status = 'cash on delivery'; // Set default payment status
            $order->delivery_status = 'processing'; // Set default delivery status
            $order->save();

            // Optionally, you can perform additional processing here
            // For example, sending confirmation emails, updating stock, etc.

            // Delete the corresponding Cart item
            $cartItem->delete();
        }
        // Redirect or return a response as needed
        return redirect()->back()->with('message', 'We have received your order. Thank you for shopping with us!');
    }
    public function stripe($totalPrice)
    {
        // dd($totalPrice);
        return view('frontend.Product.stripe', compact('totalPrice'));
    }
    public function stripePost(Request $request, $totalPrice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => $totalPrice * 100,
            "currency" => "inr",
            "source" => $request->stripeToken,
            "description" => "Thanks for payment."
        ]);

        $userId = Auth::id();

        // Check if user is authenticated
        if (!$userId) {
            // Handle unauthenticated user (e.g., redirect to login)
            return redirect()->route('frontend_login.index');
        }

        try {
            // Retrieve all cart items for the authenticated user
            $cartItems = Cart::where('user_id', $userId)->get();

            if ($cartItems->isEmpty()) {
                return redirect()->back()->with('error', 'Cart items not found.');
            }

            // Loop through each cart item to create an order
            foreach ($cartItems as $cartItem) {
                // Create a new Order record
                $order = new Order();
                $order->user_id = $cartItem->user_id;
                $order->product_id = $cartItem->product_id;
                $order->quantity = $cartItem->quantity;
                $order->payment_status = 'paid'; // Set default payment status
                $order->delivery_status = 'processing'; // Set default delivery status
                $order->save();

                // Optionally, you can perform additional processing here
                // For example, sending confirmation emails, updating stock, etc.

                // Delete the corresponding Cart item
                $cartItem->delete();
            }
            Session::flash('success', 'Payment successful!');
        } catch (\Exception $e) {
            // Handle payment failure
            Session::flash('error', $e->getMessage());
        }
        // Redirect to the "show_cart" route
        return redirect()->route('show_cart.add')->with('message', 'Payment process is complete. Thank you for shopping with us!');
    }

    // show order
    public function show_order()
    {
        $userId = Auth::id();
        // Check if user is authenticated
        if (!$userId) {
            // Handle unauthenticated user (e.g., redirect to login)
            return redirect()->route('frontend_login.index');
        }

        // Fetch cart items for the authenticated user
        $orderItems = Order::where('user_id', $userId)
            ->with('product')
            ->get();
        // dd($orderItems);
        return view('frontend.Product.order', compact('orderItems'));
    }
    // cancel order
    public function cancel_order($id)
    {
        $order = Order::find($id);
        $order->delivery_status = "You Canceled the order";
        $order->save();
        return redirect()->back()->with('message', 'You Canceled The Order.');
    }
    // add_comment

    public function add_comment(Request $request)
    {
        $userId = Auth::id();
        // Check if user is authenticated
        if (!$userId) {
            // Handle unauthenticated user (e.g., redirect to login)
            return redirect()->route('frontend_login.index');
        }
        // dd($request);

        $comment = new Comment();
        $comment->name = Auth::user()->name;
        $comment->user_id = Auth::user()->id;
        $comment->comment = $request->comment;

        $comment->save();

        return redirect()->back()->with('message', 'Your Comment Added.');
    }
    // add_reply
    public function add_reply(Request $request)
    {
        $userId = Auth::id();
        // Check if user is authenticated
        if (!$userId) {
            // Handle unauthenticated user (e.g., redirect to login)
            return redirect()->route('frontend_login.index');
        }
        $reply = new Reply();
        $reply->name = Auth::user()->name;
        $reply->user_id = Auth::user()->id;
        $reply->comment_id = $request->comment_id;
        $reply->reply = $request->reply;

        $reply->save();
        return redirect()->back()->with('message', 'Your Reply is Added.');
    }
    // product_search

    public function product_search(Request $request)
    {
        $search_text = $request->search;
        $products = Product::where('name', 'LIKE', '%' . $search_text . '%')->paginate(10);

        $comments = Comment::orderBy('id', 'desc')->get();
        $reply = Reply::all();

        $user = Auth::user(); // Assuming you are using Laravel's authentication

        return view('frontend.index', compact('user', 'products', 'comments', 'reply'));
    }

    // ProductPage
    public function products()
    {
        $user = Auth::user();
        $products = Product::all(); // Fetch all products

        $comments = Comment::orderby('id', 'desc')->get();
        $reply = Reply::all();
        // dd($comment);
        return view('frontend.Product.all_product', compact('user', 'products', 'comments', 'reply'));
    }
    // search_product
    public function search_product(Request $request)
    {
        $search_text = $request->search;
        $products = Product::where('name', 'LIKE', '%' . $search_text . '%')->paginate(10);

        $comments = Comment::orderBy('id', 'desc')->get();
        $reply = Reply::all();

        $user = Auth::user(); // Assuming you are using Laravel's authentication

        return view('frontend.Product.all_product', compact('user', 'products', 'comments', 'reply'));
    }
}
