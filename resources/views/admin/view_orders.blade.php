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
          <h1 style="color:white;">List Of Products</h1>
          <form id="filterForm" method="get" action="{{ route('view_orders') }}" >
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <!-- <label for="filterName">Filter </label> -->
                            <input type="text" class="form-control" id="filterName" name="filterName" placeholder="Search" value="{{ request('filterName') }}">
                            <button type="submit" class="btn btn-primary" id="applyFilterBtn">
                            Apply Filter
                        </button>
                        <button type="button" class="btn btn-secondary" id="resetFilterBtn">
                            Reset
                        </button>
                        </div>
                    </div>
                
                >
                </div>
            </form>
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
                   
                <div class="table-container">
                    <table class="table table-responsive table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Customer Address</th>
                                <th scope="col">Customer Phone</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Image</th>
                                <th scope="col">Product Price</th>
                                <th scope="col">Order Status</th>
                                <th scope="col">Action</th>
                                <th scope="col">Print</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>
                                    {{$order->name}}
                                </td>
                                <td>
                                {{$order->order_address}}
                                </td>
                                <td>
                                {{$order->order_phone}}
                                </td>
                                
                                <td>
                                {{$order->title}}
                                </td>
                                <td>
                                <img src="{{ asset('storage/' . $order->image) }}" alt="{{ $order->title }}" style="width: 200px; height: 150px;"> <!-- Adjust dimensions as needed -->
                               </td><td>
                               {{$order->price}}
                               </td>
                                <td>
                                    @if( $order->order_status == 'pending')
                                    <p style="color:red;">Pending</p>
                                    @elseif( $order->order_status=='on the way')
                                    <p style="color:yellow;">On the way</p>
                                    @else
                                    <p style="color:green;">Delivered</p>
                                    @endif
                                </td>
                                <td>
                                <a href="{{url('/on_the_way/'.$order->id)}}" class="btn btn-warning">On the way</a>
                                <a href="{{url('/delivered/'.$order->id)}}" class="btn btn-success">Delivered</a>
                                </td>
                                <td>
                               
                                <a href="{{url('/print_pdf/'.$order->id)}}" class="btn btn-secondary">Print PDF</a>
                                </td>
                             
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    <div class="div_deg">
                    {{$orders->onEachSide(1)->links()}}
                    </div>
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
    <script>
        document.getElementById('resetFilterBtn').addEventListener('click',function(){
            window.location.href="/view_orders";
        });
    </script>

  </body>
</html>