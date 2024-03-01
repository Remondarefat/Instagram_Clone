@extends('layouts.main')
@section('content')
    @if ($savedPosts->isNotEmpty())
        <div class="mt-5">
            <span class="fw-bold mb-3">All Posts </span>
        </div>
        <div class="row mt-2 g-1">
            @foreach($savedPosts as $savedPost)
                <div class="col-md-4">
                    @if ($savedPost->post->media->isNotEmpty())
                        <div class="Savedpost">
                            <a href="{{ route('postDesc.show', $savedPost->post->id) }}">
                                <div class="img-wrapper">
                                    @php $media = $savedPost->post->media->first(); @endphp
                                    @if(Str::endsWith($media->media_url, ['.mp4', '.mov']))
                                        <div class="video-icon-overlay"><i class="fas fa-video"></i></div>
                                        <video class="w-100 post-video" preload="auto" loop muted playsinline>
                                            <source src="{{ asset("storage/images/" . $media->media_url) }}" type="video/mp4">
                                        </video>
                                    @else
                                    <img class="w-100 post-image" src="{{ asset("storage/images/" . $media->media_url) }}" alt="media">
                                        @if($savedPost->post->media->count() > 1)
                                            <span class="multi-image-icon"><i class="fas fa-clone"></i></span>
                                        @endif
                                    @endif
                                    <div class="layer d-flex justify-content-center align-items-center">
                                        <div class="icons fs-3">
                                            <i class="fa-solid fa-heart text-white"></i>
                                            <span class="text-white fw-bold fs-3 pe-3">{{ $likesCounts[$savedPost->post->id] ?? 0 }}</span>
                                            <i class="fa-solid fa-comment text-white"></i>
                                            <span class="text-white fw-bold fs-3">{{ $commentsCounts[$savedPost->post->id] ?? 0 }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                </div>
            @endforeach
            </div>
    @else
        <div>No Saved Posts Found.</div>
    @endif
@endsection
