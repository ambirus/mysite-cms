!function ($) {
    $(document).on("click","ul.nav li.parent > a > span.icon", function(){
        $(this).find('em:first').toggleClass("glyphicon-minus");
    });
    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
}(window.jQuery);

$(window).on('resize', function () {
    if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
})
$(window).on('resize', function () {
    if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
});

$(document).ready(function () {

    $(".delete-item").click(function () {
        if (confirm('Delete this item?')) {
            return true;
        }
        return false;
    });

    $("select[name=PrettyUrl\\[model\\]]").change(function () {

        $.post('/navigation/pretty/items', {model: this.value})
            .done(function (data) {
                $("select[name=PrettyUrl\\[modelItem\\]]").html(data);
                var optionId = $("select[name=PrettyUrl\\[model\\]]").children(":selected").attr("id");

                $("input[name=PrettyUrl\\[fullUrl\\]]").val('/' + optionId.substr(6) + '/front/index');
            });

    });

    $("select[name=PrettyUrl\\[modelItem\\]]").change(function () {
        $("input[name=PrettyUrl\\[fullUrl\\]]").val($("select[name=PrettyUrl\\[modelItem\\]]").val());

    });

    $(".showMore").click(function () {
        var nextDiv = $(this).next()[0];

        if (nextDiv.className === 'hidden') {
            nextDiv.className = '';
            $(this)[0].innerHTML = '&#9650;';

        } else {
            nextDiv.className = 'hidden';
            $(this)[0].innerHTML = '&#9660;';
        }

    });

    $(".datetimepicker").datetimepicker($.extend($.datepicker.regional[document.currLang]));

    $(".ajax-item").click(function (event) {

        event.preventDefault();

        var results = $("#ajax_results");

        $.ajax({
            url: this.href
            //context: document.body
        }).done(function(e) {
            results.addClass("alert bg-success");
            results.css("display", "block");
            results.text(e);
        }).error(function (e) {
            results.addClass("alert bg-danger");
            results.css("display", "block");
            results.text(e.statusText);
        });

    });

    $(".bloq_descr").click(function () {
        $(".bloq_descr").next("blockquote").slideToggle();
    });
});