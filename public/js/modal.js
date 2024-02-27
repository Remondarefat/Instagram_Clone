var croppers = [];
var croppedImageDataURLs = [];
var videoURLs = [];

// awel ma el user y5tar file
function displayImage(event) {
    //event.target refers to the HTML input element of type file
    let files = event.target.files;
    for (let i = 0; i < files.length; i++) {
        let file = files[i];
        if (file.type.startsWith('image/')) {
            handleImage(file);
        } else if (file.type.startsWith('video/')) {
            handleVideo(file);
        }
    }
}

function handleImage(file) {
    let reader = new FileReader();
    reader.onload = function () {
        let output = '<div class="col-md-4 mb-3"><img class="cropped-image" src="' + reader.result + '" class="img-fluid"></div>';
        document.getElementById("uploadedImageContainer").insertAdjacentHTML("beforeend", output);

        // Initialize cropper for each uploaded image
        var image = document.querySelector(".cropped-image:last-child");
        var cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 1,
            guides: false,
            autoCropArea: 1,
            responsive: true,
            background: false,
            dragMode: "move",
        });
        croppers.push(cropper);
    }
    reader.readAsDataURL(file);

    document.getElementById("modalBodyText").style.display = "none";
    document.getElementById("icon").style.display = "none";
    document.getElementById("upload-btn").style.display = "none";
    document.getElementById("cropButtonUpload").style.display = "block";
    document.getElementById("back").style.display = "block";
    document.getElementById("exampleModalLongTitle").innerText = "Crop Image";
}

function handleVideo(file) {
    let video = document.createElement('video');
    video.src = URL.createObjectURL(file); 
    video.style.width = '100%';
    // display the video controls
    video.controls = true;
    document.getElementById('uploadedImageContainer').appendChild(video);

    document.getElementById('modalBodyText').style.display = 'none';
    document.getElementById('icon').style.display = 'none';
    document.getElementById('upload-btn').style.display = 'none';
    document.getElementById('cropButtonUpload').style.display = 'block';
    document.getElementById('back').style.display = 'block';
    document.getElementById('exampleModalLongTitle').innerText = 'Upload Video';
// video = variable ,,,,, video.src = URL.createObjectURL(file)
    if (video && video.src) {
        videoURLs.push(video.src);
    } else {
        console.error('Invalid video file');
    }
}


function initCropper() {
    croppers.forEach(function (cropper) {
        cropper.enable();
    });
    var images = document.querySelectorAll(".cropped-image");
    croppers = [];
    images.forEach(function (image) {
        var cropper = new Cropper(image, {
            aspectRatio: 1,
        });
        croppers.push(cropper);
    });
}

function populateCroppedImageData() {
    croppedImageDataURLs = [];

    croppers.forEach(function (cropper) {
        var croppedImageDataURL = cropper.getCroppedCanvas().toDataURL();
        croppedImageDataURLs.push(croppedImageDataURL);
    });
}

document.getElementById("cropButtonUpload").addEventListener("click", function () {
    populateCroppedImageData();
    displayCroppedImages(croppedImageDataURLs, videoURLs);
});

function displayCroppedImages(imageDataURLs, videoURL) {
    populateCroppedImageData(); 

    const carouselInner = document.querySelector("#imageCarousel .carousel-inner");
    carouselInner.innerHTML = "";

    if (videoURL && videoURL.length > 0) {
        document.getElementById("imageCarousel").style.display = "none";
        document.getElementById("videoContainer").style.display = "block";

        // Display the video
        const video = document.createElement("video");
        video.src = videoURL;
        video.style.width = "100%";
        video.style.height = "100%";
        video.controls = true;
        document.getElementById("videoContainer").appendChild(video);
    } else {
        // Hide the video container and display the carousel
        document.getElementById("imageCarousel").style.display = "block";
        document.getElementById("videoContainer").style.display = "none";

        // Display images in the carousel
        imageDataURLs.forEach((imageDataURL, index) => {
            const carouselItem = document.createElement("div");
            carouselItem.classList.add("carousel-item");
            if (index === 0) {
                carouselItem.classList.add("active");
            }
            const image = document.createElement("img");
            image.src = imageDataURL;
            image.style.width = "100%";
            image.style.height = "100%";
            carouselItem.appendChild(image);
            carouselInner.appendChild(carouselItem);
        });
    }
    $("#exampleModalCenter").modal("hide");
    $("#postModal").modal("show");
}


document.getElementById("shareButton").addEventListener("click", function () {
    populateCroppedImageData();
    document.getElementById("croppedImageDataUrls").value = JSON.stringify(croppedImageDataURLs);
    document.getElementById("videoDataUrls").value = JSON.stringify(videoURLs);

    const hashtagInput = document.getElementById("hashtag");
    const hashtags = hashtagInput.value.trim();
    var firstWord = hashtags.split(' ')[0]
    if (hashtags.length === 0 || firstWord.startsWith('#')) {
        document.getElementById("hashtag").value = hashtags;
        document.getElementById("postForm").submit();
    } else{
        var errorMessage = document.getElementById('hashtagErrorMessage');
        errorMessage.innerText = 'Hashtag must start with #';
        errorMessage.style.display = 'block';
        event.preventDefault();
    }
});

document.getElementById('backPostModal').addEventListener('click', function () {
    $('#postModal').modal('hide');
    $('#exampleModalCenter').modal('show');
});

document.getElementById('back').addEventListener('click', function () {
    $('#exampleModalCenter').modal('hide');
});
