// toggle search
$(document).ready(function () {
    const searchIcon = $(".nav-tab.nav-tab-search");

    const additionalTabContent = $(".d-none");

    searchIcon.on("click", function () {
        additionalTabContent.toggleClass("d-none");
    });
});
$(document).ready(function () {
    $("#settings-toggle").click(function (e) {
        e.preventDefault(); // Prevent the default behavior of the anchor tag
        $("#settings-content").slideToggle(500); // Toggle the visibility of the settings content with sliding animation
    });
});

// create post button
$(document).ready(function () {
    const createIcon = $(".nav-tab.nav-tab-create");
    const additionalTabContent = $(".createpost");
    const uploadModal = $("#exampleModalCenter");

    createIcon.on("click", function () {
        additionalTabContent.toggleClass("d-none");
        uploadModal.modal("show"); // Open the upload modal when "Create Post" is clicked
    });
});
$("#exampleModal").on("show.bs.modal", function () {
    $("body").removeClass("modal-open");
});

//search content
const searchInput = document.getElementById("search-input");
const searchResultsContainer = document.getElementById(
    "search-results-container"
);

searchInput.addEventListener("input", function () {
    const query = this.value.trim();

    if (query.length === 0) {
        searchResultsContainer.innerHTML = "No recent searches";
        return;
    }

    fetch(`/search?query=${query}`)
        .then((response) => response.json())
        .then((data) => {
            if (data.length > 0) {
                let resultsHtml = '<ul class="list-unstyled hover ">'; // Start building the HTML for search results
                data.forEach((result) => {
                    resultsHtml += `<a href="/user/${result.id}" class="text-decoration-none text-black d-flex align-items-center rounded-4 mb-2 p-2 search-tab">
                        <li class="d-flex align-items-center hover">
                            <img class="me-2 rounded-circle" src="${result.avatar}" alt="">
                            <div>
                                <p class="fw-bold mb-0">${result.username}</p>
                                <p class="text-muted mb-0">${result.fullname}</p>
                            </div>
                    </li>
                </a>`;
                });
                resultsHtml += "</ul>"; // Close the list
                searchResultsContainer.innerHTML = resultsHtml; // Update the container with search results
            } else {
                searchResultsContainer.innerHTML = "No results found";
            }
        })
        .catch((error) =>
            console.error("Error fetching search results:", error)
        );
});


//   document.getElementById('postButton').addEventListener('click', function() {
//     document.getElementById('commentForm').submit();
// });
document.getElementById('commentInput').addEventListener('input', function() {
    var postButton = document.getElementById('postButton');
    if (this.value.trim() !== '') {
        postButton.style.display = 'inline'; // Show "Post" text
    } else {
        postButton.style.display = 'none'; // Hide "Post" text
    }
});

document.getElementById('postButton').addEventListener('click', function() {
    document.getElementById('commentForm').submit(); // Submit form
});