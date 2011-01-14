<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

[[!include? &file=`resources/chunks/doc_head.php`]]

<body>
	<div id="wrapper">
		<div id="header">
			<div id="skip"><a tabindex="1" accesskey="S" href="#content">Skip to Main Content</a></div>
			<span class="logo"><a title="american advertising federation logo" href="[[~1]]">American Advertising Federation of Des Moines</a></span>
			<div class="links-area">
				[[include? &file=`resources/chunks/dynamic_navigation.php`]]
			</div>
		</div>
		<div id="main">
			<div id="twocolumns">
				<div id="content">
				    <h1>[[*pagetitle]]</h1>
                    	[[*content]]
					<!--
					<ul class="entry-links">
						<li><a tabindex="12" href="[[~11]]">JOIN</a></li>
						<li><a tabindex="13" href="[[~10]]">MEMBER LOG IN</a></li>
					</ul>
					-->
				</div>
				<div class="aside">
					<div class="info-box">
						
						<h2>FEATURED EVENTS</h2>
						[[!getResources? &parents=`16` &tpl=`featuredEvent` &includeTVs=`1` &processTVs=`1`]]
						
					</div>
					<div class="info-box sub-box">
						<h2>SPONSORS</h2>
						<a tabindex="15" href="#"><img src="resources/images/img-empty.gif" width="190" height="163" alt="image description" /></a>
						<a tabindex="16" href="#"><img src="resources/images/img-empty.gif" width="190" height="163" alt="image description" /></a>
						<div class="more">
							<a tabindex="17" rel="#sponsor_form" href="[[~17]]">BECOME A SPONSOR</a>
						</div>
					</div>
				</div>
			</div>
			<div id="sidebar">
				<div class="info-block">
				    [[!include? &file=`resources/chunks/news_scroller.php`]]
				</div>
				<div class="info-block">
					[[!include? &file=`resources/chunks/calendar_scroller.php`]]
				</div>
				<div class="info-block sub-block">
					<h2>FEATURED MEMBER</h2>
					<div class="text-box">
						<div class="personal">
							<a tabindex="24" href="[[~2]]"><img src="resources/images/img1.gif" width="60" height="67" alt="photo" /></a>
							<div class="info">
								<strong>Jason LaCava</strong>
								<span>Creative Director at Measured Intentions</span>
							</div>
						</div>
						<p>Advertising and Marketing specialist and award winning graphic designer with fifteen years of experience in the marketing and advertising</p>
						<div class="more">
							<a tabindex="25" title="learn more about featured member" href="[[~2]]">LEARN MORE</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		[[include? &file=`resources/chunks/footer.php`]]
	</div>
</body>
</html>