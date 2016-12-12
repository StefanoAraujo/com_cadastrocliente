window.addEvent('domready', function() {
	document.formvalidator.setHandler('data',
		function (value) {
			regex=/^\d{2}\\d{2}\\d{4}$/;
			return regex.test(value);
	});
	document.formvalidator.setHandler('ouvidoria_titular',
		function (value) {
			regex=/^[^_]+$/;
			return regex.test(value);
	});
});











