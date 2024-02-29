@extends('layouts.main') 
@section('content')
    @if ($savedPosts->isNotEmpty())
                <div class="mt-5">
                    <span class="fw-bold mb-3">All Posts </span>
                </div>
        <div class="row mt-2 g-1">
        @foreach($savedPosts as $savedPost)
    <div class="col-md-4">
        @if ($savedPost->post->media)
            @foreach ($savedPost->post->media as $media)
                <div class="Savedpost">
                    <a href="{{ route('postDesc.show', $savedPost->post->id) }}">
                        <img src="{{ asset("/images/$media->media_url") }}" alt="Media" class="w-100">
                    
                        <div class="layer d-flex justify-content-center align-items-center">
                            <div class="icons fs-3">
                                <i class="fa-solid fa-heart text-white"></i>
                                @if(isset($likesCounts[$savedPost->post->id]) && $likesCounts[$savedPost->post->id] > 0)
                                    <span class="text-white fw-bold fs-3 pe-3">{{ $likesCounts[$savedPost->post->id] }}</span>
                                @else
                                    <span class="text-white fw-bold fs-3 pe-3">0</span>
                                @endif
                                <i class="fa-solid fa-comment text-white"></i>
                                @if(isset($commentsCounts[$savedPost->post->id]) && $commentsCounts[$savedPost->post->id] > 0)
                                    <span class="text-white fw-bold fs-3">{{ $commentsCounts[$savedPost->post->id] }}</span>
                                @else
                                    <span class="text-white fw-bold fs-3">0</span>
                                @endif
                            </div>
                        </div>

                    </a>
                </div>
            @endforeach
        @endif
    </div>
@endforeach

        </div>
        @else
        
    @endif
@endsection
