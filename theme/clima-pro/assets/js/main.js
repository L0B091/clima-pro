/**
 * Clima Pro · JS liviano (sin dependencias).
 * - Menú móvil
 * - Filtros desplegables en móvil
 * - Aparición al hacer scroll (IntersectionObserver)
 */
(function () {
	'use strict';
	var doc = document.documentElement;
	var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	// Activa animaciones solo si hay JS y el usuario no pidió movimiento reducido.
	if (!reduce && 'IntersectionObserver' in window) {
		doc.classList.add('js');
		var io = new IntersectionObserver(function (entries) {
			entries.forEach(function (e) {
				if (e.isIntersecting) {
					e.target.classList.add('is-visible');
					io.unobserve(e.target);
				}
			});
		}, { rootMargin: '0px 0px -40px 0px', threshold: 0.08 });
		// Las tarjetas de producto también aparecen con un pequeño escalonado.
		document.querySelectorAll('ul.products li.product').forEach(function (el, i) {
			el.classList.add('reveal');
			el.style.setProperty('--d', i % 5);
		});
		document.querySelectorAll('.reveal').forEach(function (el) { io.observe(el); });
	}

	// Botones que despliegan un panel (menú y filtros).
	function toggler(btnSel, panelSel) {
		var btn = document.querySelector(btnSel);
		var panel = document.querySelector(panelSel);
		if (!btn || !panel) { return; }
		btn.addEventListener('click', function () {
			var open = panel.classList.toggle('is-open');
			btn.setAttribute('aria-expanded', open ? 'true' : 'false');
		});
	}
	toggler('.nav-toggle', '#primary-nav');
	toggler('.filters-toggle', '#shop-filters');
})();
