function toggleFollow(formId) {
    var form = document.getElementById(formId);
    var formData = new FormData(form);
    var xhr = new XMLHttpRequest();
    xhr.open(form.method, form.action);
    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Handle success
            console.log(xhr.responseText); // You can optionally log the response
            // Update the button text
            var button = form.querySelector("button");
            if (button.textContent.trim() === "Follow") {
                button.textContent = "Following";
                button.classList.remove("user-follow-btn");
                button.classList.add("user-profile-btn");
                button.innerHTML +=
                    '<i class="fa-solid fa-arrow-down" style="color: #000714;"></i>';
            } else {
                button.textContent = "Follow";
                button.classList.remove("user-profile-btn");
                button.classList.add("user-follow-btn");
            }
        } else {
            // Handle errors or other statuses
        }
    };
    xhr.send(formData);
}
