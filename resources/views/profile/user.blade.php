@extends('layouts.main')
@section('title', $user->username)
@section('content')
    <div class="user-profile-container d-flex">
        <div class="image align-self-center">
            <img src="{{ $user->avatar }}" class="user-profile-pic" alt="user image">
        </div>
        <div>
            <div class="user-info d-flex">
                <h5 class="pe-3">{{ $user->username }}</h5>
                @if (Auth::check() && $user->id !== Auth::user()->id)
                    {{-- Check if the user is not viewing their own profile --}}
                    <form id="followForm" action="{{ route('users.follow', $user->id) }}" method="POST">
                        @csrf
                        <button type="button" onclick="toggleFollow('followForm')"
                            class="btn user-follow-btn me-3">Follow</button>
                    </form>
                @endif
                <button type="button" class="btn user-profile-btn me-3">Message</button>
            </div>

            <div class="followers-info d-flex mt-4 d-flex">
                <p class="me-5"><span class="fw-bold">581</span> posts</p>
                <button type="button" class="me-5 border-0 bg-white" data-bs-toggle="modal"
                    data-bs-target="#exampleModalFollowers"><span>{{ $user->followers()->count() }}</span>
                    followers
                </button>
                <button type="button" class="me-5 border-0 bg-white" data-bs-toggle="modal"
                    data-bs-target="#exampleModalFollowing"><span>{{ $user->followings()->count() }}</span>
                    following</button>
            </div>
            <div>
                <h4>{{ $user->fullname }}</h4>
                <p>{{ $user->bio }}</p>
                <!-- mutual followers -->
                <p class="followedby">Followed by
                    @foreach ($user->followers as $key => $follower)
                        <span class="fw-bold">{{ $follower->username }}</span>
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
                                    <img src="{{ $follower->avatar }}" alt="" class="follower-image ms-1 bg-black">
                                </div>
                                <div class="col">
                                    <p class="d-inline fw-bold">{{ $follower->username }}</p>
                                    <p class="text-muted mb-0">{{ $follower->fullname }}</p>
                                </div>
                                <div class="col-auto ms-auto">
                                    <form id="unfollowForm{{ $follower->id }}"
                                        action="{{ route('users.unfollow', $follower->id) }}" method="POST">
                                        @csrf
                                        <button type="button" onclick="toggleFollow('unfollowForm{{ $follower->id }}')"
                                            class="btn user-profile-btn me-3">Remove</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endforeach
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
                        <div class="row follower-item align-items-center w-100">
                            <div class="col-auto">
                                <img src="{{ $followingUser->avatar }}" alt=""
                                    class="follower-image ms-1 bg-black">
                            </div>
                            <div class="col">
                                <p class="d-inline fw-bold">{{ $followingUser->username }}</p>
                                <p class="text-muted mb-0">{{ $followingUser->fullname }}</p>
                            </div>
                            <div class="col-auto ms-auto">
                                <form id="unfollowForm{{ $followingUser->id }}"
                                    action="{{ route('users.unfollow', $followingUser->id) }}" method="POST">
                                    @csrf
                                    <button type="button" onclick="toggleFollow('unfollowForm{{ $followingUser->id }}')"
                                        class="btn user-profile-btn me-3">Following
                                        <i class="fa-solid fa-arrow-down" style="color: #000714;"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/following.js') }}"></script>
@endsection
