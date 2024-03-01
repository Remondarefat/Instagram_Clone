@extends('layouts.main')
@section('content')
            <div class="row mt-4 border   ">
                <div class="col-md-7  p-0 postDesc ">
                    <div id="carouselExample" class="carousel slide text-center cur">
                        <div class="carousel-inner">
                            @foreach ($post->media as $media )
                            <div class="carousel-item active">
                            @if (strpos($media->media_url, 'mp4') !== false)
                            <video src="{{asset("storage/images/$media->media_url")}}" class="w-100 h-100 me-md-2 " controls></video>
                            @else
                            <img class="w-100 h-100 me-md-2" src="{{asset("storage/images/$media->media_url")}}" alt="">
                            @endif
                            </div>
                            @endforeach
                        </div>
                        @if($post->media->count() >1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bg-black" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                            <span class="carousel-control-next-icon bg-black " aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        @endif
                    </div>
                </div>
                <div class="col-md-5 pt-4 pb-3 postDesc">
                    <div class="d-flex justify-content-between align-content-center" >
                        <div>
                        @if ($post->user->avatar==null)
                            <img class="rounded-circle im-com me-md-2" src="{{asset('default.jpg')}}" alt="">
                        @else
                            <img class="rounded-circle im-com me-md-2" src="{{asset(str_replace('public/','storage/',$post->user->avatar))}}" alt="">
                        @endif
                            <span class="fw-bolder ">{{$post->user->username}}</span>
                            <!-- <span></sapn> -->
                            <!-- <a href="#" class="fw-bold followBtn ms-2 ">. Following</a> -->
                        </div>
                        <div>
                            <img src="{{asset('More.svg')}}" class="icon">
                        </div>
                    </div>
                    <hr>
                    <!-- -------------------><!-- Existing post content -->
                    <!-- ------------------ -->
                    <div class="comments_sec pe-3 ">
                        <!-- Display Comments -->
                        <div class="comments_container mt-1 d-flex align-content-center">

                            <img src="{{asset(str_replace('public/','storage/',$post->user->avatar))}}" class="post-img rounded-circle me-md-2">
                                <div class=" w-100 ">
                                    <span class="fw-bolder">{{$post->user->username}}</span>
                                    <span class="text-muted ps-1">{{ $post->created_at->diffForHumans() }}</span>
                                    <div class="ps-2">
                                        <div class="d-flex  ">
                                            <p class=" p-0 m-0 pe-3 ">{{$post->caption}}</p>
                                            @foreach ($post->hashtags as $hashtag )
                                                @php
                                                    $cleanedHashtag = str_replace('#', '', $hashtag->hashtag_name);
                                                @endphp
                                                <a href="{{ url("/hashtag/$cleanedHashtag") }}" class=" p-0 m-0   hash">{{$hashtag->hashtag_name}}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                        </div>
                        @if(!$comments->isEmpty())
                    @foreach($comments as $comment)
                        <div class="comments_container mt-1 d-flex align-content-center">
                            <img src="{{asset(str_replace('public/','storage/', $comment->user->avatar ))}}" class="post-img rounded-circle">
                            <div class="ps-2 w-100">
                                <span class="fw-bolder">{{ $comment->user->username }}</span> <!-- Change to $comment->user->name -->
                                <span class="text-muted ps-1">{{ $comment->created_at->diffForHumans() }}</span>
                                <div>
                                    <div class="d-flex justify-content-between">
                                        <p>{{ $comment->comment_body }}</p>
                                        <form action="{{ route('toggleCommentLike', $comment->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="border-0 bg-transparent">
                                                @php
                                                    $liked = false;
                                                    foreach($existingLikeComments as $existingLikeComment) {
                                                        if ($existingLikeComment && $existingLikeComment->comment_id == $comment->id) {
                                                            $liked = true;
                                                            break;
                                                        }
                                                    }
                                                @endphp
                                                @if($liked)
                                                    <i class="fa-solid fs-4 fa-heart" style="color: #ff0000;"></i>
                                                @else
                                                    <i class="fa-regular fs-4 fa-heart"></i>
                                                @endif
                                            </button>
                                        </form>
                                    </div>
                                    <span class="ps-6  text-muted">Reply</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                    </div>
                    <hr>
                    <div class="likes_Sec">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                    <form  action="{{ route('post.toggle-like', $post->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="border-0 bg-transparent">
                                                @if($existingLike)
                                                    <i class="fa-solid fs-4 fa-heart" style="color: #ff0000;"></i>
                                                @else
                                                    <i class="fa-regular fs-4 fa-heart"></i>

                                                @endif
                                                </button>
                                    </form>
                                    <label for="commentInput"><img src="{{ asset('Messenger.svg') }}" class="icon ms-4 "></label>
                            </div>
                            <!------------------------------- SavedPosts  Button ------------------>
                            @auth

    @if ($post->isSavedByUser(auth()->user()->id))
        <form action="{{ route('saved-posts.destroy', ['id' => $post->id]) }}" method="post" id="unsaveForm{{ $post->id }}">
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            @csrf
            @method('DELETE')

            <button type="submit" class="border-0 p-0" style="background:none;">
                <span class="save-btn">
                    <svg aria-label="Unsave" class="x1lliihq x1n2onr6 x5n08af" fill="currentColor" height="24" role="img" viewBox="0 0 24 24" width="24">
                        <title>Unsave</title>
                        <polygon fill="#000" points="20 21 12 13.44 4 21 4 3 20 3 20 21" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></polygon>
                    </svg>
                </span>
            </button>
        </form>
    @else
        <form action="{{ route('saved.posts.store', ['id' => $post->id]) }}" method="post" id="saveForm{{ $post->id }}">
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            @csrf
            <button type="submit" class="border-0 p-0" style="background:none;">
                <span class="save-btn">
                    <svg aria-label="Save" class="x1lliihq x1n2onr6 x5n08af" fill="currentColor" height="24" role="img" viewBox="0 0 24 24" width="24">
                        <title>Save</title>
                        <polygon fill="none" points="20 21 12 13.44 4 21 4 3 20 3 20 21" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></polygon>
                    </svg>
                </span>
            </button>
        </form>
    @endif
@endauth
                            <!-- ----------------------------------------------------------------------------------------------- -->
                        </div>
                    </div>
                    <div class="mt-2 d-flex align-content-center ">
                    @if($likes->isNotEmpty())
                        <!-- Display the avatar of the last user who liked the post -->
                        <img src="{{asset(str_replace('public/','storage/', $likes->last()->user->avatar ))}}" class="likes-img rounded-circle" alt="Avatar">

                        <!-- Display the total number of likes -->
                        <span class="fw-bold ps-1">{{ $likes->count() }} likes</span>

                        <!-- Display the timestamp of the last like -->
                        <span class="text-muted ps-1">{{ $likes->last()->created_at->diffForHumans() }}</span>
                    @else
                        <span class="text-muted">No likes yet</span>
                    @endif
                    </div>
                    <div class=" mt-2 d-flex  ">
                            <img src="{{ asset('userIcon.webp') }}" class=" rounded-circle" style="width:40px;">
                                <div class="ps-3 w-100 ">
                                        <!----------- Comment Form ----------->
                                    @if(auth()->check())
                                    <form id="commentForm" action="{{ route('comments.store') }}" method="POST">
                                        @csrf
                                        <div class="d-flex justify-content-between">
                                            <input id="commentInput" name="comment_body" class="borderless-input  w-75 p-1 "  placeholder="Add a comment...">
                                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                <span id="postButton" style="display: none; cursor: pointer ;">Post</span>
                                                <i class="fa-regular fa-face-smile-beam fs-4"></i>
                                        </div>
                                    </form>
                                    @else
                                        <p>You must be logged in to comment.</p>
                                    @endif
                                </div>
                    </div>
                </div>
            </div>
            <!-- Existing code to display the current post -->
            <!-- Add a section for more posts by the same user -->
            @if ($morePosts->isNotEmpty())
    <div class="mt-3">
        <span>More posts from <span class="fw-bold">{{ $post->user->username }}</span></span>
    </div>
    <div class="row mt-2 g-1">
        @foreach ($morePosts as $morePost)
            <div class="col-md-4">
                @if ($morePost->media->isNotEmpty())
                    <div class="Savedpost">
                        <a href="{{ route('postDesc.show', $morePost->id) }}">
                            <div class="img-wrapper">
                                @php $media = $morePost->media->first(); @endphp
                                @if(Str::endsWith($media->media_url, ['.mp4', '.mov']))
                                    <video class="w-100 post-video" preload="auto" loop muted playsinline>
                                        <source src="{{ asset("storage/images/" . $media->media_url) }}" type="video/mp4">
                                    </video>
                                @else
                                <img class="w-100 post-image" src="{{ asset("storage/images/" . $media->media_url) }}" alt="media">

                                @endif
                            </div>
                        </a>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
@endif



@endsection
