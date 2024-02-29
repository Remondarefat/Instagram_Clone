@extends('layouts.app')

@section('content')
    <h1>Posts with Hashtag: {{ $hashtag }}</h1>

    <!-- @if (!is_null($posts)) -->
    @foreach($posts as $post)
        <div class="post">
            <h2>{{ $post->caption }}</h2>
            <!-- Display post content here -->
        </div>
    @endforeach
@endsection