@extends('layouts.main')
@section('content')
    <div class="flex-row d-flex mt-5">
        <div class="col-md-3  me-4 text-center offset-1 ">
            <img src="{{asset('img10.jpeg')}}" class="w-75 rounded-circle" alt="">
        </div>
        <div class="col-md-6 d-flex flex-column align-items-start">
            <div class="d-flex">
                <h4>Marwan & Weza</h4>
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
                <p>مفيش حاجة صعبة عاللي بيذاكر كويس</p>
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
@endsection
