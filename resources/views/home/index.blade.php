<!DOCTYPE html>
<html>

<head>
 @include('home.css')
</head>

<body>
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

  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
    @include('home.header')
    </header>
    <!-- end header section -->
    <!-- slider section -->

    <section class="slider_section">
    @include('home.slider')
    </section>

    <!-- end slider section -->
  </div>
  <!-- end hero area -->

  <!-- shop section -->

  <section class="shop_section layout_padding">
   @include('home.shop')
  </section>

  <!-- end shop section -->

 





  <!-- contact section -->

  <section class="contact_section ">
    @include('home.contact')
  </section>

  <br><br><br>

  <!-- end contact section -->

   

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