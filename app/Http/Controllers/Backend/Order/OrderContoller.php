<?php

namespace App\Http\Controllers\Backend\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Notifications\SendEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
// use Barryvdh\DomPDF\Facade as PDF;
use PDF;


class OrderContoller extends Controller
{
    //
    public function index()
    {

        // "id" => 1
        // "user_id" => 2
        // "product_id" => 6
        // "quantity" => 1
        // "payment_status" => "cash on delivery"
        // "delivery_status" => "processing"
        // "created_at" => "2024-03-17 12:48:12"
        // "updated_at" => "2024-03-17 12:48:12"
        // $order_data = Order::get();
        $order_data = Order::paginate(10); // Paginate with 10 records per page
        // dd($order_data->product->id);
        return view('admin.order_management.index', compact('order_data'));
    }

    public function delivered($id)
    {
        $order_data = Order::find($id);
        $order_data->delivery_status = "delivered";
        $order_data->payment_status = "paid";
        $order_data->save();
        return redirect()->back()->with('message', 'Delivery Status is Updated');
    }
    public function print_pdf($id)
    {

        $order_data = Order::find($id);

        $pdf = PDF::loadview('admin.pdf.index', compact('order_data'));
        return $pdf->download('sample.pdf');
        // return redirect()->back()->with('message', 'Downloaded Successfully');
    }
    public function send_mail($id)
    {
        $order_data = Order::find($id);
        return view('admin.order_management.send_mail', compact('order_data'));
    }

    public function send_email_user(Request $request, $id)
    {
        $order_data = Order::find($id);

        if (!$order_data) {
            return redirect()->route('order.index')->with('error', 'Order not found.');
        }

        $details = [
            'greeting' => $request->greeting,
            'firstline' => $request->firstline,
            'body' => $request->body,
            'button' => $request->button,
            'url' => $request->url,
            'lastline' => $request->lastline,
        ];

        $userEmail = $order_data->user->email;

        // Ensure the user has an email address
        if (!$userEmail) {
            return redirect()->route('order.index')->with('error', 'User does not have an email address.');
        }

        Notification::route('mail', $userEmail)->notify(new SendEmailNotification($details));

        return redirect()->route('order.index')->with('message', 'Mail sent successfully.');
    }
    public function search_data(Request $request)
    {
        $searchText = $request->search_text;
        // dd($searchText);

        // Paginate the query results
        $order_data = Order::with('product')
            ->whereHas('product', function ($query) use ($searchText) {
                $query->where('name', 'LIKE', '%' . $searchText . '%');
            })
            ->paginate(10); // 10 items per page, adjust as needed

        // $order = order::where('name', 'LIKE', '%$searchText%')->orWhere('phone', 'LIKE', '%$serachText%')->get();
        return view('admin.order_management.index', compact('order_data'));
    }
}
