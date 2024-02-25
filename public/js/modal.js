var croppers = [];
let croppedImages = [];
var croppedImageDataURLs = [];


function displayImage(event) {
    let reader = new FileReader();
    reader.onload = function () {
        let output = '<img id="croppedImage" src="' + reader.result + '" class="img-fluid">';
        document.getElementById('uploadedImageContainer').innerHTML += output;
        document.getElementById('modalBodyText').style.display = 'none';
        document.getElementById('icon').style.display = 'none';
        document.getElementById('upload-btn').style.display = 'none';
        document.getElementById('cropButtonUpload').style.display = 'block';
        document.getElementById('back').style.display = 'block';
        document.getElementById('exampleModalLongTitle').innerText = 'Crop Image';

        // Store the image data URL in a hidden input field
        document.getElementById('imageDataUrl').value = reader.result;

        // Initialize Cropper
        initCropper();
    };
    reader.readAsDataURL(event.target.files[0]);
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

document.getElementById("cropButtonUpload").addEventListener("click", function () {
        croppers.forEach(function (cropper) {
            // converts this canvas to a data URL using the toDataURL() method
            var croppedImageDataURL = cropper.getCroppedCanvas().toDataURL();
            croppedImageDataURLs.push(croppedImageDataURL);
        });
        // Display cropped images in the post modal carousel
        displayCroppedImages(croppedImageDataURLs);
    });

document.getElementById('shareButton').addEventListener('click', function (event) {
    event.preventDefault();

    var hashtagValue = document.getElementById('hashtag').value.trim();
    if (!hashtagValue.startsWith('#')) {
        var errorMessage = document.getElementById('hashtagErrorMessage');
        errorMessage.innerText = 'Hashtag must start with #';
        errorMessage.style.display = 'block';
        event.preventDefault();
    }

});

// Drag and Drop in the modal body
let modalBody = document.getElementById('modalBody');
let dragDropArea = document.getElementById('dragDropArea');

modalBody.addEventListener('dragenter', function (e) {
    e.preventDefault();
    dragDropArea.classList.add('dragover');
});

modalBody.addEventListener('dragover', function (e) {
    e.preventDefault();
    dragDropArea.classList.add('dragover');
});

modalBody.addEventListener('dragleave', function () {
    dragDropArea.classList.remove('dragover');
});

modalBody.addEventListener('drop', function (e) {
    e.preventDefault();
    dragDropArea.classList.remove('dragover');

    var files = e.dataTransfer.files;
    if (files.length > 0) {
        displayImageFromDrop(files[0]);
    }
});

function displayImageFromDrop(file) {
    let reader = new FileReader();
    reader.onload = function () {
        let output = '<img id="croppedImage" src="' + reader.result + '" class="img-fluid" alt="Uploaded Image">';
        document.getElementById('uploadedImageContainer').innerHTML += output;
        document.getElementById('modalBodyText').style.display = 'none';
        document.getElementById('icon').style.display = 'none';
        document.getElementById('upload-btn').style.display = 'none';
        document.getElementById('cropButtonUpload').style.display = 'block';
        document.getElementById('back').style.display = 'block';
        document.getElementById('exampleModalLongTitle').innerText = 'Crop Image';

        initCropper();
    };
    reader.readAsDataURL(file);
}
// document.getElementById('shareButton').addEventListener('click', function () {
//     // Get the cropped image data URL from the Cropper instance
//     var croppedImageDataURL = cropper.getCroppedCanvas().toDataURL();


//     // Update the value of the hidden input field with the cropped image data
//     document.getElementById('imageDataUrl').value = croppedImageDataURL;
//     document.getElementById('postForm').submit();
//     )};
function displayCroppedImages(imageDataURLs) {
    const carouselInner = document.querySelector("#postModal .carousel-inner");
    carouselInner.innerHTML = "";
    imageDataURLs.forEach((imageDataURL, index) => {
        const carouselItem = document.createElement("div");
        carouselItem.classList.add("carousel-item");
        if (index === 0) {
            carouselItem.classList.add("active");
        }

        const aspectRatio = 1;
        const image = document.createElement("img");
        image.src = imageDataURL;
        carouselItem.appendChild(image);
        carouselInner.appendChild(carouselItem);
    });

    $("#exampleModalCenter").modal("hide");
    $("#postModal").modal("show");
}
$("#postModal").on("hidden.bs.modal", function () {
    console.log("Modal hidden");
    $("#nextModal").modal("show");
});

// Convert the croppedImageDataURLs array to a JSON string
const croppedImageDataURLsJSON = JSON.stringify(croppedImageDataURLs);

document.getElementById("shareButton").addEventListener("click", function () {
    // Set the value of the hidden input field to the JSON string representation of croppedImageDataURLs
    document.getElementById("croppedImageDataUrls").value =
        croppedImageDataURLsJSON;

    // Submit the form
    document.getElementById("postForm").submit();
});
