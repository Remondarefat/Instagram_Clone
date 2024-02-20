// Image upload in the modal 
//the  function reads the contents of the selected image file, 
// converts it to a data URL, creates an <img> tag with the data URL as its source, 
// and then inserts the <img> tag into the modal's html
function displayImage(event) {
    let reader = new FileReader();
    reader.onload = function () {
       let output = '<img id="croppedImage" src="' + reader.result + '" class="img-fluid">';
        document.getElementById('uploadedImageContainer').innerHTML = output;
        document.getElementById('modalBodyText').style.display = 'none';
        document.getElementById('icon').style.display = 'none';
        document.getElementById('upload-btn').style.display = 'none';
        document.getElementById('cropButtonUpload').style.display = 'block'; 
        document.getElementById('back').style.display = 'block';
        document.getElementById('exampleModalLongTitle').innerText = 'Crop Image'; 

        // Initialize Cropper
        initCropper(); 
    };
    reader.readAsDataURL(event.target.files[0]);
}

function initCropper() {
    var image = document.getElementById('croppedImage');
    var cropper = new Cropper(image, {
        aspectRatio: 1
    });

    document.getElementById('cropButtonUpload').addEventListener('click', function () {
        var canvas = cropper.getCroppedCanvas();
        var croppedImageDataURL = canvas.toDataURL('image/png');
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
        document.getElementById('uploadedImageContainer').innerHTML = output;
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
