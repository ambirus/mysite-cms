$(document).ready(function () {
    $(".fancy").on("click", this, (function () {

        var title = this.alt;

        $("<img/>")
            .attr("src", this.src)
            .load(function() {
                $(".fancyDialog > div").css("width", this.width);
                $("#openFancy > div > div").html('<h3>' + title + '</h3><img src="' + this.src + '">');
                $("#openFancy").css("display", "block");
            });
    }));

    $(".close").click(function () {
        $("#openFancy").css("display", "none");
    });
});