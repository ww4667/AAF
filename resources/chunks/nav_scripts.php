<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

<script type='text/javascript'>
	$(document).ready(function(){
		$("a.navLink").hover(function() {
			$(this).stop().animate({"font-size":"28px", "line-height":"34px"}, "fast");
			$("a.navLink").not(this).stop().animate({"font-size":"16px"}, "fast");
			},function() {
				$("a.navLink").stop().animate({"font-size":"18px", "line-height":"36px"}, "fast");
			});
	});
</script>