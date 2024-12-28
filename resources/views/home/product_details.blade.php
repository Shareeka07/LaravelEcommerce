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

  <!-- shop section -->

  <section class="product_details_section layout_padding">
        <div class="container">
            <div class="row">
                <!-- Product Image -->
                <div class="col-md-6">
                    <div class="product_image">
                        <img src="{{ asset('storage/' . $products->image) }}" alt="{{ $products->title }}" class="img-fluid">
                    </div>
                </div>

                <!-- Product Details -->
                <div class="col-md-6">
                    <div class="product_details">
                        <h2>{{ $products->title }}</h2>
                        <p class="price">
                            <strong>Price:</strong> ${{ $products->price }}
                        </p>
                        <p class="description">
                            <strong>Description:</strong><br>
                            {{ $products->description }}
                        </p>
                      
                    </div>
                </div>
            </div>
        </div>
    </section>

  <!-- end shop section -->







 

   

  <!-- info section -->

  <section class="info_section  layout_padding2-top">
   @include('home.footer')
</body>

</html>