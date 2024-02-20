@extends('layouts.main')

@section('content')

<div class="user-profile-container d-flex">
    <div class="image align-self-center">
        <img src="https://i.pinimg.com/564x/cd/04/ff/cd04ff6d7231af8b76b0792087c6d223.jpg" class="user-profile-pic " alt="user image">
    </div>
    <div>
    <div class="user-info d-flex">
        <!-- username -->
        <h5 class="pe-3">rehabsabryy</h5>
        <button type="button"  class="btn btn-secondry user-profile-btn me-3"> Following <i class="fa-solid fa-arrow-down" style="color: #000714;"></i></button>
        <button type="button" class="btn btn-secondry user-profile-btn me-3">Message</button>
       
    </div>
    
    <div class="followrs-info d-flex mt-4 d-flex">
        <p class="me-5"><span class="fw-bold">581 </span>posts</p>
        <p class="me-5"><span class="fw-bold">500</span> followers</p>
        <p class="me-5"><span class="fw-bold">900 </span>following</p>
    </div>
    <div>
        <!-- first +last name -->
        <h4>Rehab sabry</h4>
        <!-- bio -->
        <p>human</p>
        <!-- mutual followers -->
        <p class="followedby">Followed by <span class="fw-bold ">remonda__, salmaelmarhoumy,moataz , marwan , mina + 48 more </span></p>
    </div>
    </div>
</div>
@endsection