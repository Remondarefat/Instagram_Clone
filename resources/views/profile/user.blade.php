@extends('layouts.main')
@section('title' , $user->username )
@section('content')
    <div class="user-profile-container d-flex">
        <div class="image align-self-center">
            <img src="{{$user->avatar}}" class="user-profile-pic "
                alt="user image">
        </div>
        <div>
            <div class="user-info d-flex">
                <h5 class="pe-3">{{ $user->username }}</h5>
                <button type="button" class="btn btn-secondry user-profile-btn me-3"> Following <i
                        class="fa-solid fa-arrow-down" style="color: #000714;"></i></button>
                <button type="button" class="btn btn-secondry user-profile-btn me-3">Message</button>

            </div>

            <div class="followrs-info d-flex mt-4 d-flex">
                <p class="me-5"><span class="fw-bold">581 </span>posts</p>
                <p class="me-5"><span class="fw-bold">500</span> followers</p>
                <p class="me-5"><span class="fw-bold">900 </span>following</p>
            </div>
            <div>
                <h4>{{ $user->fullname }}</h4>
                <p>{{ $user->bio }}</p>
                <!-- mutual followers -->
                <p class="followedby">Followed by <span class="fw-bold ">remonda__, salmaelmarhoumy,moataz , marwan , mina +
                        48 more </span></p>
            </div>
        </div>
    </div>
@endsection
