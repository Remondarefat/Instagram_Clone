@extends('layouts.main')
@section('content')
<div class="flex-row ">
    <div class="col-md-8 offset-2 mt-md-5">
        @foreach ( $posts as $post )
        @if ($post->media->count()>1)
        <div class="d-flex align-items-center mt-md-5">
            @if ($post->user->avatar==null)
                <img class="rounded-circle im-com me-md-2" src="{{'default.jpg'}}" alt="">
            @else
                <img class="rounded-circle im-com me-md-2" src="{{$post->user->avatar}}" alt="">
            @endif
            <h4>{{$post->user->username}}</h4>
        </div>
            <div id="carouselExample" class="carousel slide text-center cur">
                <div class="carousel-inner">
                    @foreach ($post->media as $media )
                    <div class="carousel-item active">
                    <a href="{{route('postDesc.show',$post->id)}}"><img class="w-100 h-100 me-md-2" src="{{ asset("/images/$media->media_url") }}"  alt=""></a>
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

                            @foreach ($like as $li )
                                @if (Auth::user()->id == $li->user_id && $li->post_id == $post->id)
                                col-red
                                @endif
                            @endforeach "></i>
                            <i class="fa-solid fa-comment ms-md-2 h4 "></i>
                        </div>
                        <!-- ---------------------------------------SAved Posts -->
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
                            <!-- --------------------------------------------------------------------------- -->
                    </div>



                    <div class="d-flex align-items-center flex-column">
                        @php
                            $counter = 0; // Initialize the counter
                        @endphp
                        @foreach ($post->comment as $comment )
                        @php
                            $counter++; // Increment the counter
                        @endphp
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div class="d-flex align-items-center mt-md-2">
                                    @if ($post->user->avatar==null)
                                    <img class="rounded-circle im-com me-md-2" src="{{'default.jpg'}}" alt="">
                                    @else
                                    <img class="rounded-circle im-com me-md-2" src="{{'rrr.jpg'}}" alt="">
                                    @endif
                                    <h6 class="bold mt-md-1">{{$comment->user->username}}</h6>
                                    <p class=" p-0 m-0  ms-md-2">{{$comment->comment_body}}</p>
                                    <p class=" p-0 m-0  ms-md-2 com-id d-none">{{$comment->id}}</p>
                                </div>
                                <i class="mt-2 com-like fa-solid h4
                                @foreach ($commentlike as $li )
                                    @if (Auth::user()->id == $li->user_id && $li->post_id == $post->id && $li->comment_id == $comment->id)
                                        col-red
                                    @endif
                            @endforeach fa-heart"></i>

                            </div>
                            @if ($counter == 3)
                                @break
                            @endif
                        @endforeach
                    </div>
                    <h6 class="  bold mt-md-1 d-none postid ">{{$post->id}}</h6>
                    <div class="comment d-flex border border-top-0 border-end-0 border-start-0 align-items-center">
                        <input type="text" oninput="postButton(this)" placeholder="Add a comments..." class="w-100 p-2 border-0 mb-md-2 com-input">
                        <h5 href="" class="text-decoration-none post-comment d-none text-info ">Post</>
                    </div>
                </div>




            @else







                <div class="mt-md-5">
                    <div class="d-flex align-items-center">
                        @if ($post->user->avatar==null)
                            <img class="rounded-circle im-com me-md-2" src="{{'default.jpg'}}" alt="">
                        @else
                            <img class="rounded-circle im-com me-md-2" src="{{$post->user->avatar}}" alt="">
                        @endif
                        <h4>{{$post->user->username}}</h4>
                    </div>

                    @foreach ($post->media as $media )
                    <a href="{{route('postDesc.show',$post->id)}}"><img class="w-100 h-100 me-md-2 mt-md-2" src="{{asset("/images/$media->media_url")}}" alt=""></a>
                     @endforeach

                    <div class="d-flex mt-md-2 justify-content-between">
                        <div>
                            <i class="fa-solid h4 fa-heart  like

                            @foreach ($like as $li )
                                @if (Auth::user()->id == $li->user_id && $li->post_id == $post->id)
                                col-red
                                @endif
                            @endforeach "></i>
                            <i class="fa-solid fa-comment ms-md-2 h4 "></i>
                        </div>
                        <!-- ---------------------------------------SAved Posts -->
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
                            <!-- --------------------------------------------------------------------------- -->
                    </div>
                    <div class="d-flex align-items-center flex-column">
                        @php
                            $counter = 0; // Initialize the counter
                        @endphp
                        @foreach ($post->comment as $comment )
                        @php
                            $counter++; // Increment the counter
                        @endphp
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div class="d-flex align-items-center mt-md-2">
                                    @if ($post->user->avatar==null)
                                    <img class="rounded-circle im-com me-md-2" src="{{'default.jpg'}}" alt="">
                                    @else
                                    <img class="rounded-circle im-com me-md-2" src="{{'rrr.jpg'}}" alt="">
                                    @endif
                                    <h6 class="bold mt-md-1">{{$comment->user->username}}</h6>
                                    <p class=" p-0 m-0  ms-md-2">{{$comment->comment_body}}</p>
                                    <p class=" p-0 m-0  ms-md-2 com-id d-none">{{$comment->id}}</p>
                                </div>
                                <i class="mt-2 com-like fa-solid h4
                                @foreach ($commentlike as $li )
                                    @if (Auth::user()->id == $li->user_id && $li->post_id == $post->id && $li->comment_id == $comment->id)
                                        col-red
                                    @endif
                            @endforeach fa-heart"></i>

                            </div>
                            @if ($counter == 3)
                                @break
                            @endif
                        @endforeach
                    </div>
                    <h6 class="  bold mt-md-1 d-none postid ">{{$post->id}}</h6>
                    <div class="comment d-flex border border-top-0 border-end-0 border-start-0 align-items-center">
                        <input type="text" oninput="postButton(this)" placeholder="Add a comments..." class="w-100 p-2 border-0 mb-md-2 com-input">
                        <h5 href="" class="text-decoration-none post-comment d-none text-info ">Post</>
                    </div>
                </div>

            @endif

        @endforeach
    </div>

</div>
<script>

    function postButton(inputElement){

        let come=inputElement.value;
        if(come == ''){
            $(inputElement).parent().find('.post-comment').addClass('d-none');
        }
        else{
            $(inputElement).parent().find('.post-comment').removeClass('d-none');
        }
   }
    $(document).ready(function() {
       $('.like').click(function() {
        $(this).toggleClass('col-red');
        let postid=$(this).parent().parent().parent().find('.postid').text();
        console.log(postid);
           $.ajax({
        //    url:''
           url: '{{ route('like.post') }}', // Use the route() helper to generate the URL
           method: 'GET',
           dataType: 'json',
           data:{'id':postid},
           success: function(response){
           },
           error: function(error) {
               console.error('Error calling PHP method:', error);
           }
       });
       });


       $('.post-comment').click(function(){
        let postBtn=this;
        let commentInput=$(this).parent().find('.com-input');
        let postid=$(this).parent().parent().find('.postid').text();
        console.log(postid);
        let postcomment=commentInput.val();
        console.log(postcomment);
        $.ajax({
           url: '{{ route('comment.post') }}', // Use the route() helper to generate the URL
           method: 'GET',
           dataType: 'json',
           data:{'id':postid,'postcomment':postcomment},
           success: function(response){
            $(postBtn).addClass('d-none');
            $(commentInput).val('');
           },
           error: function(error) {
               console.error('Error calling PHP method:', error);
           }
       });
       });


       $('.com-like').click(function(){
        $(this).toggleClass('col-red');
        let commentId=$(this).parent().find('.com-id').text();
        let postid=$(this).parent().parent().parent().find('.postid').text();
        $.ajax({
            url:'{{route('comment.like')}}',
            method:'GET',
            dataType:'json',
            data:{
                'postid':postid,
                'commentId':commentId
            },
            success:function(response){
                console.log(response.message);
            },
            error:function(error){
                console.error('Error calling PHP method:', error);
            }
        });
       });
   });

</script>
@endsection