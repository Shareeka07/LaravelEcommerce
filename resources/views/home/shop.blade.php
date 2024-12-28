<style>
.container {
  padding: 20px; /* Add padding around the container */
}

.row {
  display: flex;
  flex-wrap: wrap;
  margin: -10px; /* Adjust margin for gutters */
}

.col-sm-6, .col-md-4, .col-lg-3 {
  padding: 10px; /* Padding around each column */
  box-sizing: border-box; /* Ensure padding is included in width calculation */
}

.box {
  background-color: #f8f9fa; /* Light background for product boxes */
  border: 1px solid #ddd; /* Add a border */
  border-radius: 5px; /* Rounded corners */
  overflow: hidden; /* Hide overflow for any content */
  transition: transform 0.2s; /* Smooth transform on hover */
}

.box:hover {
  transform: scale(1.05); /* Slightly enlarge on hover */
}

.detail-box .btn {
  margin: 5px;
  font-size: 14px;
}

/* Align the buttons side-by-side using Flexbox */
.button-container {
  display: flex; /* Use flexbox for buttons */
 
  flex-wrap: wrap; /* Allow wrapping if necessary */
}

/* Responsive styles for smaller screens */
@media (max-width: 576px) {
  .col-sm-6, .col-md-4, .col-lg-3 {
    flex: 0 0 100%; /* Full width for smaller screens */
  }

  .detail-box .btn {
    width: 100%; /* Full width for buttons on small screens */
    font-size: 12px; /* Smaller font size */
  }

  .button-container {
    flex-direction: column; /* Stack buttons vertically on small screens */
  }
}

@media (min-width: 576px) {
  .col-sm-6 {
    flex: 0 0 50%; /* 2 products per row on small screens */
  }
}

@media (min-width: 768px) {
  .col-md-4 {
    flex: 0 0 33.33%; /* 3 products per row on medium screens */
  }
}

@media (min-width: 992px) {
  .col-lg-3 {
    flex: 0 0 25%; /* 4 products per row on large screens */
  }
}
</style>


<div class="container">
  <div class="heading_container heading_center">
    <h2>Latest Products</h2>
  </div>

  <div class="row">
    @foreach($products as $product)
      <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="box">
          <a href="">
            <div class="img-box">
              <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}">
            </div>
            <div class="detail-box">
              <h6>{{$product->title}}</h6>
              <h6>Price <span>{{$product->price}}</span></h6>
              <div class="button-container"> <!-- Updated this div to button-container -->
                <a href="{{url('product_details/'.$product->id)}}" class="btn btn-danger btn-sm">Details</a>
                <a href="{{url('add_cart/'.$product->id)}}" class="btn btn-primary btn-sm">Add Cart</a>
              </div>
            </div>
            <div class="new">
              <span>New</span>
            </div>
          </a>
        </div>
      </div>
    @endforeach
  </div>

  <div class="btn-box">
    <a href="">View All Products</a>
  </div>
</div>
