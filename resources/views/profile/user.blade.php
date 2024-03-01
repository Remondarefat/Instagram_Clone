@extends('layouts.main')
@section('title', "$user->fullname (@$user->username)-")
@section('content')
    <div class="user-profile-container d-flex">
        <div class="image align-self-center">
            <img src="{{ Storage::url($user->avatar) }}" class="user-profile-pic" alt="user image">
        </div>
        <div>
            <div class="user-info d-flex">
                <h5 class="pe-3">{{ $user->username }}</h5>
                @if (Auth::check() && $user->id !== Auth::user()->id)
                    @if (Auth::user()->follow($user))
                        <form action="{{ route('users.unfollow', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn user-profile-btn me-3">Following
                                <i class="fa-solid fa-arrow-down" style="color: #000714;"></i>
                            </button>
                        </form>
                    @elseif (!Auth::user()->follow($user) && Auth::user()->blockUser($user))
                        <form action="{{ route('users.unblock', $user->id) }}" method="POST">
                            @csrf
                            <button class="btn user-profile-btn me-3">Unblock</button>
                        </form>
                    @elseif (Auth::user()->followedBy($user))
                        <form action="{{ route('users.follow', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn user-follow-btn me-3">Follow Back</button>
                        </form>
                    @else
                        <form action="{{ route('users.follow', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn user-follow-btn me-3">Follow</button>
                        </form>
                    @endif
                @endif
                <button type="button" class="btn user-profile-btn me-3">Message</button>
                <a type="button" class="me-5 border-0 bg-white text-black" data-bs-toggle="modal"
                    data-bs-target="#exampleModalMore" href="#">
                    <svg aria-label="Options" fill="currentColor" height="32" role="img" viewBox="0 0 24 24"
                        width="32">
                        <title>Options</title>
                        <circle cx="12" cy="12" r="1.5"></circle>
                        <circle cx="6" cy="12" r="1.5"></circle>
                        <circle cx="18" cy="12" r="1.5"></circle>
                    </svg>
                </a>
            </div>

            <div class="followers-info d-flex mt-4">
                <p class="me-5 mb-0"><span class="">{{ $user->posts->count() }}</span> posts</p>
                <button type="button" class="me-5 border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#exampleModalFollowers">
                    <span>{{ $user->followers()->count() }}</span> Followers
                </button>
                <button type="button" class="me-5 border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#exampleModalFollowing">
                    <span>{{ $user->followings()->count() }}</span> Followings
                </button>
            </div>

            <div>
                <h4>{{ $user->fullname }}</h4>
                <p>{{ $user->bio }}</p>
                <!-- mutual followers -->
                <p class="followedby">Followed by
                    @foreach ($user->followers as $key => $follower)
                        <a class="text-decoration-none text-dark fw-bold" href="{{ route('user', $follower->id) }}">
                            {{ $follower->username }}</a>
                        @if ($key < $user->followers->count() - 1)
                            ,
                        @endif
                    @endforeach
                </p>
            </div>
        </div>
    </div>
    <!-- Followers Modal -->
    <div class="modal fade" id="exampleModalFollowers" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header-followers p-2">
                    <h1 class="modal-title fs-6 fw-bold mx-auto my-auto" id="exampleModalLabel">Followers</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body followersList">
                    <input type="text" placeholder="Search" name="follower" class="followerSearch">
                </div>
                <div class="modal-footer">
                    @foreach ($user->followers as $follower)
                        @if ($follower->username !== Auth::user()->username)
                            <div class="row follower-item align-items-center w-100">
                                <div class="col-auto">
                                    <a href="{{ route('user', $follower->id) }}">
                                        <img src="{{ $follower->avatar }}" alt=""
                                            class="follower-image ms-1 bg-black">
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="text-decoration-none text-dark" href="{{ route('user', $follower->id) }}">
                                        <p class="d-inline fw-bold">{{ $follower->username }}</p>
                                    </a>
                                    <p class="text-muted mb-0">{{ $follower->fullname }}</p>
                                </div>
                                <div class="col-auto ms-auto">
                                    @if (Auth::user()->follow($follower))
                                        <form action="{{ route('users.unfollow', $follower->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn user-profile-btn me-3">Remove</button>
                                        </form>
                                    @else
                                        <form action="{{ route('users.follow', $follower->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn user-follow-btn me-3">Follow Back</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Block Modal -->
    <div class="modal fade" id="exampleModalMore" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-flex flex-column py-1 px-0 ">
                    @if (Auth::check() && $user->id !== Auth::user()->id){{-- Check if the user is not viewing their own profile --}}
                        @if (Auth::user()->blockUser($user))
                            <form action="{{ route('users.unblock', $user->id) }}" method="POST">
                                @csrf
                                <button class="blockBtn w-100 fw-bold ">unblock</button>
                            </form>
                        @else
                            <form action="{{ route('users.block', $user->id) }}" method="POST">
                                @csrf
                                <button class="blockBtn w-100 fw-bold ">Block</button>
                            </form>
                        @endif
                    @endif
                    <button class="CancelBtn btn w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Following Modal -->
    <div class="modal fade" id="exampleModalFollowing" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header-followers p-2">
                    <h1 class="modal-title fs-6 fw-bold mx-auto my-auto" id="exampleModalLabel">Following</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body followersList ">
                    <input type="text" placeholder="Search" name="follower" class="followerSearch">
                </div>
                <div class="modal-footer">
                    @foreach ($user->followings as $followingUser)
                        @if ($followingUser->username !== Auth::user()->username)
                            <div class="row follower-item align-items-center w-100">
                                <div class="col-auto">
                                    <a href="{{ route('user', $followingUser->id) }}">
                                        <img src="{{ $followingUser->avatar }}" alt=""
                                            class="follower-image ms-1 bg-black">
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="text-decoration-none text-dark"
                                        href="{{ route('user', $followingUser->id) }}">
                                        <p class="d-inline fw-bold">{{ $followingUser->username }}</p>
                                    </a>
                                    <p class="text-muted mb-0">{{ $followingUser->fullname }}</p>
                                </div>
                                <div class="col-auto ms-auto">
                                    @if (Auth::user()->followings($followingUser))
                                        <form action="{{ route('users.unfollow', $followingUser->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn user-profile-btn me-3">Following
                                                <i class="fa-solid fa-arrow-down" style="color: #000714;"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('users.follow', $followingUser->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn user-follow-btn me-3">Follow</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>




<hr class="w-75 mx-auto my-5">

<div class="container">
    <div class="row justify-content-center mb-1">
        @php $postCounter = 0; @endphp
        @foreach($user->posts as $post)
        @if($post->media->count() > 0)
            @if($postCounter % 3 == 0 && $postCounter != 0)
                </div><div class="row justify-content-center mb-1">
            @endif
            <div class="col-md-4 pro-img-col">
                <a href="{{route('postDesc.show',$post->id)}}" >
                    <div class="img-wrapper">
                        @if(Str::endsWith($post->media->first()->media_url, ['.mp4', '.mov']))
                        <div class="video-icon-overlay"><i class="fas fa-video"></i></div>
                        <video class="w-100 post-video" preload="auto" loop muted playsinline>
                            <source src="{{ asset("storage/images/" . $post->media->first()->media_url) }}" type="video/mp4">
                        </video>
                        @else
                        <img class="w-100 post-image" src="{{ asset("storage/images/" . $post->media->first()->media_url) }}" alt="media">
                        @if($post->media->count() > 1)
                            <span class="multi-image-icon"><i class="fas fa-clone"></i></span>
                        @endif
                        @endif
                    </div>
                </a>
            </div>
            @php $postCounter++; @endphp
        @endif
        @endforeach


    </div>



</div>

@endsection
