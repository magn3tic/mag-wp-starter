//sitewide javascript
;(function($) { 


	var s,
	magTheme = {
		settings: {
			header: $('#header'),
			mainNav: $('#main-nav'),
			mainNavToggle: $('#main-nav-toggle'),
			avar: false,
			bvar: true
		},

		init: function() {
			s = this.settings;
			this.bindUIActions();
		},

		bindUIActions: function() {
			s.mainNavToggle.on('click', this.toggleMenu);
		},

		toggleMenu: function() {
			if ( s.header.hasClass('main-nav-open') ) {
				s.mainNav.velocity('slideUp', {duration: 330, easing: 'easeOutCirc'});
				s.header.removeClass('main-nav-open');
			} else {
				s.mainNav.velocity('slideDown', {duration: 330, easing: 'easeOutCirc'});
				s.header.addClass('main-nav-open');
			}
		}
	
	}

	//
	magTheme.init();

})(jQuery);