
<!-- Modal for uploading image -->

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered d-flex justify-content-center" role="document">
        <div class="modal-content ">
            <div class="modal-header d-flex align-items-center justify-content-center">
                <a id="back" class="me-5" style="display: none;">
                    <i class="fa-solid fa-arrow-left" style="color: #000000;"></i>
                </a>
                <h5 class="modal-title ps-5 pe-5" id="exampleModalLongTitle">Create new post</h5>
                <div class="d-flex align-items-end">
                    <a id="cropButtonUpload" class="ms-5" style="display: none;" >Next</a>
                </div>
            </div>
            <div class="modal-body modal-height d-flex justify-content-center align-items-center flex-column" id="modalBody">
               <!-- instagram create post icon  -->
   <svg id="icon" aria-label="Icon to represent media such as images or videos" class="x1lliihq x1n2onr6 x5n08af" fill="currentColor" height="77" role="img" viewBox="0 0 97.6 77.3" width="96">
                    <title>Icon to represent media such as images or videos</title>
                    <path
                        d="M16.3 24h.3c2.8-.2 4.9-2.6 4.8-5.4-.2-2.8-2.6-4.9-5.4-4.8s-4.9 2.6-4.8 5.4c.1 2.7 2.4 4.8 5.1 4.8zm-2.4-7.2c.5-.6 1.3-1 2.1-1h.2c1.7 0 3.1 1.4 3.1 3.1 0 1.7-1.4 3.1-3.1 3.1-1.7 0-3.1-1.4-3.1-3.1 0-.8.3-1.5.8-2.1z"
                        fill="currentColor"></path>
                    <path
                        d="M84.7 18.4 58 16.9l-.2-3c-.3-5.7-5.2-10.1-11-9.8L12.9 6c-5.7.3-10.1 5.3-9.8 11L5 51v.8c.7 5.2 5.1 9.1 10.3 9.1h.6l21.7-1.2v.6c-.3 5.7 4 10.7 9.8 11l34 2h.6c5.5 0 10.1-4.3 10.4-9.8l2-34c.4-5.8-4-10.7-9.7-11.1zM7.2 10.8C8.7 9.1 10.8 8.1 13 8l34-1.9c4.6-.3 8.6 3.3 8.9 7.9l.2 2.8-5.3-.3c-5.7-.3-10.7 4-11 9.8l-.6 9.5-9.5 10.7c-.2.3-.6.4-1 .5-.4 0-.7-.1-1-.4l-7.8-7c-1.4-1.3-3.5-1.1-4.8.3L7 49 5.2 17c-.2-2.3.6-4.5 2-6.2zm8.7 48c-4.3.2-8.1-2.8-8.8-7.1l9.4-10.5c.2-.3.6-.4 1-.5.4 0 .7.1 1 .4l7.8 7c.7.6 1.6.9 2.5.9.9 0 1.7-.5 2.3-1.1l7.8-8.8-1.1 18.6-21.9 1.1zm76.5-29.5-2 34c-.3 4.6-4.3 8.2-8.9 7.9l-34-2c-4.6-.3-8.2-4.3-7.9-8.9l2-34c.3-4.4 3.9-7.9 8.4-7.9h.5l34 2c4.7.3 8.2 4.3 7.9 8.9z"
                        fill="currentColor"></path>
                    <path
                        d="M78.2 41.6 61.3 30.5c-2.1-1.4-4.9-.8-6.2 1.3-.4.7-.7 1.4-.7 2.2l-1.2 20.1c-.1 2.5 1.7 4.6 4.2 4.8h.3c.7 0 1.4-.2 2-.5l18-9c2.2-1.1 3.1-3.8 2-6-.4-.7-.9-1.3-1.5-1.8zm-1.4 6-18 9c-.4.2-.8.3-1.3.3-.4 0-.9-.2-1.2-.4-.7-.5-1.2-1.3-1.1-2.2l1.2-20.1c.1-.9.6-1.7 1.4-2.1.8-.4 1.7-.3 2.5.1L77 43.3c1.2.8 1.5 2.3.7 3.4-.2.4-.5.7-.9.9z"
                        fill="currentColor"></path>
                </svg>
                <div class="d-flex justify-content-center align-items-center flex-column" id="dragDropArea">
                    <p id="modalBodyText">Drag photos and videos here</p>
                    <label for="file-upload" class="btn btn-primary" id="upload-btn">Select from computer</label>
                    <input id="file-upload" type="file" name="images[]" style="display: none;" onchange="displayImage(event)" accept="image/*,video/*" multiple>
                    
                </div>
                
                <!-- Display uploaded image -->
                <div id="uploadedImageContainer"></div>
            </div>
        </div>
    </div>
</div>
<!-- Crop and post details modal -->
<div class="modal fade share-modal" id="postModal" tabindex="-1" role="dialog" aria-labelledby="postModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form action="{{ route('posts.store') }}" id="postForm" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <a id="backPostModal" class="me-5">
                        <i class="fa-solid fa-arrow-left" style="color: #000000;"></i>
                    </a>
                    <h5 class="modal-title" id="postModalTitle">Create New Post</h5>
                    <div class="d-flex align-items-end">
                        <button type="submit" id="shareButton" class="ms-5">Share</button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div id="imageCarousel" class="carousel slide carousel-images-width" data-bs-ride="carousel">
                                    <div class="carousel-inner d-flex" >
                                     </div>
                            <a class="carousel-control-prev"href="#imageCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#imageCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                                </div>
                                <div id="videoContainer" style="display: none;"></div>

                            </div>
                            <div class="col-md-5 ms-5">
                                <div class="user d-flex mb-2">
                                    <img class="profile-picture" src="{{ auth()->user()->avatar }}" alt="">
                                    <p id="username" class="align-self-center fw-bold">{{ auth()->user()->username }}</p>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control post-caption" name="caption" id="caption" rows="5"
                                        placeholder="Write a caption..."></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="hashtag[]" class="form-control hashtag" id="hashtag" placeholder="Hashtags" multiple>
                                </div>
                                <div id="hashtagErrorMessage" class="alert alert-danger" style="display: none;"></div>
                                <!-- Hidden input field for image data URL -->
                                <input type="hidden" name="croppedImageDataUrls" id="croppedImageDataUrls">
                                <input type="hidden" name="videoDataUrls" id="videoDataUrls">

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
