/**
 * main.script.js
 *
 * Custom, additional scripts
 */

// Executed on DOM ready
domready(function () {

	/**
	 * Invoke modules
	 */

	// Alerts.init(push_message);                                                  // Init alerts
	// Expand.init();                                                              // Init expand / collapse
	Filters.init();                                                             // Init filters
	FontObserverHandler.init();                                                 // Init font(face)observer
	// NavMain.init();                                                             // Init main navigation
	// Popup.init();                                                               // Init popup
	Overlay.init();                                                             // Init overlay
	// ToggleView.init();                                                          // Init togg`le (grid or list) view

	/**
	 * Invoke plugins
	 */

	// Run svg4everybody polyfill (e.g. for IE11)
	svg4everybody({
		nosvg: false,                                                           // Shiv <svg> and <use> elements and use image fallbacks
		polyfill: true                                                          // Polyfill <use> elements for external content
	});

	// Init smoothscroll (with or without hash)
	// new SmoothScroll('a[href*="#"]', {
	// 	// speed: 500,
	// 	offset: 32
	// });
	smoothScrollWithoutHash('a[href*="#"]', {
		// speed: 500,
		offset: 32
	});

	// Init gumshoe (scrollspy)
	// gumshoe.init();

});
