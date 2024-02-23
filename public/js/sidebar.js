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
