// start-foundation.js
// Just gets foundation started.

$(document).foundation('interchange', {
  named_queries : {
	// Retina for small screens
    smallretina : 	'only screen and (-webkit-min-device-pixel-ratio: 2),  only screen and (min--moz-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2/1), only screen and (min-device-pixel-ratio: 2), only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx)',
	// Retina for medium screens
	mediumretina:	'only screen and (min-width: 40.063em) and (-webkit-min-device-pixel-ratio: 2),  only screen and (min-width: 40.063em) and (min--moz-device-pixel-ratio: 2), only screen and (min-width: 40.063em) and (-o-min-device-pixel-ratio: 2/1), only screen and (min-width: 40.063em) and (min-device-pixel-ratio: 2), only screen and (min-width: 40.063em) and (min-resolution: 192dpi), only screen and (min-width: 40.063em) and (min-resolution: 2dppx)',
	// Retina for large screens
	largeretina: 'only screen and (min-width: 64.063em) and (-webkit-min-device-pixel-ratio: 2),  only screen and (min-width: 64.063em) and (min--moz-device-pixel-ratio: 2), only screen and (min-width: 64.063em) and (-o-min-device-pixel-ratio: 2/1), only screen and (min-width: 64.063em) and (min-device-pixel-ratio: 2), only screen and (min-width: 64.063em) and (min-resolution: 192dpi), only screen and (min-width: 64.063em) and (min-resolution: 2dppx)',
	// Retina for xlarge screen
	xlargeretina: 'only screen and (min-width: 90.063em) and (-webkit-min-device-pixel-ratio: 2),  only screen and (min-width: 90.063em) and (min--moz-device-pixel-ratio: 2), only screen and (min-width: 90.063em) and (-o-min-device-pixel-ratio: 2/1), only screen and (min-width: 90.063em) and (min-device-pixel-ratio: 2), only screen and (min-width: 90.063em) and (min-resolution: 192dpi), only screen and (min-width: 90.063em) and (min-resolution: 2dppx)',
	// Retina for xxlarge screen
	xxlargeretina:	'only screen and (min-width: 120.063em) and (-webkit-min-device-pixel-ratio: 2),  only screen and (min-width: 120.063em) and (min--moz-device-pixel-ratio: 2), only screen and (min-width: 120.063em) and (-o-min-device-pixel-ratio: 2/1), only screen and (min-width: 120.063em) and (min-device-pixel-ratio: 2), only screen and (min-width: 120.063em) and (min-resolution: 192dpi), only screen and (min-width: 120.063em) and (min-resolution: 2dppx)'
  }
});

 $(document).foundation();