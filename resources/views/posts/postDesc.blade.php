@extends('layouts.main') 
@section('content')
            <div class="row mt-4 border  ">
                <div class="col-md-7  p-0 postDesc ">
                    <div id="carouselExample" class="carousel slide text-center cur">
                        <div class="carousel-inner">
                            @foreach ($post->media as $media )
                            <div class="carousel-item active">
                                <img class="w-100 h-100 me-md-2" src="{{ asset("/images/$media->media_url") }}"  alt="">
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
                            <img src="{{$user->avtar}}" class="post-img rounded-circle">
                            <span class="fw-bolder ps-1">{{$user->username}}</span>
                            <span></sapn>
                            <a href="#" class="fw-bold followBtn ms-2 ">. Following</a>
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
                        @if(!$comments->isEmpty())
                        @foreach($comments as $comment)
                            <div class="comments_container mt-1 d-flex align-content-center">
                                <img src="{{ $comment->user->avatar }}" class="post-img rounded-circle">
                                <div class="ps-2 w-100">
                                    <span class="fw-bolder">{{ $user->username }}</span>
                                    <span class="text-muted ps-1">{{ $comment->created_at->diffForHumans() }}</span>
                                    <div>
                                        <div class="d-flex justify-content-between">
                                            <p>{{ $comment->comment_body }}</p>
                                            <form action="{{ route('toggleCommentLike', $comment->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="border-0 bg-transparent">
                                                        @if($existingLikeComment && $existingLikeComment->comment_id == $comment->id)
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
                    <div class="likes_Sec "> 
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
                            <img src="{{ asset('Bookmark.svg') }}" class="icon">
                        </div>
                    </div>
                    <div class="mt-2 d-flex align-content-center ">
                            <img src="{{$user->avatar}}" class="likes-img rounded-circle">
                            <span  class=" fw-bold ps-1">60 likes</span>
                    </div>
                    <p>1 day ago</p>
                    <div class=" mt-1 d-flex  ">
                            <img src="{{ asset('userIcon.webp') }}" class=" rounded-circle" style="width:40px;">
                                <div class="ps-3 w-100">
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
                    <span>More posts from <span class="fw-bold">{{ $user->username }}</span></span>
                </div>
                <div class="row mt-2 g-1">
                    @foreach ($morePosts as $morePost)
                        <div class="col-md-4">
                            @foreach ($morePost->media as $media)
                                <img src="{{ asset("/images/$media->media_url")}}" alt="Media" class="w-100">
                            @endforeach
                            <!-- Add any additional content you want to display -->
                        </div>
                    @endforeach
                </div>
            @endif


        
@endsection 
