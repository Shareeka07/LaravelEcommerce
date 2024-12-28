<!DOCTYPE html>
<html>
  <head> 
   @include('admin.css')
   <style type="text/css">
     input[type='text']
     {
        width:400px;
        height:50px;
     }
     .div_deg
     {
        display:flex;
        justify-content:center;
        align-items:center;
        margin:30px;
     }
     .table-container {
            /* padding: 20px;
            background-color: #fff;
            border-radius: 5px; */
            margin:auto;
            text-align:center;
        }
   </style>
  </head>
  <body>
    <header class="header">   
      @include('admin.header')
    </header>
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
          <h1 style="color:white;">Add Product</h1>
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
                    <div class="div_deg">
                        
                       


                          <!-- Add Category Form -->
                        <form action="{{ url('save_product') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <!-- Title Field -->
                                <div class="col-md-6 mb-3">
                                    <label for="title" class="form-label">Product Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter product title" required>
                                </div>

                                <!-- Description Field -->
                                <div class="col-md-6 mb-3">
                                    <label for="description" class="form-label">Product Description</label>
                                    <textarea name="description" class="form-control" placeholder="Enter product description" rows="3" required></textarea>
                                </div>

                                <!-- Price Field -->
                                <div class="col-md-6 mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" name="price" class="form-control" placeholder="Enter price" step="0.01" required>
                                </div>

                                <!-- Quantity Field -->
                                <div class="col-md-6 mb-3">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" name="quantity" class="form-control" placeholder="Enter quantity" required>
                                </div>

                                <!-- Category Field -->
                                <div class="col-md-6 mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select name="category" class="form-select" required>
                                        <option value="">Select Category</option>
                                        <!-- Assuming $categories contains category names -->
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Image Upload Field -->
                                <div class="col-md-6 mb-3">
                                    <label for="image" class="form-label">Product Image</label>
                                    <input type="file" name="image" class="form-control" required>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Save Product</button>
                            </div>
                        </div>
                    </form>

                </div>
              

          </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{asset('/admincss/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('/admincss/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('/admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('/admincss/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('/admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('/admincss/js/charts-home.js')}}"></script>
    <script src="{{asset('/admincss/js/front.js')}}"></script>
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
  </body>
</html>