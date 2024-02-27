@extends('layouts.main')
@section('content')
    <div class="flex-row d-flex mt-5">
        <div class="col-md-3  me-4 text-center offset-1 ">
            @if ($user->avatar==null)
            <img class="rounded-circle im-com me-md-2" src="{{'default.jpg'}}" alt="">
        @else
        <img class="rounded-circle im-pro me-md-2" src="{{ Storage::url($user->avatar) }}" alt="">
        @endif
            </div>
        <div class="col-md-6 d-flex flex-column align-items-start">
            <div class="d-flex">
                <h4>{{ $user->username }}</h4>
                <a href="/profile" class="btn bt-insta  ms-3">Edit Profile</a>
                <a href="" class="btn bt-insta ms-3">Saved Post</a>
            </div>
            <div class="mt-4">
                <a href="" class=" ms-3 text-decoration-none text-dark">{{ $user->posts->count() }} posts</a>
                {{-- <a href="" class=" ms-3 text-decoration-none text-dark"> <span>{{ $user->followers()->count() }}</span>followers</a> --}}
                {{-- <a href="" class=" ms-3 text-decoration-none text-dark"> {{ $user->followings()->count() }}following</a> --}}
            </div>
            <div class="mt-4">
                <a href="" class=" ms-3 text-decoration-none text-dark">{{ $user->gender }}</a>
                <a href="" class=" ms-3  web text-dark">{{ $user->website }}</a>
            </div>
            <div class="mt-4 ">
                <p>{{ $user->bio }}</p>
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
                        </div>
                        <div class="row justify-content-center mb-1">
                    @endif
                    <div class="col-md-4 pro-img-col">
                        <div class="img-wrapper">
                            <img class="w-100 post-image" src="{{ asset("/images/" . $post->media->first()->media_url) }}" alt="media">
                            @if($post->media->count() > 1)
                            <span class="multi-image-icon"><i class="fas fa-clone"></i></span>
                            @endif
                        </div>
                    </div>
                    @php $postCounter++; @endphp
                @endif
            @endforeach
        </div>
    </div>
    
@endsection