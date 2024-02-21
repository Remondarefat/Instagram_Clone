@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- Including Sidebar --}}
        <div class="col-md-3">
            @include('includes.navbar') {{-- Assuming 'includes.navbar' is your sidebar --}}
        </div>

        {{-- Main Content --}}
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="d-flex align-items-center">
                        <img class="rounded-circle im-pro me-md-2" src="{{'img10.jpeg'}}" alt="">
                        <h4>user name</h4>
                    </div>
                    <div id="carouselExample" class="carousel slide text-center mt-md-2 cur">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="w-100 h-100 me-md-2" src="{{'pro.jpg'}}" alt="">
                            </div>
                            <div class="carousel-item">
                                <img class="w-100 h-100 rounded-circle me-md-2" src="{{'rrr.jpg'}}" alt="">
                            </div>
                            <div class="carousel-item">
                                <h1>test3</h1>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bg-black" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                            <span class="carousel-control-next-icon bg-black" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="d-flex mt-md-2 justify-content-between">
                        <div>
                            <i class="fa-solid h4 fa-heart text-black"></i>
                            <i class="fa-solid fa-comment ms-md-2 h4 text-black"></i>
                        </div>
                        <i class="fa-solid fa-bookmark h4 text-black"></i>
                    </div>
                    <div class="d-flex align-items-start mt-md-2">
                        <img class="rounded-circle im-com me-md-2" src="{{'rrr.jpg'}}" alt="">
                        <h6 class="p-0 m-0 bold mt-md-1">username</h6>
                        <p class="p-0 m-0 ms-md-2">Lorem ipsum dolor sit, amet consectetur adipisicing elit. asdsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdd Iure</p>
                    </div>
                    <div class="d-flex align-items-start mt-md-2">
                        <img class="rounded-circle im-com me-md-2" src="{{'rrr.jpg'}}" alt="">
                        <h6 class="p-0 m-0 bold mt-md-1">username</h6>
                        <p class="p-0 m-0 ms-md-2">Lorem ipsum dolor sit, amet consectetur adipisicing elit. asdsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdd Iure</p>
                    </div>
                    <div class="d-flex align-items-start mt-md-2">
                        <img class="rounded-circle im-com me-md-2" src="{{'rrr.jpg'}}" alt="">
                        <h6 class="p-0 m-0 bold mt-md-1">username</h6>
                        <p class="p-0 m-0 ms-md-2">Lorem ipsum dolor sit, amet consectetur adipisicing elit. asdsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdd Iure</p>
                    </div>

                    <input type="text" placeholder="Add a comments..." class="w-100 p-2 border border-top-0 border-end-0 border-start-0 mb-md-2">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
