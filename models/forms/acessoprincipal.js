window.addEvent('domready', function() {
	document.formvalidator.setHandler('senha',
		function (value) {
			regex=/^\d{2}\\d{2}\\d{4}$/;
			return regex.test(value);
	});
	document.formvalidator.setHandler('cpfcnpj',
		function (value) {
			regex=/^[^_]+$/;
			return regex.test(value);
	});
});











