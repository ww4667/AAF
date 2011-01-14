<script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAAoZ-8k2u7WnxmF7DO3q2Y_BQfv9QOqZKlaDP5fnJNKI2iKRbvzBQrai9WZ31un8m-B4sc1pM7ws_HBQ"></script>
<script type="text/javascript" src="/resources/js/jquery.gfeed.js"></script>
<script type="text/javascript">
	
	$(document).ready(function() {

    // local news feed in the top left corner
    $('#local_news_feed').gFeed({
        url:'http://www.google.com/calendar/feeds/84qag3svb3fkifd9fas7b3iat0@group.calendar.google.com/public/basic',
        max:20
    }); 

    // national news feed in top left corner
    $('#national_news_feed').gFeed({
        url:'http://feeds.feedburner.com/AmericanAdvertisingFederationNews?format=xml',
        max:20
    }); 

    // calendar feed in top left box under the news box
    $('#calendar_feed').gFeed({
        url:'http://www.google.com/calendar/feeds/ljnc8o0pq6vtlmnqlsfcd02puc%40group.calendar.google.com/public/basic?ctz=America/Chicago&orderby=starttime&sortorder=ascending',
        max:20
    }); 

    // full calendar feed on Full Calendar page
    $('#full_calendar_feed').gFeed({
        url:'http://www.google.com/calendar/feeds/ljnc8o0pq6vtlmnqlsfcd02puc%40group.calendar.google.com/public/basic?ctz=America/Chicago&orderby=starttime&sortorder=ascending',
        max:100
    }); 

    // student calendar feed on Student Events page
    $('#student_calendar_feed').gFeed({
        url:'http://www.google.com/calendar/feeds/7gdtqflj09o5r2ke0o828dsrc4%40group.calendar.google.com/public/basic?ctz=America/Chicago&orderby=starttime&sortorder=ascending',
        max:100
    }); 

	$('#tabs-news').tabs();
	google.setOnLoadCallback(function(){
		$.getScript('/resources/js/vscrollarea.js',function(){
			VSA_initScrollbars();
		});
	});

	});
	
</script>