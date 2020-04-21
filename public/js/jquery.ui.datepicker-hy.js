/* Russian (UTF-8) initialisation for the jQuery UI date picker plugin. */
/* Written by Ashot Navasardyan (ashotnavasardyan@gmail.com). */
jQuery(function($){
	$.datepicker.regional['hy'] = {
		closeText: 'Փակել',
		prevText: '&#x3c;Նախ',
		nextText: 'Հաջ&#x3e;',
		currentText: 'Այսօր',
		monthNames: ['Հունվար','Փետրվար','Մարտ','Ապրիլ','Մայիս','Հունիս',
		'Հուլիս','Օգոստոս','Սեպտեմբեր','Հոկտեմբեր','Նոյեմբեր','Դեկտեմբեր'],
		monthNamesShort: ['Հուն','Փետ','Մար','Ապր','Մայ','Հուն',
		'Հուլ','Օգս','Սեպ','Հոկ','Նոյ','Դեկ'],
		dayNames: ['Կիրակի','Երկուշաբթի','Երեքշաբթի','Չորեքշաբթի','Հինգշաբթի','Ուրբաթ','Շաբաթ'],
		dayNamesShort: ['կրկ','երկ','երե','չոր','հնգ','ուր','շբթ'],
		dayNamesMin: ['Կր','Եկ','Եր','Չր','Հն','Ուբ','Շբ'],
		weekHeader: 'Շբ',
		dateFormat: 'dd.mm.yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['hy']);
});