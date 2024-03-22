<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>This is a PDF file....</h1>
    <h1>Order ID: {{ $order_data->id }}</h1>
    <h1>Product Name: {{ $order_data->product->name }}</h1>

    <h1>Quantity: {{ $order_data->quantity }}</h1>
    <h1>Payment Status: {{ $order_data->payment_status }}</h1>
    <h1>Delivery Status: {{ $order_data->delivery_status }}</h1>

    <br />
    {{-- /Users/sangeetha/Desktop/March 2024_office work/event_management/public/storage/product_images --}}
    {{-- <img src="storage/product_images/{{ $order_data->product->image }}" alt="{{ $order_data->product->name }}"
        width="50px" height="50px" style="object-fit: contain">

    <img src="{{ asset('storage/product_images/' . $order_data->product->image) }}"
        alt="{{ $order_data->product->name }}" width="50px" height="50px" style="object-fit: contain"> --}}
</body>

</html>
