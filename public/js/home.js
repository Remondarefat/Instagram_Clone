// toggle search
$(document).ready(function () {
    const searchIcon = $(".nav-tab.nav-tab-search");

    const additionalTabContent = $(".d-none");

    searchIcon.on("click", function () {
        additionalTabContent.toggleClass("d-none");
    });
});
