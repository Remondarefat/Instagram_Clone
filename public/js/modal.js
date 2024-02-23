
var cropper;
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
    var image = document.getElementById('croppedImage');
    cropper = new Cropper(image, {
                aspectRatio: 1
    });

    document.getElementById('cropButtonUpload').addEventListener('click', function () {
        var croppedImageDataURL = cropper.getCroppedCanvas().toDataURL();
        document.getElementById('postModalTitle').innerText = 'Create New Post';
        document.getElementById('croppedImagePrev').src = croppedImageDataURL;
        $('#exampleModalCenter').modal('hide');
        $('#postModal').modal('show');
    });

    document.getElementById('backPostModal').addEventListener('click', function () {
        $('#postModal').modal('hide');
        $('#exampleModalCenter').modal('show');
        document.getElementById('croppedImagePrev').src = '';
        document.getElementById('file-upload').value = '';
    });
}
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
document.getElementById('shareButton').addEventListener('click', function () {
    // Get the cropped image data URL from the Cropper instance
    var croppedImageDataURL = cropper.getCroppedCanvas().toDataURL();


// Update the value of the hidden input field with the cropped image data
    document.getElementById('imageDataUrl').value = croppedImageDataURL;
    document.getElementById('postForm').submit();
});