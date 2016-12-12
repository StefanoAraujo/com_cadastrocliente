window.addEvent('domready', function() {
	document.formvalidator.setHandler('email',
		function (value) {
			regex=/^\d{2}\\d{2}\\d{4}$/;
			return regex.test(value);
	});
});











