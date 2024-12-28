<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Product:Laptop</h1>
    <h3>Price:100</h3>
    <form action="{{route('razorpay')}}" method="post">
       @csrf
       <script src="https://checkout.razorpay.com/v1/checkout.js"
       data-key="{{env('RAZORPAY_KEY')}}"
       data-amount="10000"
       data-currency="INR"
       data-payment-methods='{"card": true, "upi": true, "wallet": true, "netbanking": true}'
       data-buttontext="Pay with Razorpay"
       data-image="https://uxwing.com/wp-content/themes/uxwing/download/brands-and-social-media/razorpay-icon.png"
       data-notes.customer_name="Saboora"
       data-notes.customer_email="shareekha123@gmail.com"
       data-notes.product_name="Laptop"
       data-notes.quantity="1"
       data-prefill.name="Saboora Shareeka">

       </script>
    </form>
</body>
</html>