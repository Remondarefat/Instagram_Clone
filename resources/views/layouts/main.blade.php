<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') Instagram </title>
    <link rel="icon" href= "{{asset('instagram.png')}}" type="image/x-icon"> 
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <!-- !------Loading Page-- -->
    <div id="loading">
        <div class="ring d-flex flex-column align-items-center justify-content-between w-100 h-100 mb-5">
            <div></div>
            <img src="{{ asset('R.png') }}" >
            <div class="text-center Loding_text d-flex flex-column ">
                <span class="text-muted">From</span>
                <img src="{{ asset('OIP.jpeg') }}">
            </div>
        </div>
    </div>
    <!--!------------------------------------------->
    <div class=" container-fluid">
        <div class="row">
            <div class=" m-0 p-0 col-md-2">
                @include('includes.sidebar') 
            </div>
            <div class=" col-md-8 offset-1  ">
                @yield('content')
            </div>
        </div>
    </div>
    <script>
        // !----- Loading Page -------
        $(document).ready(function(){
            $("#loading .ring").fadeOut(170 , function() {
            $("#loading").fadeOut(1800, function(){
                $("#loading").remove();
                $("#homePage").css("overflow" , "auto");
            })
            });
        });
  // !----- Loading Page -------
    </script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/whatwg-fetch/3.6.2/fetch.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="{{ asset('js/modal.js') }}"></script>



</body>

</html>
