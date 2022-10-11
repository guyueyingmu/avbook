(function($) {

    $(document).ready(function() {


        if ($('body').height() > $(window).height()) {
            $("#prev, #next").hide();
        }

        var show = function() {
                return $('body').height() - ($(window).height() + $(window).height() / 2);
            }

        $(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > show()) {
                    $("#prev, #next").show();
                } else {
                    $("#prev, #next").hide();
                }
            });
        });
    });

})(jQuery);