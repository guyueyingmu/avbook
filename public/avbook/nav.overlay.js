(function($) {
		var CBody = $('div.container'),
        TBtn = $('.trigger-overlay'),
        FScreen = $('div.overlay'),
        CBtn = $('.overlay .overlay-close');

		function toggleFScreen() {
        if (FScreen.hasClass('open')) {
            FScreen.removeClass('open');
            CBody.removeClass('overlay-open');
        } else {
            FScreen.addClass('open');
            CBody.addClass('overlay-open');
        }
    }
    TBtn.on('click', toggleFScreen);
    CBtn.on('click', toggleFScreen);
})(jQuery);