<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>[[++site_name]] - [[*pagetitle]]</title>
        <base href="[[!++site_url]]" />
	
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="resources/css/reset.css" />
	<link rel="stylesheet" type="text/css" href="resources/css/all.css" />
	<link rel="stylesheet" type="text/css" href="resources/css/tabs.css" />
	
	[[include? &file=`resources/chunks/nav_scripts.php`]]
	[[include? &file=`resources/chunks/google_feed_api.php`]]
	
	<!-- JAVASCRIPT -->
	<script type="text/javascript" src="http://cdn.jquerytools.org/1.2.5/tiny/jquery.tools.min.js"></script>
	<script type="text/javascript" src="https://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
	<script type="text/javascript" src="resources/js/jquery-ui-personalized-1.6rc4.min.js"></script>
	<!--
	<script type="text/javascript" src="resources/js/vscrollarea.js"></script>
	-->
	<script type="text/javascript">//<![CDATA[
		var mobi = ['opera', 'iemobile', 'webos', 'android', 'safari'];
		var midp = ['blackberry', 'symbian'];
		var ua = navigator.userAgent.toLowerCase();
		/*var desktop = '<link rel="stylesheet" href="resources/css/all.css" type="text/css" media="all"/><!--[if IE]><link rel="stylesheet" type="text/css" href="resources/css/lt7.css" media="screen"/><![endif]-->';*/
		var desktop = '<!--[if IE]><link rel="stylesheet" type="text/css" href="resources/css/lt7.css" media="screen"/><![endif]-->';
		if ((ua.indexOf('midp') != -1) || (ua.indexOf('mobi') != -1) || ((ua.indexOf('ppc') != -1) && (ua.indexOf('mac') == -1)) || (ua.indexOf('webos') != -1)) {
			document.write('<link rel="stylesheet" href="resources/css/allmobile.css" type="text/css" media="all"/>');
			if (ua.indexOf('midp') != -1) {
				for (var i = 0; i < midp.length; i++) {
					if (ua.indexOf(midp[i]) != -1) {
						document.write('<link rel="stylesheet" href="resources/css/' + midp[i] + '.css" type="text/css"/>');
						document.write('<meta name="viewport" content="width=240,initial-scale=1.0,maximum-scale=1.0,user-scalable=0"/>');
					}
				}
			}
			else {
				if ((ua.indexOf('mobi') != -1) || (ua.indexOf('ppc') != -1) || (ua.indexOf('webos') != -1)) {
					for (var i = 0; i < mobi.length; i++) {
						if (ua.indexOf(mobi[i]) != -1) {
							document.write('<link rel="stylesheet" href="resources/css/' + mobi[i] + '.css" type="text/css"/>');
							document.write('<meta name="viewport" content="width=240"/>');
							break;
						}
					}
				}
			}
		}
		else {
			document.write(desktop);
		}
	//]]></script>
	
	<style type="text/css">
		.gf-result .gf-author,.gf-result .gf-spacer,.gf-result .gf-relativePublishedDate	{display:none}
		.gf-title	{font-weight:bold}
		#calendar_feed .gfc-resultsHeader	{display:none}
		#sidebar .gfc-result	{margin-bottom:10px}
		#content .gfc-result	{margin-bottom:15px}
			#content .gfc-resultsHeader	{display:none}
	</style>
	
	<!--[if lt IE 7]><link rel="stylesheet" type="text/css" href="resources/css/lt7.css" media="screen"/><![endif]-->
</head>