<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>I am a PDF</h1>

    <center>
        <h1>Customer Name: {{$data->name}}</h1>
        <h1>Customer Phone: {{$data->order_phone}}</h1>
        <h1>Customer Address: {{$data->order_address}}</h1>
        <h1>Product Name: {{$data->title}}</h1>
        <h1>Product Price: {{$data->price}}</h1>
        <img src="storage/{{$data->image}})" alt="Product Image">
        <!-- <img src="{{ public_path('storage/' . $data->image) }}" alt="Product Image"> -->


        </center>
</body>
</html>