<!DOCTYPE html>
<html>

<head>
 @include('home.css')
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
    @include('home.header')
    </header>
    <!-- end header section -->
   
  <!-- </div> -->
  <!-- end hero area -->

   <!-- Display Validation Errors and Success Messages -->
   @if ($errors->any())
                                <div id="error_message" class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                </div>
                            @endif

                            @if (session('success'))
                                <div id="success_message" class="alert alert-success">
                                {{ session('success') }}
                                </div>
                            @endif

  <!-- cart section -->
  <div class="container">
    <div class="heading_container heading_center">
        <h2>Your Cart</h2>
    </div>

   

    @if ($carts->isEmpty())
        <div class="alert alert-warning">
            Your cart is currently empty.
        </div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    
                    <th>Product Image</th>
                    <th>Product Title</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @php
            $total_price = 0;
            @endphp



                @foreach ($carts as $cart)
                   
                   
                        <tr>
                       
                            <td>
                                <img src="{{ asset('storage/' . $cart->image) }}" alt="{{ $cart->title }}" style="width: 100px;">
                            </td>
                            <td>{{ $cart->title }}</td>
                            <td>${{ $cart->price }}</td>
                            
                              <!-- Blade template -->
                                <td>
                                <form action="{{url('remove_from_cart/'.$cart->cart_id)}}" method="POST" style="display:inline;">
                                   @csrf
                                    @method('DELETE') <!-- This is needed for Laravel to understand it's a delete request -->
                                     <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                </form>
                                </td>



                        </tr>
                        @php
                        $total_price += $cart->price;
                    @endphp

                   
                @endforeach
            </tbody>
        </table>
        <h3 style="text-align:center;">Total Price is Rs.{{$total_price}}</h3>

     
        <div class="row justify-content-center mt-5">
                <div class="col-md-6">
                    <h3 class="text-center">Order Details</h3>
                    <form action="{{ url('place_order') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Full Name:</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{Auth::user()->name}}" required>
                        </div>
                       
                        <div class="form-group">
                            <label for="phone">Phone Number:</label>
                            <input type="text" id="phone" name="phone" class="form-control" value="{{Auth::user()->phone}}" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <textarea id="address" name="address" class="form-control" rows="3" required>{{Auth::user()->address}}</textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block mb-5">Place Order</button>
                    </form>
                </div>
            </div>
    @endif
</div>
 

  <!-- end cart section -->







 

   

  <!-- info section -->

  <section class="info_section  layout_padding2-top">
   @include('home.footer')
</body>
<script>
        setTimeout(function(){
          var error=document.getElementById('error_message');
          var success=document.getElementById('success_message');
          if(error){
            error.style.display="none";
          }
          if(success){
            success.style.display="none";
          }

        },3000);
    </script>
</html>