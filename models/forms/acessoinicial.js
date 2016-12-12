window.addEvent('domready', function() {
	document.formvalidator.setHandler('documento',
		function (value) {
			regex=/^\d{2}\\d{2}\\d{4}$/;
			return regex.test(value);
	});
	document.formvalidator.setHandler('nome',
		function (value) {
			regex=/^[^_]+$/;
			return regex.test(value);
	});
	document.formvalidator.setHandler('datanascimento',
		function (value) {
			regex=/^[^_]+$/;
			return regex.test(value);
	});
	document.formvalidator.setHandler('email',
		function (value) {
			regex=/^[^_]+$/;
			return regex.test(value);
	});
	document.formvalidator.setHandler('termo',
		function (value) {
			regex=/^[^_]+$/;
			return regex.test(value);
	});
});











