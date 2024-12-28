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
          <h1 style="color:white;">Add Category</h1>
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
                        <form action="{{url('update_category/'.$category->id)}}" method="post">
                            @csrf
                            <div>
                            <input type="text" name="category" value="{{$category->category_name}}" placeholder="Enter category name">
                            <button type="submit" class="btn btn-warning">Update Category</button>
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