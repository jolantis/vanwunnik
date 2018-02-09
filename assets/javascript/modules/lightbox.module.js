/**
 * Lightbox module
 */

Lightbox = function () {
	function addLightbox() {
		if (lightboxsettings.lightbox_added !== !0) {
			var lightbox = document.createElement("div"),
				closebtn = document.createElement("button");
			lightbox.className = "lightbox js-lightbox", document.body.appendChild(lightbox), closebtn.className = "lightbox__close js-lightbox-close", closebtn.innerText = "Sluit", lightbox.appendChild(closebtn), lightboxsettings.lightbox_added = !0, lightboxel.lightbox = lightbox, lightboxel.closebtn = closebtn
		}
	}
	function addBackdrop() {
		if (lightboxsettings.backdrop_added !== !0) {
			var backdrop = document.createElement("div");
			backdrop.className = "backdrop js-backdrop", document.body.appendChild(backdrop), lightboxsettings.backdrop_added = !0, lightboxel.backdrop = backdrop
		}
	}
	function updateCount(slider) {
		var current = slider.selectedIndex + 1,
			total = slider.cells.length;
		lightboxel.count.textContent = current + "/" + total
	}
	function addHash(link) {
		window.location.hash = link.getAttribute("href")
	}
	function removeHash() {
		history.pushState("", document.title, window.location.pathname + window.location.search)
	}
	function addContent(target) {
		var link = null;
		link = "a" === target.tagName.toLowerCase() ? target : domparents.findAncestorByElement(target, "a");
		var id = link.getAttribute("href"),
			sliderborder = "";
		link.classList.contains("js-has-border") && (sliderborder = " lightbox__slider--border"), addHash(link);
		var info = document.querySelector(id),
			infoel = info.cloneNode(!0),
			description = document.createElement("div");
		description.className = "lightbox__info js-lightbox-info", description.appendChild(infoel);
		var boxnav = document.createElement("div");
		boxnav.className = "lightbox__nav", description.appendChild(boxnav), lightboxel.nav = boxnav;
		var prevbtn = document.createElement("button");
		prevbtn.className = "lightbox__navbutton lightbox__navbutton--prev js-lightbox-prevbtn", boxnav.appendChild(prevbtn), lightboxel.prevbtn = prevbtn;
		var count = document.createElement("div");
		count.className = "lightbox__count js-lightbox-count", boxnav.appendChild(count), lightboxel.count = count;
		var nextbtn = document.createElement("button");
		nextbtn.className = "lightbox__navbutton lightbox__navbutton--next js-lightbox-nextbtn", boxnav.appendChild(nextbtn), lightboxel.nextbtn = nextbtn;
		var sliderid = link.getAttribute("data-slider"),
			slider = document.querySelector("#" + sliderid),
			sliderel = slider.cloneNode(!0),
			boxslider = sliderel;
		boxslider.className = "lightbox__slider js-lightbox-slider" + sliderborder, lightboxel.lightbox.appendChild(boxslider), lightboxel.lightbox.appendChild(description);
		var boxslides = boxslider.querySelectorAll(".js-slider-item");
		boxslides.length > 1 && (flkty = new Flickity(boxslider, {
			cellSelector: ".js-slider-item",
			imagesLoaded: !0,
			pageDots: !1,
			prevNextButtons: !1
		}), flkty.on("select", function () {
			updateCount(flkty)
		}), lightboxel.nextbtn.addEventListener("click", function () {
			flkty.next(!0)
		}, !1), lightboxel.prevbtn.addEventListener("click", function () {
			flkty.previous(!0)
		}, !1)), 1 === boxslides.length && (boxslides[0].classList.add("is-selected"), lightboxel.nextbtn.classList.add("is-hidden"), lightboxel.prevbtn.classList.add("is-hidden"))
	}
	function removeContent() {
		var image = lightboxel.lightbox.querySelector(".js-lightbox-image"),
			slider = lightboxel.lightbox.querySelector(".js-lightbox-slider"),
			info = lightboxel.lightbox.querySelector(".js-lightbox-info"),
			map = lightboxel.lightbox.querySelector(".js-lightbox-map");
		null !== image && "undefined" != typeof image && image.parentNode.removeChild(image), null !== slider && "undefined" != typeof slider && slider.parentNode.removeChild(slider), null !== info && "undefined" != typeof info && info.parentNode.removeChild(info), null !== map && "undefined" != typeof map && map.parentNode.removeChild(map)
	}
	function handleClose(event) {
		var target = event.target;
		(target.classList.contains("js-lightbox-close") || target.classList.contains("js-backdrop") || 27 === event.keyCode) && Lightbox.close(event), removeHash()
	}
	function setLightboxHandlers() {
		lightboxel.closebtn.addEventListener("click", handleClose, !1), document.addEventListener("keyup", handleClose, !1), lightboxel.backdrop.addEventListener("click", handleClose, !1)
	}
	function unsetLightboxHandlers() {
		lightboxel.closebtn.removeEventListener("click", handleClose, !1), document.removeEventListener("keyup", handleClose, !1), lightboxel.backdrop.removeEventListener("click", handleClose, !1)
	}
	function fitToView() {
		var maxHeight = Math.round(.9 * window.innerHeight),
			ratio = 0,
			width = lightboxel.lightbox.offsetWidth,
			height = lightboxel.lightbox.offsetHeight;
		if (height > maxHeight) {
			ratio = maxHeight / height, lightboxel.lightbox.style.height = maxHeight + "px";
			var newwidth = width * ratio;
			lightboxel.lightbox.style.width = newwidth + "px", width *= ratio, height *= ratio;
			var posleft = Math.round(window.innerWidth - width) / 2;
			lightboxel.lightbox.style.left = posleft + "px", null !== flkty && "undefined" != typeof flkty && flkty.resize()
		}
	}
	function open(event) {
		"undefined" != typeof event && event.preventDefault(), removeContent(), lightboxel.lightbox.classList.add("is-visible"), lightboxel.backdrop.classList.add("is-visible"), setLightboxHandlers(), addContent(event.target), fitToView()
	}
	function openFromHash(hash) {
		removeContent(), lightboxel.lightbox.classList.add("is-visible"), lightboxel.backdrop.classList.add("is-visible"), setLightboxHandlers();
		var link = document.querySelector('[data-link="' + hash + '"]');
		null !== link && "undefined" != typeof link && addContent(link), fitToView()
	}
	function addLightMap() {
		lightmap.loaded = !0;
		var mapcanvas = document.createElement("div");
		mapcanvas.setAttribute("id", "map-canvas"), mapcanvas.className = "lightbox__map js-lightbox-map", lightboxel.lightbox.appendChild(mapcanvas);
		var kkmapstyle = [{
			featureType: "all",
			elementType: "all",
			stylers: [{
				saturation: -100
			}]
		}],
			latlng = new google.maps.LatLng(51.8267919, 5.8560523),
			mapOptions = {
				zoom: 14,
				center: latlng,
				scrollwheel: !1,
				mapTypeControlOptions: {
					mapTypeIds: [google.maps.MapTypeId.ROADMAP, "kkmapstyle"]
				}
			};
		map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
		var mapType = new google.maps.StyledMapType(kkmapstyle, {
			name: "Kukel & Kuijpers"
		});
		map.mapTypes.set("kkmapstyle", mapType), map.setMapTypeId("kkmapstyle"), marker = new google.maps.Marker({
			position: latlng,
			icon: "/assets/images/map-marker.svg",
			map: map
		})
	}
	function loadMapScript() {
		var script = document.createElement("script");
		script.type = "text/javascript", script.id = "mapsapi", script.src = "https://maps.googleapis.com/maps/api/js?key=" + lightmap.apikey + "&callback=Lightbox.addLightMap", document.body.appendChild(script)
	}
	function openWithMap(event) {
		event.preventDefault(), removeContent(), lightboxel.lightbox.classList.add("is-visible"), lightboxel.backdrop.classList.add("is-visible"), setLightboxHandlers(), lightmap.loaded === !0 ? addLightMap() : loadMapScript()
	}
	function close(event) {
		"undefined" != typeof event && event.preventDefault(), lightboxel.lightbox.classList.remove("is-visible"), lightboxel.lightbox.classList.add("is-hiding"), lightboxel.backdrop.classList.remove("is-visible"), lightboxel.backdrop.classList.add("is-hiding");
		var backdropHasTransitionSet = null,
			backdropHasWebkitTransitionSet = null;
		window.getComputedStyle && (backdropHasTransitionSet = window.getComputedStyle(lightboxel.backdrop, null).getPropertyValue("transition"), backdropHasWebkitTransitionSet = window.getComputedStyle(lightboxel.backdrop, null).getPropertyValue("-webkit-transition")), Modernizr.csstransitions && "none" !== backdropHasTransitionSet && "none" !== backdropHasWebkitTransitionSet ? lightboxel.backdrop.addEventListener(transitionEnd, function () {
			lightboxel.lightbox.classList.remove("is-hiding"), lightboxel.backdrop.classList.remove("is-hiding")
		}, !1) : (lightboxel.lightbox.classList.remove("is-hiding"), lightboxel.backdrop.classList.remove("is-hiding")), unsetLightboxHandlers()
	}
	function init() {
		if (window.innerWidth < 768) {
			var smallsliders = document.querySelectorAll(".js-portfolio-slider");
			if (null !== smallsliders)
				for (s = 0; s < smallsliders.length; s++) {
					var smallslides = smallsliders[s].querySelectorAll(".js-slider-item");
					if (smallslides.length > 1) {
						new Flickity(smallsliders[s], {
							cellSelector: ".js-slider-item",
							imagesLoaded: !0,
							pageDots: !1
						})
					}
				}
		} else {
			if (addLightbox(), addBackdrop(), window.location.href.indexOf("#") !== -1) {
				var href = window.location.href,
					slug = href.substr(href.lastIndexOf("#") + 1);
				slug = slug.replace("/", ""), slug.indexOf("info-") !== -1 && openFromHash(slug)
			}
			var openlightboxlinks = document.querySelectorAll(".js-open-lightbox");
			if (openlightboxlinks.length > 0)
				for (i = 0; i < openlightboxlinks.length; i++)
					openlightboxlinks[i].addEventListener("click", open, !1);
			var openlightmaplinks = document.querySelectorAll(".js-open-map-lightbox");
			if (openlightmaplinks.length > 0)
				for (i = 0; i < openlightmaplinks.length; i++)
					openlightmaplinks[i].addEventListener("click", openWithMap, !1)
		}
	}
	var lightboxsettings = {
		backdrop_added: !1,
		lightbox_added: !1
	},
		lightboxel = {
			backdrop: null,
			lightbox: null,
			closebtn: null,
			count: null
		},
		flkty = null,
		lightmap = {
			loaded: !1,
			apikey: "AIzaSyCVEy2Rq7Uc29lF1on5ueT4NjqPekI5Pz4"
		};
	return {
		init: init,
		open: open,
		close: close,
		addLightMap: addLightMap
	}
}();
