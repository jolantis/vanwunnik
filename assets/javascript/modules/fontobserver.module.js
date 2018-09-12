/**
 * Fontobserver module
 *
 * More info: https://www.bramstein.com/writing/web-font-loading-patterns.html
 */

var FontObserverHandler = (function () {

	function init() {

		// If the class `fonts-loaded` is already set, we're good
		if (document.documentElement.className.indexOf('fonts-loaded') > -1) {
			// if (document.documentElement.classList.contains('fonts-loaded')) {
			return;
		}

		// Define the fonts and font variants to observed
		var rosario_regular = new FontFaceObserver('Rosario', {
			weight: 400
		});
		var rosario_italic = new FontFaceObserver('Rosario', {
			weight: 400,
			style: 'italic'
		});
		var rosario_bold = new FontFaceObserver('Rosario', {
			weight: 700
		});
		var rosario_bold_italic = new FontFaceObserver('Rosario', {
			weight: 700,
			style: 'italic'
		});

		// Loading groups of fonts with a timeout
		Promise.all([
			rosario_regular.load(),
			rosario_italic.load(),
			rosario_bold.load(),
			rosario_bold_italic.load()
		]).then(function () {
			document.documentElement.className += ' fonts-loaded';
			// document.documentElement.classList.add('fonts-loaded');
			enhance.cookie('fonts_loaded', 'true', 7);
			// console.log('Kawak fonts have loaded.');
		}).catch(function () {
			// document.documentElement.classList.add('fonts-failed');
			console.info('Web fonts could not be loaded in time. Falling back to system fonts.');
		});

		// // Timer helper function
		// function timer(time) {
		// 	return new Promise(function (resolve, reject) {
		// 		setTimeout(reject, time);
		// 	});
		// }

		// // Loading groups of fonts with a timeout
		// Promise.race([
		// 	timer(3000),
		// 	kawak_light.load(),
		// 	kawak_regular.load()
		// ]).then(function () {
		// 	document.documentElement.className += ' fonts-loaded';
		// 	// document.documentElement.classList.add('fonts-loaded');
		// 	enhance.cookie('fonts_loaded', 'true', 7);
		// 	// console.info('Kawak fonts have loaded.');
		// }).catch(function () {
		// 	// document.documentElement.classList.add('fonts-failed');
		// 	console.info('Kawak fonts loading has timed out (> 3 sec.). Falling back to system fonts.');
		// });

		// // Prioritised loading
		// kawak_light.load().then(function () {
		// 	document.documentElement.className += ' kawak-light-loaded';
		// 	console.info('Kawak Light font has loaded.');

		// 	kawak_regular.load().then(function () {
		// 		document.documentElement.className += ' kawak-regular-loaded';
		// 		document.documentElement.className += ' fonts-loaded';
		// 		console.info('Kawak Regular font has loaded.');
		// 	});
		// });

	}

	/**
	 * Return public methods
	 */
	return {
		init: init
	};
})();
