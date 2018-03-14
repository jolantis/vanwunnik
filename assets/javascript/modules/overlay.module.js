/**
 * Overlay module
 */

var Overlay = (function () {

	function addHash(url) {
		// history.replaceState(null, document.title, target.href);
		// history.pushState(null, document.title, target.href);
		history.pushState(url, null, url);
		// history.replaceState(url, null, url);
		// document.title = document.title;
	}

	function removeHash(url) {

		if (typeof url === 'undefined') {
			// history.replaceState(null, document.title, location.pathname);
			// history.pushState(null, null, location.pathname);
			history.replaceState(null, null, location.pathname);
		}
		else {
			history.pushState(url, null, url);
			// history.replaceState(null, document.title, target.href);
		}
	}

	// function updateHistory(url) {
	// 	window.browserHistory = window.browserHistory? window.browserHistory : [];

	// 	if (window.browserHistory.length > 10) {
	// 		window.browserHistory = window.browserHistory.shift();
	// 	}

	// 	window.browserHistory.push(url);
	// }

	function removeContent() {
		var overlay = document.querySelector('.js-overlay');

		if (overlay !== null) {
			overlay.setAttribute('aria-hidden', true);
		}
		document.body.classList.remove('is-open-overlay');
	}

	function loadContent(url) {
		var request = new XMLHttpRequest();
		request.open('GET', url, false);
		request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
		request.send(null);

		if (request.status === 200) {
			document.getElementById('ajax-container').innerHTML = request.responseText;
			// setupHistoryClicks();
			return true;
		}
		return false;
	}

	// function unload() {

	// }

	// function handleClose(event) {
	// 	var target = event.target;
	// 	(target.classList.contains("js-lightbox-close") || target.classList.contains("js-backdrop") || 27 === event.keyCode) && Lightbox.close(event), removeHash()
	// }

	// function setLightboxHandlers() {
	// 	lightboxel.closebtn.addEventListener("click", handleClose, !1), document.addEventListener("keyup", handleClose, !1), lightboxel.backdrop.addEventListener("click", handleClose, !1)

	// }

	// function unsetLightboxHandlers() {
	// 	lightboxel.closebtn.removeEventListener("click", handleClose, !1), document.removeEventListener("keyup", handleClose, !1), lightboxel.backdrop.removeEventListener("click", handleClose, !1)
	// }

	function close(event) {
		event.preventDefault();
		var target = event.currentTarget;

		removeContent();
		removeHash(target.href);
	}

	function open(event) {
		event.preventDefault();
		var target = event.currentTarget;
		var overlay = document.querySelector('.js-overlay');
		var closebutton = document.querySelector('.js-overlay-close');

		document.body.classList.add('is-open-overlay');
		// overlay.classList.remove('is-hidden');
		overlay.setAttribute('aria-hidden', false);
		loadContent(target.href);
		closebutton.addEventListener('click', Overlay.close, false);
		// closebutton.addEventListener('click', close, closebutton.href);
		addHash(target.href);

		document.addEventListener('keyup', function(event) {
			// var closebutton = document.querySelector('.js-overlay-close');

			if (event.keyCode === 27) {
				// close(closebutton.href);
				removeContent();
				removeHash(closebutton.href);
			}
		}, true);

		// window.addEventListener('popstate', function(event) {
		// 	history.replaceState(null, document.title, location.pathname);
		// 	removeContent();
		// });
	}

	// function openFromHash() {
	// 	// var link = document.querySelector('[data-link="' + hash + '"]');

	// 	// removeContent();
	// 	loadContent(target);
	// }

	function init() {
		// if (window.location.href.indexOf("#") !== -1) {
		// 	var href = window.location.href,
		// 		slug = href.substr(href.lastIndexOf("#") + 1);
		// 	slug = slug.replace("/", ""), slug.indexOf("info-") !== -1 && openFromHash(slug)
		// }

		var openoverlaylinks = document.querySelectorAll('.js-overlay-open');

		// if (openoverlaylinks.length > 0 && window.innerWidth >= 768) {
		if (openoverlaylinks.length > 0) {
			for (i = 0; i < openoverlaylinks.length; i++) {
				openoverlaylinks[i].addEventListener('click', Overlay.open, false);
			}
		}
	}

	window.addEventListener('popstate', function(event) {
		var url = event.state;
		// var openoverlaylinks = document.querySelectorAll('.js-overlay-open');

		// console.log(openoverlaylinks);

		// if (url !== null && window.innerWidth >= 768) {
		if (url !== null) {
			var slug = url.substring(url.lastIndexOf('/') + 1)	;

			// console.log(slug, location.pathname);
			// console.log(slug);
			// console.log(location.href);

			// if (location.pathname.indexOf('series') === -1) {
			// 	removeContent();
			// 	removeHash();
			// 	console.log('PIET');
			// }

			if ((slug !== 'werk' || slug !== 'work') && isNaN(slug) === true && location.pathname.indexOf('series') === -1) {
			// if (location.pathname !== '/work') {
				var overlay = document.querySelector('.js-overlay');
				var closebutton = document.querySelector('.js-overlay-close');

				document.body.classList.add('is-open-overlay');
				// overlay.classList.remove('is-hidden');
				overlay.setAttribute('aria-hidden', false);
				loadContent(url);
				closebutton.addEventListener('click', Overlay.close, false);
				// addHash(url);
				history.replaceState(url, null, url);
			}
			else {
				removeContent();
				removeHash();
			}
		}
		else {
			removeContent();
			removeHash();
		}
	});

	/**
	 * Return public methods
	 */
	return {
		close: close,
		open: open,
		init: init
	};
}) ();
