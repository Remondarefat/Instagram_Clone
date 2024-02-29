@extends('layouts.main')

@section('content')
<div class="d-flex align-items-center w-25">
    @foreach($posts[0]->media as $media)
    <img src="/storage/images/{{ $media->media_url}}" class="w-100 rounded-circle me-md-5 mb-md-4">
    @endforeach
    <div>
        <h3>{{ $hashtag_name }}</h3>
        <h3>{{ $posts->count() }}</h3>
        <h5>posts</h5>
    </div>
</div>
    <div class="container">
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4 mt-md-2 shadow">
                    @if($post->media->count() > 1)
                    <div id="carouselExample" class="carousel slide">
                        <div class="carousel-inner">
                            @foreach($post->media as $media)
                            <div class="carousel-item active">
                            <img src="/storage/images/{{ $media->media_url}}" class="d-block w-100" alt="...">
                            </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        </div>
                    @else


                    @foreach($post->media as $media)
                    @if (strpos($media->media_url, 'mp4') !== false)

                    <video src="{{asset("storage/images/$media->media_url")}}" class="ved" controls></video>
                    @else
                    <img class="w-100" src="{{asset("storage/images/$media->media_url")}}" alt="">
                    @endif
                    @endforeach
                    @endif

                </div>
            @endforeach
        </div>
    </div>

@endsection