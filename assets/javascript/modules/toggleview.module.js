/**
 * Toggle between grid and list view
 */

var ToggleView = (function () {

	function toggle(event) {
		event.preventDefault();
		var button = event.currentTarget;
		// var toggletarget = button.parentNode;
		// var toggleview = document.querySelector('.js-toggle-view');
		var toggletarget = document.querySelector('.js-toggle-target');

		if(button.classList.contains('js-toggle-grid')) {
			toggletarget.classList.remove('cssgrid--list');
			toggletarget.classList.add('cssgrid--grid');
			enhance.cookie('toggle_view', false);
			// cookie.set('toggle_view', false);
			location.reload();
		}
		if(button.classList.contains('js-toggle-list')) {
			toggletarget.classList.remove('cssgrid--grid');
			toggletarget.classList.add('cssgrid--list');
			enhance.cookie('toggle_view', 'list', 7);
			// cookie.set('toggle_view', 'list', 7);
			location.reload();
		}

		// toggletarget.classList.toggle('cssgrid--list');

		var targetimages = toggletarget.getElementsByTagName('img');
		for (i = 0; i < targetimages.length; i++) {
			targetimages[i].classList.remove('lazyloaded');
			targetimages[i].classList.add('lazyload');
		}
	}

	function init() {
		var togglebuttons = document.querySelector('.js-toggle-buttons');
		var toggletarget = document.querySelector('.js-toggle-target');


		if (togglebuttons && toggletarget) {

			if (enhance.cookie('toggle_view') === 'list') {
				// toggletarget.classList.remove('cssgrid--grid');
				toggletarget.classList.add('cssgrid--list');
			}
			else {
				enhance.cookie('toggle_view', 'grid', 7);
				// cookie.set('toggle_view', 'grid', 7);
				// toggletarget.classList.remove('cssgrid--list');
				toggletarget.classList.add('cssgrid--grid');
			}

			var buttons = togglebuttons.getElementsByTagName('button');
			for (i = 0; i < buttons.length; i++) {
				buttons[i].addEventListener('click', ToggleView.toggle, false);
			}
		}
	}

	/**
	 * Return public methods
	 */
	return {
		// grid: grid,
		// list: list,
		toggle: toggle,
		init: init
	};
})();
