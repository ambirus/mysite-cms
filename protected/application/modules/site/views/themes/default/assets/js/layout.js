$(document).ready(function () {
    var $menu = $("#menu"), $btn = $("#menu-toggle");

    $("#menu-toggle").on("click", function () {
        $menu.toggleClass("open");
        return false;
    });

    $("#logo").click(function () {
        location.href = '/';
    });
});
