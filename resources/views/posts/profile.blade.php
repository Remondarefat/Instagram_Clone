@extends('layouts.main')

@section('content')
<div class="flex-row d-flex mt-5">
    <div class="col-md-3 me-4 text-center offset-1">
        @if ($user->avatar == null)
            <img class="rounded-circle im-com me-md-2" src="{{ 'default.jpg' }}" alt="">
        @else
            <img class="rounded-circle im-pro me-md-2" src="{{ Storage::url($user->avatar) }}" alt="">
        @endif
    </div>
    <div class="col-md-6 d-flex flex-column align-items-start">
        <div class="d-flex">
            <h4>{{ $user->username }}</h4>
            <a href="/profile" class="btn bt-insta ms-3">Edit Profile</a>
            <a href="" class="btn bt-insta ms-3">Saved Posts</a>
        </div>
        <div class="mt-3">
            <a href="" class=" text-decoration-none text-dark">{{ $user->posts->count() }} posts</a>

            <a href="#" class="ms-3 text-decoration-none text-dark" data-bs-toggle="modal" data-bs-target="#followersModal">
                {{ $user->followers()->count() }} followers
            </a>

            <a href="#" class="ms-3 text-decoration-none text-dark" data-bs-toggle="modal" data-bs-target="#followingModal">
                {{ $user->followings()->count() }} following
            </a>
        </div>
        <div class="mt-1">
            <a href="" class=" text-decoration-none text-dark">{{ $user->gender }}</a>
            <a href="" class="ms-3 web text-dark">{{ $user->website }}</a>
        </div>
        <div class="mt-1 ">
            <p>{{ $user->bio }}</p>
        </div>

        <div class="mt-1">
            <h4>{{ $user->fullname }}</h4>
            <p class="followedby ">Followed by
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
<div class="modal fade" id="followersModal" tabindex="-1" aria-labelledby="followersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="followersModalLabel">Followers</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <ul class="list-unstyled">
            @foreach($user->followers as $follower)
              <li><a href="/user/{{ $follower->id }}" class="text-decoration-none">{{ $follower->username }}</a></li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Following Modal -->
  <div class="modal fade" id="followingModal" tabindex="-1" aria-labelledby="followingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="followingModalLabel">Following</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <ul class="list-unstyled">
            @foreach($user->followings as $following)
              <li><a href="/user/{{ $following->id }}" class="text-decoration-none">{{ $following->username }}</a></li>
            @endforeach
          </ul>
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
                <a href="#" >
                    <div class="img-wrapper">
                        @if(Str::endsWith($post->media->first()->media_url, ['.mp4', '.mov']))
                        <div class="video-icon-overlay"><i class="fas fa-video"></i></div>
                        <video class="w-100 post-video" preload="auto" loop muted playsinline>
                            <source src="{{ asset("/images/" . $post->media->first()->media_url) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        @else
                        <img class="w-100 post-image" src="{{ asset("/images/" . $post->media->first()->media_url) }}" alt="media">
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
