@extends('layouts.main')
@section('content')
@endsection
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="d-flex align-items-start ">
        <div class="si-bar bg-light border p-2 border-right-3 text-dark">
            <h1>sidebar_with_mina</h1>
            
        </div>
        <div>
            <div class="flex-row d-flex w-100 mt-5">
                <div class="col-md-3  me-4 text-center offset-2">
                    <img src="{{asset('pro.jpg')}}" class="w-75 rounded-circle" alt="">
                </div>
                <div class="col-md-5 d-flex flex-column align-items-start">
                    <div class="d-flex">
                        <h4>moatazgamal100100</h4>
                        <a href="" class="btn bt-insta  ms-3">Edit Profile</a>
                        <a href="" class="btn bt-insta ms-3">Saved Post</a>
                    </div>
                    <div class="mt-4">
                        <a href="" class=" ms-3 text-decoration-none text-dark">83 posts</a>
                        <a href="" class=" ms-3 text-decoration-none text-dark">1793 followers</a>
                        <a href="" class=" ms-3 text-decoration-none text-dark">1575 following</a>
                    </div>
                    <div class="mt-4">
                        <a href="" class=" ms-3 text-decoration-none text-dark">دكر</a>
                        <a href="" class=" ms-3  web text-dark">website</a>
                    </div>
                    <div class="mt-4 ">
                        <p>ma7bob 7abob bar b waldyh by3ml a7la wgayb ma3 el so8yr 2bl el kbeer</p>
                    </div>


                </div>
            </div>
            <hr class="w-75 mx-auto my-5">
            <div class="flex-row d-flex justify-content-center">
                <div class="col-md-3">
                    <div class="me-1">
                        <img class="w-100" src="{{'img1.jpeg'}}" alt="">
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="me-1">
                        <img class="w-100" src="{{'img2.jpeg'}}" alt="">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="me-1">
                        <img class="w-100" src="{{'img1.jpeg'}}" alt="">
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>