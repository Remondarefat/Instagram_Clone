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

