@extends('layouts.main')
@section('content')
<div class="flex-row ">
    <div class="col-md-8 offset-2 mt-md-5">
        @foreach ($posts as $post)
            @if ($post->media->count() > 1)
                <div class="d-flex align-items-center mt-md-5">
                    @if ($post->user->avatar == null)
                        <img class="rounded-circle im-com me-md-2" src="{{ asset('default.jpg') }}" alt="">
                    @else
                        <img class="rounded-circle im-com me-md-2" src="{{ $post->user->avatar }}" alt="">
                    @endif
                    <h4>{{ $post->user->username }}</h4>
                </div>
                <div id="carouselExample" class="carousel slide text-center cur">
                    <div class="carousel-inner">
                        @foreach ($post->media as $media)
                            <div class="carousel-item">
                                <img class="w-100 h-100 me-md-2" src="{{ asset("images/$media->media_url") }}" alt="">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon bg-black" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon bg-black " aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div>
                    <div class="d-flex mt-md-2 justify-content-between">
                        <div>
                            <i class="fa-solid h4 fa-heart  like
                                @foreach ($like as $li)
                                    @if (Auth::user()->id == $li->user_id && $li->post_id == $post->id)
                                        col-red
                                    @endif
                                @endforeach
                            "></i>
                            <i class="fa-solid fa-comment ms-md-2 h4 "></i>
                        </div>
                        <i class="fa-solid fa-bookmark h4"></i>
                    </div>
                    <div class="d-flex align-items-center flex-column">
                        @php
                            $counter = 0;
                        @endphp
                        @foreach ($post->comment as $comment)
                            @php
                                $counter++;
                            @endphp
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div class="d-flex align-items-center mt-md-2">
                                    @if ($post->user->avatar == null)
                                        <img class="rounded-circle im-com me-md-2" src="{{ asset('default.jpg') }}" alt="">
                                    @else
                                        <img class="rounded-circle im-com me-md-2" src="{{ asset('rrr.jpg') }}" alt="">
                                    @endif
                                    <h6 class="bold mt-md-1">{{ $comment->user->username }}</h6>
                                    <p class="p-0 m-0 ms-md-2">{{ $comment->comment_body }}</p>
                                    <p class="p-0 m-0 ms-md-2 com-id d-none">{{ $comment->id }}</p>
                                </div>
                                <i class="mt-2 com-like fa-solid h4
                                    @foreach ($commentlike as $li)
                                        @if (Auth::user()->id == $li->user_id && $li->post_id == $post->id && $li->comment_id == $comment->id)
                                            col-red
                                        @endif
                                    @endforeach
                                fa-heart"></i>
                            </div>
                            @if ($counter == 3)
                                @break
                            @endif
                        @endforeach
                    </div>
                    <h6 class="bold mt-md-1 d-none postid">{{ $post->id }}</h6>
                    <div class="comment d-flex border border-top-0 border-end-0 border-start-0 align-items-center">
                        <input type="text" oninput="postButton(this)" placeholder="Add a comment..." class="w-100 p-2 border-0 mb-md-2 com-input">
                        <h5 href="" class="text-decoration-none post-comment d-none text-info">Post</h5>
                    </div>
                </div>
            @else
                <div class="mt-md-5">
                    <div class="d-flex align-items-center">
                        @if ($post->user->avatar == null)
                            <img class="rounded-circle im-com me-md-2" src="{{ asset('default.jpg') }}" alt="">
                        @else
                            <img class="rounded-circle im-com me-md-2" src="{{ $post->user->avatar }}" alt="">
                        @endif
                        <h4>{{ $post->user->username }}</h4>
                    </div>
                    @foreach ($post->media as $media)
                        <img class="w-100 h-100 me-md-2 mt-md-2" src="{{ asset("images/$media->media_url") }}" alt="">
                    @endforeach
                    <div class="d-flex mt-md-2 justify-content-between">
                        <div>
                            <i class="fa-solid h4 fa-heart like
                                @foreach ($like as $li)
                                    @if (Auth::user()->id == $li->user_id && $li->post_id == $post->id)
                                        col-red
                                    @endif
                                @endforeach
                            "></i>
                            <i class="fa-solid fa-comment ms-md-2 h4"></i>
                        </div>
                        <i class="fa-solid fa-bookmark h4"></i>
                    </div>
                    <div class="d-flex align-items-center flex-column">
                        @php
                            $counter = 0;
                        @endphp
                        @foreach ($post->comment as $comment)
                            @php
                                $counter++;
                            @endphp
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div class="d-flex align-items-center mt-md-2">
                                    @if ($post->user->avatar == null)
                                        <img class="rounded-circle im-com me-md-2" src="{{ asset('default.jpg') }}" alt="">
                                    @else
                                        <img class="rounded-circle im-com me-md-2" src="{{ asset('rrr.jpg') }}" alt="">
                                    @endif
                                    <h6 class="bold mt-md-1">{{ $comment->user->username }}</h6>
                                    <p class="p-0 m-0 ms-md-2">{{ $comment->comment_body }}</p>
                                    <p class="p-0 m-0 ms-md-2 com-id d-none">{{ $comment->id }}</p>
                                </div>
                                <i class="mt-2 com-like fa-solid h4
                                    @foreach ($commentlike as $li)
                                        @if (Auth::user()->id == $li->user_id && $li->post_id == $post->id && $li->comment_id == $comment->id)
                                            col-red
                                        @endif
                                    @endforeach
                                fa-heart"></i>
                            </div>
                            @if ($counter == 3)
                                @break
                            @endif
                        @endforeach
                        @if ($post->hashtags()->count() > 0)
                            <div>
                                
                            </div>
                        @endif
                    </div>
                    <h6 class="bold mt-md-1 d-none postid">{{ $post->id }}</h6>
                    <div class="comment d-flex border border-top-0 border-end-0 border-start-0 align-items-center">
                        <input type="text" oninput="postButton(this)" placeholder="Add a comment..." class="w-100 p-2 border-0 mb-md-2 com-input">
                        <h5 href="" class="text-decoration-none post-comment d-none text-info">Post</h5>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
<script>
    function postButton(inputElement) {
        let come = inputElement.value;
        if (come == '') {
            $(inputElement).parent().find('.post-comment').addClass('d-none');
        } else {
            $(inputElement).parent().find('.post-comment').removeClass('d-none');
        }
    }
    $(document).ready(function() {
        // JavaScript AJAX functions
    });
</script>
@endsection
