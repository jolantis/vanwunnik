/**
 * Filters (show-hide filter tags) module
 */

var Filters = (function () {

	function toggle(event) {
		event.preventDefault();
		var button = event.target;
		var expandtarget = document.querySelector('.js-filters');
		var expandparent = expandtarget.parentNode;

		if (expandparent.classList.contains('is-closed')) {
			expandparent.removeChild(button);
			button.textContent = 'Less −';
			expandtarget.appendChild(button);
			expandparent.classList.remove('is-closed');
			expandparent.classList.add('is-open');
		}
		else {
			expandtarget.removeChild(button);
			button.textContent = 'More +';
			expandparent.insertBefore(button, expandtarget);
			expandparent.classList.remove('is-open');
			expandparent.classList.add('is-closed');
		}
	}

	function init() {
		var expandtarget = document.querySelector('.js-filters');

		if (expandtarget) {
			var expandparent = expandtarget.parentNode;
			var button = expandtarget.parentNode.getElementsByTagName('button')[0];
			var lastItem = expandtarget.lastElementChild;

			if (expandparent.classList.contains('is-open')) {
				expandtarget.removeChild(button);
				expandparent.classList.remove('is-open');
			}
			else {

				if (isVisible(lastItem)) {
					expandparent.classList.add('is-visible');

					if (button) {
						button.remove();
						expandparent.classList.remove('is-closed');
					}
				}
				else {

					if (!button) {
						var newButton = document.createElement('button');
						newButton.setAttribute('aria-hidden', true);
						newButton.textContent = 'More +';
						expandparent.classList.add('is-closed');
						expandparent.classList.remove('is-visible');
						expandparent.insertBefore(newButton, expandtarget);
						newButton.addEventListener('click', Filters.toggle, false);
					}
				}
			}
		}
	}

	// Store the window width
	var windowwidth = window.innerWidth;

	// Check window width has actually changed and it's not just iOS triggering a resize event on scroll!
	if (window.innerWidth !== windowwidth) {

		// Debounced (delayed) callback of `init` function after resize!
		window.addEventListener('resize', debounce(init), false);
	}

	/**
	 * Return public methods
	 */
	return {
		toggle: toggle,
		init: init
	};
})();
