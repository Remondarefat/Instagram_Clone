var croppers = [];
let croppedImages = [];
var croppedImageDataURLs = [];

function displayImage(event) {
    for (let i = 0; i < event.target.files.length; i++) {
        // use Filereader to read the file asynchronously
        let reader = new FileReader();
        reader.onload = function () {
            // When the file reading is completed, it Generates HTML markup (<img> tag) to display the uploaded image.
            let output =
                '<div class="col-md-4 mb-3"><img class="cropped-image" src="' +
                reader.result +
                '" class="img-fluid"></div>';
            document
                .getElementById("uploadedImageContainer")
                .insertAdjacentHTML("beforeend", output);

            // Initialize cropper for each uploaded image
            var image = document.querySelector(".cropped-image:last-child");
            var cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 1,
                guides: false,
                dragMode: "move",
            });
            croppers.push(cropper);
        };
        reader.readAsDataURL(event.target.files[i]);
    }

    document.getElementById("modalBodyText").style.display = "none";
    document.getElementById("icon").style.display = "none";
    document.getElementById("upload-btn").style.display = "none";
    document.getElementById("cropButtonUpload").style.display = "block";
    document.getElementById("back").style.display = "block";
    document.getElementById("exampleModalLongTitle").innerText = "Crop Image";
    initCropper();
}
let croppie = null;

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

document
    .getElementById("cropButtonUpload")
    .addEventListener("click", function () {
        croppers.forEach(function (cropper) {
            // converts this canvas to a data URL using the toDataURL() method
            var croppedImageDataURL = cropper.getCroppedCanvas().toDataURL();
            croppedImageDataURLs.push(croppedImageDataURL);
        });
        // Display cropped images in the post modal carousel
        displayCroppedImages(croppedImageDataURLs);
    });

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
